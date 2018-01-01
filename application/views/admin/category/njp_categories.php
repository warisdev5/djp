<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="row">
	<div class="col-md-10">
		<div class="box">
			<div class="box-header with-border">
            	<h3 class="box-title"><?php echo $sub_title?></h3>
            	<?php echo anchor('admin/category/njp_category_add', '<span class="btn-label"><i class="fa fa-plus"></i></span> '. lang('menu_njp_cat_add'), array('class' => 'btn btn-primary btn-labeled btn-flat hidden-print pull-right')); ?>
			</div>
			<div class="box-body">
                
				<table id="record-table" class="table table-striped table-hover table-condensed">
                	<thead>
                    	<tr>
                        	<th>Sr.No</th>
                            <th>Category</th>
                            <th>Court Type</th>
                            <th>Sorting</th>
                            <th class="hidden-print">Action</th>
						</tr>
					</thead>
                                		
					<tbody>
						<?php $i = 1?>
						<?php foreach ($categories as $cat) : ?>
							
							<tr>
								<td><?php echo $i++?></td>
								<td><?php echo $cat->cat_name; ?></td>
								<td><?php echo $cat->court_type; ?></td>
								<td><?php echo $cat->sorting; ?></td>
								<td class="hidden-print"><?php echo anchor('admin/category/njp_category_edit/'.$cat->id, '<i class="fa fa-edit"></i>','class="btn btn-primary btn-sm m-r-5"'); ?></td>
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
	      'lengthChange': true,
	      'searching'   : true,
	      'ordering'    : false,
	      'info'        : true,
	      'autoWidth'   : false
	    });
	});
</script>