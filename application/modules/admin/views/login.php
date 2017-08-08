<!-- BEGIN LOGIN FORM -->
<?php echo form_open(base_url('admin/authenticate/login'),['class'=>'login-form']);?>
    <h3 class="form-title">Login to your account</h3>
    <div class="alert alert-danger display-hide">
	<button class="close" data-close="alert"></button>
	<span>Enter any username and password.</span>
    </div>
    <div class="form-group">
	<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
	<?php echo form_error('username','', ''); ?>
	<label class="control-label visible-ie8 visible-ie9">Username</label>
	<div class="input-icon">
	    <i class="fa fa-user"></i>
	    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
	</div>
    </div>
    <div class="form-group">
	<?php echo form_error('password','', ''); ?>
	<label class="control-label visible-ie8 visible-ie9">Password</label>
	<div class="input-icon">
	    <i class="fa fa-lock"></i>
	    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
	</div>
    </div>
    <div class="form-group form-inline">
    <?php echo form_error('captcha','', ''); ?>
    <label class="control-label visible-ie8 visible-ie9">Captcha</label>
    <a class="reload_captcha input-small pull-left" rel="<?php echo base_url('xhr/reload_captcha')?>" href="javascript:;"><?php echo $captcha['image'];?></a>
    <div class="input-icon pull-right">
        <i class="fa fa-lock"></i>
        <input class="form-control placeholder-no-fix input-small" type="text" autocomplete="off" placeholder="Captcha" name="captcha"/>
    </div>
    </div>
    <div class="form-actions">
	<label class="">
	<!-- <input type="checkbox" name="remember" value="1"/> Remember me </label> -->
	<button type="submit" class="btn blue pull-right">
	Login <i class="m-icon-swapright m-icon-white"></i>
	</button>
    </div>
    <div class="forget-password hide">
	<h4>Forgot your password ?</h4>
	<p>Click <a href="javascript:;" id="forget-password">here</a> to reset your password.</p>
    </div>
<?php echo form_close();?>
<!-- END LOGIN FORM -->
<!-- BEGIN FORGOT PASSWORD FORM -->
<?php echo form_open('',['class'=>'forget-form']);?>
    <h3>Forget Password ?</h3>
    <p>Enter your e-mail address below to reset your password.</p>
    <div class="form-group">
	<div class="input-icon">
	    <i class="fa fa-envelope"></i>
	    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
	</div>
    </div>
    <!-- AJAX RESULT -->
    <p class="msg"></p>
    <div class="form-actions">
	<button type="button" id="back-btn" class="btn">
	<i class="m-icon-swapleft"></i> Back </button>
	<button type="submit" class="btn blue pull-right">
	Submit <i class="m-icon-swapright m-icon-white"></i>
	</button>
    </div>
<?php echo form_close();?>
<!-- END FORGOT PASSWORD FORM -->
