<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta name="robots" content="noindex,nofollow">
<meta charset="utf-8"/>
<title><?php echo ($page_title) ? $page_title .' - ' : '';?><?php echo $this->config->item('development_name');?> | Admin Dashboard</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/admin/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/admin/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<?php if (!empty($css_files)) { foreach ($css_files as $file): ?>
<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; }?>
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<!--<link href="<?php echo base_url()?>assets/admin/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/admin/plugins/clockface/css/clockface.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/admin/plugins/bootstrap-datepicker/css/datepicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/admin/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/admin/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/admin/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/admin/plugins/fancybox/source/jquery.fancybox.css"/>
<link href="<?php echo base_url()?>assets/admin/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
<!--<link href="<?php echo base_url()?>assets/admin/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>-->
<link href="<?php echo base_url()?>assets/admin/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/admin/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/admin/plugins/select2/select2-metronic.css"/>
<link rel="stylesheet" href="<?php echo base_url()?>assets/admin/plugins/data-tables/DT_bootstrap.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url()?>assets/admin/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/admin/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/admin/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/admin/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/admin/css/pages/tasks.css" rel="stylesheet" type="text/css"/>
<!--link href="<?php echo base_url()?>assets/admin/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/-->
<!--link href="<?php echo base_url()?>assets/admin/css/themes/grey.css" rel="stylesheet" type="text/css" id="style_color"/-->
<link href="<?php echo base_url()?>assets/admin/css/print.css" rel="stylesheet" type="text/css" media="print"/>
<link href="<?php echo base_url()?>assets/admin/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<!--<link rel="shortcut icon" href="favicon.ico"/>-->
<script>var base_URL = '<?php echo base_url()?>';var base_ADM = '<?php echo base_url(ADMIN)?>';</script>
<body>
<?php $this->load->view($main); ?>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]><script src="<?php echo base_url()?>assets/admin/plugins/respond.min.js"></script><script src="<?php echo base_url()?>assets/admin/plugins/excanvas.min.js"></script><![endif]-->
<script src="<?php echo base_url()?>assets/admin/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url()?>assets/admin/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/plugins/bootstrap/js/bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!--<script type="text/javascript" src="<?php echo base_url()?>assets/admin/plugins/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/admin/plugins/flot/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/admin/plugins/flot/jquery.flot.categories.min.js"></script>-->
<script src="<?php echo base_url()?>assets/admin/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/plugins/fancybox/source/jquery.fancybox.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!--<script src="<?php echo base_url()?>assets/admin/plugins/jquery.pulsate.min.js" type="text/javascript"></script>-->
<!--<script src="<?php echo base_url()?>assets/admin/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>-->
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="<?php echo base_url()?>assets/admin/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<!--<script src="<?php echo base_url()?>assets/admin/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>-->
<script src="<?php echo base_url()?>assets/admin/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/admin/plugins/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/admin/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/admin/plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/admin/plugins/data-tables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/admin/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/admin/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/admin/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/admin/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/admin/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<?php if (!empty($js_files)) { foreach ($js_files as $file): ?>
<script src="<?php echo $file; ?>"></script>
<?php endforeach; } ?>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url()?>assets/admin/scripts/core/app.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/scripts/custom/index.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/scripts/custom/tasks.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/admin/scripts/custom/table-managed.js"></script>
<script src="<?php echo base_url()?>assets/admin/scripts/custom/components-pickers.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN USER CUSTOM JAVASCRIPTS -->
<script src="<?php echo base_url()?>assets/admin/scripts/custom/form-status.js" type="text/javascript"></script>
<!-- END USER CUSTOM JAVASCRIPTS -->
<script>
jQuery(document).ready(function() {
    App.init(); // initlayout and core plugins
    TableManaged.init();
    ComponentsPickers.init();

    Index.init(); // init index page's custom scripts

    // Custom JS in admin pages
	FormStatus.init();

<?php echo ($js_inline) ? "\t".$js_inline."\n" : "";?>
<?php if ($this->session->flashdata('message')) { ?>
	bootbox.alert('<h3><?php echo $this->session->flashdata('message');?></h3>');
<?php } ?>
});
</script>
</body>
</html>
