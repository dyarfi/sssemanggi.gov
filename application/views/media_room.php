<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- action class for animating page content when header is active -->
<div class="action step-right">        
    <!-- img header -->
    <section class="page-header img-section dark" style="background-image:url(<?php echo base_url('assets/static/img');?>/media.jpg);">
        <div class="content-block black-tint">

            <div id="crumbs" class="abs">
                <div class="row large dark">
                    <div class="six columns">
                        <!-- page title/statement -->
                        <h6 class="sub-heading">
                            <a href="<?php echo base_url();?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            <a href="#">Media Room</a>
                        </h6>
                    </div>
                    <div class="six columns text-right">

                    </div>
                </div>
            </div>
            <!-- page statement -->
            <div class="row bigtoppadding">
                <div class="twelve columns text-center">
                    <h1 class="block-heading">MEDIA ROOM</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="grey stripe-bg">
        <!-- two third / left side -->
        <div class="two-third white">
            <div id="contact-page">
                <div class="content-block">
                    <div class="row">
                        <!-- page title / description -->
                        <h3 class="bold"></h3>
                        <?php echo $detail->text;?>
                        <hr class="thin grey">
                    </div>
                    <div class="row">                                
                        <?php echo form_open_multipart('',array('id'=>'form-register','class'=>'form-horizontal','name'=>'register','method'=>'POST'));?>
                        <!--form name="mediareg" method="Post" action="mediareg.php" onSubmit="return validate();"-->
                        <div class="eight columns">                                   
                            <div class="row">
                                <div class="field six columns">
                                    <label for="firstname">Nama Awal*</label>
                                    <input class="input" type="text" id="firstname" name="firstname" placeholder="" value="<?php echo $fields->firstname;?>">
                                    <?php echo $errors['firstname'];?>
                                </div>
                                <div class="field six columns">
                                    <label for="lastname">Nama Akhir*</label>
                                    <input class="input" type="text" id="lastname" name="lastname" placeholder="" value="<?php echo $fields->lastname;?>">
                                    <?php echo $errors['lastname'];?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="six columns">
                                    <div class="twelve columns">
                                        <label for="gender">Gender :</label>
                                        <ul>
                                            <li class="field">
                                                <div class="picker">
                                                    <select name="gender" id="gender" required>
                                                      <option value="Male">Male</option>
                                                      <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </li>
                                        </ul>                                                
                                  <?php echo $errors['gender'];?>
                              </div>
                          </div>
                          <div class="field six columns">
                            <label for="birthdate">Tanggal Lahir*</label>
                            <input class="input" type="text" id="birthdate" name="birthdate" placeholder="dd/mm/yyyy" value="<?php echo $fields->birthdate;?>">
                            <?php echo $errors['birthdate'];?>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="field six columns">
                            <label for="email">Email*</label>
                            <input class="input" type="email" id="email" name="email" placeholder="email@email" value="<?php echo $fields->email;?>">
                            <?php echo $errors['email'];?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="field six columns">
                            <label for="password">Password*</label>
                            <input class="input" type="password" id="password" name="password" placeholder="" value="<?php echo $fields->password;?>">
                            <?php echo $errors['password'];?>
                        </div>
                        <div class="field six columns">
                            <label for="password2">Konfirmasi Password*</label>
                            <input class="input" type="password" id="password2" name="password2" placeholder="" value="<?php echo $fields->password2;?>">
                            <?php echo $errors['password2'];?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="field six columns">
                            <label for="phone">No.Telp*</label>
                            <input class="input" type="text" id="phone" name="phone" placeholder="" value="<?php echo $fields->phone;?>">
                            <?php echo $errors['phone'];?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="field twelve columns">
                            <label for="address">Alamat Lengkap*</label>
                            <textarea class="input textarea" type="text" id="address" name="address" placeholder="" rows="4"><?php echo $fields->address;?></textarea>
                            <?php echo $errors['address'];?>
                        </div>
                    </div>
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
                    <div class="row">
                        <div class="twelve columns field">
                            <label for="captcha"><?php echo lang('captcha');?> * :</label>
                            <div class="twelve">
                                <input type="text" name="captcha" id="captcha" class="input eight columns" value="<?php echo $fields->captcha;?>">
                                <a class="reload_captcha four columns" rel="<?php echo base_url('xhr/reload_captcha')?>" href="javascript:;"><?php echo $captcha['image'];?></a>                                            
                            </div>
                        </div> 
                        <?php echo $errors['captcha'];?>   
                    </div>
                    <div class="row midtoppadding">
                        <input class="purple small submit" type="reset" name="Reset" value="RESET">&nbsp;&nbsp;<input class="purple small submit" type="submit" name="Submit" value="KIRIM">
                    </div>                  
                </div>
                <!--/form-->
                <?php echo form_close(); ?>
                <div class="twelve columns">
                    <div class="email-msg" class="warning light"></div>
                </div> 
            </div>
        </div>
    </div>
</div>
<!-- one third sidebar -->
<aside class="one-third grey">
    <div id="sidebar">
        <!-- contact widget -->
        <img src="<?php echo base_url('assets/static/img');?>/Suzuki-Way-of-Life-logo.jpg" style="margin-bottom:30px;"/>
        <div class="widget">
            <h5 class="stripe-heading">MEDIA ROOM LOGIN</h5>
            <div class="widget-content">
                <p class="contact-info">
                    Jika Anda sudah memiliki e-mail dan password,<br>
                    Anda bisa masuk sekarang ke Suzuki Media Room<br>
                </p>
                <!--a href="#?custom=true&width=260&height=280" rel="prettyPhotoLogin" class="purple fill-button">LOGIN DISINI</a-->
                <!--a href="#login_popup" rel="prettyPhotoLogin" class="purple fill-button">LOGIN DISINI</a-->
                <!--a href="javascript:;" class="purple fill-button box-login">LOGIN DISINI</a-->
                <div id="login_popup">
                    <?php echo form_open_multipart(base_url('media-room/login'),['id'=>'form_login','method'=>'POST','rel'=>base_url($this->uri->uri_string())]);?>
                        <div class="field twelve"><input type="email" class="input" name="email_login" value="" placeholder="Email" size="20" maxlength="40">
                            <span class="warning light"><?php echo $errors['email_login'];?></span>
                        </div>
                        <div class="field twelve"><input type="password" class="input" name="password_login" value="" placeholder="Password" size="20" maxlength="40">
                            <span class="warning light"><?php echo $errors['password_login'];?></span>
                        </div>
                        <div class="field">
                            <input type="submit" value="LOGIN" class="purple small submit box-login">                            
                        </div>
                        <span class="warning light note"></span>
                    <?php echo form_close();?>
                </div>
                </div>                        
            </div>
        </div>
    </aside>
    <!-- clear floats -->
    <div class="clear">
    </div>
</section>            
</div><!-- action -->