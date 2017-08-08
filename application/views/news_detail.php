<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

    <!-- action class for animating page content when header is active -->
    <div class="action step-right">

            <!-- #crumbs for page title bar and top navigation -->
            <div id="crumbs" class="white">
                <div class="row large">
                    <!-- page title/statement -->
                    <div class="nine columns">
                        <h6 class="sub-heading">
                        <a href="<?php echo base_url();?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        <a href="<?php echo base_url('news');?>">News</a> <i class="fa fa-chevron-right" aria-hidden="true"></i> <a href="#"><?php echo $row->subject;?></a>

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
                                    <div class="pull-right">
                                        <ul class="share list-inline addthis_default_style addthis_32x32_style img-slider-nav">
                                        <li>
                                            <a data-original-title="Twitter" rel="tooltip" href="javascript:;" class="btn btn-twitter addthis_button_twitter" data-placement="left">
                                                <i class="fa fa-twitter fa-1x"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-original-title="Facebook" rel="tooltip" href="javascript:;" class="btn btn-facebook addthis_button_facebook" data-placement="left">
                                                <i class="fa fa-facebook fa-1x"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-original-title="Google+" rel="tooltip" href="javascript:;" class="btn btn-google addthis_button_google_plusone_share" data-placement="left">
                                                <i class="fa fa-google-plus fa-1x"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-original-title="LinkedIn" rel="tooltip" href="javascript:;" class="btn btn-linkedin addthis_button_linkedin" data-placement="left">
                                                <i class="fa fa-linkedin fa-1x"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-original-title="Pinterest" rel="tooltip" href="javascript:;" class="btn btn-pinterest addthis_button_pinterest_share" data-placement="left">
                                                <i class="fa fa-pinterest fa-1x"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a  data-original-title="Email" rel="tooltip" href="javascript:;" class="btn btn-mail addthis_button_email" data-placement="left">
                                                <i class="fa fa-envelope fa-1x"></i>
                                            </a>
                                        </li>
                                    </ul>
            				            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-592e894372cae779" async="async"></script>
                                    </div>
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
