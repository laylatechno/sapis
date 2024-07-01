<?php

class Report_model extends CI_Model {
	function __construct() {
		parent::__construct();
  }

	function get_dataoptionworkunit() {
		$query = $this->db->get('workunit');
		return $query->result_array();
	}

  // ============================================================================================== INBOX ==================================================================================================

  function report_inmail($startdate, $enddate, $workunit) {
    $this->db->join("indeks", "indeks.IndeksID = inmail.IndeksID");
		$this->db->join("workunit", "workunit.WorkunitID = inmail.WorkunitID");

    $this->db->where('InMailDate >=', $startdate);
    $this->db->where('InMailDate <=', $enddate);
		if (!$workunit) {
			// code...
		} else {
			$this->db->where('inmail.WorkunitID', $workunit);
		}

    $query = $this->db->get('inmail');
    return $query->result();
  }

	// ============================================================================================== OUTBOX ==================================================================================================

	function report_outmail($startdate, $enddate, $workunit) {
		$this->db->join("indeks", "indeks.IndeksID = outmail.IndeksID");
		$this->db->join("workunit", "workunit.WorkunitID = outmail.WorkunitID");

		$this->db->where('OutMailDate >=', $startdate);
		$this->db->where('OutMailDate <=', $enddate);
		if (!$workunit) {
			// code...
		} else {
			$this->db->where('outmail.WorkunitID', $workunit);
		}

		$query = $this->db->get('outmail');
		return $query->result();
	}

}
