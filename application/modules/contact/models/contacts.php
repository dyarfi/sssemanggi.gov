<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Contacts
class Contacts Extends MY_Model {
    // Table name for this model
	public $_table = 'contacts';

	// Set primary key
	public $primary_key = 'id';
	
	public function __construct(){
	    // Call the Model constructor
	    parent::__construct();

	    // Set default db
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
				. '`subject` VARCHAR(255) NULL, '								
				. '`url` VARCHAR(255) NULL, '
				. '`text` TEXT NULL, '
				. '`type` VARCHAR(255) NULL, '
				. '`location` TEXT NULL, '				
				. '`phone` VARCHAR(64) NULL, '
				. '`fax` VARCHAR(64) NULL, '
				. '`zipcode` VARCHAR(12) NULL, '
				. '`media` VARCHAR(255) NULL, '
				. '`priority` TINYINT(3) NULL, '
				. '`user_id` TINYINT(3) NULL, '
				. '`count` INT(11) NULL, '	
				. '`status` ENUM( \'publish\', \'unpublish\', \'deleted\' ) NULL DEFAULT \'publish\', '
				. '`added` INT(11) NULL, '
				. '`modified` INT(11) NULL, '
				. 'INDEX (`priority`) '
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
	
	public function getContact($id = null){
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
	
	public function getContactByName($name = null){
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
	
	public function getAllContact($admin=null){
		$data = array();
		$this->db->where('status','publish');
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
	
	public function getAllContactByType($type=null){
		$data = array();
		$this->db->order_by('added');
		$this->db->where('type',$type);
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

	public function getAllContactByAttribute($type=null){
		$data = array();
		$this->db->order_by('added');
		$this->db->where('attribute',$type);
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
	
	public function setContact($object=null){
		
		// Set Contact data
		$data = array(			
			'menu_id'       => $object['menu_id'],
			'name'			=> $object['name'],
			'subject'		=> $object['subject'],
            'url'           => $object['url'],
			'synopsis'		=> $object['synopsis'],
			'text'			=> $object['text'],
            'media'			=> $object['media'],
			'attribute'		=> $object['attribute'],
			'allow_comment' => $object['allow_comment'],
			'tags'			=> $object['tags'],
			'priority'		=> $object['priority'],
			'user_id'		=> $object['user_id'],
			'count'			=> $object['count'],
			'status'		=> $object['status'],
			'added'			=> time(),	
			'modified'		=> $object['status']
		);
		
		// Insert Contact data
		$this->db->insert($this->table, $data);
		
		// Return last insert id primary
		$insert_id = $this->db->insert_id();
			
		// Return last insert id primary
		return $insert_id;
		
	}	
	
	// Delete contacts
	public function deleteContact($id) {
		
		// Check contacts id
		$this->db->where('id', $id);
		
		// Delete contacts form database
		return $this->db->delete($this->table);		
	}	
}
