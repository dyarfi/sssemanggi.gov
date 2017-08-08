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
                        <a href="<?php echo base_url('promo');?>">Promo</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>                        
                        <a href="#"><?php echo $row->subject;?></a> 
                        
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
                            <?php if ($row->media) { ?>
                            <div class="post-img">
                                <img src="<?php echo base_url('uploads/news/'.$row->media);?>" alt="<?php echo $row->media;?>"/>
                            </div>
                            <?php } ?>
                            <div class="post-info">
                                <!-- post title -->
                                <h1 class="grid-title"><?php echo $row->subject;?></h1>
                                <div class="post-meta">
                                    <span><?php echo date('M d, Y',strtotime($row->publish_date));?> <!--| <?php echo ($row->count) ? $row->count : 0;?> views--></span>
                                </div>
                                <div class="post-content">                                                    
                                    <?php echo $row->text;?>
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
