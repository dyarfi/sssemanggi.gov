<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="backlit" style="display: none;"></div>
<div class="pop-up pop-cart" style="display: none">
    <div class="cart-data-handler nice-scroll" style="height:560px;overflow:hidden;"></div>
</div>
<!-- action class for animating page content when header is active -->
<div class="action step-right">
    <!-- Equal height section -->
    <!-- img header -->
    <section class="page-header img-section img-marine-detail" style="background-image:url(<?php echo base_url('uploads/marine/'.$detail->media);?>);">
        <div class="">
            <div id="crumbs" class="white">
                <div class="row large light">
                    <div class="six columns">
                        <h6 class="sub-heading">
                            <a href="<?php echo base_url();?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            <a href="<?php echo base_url('marine');?>">Marine</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            <a href="#"><?php echo $detail->subject;?></a>
                        </h6>
                    </div>
                    <div class="six columns text-right"></div>
                </div>
            </div>
            <!-- page statement -->
            <div class="row bigtoppadding">
                <div class="twelve columns text-center">
                    <h1 class="block-heading"><br/><span class="light"></span></h1>
                </div>
            </div>
        </div>
    </section>
    <section>
        <ul class="marine-detail grid times-two" style="background:#fff;">
            <!-- first half block -->
            <li class="one-half grey">
            <div class="content-block">
            <!-- <div class="row bigpadding">
                    <div class="eight columns centered"> -->
                <h1 class="block-heading small"><?php echo $detail->text;?></h1> <!--hero name-->
                <span class="border"></span>
                    <hr class="thin grey">
                    <div class="row nopadding">
                        <?php
                        $attributes = json_decode($detail->attribute);
                        if ($attributes) { ?>
                        <?php
                            foreach ($attributes as $attribute => $key) {
                                if ($attribute == 'spesifikasi') {
                                    $i=1;
                                    foreach ($key as $row => $val) {
                                        // Suzuki want this to be hidden
                                        if ($row != 'features') {
                                        ?>
                                        <div class="drawer-title">
                                            <a href="#" class="toggle" gumby-trigger="#drawer<?php echo $i;?>"><?php echo ucfirst(str_replace('_', ' ', $row));?></a>
                                        </div>
                                        <div class="drawer drawer-content" id="drawer<?php echo $i;?>">
                                            <div class="content-block">
                                                <?php foreach ($val->attributes as $obj => $object) { ?>
                                                    <div class="row">
                                                        <div class="four columns"><?php echo $object->label; ?></div>
                                                        <span class="three columns"></span>
                                                        <div class="five columns "><?php echo $object->value; ?></div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                    $i++;
                                    }
                                } else if ($attribute == 'price') { ?>
                                    <div class="clear-20" id="harga"></div>
                                    <hr class="thin grey">
                                    <h5 class="bold purple-text"><span class="fa fa-play icondetail" aria-hidden="true"></span> <?php echo 'Harga';?> <span style="font-size:66%;">Standard dan optional equipment</span></h5>
                                    <h2 class="stripe-heading">
                                        <span style="font-size:66%;">Rp.</span>
                                            <?php echo $key->price_range->value;?>
                                            <br><span style="font-size:12px;">
                                            <?php echo $key->price_range_text->value;?>
                                        </span>
                                    </h2>
                                <?php
                                }
                            }
                        }
                    ?>
                    </div>
                    <div class="clear-20"></div>
                    <div class="row nopadding">
                        <div class="twelve columns">
                            <?php if ($detail->brochure) { ?><a class="submit small purple" href="http://www.suzuki.co.id/<?php echo $detail->brochure;?>" target="blank"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> BROSUR</a><?php } ?>
                            <a class="submit small purple" href="http://www.suzuki.co.id/dealers/#!/pilih_jenis=marine"><span class="fa fa-map-marker" aria-hidden="true"></span> TEMUKAN DEALER</a>
                            <a class="for-pera submit small purple" href="#"><span class="fa fa-cogs" aria-hidden="true"></span> PERAWATAN BERKALA</a>
                        </div>
                    </div>
            </div>
            </li>
            <!-- second half block -->
            <li class="one-half img-section">
                <div class="clear-20"></div>
                    <div class="text-center">
                    <a class="purple fill-button product-to-cart" href="#" data-id="<?php echo $detail->id;?>" data-variant="<?php echo @$variant->id;?>">
                        <span class="fa fa-shopping-cart" aria-hidden="true"></span>
                        &nbsp;&nbsp; Pesan
                    </a>
                    </div>
                <img src="<?php echo base_url('uploads/marine/'.$detail->cover);?>" alt="<?php echo $detail->subject;?>"/>
            </li>
        </ul>
        <div class="clear"></div>
    </section>
</div><!-- action -->

<!-- perawatan berkala -->
<div class="pera-modal custom-scroll">
    <div id="pera-scrollarea">
        <div class="content-block nopadding">
            <div class="row headinfo">
                <div class="two columns">
                    <img src="<?php echo base_url('uploads/marine/'.$detail->cover);?>" alt="" class="logo-product" style="padding-top:10px; padding-bottom: 2px;">
                </div>
                <div class="ten columns"><h1 class="block-heading small"><?php echo $detail->subject;?></h1></div>
            </div>
            <div class="row nopadding">
                <div class="ten columns centered nopadding">
                    <?php
                    $services = $this->ProductServices->findAllBy('product_id',$detail->id,'*',['id'=>'asc']);
                    ?>
                    <h5 class="bold purple-text">PERAWATAN BERKALA</h5>
                    <ul class="the-accordion">
                    <?php
                    $f=0;
                    foreach ($services as $service) { ?>
                        <li>
                            <a href="#" <?php echo ($f == 0) ? 'class="acc-open"':'';?>>
                                <i class="fa fa-caret-right"></i> <?php echo $service->subject;?>
                            </a>
                            <div class="cont-acc" <?php echo ($f > 0) ? 'style="display: none;"':'';?>>
                                <?php echo $service->text;?>
                            </div>
                        </li>
                    <?php
                    $f++;
                    }
                    ?>
                </div>
            </div>
        </div>
        <a class="remove-pera"><i class="fa fa-times"></i></a>
    </div>
</div>

<?php if ($detail->video) {?>
<div class="video-modal" id="video-modal">
    <article class="youtube video"></article>
    <a class="remove-video switch" gumby-trigger="|#video-modal"><i class="fa fa-times"></i></a>
</div>
<?php } ?>
