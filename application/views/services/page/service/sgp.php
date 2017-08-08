<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="backlit" style="display: none;"></div>

<?php $this->load->view('services/page/auth/account');?>
<!-- action class for animating page content when header is active -->
<div class="action step-right">
    <!-- img header -->
    <section class="header-halo" style="background: url(<?=base_url();?>assets/public/service/assets/img/slides/Service.jpg) center center no-repeat; background-size: cover;">
        <div class="black-tint has-button">
            <div id="crumbs" class="abs">
                <h6 class="sub-heading">
                    <a href="<?=base_url('services');?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    <a href="<?=base_url('services');?>">Servis</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    <a href="#">SGP</a>
                </h6>
            </div>
            SGP
            <span class="sub-lite">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span>
        </div>
    </section>
    <section class="back-white">
        <ul class="list-service">
            <?php foreach($product_statics as $product) { ?>
                <li>
                    <a href="<?php echo base_url().'services/sgp/'.$product->sps_url ?>">
                        <img src="<?php echo base_url().'uploads/static/service/'.$product->sps_image_url ?>" />
                        <div class="name">
                            <span></span><?php echo $product->sps_subject?>
                            <div class="desc"><?php echo $product->sps_title?></div>
                        </div>
                    </a>
                </li>
            <?php } ?>
        </ul>
        <br /><br /><br /><br /><br />
    </section>    
</div>
<!-- action -->
<?php
// if ($logged_in) {
?>
<!-- booking modal -->
<?php $this->load->view('services/page/booking');?>
<!-- booking modal -->
<?php
//}
?>
    