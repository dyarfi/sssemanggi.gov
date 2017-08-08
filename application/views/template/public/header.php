<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="preloader">
    <div id="status">
        &nbsp;
    </div>
</div>
<header class="main custom-scroll cbp-spmenu cbp-spmenu-left" id="main-menu">
    <div id="header-scrollarea">
        <div class="logo">
            <img src="<?php echo base_url('assets/static/img/logo-main.png');?>" alt="logo" gumby-retina>
        </div>    
        <?php $this->load->view('template/public/navigation'); ?>
    </div>
</header>
<div class="trigger">
    <a href="<?php echo base_url();?>">
        <img src="<?php echo base_url('assets/static/img');?>/logo-suzu.jpg" class="logo-suzuki">
    </a>
    <div class="trigger-box">
        <!-- toggle IE -->
        <button id="showMenu" class="visibile-ie">
            <span>menu</span>
            <span class="x-ie"><img src="<?php echo base_url('assets/public/images');?>/close-ie.jpg" class="close menu in ie"></span>
        </button>
        <!-- end toggle IE -->
        <a class="toggle" gumby-trigger="header.main" id="trigger">
        <i class="fa fa-bars active"></i>
        <i class="fa fa-times"></i>
        </a>
    </div>    
    <?php
    if ($logged_in === false) {
        ?>
        <div class="white-text center map-marker">
            <a href="<?php echo base_url('xhr/service_map');?>?custom=true" class="map-marker-btn" rel="prettyPhoto">Nearby Dealer</a>
        </div>
        <a href="#" class="open-pop dom-login but-log">
            Log In
        </a>

        <a href="#" class="open-pop dom-regis but-reg">
            Sign Up
        </a>
        <?php
    } 
    if($logged_in) { ?>
    <a href="<?php echo base_url('services/profile');?>" class="but-reg">profile</a>
        <a href="<?php echo base_url('services/auth/signout');?>" class="but-log">Logout</a>
    <?php 
    } 
    ?>
    <!-- side logo mark  -->
    <div class="side-logo">
        <button class="newsl-ie visibile-ie" id="showNews">Suzuki<br>Update</button>
        <!--a class="planner-btn newsl-nonie"><img src="<?php echo base_url('assets/static/img');?>/logo-mark.png" alt="logo" gumby-retina></a-->
        <a class="planner-btn">
            <span>Suzuki</span>
            Update
        </a>
    </div>
    <!--div class="enq" style=""><a class="planner-btn"><span>Enquiry</span></a></div-->
    <div class="back-to-top">
        <a id="top-trigger">
        <i class="fa fa-angle-up"></i>
        </a>
    </div>
</div>