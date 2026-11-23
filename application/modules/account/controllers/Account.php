<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_account');
    }

    //LOGIN
    public function index()
    {
        // if (substr($_SERVER['HTTP_HOST'], 0, 4) === 'www.') {
        //     header('Location: http'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 's':'').'://' . substr($_SERVER['HTTP_HOST'], 4).$_SERVER['REQUEST_URI']);
        //     exit;
        // }

        if (!$this->session->userdata('accountId')) {
            $data['title'] = 'Login';
            $this->load->view('v_login', $data);
        } else {
            redirect('transaction');
        }
    }

	//AJAX LOGIN
    public function ajax_signin()
    {
    $url = '';
		if ($this->input->post('isLogin') == 1) {
			$data['a_username'] = $this->input->post('a_username');
			$data['a_password'] = $this->input->post('a_password');

			if ($user = $this->mdl_account->m_ajax_signin($data)) {

				foreach ($user as $u) {
					$this->session->set_userdata('accountId', $u->a_id);
					$this->session->set_userdata('username', $u->a_username);
					$this->session->set_userdata('a_name', $u->a_name);
          $this->session->set_userdata('profile', $u->a_profile);
          $this->session->set_userdata('window', $u->a_window);
          $this->session->set_userdata('office', $u->a_office);
					$this->session->set_userdata('a_type', $u->a_type);
					// $this->session->set_userdata('system', $u->a_system);
				}

  
// echo "test -".$this->session->userdata('a_type').'-';
        // if ($data = $this->mdl_account->m_creset()) {
        //   $status = '';
        //   foreach ($data as $u) {
  			// 		$status = $u->status;
  			// 	}
        // }


        // $datelatest =  $this->mdl_account->m_ajax_datelatest();
        // foreach ($datelatest as $u1) {
				// 	$this->session->set_userdata('rdate', $u1->rdate);
				// 	$this->session->set_userdata('tdate', $u1->tdate);
				// }

        // echo $this->session->userdata('rdate').' - '.$this->session->userdata('tdate');
        // die();

        /**
         * Get user details
         * @type {[type]}
         */
          $ip = $_SERVER['SERVER_ADDR'];
          if (PHP_OS == 'WINNT'){
            $ip = getHostByName(getHostName());
          }
          if (PHP_OS == 'Linux'){
            $command="/sbin/ifconfig";
            exec($command, $output);
            $pattern = '/inet addr:?([^ ]+)/';
            $ip = array();
            foreach ($output as $key => $subject) {
              $result = preg_match_all($pattern, $subject, $subpattern);
              if ($result == 1) {
                if ($subpattern[1][0] != "127.0.0.1")
                  $ip = $subpattern[1][0];
              }
            }
          }

          $pcname = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
          $pcname = $_SERVER['REMOTE_ADDR'];
          $pcname = gethostbyaddr($pcname);

          $data1['a_ip'] = $ip;
          $data1['a_macadd'] = explode("\\",exec('getmac'));
          $data1['a_macadd'] = preg_replace('/\s+/','',$data1['a_macadd'][0]);

          $data1['a_browser'] = $_SERVER ['HTTP_USER_AGENT'];
          $data1['a_pcname'] = $pcname;
          $data1['a_id'] = $this->session->userdata('accountId');

          $this->mdl_account->m_ajax_save_userdetails($data1);

				$result = array('status' => 'yes', 'content' => 'Successfully logged in! Redirecting...', 'url' => $url, 'type' => $this->session->userdata('a_type'));
				echo json_encode($result);
			} else {
				$result = array('status' => 'no', 'content' => 'Invalid Username and Password!');
				echo json_encode($result);
			}
		}
    }

	//LOGOUT/DESTROY ALL SESSIONS
    public function logout()
    {
  		if($this->mdl_account->m_ajax_signout()) {
  			redirect('account');
  		}
    }

    //CHANGE PASSWORD
    public function profile()
    {
        if ($this->session->userdata('accountId')) {
            $data['title'] = 'Profile';
            $data['content'] = 'account/v_profile';
            $this->load->view('layouts/v_master', $data);
        } else {
          redirect('account');
        }
    }

    //UPDATE PASSWORD
    public function update_password()
    {
      if ($this->session->userdata('accountId')) {
        $a_id = $this->session->userdata('accountId');
        if($this->input->post('password') == $this->input->post('password2')){
            if($this->mdl_account->m_ajax_update_password($a_id,$this->input->post('password'))){
                $result = array('status' => 'yes','content'=> 'Password Successfully Updated');
                echo json_encode($result);
                exit();
            } else {
                $result = array('status' => 'no','content'=> 'Password failed to updated');
                echo json_encode($result);
                exit();
            }
        } else {
            $result = array('status' => 'no','content'=> 'Password did not match');
            echo json_encode($result);
            exit();
        }
      } else {
        redirect('account');
      }
    }

    //CHECK DATABASE IF ONLINE/OFFLINE
    public function ifonline(){
        if($this->mdl_account->m_ifonline())
        {
            $result = array('status' => 'yes');
            echo json_encode($result);
        } else {
            $result = array('status' => 'no');
            echo json_encode($result);
        }
    }

    //CHECK IF RESET
    public function creset() {
      if ($data = $this->mdl_account->m_creset()) {
        file_put_contents(basename('/reset.txt'),time());
        echo json_encode($data);
      }
    }

}