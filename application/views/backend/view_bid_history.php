<div class="inner-block">
    <div class="blank">
    	<div class="blankpage-main">
	

			<input type="hidden" id="a_desc" value="<?php echo base_url();?>Auction/get_auction_for_edit">
			<table class="table table-hover table-bordered" id="bidHistory">
				<thead>
				<tr>
					<th>Auction Title</th>
					<th>Last Price</th>
					<th>Bid Time</th>
					<th>Bid Status</th>
					<th>Bid By</th>
					<th>IP</th>
					<?php 
						if($this->session->userdata('user_type') == 'Bidder'){
					?>
					<th>Action</th>
					<?php
						}
					?>
				</tr>
				</thead>
				<tbody id="user_discribe" class="tbody_col">
				<?php foreach ($bid_history as $c_info):?>
				<tr>
					<input type="hidden" id="stu_<?php echo $c_info['s_id'];?>" value="<?php echo $c_info['s_id'];?>">
					<td><?php echo $c_info['a_title'];?></td>
					<td><?php echo $c_info['last_price'];?></td>
					<td><?php echo $c_info['s_dom'];?></td>
					<td>
					
						<?php 
							if($c_info['sold_status'] == 0)
							{
								echo '<span style="color:red;">Not Sold</span>';
							}
							else 
								echo '<span style="color:green;">Sold</span>';
						?>
					
					</td>
					<td><?php echo $c_info['user_name'];?></td>
					<td><?php echo $c_info['s_ip'];?></td>
					<?php 
						if($this->session->userdata('user_type') == 'Bidder'){
					?>
					<td>
						<input type="hidden" name="s_id" value="<?php echo $c_info['s_id'];?>" style="display: none;">
						<a type="button" class="btn btn-danger" href="<?php echo site_url('Bid_history/deleteBid/'. $c_info['s_id'].''); ?>" onClick="return doconfirm();">Delete</a>
					</td>
					<?php 
						} 
					?>
				</tr>
				<?php endforeach;?>
				</tbody>
			</table>




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
											<option value="">Select Show/Hide</option>
											<option value="1">Show</option>
											<option value="0">Hide</option>
										</select>
										<input type="hidden" class="form-control" name="s_id" id="s_id3">
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
		var s_id = $(this).find('input:hidden').val();
		//alert(user_id);
		var a_desc = $('#a_desc').val();
		$.ajax({
			url: a_desc,
			type: 'POST',
			dataType: 'json',
			data: {'s_id':s_id},
			success:function(result){
				$('#clssss_id').val(result.c_id);
				$('#a2_status').val(result.a_status);
				$('#sessins_id').val(result.c_type_id);
				$('#a_price_id').val(result.a_price);
				$('#a_location_id').val(result.a_location);
				$('#a_desc_id').val(result.a_desc);
				$('#a_title_id').val(result.a_title);
				$('#s_id3').val(result.s_id);
				$('#s_id2').val(result.s_id);
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