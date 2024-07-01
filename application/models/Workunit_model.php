<?php

class Workunit_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	var $table = "workunit";
  var $select_column = array("WorkunitID", "WorkunitName", "WorkunitCode", "WorkunitDesc");
  var $order_column = array(null, "WorkunitName", "WorkunitCode", "WorkunitDesc");

  function query_dataworkunit() {
    $this->db->select($this->select_column);
    $this->db->from($this->table);
    if(isset($_POST["search"]["value"])) {
        $this->db->like("WorkunitCode", $_POST["search"]["value"]);
        $this->db->or_like("WorkunitName", $_POST["search"]["value"]);
    }
    if(isset($_POST["order"])) {
      $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else {
      $this->db->order_by('WorkunitID', 'DESC');
    }
  }

  function get_dataworkunit(){
    $this->query_dataworkunit();
    if($_POST["length"] != -1){
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  function get_filtered_dataworkunit(){
    $this->query_dataworkunit();
    $query = $this->db->get();
    return $query->num_rows();
  }

  function get_all_dataworkunit(){
    $this->db->select("*");
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

	public function check_duplicateid($id) {
		$this->db->where('WorkunitCode', $id);
		$query = $this->db->get($this->table);
		return $query;
	}

	public function add_workunit($data) {
    $query = $this->db->insert($this->table, $data);
		return $query;
  }

	public function delete_workunit($id){
		$this->db->where('WorkunitID', $id);
		$query = $this->db->delete($this->table);
		return $query;
	}

}
