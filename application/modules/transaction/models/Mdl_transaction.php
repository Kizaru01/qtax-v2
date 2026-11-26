<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_transaction extends CI_Model
{

  // public function m_save_transaction($data) {
	// 	if($this->db->insert('tbl_transaction',$data)) {
  //   	return TRUE;
	// 	} else {
	// 		return FALSE;
	// 	}
	// }

  public function m_save_transaction($data) {
		$id = $data['id'];
		unset($data['id']);
		$this->db->where('id', $id);
		if($this->db->update('tbl_transaction',$data)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

  public function m_ajax_get_serve($str) {
    $sql = 'SELECT
              `id`,
              `number`,
              IFNULL(`window`,"") AS `window`,
              (
            	CASE
            		WHEN `status` = "NA" THEN "serve"
            		WHEN `status` = "SERVING" THEN "serving"
            		WHEN `status` = "PENDING" THEN "pending"
            	END
            	) AS `remarks`
            FROM
              `tbl_transaction`
            WHERE
              DATE(`dtadded`) = CURDATE()
              AND (`status` = "NA" OR `status` = "SERVING" OR `status` = "PENDING")
              AND `type` = "'.$str.'"
              AND isactive = "yes"
            ORDER BY `dtorder`';

    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }

  public function m_ajax_get_serve_verification($str) {
    $sql = 'SELECT
              `id`,
              `number`,
              IFNULL(`window`,"") AS `window`,
              (
            	CASE
            		WHEN `status` = "VERIFY" THEN "serve"
            	END
            	) AS `remarks`
            FROM
              `tbl_transaction`
            WHERE
              DATE(`dtadded`) = CURDATE()
              AND `status` = "VERIFY"
              AND `type` = "'.$str.'"
              AND isactive = "yes"';

    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }

  public function m_ajax_get_serve5to10($str) {
    $sql = 'SELECT
              `id`,
              `number`,
              `ifpayment`,
              IFNULL(`window`,"") AS `window`,
              (
            	CASE
            		WHEN `status` = "FINISHED" THEN "serve"
            		WHEN `status` = "PAYMENT-SERVING" THEN "serving"
            		WHEN `status` = "PAYMENT-PENDING" THEN "pending"
            	END
            	) AS `remarks`
            FROM
              `tbl_transaction`
            WHERE
              DATE(`dtadded`) = CURDATE()
              AND (`status` = "FINISHED" OR `status` = "PAYMENT-SERVING" OR `status` = "PAYMENT-PENDING")
              AND `ifpayment` = "YES" ';

    if ($str == 'SPECIAL-TAX') {
      $sql .= ' AND (`type` = "'.$str.'" OR `type` = "SPECIAL5-10" OR `type` = "SPECIAL")';
    } else {
      $sql .= ' AND (`type` = "'.$str.'" OR `type` = "P'.$str.'")';
    }
             
    $sql .= ' AND isactive = "yes"
              ORDER BY `dtupdated` ASC';

    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }

  public function m_ajax_get_serve5to10_verify($str) {
    $sql = 'SELECT
              `id`,
              `number`,
              `ifpayment`,
              IFNULL(`window`,"") AS `window`,
              (
            	CASE
            		WHEN `status` = "FINISHED" THEN "serve"
            		WHEN `status` = "PAYMENT-SERVING" THEN "serving"
            		WHEN `status` = "PAYMENT-PENDING" THEN "pending"
            	END
            	) AS `remarks`
            FROM
              `tbl_transaction`
            WHERE
              DATE(`dtadded`) = CURDATE()
              AND (`status` = "FINISHED" OR `status` = "PAYMENT-SERVING" OR `status` = "PAYMENT-PENDING")
              AND `ifpayment` = "NO" ';

    // if ($str == 'SPECIAL-TAX') {
      $sql .= ' AND (`type` = "'.$str.'" OR `type` = "SPECIAL5-10" OR `type` = "REGULAR5-10" OR `type` = "SPECIAL")';
    // } else {
    //   $sql .= ' AND (`type` = "'.$str.'" OR `type` = "P'.$str.'")';
    // }
             
    $sql .= ' AND isactive = "yes"
              ORDER BY `dtupdated` ASC';

    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }

  public function m_ajax_get_serve_releasing($str) {
    $sql = 'SELECT
              `id`,
              `number`,
              `ifpayment`,
              IFNULL(`window`,"") AS `window`,
              (
            	CASE
            		WHEN `status` = "RELEASING" THEN "serve"
            		WHEN `status` = "PAYMENT-FINISHED" THEN "serve"
            		WHEN `status` = "RELEASING-SERVING" THEN "serving"
            		WHEN `status` = "RELEASING-PENDING" THEN "pending"
            	END
            	) AS `remarks`
            FROM
              `tbl_transaction`
            WHERE
              DATE(`dtadded`) = CURDATE()
              AND (`status` = "RELEASING" OR `status` = "PAYMENT-FINISHED" OR `status` = "RELEASING-SERVING" OR `status` = "RELEASING-PENDING")';

      // $sql .= ' AND `type` = "'.$str.'" ';

    if ($str == 'RELEASING-REGULAR') {
      $sql .= ' AND (`type` = "'.$str.'" OR `type` = "REGULAR" OR `type` = "PREGULAR" OR `type` = "PREGULAR5-10" OR `type`="REGULAR-TAX" OR `type`= "REGULAR5-10")';
    } else {
       $sql .= ' AND (`type` = "'.$str.'" OR `type` = "SPECIAL"  OR `type` = "SPECIAL-TAX")';
    }
             
    $sql .= ' AND isactive = "yes"
              ORDER BY `dtupdated` ASC';

    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }

  public function m_ajax_get_servev2($type) {
    $type = ($type == '') ? 'REGULAR' : $type;

    $sql = 'SELECT
              `id`,
              `number`,
              IFNULL(`window`,"") AS `window`,
              (
            	CASE
            		WHEN `status` = "NA" THEN "serve"
            		WHEN `status` = "SERVING" THEN "serving"
            		WHEN `status` = "PENDING" THEN "pending"
            	END
            	) AS `remarks`
            FROM
              `tbl_transaction`
            WHERE
              DATE(`dtadded`) = CURDATE()
              AND (`status` = "NA" OR `status` = "SERVING" OR `status` = "PENDING")
              AND isactive = "yes"
              ORDER BY
              	`type` = "'.$type.'" AND
              	`number`
              ';

    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }

}