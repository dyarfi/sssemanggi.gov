<div class="page-content-wrapper">
    <div class="page-content">
	<div class="row">
	    <div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		<?=ucfirst($action);?> Contact History<!--small>managed data users</small-->
		</h3>
		<ul class="page-breadcrumb breadcrumb">					
		    <li>
			<i class="fa fa-home"></i>
			<a href="<?=base_url(ADMIN.'dashboard/index');?>">
				Dashboard
			</a>
			<i class="fa fa-angle-right"></i>
		    </li>
		    <li>
			<a href="<?=base_url(ADMIN);?>/contacthistory/index">Contact History Control</a>
			<i class="fa fa-angle-right"></i>
		    </li>
		    <li>
			<a href="<?=base_url(ADMIN);?>/contacthistory/<?=($action) ? $action .'/'. $param :'';?>">
			    Contact History <?=ucfirst($action);?>
			</a>
		    </li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	    </div>
	</div>	
	<!-- BEGIN FORM-->
	<?php echo form_open(base_url(ADMIN).'/'.$class_name.'/'.($action ? $action .'/'. $param :''),['id'=>$class_name.'-form','class'=>'form-horizontal','enctype'=>'multipart/form-data','role'=>'form']);?>
	    <div class="form-body">
	    <!--/row-->
	    <div class="row">
		<div class="col-md-8">
		    <div class="form-group">
				<label class="control-label col-md-3">Name</label>
				<div class="col-md-8">
				    <div class="input-group">
					<span class="input-group-addon">
						<i class="fa fa-user"></i>
					</span>
					<input type="text" class="form-control" name="name" placeholder="Name" value="<?=$fields->name;?>" id="name">
				    </div>
				    <span class="help-block"><?php echo $errors['name'];?></span>
				</div>
		    </div>
            <div class="form-group">
				<label class="control-label col-md-3">Email</label>
				<div class="col-md-8">				
	                <div class="input-group">
	            	<span class="input-group-addon">
						<i class="fa fa-envelope"></i>
					</span>
					<input type="text" class="form-control" name="email" placeholder="Email" value="<?=$fields->email;?>" id="email">
				    </div>
				    <span class="help-block"><?php echo $errors['email'];?></span>
				</div>
		    </div>
            <div class="form-group">
				<label class="control-label col-md-3">Subject</label>
				<div class="col-md-8">				
	                <div>
					<input type="text" class="form-control" name="subject" placeholder="Subject" value="<?=$fields->subject;?>" id="subject">
				    </div>
				    <span class="help-block"><?php echo $errors['subject'];?></span>								
				</div>
		    </div>
            <div class="form-group">
				<label class="control-label col-md-3">Message</label>
				<div class="col-md-8">				
	                <div>
					<input type="text" class="form-control" name="message" placeholder="Message" value="<?=$fields->message;?>" id="message">
				    </div>
				    <span class="help-block"><?php echo $errors['message'];?></span>								
				</div>
		    </div>
            <div class="form-group">
			<label class="control-label col-md-3">Status</label>
			<div class="col-md-6">
			    <select class="form-control" name="status">
				<?php foreach ($statuses as $status => $stat) {?>
					<option value="<?php echo $status;?>" <?php echo ($status == $fields->status) ? 'selected' : '';?>><?php echo $stat;?></option>
				<?php } ?>
			    </select>								
			    <span class="help-block"><?php echo $errors['status'];?></span>
			</div>
		    </div>
		</div>					
	    </div>
	    <!--/row-->
	    </div>
	    <div class="form-actions fluid">
		<div class="row">
		    <div class="col-md-8">
			<div class="col-md-offset-3 col-md-8">
			    <button class="btn green" type="submit">Submit</button>
			    <button class="btn default" type="button" onclick="window.location.href = '<?php echo base_URL(ADMIN.$class_name."/index?active=current");?>';"><?php echo lang('Cancel');?></button>
			</div>
		    </div>
		    <div class="col-md-6">
			<div class="msg"></div>
		    </div>
		</div>
	    </div>
	<?php echo form_close();?>
	<!-- END FORM-->
	</div>
</div>	