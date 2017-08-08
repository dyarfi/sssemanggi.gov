<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0, user-scalable=no" />
	<title><?php echo $page_title; ?></title>
	<!-- Core JavaScript Files -->
	<script src="<?php echo base_url();?>assets/public/js/libs/jquery-1.9.1.min.js"></script>
	<!--script src="<?php echo base_url();?>assets/public/js/bootstrap.min.js"></script-->
	<!--script src="<?php echo base_url();?>assets/public/js/jquery.easing.min.js"></script-->
	<!-- Custom Theme JavaScript -->
	<!--script src="<?php echo base_url();?>assets/public/js/custom.blank.js"></script-->
	<script type="text/javascript">
		var base_URL = '<?php echo base_url();?>';
	</script>
    <!--link href="<?php echo base_url();?>assets/public/css/blank.css" rel="stylesheet"-->
    <!--link href="<?php echo base_url();?>assets/public/css/style.css" rel="stylesheet"-->
</head>
<body>
<?php $this->load->view($main); ?>
<script type="text/javascript">
jQuery(document).ready(function() {
  // Blank.init();
  $('.reload_captcha').on('click',function() {
        var url = $(this).attr('rel');
        $.ajax({
            type: "POST",
            url: url,
            //cache: false,
            //async: true,
            success: function(msg){
                $('.reload_captcha').empty().html(msg);
                // Need random for browser recache
                img = $('.reload_captcha').find('img');
                src = img.attr('src');
                ran = img.fadeOut(50).fadeIn(50).attr('src', src + '?=' + Math.random());
            },
            complete: function(msg) {},
            error: function(msg) {}
        });
        return false;
    });
    $('#form_order').submit(function(e){
        var frm = $(this);
        var url = frm.attr('action');
		frm.find('button.purple.fill-button').prop('disabled',true);
        $.ajax({
            type: "POST",
            url: url,
            data: $(this).serializeArray(),
            //cache: false,
            //async: true,
            success: function(json){
                frm.find('span.warning').empty();
                frm.find('.warning.light.note').empty().fadeIn();
                if (json.result.errors) {
                    $.each(json.result.errors, function (key, error) {
                        frm.find('label[for="'+key+'"] span').html(error);
                    });
					frm.find('submit.purple.fill-button').prop('disabled',false);
                }
                if (json.result.status != 1) {
                    frm.find('.warning.light.note').text(json.result.message).fadeIn();
					frm.find('button.purple.fill-button').prop('disabled',false);
                    //return false;
                }
                if(json.result.status == 1) {
                    frm.find('.warning.light.note').text(json.result.message).fadeIn();
                    setTimeout(function() {
                        // Do something after 5 seconds
                        window.location.href = json.result.data.referer;
                    }, 1000);
                    $('.reload_captcha').click();
                }
            },
            complete: function(json) {},
            error: function(json) {}
        });
        return false;
    });
});
</script>
</body>
</html>
