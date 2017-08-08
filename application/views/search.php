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
                        <a href="#">Search</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </h6>
                </div>    
            </div>            
            <span class="sub-lite"></span>
        </div>
    </section>
    <section class="white-bg">
        <div class="row">
            <?php // echo $detail->text; ?>
            <section class="single-page search-page">
                <article>
                    <h2 class="page-title">Hasil Pencarian</h2>
                    <h3>Pencarian untuk "<?php echo $search;?>"</h3>
                    <p class="found"><?php echo $count;?> <?php echo lang('search');?></p>
                    <div class="list_result">               
                      <?php 
                        if (!empty($html)) { 
                            echo $html;
                        } else { ?>            
                            <h3><?php echo lang('no_search');?></h3>
                        <?php } ?>  
                   </div>
                </article>
            </section>
        </div>
        <!-- sidebar -->
        <!-- clear floats -->
        <div class="clear"></div>
        <br/><br/><br/><br/>
    </section>
</div>
        