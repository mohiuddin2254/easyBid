<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Category_model extends CI_Model {
		function __construct(){
          // Call the Model constructor
          parent::__construct();
		  
			
		}
		
		function get_search_count($c_id=null,$a_title=null){
			$this->db->select('*');
			$this->db->from('tbl_auction');
			if($c_id != 'null'){$this->db->where('c_id',$c_id); }
			
			if($a_title != 'null'){$this->db->or_where('a_title',$a_title);}
			$query = $this->db->get();
				 return $query->num_rows();
		}
		
		function get_search($a_title=null,$from,$to){
			
			$this->db->select('*');
			$this->db->from('tbl_auction,tbl_category,tbl_category_type');
			
			if($a_title != 'null')
			{
				$this->db->or_where('a_title',$a_title);
			}
				$this->db->where('tbl_auction.c_id = tbl_category.c_id');
				$this->db->where('tbl_auction.c_type_id = tbl_category_type.c_type_id');
			
			$this->db->limit($from,$to);
			$this->db->order_by('a_id','asc');
			
			$query = $this->db->get();
			
			if($query->num_rows() > 0)
				 return $query->result_array();
			else
				 return FALSE;
		}
		function get_auction(){
		$query= $this->db->select('*')
					->from('tbl_auction,tbl_category,tbl_category_type')
					->where('tbl_auction.c_id = tbl_category.c_id')
					->where('tbl_auction.c_type_id = tbl_category_type.c_type_id')
					->where('tbl_auction.a_status',1)
					
					->get();
			
			$data = $query->result_array();
			return $data;
		}
		
		function get_auction_admin(){
        //kam shes ou ektu jinish otota time lagailay ni tmra 
        $auc = $this->session->userdata('user_id');
		$query= $this->db->select('*')
					->from('tbl_auction,tbl_category,tbl_category_type')
					->where('tbl_auction.c_id = tbl_category.c_id')
					->where('tbl_auction.c_type_id = tbl_category_type.c_type_id')
					->get();
			
			$data = $query->result_array();

			return $data;
		}

	
		function get_specific_cat_auction($cat){
		$query= $this->db->select('*')
					->from('tbl_auction,tbl_category,tbl_category_type')
					->where('tbl_auction.c_id = tbl_category.c_id')
					->where('tbl_auction.c_type_id = tbl_category_type.c_type_id')
					->where('tbl_category.c_title',$cat)
					->order_by('tbl_category.c_title','asc')
					->get();
	//ami koilam search dite search kilan ditm		
			$data = $query->result_array();

			return $data;
		}
		
		function last_price(){
		$query= $this->db->select('*')
					->from('tbl_sold_product')
					->order_by('tbl_sold_product.s_id','desc')
					->limit('1')
					

					
					->get();
			
			$data = $query->result_array();
			return $data;
		}
		
		
		
			
	 function addAuction(){
			date_default_timezone_set('Asia/Dhaka');
			$date = date('Y-m-d',time());

			$insert_data= array(
					'c_id' => $this->input->post('c_id'),
					'c_type_id' => $this->input->post('c_type_id'),
					'a_title' => $this->input->post('a_title'),
					'a_desc' => $this->input->post('a_desc'),
					'a_location' => $this->input->post('a_location'),
					'a_start_time' => ($this->input->post('a_start_time'))*60000,
					'a_price' => $this->input->post('a_price'),
					'a_doc' => $date,
					'a_created_by' => $this->session->userdata('user_id')
						);
			if($this->db->insert('tbl_auction',$insert_data)){
				$data['status'] = 'success';
				return $this->db->insert_id();
			}
			else{
				$data['status'] = 'error';
				return FALSE;
			}
			
			
		} 
		
		function add_bid(){
			$insert_data = array(
				'a_id'=> $this->input->post('a_id'),
				'last_price' => $this->input->post('last_price'),
				'sold_by' => $this->session->userdata('user_id'),
				's_ip' => $_SERVER['REMOTE_ADDR']
			);
			if($this->db->insert('tbl_sold_product',$insert_data)){
				$data['status'] = 'success';
				
			}
			else{
				$data['status'] = 'error';
				return FALSE;
			}
			
			$pro = $this->input->post('a_id');
			if($this->input->post('a_status')){
			$a_status=1;
			}
			$insert_data= array(
					'a_status' => $a_status,
					'last_price' => $this->input->post('last_price')
						);
			$this->db->where('a_id', $pro);
			$this->db->update('tbl_auction', $insert_data);
		}
		function doneAuction($a_id){

			$pro = $this->input->post('a_id');
			if($this->input->post('a_status')){
			$a_status=2;
			}
			$insert_data= array(
					'a_status' => $a_status
						);
			$this->db->where('a_id', $pro);
			$this->db->update('tbl_auction', $insert_data);
		}

		function get_category_info(){
		$query= $this->db->select('*')
					->from('tbl_category')
					->order_by('tbl_category.c_id')
					->get();
			
			$data = $query->result_array();
			return $data;
		}
		function get_category_type_info(){
		$query= $this->db->select('*')
					->from('tbl_category,tbl_category_type')
					->where('tbl_category.c_id = tbl_category_type.c_id')
					->get();
			
			$data = $query->result_array();
			return $data;
		}
		
		function addCategory(){
			date_default_timezone_set('Asia/Dhaka');
			$date = date('Y-m-d',time());
			$insert_data= array(
						'c_title' => $this->input->post('c_title'),
						'c_icon' => $this->input->post('c_icon'),
						'c_doc' => $date,
						'c_created_by' => $this->session->userdata('user_id')
						);
			if($this->db->insert('tbl_category',$insert_data)){
				$data['status'] = 'success';
			}
			else{
				$data['status'] = 'error';
				
			}
			
		}
		function addCategoryType(){
			
			$insert_data= array(
						'c_id' => $this->input->post('c_id'),
						'c_type_title' => $this->input->post('c_type_title'),
						'c_type_created_by' => $this->session->userdata('user_id')
						);
			if($this->db->insert('tbl_category_type',$insert_data)){
				$data['status'] = 'success';
			}
			else{
				$data['status'] = 'error';
				
			}
			
		}
		
		
		function get_category_title(){
			$query= $this->db->select('*')
					->from('tbl_category')
					->get();
			$data = $query->result();
			//$row = '';
			$row[''] = 'Select Category';
			if(count($data) > 0){
				foreach($data as $field){
					$row[$field->c_id] = $field->c_title;
				}
			}
			return $row;
			
		}
		
		
		
		function get_categoryType(){
			$query= $this->db->select('*')
										->from('tbl_category_type')
										->get();
			$data = $query->result();
			//$row = '';
			$row[''] = 'Select A Type';
			if(count($data) > 0){
			foreach($data as $field){
				$row[$field->c_type_id] = $field->c_type_title;
			}
			}
			return $row;
				
		}
		
		function get_catType($clsss_id)
		{
				$this -> db -> where('c_id',$clsss_id);
				$query = $this -> db -> get('tbl_category_type');
			return $query;
		}
		
		
		
		//auction edit start
		function get_auction_for_edit($aID){
			$query= $this->db->select('*')
							->from('tbl_auction')
							->where('tbl_auction.a_id',$aID)
							->get();
			$data = $query->row_array();
			return $data;
		}

		function editAuction(){

			$pro = $this->input->post('a_id');
			$insert_data= array(
					'c_id' => $this->input->post('c_id'),
					'c_type_id' => $this->input->post('c_type_id'),
					'a_title' => $this->input->post('a_title'),
					'a_desc' => $this->input->post('a_desc'),
					'a_location' => $this->input->post('a_location'),
					'a_start_time' => ($this->input->post('a_start_time'))*60000,
					'a_price' => $this->input->post('a_price'),
					'a_created_by' => $this->session->userdata('user_id')
						);
			$this->db->where('a_id', $pro);
			$this->db->update('tbl_auction', $insert_data); 

		}


		function editAuctionStatus(){

			$pro = $this->input->post('a_id');
			$insert_data= array(
					'a_status' => $this->input->post('a_status'),
						);
			$this->db->where('a_id', $pro);
			$this->db->update('tbl_auction', $insert_data); 

		}
		//auction edit end
		
		//category start
		function get_category_for_edit($cID){
			$query= $this->db->select('*')
							->from('tbl_category')
							->where('tbl_category.c_id',$cID)
							->get();
			$data = $query->row_array();
			return $data;
		}

		function editCategory(){

			$c_id = $this->input->post('c_id');
			$insert_data= array(
					'c_title' => $this->input->post('c_title'),
					'c_icon' => $this->input->post('c_icon'),
					'c_created_by' => $this->session->userdata('user_id')
						);
			$this->db->where('c_id', $c_id);
			$this->db->update('tbl_category', $insert_data); 

		}
		//category edit end
		//category type start
		function get_categoryType_for_edit($ctypeID){
			$query= $this->db->select('*')
							->from('tbl_category_type')
							->where('tbl_category_type.c_type_id',$ctypeID)
							->get();
			$data = $query->row_array();
			return $data;
		}

		function editCategoryType(){

			$c_type_id = $this->input->post('c_type_id');
			$insert_data= array(
					'c_id' => $this->input->post('c_id'),
					'c_type_title' => $this->input->post('c_type_title'),
					'c_type_created_by' => $this->session->userdata('user_id')
						);
			$this->db->where('c_type_id', $c_type_id);
			$this->db->update('tbl_category_type', $insert_data); 

		}
		//category type edit end
		function get_specific_auction($a){
		$query= $this->db->select('*')
						->from('tbl_auction,tbl_category,tbl_category_type,tbl_users')
						->where('tbl_auction.c_id = tbl_category.c_id')
						->where('tbl_auction.c_type_id = tbl_category_type.c_type_id')
						->where('tbl_auction.a_created_by = tbl_users.user_id')
						->where('tbl_auction.a_title',$a)
						->order_by('tbl_auction.a_title','asc')
						->get();
			
			$data = $query->result_array();
			return $data;
	}
	
	
	function employee_update($email,$data)
	{
  	 
		$this->db->where('email',$email);	
		$this->db->update('employees', $data);
		 
	}
	
	//bid history
	
	
	function get_bid_history(){
		$query= $this->db->select('*')
					->from('tbl_auction,tbl_sold_product,tbl_users')
					->where('tbl_auction.a_id = tbl_sold_product.a_id')
					->where('tbl_sold_product.sold_by = tbl_users.user_id')
					->get();
			
			$data = $query->result_array();

			return $data;
		}	
	function get_bid_history_bidder(){
		
		$bidder = $this->session->userdata('user_id');
		
		$query= $this->db->select('*')
					->from('tbl_auction,tbl_sold_product,tbl_users')
					->where('tbl_auction.a_id = tbl_sold_product.a_id')
					->where('tbl_sold_product.sold_by = tbl_users.user_id')
					->where('tbl_sold_product.sold_by',$bidder)
					->get();
			
			$data = $query->result_array();

			return $data;
		}
	
	//payment
	
	function get_bid_winner(){
		$bidder = $this->session->userdata('user_id');
		$query= $this->db->select('*')
					->from('tbl_auction,tbl_sold_product,tbl_users')
					->where('tbl_auction.last_price = tbl_sold_product.last_price')
					->where('tbl_sold_product.sold_by = tbl_users.user_id')
					->where('tbl_sold_product.sold_by',$bidder)
					->get();
			
			$data = $query->result_array();

			return $data;
		}
	
	function addPay(){
			$insert_data = array(
				'a_id'=> $this->input->post('a_id'),
				'pay_type' => $this->input->post('pay_type'),
				'pay_trx_id' => $this->input->post('pay_trx_id'),
				'pay_num' => $this->input->post('pay_num'),
				'pay_by' => $this->session->userdata('user_id'),
				'p_ip' => $_SERVER['REMOTE_ADDR']
			);
			if($this->db->insert('tbl_payment',$insert_data)){
				$data['status'] = 'success';
				
			}
			else{
				$data['status'] = 'error';
				return FALSE;
			}
			
			$pro = $this->input->post('s_id');
			if($this->input->post('sold_status')){
			$sold_status=1;
			}
			$insert_data= array(
					'sold_status' => $sold_status
						);
			$this->db->where('s_id', $pro);
			$this->db->update('tbl_sold_product', $insert_data);
		}
	
	}

?>