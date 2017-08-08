<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="backlit" style="display: none;"></div>

<?php $this->load->view('services/page/auth/account');?>

<!-- action class for animating page content when header is active -->
<div class="action step-right">
    <!-- img header -->
    <section class="header-halo" style="background: url(<?=base_url();?>assets/public/service/assets/img/seseraan.jpg) center center no-repeat; background-size: cover;">
        <div class="black-tint">
            <div id="crumbs" class="abs">
                <div class="eight columns">
                    <h6 class="sub-heading">
                        <a href="<?=base_url('services');?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        <a href="<?=base_url('services');?>">Servis</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        <a href="#">Layanan 24 Jam Sera</a>
                    </h6>
                </div>
            </div>
            24 HOURS SUZUKI EMERGENCY ROADSITE ASSISTANT (24H SERA)
        </div>
    </section>
    <section class="back-white">
        <div class="desc_content">
            <p>Nikmati kenyamanan berkendaraan selama 24 jam ketika terjadi gangguan atau keadaaan darurat di jalan. Fasilitas ini diberikan <b>GRATIS*</b> kepada pengguna kendaraan Suzuki selama masa garansi (3 tahun atau 100,000 KM) sejak pembelian.</p>
            <p>Layanan <b>24H SeRa</b> ini terdiri dari :</p>
            <ol>
                <li>Panduan teknis untuk pemeriksaan awal dalam situasi kondisi darurat bagi pengguna kendaraan Suzuki.</li>
                <li>
                    Bantuan perbaikan ringan di lokasi kejadian (OnSite Repair), terdiri dari :<br /><br />
                        <ul><li>Mengaktifkan batere/ aki yang lemah (Battery Jumper)</li>
                        <li>Penggantian ban dengan ban cadangan (Flat Tire Service)</li>
                        <li>Layanan kunci tertinggal di dalam mobil (Locksmith Service)</li>
                        <li>Pengisian bahan bakar untuk kendaraan yang kehabisan bahan bakar (Fuel Supply Service)</li>
                        <li>Layanan service ringan darurat yang kurang dari 1 jam.</li>
                    </ul>
                <br />
                </li>
                <li>Layanan Mobil Gendong (Towing) dari lokasi keadaan darurat ke Bengkel Resmi Suzuki terdekat, untuk perbaikan yang tidak dapat diatasi di jalan atau proses perbaikan lebih dari 1 jam.</li>
            </ol>
            <p>Daerah layanan <b>24H SeRa</b> meliputi daerah berikut :</p>
            <ol>
                <li>JABODETABEK</li>
                <li>BANDUNG</li>
                <li>SURABAYA</li>
                <li>DENPASAR</li>
                </ol>
                <p>Khusus untuk layanan Mobil Gendong (Towing) berlaku untuk daerah JABODETABEK, BANDUNG, SURABAYA dan DENPASAR.</p>
                <p>Cara mendapatkan fasiltas <b>24H SeRa</b> tersebut dengan menghubungi layanan call center <b>HALO SUZUKI  <a href="tel:+62-0800-1100-800">0800-1100-800</a></b> <i>(bebas pulsa).</i></p><br>
                <p><i>*syarat dan ketentuan berlaku.</i></p>
            </div><br>
        <img src="<?=base_url();?>assets/public/service/assets/img/P_20150206_092258.jpg" />
        <table border="0" cellpadding="0" cellspacing="2" style="width: 100%;">
	<tbody>
		<tr>
			<td><img alt="" src="<?=base_url();?>assets/public/service/assets/img/sc2.jpg" style="width: 442px; height: 250px;" /></td>
			<td><img alt="" src="<?=base_url();?>assets/public/service/assets/img/sc3.jpg" style="width: 442px; height: 332px;" /></td>
		</tr>
	</tbody>
</table>
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