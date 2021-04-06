<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_control extends CI_Controller {
	function __construct(){
		parent:: __construct();
		
		if(!$this->session->userdata('user_id')){
			 redirect('users/login');
		 }
		
		
	}

	
	function index()
	{
		$data['title']="EasyBid-Users Control";
		$info['user_info'] = $this->user_model->getUserAdmin();
		$this->load->view('backend/layouts/header',$data);
		$this->load->view('backend/view_users_control',$info);
		$this->load->view('backend/layouts/footer');
	}
	
	function users_creator()
	{
		$data['title']="EasyBid-Users Control";
		$info['user_info'] = $this->user_model->getUserCreator();
		$this->load->view('backend/layouts/header',$data);
		$this->load->view('backend/view_users_control',$info);
		$this->load->view('backend/layouts/footer');
	}
	
	function users_bidder()
	{
		$data['title']="EasyBid-Users Control";
		$info['user_info'] = $this->user_model->getUserBidder();
		$this->load->view('backend/layouts/header',$data);
		$this->load->view('backend/view_users_control',$info);
		$this->load->view('backend/layouts/footer');
	}
	
	function users_except_admin(){
		$data['title']="EasyBid-Users Control - Auction Creator";
		$info['user_info'] = $this->user_model->getUserExcept_admin();
		$info['confirm'] = $this->user_model->get_confirm();
		$this->load->view('backend/layouts/header',$data);
		$this->load->view('backend/view_users_except_admin',$info);
		$this->load->view('backend/layouts/footer');
	}
	
	
	
	public function addUser(){
		$_SESSION['pack-item'] = '<div class="alert alert-success">Added Successfully</div>';
		$this->session->mark_as_flash('pack-item');
		$user_id = $this->user_model->addUser();

			/************* File Upload ************/
			$config['upload_path'] = './uploads/user_pic/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload',$config);
			
			$filetype = $_FILES['user_pic']['type'];
			$file_name = $_FILES['user_pic']['name'];
			
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

			$_FILES['user_pic']['name']=$user_id.'.'.$file_type;
			
			$this->upload->do_upload('user_pic');
			
		
			$up_dtat = array('user_pic' => $_FILES['user_pic']['name']);
			$this->db->where('user_id',$user_id);
			$this->db->update('tbl_users',$up_dtat);
		redirect('Users_control');
	}
	
	
	public function editUser(){

			$_SESSION['after_edit'] = '<div class="alert alert-success">Updated Successfully</div>';
			$this->session->mark_as_flash('after_edit');
			$this->user_model->editUser();
			redirect('Users_control');
		
	}
	
	public function editUserStatus(){

			$_SESSION['after_edit'] = '<div class="alert alert-success">Updated Successfully</div>';
			$this->session->mark_as_flash('after_edit');
			$this->user_model->editUserStatus();
			redirect('Users_control/users_except_admin');
	}
	
	public function get_user_for_status(){
		
		$userID = $this->input->post('user_id');
		
		$data['user_info'] = $this->user_model->get_user_for_edit_status($userID);
		
		echo json_encode($data['user_info']);
	}
	
	
	public function editUserTenant(){

		if($this->Access_model->check_user_access('Users_control','editUser',$this->session->userdata('user_type'))){
			$_SESSION['after_edit'] = '<div class="alert alert-success">Updated Successfully</div>';
			$this->session->mark_as_flash('after_edit');
			$this->user_model->editUser();
			redirect('Users_control/users_tenant');
		}
		else{
			redirect('Users_control/users_tenant');
		}
	}
	
	public function get_user_info_for_edit(){
		
		$userID = $this->input->post('user_id');
		
		$data['user_info'] = $this->user_model->get_user_for_edit($userID);
		
		echo json_encode($data['user_info']);
	}
	
	
	function delUser($user_id) {
		
		$this->db->where('user_id', $user_id);
		$this->db->delete('tbl_users');
		$this->session->set_flashdata('message', 'Your data deleted Successfully..');
		redirect('Users_control');
    }


}
