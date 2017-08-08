<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="backlit" style="display: none;"></div>
<div class="pop-up pop-cart" style="display: none">
    <div class="cart-data-handler nice-scroll" style="height:560px;overflow:hidden;"></div>
</div>
<!-- action class for animating page content when header is active -->
<div class="action step-right">
    <!-- intro section / image background-->
    <section id="intro" class="img-section" style="background:url('<?php echo base_url('uploads/automobile/'.str_replace($detail->media, 'thumb__1192x671'.$detail->media, $detail->media));?>') no-repeat;">
        <div class="">
            <!-- #crumbs for page title bar and top navigation -->
            <div id="crumbs" class="white">
                <div class="row large light">
                    <div class="six columns">
                        <!-- page title/statement -->
                        <h6 class="sub-heading">
                            <a href="<?php echo base_url();?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            <a href="<?php echo base_url('automobile');?>">Automobile</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            <a href="#"><?php echo $detail->subject;?></a>
                        </h6>
                    </div>
                    <div class="six columns text-right"></div>
                </div>
            </div>
            <div class="detail-produk content-block">
                <div class="row large">
                    <div class="eleven columns">
                        <!-- intro statement -->
                        <img src="<?php echo base_url('uploads/automobile/'.$detail->cover);?>" alt="" class="logo-product">
                        <p class="txtintro" style="color:#000;"><?php echo $detail->text;?></p>
                        <div class="midtoppadding box-middle-handler">
                            <ul class="prodinfo">
                                <?php if ($detail->messages) {?><li><a href="<?php echo strip_tags($detail->messages);?>" class="open-video switch purple fill-button" gumby-trigger="#video-modal" onclick="playVid()"><span class="fa fa-play" aria-hidden="true"></span> VIDEO</a></li><?php } ?>
                                <li class="invisibile-ie"><a href="#" class="planner-btn-mobile purple fill-button"><span class="fa fa-info" aria-hidden="true"></span> DETAIL PRODUK</a></li>
                                <li class="visibile-ie"><a class="planner-btn-mobile purple fill-button" id="showDetail"><span class="fa fa-info" aria-hidden="true"></span> DETAIL PRODUK</a></li>
                                <?php if($detail->brochure) {?><li><a href="http://www.suzuki.co.id/<?php echo $detail->brochure;?>" target="_blank" class="purple large fill-button"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> BROSUR</a></li><?php } ?>
                                <!--li><a href="pricelist.html" class="purple fill-button"><span class="fa fa-file-text-o" aria-hidden="true"></span> DAFTAR HARGA</a></li-->
                                <li><a href="http://www.suzuki.co.id/dealers/#!/pilih_jenis=automobile" class="purple fill-button" target="_blank"><span class="fa fa-map-marker" aria-hidden="true"></span> TEMUKAN DEALER</a></li>
                                <li><a class="for-pera purple fill-button" href="#"><span class="fa fa-cogs" aria-hidden="true"></span>PERAWATAN BERKALA</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- planner window -->
<div class="planner-modal-mobile custom-scroll-mobile cbp-spmenu cbp-spmenu-right" id="detail-product">
    <div  id="planner-scrollarea-mobile">
        <div class="content-block nopadding">
            <div class="row headinfo">
                <div class="two columns">
                    <img src="<?php echo base_url('uploads/automobile/'.$detail->cover);?>" alt="" style="padding-top:5px;"/>
                </div>
                <div class="six columns" style="padding-top:10px;">
                    <ul class="nav-icon-list">
                        <li><a href="#color"><span>WARNA</span></a></li>
                        <li><a href="#spec"><span>SPESIFIKASI</span></a></li>
                        <li><a href="#fitur"><span>FITUR</span></a></li>
                        <li><a href="#harga"><span>HARGA</span></a></li>
                    </ul>
                </div>
                <div class="four columns">
                    <div class="row navbar" id="nav1">
                      <ul class="eight columns">
                        <li>
                          <a href="#" class="purple submit">SIMULASI KREDIT</a>
                          <div class="dropdown">
                            <ul>
                                <li><a href="http://indomobilfinance.com/public/simulasi/simulasi-kredit/ctgr/simulasi-kredit/m/4" target="_blank">Indomobil Finance</a></li>
                                <li><a href="http://www.bcafinance.co.id/infokredit/simulasi_kredit.html" target="_blank">BCA Finance</a></li>
                                <li><a href="https://www.oto.co.id/products/simulasi-kredit" target="_blank">OTO Finance</a></li>
                                <li><a href="http://www.mtf.co.id/pages/mobil-baru" target="_blank">MTF Finance</a></li>
                            </ul>
                          </div>
                        </li>
                      </ul>
                    </div>
                </div>
            </div>
            <div class="row nopadding">
                <div class="ten columns centered nopadding">
                    <div class="clear-20" id="color"></div>
                    <hr class="thin grey">
                    <h5 class="bold purple-text"><span class="fa fa-play icondetail" aria-hidden="true"></span> PILIHAN WARNA</h5>
                    <div class="row nopadding">
                        <div class="twelve columns centered text-center">
                            <?php
                            $variants = $this->ProductVariants->with('colors')->findAll(['product_id'=>$detail->id],'*',['id'=>'DESC']);
                            if ($variants) {
                            ?>
                            <div class="flexslider img-nav-slider">
                                <ul class="slides">
                                    <?php foreach ($variants as $variant) {?>
                                    <li class="variant">
                                        <a class="purple fill-button product-to-cart" href="#" data-id="<?php echo $detail->id;?>" data-variant="<?php echo $variant->id;?>">
                                            <span class="fa fa-shopping-cart" aria-hidden="true"></span>
                                            &nbsp;&nbsp; Pesan
                                        </a>
                                        <p><img src="<?php echo base_url($variant->media);?>"/></p>
                                        <h6 class="client-credit"><?php echo $variant->subject;?></h6>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <?php } else { ?>
                            <a class="purple fill-button product-to-cart" href="#" data-id="<?php echo $detail->id;?>" data-variant="<?php echo $variant->id;?>">
                                <span class="fa fa-shopping-cart" aria-hidden="true"></span>
                                &nbsp;&nbsp; Pesan
                            </a>
                            <img src="<?php echo base_url('uploads/automobile/'.$detail->media_plain);?>" alt="<?php echo $detail->subject;?>"/>
                            <?php } ?>
                            <!--div class="img-nav"></div-->
                            <?php
                            if ($variants) { ?>
                            <ol class="img-slider-nav do-six">
                                <?php foreach ($variants as $color) {?>
                                    <li class="nav-button">
                                        <a href="#"><img src="<?php echo base_url('assets/public/images/picker/'.$color->colors->media);?>" class="img-responsive"/></a>
                                    </li>
                                <?php } ?>
                            </ol>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                        $attributes = json_decode($detail->attribute);
                        if ($attributes) { ?>
                        <?php
                            foreach ($attributes as $attribute => $key) {
                                if ($attribute == 'spesifikasi') { ?>
                                <div class="clear-20" id="spec"></div>
                                <hr class="thin grey">
                                <h5 class="bold purple-text"><span class="fa fa-play icondetail" aria-hidden="true"></span><?php echo ucfirst(str_replace('_', ' ',$attribute));?></h5>
                                <div class="row nopadding">
                                <?php
                                $i=1;
                                foreach ($key as $row => $val) { ?>
                                    <div class="drawer-title">
                                        <a href="#" class="toggle" gumby-trigger="#drawer<?php echo $i;?>"><?php echo ucfirst(str_replace('_', ' ',$row));?></a>
                                    </div>
                                    <div class="drawer drawer-content" id="drawer<?php echo $i;?>">
                                        <div class="content-block">
                                            <?php foreach ($val->attributes as $obj => $object) { ?>
                                                <div class="row">
                                                    <div class="five columns"><?php echo $object->label; ?></div>
                                                    <div class="six columns "><?php echo $object->value; ?></div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php
                                $i++;
                                }
                                ?>
                                </div>
                                <?php
                                } else if ($attribute == 'features') { ?>
                                    <div class="clear-20" id="fitur"></div>
                                    <hr class="thin grey">
                                    <h5 class="bold purple-text"><span class="fa fa-play icondetail" aria-hidden="true"></span>FITUR</h5>
                                    <div class="row nopadding">
                                        <?php
                                        $j=11;
                                        foreach ($key as $row => $val) { ?>
                                        <div class="drawer-title ">
                                            <a href="#" class="toggle" gumby-trigger="#drawer<?php echo $j;?>"><?php echo ucfirst(str_replace('_', ' ', $val->label));?></a>
                                        </div>
                                        <div class="drawer drawer-content" id="drawer<?php echo $j;?>">
                                            <div class="content-block">
                                                <div class="row">
                                                <?php echo strip_tags($val->value,'<img><p><b><span><div><strong><h1><h2><h3><h4><h5><h6>');?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $j++;
                                        }
                                        ?>
                                    </div>
                                    <div class="clear-20"></div>
                                    <p class="disclaimer"><strong>Catatan:</strong>  Standar dan pilihan  perlengkapan yang  tersedia mungkin berbeda di pasaran. Tanyakan pada dealer Anda, apakah spesifikasi dan ilustrasi yang merujuk ke model  tersedia di daerah. SUZUKI berhak untuk mengubah harga, warna, bahan, perlengkapan, dan model, serta menghentikan model tanpa pemberitahuan terlebih dahulu.</p>
                                <?php
                                } else if ($attribute == 'price') { ?>
                                    <div class="clear-20" id="harga"></div>
                                    <hr class="thin grey">
                                    <h5 class="bold purple-text"><span class="fa fa-play icondetail" aria-hidden="true"></span> Harga <?php //echo ucfirst($row);?> <span style="font-size:66%;">Standard dan optional equipment</span></h5>
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

                    <?php if ($detail->pricelist) { ?>
                    <div class="row nopadding">
                        <div class="drawer-title ">
                            <a href="#" class="toggle" gumby-trigger="#drawer111">DAFTAR HARGA</a>
                        </div>
                        <div class="drawer drawer-content" id="drawer111">
                            <div class="content-block">
                                <div class="row">
                                    <?php echo $detail->pricelist;?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="clear-20"></div>
                    <div class="row nopadding">
                        <div class="twelve columns">
                            <a class="submit small purple" href="<?php echo base_url($detail->brochure);?>" target="blank"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> BROSUR</a> <a class="submit small purple" href="<?php echo base_url('dealers');?>"><span class="fa fa-map-marker" aria-hidden="true"></span> TEMUKAN DEALER</a>
                        </div>
                    </div>

                    <div class="clear-20"></div>
                    <hr class="thin grey">
                    <?php if ($detail->accessory) { ?>
                    <h5 class="bold purple-text"><span class="fa fa-play" aria-hidden="true"></span> AKSESORIS</h5>
                    <div class="row nopadding">
                        <div class="twelve columns">
                            <?php
                                $l=1;
                                foreach ($detail->accessory as $accessory) {
                                    $path_file_name = pathinfo($accessory->media);
                                    $filename = str_replace($path_file_name['basename'], 'thumb__150x150'.$path_file_name['basename'], $path_file_name['basename']);
                                    $image = $path_file_name['dirname'] .'/'.$filename;
                                    ?>
                                    <a href="#" class="switch" gumby-trigger="#modal<?php echo $l;?>"><img  class="three columns zoom-on-hover aks" src="<?php echo base_url($image);?>" /></a>
                                <?php
                                $l++;
                                }
                                $m=1;
                                foreach ($detail->accessory as $accessory_detail) { ?>
                                    <div class="modal" id="modal<?php echo $m;?>">
                                      <div class="content">
                                        <a class="close switch" gumby-trigger="|#modal<?php echo $m;?>"><i class="icon-cancel" /></i></a>
                                        <div class="row">
                                          <div class="ten columns centered text-center">
                                            <img src="<?php echo base_url($accessory_detail->media);?>" />
                                            <h3><?php echo $accessory_detail->subject;?></h3>
                                            <p><?php echo $accessory_detail->text;?></p>
                                            <h4><?php echo $accessory_detail->attribute;?></h4>
                                            <p class="btn primary medium">
                                              <a href="#" class="switch" gumby-trigger="|#modal<?php echo $m;?>">Tutup</a>
                                            </p>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                <?php
                                $m++;
                                } ?>
                        </div>
                    </div>
                    <!-- end... -->
                    <?php } ?>
                    <div class="gaps-end">
                        <div class="clear-50"></div>
                        <div class="clear-50"></div>
                        <div class="clear-50"></div>
                        <div class="clear-50"></div>
                        <div class="clear-50"></div>
                        <div class="clear-50"></div>
                        <div class="clear-50"></div>
                        <div class="clear-50"></div>
                    </div>
                    <hr class="thin grey">
                </div>
            </div>
        </div>
        <!-- close planner button -->
        <a class="remove-planner-mobile invisibile-ie"><i class="fa fa-times"></i></a>
        <a class="remove-planner-mobile visibile-ie"><i class="fa fa-times">x</i></a>
    </div><!--planner scrollarea -->
</div>
<!-- end div.content -->

<!-- perawatan berkala -->
<div class="pera-modal custom-scroll">
    <div id="pera-scrollarea">
        <div class="content-block nopadding">
            <div class="row headinfo">
                <div class="two columns">
                    <img src="<?php echo base_url('uploads/automobile/'.$detail->cover);?>" alt="" class="logo-product" style="padding-top:10px; padding-bottom: 2px;">
                </div>
            </div>
            <div class="row nopadding">
                <div class="ten columns centered nopadding">
                    <h5 class="bold purple-text">PERAWATAN BERKALA</h5>
                    <?php
                    $services = $this->ProductServices->findAll(['product_id'=>$detail->id],'*',['id'=>'ASC']);
                    ?>
                    <ul class="the-accordion">
                    <?php
                    $f=0;
                    foreach ($services as $service) {
                        if ($service->status == 'publish') {
                        ?>
                        <li>
                            <a href="#" <?php echo ($f == 0) ? 'class="acc-open"':'';?>>
                                <i class="fa fa-caret-right"></i> <?php echo $service->subject;?>
                            </a>
                            <div class="cont-acc" <?php echo ($f > 0) ? 'style="display: none;"':'';?>>
                                <?php echo $service->text;?>
                            </div>
                        </li>
                        <?php
                        }
                    $f++;
                    }
                    ?>
                </div>
            </div>
        </div>
        <a class="remove-pera"><i class="fa fa-times"></i></a>
    </div>
</div>

<?php if ($detail->messages) {?>
<div class="video-modal" id="video-modal">
    <article class="youtube video"></article>
    <a class="remove-video switch" gumby-trigger="|#video-modal"><i class="fa fa-times"></i></a>
</div>
<?php } ?>
