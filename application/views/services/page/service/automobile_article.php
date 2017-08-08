<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="backlit" style="display: none;"></div>

<?php $this->load->view('services/page/auth/account');?>

<!-- action class for animating page content when header is active -->
<div class="action step-right">
    <!-- #crumbs for page title bar and top navigation -->
    <div id="crumbs" class="white">
        <div class="row large">
            <div class="eight columns">
                <!-- page title -->
                <h6 class="sub-heading">
                    <a href="<?php echo base_url('services');?>">Home</a>
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    <a href="#">Tips Mobil</a>
                </h6>
            </div>
            <div class="four columns text-right">

            </div>
        </div>
    </div>

    <!-- begin notes -->
    <section class="grey stripe-bg">
        <div class="two-third">
            <!-- begin posts -->
            <ul class="grid alt-posts" id="posts">
                <?php
                foreach ($tips as $tip)
                {
                ?>
                    <li class="post">
                        <!-- post image -->
<!--                                    <div class="post-img">-->
<!--                                        <img src="assets/img/newspromo/no.jpg" alt="post-img-anthem" />-->
<!--                                    </div>-->
                        <div class="post-info">
                            <!-- Selengkapnya button -->
                            <a href="<?=base_url('services/automobile/' . $type . '/'  . $tip->url);?>" title="<?=$tip->subject;?>"><h1 class="grid-title">
                                    <?=$tip->subject;?>
                                </h1></a>
                            <div class="post-meta">
                            <span> <span><a href="<?=base_url('services/automobile/' . $type . '/'  . $tip->url);?>"><?=date('F d, Y',strtotime($tip->publish_date));?></a></span></span>
                            </div>
                            <div class="post-content">
                                <p class="intro">
                                    <?=character_limiter($tip->text, 500);?>
                                </p>
                                <!-- Selengkapnya button -->
                                <a href="<?=base_url('services/automobile/' . $type . '/'  . $tip->url);?>" class="icon-button">Selengkapnya<i class="fa fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                <?php
                }
                ?>
            </ul>
            <!-- end posts -->
            <!-- notes navigation -->
<!--                        <div class="post-nav grey">-->
<!--                            <div class="row">-->
<!--                                <div class="four columns text-left smalltoppadding">-->
<!--                                    <ul class="icon-nav">-->
<!--                                        <li><i class="fa fa-arrow-left"></i> &nbsp; <a href="news.html">Halaman Sebelumnya </a></li>-->
<!--                                    </ul>-->
<!--                                </div>-->
<!---->
<!--                                <div class="four columns">-->
<!--                                    <ul class="pagination">-->
<!--                                        <li class="current"><a href="news.html">1</a></li>-->
<!--                                        <li><a href="#">2</a></li>-->
<!--                                        <li><a href="3news.html">3</a></li>-->
<!---->
<!--                                    </ul>-->
<!--                                </div>-->
<!---->
<!--                                <div class="four columns text-right smalltoppadding">-->
<!--                                    <ul class="icon-nav">-->
<!--                                        <li><a href="3news.html">Halaman Selanjutnya &nbsp; <i class="fa fa-arrow-right"></i></a></li>-->
<!--                                    </ul>-->
<!--                                </div>-->
<!---->
<!--                            </div>-->
<!--                        </div>-->
        </div>

        <!-- sidebar -->
        <aside class="one-third grey">
            <div id="sidebar">

                <div class="widget">
                    <h5 class="stripe-heading"><?=$sidebar_title;?></h5>
                    <div class="widget-content">
                        <ul class="recent-posts">
                        <?php
                        foreach ($tips as $tip) {
                        ?>
                            <li><a href="<?=base_url('services/automobile/' . $type . '/'  . $tip->url);?>"><?=$tip->subject;?></a>
                                <span><?=date('F d, Y',strtotime($tip->publish_date));?></span></li>
                        <?php
                        }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- clear floats -->
        <div class="clear">
        </div>
    </section>
</div>
<!-- action -->
<?php
// if ($logged_in) {
?>
<!-- booking modal -->
<?php $this->load->view('services/page/booking');?>
<!-- booking modal -->
<?php
//}
?>