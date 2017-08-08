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
		'models'		=> array('page/Pages','page/PageMenus','page/PageGroups','page/PageSocmeds','page/Templates'),
		// Page module menus
		'module_menu'	=> array(
						'pagegroup/index'	=> 'Page Groups',
						'pagemenu/index'	=> 'Page Menus',
						'page/index'		=> 'Pages',
						'pagesocmed/index'		=> 'Social Medias'
						),
		// Page module functions
		'module_function'	=> array(
						// Page functions
						'pagegroup/index/add'	=> 'Add Page Group',
						'pagegroup/index/read'	=> 'Read Page Group',
						'pagegroup/index/edit'	=> 'Edit Page Group',
						'pagegroup/index/delete'	=> 'Delete Page Group',
						// Page Menu functions
						'pagemenu/index/add'	=> 'Add Page Menu',
						'pagemenu/index/read'	=> 'Read Page Menu',
						'pagemenu/index/edit'	=> 'Edit Page Menu',
						'pagemenu/index/delete'	=> 'Delete Page Menu',
						// Page functions
						'page/index/add'	=> 'Add Page',
						'page/index/read'	=> 'Read Page',
						'page/index/edit'	=> 'Edit Page',
						'page/index/delete'	=> 'Delete Page',
						// Social Media functions
						'pagesocmed/index/add'	=> 'Add Social Media',
						'pagesocmed/index/read'	=> 'Read Social Media',
						'pagesocmed/index/edit'	=> 'Edit Social Media',
						'pagesocmed/index/delete'	=> 'Delete Social Media',
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
    // Products module
	'Product' => array (
		// Automobile Models list
		'models'		=> array('page/Templates','product/Products','product/ProductVariants','product/ProductColors','product/ProductServices','product/ProductModels','product/ProductGroups',/*,'product/ProductAttributeGroups',*/'product/ProductCategories'),
		// Automobile module menus
		'module_menu'	=> array(
						'productcategory/index' 	=> 'Category',
						'productgroup/index' 	=> 'Group',						
						'automobile/index' 	=> 'Automobile',
						'motorcycle/index' 	=> 'Motorcycle',
						'marine/index' 		=> 'Marine'
						),
		// Automobile module functions
		'module_function'	=> array(

						// Productgroup functions
						'productgroup/index/add'		=> 'Add Product Group',
						'productgroup/index/read'		=> 'Read Product Group',
						'productgroup/index/edit'		=> 'Edit Product Group',
						'productgroup/index/delete'		=> 'Delete Product Group',

						// Productcategory functions
						'productcategory/index/add'		=> 'Add Product Category',
						'productcategory/index/read'		=> 'Read Product Category',
						'productcategory/index/edit'		=> 'Edit Product Category',
						'productcategory/index/delete'		=> 'Delete Product Category',

						// Automobile functions
						'automobile/index/add'		=> 'Add Automobile',
						'automobile/index/read'		=> 'Read Automobile',
						'automobile/index/edit'		=> 'Edit Automobile',
						'automobile/index/delete'	=> 'Delete Automobile',

						// Motorcycle functions
						'motorcycle/index/add'		=> 'Add Motorcycle',
						'motorcycle/index/read'		=> 'Read Motorcycle',
						'motorcycle/index/edit'		=> 'Edit Motorcycle',
						'motorcycle/index/delete'	=> 'Delete Motorcycle',

						// Marine functions
						'marine/index/add'		=> 'Add Marine',
						'marine/index/read'		=> 'Read Marine',
						'marine/index/edit'		=> 'Edit Marine',
						'marine/index/delete'	=> 'Delete Marine',

						// Product Model functions
						'productmodel/index'			=> 'List Product Model',
						'productmodel/index/add'		=> 'Add Product Model',
						'productmodel/index/read'	=> 'Read Product Model',
						'productmodel/index/edit'	=> 'Edit Product Model',
						'productmodel/index/delete'	=> 'Delete Product Model',

						// Product Attributes functions
						'productattribute/index'			=> 'List Product Attribute',
						'productattribute/index/add'		=> 'Add Product Attribute',
						'productattribute/index/read'		=> 'Read Product Attribute',
						'productattribute/index/edit'		=> 'Edit Product Attribute',
						'productattribute/index/delete'		=> 'Delete Product Attribute',

						// Product Variants functions
						'productvariant/index'			=> 'List Product Variant',
						'productvariant/index/add'		=> 'Add Product Variant',
						'productvariant/index/read'		=> 'Read Product Variant',
						'productvariant/index/edit'		=> 'Edit Product Variant',
						'productvariant/index/delete'	=> 'Delete Product Variant',

						// Product Accessory functions
						'productaccessory/index'			=> 'List Product Accessory',
						'productaccessory/index/add'		=> 'Add Product Accessory',
						'productaccessory/index/read'		=> 'Read Product Accessory',
						'productaccessory/index/edit'		=> 'Edit Product Accessory',
						'productaccessory/index/delete'		=> 'Delete Product Accessory',

						// Product Accessory functions
						'productservice/index'			=> 'List Product Service',
						'productservice/index/add'		=> 'Add Product Service',
						'productservice/index/read'		=> 'Read Product Service',
						'productservice/index/edit'		=> 'Edit Product Service',
						'productservice/index/delete'	=> 'Delete Product Service',
						'productservice/store'			=> 'Store Product Service',
						'productservice/list_items'		=> 'Product Service Items',
						'productservice/list_item_delete' => 'Product Service Items',

						/*
						// Product Attributes Groups functions
						'productattributegroup/index'			=> 'List Product Attribute Group',
						'productattributegroup/index/add'		=> 'Add Product Attribute Group',
						'productattributegroup/index/read'		=> 'Read Product Attribute Group',
						'productattributegroup/index/edit'		=> 'Edit Product Attribute Group',
						'productattributegroup/index/delete'	=> 'Delete Product Attribute Group',

						// Product To Attributes Groups functions
						'producttoattribute/index'			=> 'List Product to Attribute',
						'producttoattribute/index/add'		=> 'Add Product to Attribute',
						'producttoattribute/index/read'		=> 'Read Product to Attribute',
						'producttoattribute/index/edit'		=> 'Edit Product to Attribute',
						'producttoattribute/index/delete'	=> 'Delete Product to Attribute'
						*/

		)
	),
    // News Center module
	'Newscenter' => array (
		// News Center Models list
		'models'		=> array('newscenter/News','newscenter/Tags','newscenter/TagsToNews'),
		// News Center module menus
		'module_menu'	=> array(
                'newscenter/index'	=> 'News',
                'promo/index' 		=> 'Promo',
                'csr/index' 		=> 'CSR'),
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
	),
	// Region module
	'Region' => array (
		// Region Models list
		'models'		=> array('region/Provinces','region/SubUrbans','region/UrbanDistricts','region/Districts'),
		// Region module menus
		'module_menu'	=> array(
							'province/index'		=> 'Province',
							'urbandistrict/index'	=> 'Urban District',
							'suburban/index'		=> 'Sub Urban',
							//'district/index'		=> 'District',
							),
		// Region module functions
		'module_function'	=> array(
						// Province functions
						'province/index/add'	=> 'Add Province',
						'province/index/read'	=> 'View Province',
						'province/index/edit'	=> 'Edit Province',
						'province/index/delete'	=> 'Delete Province',
						'province/index/change'	=> 'Change Province Status',
						'province/index/export'	=> 'Export Province',
						'province/index/print'	=> 'Print Province',
						// Urban District functions
						'urbandistrict/index/add'	=> 'Add Urban District',
						'urbandistrict/index/read'	=> 'View Urban District',
						'urbandistrict/index/edit'	=> 'Edit Urban District',
						'urbandistrict/index/delete'	=> 'Delete Urban District',
						'urbandistrict/index/change'	=> 'Change Urban District Status',
						'urbandistrict/index/export'	=> 'Export Urban District',
						'urbandistrict/index/print'	=> 'Print Urban District',
						// Sub District functions
						'suburban/index/add'	=> 'Add Sub Urban',
						'suburban/index/read'	=> 'View Sub Urban',
						'suburban/index/edit'	=> 'Edit Sub Urban',
						'suburban/index/delete'	=> 'Delete Sub Urban',
						'suburban/index/change'	=> 'Change Sub Urban Status',
						'suburban/index/export'	=> 'Export Sub Urban',
						'suburban/index/print'	=> 'Print Sub Urban',
						// District functions
						//'district/index/add'	=> 'Add District',
						//'district/index/read'	=> 'View District',
						//'district/index/edit'	=> 'Edit District',
						//'district/index/delete'	=> 'Delete District',
						//'district/index/change'	=> 'Change District Status',
						//'district/index/export'	=> 'Export District',
						//'district/index/print'	=> 'Print District',
					    ),
	),
	// Service module
	'Service' => array (
		// Service Models list
		'models'		=> array('service/Dealers'),
		// Service module menus
		'module_menu'	=> array(
							//'service/index'		=> 'Service',
							'dealers/index'		=> 'Dealer',
							'dealer_networks/index'		=> 'Dealer Networks',
				            'booking/index'	=> 'Booking',
				            'booking_approval/index'	=> 'Booking Approval',
				            'servicemember/index'	=> 'Service Member',
				            'servicemember_approval/index'	=> 'Service Member Approval',
				            'article/index'	=> 'Article',
				            'education/index'	=> 'Education',
				            'product_static/index'	=> 'Product Static',
				            'tips/index'	=> 'Tips',
				            'survey/index'	=> 'Survey',
				            'survey_respondent/index'	=> 'Survey Respondent',
				            'survey_dashboard/index'	=> 'Survey Dashboard',
				            //'slide_banner/index'	=> 'Slide Banner',
				            'static_content/index'	=> 'Static Content',
				            'community/index'	=> 'Community',
	                        //'service/part_reff/index'	=> 'Part Refference',
            				//'service/part/index'	=> 'Part',
							),
		// Service module functions
		'module_function'	=> array(
						// Booking functions
			            'booking/index/read'	=> 'View Booking',
			            'booking/index/edit'	=> 'Update Booking',
			            // Booking Approval functions
			            'booking_approval/index/read'	=> 'View Booking Approval',
			            'booking_approval/index/edit'	=> 'Update Booking Approval',
			            // Member functions
			            'servicemember/index/read'	=> 'View Service Member',
			            'servicemember/index/edit'	=> 'Update Service Member',
			            // Member Approval functions
			            'servicemember_approvals/index/read'	=> 'View Service Member Approval',
			            'servicemember_approvals/index/edit'	=> 'Update Service Member Approval',
			            // Article functions
			            'article/index/add'	=> 'Add Article',
			            'article/index/edit'	=> 'Edit Article',
			            'article/index/delete'	=> 'Delete Article',
			            // Product Static functions
			            'product_static/index/add'	=> 'Add Product Static',
			            'product_static/index/edit'	=> 'Edit Product Static',
			            'product_static/index/delete'	=> 'Delete Product Static',
			            // Tips functions
			            'tips/index/add'	=> 'Add Tips',
			            'tips/index/edit'	=> 'Edit Tips',
			            'tips/index/delete'	=> 'Delete Tips',
			            // Survey functions
            			'survey/index/add'	=> 'Add Tips',
            			'survey/index/edit'	=> 'Edit Tips',
            			'survey/index/delete'	=> 'Delete Tips',
            			// Survey Respondent functions
            			'survey_respondent/index/add'	=> 'Add Survey Respondent',
            			'survey_respondent/index/edit'	=> 'Edit Survey Respondent',
            			'survey_respondent/index/delete'	=> 'Delete Survey Respondent',
            			// Survey Dashboard
            			//'service/survey_dashboard/index'	=> 'Survey Dashboard',
			            // Part Refference functions
			            //'service/part_reff/index/add'	=> 'Add Part Refference',
			            //'service/part_reff/index/edit'	=> 'Edit Part Refference',
			            //'service/part_reff/index/delete'	=> 'Delete Part Refference',
			            // Part Refference functions
			            //'service/part/index/add'	=> 'Add Part',
			            //'service/part/index/edit'	=> 'Edit Part',
			            //'service/part/index/delete'	=> 'Delete Part',
						// Dealers functions
						'dealers/index/add'	=> 'Add Dealer',
						'dealers/index/read'	=> 'View Dealer',
						'dealers/index/edit'	=> 'Edit Dealer',
						'dealers/index/delete'	=> 'Delete Dealer',
						'dealers/index/change'	=> 'Change Dealer Status',
						'dealers/index/export'	=> 'Export Dealer',
						'dealers/index/print'	=> 'Print Dealer',
						// Dealers functions
						'dealer_networks/index/add'	=> 'Add Dealer Networks',
						'dealer_networks/index/read'	=> 'View Dealer Networks',
						'dealer_networks/index/edit'	=> 'Edit Dealer Networks',
						'dealer_networks/index/delete'	=> 'Delete Dealer Networks',
						'dealer_networks/index/change'	=> 'Change Dealer Networks Status',
						'dealer_networks/index/export'	=> 'Export Dealer Networks',
						'dealer_networks/index/print'	=> 'Print Dealer Networks'
					    ),
	),
);


/* End of file modules.php */
/* Location: ./application/config/modules.php */
