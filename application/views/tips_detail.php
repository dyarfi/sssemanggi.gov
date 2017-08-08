<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

    <!-- action class for animating page content when header is active -->
    <div class="action step-right">
        
            <!-- #crumbs for page title bar and top navigation -->
            <div id="crumbs" class="white">
                <div class="row large">
                    <!-- page title/statement -->
                    <div class="nine columns">
                        <h6 class="sub-heading">
                        <a href="index.html">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        <a href="<?php echo base_url('promo');?>">Tips dan Triks</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>                        
                        <a href="#"><?php echo $row->sts_subject;?></a> 
                        
                        </h6>
                    </div>
                    <div class="six  columns text-right">

                    </div>
                </div>
            </div>
            
        <section class="grey stripe-bg">
            <!-- post content -->
            <div class="two-third">
                <div id="single-post">
                    <!-- post container -->
                    <ul class="grid alt-posts" id="posts">
                        <!-- begin post -->
                        <li class="post">
                            <!-- post  img header -->
                            <?php if ($row->sts_media) { ?>
                            <div class="post-img">
                                <img src="<?php echo base_url('uploads/news/'.$row->sts_media);?>" alt="<?php echo $row->sts_media;?>"/>
                            </div>
                            <?php } ?>
                            <div class="post-info">
                                <!-- post title -->
                                <h1 class="grid-title"><?php echo $row->sts_subject;?></h1>
                                <div class="post-meta">
                                    <span><?php echo date('M d, Y',strtotime($row->sts_publish_date));?> | <?php echo ucfirst($row->sts_type);?> <!--| <?php echo ($row->count) ? $row->count : 0;?> views--></span>
                                </div>
                                <div class="post-content">                                                    
                                    <?php echo $row->sts_text;?>
                                </div>
                            </div>
                        </li>
                    </ul>
            
                </div>
            </div>
            <!-- sidebar -->
            <?php $this->load->view('template/public/right_news');?>  
        <!-- clear floats -->
        <div class="clear"></div>
        </section>
    </div>
