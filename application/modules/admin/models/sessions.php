<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Sessions
class Sessions Extends CI_Model {
	// Table name for this model
	public $table = 'ci_sessions';
	
	public function __construct(){
	    // Call the Model constructor
	    parent::__construct();
			
	    // Set default db
	    $this->db = $this->load->database('default', true);		
	    // Set default table
	    $this->table = $this->db->dbprefix($this->table);			

	    // Always check the sessions tables	
	    $this->install();    
				
	}
	
	public function install() {
		
	    $insert_data	= FALSE;

	    if (!$this->db->table_exists($this->table)) { 
			$insert_data	= TRUE;

			$sql = 'CREATE TABLE IF NOT EXISTS `'.$this->table.'` ('
					. '`session_id` VARCHAR(42) NOT NULL DEFAULT 0 PRIMARY KEY,'
					. '`ip_address` VARCHAR(16) NOT NULL DEFAULT 0, '
					. '`user_agent` VARCHAR(255) NULL, '
					. '`last_activity` INT(11) UNSIGNED NOT NULL,'
					. '`user_data` blob NULL, '
					. 'INDEX (`session_id`, `ip_address`) '
					. ') ENGINE=MYISAM DEFAULT CHARSET=utf8;';

			$this->db->query($sql);
	    }


	    if(!$this->db->query('SELECT * FROM `'.$this->table.'` LIMIT 0, 1;'))
		    $insert_data = TRUE;

	    if ($insert_data) { 
			$sql = '';
			if ($sql) $this->db->query($sql);
	    }

	    return $this->db->table_exists($this->table);
		
	}
	
	public function deleteSession($id) {
		
	    // Check session id
	    return $this->db->where('session_id', $id);
		
	}
	
	public function truncate(){
	    // Set data to be emptied
	    $result = $this->db->query("TRUNCATE TABLE `".$this->table."`");

	    // Data emptied return will be 0 zero
	    return !$result;
	}
}
