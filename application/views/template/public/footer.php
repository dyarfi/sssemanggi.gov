<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- widgetized footer -->            
<footer id="colophon">
    <div class="row large">
        <div class="six columns">
            <p><?php echo @$this->copyright->value;?></p>
        </div>        
    </div>
</footer>
<?php $this->load->view('template/public/bottom_content');?>
