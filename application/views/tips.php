<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- action class for animating page content when header is active -->
<div class="action step-right">
<!-- #crumbs for page title bar and top navigation -->
    <div id="crumbs" class="white">
        <div class="row large">
            <div class="eight columns">
                <!-- page title -->
                <h6 class="sub-heading">
                    <a href="<?php echo base_url();?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    <a href="#">Tips dan Triks</a>                         
                </h6>                    
            </div>
            <div class="four columns text-right"> </div>
        </div>
    </div>                
    <!-- begin notes -->
    <section class="grey stripe-bg">
        <div class="two-third">
            <!-- begin posts -->
            <ul class="grid alt-posts" id="posts">
                <?php foreach ($rows as $row) { ?>           
                    <li class="post">
                        <?php if ($row->sts_media) { ?> 
                        <!-- post image -->
                        <div class="post-img">
                            <img src="<?php echo base_url('uploads/news/'.$row->sts_media);?>" alt="post-img-anthem" />
                        </div>
                        <?php } ?>
                        <div class="post-info">
                                <a href="<?php echo base_url('page-tips/'.$row->sts_url);?>" title="Read Post"><h1 class="grid-title"><?php echo $row->sts_subject;?></h1></a>
                            <div class="post-meta">
                                <span> <span><a href="<?php echo base_url('page-tips/'.$rowsts_->url);?>"><?php echo date('M d, Y',strtotime($row->sts_publish_date));?></a></span> | <?php echo ucfirst($row->sts_type);?></span>
                            </div>
                            <div class="post-content">
                                <p class="intro">
                                    <?php echo word_limiter(strip_tags($row->sts_text),30);?>
                                    <!-- INTRO ARTIKEL -->
                                </p>
                                <!-- Selengkapnya button -->
                                <a href="<?php echo base_url('page-tips/'.$row->sts_url);?>" class="icon-button">Selengkapnya<i class="fa fa-chevron-right"></i></a>
                            </div>
                        </div>                                
                    </li>                   
                <?php } ?>                                                
            </ul>
            <!-- end posts -->
            <!-- notes navigation -->
            <!--div class="post-nav grey">
                <div class="row">
                    <div class="eight columns">
                        <ul class="pagination">
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li class="current"><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">6</a></li>
                    </ul>
                </div>                                        
                    <div class="four columns text-right smalltoppadding">
                        <ul class="icon-nav">
                            <li><a href="">Next Page &nbsp; <i class="fa fa-arrow-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div-->
        </div>
                
        <!-- sidebar -->
        <?php $this->load->view('template/public/right_news');?> 

        <!-- clear floats -->
        <div class="clear">
        </div>
    </section>
</div>
