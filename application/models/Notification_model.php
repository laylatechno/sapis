<?php

class Notification_model extends CI_Model {
	function __construct() {
		parent::__construct();
  }

  // ================================================================================================================= INBOX NOTIFYCATION

  public function count_inboxnotif() {
    $this->db->where('Username', $this->session->userdata('Username'));
    $this->db->where('DispositionStatus', 'unread');
    $query = $this->db->get('disposition');
    return $query->num_rows();
  }

  public function get_listnotif() {
    $this->db->join('inmail', 'inmail.InMailID = disposition.InMailID');
		$this->db->join('workunit', 'workunit.WorkunitID = inmail.WorkunitID');

    $this->db->where('disposition.Username', $this->session->userdata('Username'));
    $this->db->where('DispositionStatus', 'unread');
    $this->db->order_by('DispositionLog', 'DESC');
    $query = $this->db->get('disposition');
    return $query->result();
  }

  public function maskasread($data, $id) {
    $this->db->where('DispositionID', $id);
    return $this->db->update('disposition', $data);
  }

  // ================================================================================================================= DISPO NOTIFYCATION

  public function count_disponotif() {
    $this->db->where('InMailStatus', 1);
    $query = $this->db->get('inmail');
    return $query->num_rows();
  }

  public function get_listdispo() {
		$this->db->join('workunit', 'workunit.WorkunitID = inmail.WorkunitID');

    $this->db->where('InMailStatus', 1);
    $this->db->order_by('InMailLog', 'DESC');
    $query = $this->db->get('inmail');
    return $query->result();
  }

}
