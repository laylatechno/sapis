<?php

class Dashboard_model extends CI_model {

	public function get_counter(){
		$offset = 0;
		$limit = 6;

		$this->db->join('accountinfo', 'accountinfo.Username = accountlogincounter.Username');
		$this->db->order_by('accountlogincounter.IndexID', 'DESC');
		$this->db->limit($limit, $offset);
		$query = $this->db->get('accountlogincounter');
		return $query->result();
	}

	public function get_datadisposition($username) {
		$this->db->join('inmail', 'inmail.InMailID = disposition.InMailID');
		$this->db->join('accountinfo', 'accountinfo.Username = inmail.Username');

		$this->db->order_by('DispositionID', 'DESC');
		$this->db->where('disposition.Username', $username);
		$this->db->where('DispositionStatus', 'unread');
		$query = $this->db->get('disposition');
		return $query->result();
	}

	// ========================================================================================== GRAPHIC SURAT MASUK =========================================================================

	public function get_allyear() {
		$query = $this->db->query('select year(InMailDate) as year from inmail group by year(InMailDate)');
    return $query->result();
	}

	function graph_inmail_jan($year) {
		$this->db->where('MONTH(InMailDate)', 1);
		$this->db->where('YEAR(InMailDate)', $year);
		$query = $this->db->get('inmail');
		return $query->num_rows();
	}
	function graph_inmail_feb($year) {
		$this->db->where('MONTH(InMailDate)', 2);
		$this->db->where('YEAR(InMailDate)', $year);
		$query = $this->db->get('inmail');
		return $query->num_rows();
	}
	function graph_inmail_mar($year) {
		$this->db->where('MONTH(InMailDate)', 3);
		$this->db->where('YEAR(InMailDate)', $year);
		$query = $this->db->get('inmail');
		return $query->num_rows($year);
	}
	function graph_inmail_apr($year) {
		$this->db->where('MONTH(InMailDate)', 4);
		$this->db->where('YEAR(InMailDate)', $year);
		$query = $this->db->get('inmail');
		return $query->num_rows();
	}
	function graph_inmail_may($year) {
		$this->db->where('MONTH(InMailDate)', 5);
		$this->db->where('YEAR(InMailDate)', $year);
		$query = $this->db->get('inmail');
		return $query->num_rows();
	}
	function graph_inmail_jun($year) {
		$this->db->where('MONTH(InMailDate)', 6);
		$this->db->where('YEAR(InMailDate)', $year);
		$query = $this->db->get('inmail');
		return $query->num_rows();
	}
	function graph_inmail_jul($year) {
		$this->db->where('MONTH(InMailDate)', 7);
		$this->db->where('YEAR(InMailDate)', $year);
		$query = $this->db->get('inmail');
		return $query->num_rows($year);
	}
	function graph_inmail_aug($year) {
		$this->db->where('MONTH(InMailDate)', 8);
		$this->db->where('YEAR(InMailDate)', $year);
		$query = $this->db->get('inmail');
		return $query->num_rows($year);
	}
	function graph_inmail_sep($year) {
		$this->db->where('MONTH(InMailDate)', 9);
		$this->db->where('YEAR(InMailDate)', $year);
		$query = $this->db->get('inmail');
		return $query->num_rows($year);
	}
	function graph_inmail_oct($year) {
		$this->db->where('MONTH(InMailDate)', 10);
		$this->db->where('YEAR(InMailDate)', $year);
		$query = $this->db->get('inmail');
		return $query->num_rows($year);
	}
	function graph_inmail_nov($year) {
		$this->db->where('MONTH(InMailDate)', 11);
		$this->db->where('YEAR(InMailDate)', $year);
		$query = $this->db->get('inmail');
		return $query->num_rows();
	}
	function graph_inmail_dec($year) {
		$this->db->where('MONTH(InMailDate)', 12);
		$this->db->where('YEAR(InMailDate)', $year);
		$query = $this->db->get('inmail');
		return $query->num_rows();
	}

	// ========================================================================================== GRAPHIC SURAT KELUAR =========================================================================

	function graph_outmail_jan($year) {
		$this->db->where('MONTH(OutMailDate)', 1);
		$this->db->where('YEAR(OutMailDate)', $year);
		$query = $this->db->get('outmail');
		return $query->num_rows();
	}
	function graph_outmail_feb($year) {
		$this->db->where('MONTH(OutMailDate)', 2);
		$this->db->where('YEAR(OutMailDate)', $year);
		$query = $this->db->get('outmail');
		return $query->num_rows();
	}
	function graph_outmail_mar($year) {
		$this->db->where('MONTH(OutMailDate)', 3);
		$this->db->where('YEAR(OutMailDate)', $year);
		$query = $this->db->get('outmail');
		return $query->num_rows();
	}
	function graph_outmail_apr($year) {
		$this->db->where('MONTH(OutMailDate)', 4);
		$this->db->where('YEAR(OutMailDate)', $year);
		$query = $this->db->get('outmail');
		return $query->num_rows($year);
	}
	function graph_outmail_may($year) {
		$this->db->where('MONTH(OutMailDate)', 5);
		$this->db->where('YEAR(OutMailDate)', $year);
		$query = $this->db->get('outmail');
		return $query->num_rows();
	}
	function graph_outmail_jun($year) {
		$this->db->where('MONTH(OutMailDate)', 6);
		$this->db->where('YEAR(OutMailDate)', $year);
		$query = $this->db->get('outmail');
		return $query->num_rows();
	}
	function graph_outmail_jul($year) {
		$this->db->where('MONTH(OutMailDate)', 7);
		$this->db->where('YEAR(OutMailDate)', $year);
		$query = $this->db->get('outmail');
		return $query->num_rows();
	}
	function graph_outmail_aug($year) {
		$this->db->where('MONTH(OutMailDate)', 8);
		$this->db->where('YEAR(OutMailDate)', $year);
		$query = $this->db->get('outmail');
		return $query->num_rows();
	}
	function graph_outmail_sep($year) {
		$this->db->where('MONTH(OutMailDate)', 9);
		$this->db->where('YEAR(OutMailDate)', $year);
		$query = $this->db->get('outmail');
		return $query->num_rows();
	}
	function graph_outmail_oct($year) {
		$this->db->where('MONTH(OutMailDate)', 10);
		$this->db->where('YEAR(OutMailDate)', $year);
		$query = $this->db->get('outmail');
		return $query->num_rows();
	}
	function graph_outmail_nov($year) {
		$this->db->where('MONTH(OutMailDate)', 11);
		$this->db->where('YEAR(OutMailDate)', $year);
		$query = $this->db->get('outmail');
		return $query->num_rows();
	}
	function graph_outmail_dec($year) {
		$this->db->where('MONTH(OutMailDate)', 12);
		$this->db->where('YEAR(OutMailDate)', $year);
		$query = $this->db->get('outmail');
		return $query->num_rows();
	}

}

?>
