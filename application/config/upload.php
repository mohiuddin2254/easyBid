<?php

	 $ci =& get_instance();
	// after you use $ci instead of $this
	if($ci->uri->segment(2)=='addAuction'){
		$config['upload_path'] = '.assets/uploads/a_pic/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
	}
	
	


?>