<!DOCTYPE html>
<!--[if gt IE 9]><!-->
<html class="no-js" lang="id" itemscope itemtype="http://schema.org/Product">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="msvalidate.01" content="A0A21A55BF8A5297D8AA00CEF63298E3" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, shrink-to-fit=no"> -->

<meta name="viewport" content="width=device-width, initial-scale=1" />
<!--meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1"-->
<title><?php echo ($page_title) ? $page_title .' | '. @$this->site_name : ''; ?></title>
<meta name="description" content="<?php echo $this->site_description ? $this->site_description : lang('meta_description');?>"/>
<meta name="keywords" content="<?php echo $this->site_keywords ? $this->site_keywords : lang('meta_keywords');?>"/>
<meta name="author" content="">
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
<!-- <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />     -->
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
        // Main Frameworks
        "public/css/bootstrap.css",
        //"public/css/font-awesome.min.css",
        //"public/css/halcyon-icons.min.css",
        //"public/css/halcyon-school-icons.min.css",
        //"public/css/halcyon-interface-icons.min.css",
        //"public/css/halcyon-office-icons.min.css",
        // Main Site CSS
        //"public/css/dark.css",        
        //"public/css/font-icons.css", 
        //"public/css/animate.css", 
        //"public/css/responsive.css",     
        //"public/css/pages-style.css",
        //"public/css/custom.css",
        "public/css/style.css",
        "public/css/swiper.css",
        "public/css/dark.css",
        "public/css/font-icons.css",
        "public/css/animate.css",
        "public/css/magnific-popup.css",
        "public/css/responsive.css"
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
<!--Style-->
<?php if (!empty($css_files_ext)) { foreach ($css_files_ext as $ext): ?>
<link rel="stylesheet" type="text/css" href="<?php echo $ext; ?>">
<?php endforeach; } ?>
<!--Style-->
<!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/css/ie8-and-down.css'); ?>" /><![endif]-->
<!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/css/ie8-and-down.css'); ?>" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/css/ie7only.css'); ?>"><![endif]-->
<!--[if IE 6]>
    <link rel="stylesheet" type="text/css" href="https://necolas.github.io/normalize.css/5.0.0/normalize.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/public/css/ie6only.css'); ?>">
<![endif]-->
<script type="text/javascript">var base_URL = '<?php echo base_url();?>';</script>
<?php if (!empty($this->ga_analytics->value)) { echo $this->ga_analytics->value; } ?>
</head>
<body class="stretched">
    <!-- Document Wrapper
    ============================================= -->
    <div id="wrapper" class="clearfix">
<?php $this->load->view('template/public/header'); ?>
<?php $this->load->view('flashdata'); ?>
<?php $this->load->view($main); ?>
<?php $this->load->view('template/public/footer'); ?>
    </div><!-- MAIN CONTAINER -->
<!-- SCROLL UP -->
<a id="scroll-up" class="waves"><i class="fa fa-angle-up"></i></a>
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
            //"public/js/jquery-2.2.3.min.js",
            "public/js/jquery.js",            
            //"public/js/bootstrap.min.js",
            //"public/js/plugins.js",
            //"public/js/functions.js",   
            //"public/js/custom.js"
        ];
    // Minify Library JS
    $this->minify->js($javascripts);
    /*
     * Adding additional javascript from controller
     */
    foreach ($js_files as $group => $file):
        // Add js to minified
        $this->minify->add_js($file, $group);
    endforeach;
    //
    /*
     * ----------------- BEWARE OF DEPLOYING | ALWAYS SET TO FALSE AFTER RECOMPILE ------------------
     * Recompile javascript!!! Set this to true every times you add javascripts library from anywhere
     * delete assets/public/js/scripts.min.js to recompile again
     */
    echo $this->minify->deploy_js(FALSE);
?>
<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
<!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->
<script type="text/javascript" src="<?php echo base_url('assets/public/js/plugins.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/public/js/functions.js');?>"></script>
<script type="text/javascript">
$(document).ready(function() {
    <?php echo ($js_inline) ? "\t".$js_inline."\n" : "";?>
      $('.flexslider').flexslider({
        animation: "slide",
        controlsContainer: $(".nav-controllers"),
        customDirectionNav: $(".nav-controllers a")
      });
});
</script>
</body>
</html>
