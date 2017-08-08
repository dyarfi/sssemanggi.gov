<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); //print_r($dealer_bookings);?>
<div class="modal modal-book-dealer" id="modal2">
    <div class="content">
    <a class="close switch btn medium" gumby-trigger="|#modal2"><i class="icon-cancel" /></i></a>
        <?php echo form_open_multipart(base_url('services/automobile/booking.json'),array('id'=>'booking-form-dealer','method'=>'POST','class'=>'white'));?>
            <input type="hidden" name="dealer_id" value="<?php echo $dealer->id;?>">
            <input type="hidden" name="book_type" value="0">
            <!-- first part -->
            <div class="clear-20"></div>
            <div class="mod-title"><h4 class="bold">DAFTAR LAYANAN SERVIS</h4></div>
            <hr class="thin grey">
            <div class="row fields">
                <ul class="twelve row">
                    <li class="twelve row">
                        <div class="twelve columns field">
                            <label>Nama</label>
                            <input type="text" class="input" name="name" value="">
                            <span class="errors warning name"></span>
                        </div>
                    </li>
                    <li class="twelve row">
                        <div class="twelve columns field">
                            <label>Alamat Email</label>
                            <input type="email" class="input" name="email" value="">
                            <span class="errors warning email"></span>
                        </div>
                    </li>
                    <li class="twelve row">
                        <div class="twelve columns field">
                            <label>Nomor Telepon</label>
                            <input type="text" class="input" name="phone" value="">
                            <span class="errors warning phone"></span>
                        </div>
                    </li>
                    <li class="twelve row">
                        <div class="six columns field">
                            <label>Pilih Kendaraan</label>
                            <p class="picker">
                                <select name="service_vehicle_id">
                                    <option selected readonly value="">Pilih Kendaraan</option>
                                    <?php
                                    if ($logged_in) {
                                        foreach ($vehicles as $vehicle)
                                        {
                                            $number_vin = ($vehicle->plate_number) ? "({$vehicle->plate_number} | {$vehicle->vin_number})" : '';
                                            print("<option value='{$vehicle->service_vehicle_id}'>{$vehicle->subject} $number_vin</option>");
                                            //print("<option value='{$vehicle->service_vehicle_id}'>{$vehicle->subject}</option>");
                                        }
                                    } else {
                                        foreach ($vehicles as $vehicle)
                                        {
                                            print("<option value='{$vehicle->id}'>{$vehicle->subject}</option>");
                                        }
                                    }
                                    ?>
                                </select>
                            </p>
                            <span class="errors warning service_vehicle_id"></span>
                        </div>
                        <div class="six columns">
                            <label>Tipe Transmisi</label>
                            <p class="picker">
                                <select name="vehicle_type">
                                    <option selected disabled value="">Tipe Transmisi</option>
                                    <option value="Manual">Manual</option>
                                    <option value="Automatic">Automatic</option>
                                </select>
                            </p>
                            <span class="errors warning vehicle_type"></span>
                        </div>
                    </li>
                    <li class="twelve row">
                        <div class="twelve columns field">
                            <label>Nomor VIN</label>
                            <input type="text" class="input" name="vin_number" value="">
                            <span class="errors warning vin_number"></span>
                        </div>
                    </li>
                    <li class="twelve row">
                        <div class="twelve columns field">
                            <label>Nomor Polisi</label>
                            <input type="text" class="input" name="license_number" value="">
                            <span class="errors warning license_number"></span>
                        </div>
                    </li>
                    <li class="twelve row">
                        <div class="twelve columns field">
                            <label>Nama pada STNK</label>
                            <input type="text" class="input" name="license_name" value="">
                            <span class="errors warning license_name"></span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="twelve row">
                <div class="field">
                    <label>Tipe Servis</label>
                    <div class="picker five columns">
                        <select name="service_type">
                            <option selected disabled value="">Pilih Layanan</option>
                            <option value="1">Free Service 1 (1000 KM)</option>
                            <option value="2">Free Service 2 (5000 KM)</option>
                            <option value="3">Free Service 3 (10000 KM)</option>
                            <option value="4">Free Service 4 (20000 KM)</option>
                            <option value="5">Free Service 5 (30000 KM)</option>
                            <option value="6">Free Service 6 (40000 KM)</option>
                            <option value="7">Free Service 7 (50000 KM)</option>
                            <option value="8">Paket A (Kelipatan 5000 KM)</option>
                            <option value="9">Paket B (Kelipatan 10000 KM)</option>
                            <option value="10)">Paket C (Kelipatan 20000 KM)</option>
                            <option value="11">Paket D (Kelipatan 40000 KM)</option>
                            <option value="12">Suzuki Product Quality Update</option>
                            <option value="0" class="clear-custom">Custom Service</option>
                        </select>
                    </div>
                    <span class="errors warning service_type"></span>
                    <div class="six columns hide" id="custom-field">
                        <input class="input" type="text" value="" name="custom" id="custom"/>
                        <span class="errors warning custom"></span>
                    </div>
                </div>
                <div class="twelve row">
                    <div class="field">
                        <ul>
                            <li class="rows">
                                <div class="twelve columns">
                                    <div class="field">
                                        <label for="captcha"><?php echo lang('captcha');?> * :</label>
                                        <div class="twelve">
                                            <input type="text" name="captcha" id="captcha" class="input three columns" value="<?php echo $fields->captcha;?>">
                                            <a class="reload_captcha four columns" rel="<?php echo base_url('xhr/reload_captcha')?>" href="javascript:;"><?php echo $this->captcha['image'];?></a>
                                            <span class="errors warning captcha"></span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="twelve row">
                    <div class="field">
                        <input type="hidden" name="time" value=""/>
                        <input type="hidden" name="date" value=""/>
                        <input type="submit" name="Submit" value=" Simpan " class="purple submit">
                    </div>
                </div>
            </div>
        <?php echo form_close();?>
        <hr class="thin grey">
    </div>
</div>
