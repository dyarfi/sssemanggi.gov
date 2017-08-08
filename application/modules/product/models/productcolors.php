<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Colors
class ProductColors Extends MY_Model {
    
	// Table name for this model
	public $_table = 'product_colors';
	
	// Set primary key
	public $primary_key = 'id';

	public function __construct(){
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
				. '`name` VARCHAR(255) NULL, '
				. '`subject` VARCHAR(255) NULL, '
                . '`url` VARCHAR(255) NULL, '
				. '`text` TEXT NULL, '
                . '`media` VARCHAR(255) NULL, '
                . '`priority` INT(11) NULL , '					
				. '`user_id` TINYINT(3) NULL , '
				. '`count` INT(11) NULL , '	
				. '`status` ENUM( \'publish\', \'unpublish\', \'deleted\' ) NULL DEFAULT \'publish\', '
				. '`added` INT(11) NULL, '
				. '`modified` INT(11) NULL, '
				. 'INDEX (`name`) '
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
	
	public function getCount($status = null){
		$data = array();
		$options = array('status' => $status);
		$this->db->where($options,1);
		$this->db->from($this->table);
		$data = $this->db->count_all_results();
		return $data;
	}
	
	public function getColor($id = null){
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
    
    public function getColorByParentId($options = null,$limit=''){
	    if(!empty($options)){
		$data = array();
		$options = ($options) ? $options : array();
		$Q = $this->db->get_where($this->table,$options,($limit) ? $limit : '2000');
		if ($Q->num_rows() > 0){
            foreach ($Q->result_object() as $row){
                $data[] = $row;
            }
		}
		$Q->free_result();
		return $data;
	    }
	}	
	
	public function getColorByUrl($type=null, $url = null){
		if(!empty($type) && !empty($url)){
			$data = array();
			$options = array('url'=>$url,'status'=>'publish');
			$this->db->order_by('added','DESC');
			$Q = $this->db->get_where($this->table,$options,1);
			if ($Q->num_rows() > 0){
				foreach ($Q->result_object() as $row)
				$data = $row;				
			}
			$Q->free_result();
			return $data;
		}
	}	

	public function getColorByName($name = null){
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
	
	public function getAllColor($admin=null){
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
		
	public function setColor($object=null){
		
		// Set Business data
		$data = array(			
			'name'			=> $object['name'],
			'subject'		=> $object['subject'],
			'url'			=> $object['url'],			
			'text'			=> $object['text'],
            'media'			=> $object['media'],
			'priority'		=> $object['priority'],
			'user_id'		=> $object['user_id'],
			'count'			=> $object['count'],
			'status'		=> $object['status'],
			'added'			=> time(),	
			'modified'		=> $object['status']
		);
		
		// Insert Business data
		$this->db->insert($this->table, $data);
		
		// Return last insert id primary
		$insert_id = $this->db->insert_id();
			
		// Return last insert id primary
		return $insert_id;
		
	}	
	
	// Delete Color
	public function deleteColor($id) {
		
		// Check Color id
		$this->db->where('id', $id);
		
		// Delete Color form database
		return $this->db->delete($this->table);		
	}	
}
