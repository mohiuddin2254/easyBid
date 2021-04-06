<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auction extends CI_Controller{
	function __construct(){
		parent:: __construct();
		
		if(!$this->session->userdata('user_id')){
			 redirect('users/login');
		 }
		
	}
	
	 
	public function index(){
		$data['header'] = 'EasyBid';
		$data['c_title'] = $this->category_model->get_category_title();	
		$data['pro_info'] = $this->category_model->get_categoryType();
		$data['auc_info'] = $this->category_model->get_auction_admin();
		$this->load->view('backend/layouts/header',$data);
		$this->load->view('backend/view_auction',$data);
		$this->load->view('backend/layouts/footer');
	}
	function addAuction(){
		$_SESSION['pack-item'] = '<div class="alert alert-success">Added Successfully</div>';
		$this->session->mark_as_flash('pack-item');
		
		$a_id = $this->category_model->addAuction();

			/************* File Upload ************/
			$config['upload_path'] = './assets/uploads/a_pic/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload',$config);
			
			$filetype = $_FILES['a_pic']['type'];
			$file_name = $_FILES['a_pic']['name'];
			
			if($filetype == "image/jpg")
					$file_type='jpg';
				else if ($filetype == "image/gif")
					$file_type='gif';
				else if($filetype == "image/jpeg")
					$file_type='jpg';

				else if($filetype == "image/pjpeg")
					$file_type='pjpeg';
				else if($filetype ==  "image/png")
					$file_type='png';

			$_FILES['a_pic']['name']=$a_id.'.'.$file_type;
			
			$this->upload->do_upload('a_pic');
			
		
			$up_dtat = array('a_pic' => $_FILES['a_pic']['name']);
			$this->db->where('a_id',$a_id);
			$this->db->update('tbl_auction',$up_dtat);
		redirect('Auction');
	}
	
	
	function get_cat_type(){
		$c_id = $this->input->post('c_id');
		$query = $this -> category_model -> get_catType($c_id);
		$json_response = array();
		foreach($query->result() as $row){
			$row_array['c_type_title'] = $row-> c_type_title;
			$row_array['c_type_id'] = $row-> c_type_id;
			array_push($json_response,$row_array);
		}
		
		echo json_encode($json_response);
	}
	
	
	function get_auction_for_edit(){
		
		$aID = $this->input->post('a_id');
		
		$data['a_info'] = $this->category_model->get_auction_for_edit($aID);
		
		echo json_encode($data['a_info']);
	}
	function editAuction(){
		$this->category_model->editAuction();
		redirect('Auction');

	}
	


	function editAuctionStatus(){
		$this->category_model->editAuctionStatus();
		redirect('Auction');

	}

	function deleteAuc($a_id) {
		
		unlink("assets/uploads/a_pic/".$a_id);
		$this->db->where('a_id', $a_id);
		$this->db->delete('tbl_auction');
		$this->session->set_flashdata('message', 'Your data deleted Successfully..');
		redirect('Auction');
		
    }
	
}
?>