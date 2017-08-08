<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Automobile extends Public_Controller {

	public function __construct() {
		parent::__construct();

		// load models
		$this->load->model('product/Products');
		$this->load->model('product/ProductColors');
		$this->load->model('product/ProductVariants');
		$this->load->model('product/ProductServices');
		// load models
		$this->load->model('product/ProductCategories');
	}

    public function index() {

		// Set data from page menus and page
        $data['upload_path_automobile'] = 'uploads/automobile/';

        // Set categories
		$data['categories'] = $this->ProductCategories->findAll(['status'=>'publish','type'=>'automobile'],['subject','url'],['subject'=>'DESC']);

		// Set main template
		$data['automobiles'] = $this->Products->with('category')->findAll(['status'=>'publish','type'=>'automobile'],['category_id','subject','url','cover','thumbnail','media'],['priority'=>'DESC']);

        // Set main template
		$data['main']       = 'automobile';

		// Set site title page with module menu
		$data['page_title'] = lang('Automobile') . ($detail->subject ? ' - '.$detail->subject : '');

		// Load JS execution
        $data['js_inline'] 	= 'window.setTimeout( function(){ $(".planner-btn").click(); }, 3000);';

		// Set meta description for html tags in template
		$this->meta_description = $this->clean_tags($detail->text);

		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));

	}

	public function detail($url='') {

        // Set data from page menus
        $detail  		= $this->Products->with('accessory')->findBy('url', $url);
        $data['detail'] = $detail;

        // Set main template
		$data['main']       = 'automobile_detail';

		// Set site title page with module menu
		$data['page_title'] =  lang('Automobile') . ($detail->subject ? ' - '.$detail->subject : '');

		// Set meta description for html tags in template
		$this->meta_description = $this->clean_tags($field->text);

		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));

	}

}

/* End of file site_page.php */
/* Location: ./application/controllers/site_page.php */
