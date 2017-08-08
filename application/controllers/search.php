<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends Public_Controller {

	public function __construct() {
		parent::__construct();
			
		// Load Language list
		$this->load->model('admin/Languages');

		// Load Setting data
		$this->load->model('admin/Settings');
		
		// Load User related model in admin module
		$this->load->model('page/Pagemenus');
        
        // Load Product Models
        //$this->load->model('product/ProductCategories');
		//$this->load->model('product/Products');
        //$this->load->model('product/ProductImages');

        $this->load->library('pagination');

	}
	
	public function index($keyword='') {
		
		// Keyword from post from URL	
		if ($keyword = $this->input->post('search')) {
			// Redirest url base to search page
			redirect(base_url('search/'.$this->security->xss_clean($keyword)));
		}
		// Search URL page 
		$search     = $this->uri->segment(2) == '' ? lang('no_search') : urldecode($this->uri->segment(2));

		// Table for search queries in the tables
		$return['products'] = $this->db->like('subject',$search)->or_like('text',$search)->where('status','publish')->get('products')->result();
		$return['news']		= $this->db->like('subject',$search)->or_like('text',$search)->where('status','publish')->get('news')->result();

		//$return['service_education'] = $this->db->query('business_categories')->get('service_education');
		//$return['service_product_static'] = $this->db->query('business_categories')->get('service_product_static');
		//$return['service_static_content'] = $this->db->query('business_categories')->get('service_static_content');
		//$return['service_tips'] = $this->db->query('business_categories')->get('service_tips');
		//$return['service_vehicle'] 	= $this->db->query('business_categories')->get('service_vehicle');
						
		// Define temp data
		$search_var = array();
		$i = 0;
		$url_base = base_url();
		foreach ($return['products'] as $products) {
			if(!empty($products)) {
				$search_var[$i]['url'] = base_url($products->type.'/'.$products->url);
				$search_var[$i]['image'] = base_url('uploads/'.$products->type.'/'.$products->thumbnail);
				$search_var[$i]['subject'] = $products->subject;
				$search_var[$i]['text'] = word_limiter(strip_tags(trim($products->text,"\x00..\x1F")), 66,'...');		
			}
			$i++;
		}
		//print_r($return['news']);
		foreach ($return['news'] as $news) {
			if(!empty($news)) {
				$type = '';
				if ($news->type == 'news' || $news->type == 'promo') {
					$type = base_url($news->type.'/'.$news->url);
				} else if ($news->type == 'csr') {					
					$type = base_url('corporate/page-csr/'.$news->url);
				} 
				$search_var[$i]['url'] = $type; 
				$search_var[$i]['image'] = $news->media ? base_url('uploads/news/'.$news->media) :'';
				$search_var[$i]['subject'] = $news->subject;
				$search_var[$i]['text'] = word_limiter(strip_tags(trim($news->text,"\x00..\x1F")), 66,'...');		
			}
			$i++;
		}
		foreach ($return['service_education'] as $service_education) {
			if(!empty($service_education)) {
				$search_var[$i]['url'] = base_url('media-center/'.$medias->url.'/'.$medias->prefix); 
				$search_var[$i]['image'] = base_url('uploads/medias/'.$medias->media); 												
				$search_var[$i]['subject'] = $medias->subject;
				$search_var[$i]['text'] = word_limiter(strip_tags(trim($medias->text,"\x00..\x1F")), 66,'...');		
			}
			$i++;
		}
		foreach ($return['service_product_static'] as $service_product_static) {
			if(!empty($service_product_static)) {
				$search_var[$i]['url'] = base_url('page/'.$pages->url.'/'.$pages->prefix); 
				$search_var[$i]['image'] = base_url('uploads/pages/'.$pages->media); 																
				$search_var[$i]['subject'] = $pages->subject;
				$search_var[$i]['text'] = word_limiter(strip_tags(trim($pages->text,"\x00..\x1F")), 66,'...');		
			}
			$i++;
		}
		foreach ($return['service_static_content'] as $service_static_content) {
			if(!empty($service_static_content)) {
				$search_var[$i]['url'] = base_url('page/'.$pages->url.'/'.$pages->prefix); 
				$search_var[$i]['image'] = base_url('uploads/pages/'.$pages->media); 																
				$search_var[$i]['subject'] = $pages->subject;
				$search_var[$i]['text'] = word_limiter(strip_tags(trim($pages->text,"\x00..\x1F")), 66,'...');		
			}
			$i++;
		}		
		foreach ($return['service_tips'] as $service_tips) {
			if(!empty($service_tips)) {
				$search_var[$i]['url'] = base_url('page/'.$pages->url.'/'.$pages->prefix); 
				$search_var[$i]['image'] = base_url('uploads/pages/'.$pages->media); 																
				$search_var[$i]['subject'] = $pages->subject;
				$search_var[$i]['text'] = word_limiter(strip_tags(trim($pages->text,"\x00..\x1F")), 66,'...');		
			}
			$i++;
		}
		foreach ($return['service_vehicle'] as $service_vehicle) {
			if(!empty($service_vehicle)) {
				$search_var[$i]['url'] = base_url('page/'.$pages->url.'/'.$pages->prefix); 
				$search_var[$i]['image'] = base_url('uploads/pages/'.$pages->media); 																
				$search_var[$i]['subject'] = $pages->subject;
				$search_var[$i]['text'] = word_limiter(strip_tags(trim($pages->text,"\x00..\x1F")), 66,'...');		
			}
			$i++;
		}
		//exit;
		/* DATABASE SEARCH */
		 $search_data = $search_var;
		/* Here We Set Our Paging */        
		$html = '';
		$total_rows = 0;
		//print_r($search_data);
		//exit;
		if (!empty($search_data)) {
			$total_rows      = count($search_data);

			$config['base_url'] = base_url("search/{$search}");
			$config['total_rows'] = $total_rows;
			$config['per_page'] = 5;
			$config['uri_segment'] = 3;
			$config['use_page_numbers'] = TRUE;
	        $choice = $config['total_rows']/$config['per_page'];

	        $config['num_links'] = floor($choice);
	        
	        $this->pagination->initialize($config); 

	        $page 			= $this->uri->segment(3);
	        $active_page    = empty($page) ? 1 : $page; 
			$start_arr      = ($active_page-1) * $config['per_page'];
			$top_limit      = $config['per_page'] > $total_rows ? $total_rows : $config['per_page'];
			$end_arr        = ($active_page*$top_limit)-1;
 				
			$html .= ''; 
			$html .= '<div class="search-list">';			
			for ($index=$start_arr;$index<=$end_arr;$index++):
				if (!empty($search_data[$index]['url'])):
					$cl = 'twelve';
					$html .= '<div class="row">';		
						if($search_data[$index]["image"]) {        
							$cl = 'ten';
							$html .= '<figure class="two columns">';
							$html .= '<a href="'.$search_data[$index]['url'].'" class="learn-more">';
							$html .= '<img src="'.$search_data[$index]["image"].'"/>';                      	
	                      	$html .= '</a>';
	                    	$html .= '</figure>';
                    	}
                    	$html .= '<div class="'.$cl.' columns">';
                    	$html .= '<a href="'.$search_data[$index]['url'].'" class="learn-more">';
						$html .= '<h4>'.$search_data[$index]['subject'].'</h4>';
						$html .= '</a>';
						$html .= '<p>'.word_limiter(ucfirst(strip_tags(@$search_data[$index]['text'])),75,'').'</p>';
						$html .= '</div>';
					$html .= '</div><hr class="thin grey"/>';
				endif;
			endfor;
			$html .= '</div>';
			$html .= '<nav class="filter paging">';
			$html .=  $this->pagination->create_links();
			$html .= '</nav>';
		} else {
			$html .= '<div class="search_ul">'.lang('no_search').'</div>';			
			$html .= '<p><br/><br/><br/><br/><br/><br/><br/><br/></p>';
		}		
		
		// Set search text		
		$data['search'] = $search;

		// Set html result	
		$data['html'] = $html;

		// Set count html
		$data['count'] = ($total_rows != 0) ? $total_rows : 0;
				
		// Set site title page with module menu
		$data['page_title'] = $this->lang->line('search');
		
		// Set main template
		$data['main'] = 'search';
		
		// Load site template
		$this->load->view('template/public/template', $this->load->vars($data));		
		
	}
	
}

/* End of file search.php */
/* Location: ./application/controllers/search.php */