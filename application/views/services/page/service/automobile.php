<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!--div class="backlit" style="display: none;"></div-->

<?php $this->load->view('services/page/auth/account');?>

<!-- action class for animating page content when header is active -->
<div class="action step-right">
    <!-- img header -->
    <section class="header-halo" style="background: url(<?=base_url();?>assets/public/service/assets/img/slides/free_jasa3.jpg) center center no-repeat; background-size: cover;">
        <div class="black-tint has-button">
            <div id="crumbs" class="abs">
                <div class="eight columns">            
                    <h6 class="sub-heading">
                        <a href="<?=base_url('services');?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        <a href="<?=base_url('services/');?>">Servis</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        <a href="#">Servis Mobil</a>
                    </h6>
                </div>    
            </div>
            <?php /*if($logged_in) { ?>
            <a href="<?php echo base_url('services/automobile');?>" class="book">Booking Servis Mobil</a>
            <?php }*/ ?>            
            <!--a href="#" class="<?=($logged_in) ? 'book' : 'open-pop dom-login book-not-logged-in';?>">Booking Servis Mobil</a-->
            <a href="#" class="book">Booking Servis Mobil</a>            
            
            <span class="sub-lite"></span>
        </div>
    </section>

    <section class="back-white">
        <ul class="list-service">            
            <?php foreach($product_statics as $product) { 
                $url = ($product->sps_ext_url) ? $product->sps_url : base_url().'services/automobile/'.$product->sps_url;
                $class  = ($product->sps_id == 5) ? 'book-btn' : '';
                ?>
                <li>                
                    <a class="<?php echo $class;?>" href="<?php echo $url;?>" target="<?php echo ($product->sps_ext_url) ? '_blank' :'_self'?>">
                        <img src="<?php echo base_url().'uploads/static/service/'.$product->sps_image_url ?>" />
                        <div class="name">
                            <span></span><?php echo $product->sps_subject?>
                            <div class="desc"><?php echo $product->sps_title?></div>
                        </div>
                    </a>
                </li>
            <?php } ?>                    
        </ul>
    </section>

</div>
<!-- action -->
<!-- planner window -->
<?php
// if ($logged_in) {
?>
<!-- booking modal -->
<?php $this->load->view('services/page/booking');?>
<!-- booking modal -->
<?php
//}
?>
<!-- planner -->
<?php //$this->load->view('services/page/survey'); ?>
