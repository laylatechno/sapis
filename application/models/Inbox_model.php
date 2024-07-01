<?php

class Inbox_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	public function check_access($id) {
		$this->db->where('Username', $this->session->userdata('Username'));
		$this->db->where('InMailID', $id);
		$query = $this->db->get('disposition');
		return $query->num_rows();
	}

	public function get_datadisposition($page, $username) {
    $offset = 5*$page;
		$limit = 5;

		$this->db->join('inmail', 'inmail.InMailID = disposition.InMailID');
    $this->db->join('indeks', 'indeks.IndeksID = inmail.IndeksID');

		$this->db->order_by('DispositionID', 'DESC');
		$this->db->where('disposition.Username', $username);
    $this->db->limit($limit, $offset);
		$query = $this->db->get('disposition');
		return $query->result();
	}

  public function search_datadisposition($keyword){
    $this->db->like('InMailOrigin', $keyword);

    $this->db->join('inmail', 'inmail.InMailID = disposition.InMailID');
    $this->db->join('indeks', 'indeks.IndeksID = inmail.IndeksID');

    $this->db->where('disposition.Username', $this->session->userdata('Username'));
    $query = $this->db->get('disposition');
    return $query->result();
  }

  public function count_inmaildeadline() {
    $this->db->where('Username', $this->session->userdata('Username'));
    $this->db->where('DispositionDeadline <=', date("Y-m-d"));
    $this->db->where('DispositionStatus', "unread");
    $query = $this->db->get('disposition');
    return $query->num_rows();
  }

	public function get_filehasdisposition($id, $username) {
		$this->db->where('InMailID', $id);
		$this->db->where('Username', $username);
		$query = $this->db->get('disposition');
		return $query->row_array();
	}

}
