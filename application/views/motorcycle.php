<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- action class for animating page content when header is active -->
<div class="action step-right">        
    <div id="crumbs" class="white">
        <div class="row large">
            <div class="eight columns">
                <!-- page title -->
                <h6 class="sub-heading">SUZUKI MOTORCYCLE PRODUCTS</h6>
                <!--portfolio filters -->
                <div id="options">
                    <ul id="filters" class="option-set">
                        <li>&nbsp; | &nbsp; <a href="#" data-filter="*" class="selected">All</a></li>
                        <?php foreach ($categories as $category) { ?>                        
                        <li><a href="#" data-filter=".<?php echo $category->url;?>"><?php echo $category->subject;?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="four columns text-right">
            </div>
        </div>
    </div>        
    <!-- begin projects -->
    <section class="work grey stripe-bg">
    <ul class="grid filter times-three basic" id="projects">
        <?php foreach ($motorcycles as $motorcycle) { ?>
            <li class="grid-item <?php echo $motorcycle->category->url;?> graphics">
                <div class="grid-project">         
                    <div class="img-box">
                        <img src="<?php echo base_url('uploads/motorcycle/'.str_replace($motorcycle->thumbnail, 'thumb__600x385'.$motorcycle->thumbnail, $motorcycle->thumbnail));?>" alt="project" class="zoom-on-hover">
                        <div class="icon-box">                            
                            <a href="<?php echo base_url('motorcycle/'.$motorcycle->url);?>" class="cats white line-button" style="text-align:center">DETAIL PRODUK<!--i class="fa fa-plus"></i--></a>
                        </div>
                    </div>                    
                    <a href="<?php echo base_url('motorcycle/'.$motorcycle->url);?>" title="View Project">
                    <div class="project-info">
                        <h1 class="grid-title"><?php echo $motorcycle->subject;?></h1>
                        <h6 class="project-cat"><?php echo $motorcycle->category->subject;?></h6>
                    </div>
                    </a>
                </div>
            </li>
        <?php } ?> 
    </ul>
    <!-- clear floats -->
    <div class="clear">
    </div>
    </section>
</div>

















            