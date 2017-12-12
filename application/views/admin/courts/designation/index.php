<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="row">
	<div class="col-md-8">
		<div class="box">
			<div class="box-header with-border">
            	<h3 class="box-title"><?php echo $sub_title?></h3>
            	<?php echo anchor('admin/courts/add_designation', '<span class="btn-label"><i class="fa fa-plus"></i></span> '. lang('menu_desgn_add'), array('class' => 'btn btn-primary btn-labeled btn-flat hidden-print pull-right')); ?>
			</div>
			<div class="box-body">
                
				<table id="record-table" class="table table-striped table-hover table-condensed">
                	<thead>
                    	<tr>
                        	<th>Sr.No</th>
                            <th>Designation</th>
                            <th>Designation<br>short name</th>
                            <th>Active</th>
                            <th class="hidden-print">Action</th>
						</tr>
					</thead>
                                		
					<tbody>
						<?php $i = 1?>
						<?php foreach ($designations as $desgn) : ?>
							
							<tr>
								<td><?php echo $i++?></td>
								<td><?php echo $desgn->desgn_name; ?></td>
								<td><?php echo $desgn->desgn_short_name; ?></td>
								<td><span class="label <?= (($desgn->active=='Yes') ? 'bg-primary' : 'bg-gray'); ?>"><?php echo $desgn->active;?></span></td>
								<td class="hidden-print"><?php echo anchor('admin/courts/edit_designation/'.$desgn->desgn_id, '<i class="fa fa-edit"></i>','class="btn btn-primary btn-sm m-r-5"'); ?></td>
							</tr>
							
						<?php endforeach; ?>
					</tbody>
					
				</table>
			</div>
		</div>
	</div>
</div>
                    
<script>
	$(document).ready(function(){
	    $('#record-table').DataTable({
	      'paging'      : true,
	      'lengthChange': false,
	      'searching'   : false,
	      'ordering'    : true,
	      'info'        : true,
	      'autoWidth'   : false
	    });
	});
</script>