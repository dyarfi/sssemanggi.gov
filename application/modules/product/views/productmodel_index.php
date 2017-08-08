<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container-fluid">
	<div class="col-lg-12 clearfix">
		<h3 class="block"><?php echo $product->subject;?></h3>
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#tab_<?php echo $product->url;?>" data-toggle="tab">Add new Models</a>
			</li>
			<li>
				<a href="#" class="clear-form tooltips" data-original-title="Add" data-placement="right">Add New<span class="fa fa-plus"></span></a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade active in" id="tab_<?php echo $product->url;?>">
				<?php echo form_open('',['id'=>'form-model']);?>
				<input type="hidden" value="" name="id"/>
				<input type="hidden" value="<?php echo $product->id;?>" name="product_id"/>
				<div class="col-lg-10">
					<div class="form-group">
						<div class="input-group col-md-12">
							<label class="control-label" for="subject">Subject </label>
							<input id="subject" class="form-control col-md-8" type="text" name="subject" placeholder="" value="">
						</div>
						<div class="input-group col-md-12">
							<label class="control-label" for="group_name">Group Name </label>
							<input id="group_name" class="form-control col-md-8" type="text" name="group_name" placeholder="" value="">
						</div>
						<div class="input-group col-md-12">
							<label class="control-label" for="text">Text </label>
							<textarea id="text" class="form-control col-md-8 texteditor" name="text" placeholder=""></textarea>
						</div>
						<div class="input-group col-md-12">
							<label class="control-label" for="price">Price </label>
							<input id="price" class="form-control col-md-8" type="text" name="price" placeholder="" value="">
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
		<?php if ($productmodels) { ?>
			<h3 class="block">Models</h3>
			<table class="table table-striped">
				<thead>
					<tr>
						<th width="14%">Subject</th>
						<th width="14%">Group Name</th>
						<th>Text</th>
						<th>Price</th>
						<th>Status</th>
						<th width="14%">Function</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($productmodels as $models) { ?>
					<tr>
						<td><?php echo $models->subject;?></td>
						<td><?php echo $models->group_name;?></td>
						<td><?php echo strip_tags($models->text);?></td>
						<td><?php echo $models->price;?></td>
						<td><?php echo $models->status;?></td>
						<td>
							<div class="col-md-12 model-holder">
								<span class="grey">
									<button class="btn btn-default model-edit-btn tooltips" data-original-title="Edit" data-placement="top" rel="<?php echo base_url(ADMIN.'productmodel/edit/'.$models->id);?>">&nbsp;<span class="fa fa-edit"></span></button>
									<button class="btn btn-danger model-delete-btn tooltips" data-original-title="Delete" data-placement="top" rel="<?php echo base_url(ADMIN.'productmodel/delete/'.$models->id);?>">&nbsp;<span class="fa fa-minus"></span></button>
								</span>
							</div>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		<?php } else { ?><?php } ?>
		<div class="clearfix"></div><hr/>
	</div>
</div>
