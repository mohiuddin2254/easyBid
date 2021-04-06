<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{
	function __construct(){
		parent:: __construct();
	
	}
	public function index()
	{
		$data['header'] = "EasyBid-Home";
		$data['cat_info'] = $this->category_model->get_category_info();
		$data['cat_type_info'] = $this->category_model->get_category_type_info();
		$data['cat_title'] = $this->category_model->get_category_title();
		$data['auc_info'] = $this->category_model->get_auction();
		//echo CI_VERSION;
		$this->load->view('frontend/layouts/header',$data);
		$this->load->view('frontend/home',$data);
		$this->load->view('frontend/layouts/footer');
		
	}
	

    public function addBid() {


        $products = $this->category_model->add_bid();
        redirect('home');
		echo json_encode($products);

    }

    public function addBids() {

		$cat = $this->input->post('c_id');
        $products = $this->category_model->add_bid();
        redirect('home/category_info/'.$cat);
		echo json_encode($products);

    }

	function auction_info($a){
		
		$data['header'] = "EasyBid-Single Auction";
		$data['auc_info'] = $this->category_model->get_specific_auction($a);
		
		$this->load->view('frontend/layouts/header',$data);
		$this->load->view('frontend/single_auction',$data);
		$this->load->view('frontend/layouts/footer');
	}
	function category_info($cat){
		
		$data['header'] = "EasyBid-Single Category";
		$data['cat_info'] = $this->category_model->get_specific_cat_auction($cat);

		$this->load->view('frontend/layouts/header',$data);
		$this->load->view('frontend/single_cat',$data);
		$this->load->view('frontend/layouts/footer');
	}
	
	
	
		
	function search(){
		

		if($this->uri->segment(3)){$a_title = $this->uri->segment(4);}
		else{
			$a_title = $_GET['a_title'];
				
			if($a_title == ''){
				$a_title = 'null';
			}
		}
		
		$this->load->library('pagination');

			$config['base_url'] = base_url().'Home/search/'.$a_title.'/';
			

			$config['total_rows'] = $this->category_model->get_search_count($a_title);
			$config['per_page'] = 2;
			$config['uri_segment'] = 8;
			$this->pagination->initialize($config);
			

		$search = $this->input->post('search');
		
		$data['datas'] = $this->category_model->get_search($a_title,$config['per_page'],$this->uri->segment(8));
		$data['header'] = "Search";
		$this->load->view('frontend/layouts/header',$data);
		$this->load->view('frontend/view_search',$data);
		$this->load->view('frontend/layouts/footer');

	}
	
	
}
?>