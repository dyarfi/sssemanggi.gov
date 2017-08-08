<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {

	public $module_list = '';
	public $module_function_list = '';

	public $controller = '';
	public $action = '';

	public $user = '';
	public $previous_url = '';

	public $setting ='';
	public $i18ln = '';

	public function __construct() {
		parent::__construct();

		// Load Session library
		$this->load->library('session');

		// Load Admin config
		$this->configs			= $this->load->config('admin/admin',true);

		// Load Setting Model
		$this->load->model('admin/Settings');

		// Load Setting Model
		$this->load->model('admin/Languages');

		// Set site logo
        $this->logo     = $this->Settings->getByParameter('site_logo_admin');

        // Set site logo
        $this->site_name    = $this->Settings->getByParameter('site_name');

        // Set site title name
        $this->title_name  	= $this->Settings->getByParameter('title_name');

        // Set site copyright
        $this->copyright    = $this->Settings->getByParameter('copyright');

		// Set i18ln for the default language
		$this->i18ln			= $this->Languages->getDefaultSiteLanguage();

		// Set default language to English
		//$this->config->set_item('language','english');
		$this->config->set_item('language', $this->i18ln->url);
		$this->config->set_item('csrf_protection', FALSE);
		$this->config->set_item('global_xss_filtering', FALSE);

		// Load language variables
		$this->lang->load( array('module','form_validation','label','name','upload','email'));

		// Session destroy
		//$this->session->sess_destroy();

		// Set user data lists from login session
		$this->load->library('Acl');
		$this->user				= $this->acl->user();

		// Load user module and function lists
		$this->module_list		= json_decode($this->session->userdata('module_list'),TRUE);
		$this->module_function_list	= json_decode($this->session->userdata('module_function_list'),TRUE);

		$this->module			= @$this->uri->segments[1];
		$this->controller		= @$this->uri->segments[2];
		$this->action			= @$this->uri->segments[3];
		$this->param			= (@$this->uri->segments[4] != '') ? '/' . @$this->uri->segments[4] : '';
		$this->module_request	= $this->controller . '/' .$this->action . $this->param;
		$this->module_menu		= self::check_module_menu($this->module_request);

		// Check if user data is true empty and redirect to authenticate
		if (!$this->user
				&& strpos($this->uri->uri_string(), ADMIN) == 0
					&& $this->uri->segment(2) !== 'authenticate') {
			// Destroy all session
			$this->acl->session_destroy();
			// Redirect to authentication if direct access to all classes
			redirect(ADMIN.'authenticate/logout');
		}

		// Check for previous url from referrer
		if (strstr($this->session->userdata('prev_url'), ADMIN) !== ''
				&& $this->session->userdata('prev_url') != $this->session->userdata('curr_url')) {
			// Set Previous URL to current URL
			$this->session->set_userdata('prev_url', $this->session->userdata('curr_url'));
		} else {
			// Set current URL from current url
			$this->session->set_userdata('curr_url', $this->uri->uri_string());
		}

		// Set previous URL from previous url session
		$this->previous_url	= $this->session->userdata('prev_url');

		// Check user access list
		self::check_module_permission($this->controller, $this->action, $this->param);

	}

	/**
	* Checking access permission stored in database and return the accessible function
	*
	* @access	public
	* @param	array
	* @return	true/false
	*/
	public function check_module_permission ($controller='',$action='', $param='') {

		$accessible		= FALSE;

		$module_list 	= $this->module_list;

		$module_function_list 	= $this->module_function_list;

		// Check again for necessaries variables
		if ($module_list && $module_function_list && strstr($this->uri->uri_string, ADMIN) !='') {

			$url_to_match = '';

			$param = is_numeric(str_replace('/', '',$param)) ? '' : $param;

			//if ($controller != '' && $action != '') $url_to_match = $controller .'/'. $action . $param;

			if ($controller != '' && $action != '') $url_to_match = $controller .'/'. $action;

			$function_modules 	= array_merge_recursive($module_list, $module_function_list);

			// Define all accessible function action into TRUE
			foreach ($function_modules as $modules) {

				if (!empty($modules[$url_to_match])) {

					$accessible = TRUE;

				}

			}

			$accessible = true;

			// Define controller or post that don't have to be checked
			if ($accessible === FALSE
					// For Bypassing admin-panel reload_captcha method in all classes
					&& $action != 'reload_captcha'
					// For Bypassing admin-panel forgot_password method in all classes
					&& $action != 'forgot_password'
					// For Bypassing admin-panel ajax method in all classes
					&& $action != 'ajax'
					// For Bypassing admin-panel ordering method in all classes
					&& $action != 'order'
					// For Bypassing admin-panel download method in all classes
					&& $action != 'download'
					// For Bypassing admin-panel translate method in all classes
					&& $action != 'translate'
					// For Bypassing admin-panel translate detail method in all classes
					&& $action != 'detail'
					// For Bypassing authentication controller in @admin-panel/authentication
					&& $controller != 'authenticate'
					// For Bypassing authentication controller in @admin-panel/authentication
					&& $controller != 'dashboard'
					// For Bypassing redirect in each @controller provides
					&& $controller != 'baseadmin') {

				$message = $param ? str_replace('/', '', $param) : $action;

				if ($this->input->is_ajax_request()) {
					// Send permission message to client
					echo 'You do not have permission to '.$message;
					exit;
				}

				/*
				 * Send permission message to client via session
				 * Set session 'acl_error' if action not accessible for users
				 */

				$this->session->set_flashdata('message', 'You do not have permission to '.$message.'!');
				redirect(ADMIN . $this->controller. '/index');

			}

		}

	}

	/**
	* Checking and load the current controller module menu name
	*
	* @access	public
	* @param	array
	* @return	string
	*/
	public function check_module_menu ($module_menu = '') {

		if (empty($module_menu)) {
			return;
		}
		$menu_name = '';

		// Check if module list is available
		if (!empty($this->module_function_list)) {
			$j=0;
			foreach ($this->module_function_list as $modules => $index) {
				foreach ($index as $key => $value) {
					if( strpos($module_menu, $key) === 0 ) {
						$menu_name = $value;
					}
				}
				$j++;
		    }
		}

		return $menu_name;

	}

}
