<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="book-modal grey custom-scroll">
    <!-- planner-scrollarea adds custom scrollbar for planner -->
    <div id="book-scrollarea">
        <div class="content-block">
            <div class="mod-title"><h2 class="bold">DAFTAR LAYANAN SERVIS</h2></div>
            <div class="row">
                <div class="ten columns centered smallpadding">
                    <?php echo form_open_multipart(base_url('services/automobile/booking.json'),array('id'=>'booking-form','method'=>'POST'));?>
                        <!-- first part -->
                        <div class="clear-20"></div>
                        <div class="row fields">
                            <ul>
                                <li class="row">
                                    <div class="twelve columns field">
                                        <label>Nama</label>
                                        <input type="text" class="input" name="name" value="<?php echo @$this->member->fullname;?>">
                                    </div>
                                </li>
                                <li class="row">
                                    <div class="twelve columns field">
                                        <label>Alamat Email</label>
                                        <input type="email" class="input" name="email" value="<?php echo @$this->member->email;?>">
                                    </div>
                                </li>
                                <li class="row">
                                    <div class="twelve columns field">
                                        <label>Nomor Telepon</label>
                                        <input type="text" class="input" name="phone" value="<?php echo @$this->member->phone_number;?>">
                                    </div>
                                </li>
                                <li class="row">
                                    <div class="twelve columns field">
                                        <label>Pilih Kendaraan</label>
                                        <div class="picker">
                                            <select name="service_vehicle_id">
                                                <option selected disabled value="0">Pilih Kendaraan</option>
                                                <?php
                                                if ($logged_in) {
                                                    foreach ($vehicles as $vehicle)
                                                    {
                                                        $number_vin = ($vehicle->plate_number) ? "({$vehicle->plate_number} | {$vehicle->vin_number})" : '';
                                                        //print("<option value='{$vehicle->service_vehicle_id}'>{$vehicle->subject} $number_vin</option>");
                                                        print("<option value='{$vehicle->vehicle_type}'>{$vehicle->subject}</option>");
                                                    }
                                                } else {
                                                    foreach ($vehicles as $vehicle)
                                                    {
                                                        print("<option value='{$vehicle->id}'>{$vehicle->subject}</option>");
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li class="row">
                                    <div class="twelve columns">
                                        <label>Tipe Kendaraan</label>
                                        <div class="picker">
                                            <select name="vehicle_type">
                                                <option selected disabled value="0">Tipe Kendaraan</option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li class="row">
                                    <div class="twelve columns field">
                                        <label>Nomor VIN</label>
                                        <input type="text" class="input" name="vin_number" value="<?php echo @$this->member->vin_number;?>" placeholder="Di isi dengan 17 Nomor Rangka Kendaraan">
                                    </div>
                                </li>
                                <li class="row">
                                    <div class="twelve columns field">
                                        <label>Nomor Polisi</label>
                                        <input type="text" class="input" name="license_number" value="">
                                    </div>
                                </li>
                                <li class="row">
                                    <div class="twelve columns field">
                                        <label>Nama pada STNK</label>
                                        <input type="text" class="input" name="license_name" value="">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="field">
                                <div class="picker twelve columns">
                                    <select name="service_type">
                                        <option selected disabled value="0">Pilih Layanan</option>
                                        <option value="1">Free Service 1 (1000 KM)</option>
                                        <option value="2">Free Service 2 (5000 KM)</option>
                                        <option value="3">Free Service 3 (10000 KM)</option>
                                        <option value="4">Free Service 4 (20000 KM)</option>
                                        <option value="5">Free Service 5 (30000 KM)</option>
                                        <option value="6">Free Service 6 (40000 KM)</option>
                                        <option value="7">Free Service 7 (50000 KM)</option>
                                        <option value="8">Paket A (Kelipatan 5000 KM)</option>
                                        <option value="9">Paket B (Kelipatan 10000 KM)</option>
                                        <option value="10">Paket C (Kelipatan 20000 KM)</option>
                                        <option value="11">Paket D (Kelipatan 40000 KM)</option>
                                        <option value="12">Suzuki Product Quality Update</option>
                                        <option value="0" class="clear-custom">Custom Service</option>
                                    </select>
                                </div>
                                <div class="twelve rows hide" id="custom-field">
                                    <input class="input" type="text" value="" name="custom" id="custom"/>
                                </div>
                            </div>
                            <div class="field">
                                <div class="picker twelve columns">
                                    <select name="province">
                                        <?php
                                        print("<option value='0'>Pilih Wilayah</option>");
                                        foreach ($provinces as $province)
                                        {
                                            print("<option value='{$province->id}'>{$province->name}</option>");
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="field">
                                <div class="picker twelve columns">
                                    <select name="dealer_id">
                                        <option selected disabled>Pilih Dealer</option>
                                    </select>
                                </div>
                                <div class="labelled twelve columns"></div>
                            </div>
                            <div class="field">
                                <div class="book-table-holder rows">
                                    <div class="six columns">
                                        <input type="text" class="input" name="select_month" placeholder="Tanggal">
                                    </div>
                                    <div class="six columns time_holder">
                                        <!--input type="text" class="input" name="select_hour" placeholder="Waktu"-->
                                    </div>
                                    <?php /*
                                        <!--div class="picker six columns">
                                            <select class="" name="select_month">
                                                <option value="" disable>&nbsp;</option>
                                                <?php foreach($select_month as $key => $month) { ?>
                                                <option value="<?php echo $month;?>"><?php echo $key;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="picker six columns">
                                            <select class="" name="select_date">
                                                <option value="" disable>&nbsp;</option>
                                                <?php foreach($select_month as $key => $month) { ?>
                                                <option value="<?php echo $month;?>"><?php echo $key;?></option>
                                                <?php } ?>
                                            </select>
                                        </div-->

                                        <!--div class="tabs">
                                            <ul class="tab-nav list-inline tabular">
                                                <?php
                                                $i=1;
                                                foreach ($months as $month => $keys) {?>
                                                    <li class="<?php echo ($i==1 ? 'active' : '');?>"><a href="#" rel="<?php echo $month;?>"><?php echo $month;?></a></li>
                                                <?php
                                                $i++;
                                                }
                                                ?>
                                            </ul>
                                            <div class="tabular-handler">
                                            <?php
                                                $i=1;
                                                foreach ($months as $month => $keys) {
                                                echo '<div class="tab-contents '.($i==1 ? 'active' : '').'" id="'.$month.'">';
                                                echo '<table class="book-table columns twelve">';
                                                    echo '<tr width="1%"><th>Date</th><th colspan="11" class="text-left">'.$month.'</th></tr>';
                                                    foreach($keys as $value => $values) {
                                                        list($d, $h) = explode('-', date('d-D-y',$value));
                                                        echo '<tr'.(($h == 'Sat' || $h == 'Sun') ? ' class="holiday"' : '').'><td class="content-td">'. date('d-D-y, M',$value) .'</td>';
                                                        foreach ($values as $val) {
                                                            echo '<td'.($val == '12:00' ? ' class="noon"' :'').'><a href="javascript:;" data-key="'.$value.'-'.(int) $val.'">'.$val.'</a></td>';
                                                        }
                                                        echo '</tr>';
                                                        $j++;
                                                    }
                                                    $i++;
                                                echo '</table>';
                                                echo '</div>';
                                                }
                                            ?>
                                            </div>
                                        </div-->
                                    */?>
                                </div>

                                <?php /*
                                <ul class="the-jadwal">
                                    <li>
                                        <ul>
                                            <li>&nbsp;</li>
                                            <?php
                                            $i=1;
                                            $j=1;
                                            foreach ($periods as $period) { ?>
                                                <li>
                                                    <span><?=$period->format('D');?></span>
                                                    <?=$period->format('d/m');?>
                                                    <?=$period->format('M');?>
                                                </li>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </li>
                                    <?php
                                    for($i=8;$i<18;$i++)
                                    {
                                        $time = (strlen($i)==1) ? '0'.$i.':00' : $i.':00';
                                        ?>
                                        <li>
                                            <ul>
                                                <li><?php //echo $k;?> <?=$time;?></li>
                                                <li>&nbsp;</li>
                                                <li>&nbsp;</li>
                                                <li>&nbsp;</li>
                                                <li>&nbsp;</li>
                                                <li>&nbsp;</li>
                                                <li>&nbsp;</li>
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                */?>
                            </div>
                            <div class="field">
                                <input type="hidden" name="time" value=""/>
                                <input type="hidden" name="date" value=""/>
                                <input type="submit" name="Submit" value="Daftar Sekarang" class="purple submit">
                            </div>
                        </div>
                    <?php echo form_close();?>
                    <hr class="thin grey">
                </div>
            </div>
        </div>
        <!-- close planner button -->
        <a class="remove-book"><i class="fa fa-times"></i></a>
    </div>
    <!--planner scrollarea -->
</div>
