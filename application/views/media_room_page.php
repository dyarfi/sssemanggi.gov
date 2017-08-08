<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- action class for animating page content when header is active -->
<div class="action step-right">        
    <!-- img header -->
    <section class="page-header img-section dark" style="background-image:url(<?php echo base_url('assets/static/img');?>/media.jpg);">
        <div class="content-block black-tint">
            <div id="crumbs" class="abs">
                <div class="row large dark">
                    <div class="six columns">
                        <!-- page title/statement -->
                        <h6 class="sub-heading">
                            <a href="<?php echo base_url();?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            <a href="#">Media Room</a>
                        </h6>
                    </div>
                    <div class="six columns text-right">

                    </div>
                </div>
            </div>
            <!-- page statement -->
            <div class="row bigtoppadding">
                <div class="twelve columns text-center">
                    <h1 class="block-heading">MEDIA ROOM</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="grey stripe-bg">
        <!-- two third / left side -->
        <div class="row large white">
            <div class="content-block">
                <div class="column twelve">
                    <h1>Logged IN!</h1>
                    <div>
                        <span>Hi, <?php echo $this->member->username;?></span> | 
                        <span><a href="<?php echo base_url('media-room/logout');?>"> Logout</a></span>
                    </div>
                    <?php echo $detail->text;?>
                    <hr class="thin grey">
                </div>
            </div>
        </div>
        <!-- clear floats -->
        <div class="clear">
        </div>
    </section>            
</div><!-- action -->