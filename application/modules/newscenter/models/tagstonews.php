<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Tags
class TagsToNews Extends MY_Model {
    
	// Table name for this model
	public $_table = 'tags_to_news';

	// Set primary key
	public $primary_key = 'id';	
	
	// Set belongs to
	public $belongs_to = array(
		'news' => array(
			'model' => 'newscenter/News',
			'primary_key'=>'news_id',
			),
		'tags' => array(
			'model' => 'newscenter/Tags',
			'primary_key'=>'tag_id'
			)
		);

	public function __construct() {
		// Call the Model constructor
		parent::__construct();
		
		$this->db = $this->load->database('default', true);
		
		// Set default table
		$this->table = $this->db->dbprefix($this->_table);
				
	}
	
	public function install() {
		
		$insert_data	= FALSE;

		if (!$this->db->table_exists($this->table)) 
                $insert_data	= FALSE;
                
                $sql	= 'CREATE TABLE IF NOT EXISTS `'.$this->table.'` ('
				. '`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, '
				. '`tag_id` INT(11) NULL, '
				. '`news_id` INT(11) NULL , '
				. '`priority` INT(11) NULL , '				
				. '`added` INT(11) NULL, '
				. '`modified` INT(11) NULL '
				. ') ENGINE=MYISAM DEFAULT CHARSET=utf8;';

		$this->db->query($sql);
		
        if(!$this->db->query('SELECT * FROM `'.$this->table.'` LIMIT 0 , 1;'))
			$insert_data	= TRUE;
		
		if ($insert_data) {
			$sql	= '';

			$this->db->query($sql);
		}

		return $this->db->table_exists($this->table);
		
	}
	
	public function getCount($where = null){
		$data = array();
		if ($where) {
			$options = array_merge($where,['status'=>'publish']);
		}
		$this->db->where($options,1);
		$this->db->from($this->table);
		$data = $this->db->count_all_results();
		return $data;
	}
	
	public function getNews($id = null){
		if(!empty($id)){
			$data = array();
			$options = array('id' => $id);
			$Q = $this->db->get_where($this->table,$options,1);
			if ($Q->num_rows() > 0){
				foreach ($Q->result_object() as $row)
				$data = $row;
			}
			$Q->free_result();
			return $data;
		}
	}	
	
	public function getNewsByName($name = null){
		if(!empty($name)){
			$data = array();
			$options = array('name' => $name,'status'=>'publish');
			$Q = $this->db->get_where($this->table,$options,1);
			if ($Q->num_rows() > 0){
				foreach ($Q->result_object() as $row)
				$data = $row;
			}
			$Q->free_result();
			return $data;
		}
	}	

	public function getNewsByUrl($url = null){
		if(!empty($url)){
			$data = array();
			$options = array('url' => $url,'status'=>'publish');
			$Q = $this->db->get_where($this->table,$options,1);
			if ($Q->num_rows() > 0){
				foreach ($Q->result_object() as $row)
				$data = $row;
			}
			$Q->free_result();
			return $data;
		}
	}	
	
	public function getAllNews($status=null){
		$data = array();
		$this->db->order_by('added');
		$Q = $this->db->get($this->table);
			if ($Q->num_rows() > 0){
				//foreach ($Q->result_object() as $row){
					//$data[] = $row;
				//}
				$data = $Q->result_object();
			}
		$Q->free_result();
		return $data;
	}	
	
	public function getAllNewsByMenu($menu=null){
		$data = array();
		$this->db->order_by('added');
		$this->db->where('menu_id',$menu);
		$Q = $this->db->get($this->table);
			if ($Q->num_rows() > 0){
				//foreach ($Q->result_object() as $row){
					//$data[] = $row;
				//}
				$data = $Q->result_object();
			}
		$Q->free_result();
		return $data;
	}	
	
	public function setNews($object=null){
		
		// Set News data
		$data = array(			
			'menu_id'       => $object['menu_id'],
			'name'			=> $object['name'],
			'subject'		=> $object['subject'],
            'url'           => $object['url'],
            'type'           => $object['type'],            
			'synopsis'		=> $object['synopsis'],
			'text'			=> $object['text'],
            'media'			=> $object['media'],
			'attribute'		=> $object['attribute'],
			'allow_comment' => $object['allow_comment'],
			'tags'			=> $object['tags'],
			'order'			=> $object['order'],
			'user_id'		=> $object['user_id'],
			'count'			=> $object['count'],
			'status'		=> $object['status'],
			'added'			=> time(),	
			'modified'		=> $object['status']
		);
		
		// Insert News data
		$this->db->insert($this->table, $data);
		
		// Return last insert id primary
		$insert_id = $this->db->insert_id();
			
		// Return last insert id primary
		return $insert_id;
		
	}	

	public function count_view ($url){	
		if (get_cookie() != session_id()) {
			//print_r(Session_Cookie::instance()->get('session'));	
			$counter = $this->load_by_parameter('counter');
			$counter->value = $counter->value + 1;
			$counter->update();
		}
		Session_Cookie::instance()->set('count_visit', session_id());
	}
	
	// Delete media
	public function deleteNews($id) {
		
		// Check media id
		$this->db->where('id', $id);
		
		// Delete media form database
		return $this->db->delete($this->table);		
	}	
}
