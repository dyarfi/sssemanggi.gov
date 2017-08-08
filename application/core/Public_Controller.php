<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Public_Controller extends MY_Controller {

	public $language ='';
    public $languages ='';
    public $menus = '';
    public $member = '';
    public $captcha = '';

    function __construct() {

        parent::__construct();

        // Get libraries from system
		// $this->load->library('Template');
		// $this->load->library('Cart');

		// Load Language Model
		$this->load->model('admin/Languages');

		// Detection mobile device browser
        if( $this->agent->is_mobile() )
        {
            /*
             * Use my template library to set a theme for your staff
             *     http://philsturgeon.co.uk/code/codeigniter-template
             */
            //$this->template->set_theme('mobile');
		} else {
			//$this->template->set_theme('default');
		}

		// Get language session [!! had to set this on top !!]
		if ($this->session->userdata('language') == '') {

			// Set default language from config
			$this->session->unset_userdata('language');

			// Set config to load langauage library
			//$this->config->set_item('language', $this->Languages->getDefaultSiteLanguage()->url); // Get config from database and set to config
			$this->config->set_item('language', 'indonesia'); // Get config from database and set to config

			// Get default language setting set to config item
			$this->session->set_userdata('language', config_item('language'));

		} else {

			// Set config item from session
			$this->config->set_item('language', $this->session->userdata('language'));

		}

		$this->lang->load( array('form_validation','date','label','name','email','upload','module'));

		// Set csrf to true
		// $this->config->set_item('csrf_protection', true); // Get config from database and set to config

		// Load site models
		$this->load->model('admin/Configurations');
		$this->load->model('admin/Settings');
		$this->load->model('admin/ServerLogs');
		$this->load->model('admin/Languages');
		$this->load->model('Captcha');
		$this->load->model('region/Provinces');
		// Set site Page Menus Model
		$this->load->model('page/PageGroups');
		$this->load->model('page/PageMenus');
		$this->load->model('page/PageSocmeds');
		// Set site Page Model
		$this->load->model('product/Products');
		// Set site Page Model
		$this->load->model('page/Pages');
		// Set site Page Templates
		$this->load->model('page/Templates');

      	// Set site status on maintencance or default
		self::getSiteStatus();

		// Set site user access logs
		//self::setAccessLog(1);

		// Throw a maintenance view
		if($this->config->item('site_open') === FALSE) {

			$this->output->set_status_header('503','Site is maintenance');
			show_error(['header'=>'','message'=>$this->Settings->getByParameter('maintenance_template')->value], 503);
			exit;

        }

		// Set meta description
		$this->site_description	= $this->Settings->getByParameter('site_description')->value;

		// Set meta keyword
		$this->site_keywords	= @$this->Settings->getByParameter('site_keywords')->value;

		// Set meta name
		$this->site_name		= @$this->Settings->getByParameter('site_name')->value;

		// Set site logo
        $this->logo     		= $this->Settings->getByParameter('site_logo');

        // Set small site logo
        $this->small_logo		= $this->Settings->getByParameter('site_logo_admin');

        // Set Language list
		$this->languages		= $this->Languages->getAllLanguage(['status'=>'1']);

		// Set menu groups
		$this->menu_groups		= $this->PageGroups->getAllMenuByGroups();

        // Set menus
		$this->menus       		= $this->PageMenus->getPagesGroupByType();

		// Set social media menus
		$this->socials       	= array_filter($this->PageSocmeds->getSocmedsByType());

		// Set pages on corporate
        $this->corporates		= $this->Pages->get_many_by(['status'=>'publish','menu_id'=>25]);

 		// Set pages on marines
        $this->products			= $this->PageMenus->get_many_by(['status'=>'publish','type'=>'product', 'name !='=>'pricelist']);

		// Set automobiles
        $this->automobiles		= $this->Products->findAll(['status'=>'publish','type'=>'automobile'],'subject',['subject'=>'ASC']);

		// Set pages on marines
        $this->provinces		= $this->Provinces->getAllProvince();

        // Set member from sessions
        $this->member			= $this->session->userdata('member_session');

        // Set Captcha image
        $this->captcha 			= $this->Captcha->image();

		// Set chat mode
		$this->chat				= $this->Configurations->getConfiguration_ByParam('chat');

		// Set menus
		//$this->menus_bottom	= $this->Content->find('page_menus',['url !='=>'home','type !='=>'','position IN'=>['bottom','top_bottom'],'status'=>'publish'],['id'=>'asc'],15);

        // Set social media links
        $this->twitter     = $this->Settings->getByParameter('socmed_twitter');
        $this->facebook    = $this->Settings->getByParameter('socmed_facebook');
        $this->youtube     = $this->Settings->getByParameter('socmed_youtube');
        // Contact information
        $this->email_info  = $this->Settings->getByParameter('email_info');
        $this->ext_link	   = $this->Settings->getByParameter('ext_link');
        $this->ext_logo	   = $this->Settings->getByParameter('ext_link_logo');
        $this->title_name  = $this->Settings->getByParameter('title_name');
        $this->gmap  	   = $this->Settings->getByParameter('contactus_gmap');
        $this->copyright    = $this->Settings->getByParameter('copyright');
        $this->ga_analytics = $this->Settings->getByParameter('google_analytics');
        $this->contactus_address = $this->Settings->getByParameter('contactus_address');
        $this->site_video = @$this->Settings->getByParameter('site_video_url');
        $this->site_video_cover = @$this->Settings->getByParameter('site_video_cover');

		// Google map parse array
		parse_str(parse_url($this->gmap->value,PHP_URL_QUERY),$this->map);

    }

	public function clean_tags($text = '', $limit = '150', $end = ''){

		// Strip html from text
		$_text = strip_tags($text);
		// Return cleaned text limiter
		return trim(character_limiter(preg_replace('/(\n\s)/', '', strip_tags($_text)),$limit,$end));

	}

	protected function getSiteStatus() {

		// Get value from tbl_configurations for maintenance
		if ($this->Configurations->getConfiguration_ByParam('maintenance')) {

			// Set config value for default
			$this->config->set_item('site_open', FALSE);

		}

	}

	protected function setAccessLog($public='') {

        // Set site session id
        $this->session_id = $this->session->userdata('session_id');

		// Set user agents and platform
		$user_agents['user_agent']	= $this->agent->agent;
		$user_agents['platform']	= $this->agent->platform;
		$user_agents['browser']		= $this->agent->browser;
        $ip_address = $this->input->ip_address();
        $referrer	= (strpos($this->agent->referrer(),base_url())) ? '' : $this->agent->referrer();

		if ($public) {
			// Set ServerLog data
			$object = array(
				'session_id'	=> $this->session_id,
				'url'			=> base_url(uri_string()),
				'user_id'		=> @$object['user_id'],
				'status_code'	=> $status_code[http_response_code()],
				'bytes_served'	=> @$object['bytes_served'],
				'total_time'	=> $this->benchmark->marker['total_execution_time_start'],
				'ip_address'	=> $ip_address,
				'geolocation'	=> '',
				'http_code'		=> http_response_code(),
				'referrer'		=> $referrer,
				'user_agent'	=> json_encode($user_agents),
				'is_mobile'		=> $this->agent->is_mobile,
				'status'		=> 1,
				'added'			=> time()
			);
		}

		// Set value for ServerLogs
		$this->ServerLogs->setServerLog($object);
	}

}
