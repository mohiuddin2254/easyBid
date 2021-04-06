<section class="page-search">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Advance Search -->
				<div class="advance-search">
					<h2>Category</h2>
				</div>
			</div>
		</div>
	</div>
</section>
<!--===================================
=            Store Section            =
====================================-->
<section class="popular-deals section bg-gray">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2>Trending Auction</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas, magnam.</p>
				</div>
			</div>
		</div>
		<div class="row" >
			<!-- offer 01 -->
			<?php
				$i = 1;
				foreach ($cat_info as $au_info):
			?>
				<div class="col-sm-12 col-lg-4">
					<!-- product card -->
					<div class="product-item bg-light">
						
						<div class="card">
							<div class="thumb-content">
								<div class="price">৳<?php echo $au_info['a_price'];?></div>
								<style type="text/css">
									.img-fluid{
											height:200px;}
									.start_times{text-align:center;}
									.btn-group-sm > .btn, .btn-sm {
										padding: .25rem .5rem;
										font-size: .875rem;
										line-height: 1.5;
										border-radius: .2rem;
									}
									
								</style>
								<a href="" >
									<img class="card-img-top img-fluid img-responsive" src="<?php echo base_url().'assets/uploads/a_pic/'.$au_info['a_pic'];?>" alt="<?php echo $au_info['a_id'];?>">
								</a>
								<?php if($au_info['last_price'] != False): ?>	
								<div class="price1">Latest price: ৳<?php echo $au_info['last_price'];?></div>
								<?php endif;?>
							</div>
							<div class="card-body">
								<h4 class="card-title"><a href="<?php echo base_url().'home/auction_info/'.$au_info['a_id'];?>"><?php echo $au_info['a_title'];?></a></h4>
								<ul class="list-inline product-meta">
									<li class="list-inline-item">
										<a href="<?php echo base_url().'home/category_info/'.$au_info['c_id'];?>"><i class="fa fa-folder-open-o"></i><?php echo $au_info['c_title'];?></a>
									</li>
									<li class="list-inline-item">
										<a href=""><i class="fa fa-calendar"> <?php echo date('d F Y', strtotime($au_info['a_doc']));?></i></a>
									</li>
								</ul>
							</div>
							<div class="row">
								<div class="col-md-6">
									
									<div class="time_end">
										<strong class="start_times" id="left_timess<?php echo $au_info['a_id'];?>"></strong>
										<div class="time_end_sold" id="solds<?php echo $au_info['a_id'];?>"></div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="bid_button">
										<?php 
											if(($this->session->userdata('user_id')) && ($this->session->userdata('user_type')) == 'Bidder'){
										?>
										<input type="hidden" name="a_id" ng-model="product" style="display: none;">
										<a id="biddings<?php echo $au_info['a_id'];?>" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#bidNow<?php echo $au_info['a_id'];?>" data-whatever="@mdo">Bid Now</a>
										<?php
											} 
										?>
									</div>
								</div>
								
							</div>

						<div class="modal fade" id="bidNow<?php echo $au_info['a_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

						</div>
						<div class="modal-body">
							<form method="post" action="<?php echo base_url('Home/addBids');?>" enctype='multipart/form-data'>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Price</div>
										<input type="hidden" class="form-control" name="a_id" value="<?php echo $au_info['a_id'];?>">
										<input type="hidden" name="c_id" value="<?php echo $this->uri->segment(3);?>">
										<input type="hidden" class="form-control" name="a_status" value="<?php echo $au_info['a_status'];?>">
										<input type="number" class="form-control" name="last_price" value="<?php echo $au_info['a_price'];?>" required="required">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</form>
						</div>
						
					</div>
				</div>
			</div>
						</div>

						
					</div>
				</div>
			<?php $i++;endforeach;
			?>
			
		</div>
	</div>
</section>
<script>

	var data_info = <?php echo json_encode($cat_info);?>;
		// Set the date we're counting down to
	var i;	
	var k;
	for(i = 0;i<data_info.length;i++){
		k = parseInt(i,10)+1;
		
		//alert(data_info[i].a_dom);
		set_date_time(data_info[i].a_id,data_info[i].a_start_time,data_info[i].a_dom);
		
	}
		
		
		
	function set_date_time(ivalu,interval,start_time){
		//var countDownDate = new Date(start_time).getTime();
		
		var strtTime = new Date(start_time);
		
		strtTime = new Date(strtTime).getTime();

		var endtime = parseInt(strtTime)+parseInt(interval);

		// Update the count down every 1 second
		var x = setInterval(function() {

			//strtTime.setSeconds(strtTime.getSeconds() + 1);
			// Get todays date and time
			var now = new Date().getTime();
			
			
			
			//var now = curTime.getTime();

			// Find the distance between now an the count down date
			var distance = parseInt(endtime) - parseInt(now);
			
			//alert(distance);

			// Time calculations for days, hours, minutes and seconds
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			
			
			// Output the result in an element with id="left_timess"
			/* document.getElementById("left_timess").innerHTML = days + "d " + hours + "h "
			+ minutes + "m " + seconds + "s "; */
			//for( var i = 1; i < 18; i++ ) {
			
			//}
			// If the count down is over, write some text 
			
			if (distance < 0) {
				clearInterval(x);
				document.getElementById("left_timess"+ivalu).innerHTML = '';
				document.getElementById("solds"+ivalu).innerHTML = 'SOLD';
				$('#biddings'+ivalu).hide();
				
			}
			else{
				document.getElementById("left_timess"+ivalu).innerHTML = hours + "h "
			+ minutes + "m " + seconds + "s ";
			}
			
		}, 1000);
	}
</script>