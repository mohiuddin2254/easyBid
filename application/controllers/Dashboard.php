<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{
	function __construct(){
		parent:: __construct();
		if(!$this->session->userdata('user_id')){
			 redirect('users/login');
		 }
	
	}
	
	
	 
	public function index()
	{
		$data['header'] = 'EasyBid-Dashboard';
		$this->load->view('backend/layouts/header',$data);
		$this->load->view('backend/dashboard');
		$this->load->view('backend/layouts/footer');
	}
}
?>