<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_Home extends Public_Controller {

	public function __construct() {
		parent::__construct();

		// Load Setting data
		$this->load->model('admin/Settings');
		
		// Load User related model in admin module
		$this->load->model('page/Pagemenus');
        
        // Load Models
        $this->load->model('banner/Banners');

	}
	
	public function index() {
        
		// Set site title page with module menu
		$data['page_title'] = 'Suzuki Indonesia';
		
		// Set facebook link data
		$data['facebook']	= $this->Settings->getByParameter('socmed_facebook');
				
		// Set twitter link data
		$data['twitter']	= $this->Settings->getByParameter('socmed_twitter');
		
		// Set google link data
		$data['google']		= $this->Settings->getByParameter('socmed_gplus');
		
		// Set contact email info data
		$data['email_info']	= $this->Settings->getByParameter('email_info');		
		
		// Set contactus address info data
		$data['contactus_address']	= $this->Settings->getByParameter('contactus_address');		

		// Set contactus address info data
		$data['banners']	= $this->Banners->findAllBy('status','publish','*',['priority'=>'ASC']);				

		// Set data for js files
		//$data['js_files_ext'] = array('https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false');

		// Set data for js files
		//$data['css_files_ext'] = array(base_url("assets/public/css/jquery.bxslider.css"));

		// Load Text Editor execution
		//$data['js_inline'] = "";

		// Set main template
		$data['main'] = 'home';
		
		// Load site template
		$this->load->view('template/public/template_home', $this->load->vars($data));		
		
	}
	
}

/* End of file site_home.php */
/* Location: ./application/controllers/site_home.php */