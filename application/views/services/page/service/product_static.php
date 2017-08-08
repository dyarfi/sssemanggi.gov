<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="backlit" style="display: none;"></div>

<?php $this->load->view('services/page/auth/account');?>
<!-- action class for animating page content when header is active -->
<div class="action step-right">
    <!-- img header -->
    <?php
        $img_header = (!$static_pages) ? $product->sps_image_url : $breadcrumb[0]->url.'_periodic_head.jpg';
    ?>
    <section class="header-halo" style="background: url(<?php echo base_url().'uploads/static/service/'.$img_header;?>) center center no-repeat; background-size: cover;">
        <div class="black-tint has-button">
            <div id="crumbs" class="abs">
                <div class="eight columns">
                    <h6 class="sub-heading">
                        <a href="<?php echo base_url()?>services">Service</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        <a href="<?php echo base_url()?>services/<?php echo $breadcrumb[0]->url?>"><?php echo $breadcrumb[0]->title?></a><i class="fa fa-chevron-right" aria-hidden="true"></i>
                        <a href="<?php echo base_url()?>services/<?php echo $breadcrumb[1]->url?>"><?php echo $breadcrumb[1]->title?></a>
                    </h6>
                </div>
            </div>
            <?php echo $product->sps_subject ?>
            <span class="sub-lite"><?php echo $product->sps_title ?></span>
        </div>
    </section>
    <section class="back-white">
        <?php if (!$static_pages) { ?>
        <p><?php echo $product->sps_text ?></p>
        <?php } else { ?>
        <div class="flexslider full-slider-only">
            <ul class="slides">
                <?php
                    $n=0;
                    $header='';
                    foreach($static_pages as $pages) {
                    $header[$n] = ($n == 0 ? $pages->subject :'');
                    ?>
                    <li class="row <?php echo $n == 0 ? 'active':'';?>">
                        <div class="">
                            <a href="javascript:;" class="handler-slide" data-rel="<?php echo $pages->type .'-'.$pages->id;?>">
                                <h5><?php echo $pages->subject;?></h5>
                                <?php if ($pages->media_plain) { ?>
                                <img src="<?php echo base_url('uploads/'.$pages->type.'/'.$pages->media_plain);?>">
                                <?php } else {?>
                                <!--img src="<?php echo base_url('uploads/'.$pages->type.'/'.$pages->thumbnail);?>"-->
                                <?php } ?>
                            </a>
                        </div>
                    </li>
                    <?php
                    $n++;
                    }
                ?>
            </ul>
        </div>
        <hr class="thin grey"/>
            <ul>
                <li>Harga berikut untuk wilayah JABODETABEK.</li>
                <li>Harga belum termasuk perbaikan tambahan pada kendaraan.</li>
                <li>Harga belum termasuk PPn.</li>
                <li>Harga jasa tergantung dengan jarak. (khusus untuk produk marine)</li>
                <li>Belum Termasuk dengan Sparepart untuk perbaikan berat (bila diperlukan)</li>
            </ul>
            <h5 class="accordion-header"><?php echo $header[0] ;?></h5>
            <?php
            $k=0;
            foreach($static_pages as $pages => $static) { ?>
                <ul class="the-accordion" id="<?php echo $static->type .'-'.$static->id;?>" <?php echo ($k != 0) ? 'style="display:none"' :'';?>>
                <?php
                $l=0;
                $services = $this->ProductServices->findAllBy('product_id',$static->id,'*',['id'=>'asc']);
                //print_r($services);
                //foreach ($static->service as $value) {
                foreach ($services as $value) {
                    if ($value->status == 'publish') { ?>
                    <li>
                        <a <?php echo ($l == 0) ? 'class="acc-open"':''?> href="#"><?php echo $value->subject;?></a>
                        <div class="cont-acc" <?php echo ($l != 0) ? 'style="display: none;"' :'';?>>
                            <?php echo $value->text;?>
                        </div>
                    </li>
                    <?php
                    }
                $l++;
                }
                ?>
                </ul>
            <?php
            $k++;
            }
            ?>
        <?php
        }
        ?>
        <p><?php //echo $product->sps_text ?></p>
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
