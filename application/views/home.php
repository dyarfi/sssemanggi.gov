<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- #scrollarea adds custom scrollbar for main content -->
<div>
    <div class="action step-right">
        <!-- superslides -->
        <section class="home-slider">
            <div class="home desk">
                <div id="slidesHome" class="slides-container">
                    <?php foreach ($banners as $banner) { ?>
                        <div>
                        <?php if ($banner->media && $banner->thumb) { ?>
                        <!-- <?php echo $banner->subject;?> -->
                            <?php if ($banner->ext_url) {?>
                                <a href="<?php echo $banner->url;?>"><img class="slidejs-item hidden-phone visible-desktop" src="<?php echo base_url('uploads/banners/'.$banner->media);?>" alt="<?php echo $banner->subject;?>"></a>
                                <a href="<?php echo $banner->url;?>"><img class="slidejs-item hidden-desktop visible-tablet" src="<?php echo base_url('uploads/banners/'.$banner->thumb);?>" alt="<?php echo $banner->subject;?>"></a>
                            <?php } else { ?>
                                <img class="slidejs-item hidden-phone visible-desktop" src="<?php echo base_url('uploads/banners/'.$banner->media);?>" alt="<?php echo $banner->subject;?>">
                                <img class="slidejs-item hidden-desktop visible-tablet" src="<?php echo base_url('uploads/banners/'.$banner->thumb);?>" alt="<?php echo $banner->subject;?>">
                            <?php }
                            }
                            if ($banner->text) {
                                echo $banner->text;
                            }
                        ?>
                        </div>
                        <?php
                        }
                    ?>
                    <a href="#" class="slidesjs-next slidesjs-navigation"><img class="slide-1" src="<?php echo base_url('assets/public/images');?>/ic_next.png" alt="next"></a>
                    <a href="#" class="slidesjs-previous slidesjs-navigation"><img class="slide-1" src="<?php echo base_url('assets/public/images');?>/ic_prev.png" alt="previous"></a>
                </div>
            </div>
            <!-- slideshow direction nav -->
        </section><!-- home-slider -->
    </div>
</div><!-- scrollarea -->
