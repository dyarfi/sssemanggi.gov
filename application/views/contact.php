<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- action class for animating page content when header is active -->
<div class="action step-right">

    <!-- img header -->
    <section class="page-header img-section dark" style="background-image:url(<?php echo base_url('assets/static/img');?>/contact.jpg);">
        <div class="content-block black-tint">

            <div id="crumbs" class="abs">
                <div class="row large dark">
                    <div class="six columns">
                        <!-- page title/statement -->
                        <h6 class="sub-heading">
                            <a href="<?php echo base_url();?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            <a href="#">Hubungi Kami</a>
                        </h6>
                    </div>
                    <div class="six columns text-right">

                    </div>
                </div>
            </div>
            <!-- page statement -->
            <div class="row bigtoppadding">
                <div class="twelve columns text-center">
                    <h1 class="block-heading"><?php echo $this->Settings->getByParameter('contactus_phone')->value;?></h1>
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
                        <h4>Lengkapi Form dibawah ini</h4>
                        <hr class="thin grey">
                    </div>
                    <div class="row">                                
                        <!--form name="contactform" method="Post" action="contactform.php" onSubmit="return validate();"-->
                        <?php echo form_open_multipart('',array('id'=>'form-contact','class'=>'form-horizontal','name'=>'contact','method'=>'POST'));?>
                        <div class="eight columns">
                            <div class="row">
                                <ul>
                                    <li class="row">
                                        <label for="subject_to">Hubungi :</label>
                                        <div class="twelve columns picker">
                                            <select name="subject_to" id="subject_to">                                                
                                                <option value="" selected>Pilih Divisi</option>
                                                <?php foreach($contact_emails as $list) { ?>
                                                <option value="<?php echo $this->encrypt->encode($list->value);?>"><?php echo str_replace('Email ', '', $list->alias);?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <?php echo $errors['subject_to'];?>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="twelve columns field">
                                            <label for="name">Nama : </label><input id="name" class="input" type="edit" name="name" value="<?php echo $fields->name;?>" size="20">
                                            <?php echo $errors['name'];?>
                                        </div>
                                    </li>
                                    <li class="row">                                                
                                        <label for="gender">Gender * : </label><input id="gender" type="radio" name="gender" value="Male" checked>Male <input type="radio" name="gender" value="Female">Female
                                        <?php echo $errors['gender'];?>
                                    </li>
                                    <li class="row">
                                        <div class="twelve columns field"><br>
                                            <label for="phone">No.Telp * : </label>
                                            <span class="text-small">*Isi dengan no handphone (exp:08xxxxxxx) atau no telp rumah disertai dengan kode area (exp: 02xx-xxxxxxxx)</span>
                                            <input id="phone" class="input" type="text" name="phone" value="<?php echo $fields->phone;?>" size="20">             
                                            <?php echo $errors['phone'];?>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="twelve columns field">
                                            <label for="email">Email * : </label>
                                            <span class="text-small">*Mohon isi dengan email aktif</span>
                                            <input id="email" class="input" type="text" name="email" value="<?php echo $fields->email;?>" size="20">             
                                            <?php echo $errors['email'];?>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="twelve columns field">                                                
                                            <label for="fax">Fax : </label><input id="fax" class="input" type="text" name="fax" value="<?php echo $fields->fax;?>" size="20">
                                            <?php echo $errors['fax'];?>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="twelve columns field">                                                
                                            <label for="address">Alamat : </label><textarea id="address" class="input textarea"  name="address" cols="30" rows="4"><?php echo $fields->address;?></textarea>                                                
                                            <?php echo $errors['address'];?>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="twelve columns field">                                                
                                            <label for="subject">Subjek * : </label><input id="subject" class="input" type="text" name="subject" value="<?php echo $fields->subject;?>" size="20">                                                
                                            <?php echo $errors['subject'];?>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="twelve columns field">
                                            <label for="message">Pesan * : </label><textarea id="message" class="input textarea" name="message" cols="30" rows="4"><?php echo $fields->message;?></textarea>                                                
                                            <?php echo $errors['message'];?>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="twelve columns field">
                                            <label for="captcha"><?php echo lang('captcha');?> * :</label>
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
                                        <input class="purple small submit" type="reset" name="Reset" value="RESET">&nbsp;&nbsp;<input class="purple small submit" type="submit" name="Submit" value="KIRIM">
                                    </li>
                                </ul>
                            </div>                      
                        </div>
                        <?php echo form_close();?>
                        <div id="email-msg">
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
                <?php foreach ($contact_list as $contact) { ?>
                    <div class="widget">
                        <h5 class="stripe-heading"><?php echo $contact->subject;?></h5>
                        <div class="widget-content">
                            <p class="contact-info">
                                <?php echo $contact->location;?>
                                <br>
                                <?php if ($contact->phone) { ?>
                                    <i class="fa fa-phone"></i><?php echo $contact->phone;?><br>
                                    <?php } ?>
                                    <?php if ($contact->zipcode) { ?>
                                        <i class="fa fa-map-marker"></i><?php echo $contact->zipcode;?><br>
                                        <?php } ?>                                
                                    </p>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </aside>
                    <!-- clear floats -->
                    <div class="clear">
                    </div>
                </section>

        </div><!-- action -->