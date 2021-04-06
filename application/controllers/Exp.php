<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exp extends CI_Controller{
	function __construct(){
		parent:: __construct();
	
	}
	public function index()
	{
		echo "this is example"; 
	}


	public function add($value="")
	{
		echo $this->uri->segment(3);
	}

	
	
	
}
?>