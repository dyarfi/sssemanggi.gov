<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Corporate extends Public_Controller {

	public function __construct() {
		parent::__construct();		
		
		// Load models
		$this->load->model('newscenter/News');

	}
    
    public function index() {    	
    	
		// Set data from page menus and page
        $data['upload_path_menu'] = 'uploads/pagemenus/';     
        $data['upload_path'] = 'uploads/pages/';        
                
        // Set main template
		$data['main']       = 'automobile';
        
		// Set site title page with module menu
		$data['page_title'] =  lang('page') . ($detail->subject ? ' - '.$detail->subject : '');
		
		// Set meta description for html tags in template
		$this->meta_description = $this->clean_tags($detail->text);
		
		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));
		
	}

	public function detail($url='') {
		
		$layout = ($url == 'tentang-gear') ? 'gear' : 'detail';

    	// Set detail 
        $data['detail'] = $this->Pages->getPageByUrl($url);
                
        // Set main template
		$data['main']       = 'page_'.$layout;
        
		// Set site title page with module menu
		$data['page_title'] =  lang('page') . (@$field->subject ? ' - '.@$field->subject : '');
		
		// Set meta description for html tags in template
		//$this->meta_description = $this->clean_tags($field->text);
		
		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));
		
	}

	public function lists($type='') {
        
        // Set detail 
        $detail = $this->Pages->getPageByName('page-'.$type);
        $data['detail']	= $detail;
        
        // Set rows data
		$data['rows'] = ($type == 'csr') ? $this->News->find_all_by('type','csr', '*', ['publish_date'=>'desc']) : $this->Templates->getTemplateByType($type);        
        
        // Set main template
		$data['main'] = 'page_'.$type;

		// Set site title page with module menu
		$data['page_title'] =  lang('Page') .' - '. $detail->subject;
		
		// Set meta description for html tags in template
		$this->meta_description = $this->clean_tags($detail->text,120);
		
		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));
		
	}

	public function post($type='', $url='') {
		
		// Set page detail 
		$detail = ($type == 'csr') ? $this->News->getNewsByUrl($url) : $this->Templates->getTemplateByUrl($type, $url);
        $data['detail']	= $detail;
       	
        // Set data from page menus
        $data['upload_path'] = 'uploads/pagemenus/';

        // Set main template
		$data['main']               = 'page_csractivity_detail';
        
		// Set site title page with module menu
		$data['page_title'] 		= $detail->subject . ($page_detail->subject ? ' - '.$page_detail->subject : '');
		
		// Set meta description for html tags in template
		// $this->meta_description 	= $this->clean_tags();
		
		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));
  	}
}

/* End of file site_page.php */
/* Location: ./application/controllers/site_page.php */