<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- action class for animating page content when header is active -->
<div class="action step-right">    
    <!-- page content -->
    <!-- img header -->   
    <section class="header-halo" style="background: url(<?php echo base_url('assets/public/images/profile_bg.jpg');?>) center center no-repeat; background-size: cover;">
        <div class="black-tint has-button">
            <div id="crumbs" class="abs">
                <div class="eight columns">
                    <h6 class="sub-heading">
                    <a href="<?php echo base_url('services');?>">Home</a>
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    <a href="<?php echo base_url('services/profile');?>">Profile</a>                    
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    <a href="<?php echo base_url('services/profile/booking');?>">List Booking</a>
                </h6>
            </div>
        </div>
        Hi, <?php echo $this->member->fullname;?> 
        <!--span class="sub-lite">Booking service Suzuki</span-->
        </div>
    </section>
    <section class="grey stripe-bg">
        <!-- two third /left side-->
        <div class="two-third white">
            <div id="single-page" class="page">   
                <div class="columns">
                    <div class="row">
                        <div class="twelve columns">
                            <br/>
                            <h5>List Booking</h5>
                            <hr class="thin grey"/>
                            <?php if ($booking_history) {?>
                            <table class="row striped twelve">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Hour</th> 
                                    <th>Service Type</th>
                                    <th>Dealer</th>
                                    <th>Status</th>
                                    <th width="15%">Function</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($booking_history as $history) { ?>                                
                                    <tr>
                                        <td><?php echo $history->id; ?></td>
                                        <td><?php echo $history->name; ?></td>
                                        <td>
                                            <?php 
                                            if(strtotime(date('Y-m-d', $history->date )) < strtotime(date('Y-m-d',time())) ) {
                                                echo '<strike>'.date('Y-m-d',$history->date).'</strike>'; 
                                            } else {
                                                echo date('Y-m-d',$history->date);
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $history->time; ?></td>
                                        <td><?php echo $service_type[$history->service_type]; ?></td>
                                        <td><?php echo $this->DealerNetworks->findBy('id',$history->dealer_id)->name; ?></td>
                                        <td><?php echo ($history->approved == 1) ? 'Approved' : 'Not Approved'; ?></td>                                        
                                        <td>
                                            <?php 
                                            if(strtotime(date('Y-m-d', $history->date )) < strtotime(date('Y-m-d',time())) ) { ?>
                                            <span class="red small">Booked <span class="fa fa-check"></span></span>
                                            <?php } else { ?>
                                            <?php /*if($history->approved == 1) { ?>
                                            <a href="javascript:;" class="change-book" rel="<?php echo $this->encrypt->encode($history->id);?>">
                                                <span class="purple small">Edit</span>
                                            </a>
                                            <?php } */?>
                                                <?php if($history->approved == 1) { ?>
                                                    <a href="javascript:;" class="cancel-book" rel="<?php echo $this->encrypt->encode($history->id);?>">                                            
                                                        <span class="purple small">Cancel</span>
                                                    </a>
                                                    <a href="javascript:;" class="delete-book" rel="<?php echo $this->encrypt->encode($history->id);?>">
                                                        <span class="purple small">Delete</span>
                                                    </a>
                                                <?php } else { ?>
                                                    Waiting Approval
                                                <?php } ?>
                                            <?php } ?>                                            
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tbody>
                            </table>
                            <?php } else { ?>
                            <h5>Belum ada booking</h5>
                            <?php } ?>
                        <br/><br/>
                        <br/><br/>
                        <br/><br/>
                        <br/><br/>
                        <br/><br/>
                        <br/><br/>
                        <br/><br/>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <!-- sidebar -->
        <aside class="one-third grey">
        <div id="sidebar">
            <!-- category widget -->
            <div class="widget">
                <h5 class="stripe-heading">Hi, <?php echo word_limiter($this->member->fullname,2,'');?> </h5>
                <div class="widget-content">
                    <ul class="categories">
                        <li><a href="<?php echo base_url('services/profile');?>">Profile</a></li>
                        <li><a href="javascript:;">Inbox</a></li>
                        <li><a href="<?php echo base_url('services/profile/blog');?>">Blog</a></li>
                        <li><a href="<?php echo base_url('services/profile/booking');?>">List Booking</a></li>
                    </ul>
                </div>
            </div>            
        </div>
        </aside>
        <!-- clear floats -->
        <div class="clear"></div>
    </section>
</div>