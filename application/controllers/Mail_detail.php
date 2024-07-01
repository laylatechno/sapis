<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mail_detail extends CI_Controller {
	function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->model('Maildetail_model');
		$this->load->model('Users_model');
	}

	function index() {
		redirect(base_url('errorpage/not_found'));
	}

	public function uploadFile($input_field_name, $id, $directory, $allowedtype) {
		$config['upload_path'] = './uploads/'.$directory.'/'.$id;
		$config['allowed_types'] = $allowedtype;
		$config['overwrite'] = TRUE;
		$config['file_name'] = random_string('alnum', 20);
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload($input_field_name, $id, $directory)){
				$error = array('error' => $this->upload->display_errors());
		}else{
				$data = $this->upload->data();
        return $data;
		}
	}

	// ================================================================= USER INFO

	function get_viewuser($username){
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Users_model->get_viewuser($username)->row());
	}

	// ================================================================= MAIL INFO

	function get_viewinmail($id){
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Maildetail_model->get_viewinmail($id));
	}

	function get_viewinmailregister($id){
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Maildetail_model->get_viewinmailregister($id));
	}

	function count_datadisposition($id){
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Maildetail_model->get_datadisposition($id)->num_rows());
	}

	function get_datadisposition($id){
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Maildetail_model->get_datadisposition($id)->result());
	}

	function get_userdisposition($id){
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Maildetail_model->get_userdisposition($id));
	}

	function get_viewinmailsignature($id){
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Maildetail_model->get_viewinmailsignature($id));
	}

	// ================================================================= MAIL Attachment

	function count_viewinmailattachment($id){
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->db->get_where('inmailattachment', ['InMailID' => $id])->num_rows());
	}

	function get_viewinmailattachment($id){
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Maildetail_model->get_viewinmailattachment($id));
	}

	function check_duplicatename($id){
		$name = $_GET['name'];
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Maildetail_model->check_duplicatename($id, $name));
	}

	function add_inmailattachment($id){
    if (!empty($_FILES['file-input-Attachment']['name'])) {
      $file_upload = $this->uploadFile('file-input-Attachment', $id, 'file/incoming-mail', 'pdf|doc|docx|jpg|jpeg|png');
    }

		$data = array(
			'InMailID' 	=> $id,
			'AttachmentName' => ucwords($this->input->post('input-AttachmentName')),
			'AttachmentFile' => (!empty($_FILES['file-input-Attachment']['name'])) ? $file_upload['file_name'] : NULL,
		);

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Maildetail_model->add_inmailattachment($data));
	}

	function delete_inmailattachment($id){
		$filehas = $this->db->get_where('inmailattachment', ['AttachmentID' => $id])->row()->AttachmentFile;
		$idsurat = $this->db->get_where('inmailattachment', ['AttachmentID' => $id])->row()->InMailID;
		unlink('./uploads/file/incoming-mail/'.$idsurat.'/'.$filehas);
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Maildetail_model->delete_inmailattachment($id));
	}

	// ================================================================= MAIL COMMENTAR

	function count_viewinmailcommentar($id){
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->db->get_where('inmailcommentar', ['InMailID' => $id])->num_rows());
	}

	function get_viewinmailcommentar($id){
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Maildetail_model->get_viewinmailcommentar($id));
	}

	function add_inmailcommentar($id){
		$data = array(
			'InMailID' 	=> $id,
			'Username' => $this->session->userdata('Username'),
			'CommentarDesc' 	=> $this->input->post('input-CommentarDesc'),
		);

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Maildetail_model->add_inmailcommentar($data));
	}

	function delete_inmailcommentar($id){
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Maildetail_model->delete_inmailcommentar($id));
	}

}
