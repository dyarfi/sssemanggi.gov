<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//======================== Administrator Access - start config - ========================//

$config['module_list.models']		= array('admin/ModuleLists');
$config['module_list.module_menu']	= array('modulelist/index'  => 'Modules List');
$config['module_list.module_function']	= array(
											'modulelist/edit'   => 'Edit Module',
											'modulelist/trash'	=> 'Delete User Permission'
											);

/* MODULE MENU
 *
 * Current MENU is only set to user and setting
 * Accessed by administrators only
 *
 */

// Module Menu List
$config['admin_list.module_menu']	= array(
						'userhistory/index' => 'User Histories',
						'dashboard/index'   => 'Dashboard Panel',
						'user/index'	    => 'Users',
						'usergroup/index'   => 'User Groups',
						//'language/index'    => 'Languages',
						'setting/index'	    => 'Settings'
						);

/* MODULE FUNCTION
 *
 * Current FUNCTION is only set to user and setting
 * Accessed by administrators only
 */

// Module Function Menu List
$config['admin_list.module_function']	= array(
						'dashboard/add'	    => 'Add New Dashboard',
						'dashboard/view'    => 'View Dashboard',
						'dashboard/edit'    => 'Edit Dashboard',
						'dashboard/delete'  => 'Delete Dashboard',
						'user/view'	    	=> 'View User',
						'user/edit'	    	=> 'Edit User',
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
					'admin/Labels',
					'admin/Settings',
					//'admin/ServerLogs',
					'admin/Sessions'
					),
		// Admin module menus
		'module_menu'	=> array(
					// Dashboard index
					'dashboard/index'   => 'Dashboard Panel',
					// User index
					'user/index'	    => 'Users',
					// User Group index
					'usergroup/index'   => 'User Groups',
					// Language index
					//'language/index'     => 'Languages',
					// Setting index
					'setting/index'     => 'Settings',
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
						// User functions
						'user/add'	    => 'Add User',
						'user/view'	    => 'View User',
						'user/edit'	    => 'Edit User',
						'user/delete'	=> 'Delete User',
						'user/change'	=> 'Change User Status',
						'user/image'	=> 'Change User Image', /** Upload temp user image **/
						'user/upload'	=> 'Upload User Image', /** Upload user image **/
						// User Group functions
						'usergroup/add'	    => 'Add User Group',
						'usergroup/view'    => 'View User Group',
						'usergroup/edit'    => 'Edit User Group',
						'usergroup/delete'  => 'Delete User Group',
						'usergroup/change'  => 'Change User Group Status',
						// Language functions
						/*'language/add'	=> 'Add Language',*/
						//'language/view'	    => 'View Language',
						/*'language/edit'	=> 'Edit Language',*/
						/*'language/delete' => 'Delete Language',*/
						//'language/change'   => 'Change Language Status',
						//'language/change_default' => 'Change Language Default',
						//'languagelabel/index'	=> 'Language Label',
		                //'languagelabel/add'		=> 'Add Language Label',
                		//'languagelabel/read'	=> 'Read Language Label',
                		//'languagelabel/edit'	=> 'Edit Language Label',
                		//'languagelabel/delete'	=> 'Delete Language Label',
                		// Setting functions
						//'setting/add'	    => 'Add Setting',
						'setting/view'	    => 'View Setting',
						'setting/edit'	    => 'Edit Setting',
						//'setting/delete'    => 'Delete Setting',
						'setting/change'    => 'Change Setting Status',
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
		'models'		=> array('page/Pages','page/PageMenus','page/Templates'),
		// Page module menus
		'module_menu'	=> array(
						'pagemenu/index'	=> 'Page Menus',
						'page/index'		=> 'Pages',
						'pagesocmed/index'		=> 'Social Medias'
						),
		// Page module functions
		'module_function'	=> array(
						// Page Menu functions
						'pagemenu/index/add'	=> 'Add Page Menu',
						'pagemenu/index/read'	=> 'Read Page Menu',
						'pagemenu/index/edit'	=> 'Edit Page Menu',
						'pagemenu/index/delete'	=> 'Delete Page Menu',
						// Page functions
						'page/index/add'	=> 'Add Page',
						'page/index/read'	=> 'Read Page',
						'page/index/edit'	=> 'Edit Page',
						'page/index/delete'	=> 'Delete Page'
						),
	),
	// Member module
	'Member' => array (
		// Member Models list
		'models'		=> array('member/Members'),
		// Member module menus
		'module_menu'	=> array(
						'member/index'		=> 'Members',
						'subscriber/index'		=> 'Subscribers'),
		// Member module functions
		'module_function'	=> array(
						// Member functions
						'member/index/add'	=> 'Add Member',
						'member/index/read'	=> 'Read Member',
						'member/index/edit'	=> 'Edit Member',
						'member/index/delete'	=> 'Delete Member',
						// Subscriber functions
						'subscriber/index/add'	=> 'Add Subscriber',
						'subscriber/index/read'	=> 'Read Subscriber',
						'subscriber/index/edit'	=> 'Edit Subscriber',
						'subscriber/index/delete'	=> 'Delete Subscriber',
						),
	),
 	// Banner module
	'Banner' => array (
		// Banner Models list
		'models'		=> array('banner/Banners'),
		// Banner module menus
		'module_menu'	=> array(
                'banner/index'		=> 'Banners'/*,'bannermiddle/index'=> 'Banner Middle'*/),
		// Banner module functions
		'module_function'	=> array(
                // Banner functions
                'banner/index/add'	=> 'Add Banner',
                'banner/index/read'	=> 'Read Banner',
                'banner/index/edit'	=> 'Edit Banner',
                'banner/index/delete'	=> 'Delete Banner',
                // Banner Middle functions
                //'bannermiddle/index/add'	=> 'Add Middle Banner',
                //'bannermiddle/index/read'	=> 'Read Middle Banner',
                //'bannermiddle/index/edit'	=> 'Edit Middle Banner',
                //'bannermiddle/index/delete'	=> 'Delete Middle Banner',
                ),
	),
    // Contact module
	'Contact' => array (
		// Contact Models list
		'models'		=> array('contact/Contacts'),
		// Contact module menus
		'module_menu'	=> array(
				// Contact index
				'contact/index'			=> 'Contact List',
                // Contact Email index
                'contactemail/index'	=> 'Contact Email',
				// Contact History index
				'contacthistory/index' 	=> 'Contact History'),
				// Contact Enquiry index
				//'contactenquiry/index' 	=> 'Contact Enquiry'),
		// Contact module functions
		'module_function'	=> array(
                // Contact functions
                'contact/index/add'		=> 'Add Contact',
                'contact/index/read'	=> 'Read Contact',
                'contact/index/edit'	=> 'Edit Contact',
                'contact/index/delete'	=> 'Delete Contact',
                // Contact Email functions
                'contactemail/index/add'	=> 'Add Contact Email',
                'contactemail/index/read'	=> 'Read Contact Email',
                'contactemail/index/edit'	=> 'Edit Contact Email',
                'contactemail/index/delete'	=> 'Delete Contact Email',
				// Contact History functions
				//'contacthistory/add'	 => 'Add New Contact History',
				//'contacthistory/edit'    => 'Edit Contact History',
				//'contacthistory/delete'  => 'Delete Contact History',
				'contacthistory/index/read' => 'Read Contact History',
				'contacthistory/change'  => 'Change Contact History Status',
				'contacthistory/reply'  => 'Reply Contact',
				//'contactenquiry/index/read' => 'Read Contact Enquiry',
				//'contactenquiry/change'  => 'Change Contact Enquiry Status',
				//'contactenquiry/reply'  => 'Reply Contact',
                ),
	),
    // News Center module
	'Newscenter' => array (
		// News Center Models list
		'models'		=> array('newscenter/News','newscenter/Tags','newscenter/TagsToNews'),
		// News Center module menus
		'module_menu'	=> array(
                'newscenter/index'	=> 'News'),
		// News Center module functions
		'module_function'	=> array(
                // News Center functions
                'newscenter/index/add'	=> 'Add News',
                'newscenter/index/read'	=> 'Read News',
                'newscenter/index/edit'	=> 'Edit News',
                'newscenter/index/delete'	=> 'Delete News',
                // Promo functions
                'promo/index/add'	=> 'Add Promo',
                'promo/index/read'	=> 'Read Promo',
                'promo/index/edit'	=> 'Edit Promo',
                'promo/index/delete'	=> 'Delete Promo',
				// CSR Activity functions
				'csr/index/add'		=> 'Add CSR Activity',
				'csr/index/read'	=> 'Read CSR Activity',
				'csr/index/edit'	=> 'Edit CSR Activity',
				'csr/index/delete'	=> 'Delete CSR Activity'
                ),
	)
);


/* End of file modules.php */
/* Location: ./application/config/modules.php */
