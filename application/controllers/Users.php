<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Users extends CI_Controller {

		public function __construct(){
			parent::__construct();

		}
		
		
		
	
		function registration(){
		
		

        if (isset($_POST['register'])) {
        	$this->form_validation->set_rules('user_type', 'User Type', 'required');
            $this->form_validation->set_rules('user_name', 'User Name', 'required|is_unique[tbl_users.user_name]');
            $this->form_validation->set_rules('user_email', 'Email','required|trim|is_unique[tbl_users.user_email]');
            $this->form_validation->set_rules('user_password', 'Password', 'required|min_length[8]');
            $this->form_validation->set_rules('user_password', 'Confirm Password', 'required|min_length[8]|matches[user_password]');
            if ($this->form_validation->run() == TRUE) {
				date_default_timezone_set('Asia/Dhaka');
				$date = date('Y-m-d',time());

                $data = array(
                    'user_type' => $_POST['user_type'],
                    'user_name' => $_POST['user_name'],
                    'user_email' => $_POST['user_email'],
                    'user_password' => md5($_POST['user_password']),
                    'user_doc' => $date,
                   
                );
                $this->db->insert('tbl_users', $data);

                $this->session->set_flashdata("success", "Your account has been registered. Waiting for Admin Approval. Thanks!!!");
                redirect("users/registration", "refresh");
            }
        }
        //load view
        $data['header']="Registration";
		$this->load->view('frontend/layouts/header',$data);
		$this->load->view('frontend/view_signup');
		$this->load->view('frontend/layouts/footer');
	}
	
		public function login(){
			
			//$type = $this->input->post('user_type');
			$email = $this->input->post('user_email');
			$password = md5($this->input->post('user_password'));
			
			//print_r($email);
			$result = $this->user_model->login($email, $password);
			
			if($result AND ($this->session->userdata('user_status')==1)){
				redirect('dashboard');
			}
			else{
				if($this->session->userdata('user_status')==1){
					$data['login_success'] = false;
					redirect('users/dashboard');	
				}
				else{
					$data = array();
					if($this->input->post()){
						$data['wrong_message'] = 'Email or Password Wrong!';
					}
					$info['header'] = "Login";
					$this->load->view('frontend/layouts/header',$info);
					$this->load->view('frontend/login_form', $data);
					$this->load->view('frontend/layouts/footer');
				}
			}
		}
		
		/*public function dashboard(){
			if($this->session->userdata('user_id')!=""){
			$data['login_success'] = true;
			$this->load->view('backend/layout/header', $data);
			$this->load->view('backend/index');
			$this->load->view('backend/layout/footer');
			}
			else{
					/* $data = array();
						if($this->input->post()){
							$data['wrong_message'] = 'Email or Password Wrong!';
						} */
				
					//redirect('users/login');
		//	}
		//}*/
		public function logout(){
			// $this->backup_database();
			$newdata = array( 
				'user_id'  => '',
				'user_type'  => '',
				'user_name'  => '',
				'user_email'    => '',
				'user_status'    => '',
				'logged_in'  => FALSE
			);

			$this->session->unset_userdata($newdata);
			$this->session->sess_destroy();
			redirect('home');
		}
	
	}

?>