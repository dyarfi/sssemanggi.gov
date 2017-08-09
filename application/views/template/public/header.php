<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>
<?php /*
<!-- HEADER -->
<header id="header">
    <div id="header-wrap" class="container">
        <div class="row">
            <div class="col-sm-3">
                <!-- LOGO -->
                <div id="logo">
                    <a href="index.html">
                        <img src="<?php echo base_url('assets/public/images/logo.png');?>" alt="">
                    </a>
                </div><!-- LOGO -->
            </div><!-- col -->   
        <?php $this->load->view('template/public/navigation'); ?>
        </div><!-- row -->
    </div><!-- container -->            
</header><!-- HEADER -->
*/
?>
<header id="header" class="transparent-header page-section dark">
    <div id="header-wrap">
        <div class="container clearfix">
            <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
            <!-- Logo
            ============================================= -->
            <div id="logo">
                <a href="<?php echo base_url();?>" class="standard-logo" data-dark-logo="<?php echo base_url('assets/public/images/logo.png');?>"><img src="<?php echo base_url('assets/public/images/logo.png');?>" alt="Canvas Logo"></a>
                <a href="<?php echo base_url();?>" class="retina-logo" data-dark-logo="<?php echo base_url('assets/public/images/logo.png');?>"><img src="<?php echo base_url('assets/public/images/logo.png');?>" alt="Canvas Logo"></a>
            </div><!-- #logo end -->            
            <?php $this->load->view('template/public/navigation'); ?>
        </div>
    </div>
</header><!-- #header end -->