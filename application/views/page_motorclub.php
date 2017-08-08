<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
        <!-- action class for animating page content when header is active -->
        <div class="action step-right">
        
            <!-- #crumbs for page title bar and top navigation -->
            <div id="crumbs" class="white">
                <div class="row large">
                    <div class="eight columns">
                        <!-- page title -->
                        <h6 class="sub-heading">POJOK SUZUKI</h6>
                         &nbsp; | &nbsp; <h6 class="sub-heading">MOTOR CLUB</h6>                       
                    </div>
                    <div class="four columns text-right">
                        &nbsp; | &nbsp;<h6 class="sub-heading"><a href="<?php echo base_url('page-carclub');?>">CAR CLUB</a></h6>
                    </div>
                </div>
            </div>
            
            <section id="intro" class="img-section" style="background-image:url(<?php echo base_url('uploads/pages/'.$detail->media);?>)">                
                <?php echo $detail->text;?>
            </section>
            
            <!-- clear floats -->
            <div class="clear">
            </div>      
                     
        </div><!-- action -->