<div class="inner-block">
    <div class="blank">
    	
    	<div class="blankpage-main">
			<?php foreach ($user_data as $user_data):?>
				<div class="row">
					<div class="col-md-3">
						<div class="user-photo">
							<img src="<?php echo base_url()?>assets/uploads/user_pic/default.png" width="80" height="70">
							<!--<a type="button" class="btn btn-success" data-toggle="modal" data-target="#Change" data-whatever="@mdo">Change Image</a>-->
						</div>
						<div class="user-details">
							<h3>Name: <?php echo $user_data['user_name'];?></h3>
							<h4>Type: <?php echo $user_data['user_type'];?></h4>
						</div>
					</div>
					<div class="col-md-9">
						<div class="user-details table-responsive">
							<h2>User Information</h2>
							<input type="hidden" id="pro_desc" value="<?php echo base_url();?>profile/get_profile_for_edit">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Address</th>
										<th>Mobile Number</th>
										<th>Joined Date</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="prof">
									<tr>
										<input type="hidden" id="stu_<?php echo $user_data['user_id'];?>" value="<?php echo $user_data['user_id'];?>">
										<td><address><?php echo $user_data['user_addr'];?></address></td>
										<td><address><?php echo $user_data['user_num'];?></address></td>
										<td><?php echo $user_data['user_doc'];?></td>
										<td><?php 
											if($user_data['user_status'] == 1)
											{
												echo '<span style="color:green;">Active</span>';
											}
											else{
												echo '<span style="color:green;">Inactive</span>';
											}
										?></td>
										<td>
											<input type="hidden" name="user_id" value="<?php echo $user_data['user_id'];?>" style="display: none;">
											<a type="button" class="btn btn-success" data-toggle="modal" data-target="#Edit" data-whatever="@mdo">Edit</a>
										</td>
									</tr>
								</tbody>
							</table>
							
			<div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="exampleModalLabel">Edit Profile</h4>
						</div>
						<div class="modal-body">
							<form  action="<?php echo base_url();?>profile/editProfile" method="post">
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Name</div>
										<input type="text" class="form-control" name="user_name" id="user_name_id" required="required">
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Mobile Number</div>
										<input type="text" name="user_num" id="user_num_id" class="form-control"/>
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Address</div>
										<textarea name="user_addr" id="user_addr_id" class="form-control"></textarea>
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
			<?php endforeach;?>
		</div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$("#prof tr").click(function(event){
		var user_id = $(this).find('input:hidden').val();
		//alert(user_id);
		var pro_desc = $('#pro_desc').val();
		$.ajax({
			url: pro_desc,
			type: 'POST',
			dataType: 'json',
			data: {'user_id':user_id},
			success:function(result){
				$('#user_name_id').val(result.user_name);
				$('#user_num_id').val(result.user_num);
				$('#user_addr_id').val(result.user_addr);
				$('#user_id2').val(result.user_id);
			 },
			error: function (jXHR, textStatus, errorThrown) {html()}
		});

	});
	
});




		
</script>