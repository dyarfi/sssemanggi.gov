<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_Page extends Public_Controller {

	public function __construct() {
		parent::__construct();	

	}
    
    public function index($url='', $lang='') {
    	
    	// Set detail 
        $detail = $this->Content->findIdByUrl('page_menus', $url, $lang);

        // Set pages data
		$data['pages'] = $this->Content->find('pages',['menu_id'=>$detail->field_id,'status'=>'publish'],['added'=>'ASC'],500);

		// Set pages data
		$data['page_detail'] = $this->Content->findIdByUrl('pages', $url, $lang);
		
		//print_r($detail);
	  	// Set data from page menus
        $data['detail'] = $detail;
        
        // Set data from page menus
        $data['upload_path'] = 'uploads/pagemenus/';
                
        // Set main template
		$data['main']       = 'page';
        
		// Set site title page with module menu
		$data['page_title'] =  lang('page') . ($detail->subject ? ' - '.$detail->subject : '');
		
		// Set meta description for html tags in template
		$this->meta_description = $this->clean_tags($detail->text);
		
		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));
		
	}

	public function detail($url='') {
    	
    	// Set detail 
        $data['detail'] = $this->Pages->getPageByUrl($url);

        // Set pages data
		$data['pages'] = $this->Content->find('pages',['menu_id'=>$detail->field_id,'status'=>'publish'],['added'=>'ASC'],500);
	
		// Set pages data
		$data['page_detail'] = $this->Content->findIdByUrl('pages', $url, $lang);
		        
        // Set data from page menus
        $data['upload_path'] = 'uploads/pagemenus/';
                
        // Set main template
		$data['main']       = 'page_detail';
        
		// Set site title page with module menu
		$data['page_title'] =  lang('page') . ($field->subject ? ' - '.$field->subject : '');
		
		// Set meta description for html tags in template
		$this->meta_description = $this->clean_tags($field->text);
		
		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));
		
	}

	public function post($url='', $url_detail='', $lang='') {

		// Set Page Menu for Business Category /*** id = 3 ***/
    	$detail = $this->Content->findIdByUrl('page_menus',$this->uri->segment(2),$lang);
    	
    	// Set menu page data
        $data['detail']				= $detail;
       
      	// Set pages data
		$data['pages'] = $this->Content->find('pages',['menu_id'=>$detail->field_id,'status'=>'publish'],['added'=>'ASC'],500);
	
		// Set pages data
		$page_detail   = $this->Content->findIdByUrl('pages', $url_detail, $lang);
		$data['page_detail'] = $page_detail;

        // Set data from page menus
        $data['upload_path'] = 'uploads/pagemenus/';

        // Set main template
		$data['main']        = 'page_detail';
        
		// Set site title page with module menu
		$data['page_title']  = $detail->subject . ($page_detail->subject ? ' - '.$page_detail->subject : '');
		
		// Set meta description for html tags in template
		// $this->meta_description 	= $this->clean_tags();
		
		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));
  	}
}

/* End of file site_page.php */
/* Location: ./application/controllers/site_page.php */