<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pricelist extends Public_Controller {

	public function __construct() {
		parent::__construct();

		// load models
		$this->load->model('product/Products');
		$this->load->model('product/ProductGroups');
		// load models
		$this->load->model('product/ProductCategories');
		//print_r($this->ProductGroups->getProductGroupForPricelist('automobile'));
		//exit;
		//print_r($this->ProductGroups->getProductGroupForPricelist('marine'));
		//exit;
	}

    public function index() {

		// Set data from page menus and page
        $data['upload_path_menu'] = 'uploads/pagemenus/';
        $data['upload_path'] = 'uploads/pages/';

        // Set main template
		$data['main']       = 'pricelist';

		// Set site title page with module menu
		$data['page_title'] =  lang('page') . ($detail->subject ? ' - '.$detail->subject : '');

		// Set meta description for html tags in template
		$this->meta_description = $this->clean_tags($detail->text);

		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));

	}

	public function model() {

			// Set data from product price
			//$data['automobile_price'] 	= $this->Products->with('model')->findAll(['status'=>'publish','type'=>'automobile'],'*',['subject'=>'ASC']);
			$data['automobile_price']	= $this->ProductGroups->getProductGroupForPricelist('automobile');
			$data['motorcycle_price'] 	= $this->Products->with('model')->findAll(['status'=>'publish','type'=>'motorcycle','is_pricelist'=>1],'*',['subject'=>'ASC']);
			//$data['marine_price'] 		= $this->Products->with('model')->findAll(['status'=>'publish','type'=>'marine'],'*',['subject'=>'ASC']);
			$data['marine_price'] 		= $this->ProductGroups->getProductGroupForPricelist('marine');
			//print_r($data['marine_price']);
			//exit;

			// Set data from page menus and page
	        $data['upload_path_menu'] = 'uploads/pagemenus/';
	        $data['upload_path'] = 'uploads/pages/';

	        // Set main template
			$data['main']       = 'pricelist_model';

	 		// Set site title page with module menu
	 		$data['page_title'] =  lang('page') . ($detail->subject ? ' - '.$detail->subject : '');

	 		// Set meta description for html tags in template
	 		$this->meta_description = $this->clean_tags($detail->text);

	 		// Load admin template
	 		$this->load->view('template/public/template', $this->load->vars($data));
 	}

	public function detail_page($type='', $url='', $lang='') {

    	// Set detail
        $detail = $this->Content->findIdByUrl('page_menus', $type, $lang);

        // Set pages data
		$data['pages'] = $this->Content->find('pages',['menu_id'=>$detail->field_id,'status'=>'publish'],['added'=>'ASC'],500);

		// Set pages data
		$data['page_detail'] = $this->Content->findIdByUrl('pages', $url, $lang);

        // Set data from page menus
        $data['detail'] = $detail;

        // Set data from page menus
        $data['upload_path'] = 'uploads/pagemenus/';

        // Set main template
		$data['main']       = 'page';

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
		$data['main']               = 'page_detail';

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
