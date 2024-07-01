<?php

class Incomingmail_model extends CI_Model {
	function __construct() {
		parent::__construct();
  }

	function get_dataoptionindeks() {
		$query = $this->db->get('indeks');
		return $query->result_array();
	}

	function get_dataoptionworkunit() {
		$query = $this->db->get('workunit');
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
     if(isset($_POST["search"]["value"])) {
					$this->db->like("InMailOrigin", $_POST["search"]["value"]);
					$this->db->or_like("InMailNumber", $_POST["search"]["value"]);
					$this->db->or_like("WorkunitName", $_POST["search"]["value"]);
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

	public function add_inmail($data) {
  	$this->db->insert($this->table, $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
  }

	public function edit_inmail($data, $id) {
		$this->db->where('InMailID', $id);
		return $this->db->update($this->table, $data);
	}

	public function forwarded_inmail($data, $id) {
		$this->db->where('InMailID', $id);
		return $this->db->update($this->table, $data);
	}

	public function delete_inmail($id){
		$this->db->where('InMailID', $id);
		$this->db->delete($this->table);
	}

}
