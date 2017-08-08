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
                    <a href="<?php echo base_url('news');?>">News</a>
                </h6>
            </div>
            <div class="four columns text-right"></div>
        </div>
    </div>
    <!-- begin notes -->
    <section class="grey stripe-bg">
        <div class="two-third">
            <div class="row">
                <div class="columns">
                <?php
                    echo form_open('',['name'=>'filter[tags]','method'=>'GET','rel'=>uri_string()]);
                    ?>
                    <ul>
                        <li class="columns picker">
                            <select name="filter">
                                <option value="" readonly>Filter By Tags</option>
                                <?php
                                foreach ($tags_filter as $tags) { ?>
                                    <option value="<?php echo urlencode($tags);?>" <?php echo $filter_cats == $tags ? 'selected' :'';?>><?php echo $tags; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </li>
                    </ul>
                    <?php
                    echo form_close();
                ?>
                </div>
                <div class="columns">
                <?php
                    echo form_open('',['name'=>'filter[year]','method'=>'GET','rel'=>uri_string()]);
                    ?>
                    <ul>
                        <li class="columns picker">
                            <select name="filter">
                                <option value="" readonly>Filter By Year</option>
                                <?php
                                foreach ($time_filter as $time) { ?>
                                    <option value="<?php echo urlencode($time);?>" <?php echo $filter_year == $time ? 'selected':'';?>><?php echo $time; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </li>
                    </ul>
                    <?php
                    echo form_close();
                ?>
                </div>
            </div>
            <!-- begin posts -->
            <ul class="grid alt-posts" id="posts">
                <?php foreach ($rows as $row) { ?>
                    <li class="post">
                        <?php if ($row->media) { ?>
                        <!-- post image -->
                        <div class="post-img">
                            <img src="<?php echo base_url('uploads/news/'.$row->media);?>" alt="post-img-anthem" />
                        </div>
                        <?php } ?>
                        <div class="post-info">
                                <a href="<?php echo base_url('news/'.$row->url);?>" title="Read Post"><h1 class="grid-title"><?php echo $row->subject;?></h1></a>
                            <div class="post-meta">
                                <span> <span><a href="<?php echo base_url('news/'.$row->url);?>"><?php echo date('M d, Y',strtotime($row->publish_date));?></a></span></span>
                            </div>
                            <div class="post-content">
                                <p class="intro">
                                    <?php echo word_limiter(strip_tags($row->text),30);?>
                                    <!-- INTRO ARTIKEL -->
                                </p>
                                <!-- Selengkapnya button -->
                                <a href="<?php echo base_url('news/'.$row->url);?>" class="icon-button">Selengkapnya<i class="fa fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <div class="post-nav grey">
                <div class="row">
                    <div class="eight columns">
                        <?php echo $links;?>
                    </div>
                </div>
            </div>
            <!-- end posts -->
        </div>
        <?php $this->load->view('template/public/right_menu');?>
        <!-- clear floats -->
        <div class="clear">
        </div>
    </section>
</div>
