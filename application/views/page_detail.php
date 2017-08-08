<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- action class for animating page content when header is active -->
<div class="action step-right">
        
    <!-- page content -->
    <!-- img header -->
    <section class="page-header img-section dark img-marine-detail" style="background-image:url(<?php echo base_url('uploads/pages/'.$detail->media);?>);">
        <div class="content-block black-tint">            
            <div id="crumbs" class="abs">
                <div class="row large light">
                    <div class="six columns">
                        <!-- page title/statement -->
                        <h6 class="sub-heading">
                        <a href="<?php echo base_url();?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            <a href="#"><?php echo $detail->subject;?></a>
                        
                        </h6>
                    </div>
                    <div class="six columns text-right"></div>
                </div>
            </div>
            <!-- page statement -->
            <div class="row bigtoppadding">
                <div class="twelve columns text-center">
                    <h1 class="block-heading uppercase"><?php echo $detail->subject;?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="grey stripe-bg">
        <!-- two third /left side-->
        <div class="two-third white">
            <div id="single-page">                        
            <?php echo $detail->text;?>
            </div>
        </div> 
        <!-- sidebar -->
        <aside class="one-third grey">
        <div id="sidebar">
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
        <!-- clear floats -->
        <div class="clear"></div>
    </section>


</div>