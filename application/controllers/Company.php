<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller{
	function __construct(){
		parent::__construct();
    error_reporting(0);
    $this->load->model('Companydata_model');
		$this->load->model('Userdata_model');
		is_logged_in();
	}

	public function index(){
		$data = [
			'title' => 'SIPAS - '.$this->db->get_where('companysetting', ['CompanyID' => 1])->row()->CompanyName,
			'userdata' => $this->Userdata_model->get_userdata($this->session->userdata('Username')),
		];

		$this->load->view('back-end/template/header', $data);
		$this->load->view('back-end/template/sidebar');
		$this->load->view('back-end/company');
		$this->load->view('back-end/template/footer');
	}

	public function uploadImage($input_field_name, $id, $column) {
		$config['upload_path'] = './uploads/app/logo/';
		$config['allowed_types'] = 'png|jpg|jpeg';
		$config['overwrite'] = TRUE;
		$config['file_name'] = random_string('alnum', 50);
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ( !$this->upload->do_upload($input_field_name, $id, $column)){
				$error = array('error' => $this->upload->display_errors());
		}else{
				$data = $this->upload->data();

				$this->Companydata_model->upload_imglogo($id, $column, $data['file_name']);

				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './uploads/app/logo/'.$data['file_name'];
				$config['create_thumb']= FALSE;
				$config['maintain_ratio']= TRUE;
				$config['quality']= '80%';
				$config['new_image']= './uploads/app/logo/'.$data['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
		}
	}

	function get_viewcompany(){
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Companydata_model->get_viewcompany());
	}

	function get_viewapp(){
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Companydata_model->get_viewapp());
	}

	function edit_company(){
		$data = array(
			'CompanyName' => $this->input->post('input-CompanyName'),
			'CompanyEmail' => strtolower($this->input->post('input-CompanyEmail')),
			'CompanyType' => ucwords($this->input->post('input-CompanyType')),
			'CompanyAddress' => $this->input->post('input-CompanyAddress'),
			'CompanyVillage' => ucwords($this->input->post('input-CompanyVillage')),
			'CompanySubDistrict' => ucwords($this->input->post('input-CompanySubDistrict')),
			'CompanyDistrict' => ucwords($this->input->post('input-CompanyDistrict')),
			'CompanyState' => ucwords($this->input->post('input-CompanyState')),
			'CompanyZIPCode' => (!empty($this->input->post('input-CompanyZIPCode'))) ? $this->input->post('input-CompanyZIPCode') : NULL,
			'CompanyPhone' => $this->input->post('input-CompanyPhone'),
		);

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Companydata_model->edit_company($data));
	}

	function edit_logo($column) {
		if (!empty($_FILES['file-input-Logo']['name'])) {
			$filehas = $this->db->get_where('appsetting', ['AppID' => 1])->row()->$column;
			unlink('./uploads/app/logo/'.$filehas);
			$img_upload = $this->uploadImage('file-input-Logo', '1', $column);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($img_upload);
		}
	}

}

?>
