<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container-fluid">	
	<div class="col-lg-12 clearfix">
		<h3 class="block"><?php echo $product->subject;?></h3>
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#tab_<?php echo $product->url;?>" data-toggle="tab">Add new Accessory</a>
			</li>	
			<li>
				<a href="#" class="clear-form tooltips" data-original-title="Add" data-placement="right">Add New<span class="fa fa-plus"></span></a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade active in" id="tab_<?php echo $product->url;?>">
				<?php echo form_open('',['id'=>'form-accessory']);?>
				<input type="hidden" value="<?php echo $product->id;?>" name="product_id"/>
				<div class="col-lg-10">
					<div class="form-group">
						<div class="input-group col-md-12">
							<label class="control-label" for="subject">Subject </label>
							<input id="subject" class="form-control col-md-8" type="text" name="subject" placeholder="" value="">
						</div>
						<div class="input-group col-md-12">						
							<label class="control-label" for="text">Text </label>
							<textarea id="text" class="form-control col-md-8" name="text" placeholder=""></textarea>
						</div>
						<div class="input-group col-md-12">						
							<label class="control-label" for="attribute">Price </label>
							<input id="attribute" class="form-control col-md-8" type="text" name="attribute" placeholder="" value="">							
						</div>
						<div class="form-group">
				    		<label class="control-label" for="fieldID4">Image</label>
							<div class="input-group col-md-12">
								<input id="fieldID4" class="form-control col-md-8" type="text" name="media" placeholder="" value="">
								<span class="input-group-btn">
									<a class="btn btn-danger iframe-btn" type="button" href="<?php echo base_url('assets/filemanager/dialog.php?type=1&relative_url=0&field_id=fieldID4&fldr=img/acc&akey='.sha1('encryption+**&&^^%%$RGGGFR$&&UUJJZXCVZXCV'));?>">Select</a>
								</span>
							</div>							
						</div>	
					</div>	
					<div class="clearfix"></div><hr/>
					<button type="submit" class="btn btn-primary" id="submit" name="submit" value="submit"><span class="fa fa-check"></span> <?php echo lang('Submit');?></button>					
				</div>
				<?php echo form_close();?>
			</div>	
		</div>
	</div>
	<div class="col-lg-12 clearfix">
		<?php if ($productaccessories) { ?>	
			<h3 class="block">Accessories</h3>
			<div class="row-fluid">
			<?php foreach ($productaccessories as $product) { ?>
				<div class="row-fluid">
					<div class="col-md-3 clearfix" style="margin-bottom:20px;">
						<div style="height:160px;overflow:hidden;border:1px solid #cccccc; border-collapse:collapse;" class="holder-img" id="<?php echo $product->id;?>">
							<img src="<?php echo base_url($product->media);?>" class="img-responsive"/>				
						</div>
						<span class="grey text-center"><?php echo character_limiter($product->subject,20);?></span>
						<div>
							<button class="btn btn-default accessory-edit-btn tooltips" data-original-title="Edit" data-placement="top" rel="<?php echo base_url(ADMIN.'productaccessory/edit/'.$product->id);?>">&nbsp;<span class="fa fa-edit"></span></button>
							<button class="btn btn-danger accessory-delete-btn tooltips" data-original-title="Delete" data-placement="top" rel="<?php echo base_url(ADMIN.'productaccessory/delete/'.$product->id);?>">&nbsp;<span class="fa fa-minus"></span></button>
						</div>	
					</div>
				</div>
				<?php } ?>
			</div>
		<?php } else { ?><?php } ?>
		<div class="clearfix"></div><hr/>
	</div>
</div>