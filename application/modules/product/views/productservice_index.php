<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container-fluid">
	<div class="col-lg-12 clearfix">
		<h3 class="block"><?php echo $product->subject;?></h3>
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#tab_<?php echo $product->url;?>" data-toggle="tab">Add new Service</a>
			</li>
			<li>
				<a href="#" class="clear-form tooltips" data-original-title="Add" data-placement="right">Add New<span class="fa fa-plus"></span></a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade active in" id="tab_<?php echo $product->url;?>">
				<?php echo form_open('',['id'=>'form-services']);?>
				<input type="hidden" value="" name="id"/>
				<input type="hidden" value="<?php echo $product->id;?>" name="product_id"/>
				<div class="col-lg-10">
					<div class="form-group">
						<?php if ($productmodels) { ?>
						<div class="input-group col-md-12">
							<label class="control-label" for="model_id">Model </label>
							<!--input id="model_id" class="form-control col-md-8" type="text" name="model_id" placeholder="" value=""-->
							<select name="model_id" class="form-control">
								<?php foreach ($productmodels as $models) { ?>
								<option value="<?php echo $models->id;?>"><?php echo $models->subject;?></option>
								<?php }?>
							</select>
						</div>
						<?php } ?>
						<div class="input-group col-md-12">
							<label class="control-label" for="subject">Subject </label>
							<input id="subject" class="form-control col-md-8" type="text" name="subject" placeholder="" value="">
						</div>
						<div class="input-group col-md-12">
							<label class="control-label" for="text">Text </label>
							<textarea id="text" class="form-control col-md-8 texteditor" name="text" placeholder=""></textarea>
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
		<?php if ($productservices) { ?>
			<h3 class="block">Services</h3>
			<div class="">
				<table class="table table-striped dataTable">
					<thead>
						<tr>
							<th width="18%">Subject</th>
							<th>Model</th>
							<!--th>Text</th-->
							<th width="14%">Function</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($productservices as $service) { ?>
						<tr>
							<td><?php echo $service->subject;?></td>
							<td><?php echo $this->ProductModels->get($service->model_id)->subject;?></td>
							<!--td><?php echo word_limiter(strip_tags($service->text),10);?></td-->
							<td>
								<div class="col-md-12 service-holder">
									<span class="grey">
										<a class="btn btn-default tooltips get-service-list" data-original-title="Add Service Items" data-placement="left" data-toggle="modal" role="button" href="#myModal1" data-rel="<?php echo base_url(ADMIN.'productservice/view/'.$service->id);?>" data-id="<?php echo $service->id;?>" data-title="<?php echo $service->subject;?><?php echo ($service->models ? ' - '. $service->models->subject : '');?>">&nbsp;<span class="fa fa-file-text"></span></a>
										<button class="btn btn-default service-edit-btn tooltips" data-original-title="Edit" data-placement="top" rel="<?php echo base_url(ADMIN.'productservice/edit/'.$service->id);?>">&nbsp;<span class="fa fa-edit"></span></button>
										<button class="btn btn-danger service-delete-btn tooltips" data-original-title="Delete" data-placement="top" rel="<?php echo base_url(ADMIN.'productservice/delete/'.$service->id);?>">&nbsp;<span class="fa fa-minus"></span></button>
									</span>
								</div>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		<?php } else { ?><?php } ?>
		<div class="clearfix"></div><hr/>
	</div>
</div>
<!-- Modal -->
<div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true" style="z-index:9999 !important">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title"><span class="fa fa-file-text"></span> Service Items <small class="title-item text-danger"></small></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="table-toolbar"></div>
						<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
							<thead>
								<tr role="row" class="heading">
									<th width="15%">Name</th>
									<th width="15%">Media</th>
									<th width="15%">Qty</th>
									<th width="10%">Price</th>
									<th width="10%">Edit</th>
									<th width="10%">Delete</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
						<hr/>
						<?php echo form_open(base_url(ADMIN) . '/productservice/store',['id'=>'form-service-items','class'=>'form-horizontal','method'=>'POST','autocomplete'=>'on']);?>
							<h3 class="label-text"></h3>
							<input type="hidden" name="id" value=""/>
							<input type="hidden" name="service_id" value=""/>
							<div class="col-md-3"><input type="text" id="name" name="name" value="" class="form-control" placeholder="Name"></div>
							<div class="col-md-2"><input type="text" id="price" name="price" value="" class="form-control" placeholder="Price" data-a-dec="," data-a-sep="."></div>
							<div class="col-md-2"><input type="text" id="quantity" name="quantity" value="" class="form-control" placeholder="Qty"></div>
							<div class="col-md-3">
								<div class="form-group">
						    		<div class="input-group col-md-12">
										<input id="fieldID4" class="form-control col-md-8" type="text" name="media" value="" placeholder="Image">
										<span class="input-group-btn">
											<a class="btn btn-danger iframe-btn click-overlay" type="button" href="<?php echo base_url('assets/filemanager/dialog.php?type=1&relative_url=0&field_id=fieldID4&fldr=img/service&akey='.sha1('encryption+**&&^^%%$RGGGFR$&&UUJJZXCVZXCV'));?>">Select</a>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-1"><button type="submit" class="btn btn-primary"> Save</button></div>
						<?php echo form_close();?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
			</div>
		</div>
	</div>
</div>
