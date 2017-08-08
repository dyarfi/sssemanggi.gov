<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Product static
class Tips Extends MY_Model {

	public $_table = 'service_tips';

	// Set primary key
	public $primary_key = 'sts_id';	
	
	public function __construct() {
		// Call the Model constructor
		parent::__construct();
		
		$this->db = $this->load->database('default', true);
		
		// Set default table
		$this->table = $this->db->dbprefix($this->_table);
				
	}
}
