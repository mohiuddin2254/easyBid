<?php
	
	class User_model extends CI_Model{

		public function  __construct(){

			$this->load->database();
		}
		
		
		
		function get_confirm(){
			
			$query= $this->db->select('*')
							->from('tbl_users')
							->get();
			$data = $query->result_array();
			return $data;
		}
		
		function login($email, $password){
			$this->db->where("user_email", $email);
			$this->db->where("user_password", $password);
			//$this->db->where("user_type", $type);

			$query = $this->db->get("tbl_users");
			if($query->num_rows()>0){
			
				foreach($query->result() as $rows){
				
					//add all data to session
					$newdata = array(
						'user_id'  => $rows->user_id,
						'user_type'  => $rows->user_type,
						'user_name'  => $rows->user_name,
						'user_email'    => $rows->user_email,
						'user_status'    => $rows->user_status,
						'logged_in'  => TRUE
					);
				}
				
				$this->session->set_userdata($newdata);
				return true;
			}
			else{
				return false;
			}
			
		} 
		
		function user_log(){
			$insert_data= array(
					'user_id' => $this->session->userdata('user_id')
						);
			if($this->db->insert('tbl_user_log',$insert_data)){
				$data['status'] = 'success';
				//return $this->db->insert_id();
			}
			else{
				$data['status'] = 'error';
				return FALSE;
			}
		}
		
		
		
		function getUserAdmin(){
		$query= $this->db->select('*')
						->from('tbl_users')
						->where('user_type','Admin')
						->get();
		$data = $query->result_array();
		return $data;
	}
	
	function getUserExcept_admin(){
		$query= $this->db->select('*')
						->from('tbl_users')
						->where('user_type','Creator')
						->or_where('user_type','Bidder')
						->get();
		$data = $query->result_array();
		return $data;
	}
	
	function getUserCreator(){
		$query= $this->db->select('*')
						->from('tbl_users')
						->where('user_type','Creator')
						->get();
		$data = $query->result_array();
		return $data;
	}
	
	function getUserBidder(){
		$query= $this->db->select('*')
						->from('tbl_users')
						->where('user_type','Bidder')
						->get();
		$data = $query->result_array();
		return $data;
	}
	 function addUser(){
			date_default_timezone_set('Asia/Dhaka');
			$date = date('Y-m-d',time());

			
			if(!$this->session->userdata('user_id')){
				$user_id = 0;
			}
			else 
				$user_id = $this->session->userdata('user_id');
			
			
			$insert_data= array(
					'user_type' => $this->input->post('user_type'),
					'user_name' => $this->input->post('user_name'),
					'user_email' => $this->input->post('user_email'),
					'user_password' => md5($this->input->post('user_password')),
					'user_doc' => $date,
					'user_status' => $user_status,
					'user_created_by' => $user_id
						);
			if($this->db->insert('tbl_users',$insert_data)){
				$data['status'] = 'success';
				//return $this->db->insert_id();
			}
			else{
				$data['status'] = 'error';
				return FALSE;
			}
		}  
		
		
	//edit user start
	
	
	function editUser(){
			date_default_timezone_set('Asia/Dhaka');
			$date = date('Y-m-d',time());
			$userID = $this->input->post('user_id');
			$insert_data= array(
					'user_name' => $this->input->post('user_name'),
					'user_email' => $this->input->post('user_email'),
					'user_password' => md5($this->input->post('user_password')),
					'user_doc' => $date,
					'user_status' => $this->input->post('user_status')
						);
			$this->db->where('user_id', $userID);
			$this->db->update('tbl_users', $insert_data); 

		}
		
		function get_user_for_edit($userID){
			$query= $this->db->select('*')
							->from('tbl_users')
							->where('tbl_users.user_id',$userID)
							->get();
			$data = $query->row_array();
			return $data;
		}
		
		function editUserStatus(){
				date_default_timezone_set('Asia/Dhaka');
				$date = date('Y-m-d',time());
				$userID = $this->input->post('user_id');
				$insert_data= array(
						'user_doc' => $date,
						'user_status' => $this->input->post('user_status')
							);
				$this->db->where('user_id', $userID);
				$this->db->update('tbl_users', $insert_data); 

			}
		
		function get_user_for_edit_status($userID){
			$query= $this->db->select('*')
							->from('tbl_users')
							->where('tbl_users.user_id',$userID)
							->get();
			$data = $query->row_array();
			return $data;
		}
	

	}