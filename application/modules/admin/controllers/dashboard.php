<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		
		//Load models
		$this->load->model('Users');
		$this->load->model('member/Members');
		$this->load->model('admin/ContactHistories');		
		$this->load->model('newscenter/News');
		//$this->load->model('violate/Violates');		
		//$this->load->model('violate/Reports');
		
		//Load user permission
		$this->load->model('UserGroupPermissions');
		
		//Put session check in constructor
		$data['user'] = $this->session->userdata('user_session');

	}
	
	public function index() {
	    
		// Check if the request via AJAX
		if ($this->input->is_ajax_request()) {
			$this->stat_dashboard();
			return false;
		}
           
		// Load WYSIHTML JS and other JS
		$data['js_files'] = array(
			base_url('assets/admin/plugins/flot/jquery.flot.min.js'),
			base_url('assets/admin/plugins/flot/jquery.flot.resize.min.js'),
			base_url('assets/admin/plugins/flot/jquery.flot.categories.min.js'),
			base_url('assets/admin/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js'));
		
		// Load WYSIHTML CSS and Others
		$data['css_files'] = array(
			base_url('assets/admin/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css'));
		
		// Load Text Editor execution
		$data['js_inline'] = "Index.initCharts(); // Initialize graph";
		
	    // Total users count
	    $data['tusers']			= $this->Users->getCount(1);

	    // Total members count
	    $data['tmembers']   	= $this->Members->query('SELECT type , count( id ) as count FROM `tbl_members` WHERE status =1 GROUP BY type');
	    
	    // Total contact count
	    $data['tcontacts']   	= $this->ContactHistories->query('SELECT sum( is_replied ) AS replied, sum( is_replied =0 ) AS not_replied FROM `tbl_contact_histories` WHERE `status` =1');
	    
	    // Total news
	    $data['tnews']   		= $this->News->getCount();
	    		
		// Set class name to view
	    $data['class_name']		= '';
	    
	    // Set module with URL request 
		$data['module_title']	= $this->module;

	    // Set page title
	    $data['title']	= "Dashboard Home";
	    
	    // Set main template
	    $data['main']	= 'admin/dashboard';
	    
		// Set admin title page with module menu
		$data['page_title'] = lang($this->module_menu);

	    //$this->load->view('template/dashboard');
	    $this->load->view('template/admin/template', $this->load->vars($data));
		
	}
        
	public function stat_dashboard() {
            
            // Check if the request via AJAX
            if (!$this->input->is_ajax_request()) {
                exit('No direct script access allowed');		
            }
            
            /*
			var visitors = [
					['01/2013', 500],
					['02/2013', 1500],
					['03/2013', 2600],
					['04/2013', 1200],
					['05/2013', 560],
					['06/2013', 2000],
					['07/2013', 2350],
					['08/2013', 1500],
					['09/2013', 4700],
					['10/2013', 1300],
				];
			 * 
			 */
			
			// User login stats
			$login_stats = $this->Users->getLoginStats();
            if(!empty($login_stats)) {
                    
                $temp_login = array();
                foreach ($login_stats as $login) {
                    $temp_login[] = array($login->last_login,$login->total_login);
                }
                $result['result']['stats_login'] = $temp_login;

            }
			
            // Return data esult
            $data['json'] = $result;

            // Load data into view		
            $this->load->view('json', $this->load->vars($data));
	    
	}
}
