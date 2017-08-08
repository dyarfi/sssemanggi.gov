<!DOCTYPE html>
<!--[if gt IE 9]><!-->
<html class="no-js" lang="id" itemscope itemtype="http://schema.org/Product">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="msvalidate.01" content="A0A21A55BF8A5297D8AA00CEF63298E3" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php echo ($page_title) ? $page_title .' | '. @$this->site_name : ''; ?></title>
<meta name="description" content="<?php echo $this->site_description ? $this->site_description : lang('meta_description');?>"/>
<meta name="keywords" content="<?php echo $this->site_keywords ? $this->site_keywords : lang('meta_keywords');?>"/>
<meta name="author" content="Suzuki Indonesia">
<meta name="robots" content="index, follow">
<link rel="shortcut icon" href="<?php echo base_url('favicon.ico');?>" type="image/x-icon"/>
<link rel="image_src" href="<?php echo base_url('assets/public/images/logo.jpg');?>" />
<!-- Facebook Metadata /-->
<meta property="fb:page_id" content=""/>
<meta property="og:description" content="<?php echo $this->site_description ? $this->site_description : lang('meta_description');?>"/>
<meta property="og:title" content="<?php echo ($page_title) ? $page_title .' | '. config_item('development_name') : ''; ?>"/>
<meta property="og:image" content="<?php echo base_url('assets/public/images/logo.jpg');?>">
<!-- Google+ Metadata /-->
<meta itemprop="name" content="<?php echo ($page_title) ? $page_title .' | '. config_item('development_name') : ''; ?>">
<meta itemprop="description" content="<?php echo $this->site_description ? $this->site_description : lang('meta_description');?>">
<meta itemprop="image" content="<?php echo base_url('assets/public/images/logo.jpg');?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
<?php
    /*
    * MINIFY CSS
    * ----------------------
    * Add css files that want to be minify
    */
    // Add / Change default dir
    $this->minify->assets_dir = 'assets/public/css';
    // Add Stylesheet
    $stylesheets = [
        // Main Gumby Frameworks
        "public/css/gumby.css",
        // Main Site CSS
        "public/css/style.css",
        "public/css/plugins.css",
        "public/css/responsive.css",
        "public/css/fawesome.css",
        "public/css/background.css",
        // jQuery and inherit CSS
        "public/css/jquery-ui.css",
        "public/css/animate.css",
        // Backend Addional CSS
        "public/css/additional.css"
    ];
    // Minify Library CSS
    $this->minify->css($stylesheets);
    /*
     * Adding additional stylesheet from controller
     */
    if (!empty($css_files)) {
        $this->minify->add_css($css_files);
        foreach ($css_files as $sheet => $css):
          // Add js to minified
          $this->minify->add_css($css, $sheet);
        endforeach;
    }
    /*
     * ----------------- BEWARE OF DEPLOYING | ALWAYS SET TO FALSE AFTER RECOMPILE ------------------
     * Recompile css!!! Set this to true every times you add css library from anywhere
     * delete assets/public/css/styles.min.css to recompile again
     */
    echo $this->minify->deploy_css(FALSE);
?>
<!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/css/ie8-and-down.css'); ?>" />
<![endif]-->
<!--[if lte IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/css/ie8-and-down.css'); ?>" />
<![endif]-->
<!--[if IE 7]>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/css/ie7only.css'); ?>">
<![endif]-->
<!--[if IE 6]>
    <link rel="stylesheet" type="text/css" href="https://necolas.github.io/normalize.css/5.0.0/normalize.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/css/ie6only.css'); ?>">
<![endif]-->
<script src="<?php echo base_url('assets/public/js/libs/modernizr-2.6.2.min.js');?>"></script>
<script type="text/javascript">var base_URL = '<?php echo base_url();?>';</script>
<script type="text/javascript">(function(d,u){var b=d.getElementsByTagName("script")[0],j=d.createElement("script");j.async=true;j.src=u;b.parentNode.insertBefore(j,b);})(document,"//di2xiflr72bem.cloudfront.net/ut/7953079a2cbe7270_60.js");</script>
<?php if (!empty($this->ga_analytics->value)) { echo $this->ga_analytics->value; } ?>
<!-- Hotjar Tracking Code for www.suzuki.co.id -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:460644,hjsv:5};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>
</head>
<body>
<?php $this->load->view('template/public/header'); ?>
<?php $this->load->view('flashdata'); ?>
<!-- Main content block - all page content -->
<div class="content custom-scroll home">
    <!-- blocker active with active header -->
    <div class="blocker"> </div>
    <?php $this->load->view($main); ?>
    <!-- Footer -->
    <?php $this->load->view('template/public/bottom_content'); ?>
    <!-- end Footer -->
</div><!-- end div.content -->
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="<?php echo base_url('assets/public/js/libs/jquery-ui-1.11.0.min.js');?>"></script>
<script src="<?php echo base_url('assets/public/js/libs/jquery.datepicker-min.js');?>"></script>
<script src="<?php echo base_url('assets/public/js/libs/gumby.min.js');?>"></script>
<!--script src="<?php echo base_url('assets/public/js/libs/jquery.geocomplete.min.js');?>"></script-->
<script src="<?php echo base_url('assets/public/js/slide-pop-forie78.js');?>"></script>
<script src="<?php echo base_url('assets/public/js/plugins.js');?>"></script>
<script src="<?php echo base_url('assets/public/js/main.js');?>"></script>
<script src="<?php echo base_url('assets/public/js/jquery.slides.min.js');?>"></script>
<script src="<?php echo base_url('assets/public/js/additional.js');?>"></script>
<!--[if IE 6]><![endif]-->
<?php if (!empty($js_files_ext)) { foreach ($js_files_ext as $ext): ?>
<script src="<?php echo $ext; ?>"></script>
<?php endforeach; } ?>
<?php
    /*
    * MINIFY JS
    * ----------------------
    * Add js files that want to be minify
    */
    // Add / Change default dir
    $this->minify->assets_dir = 'assets/public/js';
    // Add javascripts
    $javascripts = [
            "public/js/libs/jquery-2.0.2.min.js",
            "public/js/libs/jquery.easing.1.3.js",
            "public/js/libs/gumby.min.js",
            "public/js/plugins.js",
        ];
    // Minify Library JS
    $this->minify->js($javascripts);
    /*
     * Adding additional javascript from controller
     */
    foreach ($js_files as $group => $file):
        // Add js to minified
        //$this->minify->add_js($file, $group);
    endforeach;
    //
    /*
     * ----------------- BEWARE OF DEPLOYING | ALWAYS SET TO FALSE AFTER RECOMPILE ------------------
     * Recompile javascript!!! Set this to true every times you add javascripts library from anywhere
     * delete assets/public/js/scripts.min.js to recompile again
     */
    // echo $this->minify->deploy_js(FALSE);
?>
<!--script src="<?php // echo base_url('assets/public/js/main.js');?>"></script-->
<!-- only include animate.js on
    pages you want to use animations on
    <script src="js/animate.js"></script> -->
<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
<!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->
<script type="text/javascript">
$(document).ready(function() {
  //$('#slidesHome div').find('div.slide-caption').hide();
  $('#slidesHome').slidesjs({
    width: 1920,
    height: 1024,
    navigation: {
        active: false,
        previous:'class="slidesjs-previous slidesjs-navigation"',
        next:'class="slidesjs-next slidesjs-navigation"',
        effect: "slide"
        },
    play: {
      active: false,
      auto: true,
      interval: 6000,
      swap: true,
      pauseOnHover: true,
      restartDelay: 5000
   },
   callback: {
        loaded: function(number) {
            // Use your browser console to view log
            //console.log('SlidesJS: Loaded with slide #' + number);
            // Show start slide in log
            // $('#slidesjs-log .slidesjs-slide-number').text(number);
            // $('#slidesHome div').eq(number).find('div.slide-caption').hide();
        },
        start: function(number) {
            // Use your browser console to view log
            //console.log();
            //console.log($('#slidesHome div').eq(number).find('div.slide-caption').fadeIn('slow'));
            //setTimeout(function() {
                // Do something after 1 seconds
                //$('#slidesHome div').eq(number).find('div.slide-caption').fadeIn().fadeOut();
            //}, 1500);
        },
        complete: function(number) {
            // Use your browser console to view log
            //console.log('SlidesJS: Animation Complete. Current slide is #' + number);
            // Change slide number on animation complete
            //$('#slidesjs-log .slidesjs-slide-number').text(number);
            //alert($('#slidesHome div').eq(number).find('div.slide-caption').fade('slow'));
            //$('#slidesHome div').eq(number).find('div.slide-caption').fadeOut();
            //setTimeout(function() {
                // Do something after 1 seconds
                //$('#slidesHome div').eq(number).find('div.slide-caption').fadeOut();
            //}, 1000);
        }
    }
  });
});
</script>
<?php if ($this->chat) { ?>
<script type="text/javascript">!function(){var a=document.createElement("script");a.src="https://galleryuseastprod.blob.core.windows.net/velaroscripts/20479/globals.js";var b=document.createElement("script");b.src="https://eastprodcdn.azureedge.net/bundles/velaro.inline.js";var c=document.getElementsByTagName("script")[0];c.parentNode.insertBefore(a,c),a.onload=function(){c.parentNode.insertBefore(b,c)},b.onload=function(){Velaro.Globals.ActiveSite=20479,Velaro.Globals.ActiveGroup=0,Velaro.Globals.InlineEnabled=!0,Velaro.Globals.VisitorMonitoringEnabled=!0,Velaro.Globals.InlinePosition=0}}();</script>
<?php } ?>
</body>
</html>
