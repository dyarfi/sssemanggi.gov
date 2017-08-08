<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="bottom-menu">
	<div class="big-menu">
		<div class="icon-big">
			<img src="<?php echo base_url('assets/static/img/'.@$this->ext_logo->value);?>">
		</div>
		<div class="text-big">
			<p><?php echo @$this->ext_link->alias;?></p>
			<a target="_blank" href="<?php echo @$this->ext_link->value;?>"><?php echo lang('view_detail');?></a>
		</div>
	</div><!--end.bihmenmu-->
</div>