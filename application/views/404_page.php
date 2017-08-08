<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<!-- action class for animating page content when header is active -->
<div class="action step-right">
    <!-- page content -->
    <!-- img header -->
    <section class="header-halo" style="background-image:url(<?php echo base_url('assets/public/images/profile_bg.jpg')?>);">
        <div class="black-tint has-button">
            <div id="crumbs" class="abs">
                <div class="eight columns">
                    <h6 class="sub-heading">
                        <a href="<?=base_url();?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        <a href="#"><?php echo lang('404_page');?></a>
                    </h6>
                </div>
            </div>
            <span class="sub-lite"></span>
        </div>
    </section>
    <section class="white-bg">
        <div class="row">
            <section class="single-page search-page">
                <div class="row smallsidepadding midpadding">
                    <h2 class="page-title stripe-heading center"><?php echo lang('404_page');?></h2>
                    <div class="midpadding">
                        <a href="<?php echo base_url();?>" title="Kembali">Kembali <span class="fa fa-chevron-right"></span></a>
                    </div>
                </div>
                <div class="row smallsidepadding">
                    <h4>Berita Terbaru</h4>
                </div>
                <div class="midpadding">
                    <?php foreach ($rows as $row) { ?>
                    <div class="grey">
                        <div class="six columns smallsidepadding smallpadding">
                            <a href="<?php echo base_url('news/'.$row->url);?>" title="Read Post">
                                <h5><?php echo $row->subject;?></h5>
                            </a>
                            <a href="<?php echo base_url('news/'.$row->url);?>"><?php echo date('M d, Y',strtotime($row->publish_date));?></a>
                            <div class="post-content">
                                <p class="intro">
                                    <?php echo word_limiter(strip_tags($row->text),20);?>
                                    <!-- INTRO ARTIKEL -->
                                </p>
                                <!-- Selengkapnya button -->
                                <a href="<?php echo base_url('news/'.$row->url);?>" class="icon-button">Selengkapnya<i class="fa fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </section>
        </div>
        <!-- sidebar -->
        <!-- clear floats -->
        <div class="clear"></div>
        <br/><br/><br/><br/>
    </section>
</div>
