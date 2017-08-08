<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>
<!-- action class for animating page content when header is active -->
<div class="action step-right">            
    <div id="crumbs" class="white">
        <div class="row large">
            <div class="eight columns">
                <!-- page title -->
                <h6 class="sub-heading">SUZUKI AUTOMOBILE PRODUCTS</h6>
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
                <!-- top on-page nav 
                <ul class="nav-icon-list">
                    <li><a class="planner-btn"><span>Planner</span><i class="fa fa-book"></i></a></li>
                    <li><a class="search-btn"><span>Search</span><i class="fa fa-search"></i></a></li>
                </ul>
                -->
            </div>
        </div>
    </div>
    <!-- begin projects -->
    <section class="work grey stripe-bg">       
        <ul class="grid filter times-three basic" id="projects">
            <?php foreach ($automobiles as $automobile) { ?>
            <li class="grid-item <?php echo $automobile->category->url;?> graphics">
                <div class="grid-project">         
                    <div class="img-box">
                        <img src="<?php echo base_url('uploads/automobile/'.str_replace($automobile->thumbnail, 'thumb__600x385'.$automobile->thumbnail, $automobile->thumbnail));?>" alt="project" class="zoom-on-hover">
                        <div class="icon-box"> 
                            <a href="<?php echo base_url('automobile/'.$automobile->url);?>" class="cats white line-button" style="text-align:center">DETAIL PRODUK<!--i class="fa fa-plus"></i--></a>
                        </div>
                    </div>                    
                    <a href="<?php echo base_url('automobile/'.$automobile->url);?>" title="View Project">
                    <div class="project-info">
                        <h1 class="grid-title"><?php echo $automobile->subject;?></h1>
                        <h6 class="project-cat"><?php echo $automobile->category->subject;?></h6>
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