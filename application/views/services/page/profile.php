<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//print_r($this->member->vehicle);?>
<!-- action class for animating page content when header is active -->
<div class="action step-right">    
    <!-- page content -->
    <!-- img header -->   
    <section class="header-halo" style="background: url(<?php echo base_url('assets/public/images/profile_bg.jpg');?>) center center no-repeat; background-size: cover;">
        <div class="black-tint has-button">
            <div id="crumbs" class="abs">
                <div class="eight columns">
                    <h6 class="sub-heading">
                    <a href="<?php echo base_url('services');?>">Home</a>
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    <a href="<?php echo base_url('services/profile');?>">Profile</a>
                </h6>
            </div>
        </div>
        Hi, <?php echo $this->member->fullname;?>
        <!--span class="sub-lite">Booking service Suzuki</span-->
    </div>
    </section>
    <section class="grey stripe-bg">
        <!-- two third /left side-->
        <div class="two-third white">
            <div id="single-page" class="page">   
                <div class="columns">
                    <div class="row">
                        <div class="twelve columns">
                            <div class="columns" style="margin-top:-60px">  
                                <div class="image photo">
                                    <input type="file" name="fileupload" id="fileupload">
                                    <div class="fileUpload-handler">
                                        <?php if (!empty($this->member->file_name)) { $img = base_url('uploads/users/'.$this->member->file_name);} else { $img = base_url('assets/public/images/profile.jpg'); } ?>
                                        <img src="<?php echo $img;?>" alt="" width="150">
                                    </div>
                                </div>                                
                            </div>
                            <div class="eight columns">
                                <h4><?php echo $this->member->fullname;?></h4>
                                <ul class="twelve columns">
                                    <li>Username</li>
                                    <li class=""><strong><?php echo $this->member->username;?></strong><!--a class="push_six" href="javascript:;">Ubah Password</a--></li>
                                </ul>                                    
                            </div>                                
                        </div>
                    </div>
                    <div class="ten columns">
                        <div class="row">                                
                            <!--form name="contactform" method="Post" action="contactform.php" onSubmit="return validate();"-->
                            <div class="eight columns">
                                <div class="row">
                                    <?php echo form_open_multipart(base_url('services/profile_update'),array('id'=>'form-profile','class'=>'form-horizontal','method'=>'POST'));?>
                                    <input type="hidden" name="id" value="<?php echo $this->member->id;?>">
                                    <input type="hidden" name="base64" value="">                                    
                                    <ul>
                                        <li class="row">
                                            <label class="three columns" for="subject_to">Email</label>
                                            <div class="nine columns">
                                                <strong><?php echo $this->member->email;?></strong>
                                            </div>
                                        </li>
                                        <li class="row">
                                            <label class="three columns" for="fullname">Nama Lengkap</label>
                                            <div class="nine columns field">                                            
                                                <input id="fullname" class="input" type="edit" name="fullname" value="<?php echo $this->member->fullname;?>" placeholder="<?php echo $this->member->fullname;?>" size="20">
                                                <?php echo $errors['fullname'];?>
                                            </div>
                                        </li>
                                        <li class="row">                                                
                                            <label class="three columns" for="gender">Gender</label>
                                            <div class="nine columns picker">
                                                <select name="gender">
                                                    <option value="1" <?php echo $this->member->gender == 1 ? 'selected' : '';?>>Male</option>
                                                    <option value="0" <?php echo $this->member->gender == 0 ? 'selected' : '';?>>Female</option>
                                                </select>                                                
                                            </div>                                            
                                            <?php echo $errors['gender'];?>
                                        </li>
                                        <li class="row">                                            
                                            <label class="three columns" for="birthdate">Tanggal Lahir</label>
                                            <div class="nine columns field">
                                                <input id="birthdate" class="input birthdate" type="text" name="birthdate" value="<?php echo date('d/m/Y', strtotime($this->member->birthdate));?>" size="20">
                                                <?php echo $errors['birthdate'];?>
                                            </div>
                                        </li>
                                        <li class="row">                                            
                                            <label class="three columns" for="phone_number">No.Telp</label>
                                            <div class="nine columns field">
                                                <span class="text-small">*Isi dengan no handphone (exp:08xxxxxxx) atau no telp rumah disertai dengan kode area (exp: 02xx-xxxxxxxx)</span>
                                                <input id="phone_number" class="input" type="text" name="phone_number" value="<?php echo $this->member->phone_number;?>" size="20">             
                                                <?php echo $errors['phone_number'];?>
                                            </div>                                            
                                        </li>                                        
                                        <li class="row">
                                            <label class="three columns" for="address">Alamat</label>
                                            <div class="nine columns field">                                                
                                                <textarea id="address" class="input textarea"  name="address" cols="30" rows="4"><?php echo $this->member->address;?></textarea>                                                
                                                <?php echo $errors['address'];?>
                                            </div>
                                            <hr class="thin grey"/>                                           
                                            <div class="twelve row field">
                                                <button class="purple small fill-button" type="submit" name="Submit" value="SIMPAN">SIMPAN <span class="fa fa-check"></span></button>
                                            </div>
                                        </li>                                       
                                        <!--li class="row">                                            
                                            <label class="three columns" for="captcha"><?php echo lang('captcha');?> * :</label>
                                            <div class="nine columns field">
                                                <div class="twelve">
                                                    <input type="text" name="captcha" class="input eight columns" id="captcha" value="<?php echo $fields->captcha;?>">
                                                    <a class="reload_captcha four columns" rel="<?php echo base_url('xhr/reload_captcha')?>" href="javascript:;"><?php echo $captcha['image'];?></a>
                                                </div>
                                                <div class="row">
                                                    <div class="twelve columns">
                                                        <?php echo $errors['captcha'];?>
                                                    </div>
                                                </div>
                                            </div>      
                                        </li>
                                        <li>
                                            <input class="purple small submit" type="submit" name="Submit" value="SIMPAN">
                                        </li-->
                                    </ul>
                                    <?php echo form_close();?>                                    
                                    <ul>
                                        <li class="field">
                                            <div class="eight columns">
                                                <h4>List Kendaraan</h4>
                                                <div id="clone-form-update">
                                                    <?php echo form_open_multipart(base_url('services/profile_vehicle_update'),array('id'=>'form-vehicle','class'=>'form-horizontal','name'=>'contact','method'=>'POST'));?>
                                                    <input type="hidden" name="service_member_id" value="<?php echo $this->member->id;?>">
                                                    <div class="prodinfo toclone">
                                                        <hr class="thin grey"/>
                                                        <?php                      
                                                            if (count($this->member->vehicle) > 0 && count($this->member->vehicle) < 2) {
                                                                foreach($this->member->vehicle as $vehicle) { ?>
                                                                <p><span>Jenis :<input type="text" class="input" name="vehicle_type" value="<?php echo trim($this->Products->get($vehicle->service_vehicle->vehicle_type)->subject);?>"/></span></p>
                                                                <p><span>No. VIN :<input type="text" class="input" name="vin_number" value="<?php echo trim($vehicle->service_vehicle->vin_number);?>"/></span></p>
                                                                <p><span>No. POL :<input type="text" class="input" name="plate_number" value="<?php echo trim($vehicle->service_vehicle->plate_number);?>"/></span></p>                           
                                                                <p><span>Nama di STNK :<input type="text" class="input" name="registered_name" value="<?php echo trim($vehicle->service_vehicle->registered_name);?>"/></span><hr class="thin grey"/></p>
                                                                <?php
                                                                }
                                                            } else { ?>
                                                                <!--li><span>Jenis :<input type="text" class="input" name="vehicle_type" value=""/></span></li-->
                                                                <div class="field">
                                                                    <?php //print_r(array_pop($this->member->vehicle)); exit;?>
                                                                    <div class="picker twelve columns">
                                                                        <select name="vehicle_type">
                                                                            <option readonly value="">Pilih Kendaraan</option>
                                                                            <?php foreach ($products as $product) { ?>
                                                                            <option value="<?php echo $product->id;?>"><?php echo $product->subject;?></option>
                                                                            <?php } ?>
                                                                        </select>                                                        
                                                                    </div>
                                                                </div>
                                                                <div><span>No. VIN :<input type="text" class="input" name="vin_number" value=""/></span></div>
                                                                <div><span>No. POL :<input type="text" class="input" name="plate_number" value=""/></span></div>                           
                                                                <div>
                                                                    <span>Nama di STNK :<input type="text" class="input" name="registered_name" value=""/></span>
                                                                    <hr class="thin grey"/>
                                                                    <button type="submit" class="purple small fill-button button-add" name="submit" value="simpan">Simpan <i class="icon-check"></i></button>
                                                                </div>
                                                            <?php
                                                            } 
                                                        ?>    
                                                        <?php if (count($this->member->vehicle) > 0 && count($this->member->vehicle) < 2) { ?>
                                                            <a href="javascript:;" class="purple fill-button clone"/>Tambah Kendaraan <span class="fa fa-plus" aria-hidden="true"></span></a>
                                                        <?php } ?>
                                                    </div>
                                                    <?php echo form_close();?>
                                                </div>
                                                <!--hr class="thin grey"/-->
                                                <?php /*if (count($this->member->vehicle) > 0) { ?>
                                                <div>
                                                    <button type="submit" class="purple small fill-button button-add" name="submit" value="simpan">Simpan <i class="icon-check"></i></button>
                                                </div>
                                                <?php } */ ?>
                                            </div>
                                        </li>
                                    </ul>                                   
                                    <br/><br/>
                                </div>                      
                            </div>
                            <div id="email-msg">
                            </div>
                            <div class="row">
                                <br/><br/><br/><br/><br/><br/>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <!-- sidebar -->
        <aside class="one-third grey">
        <div id="sidebar">
            <!-- category widget -->
            <div class="widget">
                <h5 class="stripe-heading">Hi, <?php echo word_limiter($this->member->fullname,2,'');?></h5>
                <div class="widget-content">
                    <ul class="categories">
                        <li><a href="<?php echo base_url('services/profile');?>">Profile</a></li>
                        <li><a href="javascript:;">Inbox</a></li>
                        <li><a href="<?php echo base_url('services/profile/blog');?>">Blog</a></li>
                        <li><a href="<?php echo base_url('services/profile/booking');?>">List Booking</a></li>
                    </ul>
                </div>
            </div>            
        </div>
        </aside>
        <!-- clear floats -->
        <div class="clear"></div>
    </section>
</div>