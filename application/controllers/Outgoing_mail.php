<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Outgoing_mail extends CI_Controller {
	function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->model('Userdata_model');
		$this->load->model('Outgoingmail_model');
		$this->load->model('Maildetail_model');
		is_logged_in();
	}

	function index() {
		$data = [
				'title' => 'SIPAS - '.$this->db->get_where('companysetting', ['CompanyID' => 1])->row()->CompanyName,
				'userdata' => $this->Userdata_model->get_userdata($this->session->userdata('Username')),
		];

    $this->load->view('back-end/template/header', $data);
    $this->load->view('back-end/template/sidebar');
    $this->load->view('back-end/register/outgoing-mail');
    $this->load->view('back-end/template/footer');
	}

	function detail($id) {
		$query = $this->Maildetail_model->get_viewoutmail($id);

		if ($query->OutMailTrait == 'Rahasia' && $query->Username != $this->session->userdata('Username')) {
			redirect(base_url('errorpage/not_acceptable'));
		} else {
			$data = [
					'title' => 'SIPAS - '.$this->db->get_where('companysetting', ['CompanyID' => 1])->row()->CompanyName,
					'userdata' => $this->Userdata_model->get_userdata($this->session->userdata('Username')),
			];

			$this->load->view('back-end/template/header', $data);
			$this->load->view('back-end/template/sidebar');
			$this->load->view('back-end/register/outbox-detail');
			$this->load->view('back-end/template/footer');
		}
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

  // ============================================================================================================= OUTGOING MAIL

  function get_dataoutmail(){
     $dataoutmail = $this->Outgoingmail_model->get_dataoutmail();
     $data = array();
		 $i = 1;
     foreach($dataoutmail as $dom){
          $sub_array = array();

          $valTrait = $dom->OutMailTrait;
          if($valTrait == "Biasa"){
              $trait = '<span class="badge badge-pill badge-soft-dark font-size-12">'.$valTrait.'</span>';
          } elseif($valTrait == "Penting"){
              $trait = '<span class="badge badge-pill badge-soft-danger font-size-12">'.$valTrait.'</span>';
          } else{
              $trait = '<span class="badge badge-pill badge-soft-primary font-size-12">'.$valTrait.'</span>';
          }

					$sub_array[] = '<p class="text-muted text-center mb-0"><b>'.$i++.'</b></p>';
					$sub_array[] = '<p class="text-truncate mb-0"><b>'.$dom->OutMailDestination.'</b></p>
													<p class="text-muted mb-0">'.$dom->OutMailNumber.'</p>';
					$sub_array[] = '<p class="text-muted text-center mb-0">'.format_shortdateindo(date($dom->OutMailDate)).'</p>';
					$sub_array[] = '<p class="text-muted text-center mb-0"><b>'.$dom->WorkunitName.'</b></p>';
					$sub_array[] = '<p class="text-truncate text-center mb-0">'.$dom->IndeksName.'</p>
													<p class="text-muted text-center mb-0">'.$trait.'</p>';
					$sub_array[] = '<p class="text-muted text-center mb-0">'.$dom->FullName.'</p>';
          $sub_array[] = '<span class="text-center"><div class="dropdown">
                              <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                  <i class="mdi mdi-dots-horizontal font-size-18"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="'.base_url('outgoing_mail/detail/'.$dom->OutMailID).'"><i class="fa fa-eye font-size-16 align-middle mr-2"></i>Lihat Rincian</a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="method_edit(\''.$dom->OutMailID.'\')"><i class="fa fa-edit font-size-16 align-middle mr-2"></i>Ubah Informasi</a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="method_delete(\''.$dom->OutMailID.'\')"><i class="fa fa-trash font-size-16 align-middle mr-2"></i>Hapus Data</a>
                              </div>
                            </span>';
          $data[] = $sub_array;
     }
     $output = array(
          "draw"             =>     intval($_POST["draw"]),
          "recordsTotal"     =>     $this->Outgoingmail_model->get_all_dataoutmail(),
          "recordsFiltered"  =>     $this->Outgoingmail_model->get_filtered_dataoutmail(),
          "data"             =>     $data,
     );
     header('Content-Type: application/json; charset=utf-8');
     echo json_encode($output);
  }

  function add_outmail(){
    $data = array(
      'Username' => $this->session->userdata('Username'),
      'OutMailNumber' 	=> strtoupper($this->input->post('input-OutMailNumber')),
      'IndeksID' 	=> $this->input->post('input-IndeksID'),
      'OutMailDestination' 	=> strtoupper($this->input->post('input-OutMailDestination')),
			'WorkunitID' 	=> $this->input->post('input-WorkunitID'),
      'OutMailContent' 	=> (!empty($this->input->post('input-OutMailContent'))) ? $this->input->post('input-OutMailContent') : NULL,
      'OutMailTrait' 	=> $this->input->post('input-OutMailTrait'),
      'OutMailDate' 	=> date('Y-m-d',strtotime($this->input->post('input-OutMailDate'))),
    );

		$insert_id =  $this->Outgoingmail_model->add_outmail($data);

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(mkdir('./uploads/file/outgoing-mail/'.$insert_id, 0777, TRUE));
  }

  function edit_outmail($id){
    $data = array(
      'OutMailNumber' 	=> strtoupper($this->input->post('input-OutMailNumber')),
      'IndeksID' 	=> $this->input->post('input-IndeksID'),
      'OutMailDestination' 	=> strtoupper($this->input->post('input-OutMailDestination')),
			'WorkunitID' 	=> $this->input->post('input-WorkunitID'),
      'OutMailContent' 	=> (!empty($this->input->post('input-OutMailContent'))) ? $this->input->post('input-OutMailContent') : NULL,
      'OutMailTrait' 	=> $this->input->post('input-OutMailTrait'),
      'OutMailDate' 	=> date('Y-m-d',strtotime($this->input->post('input-OutMailDate'))),
    );

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Outgoingmail_model->edit_outmail($data, $id));
  }

  function delete_outmail($id){
    if (is_dir('uploads/file/outgoing-mail/'.$id)) {
      delete_files('./uploads/file/outgoing-mail/'.$id, TRUE);
      rmdir('./uploads/file/outgoing-mail/'.$id);
    } else {
      // code...
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Outgoingmail_model->delete_outmail($id));
  }

  // ================================================================================================================= DETAIL OUTGOING MAIL

	// ================================================================= MAIL Attachment

  function get_viewoutmail($id){
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Maildetail_model->get_viewoutmail($id));
  }

	function get_viewoutmailregister($id){
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Maildetail_model->get_viewoutmailregister($id));
	}

	function check_duplicatename($id){
		$name = $_GET['name'];
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Outgoingmail_model->check_duplicatename($id, $name));
	}

  function get_viewoutmailattachment($id){
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Maildetail_model->get_viewoutmailattachment($id));
  }

  function add_outmailattachment($id){
		if (!empty($_FILES['file-input-Attachment']['name'])) {
      $file_upload = $this->uploadFile('file-input-Attachment', $id, 'file/outgoing-mail', 'pdf|doc|docx|jpg|jpeg|png');
    }

    $data = array(
      'OutMailID' 	=> $id,
      'AttachmentName' => ucwords($this->input->post('input-AttachmentName')),
      'AttachmentFile' => (!empty($_FILES['file-input-Attachment']['name'])) ? $file_upload['file_name'] : NULL,
    );

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Maildetail_model->add_outmailattachment($data));
  }

  function delete_outmailattachment($id){
    $filehas = $this->db->get_where('outmailattachment', ['AttachmentID' => $id])->row()->AttachmentFile;
    $idsurat = $this->db->get_where('outmailattachment', ['AttachmentID' => $id])->row()->OutMailID;
    unlink('./uploads/file/outgoing-mail/'.$idsurat.'/'.$filehas);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($this->Maildetail_model->delete_outmailattachment($id));
  }

}
