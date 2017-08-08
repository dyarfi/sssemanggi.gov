<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container-fluid">
	<div class="col-lg-12 clearfix">
		<h3 class="block"><?php echo $product->subject;?></h3>
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#tab_<?php echo $product->url;?>" data-toggle="tab">Add new Variant</a>
			</li>
			<li>
				<a href="#" class="clear-form tooltips" data-original-title="Add" data-placement="right">Add New<span class="fa fa-plus"></span></a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade active in" id="tab_<?php echo $product->url;?>">
				<?php echo form_open('',['id'=>'form-variants']);?>
				<input type="hidden" value="" name="id"/>
				<input type="hidden" value="<?php echo $product->id;?>" name="product_id"/>
				<div class="col-lg-10">
					<div class="input-group">
						<label for="subject">Subject</label>
						<input type="text" id="subject" name="subject" value="" class="form-control"/>
					</div>
					<div class="input-group">
						<label for="color">Colors</label>
						<select class="form-control" id="color_id" name="color_id">
							<?php foreach ($product_colors as $color) { ?>
							<option value="<?php echo $color->id;?>" style="background: url(<?php echo base_url('assets/public/images/picker/'.$color->media);?>) no-repeat;  background-size: 20%, cover; background-position: left center; padding-left: 44px; padding-top: 10px;padding-bottom: 10px;">
								<?php echo $color->subject;?>
							</option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
			    		<label class="control-label col-md-12"><h4>Images</h4></label>
						<div class="input-group col-md-12">
							<input id="fieldID4" class="form-control col-md-8" type="text" name="media" placeholder="Max size 1200x700 px" value="">
							<span class="input-group-btn">
								<a class="btn btn-danger iframe-btn" type="button" href="<?php echo base_url('assets/filemanager/dialog.php?type=1&relative_url=0&field_id=fieldID4&fldr=img/variant&akey='.sha1('encryption+**&&^^%%$RGGGFR$&&UUJJZXCVZXCV'));?>">Select</a>
							</span>
						</div>
					</div>
					<div class="input-group">
						<label for="priority">Priority</label>
						<input type="text" id="priority" name="priority" value="" class="form-control"/>
					</div>
					<div class="clearfix"></div><hr/>
					<button type="submit" class="btn btn-default" id="submit" name="submit" value="submit"><span class="fa fa-check"></span> <?php echo lang('Submit');?></button>
				</div>
				<?php echo form_close();?>
			</div>
		</div>
	</div>
	<div class="col-lg-12 clearfix">
		<?php if ($productvariants) { ?>
			<h3 class="block">Variants</h3>
			<div class="row-fluid">
			<?php foreach ($productvariants as $product) { ?>
			<div class="row-fluid">
				<div class="col-md-3 clearfix" style="margin-bottom:20px;">
					<div class="img-thumbnail">
						<img src="<?php echo base_url($product->media);?>" class="img-responsive"/>
					</div>
					<span class="grey"><?php echo ($product->priority) ? $product->priority.'.' : '';?> <?php echo character_limiter($product->subject,20);?></span>
					<div>
						<button class="btn btn-default variant-edit-btn tooltips" data-original-title="Edit" data-placement="top" rel="<?php echo base_url(ADMIN.'productvariant/edit/'.$product->id);?>">&nbsp;<span class="fa fa-edit"></span></button>
						<button class="btn btn-danger variant-delete-btn tooltips" data-original-title="Delete" data-placement="top" rel="<?php echo base_url(ADMIN.'productvariant/delete/'.$product->id);?>">&nbsp;<span class="fa fa-minus"></span></button>
					</div>
				</div>
			</div>
			<?php } ?>
			</div>
		<?php } else { ?><?php } ?>
		<div class="clearfix"></div><hr/>
	</div>
</div>
