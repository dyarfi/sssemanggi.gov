<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ($survey) {
$objective = array();
$booleans = array();
$freetexts = array();
$ranges = array();
foreach ($surveys as $item) {
    if ($item->ssq_type == 'objective') {
        array_push($objective, array('id' => $item->ssq_id, 'subject' => $item->ssq_subject));
    } else if ($item->ssq_type == 'boolean') {
        array_push($booleans, array('id' => $item->ssq_id, 'subject' => $item->ssq_subject));
    } else if ($item->ssq_type == 'freetext') {
        array_push($freetexts, array('id' => $item->ssq_id, 'subject' => $item->ssq_subject));
    } else if ($item->ssq_type == 'range') {
        array_push($ranges, array('id' => $item->ssq_id, 'subject' => $item->ssq_subject));
    }
}
?>
<div class="pop-up pop-survey" style="display: none;">
    <a href="#" class="pop-close"><i class="fa fa-times"></i></a>
    <div class="tit-pop">Survey Online</div>
          <?php echo form_open_multipart(base_url('services/survey/save.json'),array('id'=>'survey-form','class'=>'nice-scroll','method'=>'POST','style'=>'height: 500px; overflow-y: scroll;overflow-x: hidden;'));?>
            <ul class="the-form row">
                <li>
                    <input type="text" name="ssr_name" placeholder="Nama" value="<?php echo @$this->member->fullname;?>"/>
                </li>
                <li>
                    <input type="text" name="ssr_email" placeholder="E-Mail" value="<?php echo @$this->member->email;?>"/>
                </li>
                <li>
                    <input type="text" name="ssr_phone_number" placeholder="Nomor Telepon" value="<?php echo @$this->member->phone_number;?>"/>
                </li>
                <li>
                    <input type="text" name="ssr_address" placeholder="Alamat" value="<?php echo @$this->member->address;?>"/>
                </li>
                <li>
                    <input type="text" name="ssr_vin_number" placeholder="VIN Number (17 Nomor Rangka Kendaraan)"/>
                </li>
                <?php
                if (count($booleans) > 0) {
                ?>
                <li><h5>Silakan lengkapi formulir berikut:</h5></li>
                <li>
                    <?php foreach ($objective as $object) { ?>
                    <h5 class="center"><?=$object['subject'];?></h5>
                    <div class="skin-line">
                      <ul class="list">
                        <li class="input-half">
                          <img class="img-center" src="<?php echo base_url('assets/public/images');?>/smile.png" alt="">
                          <input tabindex="21" type="radio" id="line-radio-3" value="1" checked name="question[<?=$object['id'];?>]">
                          <label for="line-radio-3">Memuaskan</label>
                        </li>
                        <li class="input-half">
                          <img class="img-center" src="<?php echo base_url('assets/public/images');?>/frown.png" alt="">
                          <input tabindex="22" type="radio" id="line-radio-4" value="2" name="question[<?=$object['id'];?>]">
                          <label for="line-radio-4">Mengecewakan</label>
                        </li>
                      </ul>
                    </div>
                    <?php } ?>
                </li>
                <?php
                foreach ($booleans as $boolean) {
                    ?>
                    <li class="columns">
                        <label><?=$boolean['subject'];?></label>
                        <div class="skin-line">
                          <ul class="list">
                            <li class="input-half">
                              <input tabindex="19" type="radio" id="line-radio-1" name="question[<?=$boolean['id'];?>]" value="1" checked>
                              <label for="line-radio-1">Ya</label>
                            </li>
                            <li class="input-half">
                              <input tabindex="20" type="radio" id="line-radio-2" name="question[<?=$boolean['id'];?>]" value="0">
                              <label for="line-radio-2">Tidak</label>
                            </li>
                          </ul>
                        </div>
                    </li>
                    <?php
                    }
                }
                ?>
                <?php
                if (count($ranges) > 0) {
                    ?>
                    <li class="row">
                        <h5>Mohon untuk mengisi pilihan sesuai dengan skala kepuasan anda
                        (1 sampai 5 buruk, 6 - 7 cukup dan 8 - 10 sangat baik)</h5></li>
                    <?php
                    foreach ($ranges as $range) {
                        ?>
                        <li class="columns">
                            <label><?=$range['subject'];?></label>
                                <div class="skin-line">
                                  <ul class="list">
                                    <?php
                                        for($i=1;$i<11;$i++) {
                                            ?>
                                            <li class="input-10">
                                              <input tabindex="19" type="radio" id="line-radio-1" name="question[<?=$range['id'];?>]" value="<?=$i;?>">
                                              <label for="line-radio-1"><?=$i;?></label>
                                            </li>
                                            <?php
                                        }
                                    ?>
                                  </ul>
                                </div>
                        </li>
                        <?php
                    }
                }
                ?>
                <?php
                if (count($freetexts) > 0) {
                    ?>
                    <li class="row"><h5>Opini Anda:</h5></li>
                    <?php
                    foreach ($freetexts as $freetext) {
                        ?>
                        <li class="columns field">
                            <?=$freetext['subject'];?>
                            <textarea class="input textarea" name="question[<?=$freetext['id'];?>]"></textarea>
                        </li>
                        <?php
                    }
                }
                ?>
                <li class="columns">
                    <div class="twelve columns">
                        <div class="field">
                            <label for="captcha"><?php echo lang('captcha');?> * :</label>
                            <div class="twelve">
                                <input type="text" name="captcha" id="captcha" class="input eight columns" value="<?php echo $fields->captcha;?>">
                                <a class="reload_captcha four columns" rel="<?php echo base_url('xhr/reload_captcha')?>" href="javascript:;"><?php echo $this->captcha['image'];?></a>
                            </div>
                        </div>
                        <?php echo $errors['captcha'];?>
                    </div>
                </li>
                <li class="columns">
                    <button type="submit">Kirim</button>
                </li>
            </ul>
    <?php echo form_close();?>
</div>
<?php
}
?>
