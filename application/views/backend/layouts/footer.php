
<!--inner block end here-->
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	 <p>&copy; <?php echo date('Y')?> Auction | Design by  <a href="" target="_blank">Easy Bid</a> </p>
</div>	
<!--COPY rights end here-->
</div>
</div>
<!--slider menu-->
    <div class="sidebar-menu">
		  	<div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#"> <span id="logo" ></span> 
			  </a> </div>		  
		    <div class="menu">
		       <ul id="menu" >
				<?php 
					if($this->session->userdata('user_type') == 'Admin'){
				?>
		        <li id="menu-home" ><a href="<?php echo base_url();?>dashboard"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
		        <li><a href="<?php echo base_url();?>Admin"><i class="fa fa-user"></i><span>Admin</span></a></li>
		        <li><a href="<?php echo base_url();?>All_User"><i class="fa fa-user"></i><span>All Users</span></a></li>
				<?php 
					}
				?>
				<?php 
					if($this->session->userdata('user_type') == 'Creator'){
				?>
				<li><a href="<?php echo base_url();?>users_control/users_creator"><i class="fa fa-user"></i><span>Users(Auction Creator)</span></a></li>			
				<?php 
					}
				?>
				<?php 
					if(($this->session->userdata('user_type') == 'Creator')OR($this->session->userdata('user_type') == 'Bidder')){
				?>
				<li><a href="<?php echo base_url();?>users_control/users_bidder"><i class="fa fa-user"></i><span>Users(Bidder)</span></a></li>			
				 <?php 
					}
				?>
				
				<?php 
					if(($this->session->userdata('user_type') == 'Admin')OR($this->session->userdata('user_type') == 'Creator')){
				?>
				<li><a href="<?php echo base_url();?>Category"><i class="fa fa-user"></i><span>Category</span></a></li>			
				<li><a href="<?php echo base_url();?>Auction"><i class="fa fa-user"></i><span>Auction</span></a></li>			
				<li><a href="<?php echo base_url();?>Bid_history"><i class="fa fa-history"></i><span>Bid History</span></a></li>			
				<?php 
					}
				?>
				<?php 
					if($this->session->userdata('user_type') == 'Bidder'){
				?>
				<li><a href="<?php echo base_url();?>Bid_history/bidder"><i class="fa fa-history"></i><span>Bid History</span></a></li>			
				<li><a href="<?php echo base_url();?>Payment"><i class="fa fa-trophy"></i><span>Bid Winner</span></a></li>			
				<?php 
					}
				?>
		      </ul>
		    </div>
	 </div>
	<div class="clearfix"> </div>
</div>
<!--slide bar menu end here-->
<script>
var toggle = true;
            
$(".sidebar-icon").click(function() {                
  if (toggle)
  {
    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({"position":"absolute"});
  }
  else
  {
    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
    setTimeout(function() {
      $("#menu span").css({"position":"relative"});
    }, 400);
  }               
                toggle = !toggle;
            });
			
		$(document).ready(function(){
			$('#myTable').DataTable();
		});	
		$(document).ready(function(){
			$('#myTable_type').DataTable();
		});
			
		$(document).ready(function(){
			$('#bidHistory').DataTable();
		});
					
			
</script>
<!--scrolling js-->
		<script src="<?php echo base_url();?>assets/backend/js/jquery.nicescroll.js"></script>
		<script src="<?php echo base_url();?>assets/backend/js/scripts.js"></script>
		<!--//scrolling js-->
<script src="<?php echo base_url();?>assets/backend/js/bootstrap.js"> </script>
<script src="<?php echo base_url();?>assets/backend/js/jquery.dataTables.min.js"> </script>
<script src="<?php echo base_url();?>assets/backend/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>assets/backend/js/my.js"> </script>
<!-- mother grid end here-->
</body>
</html>


                      
						
