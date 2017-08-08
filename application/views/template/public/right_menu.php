<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>
<!-- #sidebar -->
<aside class="one-third grey">
    <div id="sidebar">
        <!-- category widget -->
        <div class="widget">
            <h5 class="stripe-heading">PRODUK</h5>
            <div class="widget-content">
                <ul class="categories">
                    <?php foreach ($this->products as $product) { ?>                                
                    <li><a href="<?php echo base_url($product->name);?>"><?php echo $product->subject;?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <!-- category widget -->
        <div class="widget">
            <h5 class="stripe-heading">KORPORAT</h5>
            <div class="widget-content">
                <ul class="categories">
                    <?php foreach ($this->corporates as $page) { 
                        $url_type = ($page->type == 'page-listing' && $page->name != NULL) ? base_url('corporate/'.$page->name) : base_url('corporate/'.$page->url); ?>
                    <li><a href="<?php echo $url_type;?>"><?php echo $page->subject; ?></a></li>                                
                    <?php } ?>
                </ul>
            </div>
        </div>        
    </div>
</aside>
<!-- end #sidebar -->