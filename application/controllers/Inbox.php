<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inbox extends CI_Controller{
	function __construct(){
		parent::__construct();
    error_reporting(0);
		$this->load->model('Userdata_model');
		$this->load->model('Inbox_model');
		$this->load->model('Maildetail_model');
		is_logged_in();
	}

	public function index(){
		$data = [
			'title' => 'SIPAS - '.$this->db->get_where('companysetting', ['CompanyID' => 1])->row()->CompanyName,
			'userdata' => $this->Userdata_model->get_userdata($this->session->userdata('Username')),
		];

		$this->load->view('back-end/template/header', $data);
		$this->load->view('back-end/template/sidebar');
		$this->load->view('back-end/inbox/inbox');
		$this->load->view('back-end/template/footer');

	}

	function detail($id) {
		$data = [
				'title' => 'SIPAS - '.$this->db->get_where('companysetting', ['CompanyID' => 1])->row()->CompanyName,
				'userdata' => $this->Userdata_model->get_userdata($this->session->userdata('Username')),
		];

		$access = $this->Inbox_model->check_access($id);

		if ($access > 0) {
			$this->load->view('back-end/template/header', $data);
			$this->load->view('back-end/template/sidebar');
			$this->load->view('back-end/inbox/inbox-detail');
			$this->load->view('back-end/template/footer');
		} else {
			redirect('errorpage/not_acceptable');
		}

	}

	function get_datadisposition(){
		$page =  $_GET['page'];
		$username = $this->session->userdata('Username');

		$datainmail = $this->Inbox_model->get_datadisposition($page, $username);
		foreach($datainmail as $dim){
			$content = strlen($dim->InMailContent);
			$note = strlen($dim->DispositionNote);

			echo '<tr>
								<td>
									<div class="avatar-sm mx-auto">';
			if ($dim->DispositionStatus == "unread") {
				echo '<span class="avatar-title rounded-circle bg-soft-danger text-danger"><i class="mdi mdi-email-outline font-size-24"></i></span>';
			} else {
				echo '<span class="avatar-title rounded-circle bg-soft-success text-success"><i class="mdi mdi-email-open-outline font-size-24"></i></span>';
			}
			echo				'</div>
								</td>
								<td><a href="'.base_url('inbox/detail/'.$dim->InMailID).'" onclick="maskasread('.$dim->DispositionID.')">
										<h5 class="text-truncate font-size-14 mb-1">'.$dim->InMailOrigin.'</h5>
											<span class="text-muted font-size-12">';
			if ($content > 50) {
				echo substr($dim->InMailContent,0,50)."...";
			} elseif ($content == 0) {
				echo '<i>Tidak ada deskripsi</i>';
			} else {
				echo $dim->InMailContent;
			}
			echo						'</span>
										<p class="text-muted mt-2 mb-0">Catatan: ';
			if (!$note) {
				echo '<i>Tidak ada catatan</i>';
			} elseif ($note > 30) {
				echo substr($dim->DispositionNote,0,30)."...";
			} else {
				echo $dim->DispositionNote;
			}
			echo					'</p>
								</a></td>
								<td class="text-center">'.$dim->IndeksName.'</td>
								<td class="text-center">';
			if ($dim->InMailTrait == "Biasa") {
				echo '<span class="badge badge-pill badge-soft-dark font-size-12">'.$dim->InMailTrait.'</span>';
			} elseif ($dim->InMailTrait == "Penting") {
				echo '<span class="badge badge-pill badge-soft-danger font-size-12">'.$dim->InMailTrait.'</span>';
			} else {
				echo '<span class="badge badge-pill badge-soft-primary font-size-12">'.$dim->InMailTrait.'</span>';
			}
			echo			'</td>
								<td class="text-center">'.format_shortdateindo(date($dim->InMailDate)).'</td>';
			if ($dim->DispositionDeadline < date('Y-m-d') && $dim->InMailTrait == "Penting" && $dim->DispositionStatus == "unread") {
				echo '<td class="text-center text-danger">'.format_shortdateindo(date($dim->DispositionDeadline)).'</td>';
			} else {
				echo '<td class="text-center">'.format_shortdateindo(date($dim->DispositionDeadline)).'</td>';
			}
			echo	'</tr>';
		}
		exit;
	}

	function search_datadisposition(){
		$keyword =  $_GET['keyword'];

		$datainmail = $this->Inbox_model->search_datadisposition($keyword);
		foreach($datainmail as $dim){
			$content = strlen($dim->InMailContent);
			$note = strlen($dim->DispositionNote);

			echo '<tr>
								<td>
									<div class="avatar-sm mx-auto">';
			if ($dim->DispositionStatus == "unread") {
				echo '<span class="avatar-title rounded-circle bg-soft-danger text-danger"><i class="mdi mdi-email-outline font-size-24"></i></span>';
			} else {
				echo '<span class="avatar-title rounded-circle bg-soft-success text-success"><i class="mdi mdi-email-open-outline font-size-24"></i></span>';
			}
			echo				'</div>
								</td>
								<td><a href="'.base_url('inbox/detail/'.$dim->InMailID).'" onclick="maskasread('.$dim->DispositionID.')">
										<h5 class="text-truncate font-size-14 mb-1">'.$dim->InMailOrigin.'</h5>
											<span class="text-muted font-size-12">';
			if ($content > 50) {
				echo substr($dim->InMailContent,0,50)."...";
			} elseif ($content == 0) {
				echo '<i>Tidak ada deskripsi</i>';
			} else {
				echo $dim->InMailContent;
			}
			echo						'</span>
										<p class="text-muted mt-2 mb-0">Catatan: ';
			if (!$note) {
				echo '<i>Tidak ada catatan</i>';
			} elseif ($note > 30) {
				echo substr($dim->DispositionNote,0,30)."...";
			} else {
				echo $dim->DispositionNote;
			}
			echo					'</p>
								</a></td>
								<td class="text-center">'.$dim->IndeksName.'</td>
								<td class="text-center">';
			if ($dim->InMailTrait == "Biasa") {
				echo '<span class="badge badge-pill badge-soft-dark font-size-12">'.$dim->InMailTrait.'</span>';
			} elseif ($dim->InMailTrait == "Penting") {
				echo '<span class="badge badge-pill badge-soft-danger font-size-12">'.$dim->InMailTrait.'</span>';
			} else {
				echo '<span class="badge badge-pill badge-soft-primary font-size-12">'.$dim->InMailTrait.'</span>';
			}
			echo			'</td>
								<td class="text-center">'.format_shortdateindo(date($dim->InMailDate)).'</td>';
			if ($dim->DispositionDeadline < date('Y-m-d') && $dim->InMailTrait == "Penting" && $dim->DispositionStatus == "unread") {
				echo '<td class="text-center text-danger">'.format_shortdateindo(date($dim->DispositionDeadline)).'</td>';
			} else {
				echo '<td class="text-center">'.format_shortdateindo(date($dim->DispositionDeadline)).'</td>';
			}
			echo	'</tr>';
		}
		exit;
	}

	function count_inmaildeadline(){
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Inbox_model->count_inmaildeadline());
	}

}

?>
