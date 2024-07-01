<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Incoming_mail extends CI_Controller {
	function __construct(){
		parent::__construct();
		error_reporting(0);
		$this->load->model('Userdata_model');
		$this->load->model('Incomingmail_model');
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
    $this->load->view('back-end/register/incoming-mail');
    $this->load->view('back-end/template/footer');
	}

	function detail($id) {
		$query = $this->Maildetail_model->get_viewinmail($id);

		if ($query->InMailTrait == 'Rahasia' && $query->Username != $this->session->userdata('Username')) {
			redirect(base_url('errorpage/not_acceptable'));
		} else {
			$data = [
					'title' => 'SIPAS - '.$this->db->get_where('companysetting', ['CompanyID' => 1])->row()->CompanyName,
					'userdata' => $this->Userdata_model->get_userdata($this->session->userdata('Username')),
			];

			$this->load->view('back-end/template/header', $data);
			$this->load->view('back-end/template/sidebar');
			$this->load->view('back-end/register/inbox-detail');
			$this->load->view('back-end/template/footer');
		}
	}

	// ============================================================================================================= INCOMING MAIL

  function get_datainmail(){
		 $datainmail = $this->Incomingmail_model->get_datainmail();
		 $data = array();
		 $i = 1;
		 foreach($datainmail as $dim){
					$sub_array = array();

					$valTrait = $dim->InMailTrait;
					if($valTrait == "Biasa"){
					    $trait = '<span class="badge badge-pill badge-soft-dark font-size-12">'.$valTrait.'</span>';
					} elseif($valTrait == "Penting"){
					    $trait = '<span class="badge badge-pill badge-soft-danger font-size-12">'.$valTrait.'</span>';
					} else{
					    $trait = '<span class="badge badge-pill badge-soft-primary font-size-12">'.$valTrait.'</span>';
					}

					$valStatus = $dim->InMailStatus;
          if($valStatus == 0){
            $status = '<span class="badge badge-pill badge-soft-danger font-size-12">Belum Diteruskan</span>';
          } elseif($valStatus == 1){
						$status = '<span class="badge badge-pill badge-soft-warning font-size-12">Diteruskan</span>';
					} else{
						$status = '<span class="badge badge-pill badge-soft-success font-size-12">Didisposisikan</span>';
					}

					$sub_array[] = '<p class="text-muted text-center mb-0"><b>'.$i++.'</b></p>';
					$sub_array[] = '<p class="text-truncate mb-0"><b>'.$dim->InMailOrigin.'</b></p>
													<p class="text-muted mb-0">'.$dim->InMailNumber.'</p>';
					$sub_array[] = '<p class="text-muted text-center mb-0">'.format_shortdateindo(date($dim->InMailDate)).'</p>';
					$sub_array[] = '<p class="text-muted text-center mb-0"><b>'.$dim->WorkunitName.'</b></p>';
					$sub_array[] = '<p class="text-truncate text-center mb-0">'.$dim->IndeksName.'</p>
													<p class="text-muted text-center mb-0">'.$trait.'</p>';
          $sub_array[] = '<p class="text-muted text-center mb-0">'.$status.'</p>';
					$sub_array[] = '<p class="text-muted text-center mb-0">'.$dim->FullName.'</p>';
          $sub_array[] = '<span class="text-center"><div class="dropdown">
															<a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
																	<i class="mdi mdi-dots-horizontal font-size-18"></i>
															</a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="'.base_url('incoming_mail/detail/'.$dim->InMailID).'"><i class="fa fa-eye font-size-16 align-middle mr-2"></i>Lihat Rincian</a>
																<a class="dropdown-item" href="javascript:void(0)" onclick="method_edit(\''.$dim->InMailID.'\')"><i class="fa fa-edit font-size-16 align-middle mr-2"></i>Ubah Informasi</a>
																<a class="dropdown-item" href="javascript:void(0)" onclick="method_forwarded(\''.$dim->InMailID.'\')"><i class="fas fa-angle-double-right font-size-16 align-middle mr-2"></i>Teruskan</a>
																<a class="dropdown-item" href="javascript:void(0)" onclick="method_delete(\''.$dim->InMailID.'\')"><i class="fa fa-trash font-size-16 align-middle mr-2"></i>Hapus Data</a>
															</div>
														</span>';
					$data[] = $sub_array;
		 }
		 $output = array(
					"draw"             =>     intval($_POST["draw"]),
					"recordsTotal"     =>     $this->Incomingmail_model->get_all_datainmail(),
					"recordsFiltered"  =>     $this->Incomingmail_model->get_filtered_datainmail(),
					"data"             =>     $data,
		 );
		 header('Content-Type: application/json; charset=utf-8');
		 echo json_encode($output);
	}

	function add_inmail(){
		$data = array(
			'Username' => $this->session->userdata('Username'),
			'InMailNumber' 	=> strtoupper($this->input->post('input-InMailNumber')),
			'IndeksID' 	=> $this->input->post('input-IndeksID'),
			'InMailOrigin' 	=> strtoupper($this->input->post('input-InMailOrigin')),
			'WorkunitID' 	=> $this->input->post('input-WorkunitID'),
			'InMailContent' 	=> (!empty($this->input->post('input-InMailContent'))) ? $this->input->post('input-InMailContent') : NULL,
			'InMailTrait' 	=> $this->input->post('input-InMailTrait'),
			'InMailDate' 	=> date('Y-m-d',strtotime($this->input->post('input-InMailDate'))),
		);

		$insert_id = $this->Incomingmail_model->add_inmail($data);

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode(mkdir('./uploads/file/incoming-mail/'.$insert_id, 0777, TRUE));
	}

	function edit_inmail($id){
		$data = array(
			'InMailNumber' 	=> strtoupper($this->input->post('input-InMailNumber')),
			'IndeksID' 	=> $this->input->post('input-IndeksID'),
			'InMailOrigin' 	=> strtoupper($this->input->post('input-InMailOrigin')),
			'WorkunitID' 	=> $this->input->post('input-WorkunitID'),
			'InMailContent' 	=> (!empty($this->input->post('input-InMailContent'))) ? $this->input->post('input-InMailContent') : NULL,
			'InMailTrait' 	=> $this->input->post('input-InMailTrait'),
			'InMailDate' 	=> date('Y-m-d',strtotime($this->input->post('input-InMailDate'))),
		);

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Incomingmail_model->edit_inmail($data, $id));
	}

	function forwarded_inmail($id){
		$status = $this->db->get_where('inmail', ['InMailID' => $id])->row()->InMailStatus;

		if ($status == 0) {
			$data = array(
				'InMailStatus' 	=> 1,
			);

			$output = array(
				'Message' => 'no',
				'Function' => $this->Incomingmail_model->forwarded_inmail($data, $id),
			);

			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($output);
		} else {
			$output = array(
				'Message' => 'yes',
				'Function' => '',
			);

			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($output);
		}

	}

	function delete_inmail($id){
		if (is_dir('uploads/file/incoming-mail/'.$id)) {
			delete_files('./uploads/file/incoming-mail/'.$id, TRUE);
			rmdir('./uploads/file/incoming-mail/'.$id);
		} else {
			// code...
		}

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Incomingmail_model->delete_inmail($id));
	}

}
