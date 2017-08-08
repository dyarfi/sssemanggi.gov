<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- action class for animating page content when header is active -->
<div class="action step-right">
        
    <!-- page content -->
    <!-- img header -->
    <section class="page-header img-section dark" style="background-image:url(<?php echo base_url('uploads/pages/'.$detail->media);?>);">
        <div class="content-block black-tint">
            
            <div id="crumbs" class="abs">
                <div class="row large light">
                <div class="six columns">
                    <!-- page title/statement -->
                    <h6 class="sub-heading">
                    <a href="index.html">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        <a href="#"><?php echo $detail->subject;?></a>
                    
                    </h6>
                </div>
                <div class="six columns text-right">
                    
                </div>
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
                <div class="content-block">
                    <!-- page title / description -->
                    <div class="row">
                        <h3 class="bold"></h3>
                        <h5>Suzuki Indonesia merupakan kelompok usaha yang bergerak dibidang industri otomotif yang memproduksi, memasarkan, memperniagakan motor, mobil dan motor tempel (outboard-motor). Hal tersebut juga diidukung dengan pelayanan purna jual suku cadang serta perbaikan/pemeliharaan di seluruh Indonesia yang solid dan terintegrasi dalam melayani para pelanggan Suzuki.</h4>
                    </div>
                    <div style="border"></div>
                    <div class="row">
                    <p>Suzuki Indonesia telah memberikan kontribusi untuk bangsa dan masyarakat dengan memberikan produk-produk bermanfaat bagi perkembangan bangsa. Pelayanan profesional dibidang pemasaran produk dan jasa pelayanan juga menjadi komitmen utama kami untuk memberikan yang terbaik bagi para pelanggan setia Suzuki. Saling percaya dan menghormati merupakan nilai yang kami tanam dalam setiap kerja sama yang dijalani antara karyawan, pemasok, dealer-dealer diseluruh Indonesia.</p>
                    </div>                    
                    <hr class="thin grey">                    
                    <div class="row">
                        <!-- tabs -->
                        <section class="tabs">
                        <!-- tab navigation -->                        
                        <ul class="tab-nav three columns">
                            <li class="active"><a href="#"><span>VISI MISI</span></a></li>
                            <li><a href="#"><span>STRUKTUR SUZUKI INDONESIA</span></a></li>
                            <li><a href="#"><span>PROFIL</span></a></li>
                            <li><a href="#"><span>SKEMA UMUM</span></a></li>
                            <li><a href="#"><span>PRODUK SUZUKI INDONESIA</span></a></li>
                        </ul>
                        <!-- tab 1 content -->
                        <div class="tab-content active nine columns">
                            <h5 class="purple-text bold">VISI</h5>
                            <p>Menjadi perusahaan terkemuka di dalam Suzuki Global Operation yang dihargai dan dikagumi di Indonesia.</p>
                            <h5 class="purple-text bold">MISI</h5>
                            <p>Kami menginginkan pertumbuhan dan perkembangan Perusahaan yang  berimbang berdasarkan azaz kerja keras, integritas dan kebersamaan untuk  selalu mencapai hasil lebih baik dalam mendahului harapan pelanggan.</p>
                        </div>                        
                        <div class="tab-content nine columns">
                            <h5 class="bold purple-text" style="text-transform:uppercase;">Struktur Suzuki Indonesia</h5>
                            <img src="img/suzuki-struktur.png" class="img-responsive" />                
                        </div>                        
                        <!-- tab 2 content -->
                        <div class="tab-content eight columns">
                            <h5 class="purple-text bold">PROFIL</h5>
                            <table width="100%" style="font-size:12px !important;">
                                <tbody>
                                <tr>                                
                                    <td width="240"><strong>Nama Perusahaan</strong></td>
                                    <td width="384">PT Suzuki Indomobil Motor (Sole Agent)</td>
                                </tr>
                                <tr>                                
                                    <td width="240"></td>
                                    <td width="384">PT Suzuki Indomobil Sales (Sole Distributor)</td>
                                </tr>                                
                                <tr>                                
                                    <td width="240"><strong>Presiden Direktur</strong></td>
                                    <td width="384">Shuji Oishi</td>
                                </tr>
                                </tr>
                                <tr>                                
                                    <td width="240"><strong>Jumlah Karyawan</strong></td>
                                    <td width="384">5,920 (berdasarkan data Juni 2016)</td>
                                </tr>
                                </table>
                                <!--table width="100%" style="font-size:12px !important;">
                                <tr>
                                    <td colspan="2" style="background:#ccc;"><strong>Mission Statement</strong></td>
                                </tr>                    
                                <tr>
                                    <td width="40px"></td>
                                    <td>Menciptakan produk bermutu tinggi dengan fokus pada konsumen</td>
                                </tr>
                                <tr><td width="40px"></td>                                    
                                    <td>Membentuk perusahaan yang segar dan inovatif melalui <i>teamwork</i></td>
                                </tr>
                                <tr><td width="40px"></td>                                    
                                    <td>Memajukan kualitas individual melalui pengingkatan secara berkala</td>
                                </tr>
                                </tbody>
                                </table-->                                
                                <table width="100%" style="font-size:12px !important;">
                                <tr>
                                    <td colspan="3" style="background:#ccc;"><strong>Status Kepemilikan</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="background:#ddd;"><strong>PT Suzuki Indomobil Motor</strong></td>
                                </tr>
                                <tr>
                                    <td width="40px"></td>
                                    <td>Suzuki Motor Corporation</td>
                                    <td>94,94%</td>
                                </tr>
                                <tr>
                                    <td width="40px"></td>
                                    <td>PT Indomobil Sukses International</td>
                                    <td>4,55%</td>
                                </tr>
                                <tr>
                                    <td width="40px"></td>
                                    <td>PT Serasi Tunggal Karya</td>
                                    <td>0,51%</td>
                                </tr>
                                
                                <tr>
                                    <td colspan="3" style="background:#ddd;"><strong>PT Suzuki Indomobil Sales</strong></td>
                                </tr>
                                <tr>
                                    <td width="40px"></td>
                                    <td>PT Suzuki Indomobil Motor</td>
                                    <td>99%</td>
                                </tr>
                                <tr>
                                    <td width="40px"></td>
                                    <td>PT Indomobil Sukses International</td>
                                    <td>1%</td>
                                </tr>
                                </tbody>
                            </table>
                            
                        </div>
                         
                        <!-- tab 3 content -->
                        <div class="tab-content eight columns">
                                <h5 class="purple-text bold">SKEMA UMUM </h5>                                    
                                    <h5>Kantor Pusat</h5>
                                    <p><strong>Divisi Penjualan, Pemasaran dan Pelayanan</strong></p>
                                    <table border:"0">
                                    <tr>
                                    <td>Alamat</td><td>:</td><td>Jl. Raya Bekasi Km. 19, Pulogadung Jakarta 13920, Indonesia</td></tr><tr>
                                    <td>Telpon</td><td>:</td><td>(+6221) 29554800</td></tr><tr>
                                    <td>Fax</td><td>:</td><td>(+6221) 29554801/802</td></tr></table>

                                    <h5>Cakung Plant </h5>
                                    <p><strong>Manufaktur dan Perakitan Mesin dan Transmisi untuk Produk Mobil dan Motor</strong></p>
                                    <table border:"0">
                                    <tr>
                                    <td>Alamat</td><td>:</td><td>Jl. Raya Penggilingan, Cakung Jakarta Timur </td></tr><tr>
                                    <td>Telpon</td><td>:</td><td>(+6221) 4602960 </td></tr><tr>
                                    <td>Fax</td><td>:</td><td>(+6221) 4602916</td></tr></table>

                                    <h5>Direktorat Service</h5>
                                    <table border:"0">
                                    <tr>
                                    <td>Alamat</td><td>:</td><td>Jl. Tarum Barat, Jatimulya, Tambun Bekasi 17510</td></tr><tr>
                                    <td>Telpon </td><td>:</td><td>(+6221) 8807407, 8807447</td></tr><tr>
                                    <td>Fax</td><td>:</td><td>(+6221) 880-7403</td></tr></table>

                                    <h5>Tambun Plant I</h5>
                                    <p><strong>
                                    Kantor Administrasi, Manufaktur Komponen Bodi dan Perakitan Motor</strong></p>
                                    <table border:"0">
                                    <tr>
                                    <td>Alamat</td><td>:</td><td>Jl. Raya Diponegoro KM 38.2 Tambun, Jawa Barat, Indonesia</td></tr><tr>
                                    <td>Telpon</td><td>:</td><td>(+6221) 8801251, 8801235 </td></tr><tr>
                                    <td>Fax</td><td>:</td><td>(+6221) 8807401 </td></tr></table>

                                    <h5>Tambun Plant II</h5>
                                    <p><strong>
                                    Manufaktur Komponen dan Perakitan Mobil</strong></p>
                                    <table border:"0">
                                    <tr>
                                    <td>Alamat</td><td>:</td><td>Jl. Raya Diponegoro Km. 38,2 Tambun Bekasi</td></tr><tr>
                                    <td>Telpon</td><td>:</td><td>(+6221) 8801251, 8801235 </td></tr><tr>
                                    <td>Fax</td><td>:</td><td>(+6221) 8807401 </td></tr></table>

                                    <h5>Cikarang Plant</h5>
                                    <p><strong>
                                    Manufaktur Komponen Bodi dan Perakitan Mobil<br>
                                    Manufaktur dan Perakitan Mesin dan Transmisi Mobil</strong></p>
                                    <table border:"0">
                                    <tr>
                                    <td>Alamat </td><td>:</td><td> Kawasan Industri GIIC Blok AC no. 1 Cikarang Pusat Bekasi, Jawa Barat</td></tr><tr>
                                    <td>Telpon </td><td>:</td><td> (+6221) 29601900</td></tr></table>

                                    <h5>Suzuki Parts Centre</h5>
                                    <p><strong>
                                    Pengerjaan Suku Cadang</strong></p>
                                    <table border:"0">
                                    <tr>
                                    <td>Alamat </td><td>:</td><td> Jl. Diponegoro KM 38,2 Tambun Bekasi</td></tr><tr>
                                    <td>Telpon</td><td>:</td><td>(62-21) 8809940, 8809941 </td></tr><tr>
                                    <td>Fax </td><td>:</td><td>(62-21) 8809950</td></tr></table>
                                    <img src="<?php echo base_url('assets/static/img/lokasi.jpg');?>" class="img-responsive" />
                                </div>                                
                                <!-- tab 4 content -->
                                <div class="tab-content eight columns">                                    
                                    <h5 class="bold purple-text" style="text-transform:uppercase;">Produk Suzuki Indonesia</h5>                                                        
                            <!-- drawers -->
                            <div class="row">
                                <!-- drawer handle/ title / 1-->
                                <div class="drawer-title">
                                    <!-- gumby-trigger should target the id of drawer-content -->
                                    <a href="#" class="toggle posi" gumby-trigger="#drawer1">Mobil Suzuki Yang Pernah Diproduksi di Indonesia</a>
                                </div>
                                <!-- drawer content / 1 -->
                                <div class="drawer drawer-content" id="drawer1">
                                    <div class="content-block">
                                        <div class="row">                                            
                                            <table border:"0">
                                            <tbody>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%">
                                            <p align="center"><strong>Nama</strong></p>
                                            </td>
                                            <td class="contentTextInsideTable" width="28%">
                                            <p align="center"><strong>Model</strong></p>
                                            </td>
                                            <td class="contentTextInsideTable" width="27%">
                                            <p align="center"><strong>Jenis</strong></p>
                                            </td>
                                            <td class="contentTextInsideTable" align="center" width="13%">
                                            <p align="center"><strong>Mulai<br>
                                            Produksi</strong></p>
                                            </td>
                                            <td class="contentTextInsideTable" align="center" width="13%">
                                            <p align="center"><strong>Akhir<br>
                                            Produksi</strong></p>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%">&nbsp; Carry</td>
                                            <td class="contentTextInsideTable" width="28%">Pick Up Box L-51</td>
                                            <td class="contentTextInsideTable" width="27%">Bussiness</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">1976</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">1976</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">ST-10</td>
                                            <td class="contentTextInsideTable" width="27%">Bussiness/Passenger Car</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">1976</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">1977</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">ST-20</td>
                                            <td class="contentTextInsideTable" width="27%">Bussiness/Passenger Car</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">1977</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">1984</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">ST-1000 T.1</td>
                                            <td class="contentTextInsideTable" width="27%">Bussiness/Passenger Car</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">1983</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">1986</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">ST-1000 T.2</td>
                                            <td class="contentTextInsideTable" width="27%">Bussiness/Passenger Car</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">1985</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">1986</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">ST-1000 T.3</td>
                                            <td class="contentTextInsideTable" width="27%">Bussiness/Passenger Car</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">1986</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">1987</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">ST-1000 T.4</td>
                                            <td class="contentTextInsideTable" width="27%">Bussiness/Passenger Car</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">1987</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">1988</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">ST-1000 T.5</td>
                                            <td class="contentTextInsideTable" width="27%">Bussiness/Passenger Car</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">1988</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">2000</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%">Futura</td>
                                            <td class="contentTextInsideTable" width="28%">ST-1300 Chasis</td>
                                            <td class="contentTextInsideTable" width="27%">Bussiness</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">1990</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">1997</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">ST-1300 Minibus</td>
                                            <td class="contentTextInsideTable" width="27%">Passenger Car</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">1993</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">2000</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">ST-1600 Chasis</td>
                                            <td class="contentTextInsideTable" width="27%">Bussiness</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">1997</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">2000</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">ST-1600 Minibus</td>
                                            <td class="contentTextInsideTable" width="27%">Passenger Car</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">1997</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">2000</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">ST-1500 Chasis</td>
                                            <td class="contentTextInsideTable" width="27%">Bussiness</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">2000</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">–</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">ST-1500 Minibus</td>
                                            <td class="contentTextInsideTable" width="27%">Passenger Car</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">2000</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">–</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%">&nbsp; Every</td>
                                            <td class="contentTextInsideTable" width="28%">GA-413 M/T</td>
                                            <td class="contentTextInsideTable" width="27%">Passenger Car</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">2004</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">2004</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">GA-413 A/T</td>
                                            <td class="contentTextInsideTable" width="27%">Passenger Car</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">2004</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">2004</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%">&nbsp; APV</td>
                                            <td class="contentTextInsideTable" width="28%">GC415-GDN41V TIPE<br>
                                            I</td>
                                            <td class="contentTextInsideTable" width="27%">Passenger Car</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">2004</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">2007</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">GC415-GDN41V TIPE<br>
                                            II</td>
                                            <td class="contentTextInsideTable" width="27%">Business/Passenger<br>
                                            Car</td>
                                            <td class="contentTextInsideTable" align="center" width="13%">2007</td>
                                            <td class="contentTextInsideTable" align="center" width="13%">2008</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">4GCM15T TIPE I</td>
                                            <td class="contentTextInsideTable" width="27%">Business/Passenger<br>
                                            Car</td>
                                            <td class="contentTextInsideTable" align="center" width="13%">2005</td>
                                            <td class="contentTextInsideTable" align="center" width="13%">2007</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">4GCM15T TIPE II</td>
                                            <td class="contentTextInsideTable" width="27%">Business/Passenger<br>
                                            Car</td>
                                            <td class="contentTextInsideTable" align="center" width="13%">2008</td>
                                            <td class="contentTextInsideTable" align="center" width="13%">–</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">GC415-GDN71T TIPE<br>
                                            I</td>
                                            <td class="contentTextInsideTable" width="27%">Business</td>
                                            <td class="contentTextInsideTable" align="center" width="13%">2005</td>
                                            <td class="contentTextInsideTable" align="center" width="13%">2007</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">GC415-GDN71T TIPE<br>
                                            II</td>
                                            <td class="contentTextInsideTable" width="27%">Business</td>
                                            <td class="contentTextInsideTable" align="center" width="13%">2008</td>
                                            <td class="contentTextInsideTable" align="center" width="13%">–</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">GC416-GDN71T TIPE<br>
                                            I</td>
                                            <td class="contentTextInsideTable" width="27%">Business</td>
                                            <td class="contentTextInsideTable" align="center" width="13%">2005</td>
                                            <td class="contentTextInsideTable" align="center" width="13%">2007</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">GC416-GDN71T TIPE<br>
                                            II</td>
                                            <td class="contentTextInsideTable" width="27%">Business</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">2007</td>
                                            <td class="contentTextInsideTable" align="center"  width="13%">–</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">GC415-GDN41V TIPE<br>
                                            I</td>
                                            <td class="contentTextInsideTable" width="27%">Business/Passenger<br>
                                            Car</td>
                                            <td class="contentTextInsideTable" align="center" width="13%">2005</td>
                                            <td class="contentTextInsideTable" align="center" width="13%">2007</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">GC415-GDN41V TIPE<br>
                                            II</td>
                                            <td class="contentTextInsideTable" width="27%">Business/Passenger<br>
                                            Car</td>
                                            <td class="contentTextInsideTable" align="center" width="13%">2007</td>
                                            <td class="contentTextInsideTable" align="center" width="13%">–</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">GC416-GDN71V TIPE<br>
                                            I</td>
                                            <td class="contentTextInsideTable" width="27%">Business/Passenger<br>
                                            Car</td>
                                            <td class="contentTextInsideTable" align="center" width="13%">2005</td>
                                            <td class="contentTextInsideTable" align="center" width="13%">2007</td>
                                            </tr>
                                            <tr>
                                            <td class="contentTextInsideTable" width="16%"></td>
                                            <td class="contentTextInsideTable" width="28%">GC416-GDN71V TIPE<br>
                                            II</td>
                                            <td class="contentTextInsideTable" width="27%">Business/Passenger<br>
                                            Car</td>
                                            <td class="contentTextInsideTable" align="center" width="13%">2007</td>
                                            <td class="contentTextInsideTable" align="center" width="13%">–</td>
                                            </tr>
                                            <tr>
                                            <td width="16%">&nbsp; Karimun</td>
                                            <td width="28%">SL410R-DX</td>
                                            <td width="27%">Passenger Car</td>
                                            <td align="center" width="13%">1998</td>
                                            <td align="center" width="13%">2006</td>
                                            </tr>
                                            <tr>
                                            <td width="16%"></td>
                                            <td width="28%">SL410R-GX</td>
                                            <td width="27%">Passenger Car</td>
                                            <td align="center" width="13%">2003</td>
                                            <td align="center" width="13%">
                                            <div align="center">2004</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td width="16%">&nbsp; Grand Vitara</td>
                                            <td width="28%">JB420</td>
                                            <td width="27%">Utility</td>
                                            <td align="center" width="13%">2006</td>
                                            <td align="center" width="13%">
                                            <div align="center">2011</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td width="16%"></td>
                                            <td width="28%">MC M/T 2.0</td>
                                            <td width="27%">Utility</td>
                                            <td align="center" width="13%">2008</td>
                                            <td align="center" width="13%">
                                            <div align="center">–</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td width="16%"></td>
                                            <td width="28%">MC M/T 2.4</td>
                                            <td width="27%">Utility</td>
                                            <td align="center" width="13%">2008</td>
                                            <td align="center" width="13%">
                                            <div align="center">–</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td width="16%">&nbsp; Jimny</td>
                                            <td width="28%">LJ-80</td>
                                            <td width="27%">Utility</td>
                                            <td align="center" width="13%">1979</td>
                                            <td align="center" width="13%">
                                            <div align="center">1979</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td width="16%"></td>
                                            <td width="28%">LJ-80V</td>
                                            <td width="27%">Utility</td>
                                            <td align="center" width="13%">1980</td>
                                            <td align="center" width="13%">
                                            <div align="center">1983</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">LJ-80Q Canvas</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">1981</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1981</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SJ410VRH2</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">1990</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1993</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%">&nbsp; Super Jimny</td>
                                            <td  width="28%">SJ410-V1</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">1982</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1984</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SJ410Q Canvas</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">1983</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1986</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SJ410-V2</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">1985</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1985</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SJ410-V3</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">1985</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1986</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SJ410QR</td>
                                            <td  width="27%">Bussiness</td>
                                            <td align="center"  width="13%">1985</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1988</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SJ410-V4 (2WD)</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">1986</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1988</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SJ410 (2WD B/C)</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">1986</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1988</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SJ410V (4WD)</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">1987</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1988</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SJ410 COWL</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">1988</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1988</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%">&nbsp; Katana</td>
                                            <td  width="28%">SJ410ZH (2WD)</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">1988</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1990</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SJ410NZH (Santana 2WD)</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">1988</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1990</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SJ410VRH (4WD)</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">1988</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1990</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SJ410XZH (COWL-CS)</td>
                                            <td  width="27%">Bussiness</td>
                                            <td align="center"  width="13%">1988</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1990</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SJ410VZH2</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">1990</td>
                                            <td align="center"  width="13%">
                                            <div align="center">2007</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SJ410NZH2</td>
                                            <td  width="27%">Bussiness</td>
                                            <td align="center"  width="13%">1990</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1993</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SJ410XZH2</td>
                                            <td  width="27%">Bussiness</td>
                                            <td align="center"  width="13%">1990</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1996</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SJ410XZH2 (Katana LadyY)</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">1990</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1990</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%">&nbsp; Vitara (4WD)</td>
                                            <td  width="28%">SE416</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">1992</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1995</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SE416 EPI</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">1994</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1995</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%">&nbsp; Escudo (2WD)</td>
                                            <td  width="28%">SB416 STD/V6</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">1993</td>
                                            <td align="center"  width="13%">
                                            <div align="center">2000</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SB416 GLX</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">1997</td>
                                            <td align="center"  width="13%">
                                            <div align="center">2001</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SQ420 Escudo 2,0 M/T</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">2000</td>
                                            <td align="center"  width="13%">
                                            <div align="center">2006</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SQ420 Escudo 2,0 A/T</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">2001</td>
                                            <td align="center"  width="13%">
                                            <div align="center">2006</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SQ420 Escudo</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">2000</td>
                                            <td align="center"  width="13%">
                                            <div align="center">2006</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">JA625W XL-7 M/T</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">2003</td>
                                            <td align="center"  width="13%">
                                            <div align="center">2006</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">JA625W XL-7 A/T</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">2001</td>
                                            <td align="center"  width="13%">
                                            <div align="center">–</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%">&nbsp; Sidekick</td>
                                            <td  width="28%">SB416 (2WD)</td>
                                            <td  width="27%">Utility</td>
                                            <td align="center"  width="13%">1995</td>
                                            <td align="center"  width="13%">
                                            <div align="center">2001</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%">&nbsp; Fronte</td>
                                            <td  width="28%">LC20 FC</td>
                                            <td  width="27%">Passenger Car</td>
                                            <td align="center"  width="13%">1976</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1977</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%">&nbsp; Swift</td>
                                            <td  width="28%">SA310</td>
                                            <td  width="27%">Passenger Car</td>
                                            <td align="center"  width="13%">1985</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1985</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">RS415-YN3 M/T</td>
                                            <td  width="27%">Passenger Car</td>
                                            <td align="center"  width="13%">2007</td>
                                            <td align="center"  width="13%">
                                            <div align="center">2011</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">RS415-YN3 A/T</td>
                                            <td  width="27%">Passenger Car</td>
                                            <td align="center"  width="13%">2007</td>
                                            <td align="center"  width="13%">
                                            <div align="center">2011</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%">&nbsp; Forsa</td>
                                            <td  width="28%">SA410 Forsa</td>
                                            <td  width="27%">Passenger Car</td>
                                            <td align="center"  width="13%">1985</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1986</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SA410 New Forsa</td>
                                            <td  width="27%">Passenger Car</td>
                                            <td align="center"  width="13%">1986</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1987</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SA410 Forsa GLX</td>
                                            <td  width="27%">Passenger Car</td>
                                            <td align="center"  width="13%">1988</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1989</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%">&nbsp; Amenity</td>
                                            <td  width="28%">SF413GR (3 Doors)</td>
                                            <td  width="27%">Passenger Car</td>
                                            <td align="center"  width="13%">1990</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1992</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SF413GR (5 Doors)</td>
                                            <td  width="27%">Passenger Car</td>
                                            <td align="center"  width="13%">1990</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1992</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%">&nbsp; Esteem</td>
                                            <td  width="28%">SF413 M/T</td>
                                            <td  width="27%">Passenger Car</td>
                                            <td align="center"  width="13%">1991</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1996</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SF413 A/T</td>
                                            <td  width="27%">Passenger Car</td>
                                            <td align="center"  width="13%">1993</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1993</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SF416</td>
                                            <td  width="27%">Passenger Car</td>
                                            <td align="center"  width="13%">1992</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1996</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%">&nbsp; Baleno</td>
                                            <td  width="28%">SY416 N</td>
                                            <td  width="27%">Passenger Car</td>
                                            <td align="center"  width="13%">1996</td>
                                            <td align="center"  width="13%">
                                            <div align="center">1999</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SY415 N M/T</td>
                                            <td  width="27%">Passenger Car</td>
                                            <td align="center"  width="13%">1999</td>
                                            <td align="center"  width="13%">
                                            <div align="center">2003</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">SY415 N A/T</td>
                                            <td  width="27%">Passenger Car</td>
                                            <td align="center"  width="13%">2000</td>
                                            <td align="center"  width="13%">
                                            <div align="center">2002</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%">&nbsp; Aerio</td>
                                            <td  width="28%">RH415 M/T</td>
                                            <td  width="27%">Passenger Car</td>
                                            <td align="center"  width="13%">2002</td>
                                            <td align="center"  width="13%">
                                            <div align="center">2006</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">RH415 A/T</td>
                                            <td  width="27%">Passenger Car</td>
                                            <td align="center"  width="13%">2002</td>
                                            <td align="center"  width="13%">
                                            <div align="center">2006</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%">&nbsp; New Baleno(Next G)</td>
                                            <td  width="28%">RB415 M/T</td>
                                            <td  width="27%">Passenger Car</td>
                                            <td align="center"  width="13%">2002</td>
                                            <td align="center"  width="13%">
                                            <div align="center">2006</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td  width="16%"></td>
                                            <td  width="28%">RB415 A/T</td>
                                            <td  width="27%">Passenger Car</td>
                                            <td align="center"  width="13%">2002</td>
                                            <td align="center"  width="13%">
                                            <div align="center">2006</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td >&nbsp; SX4 Sedan(Neo Baleno)</td>
                                            <td >RW415-YY6 M/T</td>
                                            <td >Passenger Car</td>
                                            <td align="center" >2008</td>
                                            <td align="center" >
                                            <div align="center">2009</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td ></td>
                                            <td >RW415-YY6 A/T</td>
                                            <td >Passenger Car</td>
                                            <td align="center" >2008</td>
                                            <td align="center" >
                                            <div align="center">2009</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td >&nbsp; SX4</td>
                                            <td >RW415-YY6 M/T</td>
                                            <td >Passenger Car</td>
                                            <td align="center" >2008</td>
                                            <td align="center" >
                                            <div align="center"><span>2012</span></div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td ></td>
                                            <td >RW415-YY6 A/T</td>
                                            <td >Passenger Car</td>
                                            <td align="center" >2008</td>
                                            <td class="contentTextInsideTable" align="center" >
                                            <div align="center"><span>2012</span></div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td >&nbsp;&nbsp;Ertiga</td>
                                            <td >AVI414F MT DX Rear AC</td>
                                            <td >Passenger Car</td>
                                            <td align="center" >2012</td>
                                            <td class="contentTextInsideTable" align="center" >
                                            <div align="center">–</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td ></td>
                                            <td >AVI414F MT SDX Rear AC</td>
                                            <td >Passenger Car</td>
                                            <td align="center" >2012</td>
                                            <td class="contentTextInsideTable" align="center" >
                                            <div align="center">–</div>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td ></td>
                                            <td >AT</td>
                                            <td >Passenger Car</td>
                                            <td align="center" >2013</td>
                                            <td class="contentTextInsideTable" align="center" >–</td>
                                            </tr>
                                            <tr>
                                            <td >Karimun Wagon R</td>
                                            <td >GA</td>
                                            <td >Passenger Car</td>
                                            <td align="center" >2013</td>
                                            <td class="contentTextInsideTable" align="center" >–</td>
                                            </tr>
                                            <tr>
                                            <td ></td>
                                            <td >GL</td>
                                            <td >Passenger Car</td>
                                            <td align="center" >2013</td>
                                            <td class="contentTextInsideTable" align="center" >–</td>
                                            </tr>
                                            <tr>
                                            <td ></td>
                                            <td >GX</td>
                                            <td >Passenger Car</td>
                                            <td align="center" >2013</td>
                                            <td class="contentTextInsideTable" align="center" >–</td>
                                            </tr>
                                            <tr>
                                            <td ></td>
                                            <td >GS</td>
                                            <td >Passenger Car</td>
                                            <td align="center" >2014</td>
                                            <td class="contentTextInsideTable" align="center" >–</td>
                                            </tr>
                                            <tr>
                                            <td ></td>
                                            <td >GS AMT</td>
                                            <td >Passenger Car</td>
                                            <td align="center" >2015</td>
                                            <td class="contentTextInsideTable" align="center" >–</td>
                                            </tr>
                                            </tbody>
                                            </table>                                             
                                        </div>
                                    </div>
                                </div>                                
                                <!-- drawer handle/ title / 1-->
                                <div class="drawer-title ">
                                    <!-- gumby-trigger should target the id of drawer-content -->
                                    <a href="#" class="toggle posi" gumby-trigger="#drawer2">Sepeda Motor Suzuki Yang Pernah Diproduksi di Indonesia</span></a>
                                </div>
                                <!-- drawer content / 1 -->
                                <div class="drawer drawer-content" id="drawer2">
                                    <div class="content-block">
                                        <div class="row">                                            
                                            <table border:"0">
                                            <tbody>
                                            <tr>
                                            <td  width="43%">
                                            <p align="center"><strong>Model</strong></p>
                                            </td>
                                            <td  width="15%">
                                            <p align="center"><strong>Jenis</strong></p>
                                            </td>
                                            <td  align="center" width="16%"><strong>Mulai Produksi</strong></td>
                                            <td  align="center" width="22%"><strong>Akhir Produksi</strong></td>
                                            </tr>
                                            <tr>
                                            <td   width="43%">&nbsp; A 100</td>
                                            <td   width="15%">Bisnis</td>
                                            <td  align="center"  width="16%">1970</td>
                                            <td  align="center"  width="22%">2005</td>
                                            </tr>
                                            <tr>
                                            <td   width="43%">&nbsp; T 125</td>
                                            <td   width="15%">Dual Purpose</td>
                                            <td  align="center"  width="16%">1971</td>
                                            <td  align="center"  width="22%">1973</td>
                                            </tr>
                                            <tr>
                                            <td   width="43%">&nbsp; A 50</td>
                                            <td   width="15%">Bisnis</td>
                                            <td  align="center"  width="16%">1972</td>
                                            <td  align="center"  width="22%">1973</td>
                                            </tr>
                                            <tr>
                                            <td   width="43%">&nbsp; RV 90</td>
                                            <td   width="15%">Sand Bike</td>
                                            <td  align="center"  width="16%">1972</td>
                                            <td  align="center"  width="22%">1974</td>
                                            </tr>
                                            <tr>
                                            <td   width="43%">&nbsp; F 90</td>
                                            <td   width="15%">Under Bone</td>
                                            <td  align="center"  width="16%">1972</td>
                                            <td  align="center"  width="22%">1974</td>
                                            </tr>
                                            <tr>
                                            <td   width="43%">&nbsp; GT 250</td>
                                            <td   width="15%">Sport Twin</td>
                                            <td  align="center"  width="16%">1972</td>
                                            <td  align="center"  width="22%">1975</td>
                                            </tr>
                                            <tr>
                                            <td   width="43%">&nbsp; TS 100</td>
                                            <td   width="15%">Trail</td>
                                            <td  align="center"  width="16%">1973</td>
                                            <td  align="center"  width="22%">1981</td>
                                            </tr>
                                            <tr>
                                            <td   width="43%">&nbsp; FR 70</td>
                                            <td   width="15%">Under Bone</td>
                                            <td  align="center"  width="16%">1973</td>
                                            <td  align="center"  width="22%">1975</td>
                                            </tr>
                                            <tr>
                                            <td   width="43%">&nbsp; GT 185</td>
                                            <td   width="15%">Sport Twin</td>
                                            <td  align="center"  width="16%">1973</td>
                                            <td  align="center"  width="22%">1975</td>
                                            </tr>
                                            <tr>
                                            <td   width="43%">&nbsp; GT 100</td>
                                            <td   width="15%">Sport</td>
                                            <td  align="center"  width="16%">1974</td>
                                            <td  align="center"  width="22%">1977</td>
                                            </tr>
                                            <tr>
                                            <td   width="43%">&nbsp; GT 125</td>
                                            <td   width="15%">Sport Twin</td>
                                            <td  align="center"  width="16%">1974</td>
                                            <td  align="center"  width="22%">1975</td>
                                            </tr>
                                            <tr>
                                            <td   width="43%">&nbsp; FR 75</td>
                                            <td   width="15%">Under Bone</td>
                                            <td  align="center"  width="16%">1975</td>
                                            <td  align="center"  width="22%">1976</td>
                                            </tr>
                                            <tr>
                                            <td   width="43%">&nbsp; GT 380</td>
                                            <td   width="15%">3 Cylinder</td>
                                            <td  align="center"  width="16%">1975</td>
                                            <td  align="center"  width="22%">1975</td>
                                            </tr>
                                            <tr>
                                            <td   width="43%">&nbsp; TS 125</td>
                                            <td   width="15%">Trail</td>
                                            <td  align="center"  width="16%">1976</td>
                                            <td  align="center"  width="22%">1977</td>
                                            </tr>
                                            <tr>
                                            <td   width="43%">&nbsp; FR 80</td>
                                            <td   width="15%">Under Bone</td>
                                            <td  align="center"  width="16%">1976</td>
                                            <td  align="center"  width="22%">1983</td>
                                            </tr>
                                            <tr>
                                            <td   width="43%">&nbsp; GP 100</td>
                                            <td   width="15%">Sport</td>
                                            <td  align="center"  width="16%">1977</td>
                                            <td  align="center"  width="22%">1980</td>
                                            </tr>
                                            <tr>
                                            <td   width="43%">&nbsp; GP 125</td>
                                            <td   width="15%">Sport</td>
                                            <td  align="center"  width="16%">1977</td>
                                            <td  align="center"  width="22%">1980</td>
                                            </tr>
                                            <tr>
                                            <td   width="43%">&nbsp; TR S</td>
                                            <td   width="15%">Sport</td>
                                            <td  align="center"  width="16%">1982</td>
                                            <td  align="center"  width="22%">1992</td>
                                            </tr>
                                            <tr>
                                            <td   width="43%">&nbsp; RC 80</td>
                                            <td   width="15%">Under Bone</td>
                                            <td  align="center"  width="16%">1984</td>
                                            <td  align="center"  width="22%">1987</td>
                                            </tr>
                                            <tr>
                                            <td   width="43%">&nbsp; TR Z</td>
                                            <td   width="15%">Sport</td>
                                            <td  align="center"  width="16%">1984</td>
                                            <td  align="center"  width="22%">1986</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp; RC 100</td>
                                            <td  width="15%">Under Bone</td>
                                            <td align="center"  width="16%">&nbsp; 1986</td>
                                            <td align="center"  width="22%">&nbsp; 2002</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp; RC 110</td>
                                            <td  width="15%">Under Bone</td>
                                            <td align="center"  width="16%">&nbsp; 1989</td>
                                            <td align="center"  width="22%">&nbsp; 1994</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp; RC 100 GX</td>
                                            <td  width="15%">Under Bone</td>
                                            <td align="center"  width="16%">&nbsp; 1994</td>
                                            <td align="center"  width="22%">&nbsp; 1997</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp; RC 110 GS</td>
                                            <td  width="15%">Under Bone</td>
                                            <td align="center"  width="16%">&nbsp; 1994</td>
                                            <td align="center"  width="22%">&nbsp; 1997</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp; RGR 150</td>
                                            <td  width="15%">Sport</td>
                                            <td align="center"  width="16%">&nbsp; 1991</td>
                                            <td align="center"  width="22%">&nbsp; 1998</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp; TS 125 ER</td>
                                            <td  width="15%">Trail</td>
                                            <td align="center"  width="16%">&nbsp; 1993</td>
                                            <td align="center"  width="22%">&nbsp; 2005</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp; FD 110 Shogun</td>
                                            <td  width="15%">Under Bone</td>
                                            <td align="center"  width="16%">&nbsp; 1996</td>
                                            <td align="center"  width="22%">&nbsp; 2003</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp; RU 120 LD Satria S</td>
                                            <td  width="15%">Under Bone</td>
                                            <td align="center"  width="16%">&nbsp; 1997</td>
                                            <td align="center"  width="22%">&nbsp; 2002</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp; RU 120 LU Satria R</td>
                                            <td  width="15%">Under Bone</td>
                                            <td align="center"  width="16%">&nbsp; 1998</td>
                                            <td align="center"  width="22%">&nbsp; 2005</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp; GSX 250 Thunder</td>
                                            <td  width="15%">Sport</td>
                                            <td align="center"  width="16%">&nbsp; 1999</td>
                                            <td align="center"  width="22%">&nbsp; 2005</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp; FXR 150</td>
                                            <td  width="15%">Sport</td>
                                            <td align="center"  width="16%">&nbsp; 2000</td>
                                            <td align="center"  width="22%">&nbsp; 2003</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp; FD 110 Smash</td>
                                            <td  width="15%">Under Bone</td>
                                            <td align="center"  width="16%">&nbsp; 2002</td>
                                            <td align="center"  width="22%">&nbsp; 2006</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp; FD 125 Shogun</td>
                                            <td  width="15%">Under Bone</td>
                                            <td align="center"  width="16%">&nbsp; 2004</td>
                                            <td align="center"  width="22%">&nbsp; 2007</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp; EN 125 Thunder</td>
                                            <td  width="15%">Sport</td>
                                            <td align="center"  width="16%">&nbsp; 2004</td>
                                            <td align="center"  width="22%">&nbsp; –</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp; SATRIA F 150</td>
                                            <td  width="15%">Under Bone</td>
                                            <td align="center"  width="16%">&nbsp; 2004</td>
                                            <td align="center"  width="22%">&nbsp; –</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp; FH 125 ARASHI</td>
                                            <td  width="15%">Under Bone</td>
                                            <td align="center"  width="16%">&nbsp; 2006</td>
                                            <td align="center"  width="22%">&nbsp; 2008</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp; UY 125 SPIN</td>
                                            <td  width="15%">Scooter</td>
                                            <td align="center"  width="16%">&nbsp; 2006</td>
                                            <td align="center"  width="22%">&nbsp; –</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp; FK 110 SMASH</td>
                                            <td  width="15%">Under Bone</td>
                                            <td align="center"  width="16%">&nbsp; 2006</td>
                                            <td align="center"  width="22%">&nbsp;2010</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp; FL 125 SHOGUN</td>
                                            <td  width="15%">Under Bone</td>
                                            <td align="center"  width="16%">&nbsp; 2007</td>
                                            <td align="center"  width="22%">&nbsp;2011</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp; UW 125 SKY WAVE</td>
                                            <td  width="15%">&nbsp;Scooter</td>
                                            <td align="center"  width="16%">&nbsp; 2007</td>
                                            <td align="center"  width="22%">&nbsp;2011</td>
                                            </tr>
                                            <tr>
                                            <td  width="43%">&nbsp;&nbsp;FL 125 SHOGUN<br>
                                            FUEL&nbsp;INFECTION</td>
                                            <td  valign="top" width="15%">&nbsp;Under Bone</td>
                                            <td align="center"  valign="top" width="16%">&nbsp; 2007</td>
                                            <td align="center"  valign="top" width="22%">&nbsp;2011</td>
                                            </tr>
                                            <tr>
                                            <td >&nbsp; FW110 TITAN</td>
                                            <td  valign="top">&nbsp;Under Bone</td>
                                            <td align="center"  valign="top">&nbsp; 2010</td>
                                            <td align="center"  valign="top">&nbsp; –</td>
                                            </tr>
                                            <tr>
                                            <td >&nbsp; FL125 AXELO</td>
                                            <td  valign="top">&nbsp;Under Bone</td>
                                            <td align="center"  valign="top">&nbsp; 2011</td>
                                            <td align="center"  valign="top">&nbsp; –</td>
                                            </tr>
                                            <tr>
                                            <td >&nbsp; UW125 HAYATE</td>
                                            <td  valign="top">&nbsp;Scooter</td>
                                            <td align="center"  valign="top">&nbsp; 2011</td>
                                            <td align="center"  valign="top">&nbsp; –</td>
                                            </tr>
                                            <tr>
                                            <td ></td>
                                            <td  valign="top"></td>
                                            <td align="center"  valign="top"></td>
                                            <td  align="center"  valign="top"></td>
                                            </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- drawer handle/ title / 1-->
                                <div class="drawer-title ">
                                    <!-- gumby-trigger should target the id of drawer-content -->
                                    <a href="#" class="toggle posi" gumby-trigger="#drawer3">Produk Suzuki Marine Yang Pernah Dipasarkan di Indonesia</span></a>
                                </div>
                                <!-- drawer content / 1 -->
                                <div class="drawer drawer-content" id="drawer3">
                                    <div class="content-block">
                                        <div class="row">
                                            <table border="0" cellspacing="0" width="100%">
                                            <tbody>
                                            <tr>
                                            <td align="center"  width="3%"></td>
                                            <td align="center"  width="31%"><strong>MODEL</strong></td>
                                            <td align="center"  width="14%"><strong>JENIS</strong></td>
                                            <td align="center"  width="21%"><strong>MULAI<br>
                                            PEMASARAN</strong></td>
                                            <td align="center"  width="21%"><strong>AKHIR<br>
                                            PEMASARAN</strong></td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DT 2<br>
                                            S</td>
                                            <td align="center"  width="14%">2 Takt</td>
                                            <td align="center"  width="21%">1994</td>
                                            <td align="center"  width="21%">1998</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DT 2,2<br>
                                            S</td>
                                            <td align="center"  width="14%">2 Takt</td>
                                            <td align="center"  width="21%">1994</td>
                                            <td align="center"  width="21%">2005</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DF 2,5 S</td>
                                            <td align="center"  width="14%">4 Takt</td>
                                            <td align="center"  width="21%">2006</td>
                                            <td align="center"  width="21%">—</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DT 4 S,L</td>
                                            <td align="center"  width="14%">2 Takt</td>
                                            <td align="center"  width="21%">1994</td>
                                            <td align="center"  width="21%">2000</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DF 6 L</td>
                                            <td align="center"  width="14%">4 Takt</td>
                                            <td align="center"  width="21%">2004</td>
                                            <td align="center"  width="21%">—</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DT 8 S,L</td>
                                            <td align="center"  width="14%">2 Takt</td>
                                            <td align="center"  width="21%">1994</td>
                                            <td align="center"  width="21%">2003</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DT 9,9 S,L</td>
                                            <td align="center"  width="14%">2 Takt</td>
                                            <td align="center"  width="21%">1994</td>
                                            <td align="center"  width="21%">2000</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DT 15 S,L</td>
                                            <td align="center"  width="14%">2 Takt</td>
                                            <td align="center"  width="21%">1994</td>
                                            <td align="center"  width="21%">—</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DF 15 S,L</td>
                                            <td align="center"  width="14%">4 Takt</td>
                                            <td align="center"  width="21%">2000</td>
                                            <td align="center"  width="21%">—</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DT 25 L</td>
                                            <td align="center"  width="14%">2 Takt</td>
                                            <td align="center"  width="21%">1994</td>
                                            <td align="center"  width="21%">2003</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DF 30 L (Q/E)</td>
                                            <td align="center"  width="14%">4 Takt</td>
                                            <td align="center"  width="21%">2003</td>
                                            <td align="center"  width="21%">—</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DT 40 S,L,L2 (W/K)</td>
                                            <td align="center"  width="14%">2 Takt</td>
                                            <td align="center"  width="21%">1994</td>
                                            <td align="center"  width="21%">—</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DF 50 L,LX (Q/H)</td>
                                            <td align="center"  width="14%">4 Takt</td>
                                            <td align="center"  width="21%">2003</td>
                                            <td align="center"  width="21%">—</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DT 60 L</td>
                                            <td align="center"  width="14%">2 Takt</td>
                                            <td align="center"  width="21%">1994</td>
                                            <td align="center"  width="21%">2000</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DT 70 L</td>
                                            <td align="center"  width="14%">2 Takt</td>
                                            <td align="center"  width="21%">1994</td>
                                            <td align="center"  width="21%">2003</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DF 70 L,X</td>
                                            <td align="center"  width="14%">4 Takt</td>
                                            <td align="center"  width="21%">2002</td>
                                            <td align="center"  width="21%">—</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DT 85 L</td>
                                            <td align="center"  width="14%">2 Takt</td>
                                            <td align="center"  width="21%">1994</td>
                                            <td align="center"  width="21%">2000</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DT 115 UL</td>
                                            <td align="center"  width="14%">2 Takt</td>
                                            <td align="center"  width="21%">1994</td>
                                            <td align="center"  width="21%">2003</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DF 115 X</td>
                                            <td align="center"  width="14%">4 Takt</td>
                                            <td align="center"  width="21%">2002</td>
                                            <td align="center"  width="21%">—</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DT 140 UL</td>
                                            <td align="center"  width="14%">2 Takt</td>
                                            <td align="center"  width="21%">1994</td>
                                            <td align="center"  width="21%">2003</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DF 140 L,X (T/Z)</td>
                                            <td align="center"  width="14%">4 Takt</td>
                                            <td align="center"  width="21%">2002</td>
                                            <td align="center"  width="21%">—</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DF 175 L,X (T/Z)</td>
                                            <td align="center"  width="14%">4 Takt</td>
                                            <td align="center"  width="21%">2005</td>
                                            <td align="center"  width="21%">—</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DT 200 UL</td>
                                            <td align="center"  width="14%">2 Takt</td>
                                            <td align="center"  width="21%">1994</td>
                                            <td align="center"  width="21%">2003</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DF 200 X (T/Z)</td>
                                            <td align="center"  width="14%">4 Takt</td>
                                            <td align="center"  width="21%">2004</td>
                                            <td align="center"  width="21%">—</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DF 225 X,XX (T/Z)</td>
                                            <td align="center"  width="14%">4 Takt</td>
                                            <td align="center"  width="21%">2005</td>
                                            <td align="center"  width="21%">—</td>
                                            </tr>
                                            <tr>
                                            <td align="center"  width="3%"><img src="<?php echo base_url('assets/public/images/ic_arrow_darkblue_2.png');?>" alt="" height="9" width="8"></td>
                                            <td  width="31%">DF 250 X,XX (T/Z)</td>
                                            <td align="center"  width="14%">4 Takt</td>
                                            <td align="center"  width="21%">2003</td>
                                            <td align="center"  width="21%">—</td>
                                            </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <!-- drawer handle/ title / 1-->
                                <div class="drawer-title ">
                                    <!-- gumby-trigger should target the id of drawer-content -->
                                    <a href="#" class="toggle posi" gumby-trigger="#drawer4">Tipe-tipe Suzuki Outboard (Marine)<br>yang masih dipasarkan saat ini</span></a>
                                </div>
                                <!-- drawer content / 1 -->
                                <div class="drawer drawer-content" id="drawer4">
                                    <div class="content-block">
                                        <div class="row">
                                        <table border:"0">
                                            <tbody>
                                            <tr>
                                            <td  align="center" width="48%"><strong><br>
                                            2 TAKT</strong></td>
                                            <td  align="center" width="52%"><strong><br>
                                            4 TAKT</strong></td>
                                            </tr>
                                            <tr>
                                            <td  align="left"  width="48%">DT 15<br>
                                            S,L</td>
                                            <td   align="left"  width="52%">DF<br>
                                            2,5 S</td>
                                            </tr>
                                            <tr>
                                            <td  align="left"  width="48%">DT 40<br>
                                            S,L,L2 ( W/K )</td>
                                            <td   align="left"  width="52%">DF 6<br>
                                            L</td>
                                            </tr>
                                            <tr>
                                            <td  align="left"  width="48%"></td>
                                            <td   align="left"  width="52%">DF 15<br>
                                            S,L</td>
                                            </tr>
                                            <tr>
                                            <td  align="left"  width="48%"></td>
                                            <td   align="left"  width="52%">DF 30<br>
                                            L ( Q/E )</td>
                                            </tr>
                                            <tr>
                                            <td  align="left"  width="48%"></td>
                                            <td   align="left"  width="52%">DF 50<br>
                                            L,UL ( Q/H )</td>
                                            </tr>
                                            <tr>
                                            <td  align="left"  width="48%"></td>
                                            <td   align="left"  width="52%">DF 70<br>
                                            L,X</td>
                                            </tr>
                                            <tr>
                                            <td  align="left"  width="48%"></td>
                                            <td   align="left"  width="52%">DF<br>
                                            115 X</td>
                                            </tr>
                                            <tr>
                                            <td  align="left"  width="48%"></td>
                                            <td   align="left"  width="52%">DF<br>
                                            140</td>
                                            </tr>
                                            <tr>
                                            <td  align="left"  width="48%"></td>
                                            <td   align="left"  width="52%">DF<br>
                                            175</td>
                                            </tr>
                                            <tr>
                                            <td  align="left"  width="48%"></td>
                                            <td   align="left"  width="52%">DF<br>
                                            225</td>
                                            </tr>
                                            <tr>
                                            <td   align="left"  width="48%"></td>
                                            <td   align="left"  width="52%">DF<br>
                                            250</td>
                                            </tr>
                                            </tbody>
                                        </table>  
                                        </div>
                                    </div>
                                </div>                  
                            </div><!-- end drawers -->    
                                </div>    
                                </section><!-- end tabs -->
                            </div>
                            <hr class="thin grey">           
                        </div>
                    </div>
                </div>
                <!-- sidebar -->
                <aside class="one-third grey">
                    <div id="sidebar">
                        <!-- category widget -->
                        <div class="widget">
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
                    </div>
                </aside>
                <!-- clear floats -->
                <div class="clear">
                </div>
            </section>
</div>