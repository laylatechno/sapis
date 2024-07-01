<?php

class Outgoingmail_model extends CI_Model {
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

  var $table = "outmail";
  var $select_column = array("OutMailID", "OutMailDestination", "OutMailNumber", "IndeksName", "WorkunitName", "OutMailTrait", "OutMailDate", "FullName");
  var $order_column = array("OutMailDestination", "OutMailNumber", "IndeksName", "WorkunitName", "OutMailTrait", "OutMailDate", "FullName");

  function query_dataoutmail() {
     $this->db->join("indeks", "indeks.IndeksID = outmail.IndeksID");
		 $this->db->join("workunit", "workunit.WorkunitID = outmail.WorkunitID");
		 $this->db->join("accountinfo", "accountinfo.Username = outmail.Username");

     $this->db->select($this->select_column);
     $this->db->from($this->table);
     if(isset($_POST["search"]["value"])) {
			 $this->db->like("OutMailDestination", $_POST["search"]["value"]);
			 $this->db->or_like("OutMailNumber", $_POST["search"]["value"]);
			 $this->db->or_like("WorkunitName", $_POST["search"]["value"]);
     }
     if(isset($_POST["order"])) {
        $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
     } else {
        $this->db->order_by('OutMailID', 'DESC');
     }
  }

  function get_dataoutmail(){
       $this->query_dataoutmail();
       if($_POST["length"] != -1){
          $this->db->limit($_POST['length'], $_POST['start']);
       }
       $query = $this->db->get();
       return $query->result();
  }

  function get_filtered_dataoutmail(){
       $this->query_dataoutmail();
       $query = $this->db->get();
       return $query->num_rows();
  }

  function get_all_dataoutmail(){
       $this->db->select("*");
       $this->db->from($this->table);
       return $this->db->count_all_results();
  }

	public function check_duplicatename($id, $name) {
		$this->db->where('OutMailID', $id);
		$this->db->where('AttachmentName', $name);
		$query = $this->db->get('outmailattachment');
		return $query->num_rows();
	}

  public function add_outmail($data) {
    $this->db->insert($this->table, $data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }

  public function edit_outmail($data, $id) {
    $this->db->where('OutMailID', $id);
    return $this->db->update($this->table, $data);
  }

  public function delete_outmail($id){
    $this->db->where('OutMailID', $id);
    $this->db->delete($this->table);
  }

}
