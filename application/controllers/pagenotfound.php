<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PageNotFound extends Public_Controller {

	public function __construct() {
		parent::__construct();

		// Load Language list
		$this->load->model('admin/Languages');

		// Load Setting data
		$this->load->model('admin/Settings');

		// Load User related model in admin module
		$this->load->model('page/Pagemenus');

		// Load models
		$this->load->model('newscenter/News');
	}

	public function index() {

		// Set default where condition
		$where_cond = ['type'=>'news','status'=>'publish'];

		// Set data rows
		$data['rows']       = $this->News->findAll($where_cond,'*',['publish_date'=>'DESC'], 0, 10);

		// Set site title page with module menu
		$data['page_title'] = $this->lang->line('404_page');

		// Set main template
		$data['main'] = '404_page';

		// Load site template
		$this->load->view('template/public/template', $this->load->vars($data));

	}

}

/* End of file search.php */
/* Location: ./application/controllers/search.php */
