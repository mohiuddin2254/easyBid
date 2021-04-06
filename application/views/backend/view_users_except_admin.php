<div class="inner-block">
    <div class="blank">
    	<div class="blankpage-main">	
			
			<input type="hidden" id="user_desc" value="<?php echo base_url();?>Users_control/get_user_for_status">
			<table class="table table-hover table-bordered" id="myTable">
				<thead>
				<tr>
					<th>Type</th>
					<th>Name</th>
					<th>Email</th>
					<th>Photo</th>
					<th>Approve Status</th>
					<?php 
						if($this->session->userdata('user_type') == 'Admin'){
					?>
					<th>Action</th>
					<?php
						}
					?>
				</tr>
				</thead>
				<tbody id="user_discribe" class="tbody_col">
				<?php foreach ($user_info as $user_info):?>
				<tr>
					<input type="hidden" id="stu_<?php echo $user_info['user_id'];?>" value="<?php echo $user_info['user_id'];?>">
					<td><?php echo $user_info['user_type'];?></td>
					<td><?php echo $user_info['user_name'];?></td>
					<td><?php echo $user_info['user_email'];?></td>
					<td>
					<?php if($user_info['user_status'] == null) {?>
						<img src="<?php echo base_url().'uploads/user_pic/'.$user_info['user_pic'];?>" width="80" height="70">
					
					<?php } else{
					?>
						<img src="<?php echo base_url()?>assets/uploads/user_pic/default.png" width="80" height="70">
					<?php } ?>
					</td>
					<td>
					<?php 
						if($user_info['user_status'] == 0)
							{
								echo '<span style="color:#d9534f;">Cancel</span>';
							}
							else 
								echo '<span style="color:#5cb85c;">Approved</span>';
					?>
					<?php 
						if($this->session->userdata('user_type') == 'Admin'){
					?>
					<input type="hidden" name="user_id" value="<?php echo $user_info['user_id'];?>" style="display: none;">
					<a type="button" class="btn btn-success" data-toggle="modal" data-target="#editStatus" data-whatever="@mdo">Edit</a>
					<?php 
						} 
					?>
					

					</td>
					<?php 
						if($this->session->userdata('user_type') == 'Admin'){
					?>
					<td>
						
						<a type="button" class="btn btn-danger" href="<?php echo site_url('Users_control/delUser/'. $user_info['user_id'].''); ?>" onClick="return doconfirm();">Delete</a>
					
					
					</td>
					
					<?php 
						} 
					?>
					
					
				</tr>
				<?php endforeach;?>
				</tbody>
			</table>
			
			
			
		
			
			<div class="modal fade" id="editStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="exampleModalLabel">Edit Status</h4>
						</div>
						<div class="modal-body">
							<form  action="<?php echo base_url();?>Users_control/editUserStatus" method="post">
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Status</div>
										<select name="user_status" class="form-control" id="user_status_id">
											<option value="1">Approved</option>
											<option value="0">Cancel</option>
										</select>
										
										<input type="hidden" name="user_id" id="user_id2">
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
		var user_id = $(this).find('input:hidden').val();
		//alert(user_id);
		var user_desc = $('#user_desc').val();
		$.ajax({
			url: user_desc,
			type: 'POST',
			dataType: 'json',
			data: {'user_id':user_id},
			success:function(result){
				$('#user_status_id').val(result.user_status);
				$('#user_id2').val(result.user_id);
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

</script>