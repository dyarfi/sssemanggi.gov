<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
		<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="portlet-config" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
						<h4 class="modal-title">Modal title</h4>
					</div>
					<div class="modal-body">Widget settings form goes here</div>
					<div class="modal-footer">
						<button class="btn blue" type="button">Save changes</button>
						<button data-dismiss="modal" class="btn default" type="button">Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
		<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
                    <?php echo $page_title;?>
				</h3>
				<ul class="page-breadcrumb breadcrumb">
					<!--li class="btn-group">
						<button data-close-others="true" data-delay="1000" data-hover="dropdown" data-toggle="dropdown" class="btn blue dropdown-toggle" type="button">
						<span>
							Actions
						</span>
						<i class="fa fa-angle-down"></i>
						</button>
						<ul role="menu" class="dropdown-menu pull-right">
							<li>
								<a href="#">
									Action
								</a>
							</li>
							<li>
								<a href="#">
									Another action
								</a>
							</li>
							<li>
								<a href="#">
									Something else here
								</a>
							</li>
							<li class="divider">
							</li>
							<li>
								<a href="#">
									Separated link
								</a>
							</li>
						</ul>
					</li-->
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url(ADMIN.$class_name);?>/index">
							Home
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url(ADMIN.$class_name);?>/index">
							<?php echo lang('Contact History');?>
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">
							<?php echo $page_title;?>
						</a>
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form class="form-horizontal" role="form" action="<?php echo base_url(ADMIN.$class_name.'/edit/'.$param);?>">
                            <div class="form-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Name:</label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static">
                                                        <?php echo $listing->name;?>
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Email:</label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static">
                                                        <?php echo $listing->email;?>
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Subject:</label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static">
                                                        <?php echo $listing->subject;?>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Message:</label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static">
                                                        <?php echo $listing->message;?>
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Added:</label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static">
                                                        <?php echo date('Y-m-d', $listing->added);?>
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <!--div class="form-group">
                                                <label class="control-label col-md-4">Modified:</label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static">
                                                        <?php echo date('Y-m-d', $listing->modified);?>
                                                    </p>
                                                </div>
                                            </div-->
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Status:</label>
                                                <div class="col-md-8">
                                                    <p class="form-control-static">
                                                        <?php echo $statuses[$listing->status];?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                            </div>
                            <div class="form-actions fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-offset-3 col-md-9 hide">
                                            <button type="submit" class="btn green"><i class="fa fa-pencil"></i> <?php echo lang('Edit');?></button>
 			    							<button class="btn default" type="button" onclick="window.location.href = '<?php echo base_URL(ADMIN.$class_name."/index?active=current");?>';"><?php echo lang('Cancel');?></button>
                                       	</div>
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                </div>
                            </div>
                    </form>
                    <!-- END FORM-->
                </div>
		<!-- END PAGE CONTENT-->
	</div>
</div>	