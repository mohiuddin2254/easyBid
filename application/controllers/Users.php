<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Users extends CI_Controller {

		public function __construct(){
			parent::__construct();

			$this->load->library('session');

		}


		function index(){
			$data['header']="Registration";
				$this->load->view('frontend/layouts/header',$data);
				$this->load->view('frontend/view_signup');
				$this->load->view('frontend/layouts/footer');
		}

		function registration(){
			
			$this->form_validation->set_rules('user_type', 'User Type', 'required');
            $this->form_validation->set_rules('user_name', 'User Name', 'required|is_unique[tbl_users.user_name]');
            $this->form_validation->set_rules('user_email', 'Email','required|trim|is_unique[tbl_users.user_email]');
            $this->form_validation->set_rules('user_password', 'Password', 'required|min_length[8]');
            $this->form_validation->set_rules('user_password', 'Confirm Password', 'required|min_length[8]|matches[user_password]');
            
			
			if($this->form_validation->run()){
				  $verification_key=md5(rand());
				  $encrypted_password = md5($this->input->post('user_password'));
				  $data=array(
					  'user_name'=> $this->input->post('user_name'),
					  'user_email'=> $this->input->post('user_email'),
					  'user_password'=> $encrypted_password,
					  'verification_key'=>$verification_key
				  );
				  $id=$this->user_model->insert($data);
				  if($id>0){
					$subject="EasyBid - Email verification";
					$message="<p>Hi ".$this->input->post('user_name').",</p>
					<br>
					<p>Please verify your email by clicking this <a href='".base_url()."Users/verify_email/".$verification_key."'>link</a></p>
					<p>once you click this link your email will be verified and you can login into EasyBid dashboard.</p>
					<br>
					<p>Thanks</p>";

					$config = array(
						'protocol'  => 'smtp',
						'smtp_host' => 'smtp.gmail.com',
						'smtp_port' => 587, //if 80 dosenot work use 24 or 21
						'smtp_user'  => 'muzimohi@gmail.com',  //give your user mail from which mail will be sent
						'smtp_pass'  => '12345678@_m',  // smtp_user password
						'_smtp_auth' => true,
						'smtp_crypto' => 'tls',
						'protocol' => 'smtp',
						'mailtype'  => 'html', 
						'charset'    => 'iso-8859-1',
						'wordwrap'   => TRUE
					   );
					   $this->load->library('email');
					   $this->email->initialize($config);  
					 
					   $this->email->set_newline("\r\n");
					   $this->email->from('muzimohi@gmail.com');  //same email u use for smtp_user 
					   $this->email->to($this->input->post('user_email'));
					   $this->email->subject($subject);
					   $this->email->message($message);
						
					   if($this->email->send())
					{
					$this->session->set_flashdata('signup_message', 'Check in your email for email verification mail');
					$this->session->flashdata('signup_message');
					redirect('Signup');
				
					}
					else{
						echo "mail not send";
					}
					} 
	
	
					 
				  }
			
			else{
				$this->index();
			}
		}
		function verify_email(){
			if($this->uri->segment(3))
			{
				$verification_key=$this->uri->segment(3);
				$vkey = $this->user_model->verify_email($verification_key);
				if($vkey == true)
				{
					$data['message'] = '<h1 align="center">Your Email has been successfully verified, now you can login from <a href="'.base_url().'Login">here</a></h1>';
				}
				else{
					$data['message']='<h1 style="align:center;">Invalid Link</h1>';
				}

				$data['header']="Registration";
				$this->load->view('frontend/layouts/header',$data);
				$this->load->view('frontend/view_signup',$data);
				$this->load->view('frontend/layouts/footer');
			}
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