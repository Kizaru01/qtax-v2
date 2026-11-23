<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viewing extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_viewing');
    }

    //LOGIN
    public function index()
    {
        file_put_contents(basename('/_getviewing.txt'),file_get_contents(base_url().'viewing/ajax_get_viewing'));
        $data['title'] = 'Viewing';
        $this->load->view('v_viewing', $data);
        // file_put_contents(basename('/_getviewing.txt'),file_get_contents(base_url().'viewing/ajax_get_viewing'));
        // file_put_contents(basename('/_getwaiting.txt'),file_get_contents(base_url().'viewing/ajax_get_waiting'));
    }

    public function ajax_get_viewing() {
      $serving_payment = $this->mdl_viewing->m_ajax_get_serving_payment();
      $serving = $this->mdl_viewing->m_ajax_get_serving();
      // if ($serving = $this->mdl_viewing->m_ajax_get_serving()) {
        $result = array(
          'status' => 'yes',
          'serving'=> $serving,
          // 'serving_payment'=> $serving_payment,
        );
      // } else {
        // $result = array(
        //   'status' => 'no',
        //   'serving'=> false,
        //   'serving_payment'=> false,

        // );
      // }
      echo json_encode($result);
    }

    public function ajax_get_waiting() {
      $waiting1to6 = $this->mdl_viewing->m_ajax_get_waiting1to6();
      $pending1to6 = $this->mdl_viewing->m_ajax_get_pending1to6();

      $result = array(
        'status' => 'yes',
        'waiting1to6'=> $waiting1to6,
        'pending1to6'=> $pending1to6
      );
      echo json_encode($result);
    }

    public function ajax_get_file() {
      $directory = "movies/";
      $pdffiles = glob($directory . "*.*");

      if ($pdffiles) {
        $files = array();
        foreach($pdffiles as $pdffile)
        {
           $files[] = base_url().'movies/'.basename($pdffile);
        }
        // echo json_encode($files);

        $result = array('status' => 'yes','content'=> $files);

      } else {
        $result = array('status' => 'no','content'=> false);
      }
      echo json_encode($result);

    }

}