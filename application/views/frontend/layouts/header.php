<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $header;?></title>
  

  <!-- Bootstrap -->
  <link href="<?php echo base_url();?>assets/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Owl Carousel -->
  <link href="<?php echo base_url();?>assets/plugins/slick-carousel/slick/slick.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/plugins/slick-carousel/slick/slick-theme.css" rel="stylesheet">
  <!-- Fancy Box -->
  <link href="<?php echo base_url();?>assets/plugins/fancybox/jquery.fancybox.pack.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/plugins/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css" rel="stylesheet">
  <!-- CUSTOM CSS -->
  <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">

  <!-- FAVICON -->
  
  <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.ico" type="image/x-icon">


</head>

<body class="body-wrapper">


<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg  navigation">
					<a class="navbar-brand" href="<?php echo base_url();?>">
						<img src="<?php echo base_url();?>assets/images/logo.png" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto main-nav ">
							<li class="nav-item active">
								<!--<a class="nav-link" href="<?php echo base_url();?>Home">Home</a>-->
							</li>
							<?php 
								if($this->session->userdata('user_id')){
							?>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url();?>Dashboard">Dashboard</a>
							</li>
							<?php
								}
							?>
							<!--<li class="nav-item dropdown dropdown-slide">
								<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Pages <span><i class="fa fa-angle-down"></i></span>
								</a>
								 Dropdown list 
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="<?php //echo base_url();?>Category">Category</a>
									<a class="dropdown-item" href="<?php //echo base_url();?>Single_Category">Single Page</a>
									<a class="dropdown-item" href="">Dashboard</a>
									<a class="dropdown-item" href="">User Profile</a>
								</div>
							</li> -->
						</ul>
						<ul class="navbar-nav ml-auto mt-10">
							<?php 
								if($this->session->userdata('user_id')){
							?>
							<li class="nav-item">
								<a class="nav-link login-button" href="<?php echo base_url();?>Users/logout">
									<span style="color:green;font-weight:bold;">
									( <?php 
										echo $this->session->userdata('user_name');
									?> )
									</span>
									Logout
								</a>
							</li>
							<?php 
								}else{
							?>
							
							<li class="nav-item">
								<a class="nav-link login-button" href="<?php echo base_url();?>Login">Login</a>
							</li>
							
							
							<li class="nav-item">
								<a class="nav-link add-button" href="<?php echo base_url();?>Signup"><i class="fa fa-plus-circle"></i> Sign Up</a>
							</li>
							<?php
								}
							?>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</section>