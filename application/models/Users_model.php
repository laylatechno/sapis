<?php

class Users_model extends CI_Model {
	function __construct() {
		parent::__construct();
  }

	function uploadImage($username, $column, $filename){
		$data = array(
					$column => $filename,
				);
		$this->db->where('Username', $username);
		$query = $this->db->update('accountuser', $data);
		return $query;
	}

	// ============================================================================================ HAK AKSES

  public function get_dataaccess(){
    $this->db->order_by('RoleID', 'ASC');
    $query = $this->db->get('rolemaster');
    return $query->result();
  }

  public function get_viewaccess($id){
    $this->db->where('RoleID', $id);
    $query = $this->db->get('rolemaster');
    return $query->row();
  }

  public function edit_access($data, $id) {
    $this->db->where('RoleID', $id);
    return $this->db->update('rolemaster', $data);
  }

	// ============================================================================================ USERS

	var $table = "accountuser";

	function get_dataoptionworkunit() {
		$query = $this->db->get('workunit');
		return $query;
	}

  public function get_userlist($page){
    $offset = 8*$page;
    $limit = 8;

    $this->db->join('rolemaster', 'rolemaster.RoleID = accountuser.RoleID');
    $this->db->join('accountinfo', 'accountinfo.Username = accountuser.Username');
    $this->db->join('workunit', 'workunit.WorkunitID = accountinfo.WorkunitID');
    $this->db->order_by('accountuser.IndexID', 'DESC');
    $this->db->limit($limit, $offset);
    $query = $this->db->get('accountuser');
    return $query;
  }

  public function get_search($keyword){
    $this->db->like('accountuser.Username', $keyword);
    $this->db->or_like('FullName', $keyword);

    $this->db->join('accountinfo', 'accountinfo.Username = accountuser.Username');
    $this->db->join('rolemaster', 'rolemaster.RoleID = accountuser.RoleID');
    $this->db->join('workunit', 'workunit.WorkunitID = accountinfo.WorkunitID');
    $query = $this->db->get('accountuser');
    return $query;
  }

	public function get_viewuser($username) {
		$this->db->join('rolemaster', 'rolemaster.RoleID = accountuser.RoleID');
    $this->db->join('accountinfo', 'accountinfo.Username = accountuser.Username');
    $this->db->join('workunit', 'workunit.WorkunitID = accountinfo.WorkunitID');

		$this->db->where('accountuser.Username', $username);
		$query = $this->db->get($this->table);
		return $query;
	}

  public function check_duplicateid($username) {
    $this->db->join('accountinfo', 'accountinfo.Username = accountuser.Username');
    $this->db->where('accountuser.Username', $username);
    $query = $this->db->get($this->table);
    return $query;
  }

  public function add_user1($data1) {
    return $this->db->insert('accountuser', $data1);
  }

  public function add_user2($data2) {
    return $this->db->insert('accountinfo', $data2);
  }

  public function edit_user1($data1, $username) {
    $this->db->where('Username', $username);
    return $this->db->update('accountuser', $data1);
  }

  public function edit_user2($data2, $username) {
    $this->db->where('Username', $username);
    return $this->db->update('accountinfo', $data2);
  }

  public function delete_user($username){
    $this->db->where('Username', $username);
    $this->db->delete('accountuser');
  }

	public function delete_info($username){
		$this->db->where('Username', $username);
		$this->db->delete('accountinfo');
	}

	public function delete_imgcover($data, $username) {
    $this->db->where('Username', $username);
    return $this->db->update('accountuser', $data);
  }

	public function password_change($data, $username) {
	 $this->db->where('Username', $username);
	 return $this->db->update('accountuser', $data);
 }

}
