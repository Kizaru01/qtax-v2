<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_number extends CI_Model
{
  public function m_ajax_get_number($data) {

		$sql = 'SELECT DISTINCT
	               LPAD(SUBSTRING(`number`,-4) + 1,4,"0") AS `series`
					    FROM
					       `tbl_transaction`
					    WHERE
  						      DATE(`dtadded`) = CURDATE()
  						            AND `type_old` = "'.$data['type'].'"
  						                  AND `isactive` = "yes"
  						                        ORDER BY SUBSTRING(`number`,-3) DESC
  						                              LIMIT 1';

		$query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
	}

  public function m_ajax_save($data) {
		if($this->db->insert('tbl_transaction',$data)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}