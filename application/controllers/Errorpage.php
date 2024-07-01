<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Errorpage extends CI_Controller{
	function __construct(){
		parent::__construct();
	}

	public function not_found(){
		$data = [
			'title' => '404 - Not Found'
		];
		$this->load->view('errors/404', $data);
	}

	public function not_acceptable(){
		$data = [
			'title' => '406 - Not Acceptable'
		];
		$this->load->view('errors/406', $data);
	}
}

?>
