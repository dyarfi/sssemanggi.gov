<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php /*
<!-- action class for animating page content when header is active -->
<div class="action step-right">
<!-- #crumbs for page title bar and top navigation -->
    <div id="crumbs" class="white">
        <div class="row large">
            <div class="eight columns">
                <!-- page title -->
                <h6 class="sub-heading">
                    <a href="<?php echo base_url();?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    <a href="#"><?php echo $detail->subject;?></a>
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
                        <?php if ($row->cover) { ?>
                        <!-- post image -->
                        <div class="post-img">
                            <img src="<?php echo base_url('uploads/pages/'.$row->cover);?>" alt="post-img-anthem" />
                        </div>
                        <?php } ?>
                        <div class="post-info">
                                <a href="<?php echo base_url('corporate/page-environment/'.$row->url);?>" title="Read Post"><h1 class="grid-title"><?php echo $row->subject;?></h1></a>
                            <div class="post-meta">
                                <span> <span><a href="<?php echo base_url('corporate/page-environment/'.$row->url);?>"><?php echo date('M d, Y',strtotime($row->publish_date));?></a></span></span>
                            </div>
                            <div class="post-content">
                                <p class="intro">
                                    <?php echo word_limiter(strip_tags($row->text),30);?>
                                    <!-- INTRO ARTIKEL -->
                                </p>
                                <!-- Selengkapnya button -->
                                <a href="<?php echo base_url('corporate/page-environment/'.$row->url);?>" class="icon-button">Selengkapnya<i class="fa fa-chevron-right"></i></a>
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

        <?php $this->load->view('template/public/right_menu');?>

        <!-- clear floats -->
        <div class="clear">
        </div>
    </section>
</div>
*/
?>

<!-- action class for animating page content when header is active -->
<div class="action step-right">

    <!-- page content -->
    <!-- img header -->
    <section class="page-header img-section dark img-marine-detail" style="background-image:url(<?php echo base_url('uploads/pages/'.$detail->media);?>);">
        <div class="content-block black-tint">
            <div id="crumbs" class="abs">
                <div class="row large light">
                    <div class="six columns">
                        <!-- page title/statement -->
                        <h6 class="sub-heading">
                        <a href="<?php echo base_url();?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            <a href="#"><?php echo $detail->subject;?></a>
                        </h6>
                    </div>
                    <div class="six columns text-right"></div>
                </div>
            </div>
            <!-- page statement -->
            <div class="row bigtoppadding">
                <div class="twelve columns text-center">
                    <h1 class="block-heading uppercase"><?php echo $detail->subject;?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="grey stripe-bg">
        <!-- two third /left side-->
        <div class="two-third white">
            <div id="single-page">
            <?php echo $detail->text;?>
            </div>
        </div>
        <!-- sidebar -->
        <aside class="one-third grey">
        <div id="sidebar">
            <!-- category widget -->
            <div class="widget">
                <h5 class="stripe-heading">KORPORAT</h5>
                <div class="widget-content">
                    <ul class="categories">
                        <?php foreach ($this->corporates as $page) {
                            $url_type = ($page->type == 'page-listing' && $page->name != NULL) ? base_url('corporate/'.$page->name) : base_url('corporate/'.$page->url); ?>
                        <li><a href="<?php echo $url_type;?>"><?php echo $page->subject; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        </aside>
        <!-- clear floats -->
        <div class="clear"></div>
    </section>


</div>
