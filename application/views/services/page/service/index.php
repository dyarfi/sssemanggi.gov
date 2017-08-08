<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="backlit" style="display: none;"></div>

<?php $this->load->view('services/page/auth/account');?>

<!-- action class for animating page content when header is active -->
<div class="action step-right">
    <!-- img header -->
    <section class="header-halo" style="background: url(<?=base_url();?>assets/public/service/assets/img/slides/Service.jpg) center center no-repeat; background-size: cover;">
        <div class="black-tint has-button">
            <div id="crumbs" class="abs">
                <div class="eight columns">
                    <h6 class="sub-heading">
                        <div class="eight columns">
                            <a href="<?=base_url('services');?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            <a href="#">Servis</a>
                        </div>
                    </h6>
                </div>
            </div>
            <!--
            <?php if($logged_in) { ?>
            <a href="<?php echo base_url('services/logout');?>" class="book_member">Logout</a>
            <?php } ?> -->
            <a href="#<?php /*echo base_url('services/automobile');*/?>" class="<?php echo ($logged_in) ? 'book' :'book';?>">Booking Servis Mobil</a>
            Layanan Servis
            <span class="sub-lite">Demi menjaga agar kondisi kendaraan Suzuki anda dalam kondisi yang terbaik, maka menjadi standar bagi kami untuk memberikan pelayanan yang terbaik untuk anda, Pelanggan Setia Suzuki.</span>
        </div>
    </section>
    <section class="back-white">
        <ul class="list-service">
            <li>
                <a href="<?=base_url('services/marine');?>">
                    <img src="<?=base_url();?>assets/public/service/assets/img/acc/suzuki_marine.jpg" />
                    <div class="name"><span></span>Servis Marine<div class="desc">Sahabat mesin kapal Anda.</div></div>
                </a>
            </li>
            <li>
                <a href="<?=base_url('services/automobile');?>">
                    <img src="<?=base_url();?>assets/public/service/assets/img/acc/231b3-servis_mobil.jpg" />
                    <div class="name">
                        <span></span>Servis Mobil
                        <div class="desc">Menjamin kenyamanan berkendara sepanjang waktu.</div>
                    </div>
                </a>
            </li>
            <li>
                <a href="<?=base_url('services/motorcycle');?>">
                    <img src="<?=base_url();?>assets/public/service/assets/img/acc/suzuki_motor.jpg" />
                    <div class="name"><span></span>Servis Motor<div class="desc">Melesat dahsyat bersama Anda.</div></div>

                </a>
            </li>
            <li>
                <a href="<?=base_url('services/layanan-24-jam-sera');?>">
                    <img src="<?=base_url();?>assets/public/service/assets/img/acc/suzuki_sera_.jpg" />
                    <div class="name"><span></span>24 Hours Road Assistant<div class="desc">Siang dan malam siaga membantu</div></div>
                </a>
            </li>
            <li>
                <a href="#" class="btn-survey">
                    <img src="<?=base_url();?>assets/public/service/assets/img/acc/survey_v2.jpg" />
                    <div class="name"><span></span>Survey Pelanggan<div class="desc">Demi memberikan yang terbaik untuk Anda, kami membutuhkan masukan dan saran Anda.</div></div>
                </a>
            </li>
            <li>
                <a href="<?=base_url('services/halo-suzuki');?>">
                    <img src="<?=base_url();?>assets/public/service/assets/img/halo_suzuki.jpg" />
                    <div class="name"><span></span>Halo Suzuki<div class="desc">24 jam siaga melayani Anda</div></div>
                </a>
            </li>
            <li>
                <a href="<?=base_url('services/sgc');?>">
                    <img src="<?=base_url();?>assets/public/service/assets/img/slides/sgc.jpg" />
                    <div class="name"><span></span>Suzuki Genuine Chemical<div class="desc">Jaga kualitas tampilan kendaraan Suzuki Anda dengan chemical treatment secara berkala.</div></div>
                </a>
            </li>
            <li>
                <a href="https://dms.suzuki.co.id/simdms/assets/custom/CampaignForm.cshtml?iframe=true&width=480&height=100%" class="prettyPhotoiFrame" rel=”prettyPhoto”>
                    <img src="<?=base_url();?>assets/public/service/assets/img/slides/quality-product-update.jpg" />
                    <div class="name"><span></span>Suzuki Product Quality Update<div class="desc">PT Suzuki Indomobil Sales, selalu berusaha memberikan pelayanan yang terbaik.</div></div>
                </a>
            </li>
            <?php
            /*
            <li>
                <a href="<?=base_url('services/sgp');?>">
                    <img src="<?=base_url();?>assets/public/service/assets/img/acc/Cargo-Net-Rp.-320000--1024x768.jpg" />
                    <div class="name"><span></span>SGP<div class="desc">Ased do eiusmod tempor incididunt ut labore quis nostrud exercitation ullamco laboris nisi ut aliquip ex</div></div>
                </a>
            </li>>
            */
            ?>
        </ul>
    </section>
</div>
<!-- planner window -->
<?php
//if ($logged_in) {
?>
<!-- booking modal -->
<?php $this->load->view('services/page/booking');?>
<!-- booking modal -->
<?php
//}
?>
<!-- planner -->
<?php $this->load->view('services/page/survey'); ?>
