<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo $page_title;?></title>
<?php foreach ($css_files as $file): ?>
<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<style type='text/css'>
body {
	font-family: Arial;
	font-size: 14px;
}
a {
	color: blue;
	text-decoration: none;
	font-size: 14px;
}
a:hover {
	/*text-decoration: underline;*/ text-decoration: none;
}
.gray {
	color: #CCCCCC
}
</style>
<?php if (!empty($css_files_ext)) { foreach ($css_files_ext as $ext): ?>
<link rel="stylesheet" type="text/css" href="<?php echo $ext; ?>">
<?php endforeach; } ?>
<script>var base_URL = '<?php echo base_url();?>';var base_ADM = '<?php echo base_url(ADMIN);?>';</script>
</head>
<body>
<h2>
	<small class="gray">
	<?php 
		foreach ($notes as $note => $val) { 
			echo '<span class="'.$note.'">';
			if ($val['dimension']) {
				echo sprintf(lang('best_dimension'),$val['dimension']);
				echo '. ';
			} if ($val['ext']) {
				echo sprintf(lang('extension'), $val['ext']);				
			}
			echo '</span>';
    	}
	?>
	</small>
</h2>
<?php echo $output; ?>
<?php if (!empty($js_files_ext)) { foreach ($js_files_ext as $ext): ?>
<script src="<?php echo $ext; ?>"></script>
<?php endforeach; } ?>
<?php foreach ($js_files as $file): ?>
<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style>
  /* Always set the map height explicitly to define the size of the div
   * element that contains the map. */
  #map {
    width:300px;
    height: 100%;
  }
  #floating-panel {
    /*position: absolute;*/
    /*top: 10px;*/
    /*left: 25%;*/
    z-index: 5;
    background-color: #fff;
    padding: 5px;
    border: 1px solid #999;
    text-align: center;
    font-family: "Roboto","sans-serif";
    line-height: 30px;
    padding-left: 10px;
  }
  input[type="textbox"] {
  	width: 390px;
  }
</style>
<script>
$(document).ready(function() {
<?php if ($this->session->flashdata('message')) { ?>
	$.colorbox.close();
<?php } ?>
	//input_file = $('.gc-file-upload').attr('id');
	//input_id = 'upload_info_'+input_file;
	//console.log(input_id.accepted_file_types);
	if(!$(".gray").is(':empty')) {
		$(".gray").hide();
		$(".gray span").each(function() {
			var div = $(this).attr('class');
			$('[id^="'+div+'_field_box"] #'+div+'_input_box').append('<div><small>' + $(this).html() + '</small></div>');
		});
	}
    $( ".tabs" ).tabs();
	<?php echo ($js_inline) ? "\t".$js_inline."\n" : "";?>
});
</script>
</body>
</html>