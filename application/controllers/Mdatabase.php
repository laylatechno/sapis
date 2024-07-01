<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdatabase extends CI_Controller{
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
    $this->load->view('back-end/mdatabase');
    $this->load->view('back-end/template/footer');
	}

  public function backup() {
    $this->load->dbutil();

    $config = array(
      'format' => 'sql'
    );

    $backup = $this->dbutil->backup($config);

    $db_name = 'db_sipas (backup-on-'.date("Y-m-d").').sql';
    $save = 'database/backup/'.$db_name;

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(write_file($save, $backup));
  }

}

?>
