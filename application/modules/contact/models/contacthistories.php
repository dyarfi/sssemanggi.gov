<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Contacts
class ContactHistories Extends MY_Model {
    // Table name for this model
	public $_table = 'contact_histories';

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
	
}
