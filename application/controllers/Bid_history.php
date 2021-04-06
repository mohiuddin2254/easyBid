<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bid_history extends CI_Controller{
	function __construct(){
		parent:: __construct();
		
		if(!$this->session->userdata('user_id')){
			 redirect('users/login');
		 }
		
	}
	
	 
	public function index(){
		$data['header'] = 'EasyBid - Bid History';
		$data['bid_history'] = $this->category_model->get_bid_history();
		$this->load->view('backend/layouts/header',$data);
		$this->load->view('backend/view_bid_history',$data);
		$this->load->view('backend/layouts/footer');
	}
	
	public function bidder(){
		$data['header'] = 'EasyBid - Bid History';
		$data['bid_history'] = $this->category_model->get_bid_history_bidder();
		$this->load->view('backend/layouts/header',$data);
		$this->load->view('backend/view_bid_history',$data);
		$this->load->view('backend/layouts/footer');
	}
	
	
	function deleteBid($s_id) {
		
		unlink("assets/uploads/a_pic/".$s_id);
		$this->db->where('s_id', $s_id);
		$this->db->delete('tbl_sold_product');
		$this->session->set_flashdata('message', 'Your data deleted Successfully..');
		redirect('Bid_history/bidder');
		
    }
}
?>