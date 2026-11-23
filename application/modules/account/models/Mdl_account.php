<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_account extends CI_Model
{
	//LOGIN/CHECK LOGIN CREDENTIALS
    public function m_ajax_signin($data)
    {
        $datelogin = date("Y-m-d G:i:s", time());
        $sql = "SELECT
                  `a_id`,
                  `a_username`,
                  `a_password`,
                  `a_profile`,
                  `a_office`,
                  `a_window`,
                  `a_type`,
                  CONCAT(IFNULL(`a_fname`,''),' ',IFNULL(`a_lname`,'')) AS `a_name`
                FROM
                  `tbl_account`
                WHERE `a_isactive` = 'yes' AND `a_username` = ? AND `a_password` = ?
                LIMIT 1";
        $attr = array($data['a_username'], sha1(md5($data['a_password'] . 'c[x]t!@n[*]{7hndv}')));
        $query = $this->db->query($sql, $attr);

        if ($query->num_rows() > 0) {
            foreach($query->result() as $r) {
                $a_id = $r->a_id;
            }
            $sql2 = "UPDATE `tbl_account` SET `a_login` = ? WHERE `a_id` = ?";
            $param2= array($datelogin,$a_id);
            $this->db->query($sql2,$param2);
            return $query->result();
        } else {
            return false;
        }
    }

	public function m_ajax_signout()
    {
        $datelogout = date("Y-m-d G:i:s", time());
        $sql = "UPDATE `tbl_account` SET `a_logout` = ? WHERE `a_id` = ?";
        $param= array($datelogout,$this->session->userdata('accountId'));
        if($this->db->query($sql,$param)) {
            $this->session->sess_destroy();
            return true;
        } else {
            return false;
        }
    }

    public function m_ajax_update_password($a_id,$password)
    {
        $newpass = sha1(md5($password.'c[x]t!@n[*]{7hndv}'));
        $this->session->set_userdata('password', $newpass);
        $sql ="UPDATE `tbl_account` SET `a_password` = '$newpass' WHERE `a_id` = '$a_id' ";
        if($this->db->query($sql)){
            return true;
        } else {
            return false;
        }
    }

    public function m_ajax_save_userdetails($data1) {
  		$id = $data1['a_id'];
  		unset($data1['a_id']);
  		$this->db->where('a_id', $id);
  		if($this->db->update('tbl_account',$data1)) {
  			return TRUE;
  		} else {
  			return FALSE;
  		}
  	}

    public function m_ajax_datelatest() {
      // $sql = "SELECT
  		// 				`rdate`,
      //         (SELECT
      //     						`rdate`
      //     					FROM
      //     						`tbl_reset`
      //     					LIMIT 1) AS `tdate`
  		// 			FROM
  		// 				`tbl_reset`
  		// 			LIMIT 1";

      $sql = "SELECT
  						UNIX_TIMESTAMP(`rdate`) AS `rdate`,
              (SELECT
          						UNIX_TIMESTAMP(DATE_FORMAT(`dtupdated`,'%Y-%m-%d')) AS `tdate`
          					FROM
          						`tbl_transaction`
          						ORDER BY `dtupdated` DESC
          					LIMIT 1) AS `tdate`
  					FROM
  						`tbl_reset`
  					LIMIT 1";

  		$query = $this->db->query($sql);
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return false;
      }
  	}

    public function m_ifonline() {
  		$sql = 'SELECT `a_id` AS `id`
  				FROM
  				  `tbl_account`
  				WHERE `a_id` = "1"
  				';
  		$query = $this->db->query($sql);
  		if($query->num_rows() > 0)
  		{
  			return $query->result();
  		} else {
  			return false;
  		}
  	}

    public function m_creset() {
  		$sql = "SELECT
                (UNIX_TIMESTAMP(DATE_FORMAT(`r`.`dtupdated`,'%Y-%m-%d')) <
                UNIX_TIMESTAMP(DATE_FORMAT(NOW(),'%Y-%m-%d')))AS `status`,
                DATE_FORMAT(`r`.`dtupdated`, '%l:%i%p %b %e, %Y') AS `dtupdated`
    					FROM
    						`tbl_reset` `r`
    					LIMIT 1";

  		$query = $this->db->query($sql);
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return false;
      }
  	}

}
