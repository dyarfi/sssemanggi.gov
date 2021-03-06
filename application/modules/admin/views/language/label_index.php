<div class="container">
    <div role="grid" class="dataTables_wrapper" id="sample_1_wrapper">						
		<!--div class="table-scrollable"-->
		<div class="table">
		    <?php
			// Form for changing data status
			echo form_open_multipart(ADMIN.$class_name.'/change');
		    ?>
		    <table id="sample_2" class="table table-striped table-bordered table-hover dataTable" aria-describedby="sample_2_info">
		    <thead>
			<tr role="row">
			<th class="table-checkbox sorting_disabled" role="columnheader" rowspan="1" colspan="1" style="width: 20px;" aria-label=" "><input type="checkbox" data-set="#sample_2 .checkboxes" class="group-checkable">
			</th>
			<th class="sorting" role="columnheader" tabindex="1" aria-controls="sample_2" rowspan="1" colspan="1" style="width: 150px;" aria-label="Email : activate to sort column ascending">Name
			</th>
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" style="width: 120px;" aria-label="Url : activate to sort column ascending">Url
			</th>
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" style="width: 120px;" aria-label="Username : activate to sort column ascending">Prefix
			</th>
			<!--th class="sorting_disabled" role="columnheader" tabindex="2" aria-controls="sample_2" rowspan="1" colspan="1" style="width: 90px;">Default
			</th-->
			<th class="sorting_disabled" role="columnheader" tabindex="2" aria-controls="sample_2" rowspan="1" colspan="1" style="width: 90px;">Site Language</th><th class="sorting" role="columnheader" tabindex="3" aria-controls="sample_2" rowspan="1" colspan="1" style="width: 142px;" aria-label="Groups : activate to sort column ascending">Is System
			</th><th class="sorting_disabled" role="columnheader" aria-controls="sample_2" tabindex="4" rowspan="1" colspan="1" style="width: 120px;" aria-label="Status : activate to sort column ascending">Status
			</th>
			</th><th class="sorting_disabled" role="columnheader" aria-controls="sample_2" tabindex="4" rowspan="1" colspan="1" style="width: 120px;" aria-label="Status : activate to sort column ascending">Manage
			</th>
			</tr>
		    </thead>							
		    <tbody role="alert" aria-live="polite" aria-relevant="all">								
			<?php							
			$i = 1;
			foreach ($rows as $row) { ?>
			<tr class="odd gradeX <?php echo ($i % 2) ? 'even' : 'odd'; ?>">
			    <td class=" sorting_1">
				<input type="checkbox" class="checkboxes" name="check[]" id="check_<?php echo $row->id; ?>" value="<?php echo $row->id; ?>" />
			    </td>
			    <td class=" "><?php echo $row->name;?>&nbsp;
					<img src="<?php echo base_url().'assets/static/img/flags/'.$row->prefix;?>.png"/></td>
			    <td class=" "><?php echo $row->url;?></td>
				<td class=" "><?php echo $row->prefix; echo $row->native ? ' (' .$row->native .')' : '';?></td>
			    <!--td class=" ">
			    	<input type="radio" class="btn-language-default" rel="<?php echo base_url(ADMIN.$class_name.'/set_default/');?>" name="default_language" value="<?php echo $row->id;?>" <?php echo $row->default ? 'checked' : '';?>/>
			    	<?php echo $options[$row->default];?>
			    </td-->
			    <td class="center ">
					<input type="radio" class="btn-language-default" rel="<?php echo base_url(ADMIN.$class_name.'/change/');?>" name="site_language" value="<?php echo $row->id;?>" <?php echo $row->site_language ? 'checked' : '';?>/>
					<span class="label label-sm label-<?php echo $row->site_language == 1 ? 'success' : 'warning'; ?>">
						<?php echo $row->site_language == 1 ? 'Yes' : 'No';?>
					</span>
			    </td>
			    <td class="center ">
				<?php //echo $is_system[$row->is_system];?>
				<span class="label label-sm label-<?php echo $is_system[$row->is_system] == 'Yes' ? 'success' : 'warning'; ?>">
					<?php echo $is_system[$row->is_system] == 'Yes' ? 'Yes' : 'No';?>
				</span>
			    </td>
			    <td class="center "><?php echo $statuses[$row->status];?></td>
			    <td class=" ">
				<!--span class="label label-sm label-<?php if($row->status == 'active') { echo 'success'; } else { echo 'warning'; }?>"><?php echo $row->status;?>
				</span-->
				<ul class="list-inline">
				    <li>
					<a class="btn default btn-xs blue" href="<?php echo base_url(ADMIN.$class_name.'/view/'.$row->id);?>" title="<?php echo lang('View');?>"><i class="fa fa-check"></i><?php echo lang('View');?>
					</a>
				    </li>
				    <?php /*
				    <li>
					<a class="btn default btn-xs purple" href="<?php echo base_url(ADMIN.$class_name.'/edit/'.$row->id);?>" title="<?php echo lang('edit');?>"><i class="fa fa-edit"></i><?php echo lang('Edit');?>
					</a>
				    </li>						    
				    <li>
					<a class="btn default btn-xs red" href="<?php echo base_url(ADMIN.$class_name.'/delete/'.$row->id);?>" title="<?php echo lang('Delete');?>"><i class="fa fa-trash-o"></i><?php echo lang('Delete');?>
					</a>
				    </li>
				    */ ?>
				</ul>
			    </td>				
			</tr>
			<?php 
			$i++;
			} ?>
		    </tbody>
		    <tfoot>
			<tr>
			    <td id="corner"><span class="glyphicon glyphicon-minus"></span></td>
			    <td colspan="7">
				<div id="selection" class="input-group">
				    <div class="form-group form-group-sm">
					<label class="col-xs-6 control-label small" for="select_action"> <?php echo lang('Change Status');?> : </label>
					<div class="col-xs-6">
					<select name="select_action" id="select_action" class="form-control input-sm">
					    <option value="">&nbsp;</option>
					    <?php foreach ($statuses as $row => $value) : ?>
					    <option value="<?php echo $row; ?>">
						<?php echo ucfirst($value); ?>
					    </option>
					    <?php endforeach; ?>
					</select>
					</div>
				      </div>
				 </div>   
			    </td>
			</tr>
		    </tfoot>
		</table>
		<?php echo form_close();?>
	    </div>
	</div>		    
</div>