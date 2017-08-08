<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2015, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

$config =
	array(
		// set on "base_url" the relative url that point to HybridAuth Endpoint
		'base_url' => '/hauth/endpoint',

		"providers" => array (
			// openid providers
			"OpenID" => array (
				"enabled" => false
			),

			"Yahoo" => array (
				"enabled" => true,
                "keys"    => array ( "key" => "dj0yJmk9am95UE81UXJQcFFSJmQ9WVdrOVJYbGFjV0ZDTTJVbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD01OQ--", "secret" => "ab66f783f93132a8c7349ebd4e8d1e6d993889e5" ),
            ),

			"AOL"  => array (
				"enabled" => false
			),

			"Google" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "255594119579-f1m3g8s9d49d072l4s13fhld9984h1dn.apps.googleusercontent.com", "secret" => "b1tl5cj1jC4vPfaVCk4PpHPK" ),
			),

			"Facebook" => array (
				"enabled" => true,
				"keys"    => array (
							"id" => "205460593285267",
							"secret" => "193e382ccbb4e4726f9906b1fb657bc4"
							),
                "scope"   => "email, user_friends, public_profile",
				"trustForwarded" => false
			),

			"Twitter" => array (
				"enabled" => true,
				"keys"    => array ( "key" => "hd0jktzDi4EU3hJjpXTdAhjgA", "secret" => "GQhgrrJomSYXuyAEtp1v5JqD6BuocwPpaZ3zWmOjrnwTAIOizv" )
			),

			// windows live
			"Live" => array (
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" )
			),

			"MySpace" => array (
				"enabled" => false,
				"keys"    => array ( "key" => "", "secret" => "" )
			),

			"LinkedIn" => array (
				"enabled" => false,
				"keys"    => array ( "key" => "75blw6tuiaom3x", "secret" => "rJMdMWsbpe2ixl9d" )
			),

			"Foursquare" => array (
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" )
			),
		),

		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => (ENVIRONMENT == 'development'),

		"debug_file" => APPPATH.'/logs/hybridauth.log',
	);


/* End of file hybridauthlib.php */
/* Location: ./application/config/hybridauthlib.php */
