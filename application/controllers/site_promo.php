<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_Promo extends Public_Controller {

	public function __construct() {
		parent::__construct();		
		
		// Load models
		$this->load->model('newscenter/News');
		
	}
    
    public function index() {    	

		// Set data from page menus and page
        $data['upload_path_menu'] = 'uploads/pagemenus/';     
        $data['upload_path'] = 'uploads/pages/';        
                	
        // Set data rows
        $data['rows']       = $this->News->findAllBy('type','promo','*',['publish_date'=>'DESC']);
        
     	// Set others
        $data['other_news'] = $this->News->find_all(['status'=>'publish'], '*', ['publish_date'=>'DESC'], $start, 10);

        // Set main template
		$data['main']       = 'promo';
        
		// Set site title page with module menu
		$data['page_title'] =  lang('Promo') . ($detail->subject ? ' - '.$detail->subject : '');
		
		// Set meta description for html tags in template
		$this->meta_description = $this->clean_tags($detail->text);
		
		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));
		
	}

	public function detail($url='') {
    	
    	// Set detail 
    	$row = $this->News->getNewsByUrl($url);
        $data['row'] = $row;

        // Set viewed item
    	$this->News->count_view($row->id);

        // Set others
        $data['other_news'] = $this->News->find_all(['status'=>'publish','id !=' =>$row->id], '*', ['publish_date'=>'DESC'], $start, 10);

        // Set data from page menus
        $data['upload_path'] = 'uploads/news/';
                
        // Set main template
		$data['main']       = 'promo_detail';
        
		// Set site title page with module menu
		$data['page_title'] =  lang('Promo') . ($row->subject ? ' - '.$row->subject : '');
		
		// Set meta description for html tags in template
		$this->meta_description = $this->clean_tags($row->text);
		
		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));
		
	}

	public function post($type='', $url='') {
		
		// Set page detail 
		$detail = $this->Templates->getTemplateByUrl($type, $url);
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