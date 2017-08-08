<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

/*
| -------------------------------------------------------------------------
| MODULE ADMIN PANEL ROUTING - [START]
| -------------------------------------------------------------------------
*/

$admin = (ADMIN) ? str_replace('/', '', ADMIN) : '';

$route[$admin]						= "admin/authenticate";
$route[$admin.'/authenticate']		= "admin/authenticate/index";
$route[$admin.'/authenticate/(:any)']	= "admin/authenticate/$1";

/***** Administrator module menu mandatory [start] *****/
$route[$admin.'/dashboard/(:any)']	= 'admin/dashboard/$1';
$route[$admin.'/user/(:any)']		= 'admin/user/$1';
$route[$admin.'/usergroup/(:any)']	= 'admin/usergroup/$1';
//$route[$admin.'/contacthistory/(:any)']	= 'admin/contacthistory/$1';
$route[$admin.'/language/(:any)']	= 'admin/language/$1';
$route[$admin.'/languagelabel/(:any)']	= 'admin/languagelabel/$1';
$route[$admin.'/modulelist/(:any)']	= 'admin/modulelist/$1';
$route[$admin.'/setting/(:any)']	= 'admin/setting/$1';
//$route[$admin.'/serverlog/(:any)']	= 'admin/serverlog/$1';

/***** Administrator module menu mandatory [end] *****/

// Banner routes
$route[$admin.'/banner/(:any)']           = 'banner/$1';
$route[$admin.'/bannermiddle/(:any)']     = 'banner/bannermiddle/$1';

// Contact routes
$route[$admin.'/contact/(:any)']           	= 'contact/$1';
$route[$admin.'/contactemail/(:any)']       = 'contact/contactemail/$1';
$route[$admin.'/contacthistory/(:any)']		= 'contact/contacthistory/$1';
$route[$admin.'/contactenquiry/(:any)']		= 'contact/contactenquiry/$1';

// Product routes
$route[$admin.'/automobile/(:any)'] = 'product/automobile/$1';
$route[$admin.'/motorcycle/(:any)'] = 'product/motorcycle/$1';
$route[$admin.'/marine/(:any)']  	= 'product/marine/$1';

$route[$admin.'/productvariant/(:any)'] = 'product/productvariant/$1';
$route[$admin.'/productaccessory/(:any)'] = 'product/productaccessory/$1';
$route[$admin.'/productattribute/(:any)'] = 'product/productattribute/$1';
$route[$admin.'/productservice/(:any)'] = 'product/productservice/$1';
$route[$admin.'/productmodel/(:any)']  = 'product/productmodel/$1';
$route[$admin.'/productcategory/(:any)']  = 'product/productcategory/$1';
$route[$admin.'/productgroup/(:any)']  = 'product/productgroup/$1';

// Region routes
$route[$admin.'/province/(:any)']	= 'region/province/$1';
$route[$admin.'/suburban/(:any)']	= 'region/suburban/$1';
$route[$admin.'/urbandistrict/(:any)'] = 'region/urbandistrict/$1';
//$route[$admin.'/district/(:any)']	= 'region/district/$1';

// Pages routes
$route[$admin.'/page/(:any)']		= 'page/$1';
$route[$admin.'/pagemenu/(:any)']	= 'page/pagemenu/$1';
$route[$admin.'/pagegroup/(:any)']	= 'page/pagegroup/$1';
$route[$admin.'/pagesocmed/(:any)']	= 'page/pagesocmed/$1';

// Members routes
$route[$admin.'/member/(:any)']		= 'member/$1';
$route[$admin.'/subscriber/(:any)']	= 'member/subscriber/$1';

// News routes
$route[$admin.'/newscenter/(:any)']   = 'newscenter/news/$1';
$route[$admin.'/promo/(:any)']  	  = 'newscenter/promo/$1';
$route[$admin.'/csr/(:any)'] 		  = 'newscenter/csr/$1';

// Service routes
$route[$admin.'/dealers/(:any)'] = 'service/dealer/$1';
$route[$admin.'/dealer_networks/(:any)'] = 'service/dealer_networks/$1';

// Service routes
$route[$admin.'/booking_approval/(:any)']   = 'service/booking_approval/$1';
$route[$admin.'/booking/(:any)']   = 'service/booking/$1';
$route[$admin.'/article/(:any)']   = 'service/article/$1';
$route[$admin.'/tips/(:any)']   = 'service/tips/$1';
$route[$admin.'/survey/(:any)']   = 'service/survey/$1';
$route[$admin.'/survey_respondent/(:any)']   = 'service/survey_respondent/$1';
$route[$admin.'/survey_dashboard/(:any)']   = 'service/survey_dashboard/$1';
$route[$admin.'/education/(:any)']   = 'service/education/$1';
$route[$admin.'/servicemember_approval/(:any)']   = 'service/servicemember_approval/$1';
$route[$admin.'/servicemember/(:any)']   = 'service/servicemember/$1';
$route[$admin.'/product_static/(:any)']   = 'service/product_static/$1';
$route[$admin.'/static_content/(:any)']   = 'service/static_content/$1';
$route[$admin.'/community/(:any)']   = 'service/article/$1';

/*
| -------------------------------------------------------------------------
| MODULE ADMIN PANEL ROUTING - [END]
| -------------------------------------------------------------------------
*/
//$route['default_controller']  = 'coming_soon';
//$route['([a-z]{0,2})/(:any)'] = 'language/lang/$1';
//$route['((.*)/\w{2})'] 		= '$1';
$route['default_controller'] = 'site_home';
$route['404_override']		 = 'pagenotfound';
// Page related controller
$route['download/(:num)']	 = 'download';
$route['language/(:any)']    = "language";
$route['search/(:any)']		 = 'search';
$route['sitemap/?([a-z]{0,2})'] = 'sitemap/index/$1';
// ------------- Contact Us
$route['contact-us']  			= "page_contact/index/$1"; // Contact Us Page
$route['contact-us/sent']  		= "page_contact/sent"; // Contact Us Page Sent
// ------------- Area Region Data
$route['area/get_area/(:any)']  = "area/get_area/$1"; // URL for get area region list
// ------------- Media Room
$route['media-room']  			= "page_media/index/$1"; // Media Index page
$route['media-room/login']		= "page_media/login"; // Media Login URL
$route['media-room/logout']		= "page_media/logout"; // Media Logout URL
$route['media-room/register']	= "page_media/register"; // Media Register Page
$route['media-room/sent']  		= "page_media/sent"; // Media Register Page Sent
$route['media-room/confirm/(:any)']	= "page_media/activation/$1"; // Media Account Activation Page
// ------------- Dealers
$route['dealer']  			= "dealer"; // Media Index page
//$route['dealer/login']		= "page_media/login"; // Media Login URL
//$route['dealer/logout']		= "page_media/logout"; // Media Logout URL
//$route['media-room/register']	= "page_media/register"; // Media Register Page
//$route['media-room/sent']  		= "page_media/sent"; // Media Register Page Sent
// /$route['media-room/confirm/(:any)']	= "page_media/activation/$1"; // Media Account Activation Page
// ------------- Page Menu & Pages
$route['page']										= "site_page";
$route['page/(:any)/post/(:any)/?([a-z]{0,2})'] 	= "site_page/post/$1/$2/$3";
$route['page/(:any)/page-([a-z]+)/?([a-z]{0,2})'] 	= "page_$2/index/$1/$2/$3";
$route['page/(:any)/page-([a-z]+)/?(:any)/?([a-z]{0,2})'] 	= "page_$2/post/$1/$2/$3/$4";
$route['page/(:any)']										= "site_page/detail/$1/";
// ------------- Products
$route['automobile/(:any)'] 		= "automobile/detail/$1";
$route['motorcycle/(:any)'] 		= "motorcycle/detail/$1";
$route['marine/(:any)'] 			= "marine/detail/$1";
// ------------- News
$route['news'] 				= "site_news";
$route['news/filter/(:any)/(:any)'] = "site_news/index/$1/$2";
$route['news/(:any)'] 		= "site_news/detail/$1";
$route['promo'] 			= "site_promo";
$route['promo/(:any)'] 		= "site_promo/detail/$1";
// ------------- Corporate
$route['corporate/page-([a-z]+)'] = "corporate/lists/$1";
$route['corporate/page-([a-z]+)/?(:any)'] = "corporate/post/$1/$2";
$route['corporate/(:any)'] 		= "corporate/detail/$1";
// ------------- Static Pages
$route['page-([a-z]+)']			= "page_$1";
$route['page-([a-z]+)/?(:any)'] = "page_$1/detail/$2";

/* Service route */
// Pages
$route['services'] = 'services';
$route['services/automobile'] = 'services/service_automobile';
$route['services/automobile/booking.json'] = 'services/service_automobile_booking';
$route['services/automobile/tips'] = 'services/service_automobile_tips';
$route['services/automobile/tips/(:any)'] = 'services/service_automobile_tips/$1';
$route['services/motorcycle'] = 'services/service_motorcycle';
$route['services/marine'] = 'services/service_marine';
$route['services/layanan-24-jam-sera'] = 'services/service_layanan24jamsera';
$route['services/halo-suzuki'] = 'services/service_halosuzuki';
$route['services/automobile/(article|event|blog)'] = 'services/service_automobile_article/$1';
$route['services/automobile/(article|event|blog)/(:any)'] = 'services/service_automobile_article/$1/$2';
$route['services/automobile/(:any)'] = 'services/product_static/automobile/$1';
$route['services/motorcycle/(:any)'] = 'services/product_static/motorcycle/$1';
$route['services/marine/(:any)'] = 'services/product_static/marine/$1';
$route['services/sgo'] = 'services/service_sgo';
$route['services/sgo/(:any)'] = 'services/product_static/sgo/$1';
$route['services/sgp'] = 'services/service_sgp';
$route['services/sgp/(:any)'] = 'services/product_static/sgp/$1';
$route['services/sgc'] = 'services/service_sgc';
$route['services/sgc/(:any)'] = 'services/product_static/sgc/$1';
// Account Related
$route['services/auth/signup.json'] = 'services/auth_signup';
$route['services/auth/signin.json'] = 'services/auth_signin';
$route['services/auth/forgot.json'] = 'services/auth_forgot';
$route['services/auth/signout'] = 'services/auth_signout';
$route['services/auth/confirm/validate.json'] = 'services/auth_confirm_validate';
$route['services/auth/confirm/(:any)'] = 'services/auth_confirm/$1';
$route['services/profile/blog'] = 'services/profile_blog';
$route['services/profile/booking'] = 'services/profile_booking_history';
// Json REST Related
$route['services/survey/save.json'] = 'services/survey_save';
$route['services/rest/dealers/(:num)'] = 'services/rest_dealers/$1';
$route['services/rest/booking/check/(:num)'] = 'services/rest_booking_check/$1';
$route['services/rest/booking/check_html/(:num)'] = 'services/rest_booking_check_html/$1';
/* End of file routes.php */
/* Location: ./application/config/routes.php */
