<section class="page-search">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Advance Search -->
				<div class="advance-search">
					<h2>Product Page</h2>
				</div>
			</div>
		</div>
	</div>
</section>
<!--===================================
=            Store Section            =
====================================-->
<?php 
	foreach ($auc_info as $auc_info):
?>
<section class="section bg-gray">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<!-- Left sidebar -->
			<div class="col-md-8">
				<div class="product-details">
					<h1 class="product-title"><?php echo $auc_info['a_title'];?></h1>
					<div class="product-meta">
						<ul class="list-inline">
							<li class="list-inline-item"><i class="fa fa-user-o"></i> By <a href=""><?php echo $auc_info['user_name'];?></a></li>
							<li class="list-inline-item"><i class="fa fa-folder-open-o"></i> Category<a href=""><?php echo $auc_info['c_title'];?></a></li>
							<li class="list-inline-item"><i class="fa fa-location-arrow"></i> Location<a href=""><?php echo $auc_info['a_location'];?></a></li>
							<li class="list-inline-item"><i class="fa fa-location-arrow"></i> Contact<a href=""><?php echo $auc_info['user_num'];?></a></li>
						</ul>
					</div>
					<div id="carouselExampleIndicators" class="product-slider carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img class="d-block w-100 img-responsive" src="<?php echo base_url().'assets/uploads/a_pic/'.$auc_info['a_pic'];?>" alt="First slide">
							</div>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
					<div class="product_desc">
						<p style="align:justify;">
							<?php echo $auc_info['a_desc'];?>
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="sidebar">
					<div class="widget price text-center">
						<h4>Price</h4>
						<p><?php echo $auc_info['a_price'];?></p>
					</div>
					<!-- User Profile widget -->
					<div class="widget user">
						<img class="rounded-circle" src="images/user/user-thumb.jpg" alt="">
						<h4><a href=""><?php echo $auc_info['a_title'];?></a></h4>
						<p class="member-time">Product Since <?php echo date('d F Y', strtotime($auc_info['a_doc']));?></p>
					</div>
					
				</div>
			</div>
			
		</div>
	</div>
	<!-- Container End -->
</section>
<?php
	endforeach;
?>