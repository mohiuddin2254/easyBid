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
	function confirm(){
		$data['header'] = 'EasyBid - Payment Confirm';

		$this->load->view('backend/layouts/header',$data);
		$this->load->view('backend/pay_confirm',$data);
		$this->load->view('backend/layouts/footer');
	}

	public function stripePost()
    {
        require_once('application/libraries/stripe-php/init.php');
    
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
     
        \Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $this->input->post('stripeToken'),
                "description" => "Test payment from Easy Bid" 
        ]);
            
        $this->session->set_flashdata('success', 'Payment made successfully.');
             
        redirect('/Payment/confirm', 'refresh');
    }

	function addPay(){
		$this->category_model->addPay();
		redirect('Payment');
	}
}
?>