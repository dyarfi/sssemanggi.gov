<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

		<!-- /.modal -->
		<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
		<!-- BEGIN STYLE CUSTOMIZER -->

		<!-- END STYLE CUSTOMIZER -->
		<!-- BEGIN PAGE HEADER-->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
				Dashboard <small><a href="<?php echo base_url(ADMIN.'dashboard/index?active=current');?>" class="logoHandler">
					<?php echo $this->site_name->value;?>
				</a></small>				
				</h3>
				<ul class="page-breadcrumb breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url(ADMIN.'admin/dashboard/index')?>">
							Home
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">
							Dashboard
						</a>
					</li>

				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN DASHBOARD STATS -->
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 hide">
				<div class="dashboard-stat blue">
					<div class="visual">
						<i class="fa fa-comments"></i>
					</div>
					<div class="details">
						<div class="number">
							 <!--?=$this->vote_model->count_allvote()?-->
						</div>
						<div class="desc">
							 Total Vote
						</div>
					</div>
					<a class="more" href="<?php echo base_url()?>__admin_vote/all">
						 View more <i class="m-icon-swapright m-icon-white"></i>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat green">
					<div class="visual">
						<i class="fa fa-group"></i>
					</div>
					<div class="details">
						<div class="number">
							 <?php echo $tusers;?>
						</div>
						<div class="desc">
							 Total User
						</div>
					</div>
					<a class="more" href="<?php echo base_url(ADMIN.'user/index?active=current');?>">
						 View more <i class="m-icon-swapright m-icon-white"></i>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat yellow">
					<div class="visual">
						<i class="fa fa-user"></i>
					</div>
					<div class="details">
						<div class="number">
							<?php
							$d = ''; 
							foreach ($tmembers as $tmember) { 
								$d += $tmember->count;
							}
							echo $d;
							?>
						</div>
						<div class="desc">							
						Member<?php echo count($tmembers) > 1 ? 's' : '';?>
						</div>
					</div>
					<!--span class="more inline" href="<?php echo base_url(ADMIN.'member/index?active=current');?>">
					 	<?php /* 
						 	$i = 1; 
						 	foreach ($tmembers as $tmember) { 
						 		$type = $tmember->type == 'Subscriber' ? 'subscriber' : 'member'; ?>
								<a class="white" href="<?php echo base_url(ADMIN.$type.'/index?active=current');?>">
									<i class="fa fa-tag"></i> 
									<?php echo $tmember->type; echo $tmember->count > 1 ? 's' : '';?> 
									(<?php echo $tmember->count; ?>) </a> 
									<?php echo count($tmembers) != $i ? '&nbsp;|&nbsp;':'';?>
							 	<?php 
							 $i++;
							} */
						?>
					</span-->
					<a class="more" href="<?php echo base_url(ADMIN.'member/index?active=current');?>">
						 View more <i class="m-icon-swapright m-icon-white"></i>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat purple">
					<div class="visual">
						<i class="fa fa-envelope"></i>
					</div>
					<div class="details">
						<div class="number">
							<?php foreach($tcontacts as $tcontact) { ;?>
							 <small><?php echo $tcontact->replied + $tcontact->not_replied;?></small>
							 <?php } ?>
						</div>
						<div class="desc">
							Email Contacts
						</div>
					</div>	
					<a class="more" href="<?php echo base_url(ADMIN.'contacthistory/index?active=current');?>">
						 View more <i class="m-icon-swapright m-icon-white"></i>						
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat blue">
				    <div class="visual"><i class="fa fa-file-text-o"></i></div>
				    <div class="details">
					<div class="number"><?php echo $tnews;?></div>
					<div class="desc">News</div>
				    </div>
				    <a class="more" href="<?php echo base_url(ADMIN.'newscenter/index?active=current');?>">
					View more <i class="m-icon-swapright m-icon-white"></i>
				    </a>
				</div>
		    </div>
		    <!--div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat yellow">
				    <div class="visual"><i class="fa fa-credit-card"></i></div>
				    <div class="details">
					<div class="number"><?php echo $tpayments;?></div>
					<div class="desc">Payments</div>
				    </div>
				    <a class="more" href="<?php echo base_url(ADMIN.'confirm_payment/index?active=current');?>">
					View more <i class="m-icon-swapright m-icon-white"></i>
				    </a>
				</div>
		    </div-->
		</div>
		<!-- END DASHBOARD STATS -->
		<div class="clearfix">
		</div>

		<div class="clearfix">
		</div>
		
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-user"></i>Login Activities
						</div>
					</div>
					<div class="portlet-body">
						<div id="login_statistics_loading">
							<img src="<?php echo base_url();?>assets/admin/img/loading.gif" alt="loading"/>
						</div>
						<div id="login_statistics_content" class="display-none">
							<div id="login_statistics" class="chart"></div>
						</div>
					</div>
				</div>
			</div>	
		</div>
		
		<div class="row hidden">
			<div class="col-md-12 col-sm-12">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-bell-o"></i>Vote Activities
						</div>

					</div>
					<div class="portlet-body">
						<div class="scroller" style="max-height: 300px;" data-always-visible="1" data-rail-visible="0">
							<ul class="feeds">
								<li>
									<div class="col1">
										<div class="cont">
											<div class="cont-col1">
												<div class="label label-sm label-info">
													<i class="fa fa-check"></i>
												</div>
											</div>
											<div class="cont-col2">
												<div class="desc">
													 You have 4 pending tasks.

												</div>
											</div>
										</div>
									</div>
									<div class="col2">
										<div class="date">
											 Just now
										</div>
									</div>
								</li>

							</ul>
						</div>
						<div class="scroller-footer">
							<div class="pull-right">
								<a href="#">
									 See All Records <i class="m-icon-swapright m-icon-gray"></i>
								</a>
								 &nbsp;
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="clearfix">
		</div>
	</div>
</div>