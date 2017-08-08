<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- action class for animating page content when header is active -->
<div class="action step-right">
    <section class="page-header img-section dark" style="background-image:url(<?php echo base_url('uploads/pages/'.$detail->media);?>);">
        <div class="content-block black-tint">
            <div id="crumbs" class="abs">
                <div class="row large dark">
                <div class="six columns">
                    <h6 class="sub-heading">
                    <a href="<?php echo base_url();?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        <a href="#">Tentang Gear</a>
                    </h6>
                </div>
                <div class="six columns text-right">
                    <h6 class="sub-heading"><a href="<?php echo base_url('corporate/tentang-suzuki')?>">Tentang Suzuki</a></h6>
                </div>
                </div>
            </div>
            <div class="row bigtoppadding">
                <div class="twelve columns text-center">
                    <h1 class="block-heading">TENTANG GEAR</h1>
                </div>
            </div>
        </div>
    </section>
        <?php echo $detail->text;?>
        <!-- sidebar -->
        <!-- clear floats -->
        <div class="clear"></div>
        <!-- widgetized footer -->
</div><!-- action -->
