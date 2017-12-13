<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!isset($item))
{
	$item = new stdClass();
	$item->judge_id=0;
	$item->judge_name='';
	$item->desgn_id='';
	$item->date_of_birth='';
	$item->date_of_joining='';
	$item->date_of_retirement='';
	$item->domicile_id='';
	$item->gender='Male';
	$item->seniority='';
}
?>

<div class="row">
	<div class="col-md-6">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo $sub_title;?></h3>
			</div>
			
			<?php echo form_open(base_url('admin/courts/save_judge'),'class="form-horizontal"'); ?>

			<div class="box-body">
			
				<?php if ( !empty(validation_errors()) )  : ?>
                	<div class="col-sm-8 col-sm-offset-4 text-danger m-b-10">
					<?php if (!empty(validation_errors())) { echo '<strong>Please fill below required field(s).</strong>'; } ?>
				</div>                                    
                <?php endif; ?>
		
				<div class="form-group">
					<label class="col-sm-4 control-label">Judge Name *</label>
					<div class="col-sm-6">
						<input type="text" value="<?php echo set_value('judge_name', $item->judge_name);?>" name="judge_name" class="form-control" placeholder="Judge name..." autofocus maxlength="100">
						<?php echo form_error('judge_name', '<div class="error">', '</div>'); ?>
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="col-sm-4 control-label">Designation</label>
					<div class="col-sm-6">
						<?php 
							$options = array();
							$options[''] = 'Please select...';
							foreach ($designations as $desgn) {
								$options[$desgn->desgn_id] = $desgn->desgn_name;
							}
							echo form_dropdown('desgn_id', $options, 
								isset($item->desgn_id)? $item->desgn_id: set_value('desgn_id'),
								array('class' => 'form-control select2 col-sm-4'));
						?>
						<?php echo form_error('desgn_id', '<div class="error">', '</div>'); ?>
					</div>
				</div>
				
				<div class="form-group">
                	<label class="col-sm-4 control-label">Date of Birth:</label>
                	<div class="col-sm-6">
                		<div class="input-group date">
                  			<div class="input-group-addon">
                    			<i class="fa fa-calendar"></i>
                  			</div>
                  			<input type="text" value="<?php echo set_value('date_of_birth', $item->date_of_birth);?>" name="date_of_birth"  class="form-control pull-right" id="datepicker-1">
              			</div>
              		</div>
              	</div>
              	
              	<div class="form-group">
                	<label class="col-sm-4 control-label">Date of Joining:</label>
                	<div class="col-sm-6">
                		<div class="input-group date">
                  			<div class="input-group-addon">
                    			<i class="fa fa-calendar"></i>
                  			</div>
                  			<input type="text" value="<?php echo set_value('date_of_joining', $item->date_of_joining);?>" name="date_of_joining"  class="form-control pull-right" id="datepicker-2">
              			</div>
              		</div>
              	</div>
              	
              	<div class="form-group">
                	<label class="col-sm-4 control-label">Date of Retirement:</label>
                	<div class="col-sm-6">
                		<div class="input-group date">
                  			<div class="input-group-addon">
                    			<i class="fa fa-calendar"></i>
                  			</div>
                  			<input type="text" value="<?php echo set_value('date_of_retirement', $item->date_of_retirement);?>" name="date_of_retirement"  class="form-control pull-right" id="datepicker-3">
              			</div>
              		</div>
              	</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label">Domicile District</label>
					<div class="col-sm-6">
						<?php 
							$options = array();
							$options[''] = 'Please select...';
							foreach ($cities as $city) {
								$options[$city->id] = $city->city_name;
							}
							echo form_dropdown('domicile_id', $options, 
								isset($item->domicile_id)? $item->domicile_id: set_value('domicile_id'),
								array('class' => 'form-control select2 col-sm-4'));
						?>
						<?php echo form_error('domicile_id', '<div class="error">', '</div>'); ?>
					</div>
				</div>

                <div class="form-group">
					<label class="col-sm-4 control-label" for="active">Gender</label>
					<div class="col-sm-8">
						<div class="input-group">
							<div class="btn-group radio-group">
								<label class="btn btn-success <?php if($item->gender != 'Male'){ echo 'not-active'; } ?>"> Male <input type="radio" name="gender" class="hidden" value="Male" <?php if($item->gender=='Male'){echo 'checked';}?>></label>
	                			<label class="btn btn-primary <?php if($item->gender != 'Female'){ echo 'not-active'; } ?>"> Female <input type="radio" name="gender" class="hidden" value="Female" <?php if($item->gender=='Female'){echo 'checked';}?>></label>
							</div>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label" for="sorting">Seniority #</label>
					<div class="col-sm-3">
						<input type="number" value="<?php echo set_value('seniority', $item->seniority);?>" name="seniority" placeholder="ex. 123" class="form-control" maxlength="10">
						<?php echo form_error('seniority', '<div class="error">', '</div>'); ?>
					</div>
				</div>
				
		        <input type="hidden" name="judge_id" value="<?php echo set_value('judge_id',$item->judge_id); ?>">
		        
			</div>
		
			<div class="box-footer">
				<div class="col-sm-8 col-sm-offset-4">
					<div class="btn-group">
						<button type="submit" class="btn btn-labeled btn-primary m-r-5"><span class="btn-label"><i class="fa fa-save"></i></span>Save</button>
                    	<?php echo anchor('admin/courts/judges', lang('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
                    </div>
				</div>
			</div>

			<?php echo form_close();?>
			
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	
	$('.radio-group label').on('click', function(){
        $(this).removeClass('not-active').siblings().addClass('not-active');
    });
    	
	$('.select2').select2();

    $('#datepicker-1, #datepicker-2,#datepicker-3').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
    });
});
</script>