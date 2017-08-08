<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Class for Authenticate used for user login
class Authenticate extends CI_Controller {

	public function __construct() {
	    parent::__construct();

		// Set default language to English
		$this->config->set_item('language','english');

		// Load language variables
		$this->lang->load( array('module','form_validation','label','name','upload','email'));

	    // Load user, profile, groups and group permissions models
	    $this->load->model('Users');
	    $this->load->model('UserProfiles');
	    $this->load->model('UserGroups');
	    $this->load->model('UserGroupPermissions');

	    // Load ModuleLists, ModelLists and ModulePermissions models
	    $this->load->model('ModuleLists');
	    $this->load->model('ModelLists');
	    $this->load->model('ModulePermissions');

	    // Load Configurations, UserHistories and Captcha
	    $this->load->model('Configurations');
	    $this->load->model('UserHistories');
	    $this->load->model('Captcha');
		$this->load->model('Sessions');

        // Load Admin config
		$this->configs = $this->load->config('admin/admin',true);

	}

    public function index () {

        // Check if already login
        self::login();

    }

	public function login () {

        // User login checking
        self::log_check();

	    // POST checking
	    if($_SERVER['REQUEST_METHOD'] === 'POST'){

		    $userObj = $_POST;

		    $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[24]|xss_clean');
		    $this->form_validation->set_rules('password', 'Password','trim|required|min_length[5]|max_length[24]|xss_clean');
			$this->form_validation->set_rules('captcha', 'Captcha', 'trim|xss_clean|max_length[6]|callback_match_captcha');

			// Validation form checks
			if ($this->form_validation->run() == FALSE)
			{
				// Set error fields
				$error = array();
				foreach(array_keys($fields) as $error) {
					$errors[$error] = form_error($error);
				}

				// Set previous post merge to default
				$fields = array_merge($fields, $this->input->post());
			}
			else
			{

			    //Make sure login object was true
			    if($userObj['username'] == '' OR $userObj['password'] == '') {
				//return false;

			    }
			    //Check if already logged in
			    if($this->session->userdata('username') == $userObj['username']) {
				//User is already logged in.
				//return false;

			    }

			    // Initialize install
			    $this->Users->install();
			    $this->UserGroups->install();
				$this->ModuleLists->install();
			    $this->ModelLists->install();
			    $this->Configurations->install();
				$this->Captcha->install();
				$this->Sessions->install();

			    //Check User login info
			    $user	= $this->Users->login($userObj);

			    // User data checking
			    if(!empty($user)) {

				    // Set return default
				    $return	    = '';

				    if ($user == 'disabled') {
						// Set flash message to disabled account
						$this->session->set_flashdata('flashdata', 'Your account is disabled!');
						// Redirect to login
						redirect(ADMIN.'authenticate/login');
				    }

				    // Check User Level from User ID given
				    $user_group = $this->UserGroups->getUserGroup($user->group_id);

				    // Checking for full backend access
				    if (intval($user_group->full_backend_access) === 1) {
						// Checking module access for ADMINISTRATOR Level
						$this->ModuleLists->module_check();
				    }

				    // Get module list by user
				    $module_list	= $this->ModuleLists->getModules($user->group_id);

				    // Get function list by user
				    $function_list	= $this->UserGroupPermissions->getModuleFunction($user->group_id);

				    $user_session->id = $user->id;
				    $user_session->username = $user->username;
				    $user_session->email = $user->email;
				    $user_session->group_id = $user->group_id;
				    $user_session->status = $user->status;
				    $user_session->last_login = $user->last_login;
				    $user_session->logged_in = true;
				    $user_session->name = $this->UserProfiles->getName($user->id);

				    $ci_session = array(
					    'module_list'		=> json_encode($module_list),
					    'module_function_list'	=> json_encode($function_list),
					    'user_session'		=> $user_session,
				    );

				    //Set session data
				    $this->session->set_userdata($ci_session);

				    // Redirect to dashboard
					redirect(ADMIN.'dashboard/index?active=current');

			    } else {

				    $userObj = 'No user with that account';
				    $this->session->set_flashdata('flashdata', $userObj);

				    redirect(ADMIN.'authenticate/login');
			    }
			}
	    }

		// Captcha data
	   $data['captcha']	= $this->Captcha->image();

       // Set error data to view
       $data['errors']     = $errors;

	    // Load js for administrator login
		$data['js_files'] = array(base_url('assets/admin/scripts/custom/login-soft.js'));

		// Load CSS for the template
		$data['css_files'] = array(base_url('assets/admin/css/pages/login-soft.css'));

		// Load JS execution
		$data['js_inline'] = "Login.init();
		$('.reload_captcha').on('click',function() {
	        var url = $(this).attr('rel');
	        $.ajax({
	            type: \"POST\",
	            url: url,
	            //cache: false,
	            //async: true,
	            success: function(msg){
	                $('.reload_captcha').empty().html(msg);
	                // Need random for browser recache
	                img = $('.reload_captcha').find('img');
	                src = img.attr('src');
	                ran = img.fadeOut(50).fadeIn(50).attr('src', src + '?=' + Math.random());
	            },
	            complete: function(msg) {},
	            error: function(msg) {}
	        });
	        return false;
	    });";

		// Set main template
	    $data['main']	= 'admin/login';

	    // Load admin template
	    $this->load->view('template/admin/login', $this->load->vars($data));
	}

	public function logout() {

		// Set user's last login
	    $this->Users->setLastLogin(@$this->acl->user()->id);

	    // Destroy user session
	    $this->session->sess_destroy();

	    // Redirect admin to refresh
	    redirect(ADMIN.'authenticate');

    }

	/**
	 * up +++++++ SETUP FIRST MIGRATION ++++++++
	 */
	public function up()
	{

		 // Set default db
	    $this->db = $this->load->database('default', true);

	    $sql = "SHOW TABLES;";

		print_r( $this->db->query($sql)->result() );
	}


	/**
	 * up +++++++ SETUP FIRST MIGRATION ++++++++
	 */
	public function util()
	{

		// Load the DB utility class
		$this->load->dbutil();

		// Backup your entire database and assign it to a variable
		$prefs = array(
                'format'      => 'zip',             // gzip, zip, txt
                'filename'    => 'backup-'.date('d-m-y-h-m-s').'.sql',    // File name - NEEDED ONLY WITH ZIP FILES
                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                'newline'     => "\n"               // Newline character used in backup file
              );
		$backup =& $this->dbutil->backup($prefs);

		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file(FCPATH.'tmp/backup-'.date('d-m-y-h-m-s').'.zip', $backup);

		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('backup-'.date('d-m-y-h-m-s').'.zip', $backup);

	}


    private function log_check ($session='') {

        // Check if user is logged in or not
	    if (@$this->session->userdata('user_session')->id != '') {
            /** Redirect to dashboards **/
			redirect(str_replace('{admin_id}', $this->session->userdata('user_session')->id, $this->configs['default_page']));
	    }

    }

	// Match Captcha post to Database
    public function match_captcha($captcha) {

        // Check captcha if empty
        if ($captcha == '') {
            $this->form_validation->set_message('match_captcha', lang('required'));
            return false;
        }
        // Check captcha if match
        else if (!$this->Captcha->match($captcha)) {
            $this->form_validation->set_message('match_captcha', lang('regex_match'));
            return false;
        } else {
            return true;
        }
    }

}
