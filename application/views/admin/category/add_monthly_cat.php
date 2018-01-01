<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!isset($item))
{
	$item = new stdClass();
	$item->id=0;
	$item->cat_name='';
	$item->court_type_id='';
	$item->cat_id='';
	$item->sorting='';
}
?>

<div class="row">
	<div class="col-md-6">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo $sub_title;?></h3>
			</div>
			
			<?php echo form_open(base_url('admin/category/monthly_category_save'), array( "class" => "form-horizontal", "data-toggle" => "validator")); ?>

			<div class="box-body">
			
				<?php if ( !empty(validation_errors()) )  : ?>
                	<div class="col-sm-8 col-sm-offset-4 text-danger m-b-10">
					<?php if (!empty(validation_errors())) { echo '<strong>Please fill below required field(s).</strong>'; } ?>
				</div>                                    
                <?php endif; ?>
		
				<div class="form-group">
					<label class="col-sm-4 control-label">Category Name *</label>
					<div class="col-sm-6">
						<input type="text" value="<?php echo set_value('cat_name', $item->cat_name);?>" name="cat_name" required class="form-control" placeholder="Category..." autofocus maxlength="50">
						<?php echo form_error('cat_name', '<div class="error">', '</div>'); ?>
						<div class="help-block with-errors"></div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label">Court Type *</label>
					<div class="col-sm-8">
						<div class="input-group">
							<div class="btn-group radio-group">
								<label class="btn btn-success <?php if($item->court_type_id != 1){ echo 'not-active'; } ?>">Sessions<input type="radio" name="court_type_id" class="hidden" value="1" required <?php if($item->court_type_id==1){echo 'checked';}?> ></label>
	                			<label class="btn btn-info <?php if($item->court_type_id != 2){ echo 'not-active'; } ?>"> Civil <input type="radio" name="court_type_id" class="hidden" value="2" <?php if($item->court_type_id==2){echo 'checked';}?> ></label>
							</div>
						</div>
						<div class="help-block with-errors"></div>
						<?php echo form_error('case_type_id', '<div class="error">', '</div>'); ?>
					</div>
				</div>
								
				<div class="form-group">
					<label class="col-sm-4 control-label">Category</label>
					<div class="col-sm-6">
						<select name="cat_id" id="cat_id" required class="form-control select2 col-sm-4">
							<option value="#">Please select...</option>
						</select>
						<?php echo form_error('cat_id', '<div class="error">', '</div>'); ?>
						<div class="help-block with-errors"></div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label" for="sorting">Sorting order by</label>
					<div class="col-sm-3">
						<input type="number" value="<?php echo set_value('sorting', $item->sorting);?>" name="sorting" placeholder="ex. 123" class="form-control" maxlength="10">
						<?php echo form_error('sorting', '<div class="error">', '</div>'); ?>
					</div>
				</div>
				
		        <input type="hidden" name="id" value="<?php echo set_value('id',$item->id); ?>">
		        
			</div>
		
			<div class="box-footer">
				<div class="col-sm-8 col-sm-offset-4">
					<div class="btn-group">
						<button type="submit" class="btn btn-labeled btn-primary m-r-5"><span class="btn-label"><i class="fa fa-save"></i></span>Save</button>
                    	<?php echo anchor('admin/category/monthly_categories', lang('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
                    </div>
				</div>
			</div>

			<?php echo form_close();?>
			
		</div>
	</div>
</div>

<script>
$(document).ready(function(){

	$('.form-horizontal').validator();
	
	$('.radio-group label').on('click', function(){
        $(this).removeClass('not-active').siblings().addClass('not-active');
    });
    	
	$('.select2').select2();

	var base_url = "<?php echo base_url();?>";

	function getCategoriesByCourtType() {

		var court_Type = $("input[name='court_type_id']:checked").val();
		 
		 var courtType = {
				 'court_type_id' : court_Type
			};

		 $.ajax({
	            type: "POST",
	            url: base_url+"admin/category/getCategoriesByCourtType/",
	            data: courtType,

	            success: function(data)
	            {
	            	console.log(data);
	            	
	            	var categories = JSON.parse(data);

	            	

	            	$('#cat_id').html('');

					var opt = $('<option>');
					opt.val('');
					opt.text('Please select...');
					$('#cat_id').append(opt);
	                
	                $.each(categories,function(id, cat)
	                {
	                    var opt = $('<option>');
	                    opt.val(cat.id);
	                    opt.text(cat.cat_name+' ('+cat.case_type+')');
	                    $('#cat_id').append(opt);
	                });
	            }

	        });
		
	}
	
	$("input[name='court_type_id']").on('click', function(){
		getCategoriesByCourtType();
    });
	getCategoriesByCourtType();
});
</script>