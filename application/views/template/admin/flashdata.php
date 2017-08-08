<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php if ($this->session->flashdata('flashdata')): ?>
<div class="overlay overlay-hugeinc open">
	<button type="button" class="overlay-close">Close</button>
	<nav>
		<div class="flashdata"><?php echo $this->session->flashdata("flashdata"); ?></div>
	</nav>	
</div>		
<?php endif; ?>
<?php if ($this->session->flashdata('message')): ?>
<div class="overlay overlay-hugeinc open">
	<button type="button" class="overlay-close">Close</button>
	<nav>		
		<div class="message"><?php echo $this->session->flashdata("message"); ?></div>
	</nav>
</div>
<?php endif; ?>