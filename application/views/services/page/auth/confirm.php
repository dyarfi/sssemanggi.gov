<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- action class for animating page content when header is active -->
<div class="action step-right">
    <!-- img header -->
    <section class="header-halo" style="background: url(<?php echo base_url('assets/public/images/profile_bg.jpg');?>) center center no-repeat; background-size: cover;">
        <div class="black-tint has-button">
            <div id="crumbs" class="abs">
                <div class="eight columns">
                    <h6 class="sub-heading">
                        <a href="<?=base_url('services');?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        <a href="#">Member Confirmation</a>
                    </h6>
                </div>
            </div>
            Member Confirmation
            <span class="sub-lite">Member Confirmation</span>
        </div>
    </section>
    <section class="back-white">
        <?php
        if ($confirm_hash_exists)
        {
        ?>
        <div class="row fields">
            <ul class="the-form row">
                <li>
                    <div style="text-align: center" class="twelve columns field">
                        <button class="open-pop dom-confirm btn-confirm">
                            Konfirmasi
                        </button>
                    </div>
                </li>
            </ul>
        </div>
        <?php
        }
        ?>
    </section>
</div>

<!-- end div.content -->
<?php
if ($confirm_hash_exists) {
    ?>
    <div class="pop-up pop-confirm" style="display: none;">
        <a href="#" class="pop-close"><i class="fa fa-times"></i></a>
        <div class="tit-pop">Konfirmasi Member</div>
        <?php echo form_open_multipart(base_url('services/auth/confirm/validate.json'),['id'=>'confirm-form','method'=>'POST']);?>
            <ul class="the-form row">
                <li>
                    <input type="text" name="vin_number" placeholder="Nomor VIN Kendaraaan"/>
                </li>
                <li>
                    <input type="text" name="plate_number" placeholder="Nomor Polisi"/>
                </li>
                <li>
                    <input type="text" name="registered_name" placeholder="Nama di STNK"/>
                </li>
                <li class="row picker">
                    <select name="vehicle_type" class="column">
                        <?php
                        foreach ($products as $product)
                        {
                        ?>
                        <option value="<?=$product->id?>"><?=$product->subject;?></option>
                        <?php
                        }
                        ?>
                    </select>
                </li>
                <li>
                    <input type="text" name="confirmation_code" placeholder="Kode Konfirmasi"/>
                    <input type="hidden" name="confirmation_hash" value="<?=$confirmation_hash;?>"/>
                </li>
                <li>
                    <button type="submit">Validate</button>
                </li>
            </ul>
        <?php echo form_close();?>
    </div>
    <?php
}
?>
<br/><br/><br/><br/><br/><br/><br/><br/>
