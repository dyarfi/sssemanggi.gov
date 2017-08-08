<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php if ($logged_in === false) { ?>
<div class="pop-up pop-login" style="display: none;">
    <a href="#" class="pop-close"><i class="fa fa-times"></i></a>
    <div class="tit-pop">Login Member Suzuki</div>
    <?php echo form_open_multipart(base_url('services/auth/signin.json'),['id'=>'signin-form','method'=>'POST']);?>
    <ul class="the-form for-login">
        <li class="mob-land-duo">
            <input type="text" name="username_signin" placeholder="Username" />
        </li>
        <li class="mob-land-duo">
            <input type="password" name="password_signin" placeholder="Password" />
        </li>
        <li><a href="#" class="lupis-pass ke-pass">Lupa Password?</a></li>
        <li class="but-cus-log">
            <input type="hidden" value="<?=base_url($this->uri->uri_string());?>" name="referer"/>
            <button type="submit">Log in</button>
        </li>
        <!--li class="the-atau but-cus-log">atau</li>
        <li class="but-cus-log"><button class="style-2">Sign Up</button></li-->
    </ul>
    <?php echo form_close();?>
    <div class="for-pass" style="display: none;">
        <?php echo form_open_multipart(base_url('services/auth/forgot.json'),['id'=>'forpass-form','method'=>'POST']);?>
        <ul class="the-form">
            <li>
                <input type="text" name="email-forgot-password" placeholder="Email" />
            </li>
            <li><a href="#" class="lupis-pass ke-login">Kembali ke Log In</a></li>
            <li>
                <button type="submit" name="forgot-button">Kirim</button>
            </li>
        </ul>
        <?php echo form_close();?>
    </div>
</div>
<div class="pop-up pop-regis" style="display: none;">
    <div class="row">
        <a href="#" class="pop-close"><i class="fa fa-times"></i></a>
        <div class="tit-pop">Daftar Member Suzuki</div>
        <?php echo form_open_multipart(base_url('services/auth/signup.json'),['id'=>'signup-form']);?>
        <ul class="the-form">
            <li>
                <input type="text" name="email" placeholder="Email" />
            </li>
            <li>
                <input type="text" name="username" placeholder="Username" />
            </li>
            <li>
                <input type="password" name="password" placeholder="Password" />
            </li>
            <li>
                <input type="password" name="repassword" placeholder="Confirm Password" />
            </li>
            <li>
                <input type="text" name="fullname" placeholder="Nama Lengkap" />
            </li>
            <li class="picker column">
                <select name="gender">
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select>
            </li>
            <li>
                <input type="text" name="birthdate" id="birthdate" placeholder="Tanggal Lahir (dd/mm/yyyy)" />
            </li>
            <li>
                <input type="text" name="phonenumber" placeholder="Nomor Telepon" />
            </li>
            <li>
                <button type="submit">Sign Up</button>
            </li>
        </ul>
        <?php echo form_close();?>
    </div>    
</div>
<?php } ?>