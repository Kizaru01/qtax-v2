<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Number extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_number');
    }

    public function index()
    {

      // if ($this->session->userdata('a_type') != 'NUMBER' || $this->session->userdata('a_type') == '') {
        // redirect('account');
      // } else {
        $data['title'] = 'LANDTAX';
        $this->load->view('v_number', $data);
      // }

        // file_put_contents(basename('/_getviewing.txt'),file_get_contents(base_url().'viewing/ajax_get_viewing'));
        // file_put_contents(basename('/_getwaiting.txt'),file_get_contents(base_url().'viewing/ajax_get_waiting'));
    }

    public function ajax_save() {
      $data['type'] = $this->input->get('status');
      $data['type_old'] = $this->input->get('status');

      $apptpye = '';
      // $data['number'] = '';


      // echo "type: ".$data['type'];

      //get number
      if($number = $this->mdl_number->m_ajax_get_number($data)) {
        $data['number'] = $number[0]->series;

          // echo "number: ".$data['number'];
      } else {

          // echo "else type: ".$data['type'];

        if ($data['type'] == 'REGULAR') {
          $data['number'] = '1001';
        } else if ($data['type'] == 'SPECIAL') {
          $data['number'] = '2001';
        } else if ($data['type'] == 'REGULAR5-10') {
          $data['number'] = '3001';
        } else if ($data['type'] == 'SPECIAL5-10') {
          $data['number'] = '4001';
        }  else if ($data['type'] == 'PREGULAR') {
            $data['number'] = '5001';
          } else if ($data['type'] == 'PSPECIAL') {
            $data['number'] = 'A001';
          } else if ($data['type'] == 'PREGULAR5-10') {
            $data['number'] = '6001';
          } else if ($data['type'] == 'PSPECIAL5-10') {
            $data['number'] = 'PS01';
        } else if ($data['type'] == 'PAYMENT-ONLY') {
          $data['number'] = 'P001';
        } else if ($data['type'] == 'RELEASING-REGULAR') {
                $data['number'] = '9001';
        } else if ($data['type'] == 'RELEASING-SPECIAL') {
          $data['number'] = '0001';
        } else if ($data['type'] == 'REGULAR-TAX') {
          $data['number'] = '7001';
        }else if ($data['type'] == 'SPECIAL-TAX') {
          $data['number'] = '8001';
        } else {
          $data['number'] = '0001';
        }
        // $data['number'] = ($data['type'] == 'REGULAR') ? '1001' : '2001';
      }

      // echo "string: ".$data['number'];
      // die();

      if ($data['type'] == 'RELEASING-REGULAR' || $data['type'] == 'RELEASING-SPECIAL') {
        $data['status'] = 'RELEASING';
      } else {
        $data['status'] = ($this->input->get('ifpayment') == 'YES') ? 'FINISHED' : 'NA';
      }
      $data['ifpayment'] = ($this->input->get('ifpayment') == 'YES') ? 'YES' : 'NO';

      if ($data['type'] == 'REGULAR') {
        $apptpye = '(1) Regular - Assessment';
      } else if ($data['type'] == 'SPECIAL') {
        $apptpye = '(2) Special - Assessment';
      } else if ($data['type'] == 'REGULAR5-10') {
        $apptpye = '(3) Regular - Payment Only';
      } else if ($data['type'] == 'SPECIAL5-10') {
        $apptpye = '(4) Special - Payment Only';
      // } else if ($data['type'] == 'PAYMENT-ONLY') {
      //   $apptpye = '(5) PAYMENT ONLY';

      } else if ($data['type'] == 'PREGULAR') {
        $apptpye = '(REGULAR) 1 - 4 Application';

      } else if ($data['type'] == 'PSPECIAL') {
        $apptpye = '(SPECIAL) 5 -10 Application';
      } else if ($data['type'] == 'PREGULAR5-10') {
        $apptpye = '(REGULAR) 5 - 10 Application';
      } else if ($data['type'] == 'PSPECIAL5-10') {
        $apptpye = '(SPECIAL) 5 - 10 Application';
      } else if ($data['type'] == 'PAYMENT-ONLY') {
        $apptpye = '(9) PAYMENT ONLY';
      } else if ($data['type'] == 'REGULAR-TAX') {
        $apptpye = '(REGULAR) Tax Bill / Closure Only / Temporary';
      } else if ($data['type'] == 'SPECIAL-TAX') {
        $apptpye = '(SPECIAL) PWDs, Senior, Pregnant';
     } else if ($data['type'] == 'RELEASING-REGULAR') {
        $apptpye = '(REGULAR) Releasing';
      } else if ($data['type'] == 'RELEASING-SPECIAL') {
        $apptpye = '(SPECIAL) Releasing';
      } else {
        $apptpye = '';
      }

      //save
      if($this->mdl_number->m_ajax_save($data)) {
        $result = array(
                        'status' => true ,
                        'content'=> $data['number'],
                        'date'=> date("m/d/Y"),
                        'time'=> date("h:i a"),
                        'apptpye' => $apptpye
                      );


          // file_put_contents(basename('/_servepayment.txt'),file_get_contents(base_url().'transaction/ajax_get_serve_payment'));
          file_put_contents(basename('/_serve.txt'),file_get_contents(base_url().'transaction/ajax_get_serve'));
        //  file_put_contents(basename('/_servereleasing.txt'),file_get_contents(base_url().'transaction/ajax_get_serve_releasing'));


      } else {
        $result = array('status' => false ,'content'=> 'Failed');
      }
      echo json_encode($result);
    }

}