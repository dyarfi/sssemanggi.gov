<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
  *  Email Config Variables
  *
  *  These come directly from the documentation of Code Igniter 1.7.2 website.
  *  http://ellislab.com/codeigniter/user-guide/libraries/email.html
  *
  *  
  */                       
//$config['useragent']        = 'CodeIgniter';
$config['useragent']        = ' PHP/' . phpversion();
$config['protocol']         = 'sendmail';
$config['mailpath']         = '/usr/sbin/sendmail';
$config['smtp_host']        = '';
$config['smtp_user']        = '';
$config['smtp_pass']        = '';
$config['smtp_port']        = 25;
$config['smtp_timeout']     = 10;
$config['wordwrap']         = FALSE; // TRUE
$config['wrapchars']        = 5000; // 76
$config['mailtype']         = 'html';
$config['charset']          = 'utf-8';
$config['validate']         = FALSE;
$config['priority']         = 1;
$config['crlf']             = "\r\n";
$config['newline']          = "\r\n";
$config['bcc_batch_mode']   = FALSE;
$config['bcc_batch_size']   = 200;

/* End of file email.php */
/* Location: ./system/application/config/email.php */ 