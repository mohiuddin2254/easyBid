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
				<?php foreach ($bid_winner as $c_info):?>
				<tr>
					<input type="hidden" id="stu_<?php echo $c_info['s_id'];?>" value="<?php echo $c_info['s_id'];?>">
					<td><?php echo $c_info['a_title'];?></td>
					<td><?php echo $c_info['last_price'];?></td>
					<td><?php echo $c_info['s_dom'];?></td>
					<td>
					
						<?php 
							if($c_info['sold_status'] == 0)
							{
								echo '<span style="color:#d9534f;">Not Sold</span>';
							}
							else 
								echo '<span style="color:#5cb85c;">Sold</span>';
						?>
					
					</td>
					<td><?php echo $c_info['user_name'];?></td>
					<td><?php echo $c_info['s_ip'];?></td>
					<?php 
						if($this->session->userdata('user_type') == 'Bidder'){
					?>
					<td>
						<input type="hidden" name="s_id" value="<?php echo $c_info['a_id'];?>" style="display: none;">
						<a type="button" class="btn btn-success" data-toggle="modal" data-target="#givePay<?php echo $c_info['a_id'];?>" data-whatever="@mdo">Give Payment</a>
						<div class="modal fade" id="givePay<?php echo $c_info['a_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="exampleModalLabel">Add Payment</h4>
						</div>
						<div class="modal-body">
							<form  action="<?php echo base_url();?>Payment/addPay" method="post">
								<input type="hidden" class="form-control" name="a_id" value="<?php echo $c_info['a_id'];?>">
								<input type="hidden" class="form-control" name="s_id" value="<?php echo $c_info['s_id'];?>">
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Payment Type</div>
										<select class="form-control" name="pay_type">
											<option value="">Select Type</option>
											<option value="BKash">BKash</option>
											<option value="Cash">Cash</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Pay Trx ID</div>
										<input type="text" class="form-control" name="pay_trx_id" >
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Pay Mobile No</div>
										<input type="text" class="form-control" name="pay_num">
										<input type="hidden" class="form-control" name="sold_status" value="1">
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
					</td>
					<?php 
						} 
					?>
				</tr>
				<?php endforeach;?>
				</tbody>
			</table>




			
		</div>
    </div>
</div>

		
		
<script type="text/javascript">
	
function doconfirm()
{
    job=confirm("Are you sure to delete permanently?");
    if(job!=true)
    {
        return false;
    }
}


</script>