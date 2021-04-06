<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Profile_model extends CI_Model {
		function __construct(){
          // Call the Model constructor
          parent::__construct();
		  
			
		}
		

		function get_users_profile(){
			
			
			$this->db->select('*');
			$query = $this->db->get_where('tbl_users', array('user_id' => $this->session->userdata('user_id')));
			return $query->result_array();
		}
		
		function editProfile(){
			$userID = $this->session->userdata('user_id');
			$insert_data= array(
					'user_name' => $this->input->post('user_name'),
					'user_num' => $this->input->post('user_num'),
					'user_addr' => $this->input->post('user_addr')
					);
			$this->db->where('user_id', $userID);
			$this->db->update('tbl_users', $insert_data); 

		}
		
		function get_profile($userID){
			$query= $this->db->select('*')
							->from('tbl_users')
							->where('tbl_users.user_id',$userID)
							->get();
			$data = $query->row_array();
			return $data;
		}
		
	}
?>