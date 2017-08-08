<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_Tips extends Public_Controller {

	public function __construct() {
		parent::__construct();		
		
		// Load models
		$this->load->model('newscenter/News');
		$this->load->model('service/Tips');
		
	}
    
    public function index() {    	
		        	        
        // Set news with dealer data
        $data['rows']         = $this->Tips->find_all(['sts_status'=>'publish'], '*', ['sts_id'=>'ASC']);
        
     	// Set others
        $data['other_news'] = $this->News->find_all(['status'=>'publish','type'=>'news'], '*', ['publish_date'=>'DESC'], $start, 10);

        // Set main template
		$data['main']       = 'tips';
        
		// Set site title page with module menu
		$data['page_title'] =  'Tips dan Trik';//lang('Tips');
		
		// Set meta description for html tags in template
		$this->meta_description = '';//$this->clean_tags($detail->text);
		
		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));
		
	}

	public function detail($url='') {
    	// Set detail 
    	$row = $this->Tips->findBy('sts_url',$url);
    	
    	$data['row'] = $row;

        // Set viewed item
    	$this->News->count_view($row->id);

        // Set others
        $data['other_news'] = $this->News->find_all(['status'=>'publish','type'=>'news'], '*', ['publish_date'=>'DESC'], $start, 10);

        // Set data from page menus
        $data['upload_path'] = 'uploads/news/';
                
        // Set main template
		$data['main']       = 'tips_detail';
        
		// Set site title page with module menu
		$data['page_title'] =  lang('Promo') . ($row->subject ? ' - '.$row->subject : '');
		
		// Set meta description for html tags in template
		$this->meta_description = $this->clean_tags($row->text);
		
		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));
		
	}
}

/* End of file site_page.php */
/* Location: ./application/controllers/site_page.php */