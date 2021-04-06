<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller{
	function __construct(){
		parent:: __construct();
		
		if(!$this->session->userdata('user_id')){
			 redirect('users/login');
		 }
		
	}
	
	 
	public function index(){
		$data['header'] = 'EasyBid - Payment';
		$data['bid_winner'] = $this->category_model->get_bid_winner();
		//$data['pay'] = $this->category_model->get_payment();
		$this->load->view('backend/layouts/header',$data);
		$this->load->view('backend/view_bid_winner',$data);
		$this->load->view('backend/layouts/footer');
	}
	function addPay(){
		$this->category_model->addPay();
		redirect('Payment');
	}
}
?>