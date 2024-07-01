<?php

class Userdata_model extends CI_model{

	function get_userdata($userid){
		$this->db->where('accountuser.Username', $userid);
		$this->db->join('accountinfo', 'accountinfo.Username = accountuser.Username');
		$this->db->join('rolemaster', 'rolemaster.RoleID = accountuser.RoleID');
		$this->db->join('workunit', 'workunit.WorkunitID = accountinfo.WorkunitID');
		$query = $this->db->get('accountuser');
		return $query->row_array();
	}

	function input_logincounter(){
		$data = array(
				'Username' => $this->session->userdata('Username'),
				'CounterBrowser' => $this->agent->browser(),
				'CounterOS' => $this->agent->platform(),
			);
		$query = $this->db->insert('accountlogincounter', $data);
		return $query;
	}

	function get_counter(){
		$this->db->join('accountinfo', 'accountinfo.Username = accountlogincounter.Username');
		$this->db->order_by('accountlogincounter.IndexID', 'DESC');
		$this->db->where('accountlogincounter.Username', $this->session->userdata('Username'));
		$query = $this->db->get('accountlogincounter');
		return $query->result();
	}

	function delete_loginhistory(){
		$this->db->where('Username', $this->session->userdata('Username'));
		$this->db->delete('accountlogincounter');
	}

}

?>
