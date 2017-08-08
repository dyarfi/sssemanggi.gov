<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); // print_r($dealer_config);?>
<!-- action class for animating page content when header is active -->
<div class="action step-right">        
    <!-- img header -->
    <section class="page-header img-section dark" style="background-image:url(<?php echo base_url('assets/public/images/dealer/');?>/reception.jpg);">
        <div class="content-block black-tint">
            <div id="crumbs" class="abs">
                <div class="row large dark">
                    <div class="six columns">
                        <!-- page title/statement -->
                        <h6 class="sub-heading">
                            <a href="<?php echo base_url('services');?>">Home</a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            <a href="#">Dealer Dashboard</a>
                        </h6>
                    </div>
                    <div class="six columns text-right">

                    </div>
                </div>
            </div>
            <!-- page statement -->
            <div class="row bigtoppadding">
                <div class="twelve columns text-center">
                    <!--div class="columns">
                        <div class="image photo dealer-image">
                            <input type="file" name="fileupload" id="fileupload">
                            <div class="fileUpload-handler">
                                <?php if (!empty($this->member->file_name)) { $img = base_url('uploads/users/'.$this->member->file_name);} else { $img = base_url('assets/public/images/profile.jpg'); } ?>
                                <img src="<?php echo $img;?>" alt="" width="150">
                            </div>
                        </div>                                
                    </div-->
                    <h1 class="block-heading">SUZUKI<br/><h4>DEALER DASHBOARD</h4></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="grey stripe-bg">
        <!-- two third / left side -->
        <div class="two-third white">            
            <!--h4 class="twelve row stripe-bg thin">Dealer News</h4-->
                <div id="contact-page">
                    <!--ul class="grid alt-posts" id="posts">
                        <?php foreach ($rows as $row) { ?>           
                            <li class="post">
                                <?php if ($row->media) { ?> 
                                <div class="post-img">
                                    <img src="<?php echo base_url('uploads/news/'.$row->media);?>" alt="post-img-anthem" />
                                </div>
                                <?php } ?>
                                <div class="post-info">
                                        <a href="<?php echo base_url('news/'.$row->url);?>" title="Read Post"><h4 class="grid-title"><?php echo $row->subject;?></h4></a>
                                    <div class="post-meta">
                                        <span> <span><a href="<?php echo base_url('news/'.$row->url);?>"><?php echo date('M d, Y',strtotime($row->publish_date));?></a></span> by <?php echo $row->dealer->name;?></span>
                                    </div>
                                    <div class="post-content">
                                        <p class="intro">
                                            <?php echo word_limiter(strip_tags($row->text),30);?>
                                        </p>
                                        <a href="<?php echo base_url('news/'.$row->url);?>" class="icon-button">Selengkapnya<i class="fa fa-chevron-right"></i></a>
                                    </div>
                                </div>                                
                            </li>                   
                        <?php } ?>                                                
                    </ul-->
                    <div class="grid alt-posts"> 
                        <div class="widget">                
                        <?php if(!$this->member) {?>
                        <!--div class="row">
                            <h5 class="stripe-heading">DEALER LOGIN</h5>
                            <div class="widget-content">
                                <p class="contact-info">
                                    Jika Anda sudah memiliki e-mail dan password,<br>
                                    Anda bisa masuk sekarang ke Dealer Page<br>
                                </p>
                                <div id="login_popup">
                                    <?php echo form_open_multipart(base_url('dealer/login'),['id'=>'form_login','method'=>'POST','rel'=>base_url($this->uri->uri_string())]);?>
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
                        </div-->       
                        <?php } else { ?>
                        <div class="row">
                            <h5 class="stripe-heading">DEALER DASHBOARD</h5>
                            <div class="widget-content tab-boxed">
                                <p class="contact-info">
                                    Hi, <strong><?php echo $dealer->name;?></strong> ini adalah halaman Dashboard anda. <a class="underline" href="<?php echo base_url('dealer/logout');?>"><strong> [LOGOUT]</strong></a>
                                    <hr class="thin grey"/>
                                </p>
                                <section class="tabs">
                                    <ul class="tab-nav per-serv-prod">
                                        <li><a href="#">Notifikasi</a></li>
                                        <li><a href="#">Pengaturan</a></li>
                                        <li><a href="#">Blog</a></li>
                                        <li class="active"><a href="#">Booking</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="push_notification" id="<?php echo $dealer->id;?>">
                                            <ul class="row">
                                                <?php foreach ($notifications as $notification) {?>
                                                <li><span class="fa fa-check" aria-hidden="true"></span> <?php echo $notification->text;?></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <?php /*if ($notifications) { ?>
                                        <div class="push_notification" id="<?php echo $this->member->email;?>">
                                            <ul class="row">
                                                <?php foreach ($notifications as $notification) {?>
                                                <li><span class="fa fa-check" aria-hidden="true"></span> <?php echo $notification->text;?></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <?php } else { ?>
                                        <ul class="row">
                                            <li>Belum ada notifikasi<br/><br/><br/><br/></li>
                                        </ul>
                                        <?php } */ ?>
                                    </div>
                                    <div class="tab-content">
                                        <h5>Dealer Setting</h5>
                                        <hr class="thin grey"/>
                                        <?php 
                                            if (!$this->member->email) { 
                                        ?>
                                        <div class="row">
                                            <div class="six columns">
                                                <?php echo form_open('xhr/dealer_primary_email',['id'=>'form-config-dealer-email']);?>
                                                <input type="hidden" name="member_id" value="<?php echo $this->encrypt->encode($this->member->id);?>">
                                                <ul class="row">
                                                    <li class="eleven columns">
                                                        <h5>Primary Email</h5>
                                                        <div class="field">                                                            
                                                            <label for="dealer_email_contact">Email Contact
                                                                <input class="input" type="text" value="<?php echo $this->member->email;?>" name="dealer_primary_email" />                                                            
                                                            </label>
                                                            <small class="warning label">* Masukkan email utama anda untuk melanjutkan</small>
                                                        </div>
                                                        <button type="submit" name="submit" class="purple small fill-button">Simpan <span class="fa fa-check" aria-hidden="true"></span></button>
                                                        <span class="warning dealer_primary_email"></span>
                                                    </li>
                                                </ul>                                                
                                                <?php echo form_close();?>
                                            </div>
                                            <div class="six columns">
                                                <span class="warning light">
                                                * Anda telah login pertama kali ke Dashboard Dealer. Untuk melanjutkan ke pengaturan Dealer yang lain nya, mohon isi terlebih dahulu Email utama anda.
                                                <span>
                                            </div>
                                        </div>                                        
                                        <?php } else { 
                                                $password_change = false;
                                                if ($this->member->password == sha1('suzukiservice281116')) {
                                                ?>
                                                <div class="row">
                                                    <div class="six columns">
                                                        <?php echo form_open('xhr/dealer_password',['id'=>'form-config-dealer-password']);?>
                                                        <input type="hidden" name="member_id" value="<?php echo $this->encrypt->encode($this->member->id);?>">
                                                        <ul class="row">
                                                            <li class="field">
                                                                <h5>Change Password</h5>
                                                                <label for="password">Password
                                                                    <input class="input" type="password" value="" name="password" />
                                                                </label>                                                        
                                                                <label for="password1">Retype Password
                                                                    <input class="input" type="password" value="" name="password1" />
                                                                </label>
                                                                <button type="submit" name="submit" class="purple small fill-button">Simpan <span class="fa fa-check" aria-hidden="true"></span></button>
                                                                <span class="warning password"></span>
                                                                <span class="warning password1"></span>
                                                            </li>
                                                        </ul>
                                                        <?php echo form_close();?>
                                                    </div>
                                                    <div class="six columns">
                                                        <span class="warning light">
                                                        * Mohon ganti password anda untuk melanjutkan pengaturan Dealer yang lain nya.
                                                        <span>
                                                    </div>
                                                </div>    
                                                <?php } else { 
                                                    $password_change = true;
                                                ?>
                                                <div class="row">
                                                    <div class="six columns">
                                                        <?php echo form_open('xhr/config_dealer',['id'=>'form-config-dealer']);?>
                                                        <input type="hidden" name="member_id" value="<?php echo $this->encrypt->encode($this->member->id);?>">
                                                        <ul class="row">
                                                            <li class="field">       
                                                            <h5>Configuration</h5>                                         
                                                            <?php 
                                                            if (!$this->member->attribute) {
                                                                    $attribute = [                                                                    
                                                                        'setting_zero' =>[
                                                                            'label' =>'Buka Sabtu',
                                                                            'type'  => 'boolean',
                                                                            'value' => 1
                                                                        ],
                                                                        'setting_one' =>[
                                                                            'label' =>'Buka Minggu',
                                                                            'type'  => 'boolean',
                                                                            'value' => 1
                                                                        ],
                                                                        'setting_two' =>[
                                                                            'label' =>'Dealer Sedang Tutup',
                                                                            'type'  => 'boolean',                                                        
                                                                            'value' => 0
                                                                        ],
                                                                        'setting_three' =>[
                                                                            'label' =>'Limit booking / jm',
                                                                            'type'  => 'text',
                                                                            'value' => 0
                                                                        ],
                                                                        'setting_four' =>[
                                                                            'label' =>'Jam Buka',
                                                                            'type'  => 'text',
                                                                            'default' => 6,
                                                                            'value' => 6
                                                                        ],
                                                                        'setting_five' =>[
                                                                            'label' =>'Jam Tutup',
                                                                            'type'  => 'text',
                                                                            'default' => 24,                    
                                                                            'value' => 24
                                                                        ]
                                                                    ];
                                                                } else {
                                                                    $attribute = json_decode($this->member->attribute, 1);
                                                                }
                                                                foreach ($attribute as $key => $val) { 
                                                                    if ($val['type'] == 'boolean') { ?>
                                                                    <div class="row">
                                                                        <label class="checkbox">
                                                                            <div class="five columns">
                                                                                <?php echo $val['label'];?>
                                                                            </div>
                                                                            <div class="three columns">
                                                                            <input type="checkbox" value="1" name="<?php echo $key;?>" <?php echo $val['value'] == 1 ? 'checked':'';?> />
                                                                            <span></span>
                                                                            </div>
                                                                        </label>
                                                                    </div>    
                                                                    <?php } else if ($val['type'] == 'text') {?>
                                                                    <div class="row">                                                                    
                                                                        <label>
                                                                            <div class="five columns">
                                                                            <?php echo $val['label'];?>
                                                                            </div>
                                                                            <div class="two columns">
                                                                                <input class="input" type="text" value="<?php echo $val['value'] == 0 ? '5' : $val['value'];?>" name="<?php echo $key;?>" />
                                                                            </div>
                                                                        </label>     
                                                                    </div>    
                                                                <?php } 
                                                                }
                                                                ?>
                                                            </li>
                                                        </ul>
                                                        <button type="submit" name="submit" class="purple small fill-button">Simpan <span class="fa fa-check" aria-hidden="true"></span></button>
                                                        <?php echo form_close();?>
                                                        <?php if ($password_change) { ?>
                                                        <a href="javascript:;" class="btn-form-cp">Ganti Password</a>
                                                        <div class="row white form-change-password" style="display:none">
                                                            <div class="twelve columns">
                                                                <?php echo form_open('xhr/dealer_password',['id'=>'form-config-dealer-password']);?>
                                                                <input type="hidden" name="member_id" value="<?php echo $this->encrypt->encode($this->member->id);?>">
                                                                <ul class="row">
                                                                    <li class="field">
                                                                        <hr class="thin grey"/>
                                                                        <label for="password">Password
                                                                            <input class="input" type="password" value="" name="password" />
                                                                        </label>                                                        
                                                                        <label for="password1">Retype Password
                                                                            <input class="input" type="password" value="" name="password1" />
                                                                        </label>
                                                                        <button type="submit" name="submit" class="purple small fill-button">Simpan <span class="fa fa-check" aria-hidden="true"></span></button>
                                                                        <span class="warning password"></span>
                                                                        <span class="warning password1"></span>
                                                                    </li>
                                                                </ul>
                                                                <?php echo form_close();?>                                                                
                                                            </div>                                                        
                                                        </div>    
                                                        <?php } ?>
                                                    </div>
                                                    <div class="six columns">
                                                        <?php echo form_open('xhr/config_email_dealer',['id'=>'form-email-dealer']);?>
                                                        <input type="hidden" name="dealer_id" value="<?php echo $this->encrypt->encode($dealer->id);?>">
                                                        <ul>
                                                            <li class="field">
                                                                <label for="dealer_email_contact"><h5>Email Contact</h5></label>
                                                                <textarea rows="4" name="dealer_email_contact" id="dealer_email_contact" class="input textarea"><?php echo str_replace('\n\r', "\n", $dealer->email);?></textarea> 
                                                                <small>* ketik enter untuk menambahkan email</small>
                                                            </li>
                                                        </ul>
                                                        <button type="submit" name="submit" class="purple small fill-button">Simpan <span class="fa fa-check" aria-hidden="true"></span></button>
                                                        <?php echo form_close();?>
                                                    </div>                                                    
                                                </div>    
                                        <?php   } 
                                        } ?>
                                    </div>
                                    <div class="tab-content">
                                        <div class="twelve columns">
                                            <h5>Blog List</h5>
                                            <hr class="thin grey"/>
                                            <?php if ($dealer_blog) {?>
                                            <table class="row striped twelve">
                                                <thead>
                                                <tr>
                                                    <th>Subject</th>
                                                    <th>Tags</th>
                                                    <th>Publish Date</th>
                                                    <th>Text</th> 
                                                    <th>Status</th>
                                                    <th width="15%">Function</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($dealer_blog as $blog) { ?>                                
                                                    <tr>
                                                        <td><?php echo word_limiter($blog->subject,4); ?></td>
                                                        <td><?php echo ucfirst($blog->tags); ?></td>
                                                        <td><?php echo date('D, d-M-Y', strtotime($blog->publish_date)); ?></td>
                                                        <td><?php echo word_limiter(strip_tags($blog->text),5); ?></td>
                                                        <td><?php echo ($blog->status == 'unpublish') ? 'Not Approved' : '<strong>Approved</strong>'; ?></td>                                        
                                                        <td>
                                                            <?php if ($blog->status == 'publish') { ?>
                                                            <a href="#" class="blog-edit switch" rel="<?php echo $this->encrypt->encode($blog->id);?>" gumby-trigger="#modal1"> 
                                                                <span class="purple small">
                                                                    Edit
                                                                </span>
                                                            </a>
                                                            &nbsp;
                                                            <a href="#" class="blog-unpublish" rel="<?php echo $this->encrypt->encode($blog->id);?>"> 
                                                                <span class="purple small">
                                                                    Cancel
                                                                </span>
                                                            </a> 
                                                            <?php } else { ?>
                                                            <span class="clearfix">Waiting Approval</span>
                                                            <a href="#" class="blog-edit switch" rel="<?php echo $this->encrypt->encode($blog->id);?>" gumby-trigger="#modal1"> 
                                                                <span class="purple small">
                                                                    Edit
                                                                </span>
                                                            </a>                                                            
                                                            <?php } ?>                                                
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <tbody>
                                            </table>
                                            <hr class="thin grey"/>                            
                                            <a href="#" class="blog-add purple small fill-button switch" gumby-trigger="#modal1">Tambah Blog <span class="fa fa-plus" aria-hidden="true"></span></a>
                                            <br/><br/>
                                            <?php } else { ?>
                                            <div class="twelve columns">
                                                <h5>Belum ada Blog</h5>
                                                <a href="#" class="blog-add purple small fill-button switch" gumby-trigger="#modal1">Tambah Blog <span class="fa fa-plus" aria-hidden="true"></span></a>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="tab-content active">
                                        <h5 id="booklist">Booking List</h5>
                                        <hr class="thin grey"/>
                                        <div class="twelve rows">
                                            <div class="eight columns">
                                                <?php echo form_open();?>
                                                <ul class="field row">
                                                    <li class="picker">
                                                        <select name="date_year">
                                                            <?php foreach ($years as $key) { ?>
                                                                <option value="<?php echo $key->format('Y');?>" <?php echo $key->format('Y') == $year_que ? 'selected' : '';?>><?php echo $key->format('Y');?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </li>
                                                    <li class="picker">
                                                        <select name="date_month">
                                                            <option disabled selected>MONTH</option>
                                                            <?php foreach ($months as $key => $month){?>
                                                            <option value="<?php echo $key;?>" <?php echo $key == $month_que ? 'selected="selected"' :'' ;?>><?php echo $key;?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </li>
                                                    <li class="picker">
                                                        <?php //echo $date_que;?>
                                                        <select name="date_select">
                                                            <option disabled selected>DATE</option>
                                                            <?php foreach ($months[$month_que] as $key => $date ) {?> 
                                                                <option value="<?php echo $date;?>" <?php echo ($date == $date_que) ? 'selected="selected"' :'';?>><?php echo $date;?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </li>
                                                </ul>
                                                <?php echo form_close();?>                                                
                                            </div>
                                            <div class="four columns">
                                                <div style="padding:10px 0 0 0" class="small">
                                                    <a target="_blank" href="<?php echo base_url('dealer/book_print/'.$date_que.'/'.$this->member->id.'/');?>"><span class="fa fa-print fa3x"></span> Print</a>
                                                    &nbsp;
                                                    <a href="<?php echo base_url('dealer/book_export/'.$date_que.'/'.$this->member->id.'/');?>"><span class="fa fa-file-excel-o fa3x"></span> Export</a>
                                                    &nbsp;
                                                    <a href="<?php echo base_url('dealer/book_export_all/'.$this->member->id.'/');?>"><span class="fa fa-file-excel-o fa3x"></span> Export All</a>                                                                                                                                                            
                                                </div>
                                            </div>
                                        </div>
                                        <?php if ($dealer_bookings) { ?>
                                        <table class="row ten booking-table-list">
                                          <thead>
                                            <tr>
                                              <th colspan="5">Customer Data</th>
                                              <th colspan="5">Booking Data</th>
                                            </tr>
                                            <tr>
                                              <th>Hour / Type</th>
                                              <th>ID Order</th>
                                              <th>Car</th>                                              
                                              <th>License</th>                                              
                                              <th>Name</th>
                                              <th>Phone</th>
                                              <th>Booked</th>
                                              <th>Package</th>
                                              <th>Status</th>
                                              <th width="12%">Function</th>
                                            </tr>                                            
                                          </thead>
                                          <tbody>
                                        <?php foreach ($dealer_bookings as $time => $books) { 
                                            $time = (strlen($time)==1) ? '0'.$time.':00' : $time.':00'; ?>
                                              <tr id="hour-<?php echo $time;?>"><td colspan="10" class="info-bg"><h4><?php echo $time;?></h4></td></tr>
                                              <?php foreach($books as $book) { 
                                                    if (!empty($book)) { ?>
                                                    <tr>
                                                        <td>
                                                            <span class="<?php echo $book->book_type ? 'primary' :'success';?> label"><?php echo $book->book_type ? 'ONLINE' :'OFFLINE';?></span>
                                                        </td>                                                        
                                                        <td><?php echo ($book->order_id) ? $book->order_id : '-';?></td>
                                                        <td>
                                                            <?php 
                                                                // Set vehicle model type
                                                                $vehicle_type = $this->ProductModels->get($book->vehicle_type);
                                                                if ($book->service_member_id != 0) {
                                                                    $vehicle = $this->Bookings->_getBookingVehicle($book->service_vehicle_id);
                                                                } else {
                                                                    $vehicle = $this->Products->get($book->service_vehicle_id);
                                                                }
                                                                echo $vehicle->subject .' | '.$vehicle_type->subject;
                                                            ?>
                                                        </td>
                                                        <td><?php echo $book->license_number;?></td>
                                                        <td><?php echo $book->name;?> </td>
                                                        <td><?php echo $book->phone;?></td>
                                                        <td><?php echo date('D, d-M-Y', $book->date); ?></td>
                                                        <td>
                                                            <?php
                                                            /* 
                                                                if ($book->service_member_id != 0) {
                                                                    $vehicle = $this->Bookings->_getBookingVehicle($book->service_vehicle_id);
                                                                } else {
                                                                    $vehicle = $this->Products->get($book->service_vehicle_id);
                                                                }
                                                                echo $vehicle->subject;
                                                            */
                                                                echo $book->service_type ? $service_type[$book->service_type] : $book->custom;
                                                            ?>
                                                        </td>
                                                        <td><?php echo ($book->approved == 0) ? '<span class="red-text">Wait Approval</span>' : '<span class="blue-text">Approved</span>';?></td>
                                                        <td>
                                                            <?php if($book->approved == 0) { ?>
                                                            <a href="javascript:;" class="change-book" rel="<?php echo $this->encrypt->encode($book->id);?>"><span class="blue-text">Approve</span></a> <?php }?> 
                                                            <?php if($book->approved == 1) { ?>
                                                            <a href="javascript:;" class="cancel-book" rel="<?php echo $this->encrypt->encode($book->id);?>">Cancel</a>
                                                            <?php } else { ?>
                                                            <a href="javascript:;" class="delete-book" rel="<?php echo $this->encrypt->encode($book->id);?>">Delete</a>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <?php } else { ?>                                                    
                                                    <tr>
                                                        <td><span class="warning label">EMPTY</span></td>
                                                        <td><?php echo '-';?></td>                                                        
                                                        <td><?php echo '-';?></td>                                                                                                                
                                                        <td><?php echo '-';?></td>
                                                        <td><?php echo '-';?> </td>
                                                        <td><?php echo '-';?></td>
                                                        <td><?php echo '-';?></td>
                                                        <td><?php echo '-';?></td>
                                                        <td><?php echo '-';?></td>
                                                        <td>
                                                            <?php 
                                                            if ($outofdate) { ?> 
                                                                <a href="javascript:;" class="add-book-dealer switch" gumby-trigger="#modal2" rel="<?php echo $this->encrypt->encode(strtotime($date_que).':'.(int) $time .':'.$dealer->id.':'.$this->member->id);?>">Add Booking</a>
                                                                <?php } else { ?>
                                                                <span class="red-text">Out of date</span>
                                                            <?php 
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>                                                        
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                            <tbody>
                                        </table>
                                        <?php } else { ?>
                                        <div class="twelve columns">
                                            <h5>Belum ada Booking</h5>
                                            <hr class="thin grey"/>
                                            <a href="#" class="purple small fill-button switch" gumby-trigger="#modal1">Tambah Booking <span class="fa fa-check" aria-hidden="true"></span></a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </section>
                                <hr class="thin grey"/>
                            </div>                                                
                        </div>    
                        <?php } ?>  
                        </div>                                      
                    </div>
                </div>
            </div>
        <!-- one third sidebar -->
        <aside class="one-third grey">
        <div id="sidebar">
            <!-- contact widget -->
            <img src="<?php echo base_url('assets/static/img');?>/Suzuki-Way-of-Life-logo.jpg" style="margin-bottom:30px;"/>
        </div>
        <div class="widget">
            <h5 class="stripe-heading">Dealer Promo</h5>
            <div class="row">
                <div class="widget-content">
                    <ul class="dealer-promo">
                        <?php foreach ($rows as $row) { ?>   
                        <li>
                            <a href="<?php echo base_url('news/'.$row->url);?>" class="grid-title"><?php echo $row->subject;?></a>
                            <span class="right"><?php echo date('M d, Y',strtotime($row->publish_date));?> <?php echo ($row->member->fullname) ? ' Oleh : '.$row->member->fullname:'';?></span>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        </aside>
        <!-- clear floats -->
        <div class="clear">
        </div>
    </section>            

<!-- booking modal -->
<?php $this->load->view('services/page/dealer/dealer_booking');?>
<!-- booking modal -->

</div><!-- action -->

<?php $this->load->view('services/page/blog'); ?>