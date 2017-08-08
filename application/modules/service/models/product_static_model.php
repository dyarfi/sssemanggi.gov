<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Product static
class Product_static_model Extends MY_Model {

	public $_table = 'service_product_static';

	// Set primary key
	public $primary_key = 'sps_id';	
	
	// Set hars many
	// public $has_many = array( 
	// 	'tagstonews' => array(
	// 		'model'=>'newscenter/TagsToNews',			
	// 		'primary_key'=>'news_id'
	// 		)
	// 	);
	public function __construct() {
		// Call the Model constructor
		parent::__construct();
		
		$this->db = $this->load->database('default', true);
		
		// Set default table
		$this->table = $this->db->dbprefix($this->_table);
				
	}

	public function get_list_home_type(){
    	$where = array('sps_type' => 'home');
        $query = $this->db->select()->get_where($this->table, $where);
        $result = array();
        if ($query->num_rows() > 0)
        {
            $result = $query->result();
            $query->free_result();
        }
        return $result;
	}
	
}
