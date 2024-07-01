<?php

class Indeks_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	var $table = "indeks";
  var $select_column = array("IndeksID", "IndeksName", "IndeksCode", "IndeksDesc");
  var $order_column = array(null, "IndeksName", "IndeksCode", "IndeksDesc");

  function query_dataindeks() {
       $this->db->select($this->select_column);
       $this->db->from($this->table);
       if(isset($_POST["search"]["value"])) {
            $this->db->like("IndeksName", $_POST["search"]["value"]);
       }
       if(isset($_POST["order"])) {
          $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
       } else {
          $this->db->order_by('IndeksID', 'DESC');
       }
  }

  function get_dataindeks(){
       $this->query_dataindeks();
       if($_POST["length"] != -1){
          $this->db->limit($_POST['length'], $_POST['start']);
       }
       $query = $this->db->get();
       return $query->result();
  }

  function get_filtered_dataindeks(){
       $this->query_dataindeks();
       $query = $this->db->get();
       return $query->num_rows();
  }

  function get_all_dataindeks(){
       $this->db->select("*");
       $this->db->from($this->table);
       return $this->db->count_all_results();
  }

	public function get_viewindeks($id) {
		$this->db->where('IndeksID', $id);
		$query = $this->db->get($this->table);
		return $query->row();
	}

	public function check_duplicateid($id) {
		$this->db->where('IndeksCode', $id);
		$query = $this->db->get($this->table);
		return $query->num_rows();
	}

	public function add_indeks($data) {
    return $this->db->insert($this->table, $data);
  }

	public function edit_indeks($data, $id) {
    $this->db->where('IndeksID', $id);
    return $this->db->update($this->table, $data);
  }

	public function delete_indeks($id){
		$this->db->where('IndeksID', $id);
		$this->db->delete($this->table);
	}

}
