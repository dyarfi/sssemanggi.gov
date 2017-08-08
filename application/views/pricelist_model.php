<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//print_r($motorcycle_price);
?>
<!-- action class for animating page content when header is active -->
<div class="action step-right">
    <!-- page content -->
    <!-- img header -->
    <section class="page-header img-section dark" style="background-image:url(<?php echo base_url('uploads/pages');?>/pricelist.jpg);">
        <div class="content-block black-tint">
            <div id="crumbs" class="abs">
                <div class="row large dark">
                    <div class="six columns">
                        <!-- page title/statement -->
                        <h6 class="sub-heading">
                            <a href="<?php echo base_url();?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            <a href="#">Price List</a>
                        </h6>
                    </div>
                    <div class="six columns text-right">
                    </div>
                </div>
            </div>
            <!-- page statement -->
            <div class="row bigtoppadding">
                <div class="twelve columns text-center">
                    <h4 class="block-heading">PRICE LIST</span></h4>
                </div>
            </div>
        </div>
    </section>
    <section class="grey stripe-bg">
        <!-- two third /left side-->
        <div class="two-third white">
            <div id="single-page">
                <div class="content-block">
                    <!-- page title / description -->
                    <div class="row">
                    </div>
                    <div class="row">
                        <p>Suzuki Indonesia telah memberikan kontribusi untuk bangsa dan masyarakat dengan memberikan produk-produk bermanfaat bagi perkembangan bangsa. Pelayanan profesional dibidang pemasaran produk dan jasa pelayanan juga menjadi komitmen utama kami untuk memberikan yang terbaik bagi para pelanggan setia Suzuki. Saling percaya dan menghormati merupakan nilai yang kami tanam dalam setiap kerja sama yang dijalani antara karyawan, pemasok, dealer-dealer diseluruh Indonesia.</p>
                    </div>
                    <div class="row">
                        <!-- tabs -->
                        <section class="tabs">
                            <!-- tab navigation -->
                            <ul class="tab-nav three columns">
                                <li class="active"><a href="#"><span>AUTOMOBILE</span></a></li>
                                <li><a href="#"><span>MOTORCYCLE</span></a></li>
                                <li><a href="#"><span>MARINE</span></a></li>
                            </ul>
                            <div class="tab-content active nine columns">
                                <h3 class="bold">AUTOMOBILE</h3>
                                <p>Harga on the road jabodetabek berlaku 1-31 Agustus 2016</p>
                                <?php
                                    $k=1;
                                    foreach ($automobile_price as $product => $automobile) {?>
                                    <div class="drawer-title">
                                        <a href="#" class="toggle uppercase" gumby-trigger="#drawer<?php echo $k;?>"><?php echo $product;?></a>
                                    </div>
                                    <div class="drawer drawer-content" id="drawer<?php echo $k;?>">
                                        <div class="content-block">
                                            <div class="row">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>GROUP MODEL</th>
                                                            <th>SALES MODEL</th>
                                                            <th>HARGA ON THE ROAD</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (is_array($automobile)) {
                                                            foreach ($automobile as $amodels => $amodel) {
                                                                foreach ($amodel as $vb) {?>
                                                                <tr>
                                                                    <td class="uppercase"><?php echo $vb->group_name;?></td>
                                                                    <td><?php echo $vb->subject;?></td>
                                                                    <td>Rp. <?php echo $vb->price;?>,-</td>
                                                                </tr>
                                                            <?php
                                                                }
                                                            }
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                $k++;
                                } ?>
                            </div>
                            <!-- tab 1 content -->
                            <div class="tab-content nine columns">
                                <!--p>Harga on the road jabodetabek berlaku 1-31 Agustus 2016</p-->
                                <h3 class="bold">MOTORCYCLE</h3>
                                <!--p>Harga on the road jabodetabek 2017</p-->
                                <table>
                                    <thead>
                                        <tr>
                                            <th valign="middle">GROUP MODEL</th>
                                            <th valign="middle">SALES MODEL</th>
                                            <th valign="middle">HARGA ON THE ROAD</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $l=1;
                                        foreach ($motorcycle_price as $motorcycle => $motor) {
                                            foreach ($motor->model as $bal) {
                                            ?>
                                            <tr>
                                                <td><?php echo $bal->subject;?></td>
                                                <td><?php echo $bal->group_name;?></td>
                                                <td>Rp. <?php echo $bal->price;?>,-</td>
                                            </tr>
                                            <?php
                                            /*
                                            <tr>
                                                <td><?php echo $motorcycle->subject;?></td>
                                                <td><?php echo $motorcycle->subject;?></td>
                                                <td>Rp. <?php echo $motorcycle->pricelist;?>,-</td>
                                            </tr>
                                            */
                                            }
                                        $l++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-content nine columns">
                                <h3 class="bold">MARINE</h3>
                                <div class="drawer-title">
                                    <a href="#" class="toggle" gumby-trigger="#drawer21">DF</a>
                                </div>
                                <div class="drawer drawer-content" id="drawer21">
                                    <div class="content-block">
                                        <div class="row">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th valign="middle">GROUP MODEL</th>
                                                        <th valign="middle">SALES MODEL</th>
                                                        <th valign="middle">HARGA ON THE ROAD</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>DF</td>
                                                        <td>DF 2,5 S</td>
                                                        <td>8.200.000</td>

                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 6 AL</td>
                                                        <td>15.600.000</td>
                                                    </tr>
                                                    <!--tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 15 AS</td>
                                                        <td>30.200.000</td>
                                                    </tr-->
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 20 AL</td>
                                                        <td>36.500.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 40 AQHL</td>
                                                        <td>84.900.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 40 ATL</td>
                                                        <td>91.400.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 70 ATL</td>
                                                        <td>108.600.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 70 ATX</td>
                                                        <td>110.200.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 90 ATL</td>
                                                        <td>119.200.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 90 ATX</td>
                                                        <td>121.000.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 115 ATX</td>
                                                        <td>140.800.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 115 AZX</td>
                                                        <td>145.200.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 150 TX</td>
                                                        <td>175.500.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 150 ZX</td>
                                                        <td>180.500.000</td>
                                                    </tr>
                                                    <!-- <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 175 TX</td>
                                                        <td>185.450.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 175 ZX</td>
                                                        <td>190.150.000</td>
                                                    </tr> -->
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 200 ATX</td>
                                                        <td>202.000.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 200 AZX</td>
                                                        <td>207.000.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 200 TX</td>
                                                        <td>231.800.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 200 ZX</td>
                                                        <td>238.700.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 250 TX</td>
                                                        <td>263.700.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 250 TXX</td>
                                                        <td>268.000.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 250 ZX</td>
                                                        <td>270.600.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 250 ZXX</td>
                                                        <td>275.000.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 250 APX</td>
                                                        <td>288.400.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 250 APXX</td>
                                                        <td>294.000.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 300 APX</td>
                                                        <td>326.700.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DF 300 APXX</td>
                                                        <td>332.400.000</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <div class="drawer-title">
                                    <a href="#" class="toggle" gumby-trigger="#drawer22">DT</a>
                                </div>
                                <div class="drawer drawer-content" id="drawer22">
                                    <div class="content-block">
                                        <div class="row">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th valign="middle">GROUP MODEL</th>
                                                        <th valign="middle">SALES MODEL</th>
                                                        <th valign="middle">HARGA ON THE ROAD</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>DT</td>
                                                        <td>DT 15 AL</td>
                                                        <td>23.600.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DT 30 L</td>
                                                        <td>32.800.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DT 40 WL</td>
                                                        <td>40.600.000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>DT 40 WRL</td>
                                                        <td>45.800.000</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section><!-- end tabs -->
                    </div><!-- end drawers -->
                </div>
            </div>
        </div>
        <?php $this->load->view('template/public/right_menu');?>
        <!-- clear floats -->
        <div class="clear">
        </div>
    </section>
</div>
