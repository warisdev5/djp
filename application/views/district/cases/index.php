<?php	defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo $sub_title; ?></h3>
			</div>
                    
			<?php if ( !empty(validation_errors()) )  : ?>
            	<div class="col-sm-8 col-sm-offset-4 text-danger m-b-10">
					<?php if (!empty(validation_errors())) { echo '<strong>Please fill below required field(s).</strong>'; } ?>
					<?php echo $message;?>
				</div>                                    
			<?php endif; ?>
               
			<div class="box-body">
				
				<?php echo form_open(base_url('district/cases/save'),'class="form-horizontal"'); ?>
				<div class="col-sm-8">
                            
					<div class="form-group">
						<label class="col-sm-4 control-label"><?php echo lang("cases_select_judge"); ?></label>
						<div class="col-sm-8">
							<?php 
								$options = array();
								$options[''] = 'Please select...';
								foreach ($courts as $court) {
									$options[$court->id] = $court->judge_name.' '.$court->designation ;
								}
								echo form_dropdown('court_id', $options, 
									isset($item->court)? $item->court_id: set_value('court_id'),
									array('class' => 'form-control select2'));
							?>
							<?php echo form_error('court_id', '<div class="error">', '</div>'); ?>
						</div>
					</div>
						
					<div class="form-group">
						<label class="col-sm-4 control-label"><?php echo lang("cases_select_date"); ?>:</label>
						<div class="col-sm-4">
							<input id="date-of-report" name="heading[date_of_report]" type="text" class="form-control datepicker" placeholder="<?php echo lang("cases_select_date"); ?>">
						</div>
					</div>
				</div>
						
					
						
                        <table id="dataTable" class="table table-striped table-bordered">
                	
                        	<thead>
                        		
                    			<tr>
                        			<th rowspan="2"><?php echo lang('cases_select_category');?></th> 
                    				<th rowspan="2"><?php echo lang('cases_fresh');?></th>
                    				<th class="text-center" colspan="2"><?php echo lang('cases_decided');?></th>
                    				<th class="text-center" colspan="3"><?php echo lang('cases_transfer');?></th>
                    				<th rowspan="2"></th>                   
								</tr>
								<tr>
									<th><?php echo lang('cases_contested');?></th>
                    				<th><?php echo lang('cases_un-contested');?></th>
                    				<th><?php echo lang('cases_transfer_date');?></th>
                    				<th><?php echo lang('cases_transfer_from');?></th>
                    				<th><?php echo lang('cases_transfer_to');?></th>  
								</tr>
								
							</thead>
							
							<tbody>
					
                    			<tr>
                                    <td class="col-md-3">
                                        	
										<?php 
										$options = array();
										$options[''] = 'None';
			                                                        
										foreach ($categories as $cat) {
											$options[$cat->id] = $cat->cat_name;
										}
										echo form_dropdown('heading[category_id][]', $options
											,"",
											array('class' => 'form-control',"id"=>"category_id"));
									?>
									<?php echo form_error('category_id', '<div class="error">', '</div>'); ?>
				
                                    
                                    </td>
                           
	                                <td>
	                                    <input type="number" value="" id="amount" name="heading[amount][]" placeholder="i.e: 123" class="form-control">
	                                </td>
	                                <td><input type="number" name="" value="" id="contested" placeholder="i.e: 123"  class="form-control"></td>
	                                <td><input type="number" name="" value="" id="un-contested" placeholder="i.e: 123"  class="form-control"></td>
	                                <td><input type="text" name="" value="" id="transfer-date" placeholder="i.e: 123"  class="form-control datepicker"></td>
	                                <td><input type="number" name="" value="" id="transfer-from" placeholder="i.e: 123"  class="form-control"></td>
	                                <td><input type="number" name="" value="" id="transfer-to" placeholder="i.e: 123"  class="form-control"></td>
                                
                                	<td class="buttons">
                                		<span class="btn btn-primary btn-sm  btn-add"><i class="fa fa-plus fa-2x "></i></span>
                            		</td>
								</tr>
								
                    		</tbody>
						</table>
					
						
					<div class="form-group">
						<div class="col-sm-6">
							<input type="submit" value="<?php echo lang("cases_save_info"); ?>" class="btn btn-primary">
						</div>
					</div>
                            
				<?php echo form_close(); ?>
                            
			</div>
		</div>
	</div>
</div>

<script>

$(document).ready(function(){
$(".datepicker").datepicker();
$('.select2').select2();

var prevoiusEntry = $("body").find('tbody tr:first');

$(document).on("click",".btn-add",function(){

    if($("#heading").val()==""){
        alert("Heading Cannot be empty");
        return false;
    }
    
        var controlForm = $('tbody'),
            currentEntry = $(this).parents('tbody tr:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('tr:not(:last) .buttons .btn-add')
            .removeClass('btn-add btn-primary').addClass('btn-remove btn-danger')
            .find(".fa-plus").removeClass("fa-plus").addClass("fa-remove");
    
    
}).on('click','.btn-remove', function()
    {
		$(this).parents('tr').remove();

		
	});
        
       $(".heading").on("change",function(){
           $("tbody").html(prevoiusEntry);
  waitingDialog.show("Please wait...");
  var controlForm = $('tbody'),
            currentEntry = $("body").find('tbody tr:first');
            var newEntry="";
       $.ajax({
           type:"POST",
           url:"<?php echo base_url("district/cases/getJsonReport"); ?>",
           data:{date_of_report:$("#date-of-report").val(),type_id:$("#heading").val(),court_id:9},
           success:function(data){

$.each(data,function(i,e){
 
            newEntry = $(currentEntry.clone()).prependTo(controlForm);
            newEntry.find('select option[value="'+e.category_id+'"]').attr("selected","selected");
newEntry=newEntry
        .find("#amount").val(e.amount);

      
        controlForm.find('tr:not(:last) .buttons .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .find(".fa-plus").removeClass("fa-plus").addClass("fa-remove");
    
});



    waitingDialog.hide();
           },
           dataType:"JSON",
   
    error: function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        console.log(msg);
    },
       })
       
       
   })
  
function freez(){
    $("#heading").attr("disabled",true);
    $("#date-of-report").attr("disabled",true);
}

});



var waitingDialog = waitingDialog || (function ($) {
    'use strict';

	
	var $dialog = $(
		'<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
		'<div class="modal-dialog modal-m">' +
		'<div class="modal-content">' +
			'<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
			'<div class="modal-body">' +
				'<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
			'</div>' +
		'</div></div></div>');

	return {
		
		show: function (message, options) {
			
			if (typeof options === 'undefined') {
				options = {};
			}
			if (typeof message === 'undefined') {
				message = 'Loading';
			}
			var settings = $.extend({
				dialogSize: 'm',
				progressType: '',
				onHide: null 
			}, options);

		
			$dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
			$dialog.find('.progress-bar').attr('class', 'progress-bar');
			if (settings.progressType) {
				$dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
			}
			$dialog.find('h3').text(message);
		
			if (typeof settings.onHide === 'function') {
				$dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
					settings.onHide.call($dialog);
				});
			}
		
			$dialog.modal();
		},
		
		hide: function () {
			$dialog.modal('hide');
		}
	};

})(jQuery);


</script>