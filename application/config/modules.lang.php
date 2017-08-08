<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
				
//======================== Administrator Access - start config - ========================//

$config['module_list.models']		= array('admin/ModuleLists');
$config['module_list.module_menu']	= array('modulelist/index'  => lang('Modules List'));
$config['module_list.module_function']	= array(
											'modulelist/edit'   => lang('Edit Module'),
											'modulelist/trash'	=> lang('Delete User Permission')
											);

/* MODULE MENU 
 * 
 * Current MENU is only set to user and setting
 * Accessed by administrators only
 * 
 */

// Module Menu List
$config['admin_list.module_menu']	= array(
						'userhistory/index' => lang('User Histories'),
						'dashboard/index'   => lang('Dashboard Panel'),
						'user/index'	    => lang('Users'),
						'usergroup/index'   => lang('User Groups'),
						'language/index'    => lang('Languages'),
						'setting/index'	    => lang('Settings')
						);

/* MODULE FUNCTION
 * 
 * Current FUNCTION is only set to user and setting
 * Accessed by administrators only
 */

// Module Function Menu List
$config['admin_list.module_function']	= array(
						'dashboard/add'	    => lang('Add New Dashboard'),
						'dashboard/view'    => lang('View Dashboard'),
						'dashboard/edit'    => lang('Edit Dashboard'),
						'dashboard/delete'  => lang('Delete Dashboard'),
						'user/view'	    => lang('View User'),
						'user/edit'	    => lang('Edit User'),
						);

//======================== Administrator Access - end config - ========================//

// Default modules
$config['modulelist'] = array(	
	// Admin module
	'Admin' => array(
		// Admin Models list
		'models'	=> array(
					'admin/Users',
					'admin/UserProfiles',
					'admin/UserHistories',
					'admin/ModulePermissions',
					'admin/UserGroupPermissions',
					'admin/Languages',
					'admin/Settings',
					'admin/ContactHistories',					
					// 'admin/ServerLogs',
					'admin/Sessions'
					),
		// Admin module menus
		'module_menu'	=> array(
					// Dashboard index
					'dashboard/index'   => lang('Dashboard Panel'),
					// User index
					'contacthistory/index' => lang('Contact History'),
					// User index
					'user/index'	    => lang('Users'),
					// User Group index
					'usergroup/index'   => lang('User Groups'),
					// Language index
					'language/index'     => lang('Languages'),
					// Setting index
					'setting/index'     => lang('Settings'),
					// Server Log index
					//'serverlog/index'   => 'Server Logs'
					),
		// Admin module functions
		'module_function'	=> array(
						// Dashboard functions
						//'dashboard/add'	    => 'Add New Dashboard',
						//'dashboard/view'    => 'View Dashboard',
						//'dashboard/edit'    => 'Edit Dashboard',
						//'dashboard/delete'  => 'Delete Dashboard',
						//'dashboard/change'  => 'Change Dashboard Status',		
						// Contact History functions
						//'contacthistory/add'	 => 'Add New Contact History',
						//'contacthistory/edit'    => 'Edit Contact History',
						//'contacthistory/delete'  => 'Delete Contact History',
						'contacthistory/view'    => lang('View Contact History'),
						'contacthistory/change'  => lang('Change Contact History Status'),
						// User functions
						'user/add'	    => lang('Add User'),
						'user/view'	    => lang('View User'),
						'user/edit'	    => lang('Edit User'),
						'user/delete'	=> lang('Delete User'),
						'user/change'	=> lang('Change User Status'),
						'user/image'	=> lang('Change User Image'), /** Upload temp user image **/
						'user/upload'	=> lang('Upload User Image'), /** Upload user image **/
						// User Group functions
						'usergroup/add'	    => lang('Add User Group'),
						'usergroup/view'    => lang('View User Group'),
						'usergroup/edit'    => lang('Edit User Group'),
						'usergroup/delete'  => lang('Delete User Group'),
						'usergroup/change'  => lang('Change User Group Status'),
						// Language functions
						//'language/add'	=> lang('Add Language'),
						'language/view'	    => lang('View Language'),
						//'language/edit'	=> lang('Edit Language'),
						//'language/delete' => lang('Delete Language'),
						'language/change'   => lang('Change Language Status'),
						//'language/change_default' => lang('Change Language Default'),
						// Setting functions
						//'setting/add'	    => lang('Add Setting'),
						'setting/view'	    => lang('View Setting'),
						'setting/edit'	    => lang('Edit Setting'),
						//'setting/delete'    => lang('Delete Setting'),
						'setting/change'    => lang('Change Setting Status'),
						// Server Log functions
						//'serverlog/view'	=> 'View Server Log',
						//'serverlog/edit'	=> 'Edit Server Log',
						//'serverlog/delete'	=> 'Delete Server Log',
						//'serverlog/trash'	=> 'Trash Server Log'
						)
	),
	// Page module
	'Page' => array (
		// Page Models list
		'models'		=> array('page/Pages','page/PageMenus'),
		//'models'		=> array('page/PageMenus'),		
		// Page module menus
		'module_menu'	=> array(
						'page/index'		=> lang('Pages'),
						'pagemenu/index'	=> lang('Page Menus')),
		// Page module functions
		'module_function'	=> array(
						// Page functions
						'page/index/add'	=> lang('Add Page'),
						'page/index/read'	=> lang('Read Page'),
						'page/index/edit'	=> lang('Edit Page'),
						'page/index/delete'	=> lang('Delete Page'),
						'page/translate'	=> lang('Translate Page'),
						// Page Menu functions
						'pagemenu/index/add'	=> lang('Add Page Menu'),
						'pagemenu/index/read'	=> lang('Read Page Menu'),
						'pagemenu/index/edit'	=> lang('Edit Page Menu'),
						'pagemenu/index/delete'	=> lang('Delete Page Menu'),
                        'pagemenu/translate'	=> lang('Translate Page Menu'),
						),
	),
    // Business module
	'Business' => array (
		// Business Models list
		'models'		=> array('business/Business','business/BusinessCategories','business/BusinessImages'),
		// Business module menus
		'module_menu'	=> array(
						'business/index'          => lang('Business List'),
						'business_category/index' => lang('Business Categories')),
		// Business module functions
		'module_function'	=> array(
						// business functions
						'business/index/add'	=> lang('Add Business'),							
						'business/index/read'	=> lang('Read Business'),
						'business/index/edit'	=> lang('Edit Business'),
						'business/index/delete'	=> lang('Delete Business'),
						'business/translate'	=> lang('Translate Business'),
						
                        // Businesss Gallery functions
                        'business_gallery/index'        => lang('Business Gallery'),
                        //'business_gallery/index/add'		=> lang('Add Gallery'),
                        //'business_gallery/index/read'	=> lang('Read Gallery'),			
                        //'business_gallery/index/edit'	=> lang('Edit Gallery'),			
                        //'business_gallery/index/delete' 	=> lang('Delete Gallery'),
                        
						// Business Category functions
						'business_category/index/add'	=> lang('Add Business Category'),
						'business_category/index/read'	=> lang('Read Business Category'),
						'business_category/index/edit'	=> lang('Edit Business Category'),
						'business_category/index/delete'	=> lang('Delete Business Category'),
                        'business_category/translate'	=> lang('Translate Business Category'),
						),
	),
 	// Banner module
	'Banner' => array (
		// Banner Models list
		'models'		=> array('banner/Banners'),
		// Banner module menus
		'module_menu'	=> array(
                'banner/index'		=> lang('Banners')),
		// Banner module functions
		'module_function'	=> array(
                // Banner functions
                'banner/index/add'	=> lang('Add Banner'),
                'banner/index/read'	=> lang('Read Banner'),
                'banner/index/edit'	=> lang('Edit Banner'),
                'banner/index/delete'	=> lang('Delete Banner'),
                'banner/translate'		=> lang('Translate Banner'),
                ),
	),
    // Faq module
	'Faq' => array (
		// Faq Models list
		'models'		=> array('faq/Faqs'),
		// Faq module menus
		'module_menu'	=> array(
                'faq/index'		=> lang('Faqs')),
		// Faq module functions
		'module_function'	=> array(
                // Faq functions
                'faq/index/add'	=> lang('Add Faq'),
                'faq/index/read'	=> lang('Read Faq'),
                'faq/index/edit'	=> lang('Edit Faq'),
                'faq/index/delete'	=> lang('Delete Faq'),
                'faq/translate'		=> lang('Translate Faq'),
                ),
	),
	// Career module
	'Career' => array (
		// Career Models list
		'models'		=> array('career/Careers','career/Divisions','career/Applicants'),
		// Career module menus
		'module_menu'	=> array(
						'career/index'		=> lang('Careers'),
						'division/index'	=> lang('Divisions'),
						'applicant/index'	=> lang('Applicants'),
						),
		// Career module functions
		'module_function'	=> array(
						// Career functions
						'career/index/add'	=> lang('Add Career'),
						'career/index/read'	=> lang('Read Career'),
						'career/index/edit'	=> lang('Edit Career'),
						'career/index/delete'	=> lang('Delete Career'),
						'career/translate'		=> lang('Translate Career'),
						
						// Division functions
						'division/index/add'	=> lang('Add Division'),
						'division/index/read'	=> lang('Read Division'),
						'division/index/edit'	=> lang('Edit Division'),
						'division/index/delete'	=> lang('Delete Division'),
						'division/translate'	=> lang('Translate Division'),
						
						// Applicant functions
						'applicant/index/add'	 => lang('Add Applicant'),
						'applicant/index/read'	 => lang('Read Applicant'),
						'applicant/index/edit'	 => lang('Edit Applicant'),
						'applicant/index/delete' => lang('Delete Applicant'),
						),
	),
    // Contact module
	'Contact' => array (
		// Contact Models list
		'models'		=> array('contact/Contacts'),
		// Contact module menus
		'module_menu'	=> array(
                'contact/index'			=> lang('Contact List')),
		// Contact module functions
		'module_function'	=> array(
                // Contact functions
                'contact/index/add'	=> lang('Add Contact'),
                'contact/index/read'	=> lang('Read Contact'),
                'contact/index/edit'	=> lang('Edit Contact'),
                'contact/index/delete'	=> lang('Delete Contact'),
                'contact/translate'	=> lang('Translate Contact')
                ),
	),
    // Media Center module
	'Media' => array (
		// Media Center Models list
		'models'		=> array('media/Medias','media/MediaCategories'),
		// Media Center module menus
		'module_menu'	=> array(
                'media/index'			=> lang('Medias'),
                'media_category/index' 	=> lang('Media Categories')),
		// Media Center module functions
		'module_function'	=> array(
                // Media Center functions
                'media/index/add'	=> lang('Add Media'),
                'media/index/read'	=> lang('Read Media'),
                'media/index/edit'	=> lang('Edit Media'),
                'media/index/delete'	=> lang('Delete Media'),
                'media/translate'	=> lang('Translate Media'),
                // Media Center Category functions
                'media_category/index/add'	=> lang('Add Media Category'),
                'media_category/index/read'	=> lang('Read Media Category'),
                'media_category/index/edit'	=> lang('Edit Media Category'),
                'media_category/index/delete'	=> lang('Delete Media Category'),
                'media_category/translate'	=> lang('Translate Media Category')
                
                ),
	),
	// Violate module
	'Violate' => array (
		// Violate Models list
		'models'		=> array('violate/Violates','violate/Reports'),
		// Violate module menus
		'module_menu'	=> array(
                'violate/index'			=> lang('Violation'),
                'report_violate/index'	=> lang('Report Violation')),
		// Violate module functions
		'module_function'	=> array(
                // Violate functions
                'violate/index/add'		=> lang('Add Violation'),
                'violate/index/read'	=> lang('Read Violation'),
                'violate/index/edit'	=> lang('Edit Violation'),
                'violate/index/delete'	=> lang('Delete Violation'),
                //'violate/translate'	=> lang('Translate Violation'),
                
                // Report Violate functions
                'report_violate/index/add'	  => lang('Add Report Violate'),
                'report_violate/index/read'   => lang('Read Report Violate'),
                'report_violate/index/edit'   => lang('Edit Report Violate'),
                'report_violate/index/delete' => lang('Delete Report Violate'),
                ),
	),
);


/* End of file modules.php */
/* Location: ./application/config/modules.php */