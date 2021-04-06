<div class="inner-block">
    <div class="blank">
    	<div class="blankpage-main">
		
			<div class="alert alert-success" style="display:none;">
		
			</div>
	
			<?php 
				if($this->session->userdata('user_type') == 'Creator'){
			?>
			<a type="button" class="btn btn-success" data-toggle="modal" data-target="#addCategory" data-whatever="@mdo"  style="margin-bottom:20px;">Add New Category</a>
			<?php
				}
			?>
	

	
			
			
			<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="exampleModalLabel">Add New Category</h4>

						</div>
						<div class="modal-body">
							<form method="post" action="<?php echo base_url('Category/addCategory');?>" enctype='multipart/form-data'>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Title</div>
										<input type="text" class="form-control" name="c_title" required="required">
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Icon</div>
										<input type="text" class="form-control" name="c_icon" title="use font awesome icon name. e.g: fa fa-home" placeholder="fa fa-home" required="required">
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
	

			
			<input type="hidden" id="cat_desc" value="<?php echo base_url();?>Category/get_category_for_edit">
			<table class="table table-hover table-bordered" id="myTable">
				<thead>
				<tr>
					<th>Category Title</th>
					<th>Icon</th>
					<th>Date of created</th>
					<?php 
						if($this->session->userdata('user_type') == 'Creator'){
					?>
					<th>Action</th>
					<?php
						}
					?>
				</tr>
				</thead>
				<tbody id="cat_discribe" class="tbody_col">
				<?php foreach ($c_info as $ca_info):?>
				<tr>
					<input type="hidden" id="stu_<?php echo $ca_info['c_id'];?>" value="<?php echo $ca_info['c_id'];?>">
					<td><?php echo $ca_info['c_title'];?></td>
					<td><?php echo $ca_info['c_icon'];?></td>
					<td><?php echo date('d F Y', strtotime($ca_info['c_doc']));?></td>
					<?php 
						if($this->session->userdata('user_type') == 'Creator'){
					?>
					<td>
					<input type="hidden" name="user_id" value="<?php echo $ca_info['c_id'];?>" style="display: none;">
					<a type="button" class="btn btn-success" data-toggle="modal" data-target="#editCategory" data-whatever="@mdo">Edit</a>
					<a type="button" class="btn btn-danger" href="<?php echo site_url('Category/delCat/'. $ca_info['c_id'].''); ?>" onClick="return doconfirm();">Delete</a>
					</td>
					<?php 
						} 
					?>
					
				</tr>
				<?php endforeach;?>
				</tbody>
			</table>
			
			<div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="exampleModalLabel">Edit Category</h4>
						</div>
						<div class="modal-body">
							<form  action="<?php echo base_url();?>Category/editCategory" method="post">
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Title</div>
										<input type="text" class="form-control" name="c_title" id="c_title_id"/>
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Icon</div>
										<input type="text" class="form-control" name="c_icon"title="use font awesome icon name. e.g: fa fa-home" placeholder="fa fa-home" title="use font awesome icon name. e.g: fa fa-home" placeholder="fa fa-home" id="c_icon_id"/>
										<input type="hidden" name="c_id" id="c_id2">
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
			
			<hr />
			<hr />
			<hr />

			<?php 
				if($this->session->userdata('user_type') == 'Creator'){
			?>
			<a type="button" class="btn btn-success" data-toggle="modal" data-target="#addCategoryType" data-whatever="@mdo"  style="margin-bottom:20px;">Add New Category Type</a>
			<?php
				}
			?>
	

	
			
			
			<div class="modal fade" id="addCategoryType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

							<h4 class="modal-title" id="exampleModalLabel">Add New Category Type</h4>
							
							
						</div>
						<div class="modal-body">
							<form method="post" action="<?php echo base_url('Category/addCategoryType');?>" enctype='multipart/form-data'>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Category Title</div>
										<?php echo form_dropdown('c_id',$c_title,'',' class="form-control"');?>
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Type Title</div>
										<input type="text" class="form-control" name="c_type_title" required="required">
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
	

			
			<input type="hidden" id="catType_desc" value="<?php echo base_url();?>Category/get_categoryType_for_edit">
			<table class="table table-hover table-bordered" id="myTable_type">
				<thead>
				<tr>
					<th>Category Title</th>
					<th>Type</th>
					<th>Date of modification</th>
					<?php 
						if($this->session->userdata('user_type') == 'Creator'){
					?>
					<th>Action</th>
					<?php
						}
					?>
				</tr>
				</thead>
				<tbody id="catType_discribe" class="tbody_col">
				<?php foreach ($c_type_info as $cat_type_info):?>
				<tr>
					<input type="hidden" id="stu_<?php echo $cat_type_info['c_type_id'];?>" value="<?php echo $cat_type_info['c_type_id'];?>">
					<td><?php echo $cat_type_info['c_title'];?></td>
					<td><?php echo $cat_type_info['c_type_title'];?></td>
					<td><?php echo $cat_type_info['c_type_dom'];?></td>

					<td>

					<?php 
						if($this->session->userdata('user_type') == 'Creator'){
					?>
					<input type="hidden" name="user_id" value="<?php echo $cat_type_info['c_type_id'];?>" style="display: none;">
					<a type="button" class="btn btn-success" data-toggle="modal" data-target="#editCategoryType" data-whatever="@mdo">Edit</a>
					<a type="button" class="btn btn-danger" href="<?php echo site_url('asd'. $cat_type_info['c_type_id'].''); ?>" onClick="return doconfirm();">Delete</a>
					
					<?php 
						} 
					?>
					</td>
					
					
				</tr>
				<?php endforeach;?>
				</tbody>
			</table>
			<div class="modal fade" id="editCategoryType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="exampleModalLabel">Edit Category Type</h4>
						</div>
						<div class="modal-body">
							<form  action="<?php echo base_url();?>Category/editCategoryType" method="post">
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Category Title</div>
										<?php echo form_dropdown('c_id',$c_title,'',' class="form-control" id="c_title2"');?>
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Type Title</div>
										<input type="text" class="form-control" name="c_type_title" id="c_type_title2"/>
										<input type="hidden" name="c_type_id" id="c_type_id2">
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
	$("#cat_discribe tr").click(function(event){
		var c_id = $(this).find('input:hidden').val();
		//alert(user_id);
		var cat_desc = $('#cat_desc').val();
		$.ajax({
			url: cat_desc,
			type: 'POST',
			dataType: 'json',
			data: {'c_id':c_id},
			success:function(result){
				$('#c_title_id').val(result.c_title);
				$('#c_icon_id').val(result.c_icon);
				$('#c_id2').val(result.c_id);
			 },
			error: function (jXHR, textStatus, errorThrown) {html()}
		});

	});
	
});

	
$(document).ready(function() {
	$("#catType_discribe tr").click(function(event){
		var c_type_id = $(this).find('input:hidden').val();
		//alert(user_id);
		var catType_desc = $('#catType_desc').val();
		$.ajax({
			url: catType_desc,
			type: 'POST',
			dataType: 'json',
			data: {'c_type_id':c_type_id},
			success:function(result){
				$('#c_title2').val(result.c_id);
				$('#c_type_title2').val(result.c_type_title);
				$('#c_type_id2').val(result.c_type_id);
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