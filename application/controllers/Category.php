<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller{
	function __construct(){
		parent:: __construct();
		if(!$this->session->userdata('user_id')){
			 redirect('users/login');
		 }	
	}
	
	function is_logged_in(){
		 
	 }

	 
	public function index(){
		$data['header'] = 'EasyBid-Categories';
		$data['c_info'] = $this->category_model->get_category_info();
		$data['c_type_info'] = $this->category_model->get_category_type_info();
		$data['c_title'] = $this->category_model->get_category_title();
		$this->load->view('backend/layouts/header',$data);
		$this->load->view('backend/view_category',$data);
		$this->load->view('backend/layouts/footer');
	}
	function addCategory(){
		$this->category_model->addCategory();
		redirect('Category');
	}
	function addCategoryType(){
		$this->category_model->addCategoryType();
		redirect('Category');
	}
	function get_category_for_edit(){
		
		$cID = $this->input->post('c_id');
		
		$data['c_info'] = $this->category_model->get_category_for_edit($cID);
		
		echo json_encode($data['c_info']);
	}
	function editCategory(){
		$this->category_model->editCategory();
		redirect('Category');

	}
	function get_categoryType_for_edit(){
		
		$ctypeID = $this->input->post('c_type_id');
		
		$data['ctype_info'] = $this->category_model->get_categoryType_for_edit($ctypeID);
		
		echo json_encode($data['ctype_info']);
	}
	function editCategoryType(){
		$this->category_model->editCategoryType();
		redirect('Category');

	}
	
	
	function delCat($c_id) {
		
		$this->db->where('c_id', $c_id);
		$this->db->delete('tbl_category');
		$this->session->set_flashdata('message', 'Your data deleted Successfully..');
		redirect('Category');
		
    }
	
}
?>