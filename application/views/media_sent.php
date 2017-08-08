<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- action class for animating page content when header is active -->
<div class="action step-right">
    <div id="crumbs" class="white">
        <div class="row large">
            <div class="eight columns">
                <!-- page title -->
                <h6 class="sub-heading">
                    <a href="<?php echo base_url();?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i><a href="#">Terima kasih</a>
                </h6>            
            </div>
            <div class="four columns text-right"> </div>
        </div>
    </div>
    <!-- img header -->
    <section class="page-header img-section dark" style="background-image:url(<?php echo base_url('assets/static/img');?>/contact.jpg);background-position:center center;">
        <div class="content-block dark black-tint">
            <div class="row large">
                <div class="ten columns centered text-center">
                <!-- intro statement -->
                    <div style="height:100px;">&nbsp;</div>
                    <h1 class="large-font bold droid-font">Terima kasih</h1>
                    <span class="border"></span>
                    <h4>Kami telah menerima data Anda. Mohon menunggu proses pengaktifan akun Anda,
                    konfirmasi pengaktifan akan dikirim melalui email Anda.</h4>
                    <div class="midtoppadding">
                        <?php if($this->facebook->value) {?>
                            <a href="<?php echo $this->facebook->value;?>" title="<?php echo $this->facebook->alias;?>" class="purple fill-button" target="_blank"><i class="fa fa-facebook"></i> &nbsp; Kunjungi Facebook</a> 
                        <?php } ?>
                        <?php if($this->twitter->value) {?>
                            <a href="<?php echo $this->twitter->value;?>" title="<?php echo $this->twitter->alias;?>" target="_blank" class="white line-button"><span><i class="fa fa-twitter"></i> &nbsp;  Terhubung dengan Twitter</span></a>
                        <?php } ?>
                    </div>
                    <div style="height:110px;">&nbsp;</div>
                </div>
            </div>              
        </div>
    </section>
</div><!-- action -->