<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_News extends Public_Controller {

	public $time_filter = '';
	public $tags_filter = '';

	public function __construct() {
		parent::__construct();

		// Load models
		$this->load->model('newscenter/News');

		// set_cookie('news_id',[1,2,3,4]);
		$this->load->helper('cookie');

		// Month or Year Filtering
		//$month = 48;
		//$time_filter = array();
		//for ($m = 1; $m < $month; $m++ ) {
			//$time_filter[$m] = date('F Y', mktime(0,0,0,-($m + 1),0,date('Y')));
		//}
		for ($y = 0; $y < 7; $y++ ) {
			$time = new DateTime('now');
			$this->time_filter[$y] = $time->modify('-'.$y.' year')->format('Y');
			//$this->date_filter[$y] = $time->modify('+ 2 days')->format('d/m/Y');
		}

		$this->tags_filter = ['Suzuki','Automobile','Motorcycle','Marine'];

		//print_r($this->date_filter);

	}

    public function index($filter="",$value="") {

    	// Set default where condition
    	$where_cond = ['type'=>'news','status'=>'publish'];

    	// Get filter parameter from url
    	$filter_year = ($filter == 'year') ? $value : '';
    	$filter_cats = ($filter == 'tags') ? $value : '';

		// Add params
		if ($filter_year) {
			$filter1 	= date('Y-m-d', mktime(0, 0, 0, 1, 1, $filter_year));
			$filter2 	= date('Y-m-d', mktime(0, 0, 0, 12, 31, $filter_year));
			$where_filter = array('publish_date >=' => $filter1, 'publish_date <' => $filter2);
			$where_cond = array_merge($where_cond,$where_filter);
		}

		if ($filter_cats) {
			$where_cond = array_merge($where_cond,['tags'=>$filter_cats]);
		}

		if($this->uri->segment(2) == 'filter') {

			$url_link = 'news/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/?';
		} else {
			$url_link = 'news/?';
		}

		// Pagination options
		$config['base_url'] = base_url($url_link);//.http_build_query($params);
		$config['total_rows'] = $this->News->findCount($where_cond);
		$config['per_page'] = 10;
		$config['enable_query_strings'] = TRUE;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'p';
		// $config['use_page_numbers'] = TRUE;
		$config['display_pages'] = TRUE;
		$config['prev_link'] = '&lt;';
		$config['next_link'] = '&gt;';
		$config['first_link'] = '&lt;&lt;';
		$config['last_link'] = '&gt;&gt;';

		// Pagination html tags
		$config['full_tag_open'] = '<div><ul class="pagination pagination-small pagination-centered">';
		$config['full_tag_close'] = '</ul></div>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li><a class='inactive' href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = '<li class="next">';
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";

		// Pagination initialize
		$this->pagination->initialize($config);
		$page = ($this->input->get('p')) ? $this->input->get('p') : 0;
		$links = $this->pagination->create_links();

		// Set pagination links
		$data['links'] 		= $links;

    	// Set data from page menus and page
        $data['upload_path_menu'] = 'uploads/pagemenus/';
        $data['upload_path'] = 'uploads/pages/';

        // Set data rows
        $data['rows']       = $this->News->findAll($where_cond,'*',['publish_date'=>'DESC'], $page, $config["per_page"]);

     	// Set detail
        $data['other_news'] = $this->News->findAll(['status'=>'publish'], '*', $order, $start, 2);

        // Set time filter
		$data['time_filter']       = $this->time_filter;

		// Tags filtering
		$data['tags_filter']       = $this->tags_filter;

		// Selected filter
		$data['filter_year'] 	= $filter_year;
    	$data['filter_cats']  	= $filter_cats;

        // Set main template
		$data['main']       = 'news';

		// Load js in controller
        //$data['js_files_ext'] = array(
            //base_url('assets/public/js/libs/jquery.ias.min.js')
        //);

		// Set js inline
		//$data['js_inline']	= '';

		// Set site title page with module menu
		$data['page_title'] =  lang('News') . ($detail->subject ? ' - '.$detail->subject : '');

		// Set meta description for html tags in template
		$this->meta_description = $this->clean_tags($detail->text);

		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));

	}

	public function detail($url='') {

    	// Set detail
    	// $row = $this->News->getNewsByUrl($url);
    	$row = $this->News->find_by('url', $url);
    	$data['row'] = $row;

    	// Set viewed item
    	$this->News->count_view($row->id);

     	// Set others
        $data['other_news'] = $this->News->find_all(['status'=>'publish','type'=>'news','id !=' =>$row->id], '*', ['publish_date'=>'DESC'], $start, 10);

        // Set data from page menus
        $data['upload_path'] = 'uploads/news/';

        // Set main template
		$data['main']       = 'news_detail';

		// Set site title page with module menu
		$data['page_title'] =  lang('News') . ($row->subject ? ' - '.$row->subject : '');

		// Set meta description for html tags in template
		$this->meta_description = $this->clean_tags($row->text);

		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));

	}


	public function lists($filter='') {

		// Get filter parameter from url
		$params_add = '';
		if ($filter != '' && $filter != 'index') {
			$params		= $this->uri->segment(3);
			$filter1 	= date('Y-m-d', mktime(0, 0, 0, 1, 1, $filter));
			$filter2 	= date('Y-m-d', mktime(0, 0, 0, 12, 31, $filter));
			$params_add = (($filter != 'index') ? "{$filter}/" : '');
			$where_filter = array('publish_date >=' => $filter1, 'publish_date <' => $filter2);
		} else {
			$params		= $this->uri->segment(2);
		}

		print_r($where_filter);
		exit;
	}


	/*
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
  	*/
}

/* End of file site_page.php */
/* Location: ./application/controllers/site_page.php */
