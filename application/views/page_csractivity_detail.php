<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

    <!-- action class for animating page content when header is active -->
    <div class="action step-right">
        
            <!-- #crumbs for page title bar and top navigation -->
            <div id="crumbs" class="white">
                <div class="row large">
                    <!-- page title/statement -->
                    <div class="six columns">
                        <h6 class="sub-heading">
                        <a href="<?php echo base_url();?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        <a href="<?php echo base_url('corporate/page-csr');?>">CSR</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        <?php echo word_limiter($detail->subject,7);?>
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
                                <?php if ($detail->media) { ?>
                                <div class="post-img">
                                    <img src="<?php echo base_url('uploads/news/'.$detail->media);?>" alt="<?php echo $detail->media;?>"/>
                                </div>
                                <?php } ?>
                                <div class="post-info">
                                    <!-- post title -->
                                    <h1 class="grid-title"><?php echo $detail->subject;?></h1>
                                    <div class="post-meta">
                                        <span><?php echo date('M d, Y',strtotime($detail->publish_date));?> | <?php echo ($detail->count) ? $detail->count : 0;?> views</span>
                                    </div>
                                    <div class="post-content">                                                    
                                        <?php echo $detail->text;?>
                                    </div>
                                </div>
                            </li>
                        </ul>
                
                    </div>
                </div>
                <!-- sidebar -->
            <?php $this->load->view('template/public/right_menu');?>  
        <!-- clear floats -->
        <div class="clear"></div>
        </section>
    </div>
