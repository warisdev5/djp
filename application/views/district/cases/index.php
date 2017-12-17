<?php	defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo $sub_title; ?></h3>
				<?php echo anchor('district/users/create', '<span class="btn-label"><i class="fa fa-plus"></i></span> '. lang('users_create_user'), array('class' => 'btn btn-primary btn-labeled btn-flat hidden-print pull-right')); ?>
			</div>
			<div class="box-body">
                           <table id="dataTable" class="table table-striped table-bordered table-hover">
                	
                                    <thead>
                                        <tr>
                                            <th><?php echo lang("cases_select_date"); ?>:</th>
                                            <th> <input type="text" class="form-control datepicker" placeholder="<?php echo lang("cases_select_date"); ?>">
                                            </th>
                                        </tr>
                    	<tr>
                        	<th><?php echo lang('cases_select_category');?></th>
                    <th>
                        <?php echo lang('cases_select_for_what');?>
                    </th>  
                    <th><?php echo lang('cases_select_amount');?></th>
                    
                    <td> 
                    </td>
						</tr>
					</thead>
					<tbody>
					
                    	<tr>
                                    <td><select value="" class="form-control" >
                                            <option value="">--<?php echo lang('cases_select_category');?>--</option>
                                            <option value="">VALUE 1</option>
                                            <option value="">VALUE 2</option>
                                            <option value="">VALUE 3</option>
                                            <option value="">VALUE 4</option>

                                </select></td>
                                
                                 <td><select value="" class="form-control" >
                                            <option value="">--<?php echo lang('cases_select_for_what');?>--</option>
                                            <option value="">VALUE 1</option>
                                            <option value="">VALUE 2</option>
                                            <option value="">VALUE 3</option>
                                            <option value="">VALUE 4</option>

                                </select></td>
                                
                           
                                
                                <td>
                                    <input type="number" value="" placeholder="<?php echo lang('cases_select_amount');?>" class="form-control">
                                </td>
                                
                                <td class="buttons">
                                <span class="btn btn-danger btn-sm  btn-add"><i class="fa fa-plus fa-2x "></i></span>
                            	<?php // echo anchor('district/users/edit/', '<i class="fa fa-plus"></i>','class="btn btn-primary btn-sm m-r-5"'); ?>
                            	<?php // echo anchor('district/users/profile/', '<i class="fa fa-eye"></i>','class="btn btn-info btn-sm"'); ?>
                            </td>
						</tr>
                                                
					
                                                
                    </tbody>
                    <tfoot>
                    <th colspan="15">
                        <div class="form-group">
                                <input type="submit" value="<?php echo lang("cases_save_info"); ?>" class="btn form-control btn-lg btn-info">
                                
                            </div>
                    </th>
                    </tfoot>
				</table>
                            
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
$(".datepicker").datepicker();

$(document).on("click",".btn-add",function(){
  
    
        var controlForm = $('tbody'),
            currentEntry = $(this).parents('tbody tr:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('tr:not(:last) .buttons .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .find(".fa-plus").removeClass("fa-plus").addClass("fa-remove");
}).on('click','.btn-remove', function()
    {
		$(this).parents('tr').remove();

		
	});


});
</script>