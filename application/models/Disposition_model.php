<?php

class Disposition_model extends CI_Model {
	function __construct() {
		parent::__construct();
  }

	function get_dataoptionuser() {
		$this->db->join('accountinfo', 'accountinfo.Username = accountuser.Username');
		$this->db->join('workunit', 'workunit.WorkunitID = accountinfo.WorkunitID');

		$query = $this->db->get('accountuser');
		return $query->result_array();
	}

	var $table = "inmail";
	var $select_column = array("InMailID", "InMailOrigin", "InMailNumber", "InMailDate", "WorkunitName", "IndeksName", "InMailTrait", "InMailStatus", "FullName");
  var $order_column = array("InMailOrigin", "InMailNumber", "InMailDate", "WorkunitName", "IndeksName", "InMailTrait", "InMailStatus", "FullName");

  function query_datainmail() {
     $this->db->join("indeks", "indeks.IndeksID = inmail.IndeksID");
		 $this->db->join("workunit", "workunit.WorkunitID = inmail.WorkunitID");
		 $this->db->join("accountinfo", "accountinfo.Username = inmail.Username");

     $this->db->select($this->select_column);

     $this->db->from($this->table);
		 $this->db->where('InMailStatus >=', 1);
     if(isset($_POST["search"]["value"])) {
				 $this->db->like("WorkunitName", $_POST["search"]["value"]);
     }
     if(isset($_POST["order"])) {
        $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
     } else {
        $this->db->order_by('InMailID', 'DESC');
     }
  }

  function get_datainmail(){
       $this->query_datainmail();
       if($_POST["length"] != -1){
          $this->db->limit($_POST['length'], $_POST['start']);
       }
       $query = $this->db->get();
       return $query->result();
  }

  function get_filtered_datainmail(){
       $this->query_datainmail();
       $query = $this->db->get();
       return $query->num_rows();
  }

  function get_all_datainmail(){
       $this->db->select("*");
       $this->db->from($this->table);
       return $this->db->count_all_results();
  }

	function count_disposition($id) {
		$query = $this->db->get_where('disposition', ['InMailID' => $id])->num_rows();
		return $query;
	}

	public function get_viewdisposition($id) {
    $this->db->join("inmail", "inmail.InMailID = disposition.InMailID");
		$this->db->join("accountinfo", "accountinfo.Username = disposition.Username");
		$this->db->join("accountuser", "accountuser.Username = accountinfo.Username");
		$this->db->join("workunit", "workunit.WorkunitID = accountinfo.WorkunitID");
		$this->db->join("rolemaster", "rolemaster.RoleID = accountuser.RoleID");

    $this->db->where('disposition.InMailID', $id);
		$query = $this->db->get('disposition');
    return $query->result();
  }

	public function add_disposition($data1) {
		$this->db->insert('disposition', $data1);
		$insert_id = $this->db->insert_id();
	  return  $insert_id;
	}

	public function update_inmail($data2, $id) {
		$this->db->where('InMailID', $id);
		return $this->db->update('inmail', $data2);
	}

	public function add_dispoted($data3) {
		return $this->db->insert('dispoted', $data3);
	}

	public function delete_disposition($id){
		$this->db->where('DispositionID', $id);
		$this->db->delete('disposition');
	}

}
