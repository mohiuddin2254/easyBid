<div class="inner-block">
    <div class="blank">
    	<div class="blankpage-main">
		
			<div class="alert alert-success" style="display:none;">
		
			</div>
	
			<?php 
				if($this->session->userdata('user_type') == 'Creator'){
			?>
			<a type="button" class="btn btn-success" data-toggle="modal" data-target="#addAuction" data-whatever="@mdo"  style="margin-bottom:20px;">Add New Action</a>
			<?php
				}
			?>
	

	
			
			
			<div class="modal fade" id="addAuction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="exampleModalLabel">Add New Action</h4>

						</div>
						<div class="modal-body">
							<form method="post" action="<?php echo base_url('Auction/addAuction');?>" enctype='multipart/form-data'>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Category Title</div>
										<?php echo form_dropdown('c_id',$c_title,'',' class="form-control" id="clsss_id"');?>
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<input type="hidden" id="session_show_link" value="<?php echo base_url();?>Auction/get_cat_type">
										<div class="input-group-addon">Category Type</div>
										<?php echo form_dropdown('c_type_id',$pro_info,'',' class="form-control" id="sessin_id"');?>
									</div>
								</div>

								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Auction Title</div>
										<input type="text" class="form-control" name="a_title" required="required">
									</div>
								</div>
								
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Auction Description</div>
										<textarea name="a_desc" class="form-control"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Auction Location</div>
										<input type="text" class="form-control" name="a_location" required="required">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Action Photo</div>
										<input type="file" class="form-control" name="a_pic" required="required">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Start Time</div>
										<input type="text" class="form-control" name="a_start_time" required="required">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Price</div>
										<input type="text" class="form-control" name="a_price" required="required">
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
	

			
			<input type="hidden" id="a_desc" value="<?php echo base_url();?>Auction/get_auction_for_edit">
			<table class="table table-hover table-bordered" id="myTable">
				<thead>
				<tr>
					<th>Category Title</th>
					<th>Category Type</th>
					<th>Auction Title</th>
					<th>Auction Image</th>
					<th>Price</th>
					<th>Date of created</th>
					<?php 
						if(($this->session->userdata('user_type') == 'Creator') OR ($this->session->userdata('user_type') == 'Admin')) {
					?>
					<th>Action</th>
					<?php
						}
					?>
				</tr>
				</thead>
				<tbody id="user_discribe" class="tbody_col">
				<?php foreach ($auc_info as $c_info):?>
				<tr>
					<input type="hidden" id="stu_<?php echo $c_info['a_id'];?>" value="<?php echo $c_info['a_id'];?>">
					<td><?php echo $c_info['c_title'];?></td>
					<td><?php echo $c_info['c_type_title'];?></td>
					<td><?php echo $c_info['a_title'];?></td>
					<td> <img class="img-responsive" style="width:50px; height:50px" src="<?php echo base_url().'assets/uploads/a_pic/'.$c_info['a_pic'];?>" alt="<?php echo $c_info['a_title'];?>"> </td>
					<td><?php echo $c_info['a_price'];?></td>
					<td><?php echo date('d F Y', strtotime($c_info['a_doc']));?></td>
					
					
					<td>
						<?php 
							if($this->session->userdata('user_type') == 'Creator'){
						?>
						<input type="hidden" name="a_id" value="<?php echo $c_info['a_id'];?>" style="display: none;">
						<a type="button" class="btn btn-success" data-toggle="modal" data-target="#editAuction" data-whatever="@mdo">Edit</a>
						<input type="hidden" name="a_id" value="<?php echo $c_info['a_id'];?>" style="display: none;">
						<a type="button" class="btn btn-info" data-toggle="modal" data-target="#editAuctionStatus" data-whatever="@mdo">Edit Status</a>
						<?php 
							} 
						?>
						<?php 
							if($this->session->userdata('user_type') == 'Admin'){
						?>
						<a type="button" class="btn btn-danger" href="<?php echo site_url('auction/deleteAuc/'. $c_info['a_id'].''); ?>" onClick="return doconfirm();">Delete</a>
						<?php 
							} 
						?>
					</td>
					
					
				</tr>
				<?php endforeach;?>
				</tbody>
			</table>
			
			<div class="modal fade" id="editAuction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="exampleModalLabel">Edit Auction</h4>
						</div>
						<div class="modal-body">
							<form  action="<?php echo base_url();?>Auction/editAuction" method="post">
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Category Title</div>
										<?php echo form_dropdown('c_id',$c_title,'',' class="form-control" id="clssss_id"');?>
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<input type="hidden" id="session_show_link" value="<?php echo base_url();?>Auction/get_cat_type">
										<div class="input-group-addon">Category Type</div>
										<?php echo form_dropdown('c_type_id',$pro_info,'',' class="form-control" id="sessins_id"');?>
									</div>
								</div>

								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Auction Title</div>
										<input type="text" class="form-control" name="a_title" id="a_title_id" required="required">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Auction Description</div>
										<textarea name="a_desc" class="form-control" id="a_desc_id"></textarea>
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Auction Location</div>
										<input type="text" class="form-control" name="a_location" id="a_location_id" required="required">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Start Time</div>
										<input type="text" class="form-control" name="a_start_time" placeholder="type minute" required="required">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Price</div>
										<input type="text" class="form-control" name="a_price" id="a_price_id" required="required">
										<input type="hidden" class="form-control" name="a_id" id="a_id2">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Update</button>
								</div>
							</form>
						</div>
						
					</div>
				</div>
			</div>




			<div class="modal fade" id="editAuctionStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="exampleModalLabel">Edit Auction Status</h4>
						</div>
						<div class="modal-body">
							<form  action="<?php echo base_url();?>Auction/editAuctionStatus" method="post">
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Status</div>
										<select class="form-control" id="a2_status" name="a_status">
											<!--<option value="">Select</option>-->
											<option value="1">Show</option>
											<option value="0">Hide</option>
										</select>
										<input type="hidden" class="form-control" name="a_id" id="a_id3">
									</div>
								</div>
								
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Update</button>
								</div>
							</form>
						</div>
						
					</div>
				</div>
			</div>
		</div>
    </div>
</div>

		
		
<script type="text/javascript">

$(document).ready(function() {
	$("#user_discribe tr").click(function(event){
		var a_id = $(this).find('input:hidden').val();
		//alert(user_id);
		var a_desc = $('#a_desc').val();
		$.ajax({
			url: a_desc,
			type: 'POST',
			dataType: 'json',
			data: {'a_id':a_id},
			success:function(result){
				$('#clssss_id').val(result.c_id);
				$('#a2_status').val(result.a_status);
				$('#sessins_id').val(result.c_type_id);
				$('#a_price_id').val(result.a_price);
				$('#a_location_id').val(result.a_location);
				$('#a_desc_id').val(result.a_desc);
				$('#a_title_id').val(result.a_title);
				$('#a_id3').val(result.a_id);
				$('#a_id2').val(result.a_id);
			 },
			error: function (jXHR, textStatus, errorThrown) {html()}
		});

	});
	
});

	
	
function doconfirm()
{
    job=confirm("Are you sure to delete permanently?");
    if(job!=true)
    {
        return false;
    }
}


$(document).ready(function() {
		$('#clsss_id').change(function(){
			var clas_id = $('#clsss_id').val();
			var i;
			var submiturl=$('#session_show_link').val();
			var outputs="";
			//alert(clas_id);
			if(clas_id!=''){
			$.ajax({
				url: submiturl,
				type: 'POST',
				dataType: 'json',
				data: {'c_id':clas_id},
				success:function(result){
				outputs+='<option>Select a Type</option>';
				for(i=0; i<result.length; i++ ){
				  outputs+='<option value="'+result[i].c_type_id+'">'+result[i].c_type_title+'</option>';
				 }
				  $("#sessin_id").html(outputs);
				 },
				error: function (jXHR, textStatus, errorThrown) {}
			});
			}
		});
	});

$(document).ready(function() {
		$('#clssss_id').change(function(){
			var clas_id = $('#clssss_id').val();
			var i;
			var submiturl=$('#session_show_link').val();
			var outputs="";
			//alert(clas_id);
			if(clas_id!=''){
			$.ajax({
				url: submiturl,
				type: 'POST',
				dataType: 'json',
				data: {'c_id':clas_id},
				success:function(result){
				outputs+='<option>Select a Type</option>';
				for(i=0; i<result.length; i++ ){
				  outputs+='<option value="'+result[i].c_type_id+'">'+result[i].c_type_title+'</option>';
				 }
				  $("#sessins_id").html(outputs);
				 },
				error: function (jXHR, textStatus, errorThrown) {}
			});
			}
		});
	});
</script>