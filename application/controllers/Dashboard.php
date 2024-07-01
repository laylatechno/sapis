<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{
	function __construct(){
		parent::__construct();
    error_reporting(0);
    $this->load->model('Companydata_model');
		$this->load->model('Userdata_model');
		$this->load->model('Dashboard_model');
		is_logged_in();
	}

	public function index(){
		$data = [
			'title' => 'SIPAS - '.$this->db->get_where('companysetting', ['CompanyID' => 1])->row()->CompanyName,
			'userdata' => $this->Userdata_model->get_userdata($this->session->userdata('Username')),
			'companydata' => $this->Companydata_model->get_companydata(),
		];

		if ($this->session->userdata('Welcome') == TRUE) {
			$this->Userdata_model->input_logincounter();
			echo $this->session->set_flashdata('flash', '<b>System Notification</b> <br>Selamat datang, <b>'.$this->session->userdata('FullName').'</b> di Aplikasi SIPAS');
			echo $this->session->set_flashdata('type', 'info');
			$this->session->unset_userdata('Welcome');

			$this->load->view('back-end/template/header', $data);
			$this->load->view('back-end/template/sidebar');
			$this->load->view('back-end/dashboard');
			$this->load->view('back-end/template/footer');
		} else {
			$this->load->view('back-end/template/header', $data);
			$this->load->view('back-end/template/sidebar');
			$this->load->view('back-end/dashboard');
			$this->load->view('back-end/template/footer');
		}
	}

	function get_datacounter() {
		$output = array(
			'TotalInMail' => $this->db->get('inmail')->num_rows(),
			'TotalOutMail' => $this->db->get('outmail')->num_rows(),
			'TotalDisposition' => $this->db->get('disposition')->num_rows(),
		);

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($output);
	}

	function get_counter(){
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($this->Dashboard_model->get_counter());
	}

	function get_messageunread(){
		$username = $this->session->userdata('Username');
		$datainmail = $this->Dashboard_model->get_datadisposition($username);

		if (!$datainmail) {
			echo '<li class="list-group-item">
							<div class="media">
								<div class="media-body">
									<p class="text-muted text-center mb-0">Kosong</p>
								</div>
							</div>
						</li>';
		} else {
			foreach($datainmail as $dim){
				$content = strlen($dim->InMailContent);
				echo '<li class="list-group-item">
							<a class="media" href="'.base_url('inbox/detail/'.$dim->InMailID).'" onclick="maskasread('.$dim->DispositionID.')">
									<div class="avatar-xs mr-3">
											<span class="avatar-title rounded-circle bg-soft-danger text-danger"><i class="mdi mdi-email-outline font-size-20"></i></span>
									</div>
									<div class="media-body">
											<h5 class="font-size-14">'.$dim->InMailOrigin.'</h5>
											<p class="text-muted">';
											if ($content > 50) {
												echo substr($dim->InMailContent,0,50)."...";
											} elseif ($content == 0) {
												echo '<i>Tidak ada deskripsi</i>';
											} else {
												echo $dim->InMailContent;
											}
					echo '</p>
											<div class="float-right">
													<p class="text-muted mb-0"><i class="mdi mdi-account mr-1"></i> '.$dim->FullName.'</p>
											</div>
											<p class="text-muted mb-0">'.format_shortdateindo(date($dim->InMailDate)).'</p>
									</div>
							</a>
							</li>';
			}
			exit;
		}
	}

	function get_graphdata($year){
		$output = array(
			'InMail_Jan' => $this->Dashboard_model->graph_inmail_jan($year),
			'InMail_Feb' => $this->Dashboard_model->graph_inmail_feb($year),
			'InMail_Mar' => $this->Dashboard_model->graph_inmail_mar($year),
			'InMail_Apr' => $this->Dashboard_model->graph_inmail_apr($year),
			'InMail_May' => $this->Dashboard_model->graph_inmail_may($year),
			'InMail_Jun' => $this->Dashboard_model->graph_inmail_jun($year),
			'InMail_Jul' => $this->Dashboard_model->graph_inmail_jul($year),
			'InMail_Aug' => $this->Dashboard_model->graph_inmail_aug($year),
			'InMail_Sep' => $this->Dashboard_model->graph_inmail_sep($year),
			'InMail_Oct' => $this->Dashboard_model->graph_inmail_oct($year),
			'InMail_Nov' => $this->Dashboard_model->graph_inmail_nov($year),
			'InMail_Dec' => $this->Dashboard_model->graph_inmail_dec($year),

			'OutMail_Jan' => $this->Dashboard_model->graph_outmail_jan($year),
			'OutMail_Feb' => $this->Dashboard_model->graph_outmail_feb($year),
			'OutMail_Mar' => $this->Dashboard_model->graph_outmail_mar($year),
			'OutMail_Apr' => $this->Dashboard_model->graph_outmail_apr($year),
			'OutMail_May' => $this->Dashboard_model->graph_outmail_may($year),
			'OutMail_Jun' => $this->Dashboard_model->graph_outmail_jun($year),
			'OutMail_Jul' => $this->Dashboard_model->graph_outmail_jul($year),
			'OutMail_Aug' => $this->Dashboard_model->graph_outmail_aug($year),
			'OutMail_Sep' => $this->Dashboard_model->graph_outmail_sep($year),
			'OutMail_Oct' => $this->Dashboard_model->graph_outmail_oct($year),
			'OutMail_Nov' => $this->Dashboard_model->graph_outmail_nov($year),
			'OutMail_Dec' => $this->Dashboard_model->graph_outmail_dec($year),
		);

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($output);
	}

	function get_percentdata($year){
		$output = array(
			'InMail' => $this->db->get_where('inmail', ['YEAR(InMailDate)' => $year])->num_rows(),
			'OutMail' => $this->db->get_where('outmail', ['YEAR(OutMailDate)' => $year])->num_rows(),
		);

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($output);
	}

}

?>
