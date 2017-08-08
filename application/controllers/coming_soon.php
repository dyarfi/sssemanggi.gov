<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coming_Soon extends Ci_Controller {

	public function __construct() {
		parent::__construct();
	
	}
	
	public function index() {
		
		// Set main template
		$data['main'] = 'coming_soon';
		
		// Load site template
		$this->load->view('template/public/blank', $this->load->vars($data));		
		
	}

}

/* End of file coming_soon.php */
/* Location: ./application/controllers/coming_soon.php */