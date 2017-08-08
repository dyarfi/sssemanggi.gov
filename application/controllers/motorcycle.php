<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Motorcycle extends Public_Controller {

	public function __construct() {
		parent::__construct();
		// load models
		$this->load->model('product/Products');
		$this->load->model('product/ProductColors');
		$this->load->model('product/ProductServices');
		$this->load->model('product/ProductVariants');
		// load models
		$this->load->model('product/ProductCategories');
	}

    public function index() {

		// Set data from page menus and page
        $data['upload_path_motorcycle'] = 'uploads/motorcycle/';

        // Set categories
		$data['categories'] = $this->ProductCategories->findAll(['status'=>'publish','type'=>'motorcycle'],['subject','url'],['subject'=>'DESC']);

		// Set main template
		$data['motorcycles'] = $this->Products->with('category')->findAll(['status'=>'publish','type'=>'motorcycle'],['category_id','subject','url','cover','thumbnail','media'],['priority'=>'DESC']);

        // Set main template
		$data['main']       = 'motorcycle';

		// Set site title page with module menu
		$data['page_title'] =  lang('Motorcycle') . ($detail->subject ? ' - '.$detail->subject : '');

		// Set meta description for html tags in template
		$this->meta_description = $this->clean_tags($detail->text);

		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));

	}

	public function detail($url='') {

        // Set data from page menus
        $detail  		= $this->Products->with('variant')->with('accessory')->findBy('url', $url);
        $data['detail'] = $detail;

        // Set main template
		$data['main']       = 'motorcycle_detail';

		// Set site title page with module menu
		$data['page_title'] =  lang('Motorcycle') . ($detail->subject ? ' - '.$detail->subject : '');

		// Set meta description for html tags in template
		$this->meta_description = $this->clean_tags($field->text);

		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));

	}

}

/* End of file site_page.php */
/* Location: ./application/controllers/site_page.php */
