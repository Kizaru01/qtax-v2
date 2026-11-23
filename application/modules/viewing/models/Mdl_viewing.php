<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_viewing extends CI_Model
{
  public function m_ajax_get_serving() {
		$sql = 'SELECT
            	`number`,
            	`window`,
              `ifpayment`,
              `type`,
              `status`
            FROM
            	`tbl_transaction`
            WHERE
              DATE(`dtadded`) = CURDATE()
            	AND (`status` = "SERVING" OR `status` = "VERIFY"
            	OR `status` = "RELEASING-SERVING" )
              AND isactive = "yes"';

		$query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
	}

  public function m_ajax_get_serving_payment() {
		$sql = 'SELECT
            	`number`,
            	`window`,
              `ifpayment`,
              `type`,
              `status`
            FROM
            	`tbl_transaction`
            WHERE
              DATE(`dtadded`) = CURDATE()
            	AND (`status` = "PAYMENT-SERVING")
              AND isactive = "yes"';

		$query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
	}

  public function m_ajax_get_waiting1to6() {
		$sql = 'SELECT
            	`number`,
            	`window`
            FROM
            	`tbl_transaction`
            WHERE
            	DATE(`dtadded`) = CURDATE()
            	AND `status` = "NA"
            	AND isactive = "yes"
            ORDER BY
            	`dtadded` ASC
            LIMIT 6';

		$query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
	}

  // public function m_ajax_get_waiting4to6() {
	// 	$sql = 'SELECT
  //           	`number`,
  //           	`window`
  //           FROM
  //           	`tbl_transaction`
  //           WHERE
  //           	DATE(`dtadded`) = CURDATE()
  //           	AND `status` = "NA"
  //           	AND isactive = "yes"
  //           ORDER BY
  //           	`dtadded` ASC
  //           LIMIT 3 OFFSET 3';
  //
	// 	$query = $this->db->query($sql);
  //   if ($query->num_rows() > 0) {
  //     return $query->result();
  //   } else {
  //     return false;
  //   }
	// }

  public function m_ajax_get_pending1to6() {
		$sql = 'SELECT
            	`number`,
            	`window`
            FROM
            	`tbl_transaction`
            WHERE
            	DATE(`dtadded`) = CURDATE()
            	AND `status` = "PENDING"
            	AND isactive = "yes"
            ORDER BY
            	`dtadded` ASC
            LIMIT 6';

		$query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
	}

  // public function m_ajax_get_pending4to6() {
	// 	$sql = 'SELECT
  //           	`number`,
  //           	`window`
  //           FROM
  //           	`tbl_transaction`
  //           WHERE
  //           	DATE(`dtadded`) = CURDATE()
  //           	AND `status` = "PENDING"
  //           	AND isactive = "yes"
  //           ORDER BY
  //           	`dtadded` ASC
  //           LIMIT 3 OFFSET 3';
  //
	// 	$query = $this->db->query($sql);
  //   if ($query->num_rows() > 0) {
  //     return $query->result();
  //   } else {
  //     return false;
  //   }
	// }

  public function m_ajax_get_pending() {
		$sql = 'SELECT
            	`number`,
            	`window`
            FROM
            	`tbl_transaction`
            WHERE
              DATE(`dtadded`) = CURDATE()
            	AND `status` = "PENDING"
              AND isactive = "yes"';

		$query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
	}

}