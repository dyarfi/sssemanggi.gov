<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>
<!-- planner window -->
<div class="planner-modal grey custom-scroll cbp-spmenu cbp-spmenu-right" id="news-letter">
    <!-- planner-scrollarea adds custom scrollbar for planner -->
    <div id="planner-scrollarea">
        <div class="content-block">
            <div class="row">
            <!-- planner heading -->
            <div class="ten columns centered">
                <h2 class="bold">DAFTAR SEKARANG,</h2>
                <p class="intro s-bold">
                    DAPATKAN PROMO DAN INFO MENARIK SEPUTAR PRODUK PRODUK SUZUKI
                </p>
                <hr class="thin grey">
            </div>
            </div>
            <div class="row">
            <div class="ten columns centered smallpadding">
                <?php echo form_open_multipart(base_url('newsletter'),array('id'=>'form-subscribes','class'=>'form-horizontal','name'=>'subscribes','method'=>'POST','rel'=>base_url($this->uri->uri_string())));?>
                    <!-- first part -->
                    <h5 class="bold purple-text">Data Diri</h5>
                    <div class="clear-20">
                    </div>
                    <div class="row">
                        <div class="field six columns">
                            <label for="name_newsletter">Nama*</label>
                            <input class="input" required type="text" id="name_newsletter" name="name_newsletter" placeholder="" value="">
                            <?php echo $errors['name_newsletter'];?>
                        </div>
                        <div class="field six columns">
                            <label for="email_newsletter">E-mail*</label>
                            <input class="input" required type="email" id="email_newsletter" name="email_newsletter" placeholder="" value="">
                            <?php echo $errors['email_newsletter'];?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="field six columns">
                            <label for="phone_newsletter">No. Telephone / HP</label>
                            <input class="input" required type="tel" id="phone_newsletter" name="phone_newsletter" placeholder="" value="">
                            <?php echo $errors['phone_newsletter'];?>
                        </div>
                    </div>

                    <div class="clear-20">
                    </div>
                    <!-- second part -->
                    <hr class="thin grey">
                    <h5 class="bold purple-text">Alamat</h5>
                    <div class="clear-20"></div>
                    <div class="row">
                        <div class="twelve">
                            <label for="province">Propinsi</label>
                            <div class="picker twelve columns">
                                <input type="hidden" value="<?php echo $fields->province;?>">
                                <select name="province" class="form-control picker-area" id="province" required>
                                    <option value="">PROPINSI</option>
                                    <?php foreach ($this->provinces as $province){ ?>
                                      <option value="<?php echo $province->id;?>" name="province"><?php echo $province->name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php echo $errors['province'];?>
                        </div>

                        <div class="twelve">
                            <label for="urbandistrict">Kabupaten</label>
                            <div class="picker twelve columns">
                                <input type="hidden" value="<?php echo $fields->urbandistrict;?>">
                                <select name="urbandistrict" class="form-control picker-area" id="urbandistrict" required>
                                    <option value="">KABUPATEN</option>
                                </select>
                            </div>
                            <?php echo $errors['urbandistrict'];?>
                        </div>

                        <div class="twelve">
                            <label for="suburban">Kecamatan</label>
                            <div class="picker twelve columns">
                                <input type="hidden" value="<?php echo $fields->suburban;?>" required>
                                <select name="suburban" class="form-control picker-area" id="suburban" required>
                                    <option value="">KECAMATAN</option>
                                </select>
                            </div>
                            <?php echo $errors['suburban'];?>
                        </div>
                    </div>
                    <div class="field row">
                        <label for="address_newsletter">Alamat</label>
                        <div class="textarea">
                            <textarea class="input textarea" rows="4" id="address_newsletter" name="address_newsletter"></textarea>
                        </div>
                        <?php echo $errors['address_newsletter'];?>
                    </div>
                    <div class="clear-20">
                    </div>
                    <!-- second part -->
                    <hr class="thin grey">
                    <h5 class="bold purple-text">Informasi yang dibutuhkan</h5>
                    <div class="clear-20">
                    </div>
                    <div class="row">
                        <div class="picker six columns">
                            <select name="information">
                                <option value="" disabled>Pilih Informasi yang dibutuhkan</option>
                                <option value="Promo & After Sales">Promo & After Sales</option>
                                <option value="Info & Promo">Info & Promo</option>
                                <option value="Daftar Harga">Daftar Harga</option>
                                <option value="Test Drive">Test Drive</option>
                            </select>
                        </div>
                        <div class="picker six columns">
                            <select name="product">
                                <option value="" disabled>Pilih Produk</option>
                                <?php foreach($this->automobiles as $automobiles) {?>
                                    <option value="<?php echo $automobiles->subject;?>"><?php echo $automobiles->subject;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <hr class="thin grey">
                    <div class="field row">
                        <div class="twelve columns alpha">
                            <p>
                                <span class="purple-text bold"></span>
                                <label class="checkbox checked" for="terms">
                                    <input type="checkbox" name="terms" id="terms" value="1" required>
                                    <span></span> Dengan mengirimkan informasi ini Saya mengizinkan Suzuki dan mitranya untuk menghubungi Saya dalam membantu proses pembelian mobil. Dengan memberikan email dan no handphone, saya telah menyetujui untuk menerima semua pemberitahuan melalui Suzuki.
                                </label>
                                <?php echo $errors['terms'];?>
                            </p>
                        </div>
                    </div>
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
                    <div class="twelve columns">
                        <input type="submit" name="Submit" value="Submit" class="purple submit">
                    </div>
                    <hr class="thin grey">
                    <div class="twelve columns">
                        <div class="email-msg warning light"></div>
                    </div>
                <?php echo form_close();?>
                <div class="clear-20"></div>
            </div>
            </div>
        </div>
        <!-- close planner button -->
        <a class="remove-planner invisibile-ie"><i class="fa fa-times"></i></a>
        <a class="remove-planner visibile-ie"><i class="fa fa-times">x</i></a>
    </div><!--planner scrollarea -->
</div><!-- planner -->
