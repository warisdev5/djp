<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!isset($item))
{
	$item = new stdClass();
	$item->id=0;
	$item->court_number='';
	$item->judge_id='';
	$item->court_type_id='';
	$item->city_id='';
	$item->user_id='';
	$item->sorting='';
}

// 	echo '<pre>';
// 	var_dump($cities);
// 	die();

?>

<div class="row">
	<div class="col-md-6">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo $sub_title;?></h3>
			</div>
			
			<?php echo form_open(base_url('admin/courts/save_court'),'class="form-horizontal"'); ?>

			<div class="box-body">
			
			<div class="color-palette-set">
				<div class="alert  alert-dismissible bg-light-blue disabled color-palette">
					
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
					<h4><i class="icon fa fa-info"></i> Important alert!</h4>
					If judge have transfer from this court number please only change judge name!
				</div>
			</div>
			
				<?php if ( !empty(validation_errors()) )  : ?>
                	<div class="col-sm-8 col-sm-offset-4 text-danger m-b-10">
					<?php if (!empty(validation_errors())) { echo '<strong>Please fill below required field(s).</strong>'; } ?>
				</div>                                    
                <?php endif; ?>
                
                <div class="form-group">
                	<label class="col-sm-4 control-label">Court Number</label>
                	<div class="col-sm-6">
                		<input type="text" name="court_number" value="<?php echo $item->court_number; ?>" <?php echo ($item->id!=0)? 'disabled' : null; ?> placeholder="Lahore-1" maxlength="30" class="form-control">
                		<?php echo form_error('court_number', '<div class="error">', '</div>'); ?>
                	</div>
                </div>
						
				<div class="form-group">
					<label class="col-sm-4 control-label">Judge Name</label>
					<div class="col-sm-6">
						<?php 
							$options = array();
							$options[''] = 'Please select...';
							foreach ($judgesNames as $judge) {
								$options[$judge->id] = $judge->judge_name.' '.$judge->designation ;
							}
							echo form_dropdown('judge_id', $options, 
								isset($item->judge_id)? $item->judge_id: set_value('judge_id'),
								array('class' => 'form-control select2 col-sm-4'));
						?>
						<?php echo form_error('judge_id', '<div class="error">', '</div>'); ?>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label" for="active">Type of Court</label>
					<div class="col-sm-8">
						<div class="input-group">
							<div class="btn-group radio-group">
								<label class="btn btn-success <?php if($item->court_type_id != '1'){ echo 'not-active'; } ?>"> Sesssions <input type="radio" name="court_type_id" class="hidden" value="1" <?php if($item->court_type_id=='1'){echo 'checked';}?>></label>
	                			<label class="btn btn-primary <?php if($item->court_type_id != '2'){ echo 'not-active'; } ?>"> Civil <input type="radio" name="court_type_id" class="hidden" value="2" <?php if($item->court_type_id=='2'){echo 'checked';}?>></label>
							</div>
						</div>
						<?php echo form_error('court_type_id', '<div class="error">', '</div>'); ?>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label">Main City</label>
					<div class="col-sm-6">
						
					<select class="form-control" name="main-city">
						<?php 
						foreach($maincities as $result){
							$selected='';
							if($result->tehsil_id == $item->city_id){
								$selected="selected='selected'";
							}
						?>
							<option value="<?php echo $result->tehsil_id; ?>" <?php echo $selected; ?>><?php echo $result->tehsil_name; ?></option>
							
						<?php 
						};
						?>
						
					</select>
						
						<?php echo form_error('main-city', '<div class="error">', '</div>'); ?>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label">City</label>
					<div class="col-sm-6">
						<?php 
							$options = array();
							$options[''] = 'Please select...';
							foreach ($cities as $city) {
								$options[$city->id] = $city->city_name;
							}
							echo form_dropdown('city_id', $options, 
								isset($item->city_id)? $item->city_id: set_value('city_id'),
								array('class' => 'form-control select2 col-sm-4', 'id' => 'city_id' ));
						?>
						
						<?php echo form_error('city_id', '<div class="error">', '</div>'); ?>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label">Tehsil</label>
					<div class="col-sm-6">
						<select name="teh_id" id="tehsils" class="form-control select2 col-sm-4">
							<option value="#">Please select...</option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label">User Name</label>
					<div class="col-sm-6">
						<?php 
							$options = array();
							$options[''] = 'Please select...';
							foreach ($users as $user) {
								$options[$user->id] = $user->first_name.' '.$user->last_name. ' ('.$user->email.')';
							}
							echo form_dropdown('user_id', $options, 
								isset($item->user_id)? $item->user_id: set_value('user_id'),
								array('class' => 'form-control select2 col-sm-4'));
						?>
						<?php echo form_error('user_id', '<div class="error">', '</div>'); ?>
					</div>
				</div>
              					
				<div class="form-group">
					<label class="col-sm-4 control-label" for="sorting">Sorting order #</label>
					<div class="col-sm-3">
						<input type="number" value="<?php echo set_value('sorting', $item->sorting);?>" name="sorting" placeholder="ex. 123" class="form-control" maxlength="10">
						<?php echo form_error('sorting', '<div class="error">', '</div>'); ?>
					</div>
				</div>
				
		        <input type="hidden" name="id" value="<?php echo set_value('id',$item->id); ?>">
		        <input type="hidden" name="courtNumber" value="<?php echo $item->court_number; ?>">
		        
			</div>
		
			<div class="box-footer">
				<div class="col-sm-8 col-sm-offset-4">
					<div class="btn-group">
						<button type="submit" class="btn btn-labeled btn-primary m-r-5"><span class="btn-label"><i class="fa fa-save"></i></span>Save</button>
                    	<?php echo anchor('admin/courts', lang('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
                    </div>
				</div>
			</div>

			<?php echo form_close();?>
			
		</div>
	</div>
</div>
<script>
$(document).ready(function(){

	var base_url = "<?php echo base_url();?>";
	
	$('.radio-group label').on('click', function(){
        $(this).removeClass('not-active').siblings().addClass('not-active');
    });
    	
	$('.select2').select2();

	$('#city_id').change(function() {

		var city_id = $(this).val();

         var city = {
				  'city_id' : city_id
		};

		$.ajax({
            type: "POST",
            url: base_url+"admin/districts/getCityByParentId/",
            data: city,
           
            success: function(data)
            {
                
            	var cities = JSON.parse(data);

            	$('#tehsils').html('');

				var opt = $('<option>');
				opt.val('');
				opt.text('Please select...');
				$('#tehsils').append(opt);
                
                $.each(cities,function(id, city)
                {
                    var opt = $('<option>');
                    opt.val(city.id);
                    opt.text(city.city_name);
                    $('#tehsils').append(opt);
                });
            }

        });


	});
});
</script>