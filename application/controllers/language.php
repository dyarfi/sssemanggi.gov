<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language extends Public_Controller {

	public function __construct() {
		parent::__construct();
		
		// Load language related model in admin module
		$this->load->model('admin/Languages');
					
	}
	
	public function index() {
		
		// Set default empty language before change
		$language = '';
		
		// Check if the url has a parameter
		if($this->uri->segment(2) != '') {
			$language = $this->uri->segment(2);
		}
		
		return $this->Languages->setSiteLanguage($language);
		
	}

	public function lang($lang='') {
						
		// Set default empty language before change
		$language = '';
		
		// Check if the url has a parameter
		if($this->uri->segment(1) != ''){
			$language = $this->uri->segment(1);
		}
		
		return $this->Languages->setSiteLanguage($language);

	}
}

/* End of file language.php */
/* Location: ./application/controllers/language.php */