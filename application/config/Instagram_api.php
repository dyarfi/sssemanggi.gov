<?php

/*
|--------------------------------------------------------------------------
| Instagram
|--------------------------------------------------------------------------
|
| Instagram client details
|
*/

$config['instagram_client_name']	= 'dyarfi.net';
$config['instagram_client_id']		= 'd262f393b96f47828333b0d7042915fb';
$config['instagram_client_secret']	= '0bcf9c10c493476786e4767383aa9aeb';
$config['instagram_callback_url']	= 'http://127.0.0.1/dentsu.digital.ml/';
$config['instagram_website']		= 'http://127.0.0.1/dentsu.digital.ml/';
$config['instagram_description']	= 'Test Drive';

/**
 * Instagram provides the following scope permissions which can be combined as likes+comments
 * 
 * basic - to read any and all data related to a user (e.g. following/followed-by lists, photos, etc.) (granted by default)
 * comments - to create or delete comments on a user’s behalf
 * relationships - to follow and unfollow users on a user’s behalf
 * likes - to like and unlike items on a user’s behalf
 * 
 */
$config['instagram_scope'] = 'basic';

// There was issues with some servers not being able to retrieve the data through https
// If you have this problem set the following to FALSE 
// See https://github.com/ianckc/CodeIgniter-Instagram-Library/issues/5 for a discussion on this
$config['instagram_ssl_verify']		= TRUE;