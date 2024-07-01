<?php

class Maildetail_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

  var $table_inmail = "inmail";
	var $table_outmail = "outmail";

	// =========================================================================================================== INCOMING MAIL ====================================================================

  public function get_viewinmail($id) {
    $this->db->join("indeks", "indeks.IndeksID = inmail.IndeksID");
		$this->db->join("workunit", "workunit.WorkunitID = inmail.WorkunitID");

    $this->db->where('InMailID', $id);
    $query = $this->db->get($this->table_inmail);
    return $query->row();
  }

	public function get_viewinmailregister($id) {
		$this->db->join('accountinfo', 'accountinfo.Username = inmail.Username');
		$this->db->join("workunit", "workunit.WorkunitID = accountinfo.WorkunitID");
		$this->db->join('accountuser', 'accountuser.Username = accountinfo.Username');
		$this->db->join('rolemaster', 'rolemaster.RoleID = accountuser.RoleID');

		$this->db->where('InMailID', $id);
		$query = $this->db->get($this->table_inmail);
		return $query->row();
	}

	public function get_datadisposition($id) {
		$this->db->join("accountinfo", "accountinfo.Username = disposition.Username");
		$this->db->join("workunit", "workunit.WorkunitID = accountinfo.WorkunitID");
		$this->db->join("accountuser", "accountuser.Username = accountinfo.Username");
		$this->db->join("rolemaster", "rolemaster.RoleID = accountuser.RoleID");

		$this->db->order_by('DispositionID', 'ASC');
		$this->db->where('disposition.InMailID', $id);
		$query = $this->db->get('disposition');
		return $query;
	}

	public function get_datadispoted($id) {
		$this->db->join('accountinfo', 'accountinfo.Username = dispoted.Username');
		$this->db->where('DispositionID', $id);
		$query = $this->db->get('dispoted');
		return $query->row();
	}

	public function get_userdisposition($id) {
		$this->db->join("dispoted", "dispoted.DispositionID = disposition.DispositionID");
		$this->db->join("accountinfo", "accountinfo.Username = dispoted.Username");

		$this->db->where('InMailID', $id);
		$this->db->where('disposition.Username', $this->session->userdata('Username'));
		$query = $this->db->get('disposition');
		return $query->row();
	}

	public function get_viewinmailsignature($id) {
		$this->db->where('InMailID', $id);
		$this->db->where('disposition.Username', $this->session->userdata('Username'));
		$query = $this->db->get('disposition');
		return $query->row();
	}

	public function get_viewinmailattachment($id) {
		$this->db->order_by('AttachmentID', 'ASC');
		$this->db->where('InMailID', $id);
		$query = $this->db->get('inmailattachment');
		return $query->result();
	}

	public function check_duplicatename($id, $name) {
		$this->db->where('InMailID', $id);
		$this->db->where('AttachmentName', $name);
		$query = $this->db->get('inmailattachment');
		return $query->num_rows();
	}

	public function add_inmailattachment($data) {
		$this->db->insert('inmailattachment', $data);
		$insert_id = $this->db->insert_id();
	  return  $insert_id;
	}

	public function delete_inmailattachment($id){
		$this->db->where('AttachmentID', $id);
		$this->db->delete('inmailattachment');
	}

	public function get_viewinmailcommentar($id) {
		$this->db->join("inmail", "inmail.InMailID = inmailcommentar.InMailID");
		$this->db->join("accountinfo", "accountinfo.Username = inmailcommentar.Username");
		$this->db->join("workunit", "workunit.WorkunitID = accountinfo.WorkunitID");
		$this->db->join("accountuser", "accountuser.Username = accountinfo.Username");
		$this->db->join("rolemaster", "accountuser.RoleID = rolemaster.RoleID");

		$this->db->order_by('CommentarID', 'ASC');
		$this->db->where('inmailcommentar.InMailID', $id);
		$query = $this->db->get('inmailcommentar');
		return $query->result();
	}

	public function add_inmailcommentar($data) {
		return $this->db->insert('inmailcommentar', $data);
	}

	public function delete_inmailcommentar($id){
		$this->db->where('CommentarID', $id);
		$this->db->delete('inmailcommentar');
	}

	// ======================================================================================================== OUTGOING MAIL =================================================================

	public function get_viewoutmail($id) {
		$this->db->join("indeks", "indeks.IndeksID = outmail.IndeksID");
		$this->db->join("accountinfo", "accountinfo.Username = outmail.Username");
		$this->db->join("workunit", "workunit.WorkunitID = accountinfo.WorkunitID");
		$this->db->join("accountuser", "accountuser.Username = accountinfo.Username");
		$this->db->join("rolemaster", "accountuser.RoleID = rolemaster.RoleID");

		$this->db->where('OutMailID', $id);
		$query = $this->db->get($this->table_outmail);
		return $query->row();
	}

	public function get_viewoutmailregister($id) {
		$this->db->join('accountinfo', 'accountinfo.Username = outmail.Username');
		$this->db->join("workunit", "workunit.WorkunitID = accountinfo.WorkunitID");
		$this->db->join('accountuser', 'accountuser.Username = accountinfo.Username');
		$this->db->join('rolemaster', 'rolemaster.RoleID = accountuser.RoleID');

		$this->db->where('OutMailID', $id);
		$query = $this->db->get($this->table_outmail);
		return $query->row();
	}

	public function get_viewoutmailattachment($id) {
		$this->db->order_by('AttachmentID', 'ASC');
		$this->db->where('OutMailID', $id);
		$query = $this->db->get('outmailattachment');
		return $query->result();
	}

	public function add_outmailattachment($data) {
		return $this->db->insert('outmailattachment', $data);
	}

	public function delete_outmailattachment($id){
		$this->db->where('AttachmentID', $id);
		$this->db->delete('outmailattachment');
	}

}
