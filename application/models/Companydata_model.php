<?php

class Companydata_model extends CI_model{

	public function upload_imglogo($id, $column, $filename){
		$data = array(
					$column => $filename,
				);
		$this->db->where('AppID', $id);
		$query = $this->db->update('appsetting', $data);
		return $query;
	}

	public function get_companydata(){
		$this->db->where('CompanyID', '1');
		$query = $this->db->get('companysetting');
		return $query->row_array();
	}

	public function get_viewcompany(){
		$this->db->where('CompanyID', '1');
		$query = $this->db->get('companysetting');
		return $query->row();
	}

	public function get_viewapp(){
		$this->db->where('AppID', '1');
		$query = $this->db->get('appsetting');
		return $query->row();
	}

	public function edit_company($data) {
		$this->db->where('CompanyID', '1');
		return $this->db->update('companysetting', $data);
	}

}

?>
