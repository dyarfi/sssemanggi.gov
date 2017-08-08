<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for ContactHistories
class ContactHistories Extends MY_Model {
	
	// Table name for this model
	public $_table = 'contact_histories'; 
	
	public function __construct() {
	    // Call the Model constructor
	    parent::__construct();

	    // Set default db
	    $this->db = $this->load->database('default', true);		
	    // Set default table
	    $this->table = $this->db->dbprefix($this->_table);	
	}
	
	public function install () {
		$insert_data		= FALSE;
		
		if (!$this->db->table_exists($this->table)) {
			$insert_data	= TRUE;

			$sql	= 'CREATE TABLE IF NOT EXISTS `'. $this->table .'` ('
					. '`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, '
					. '`subject_to` VARCHAR(64) NULL, '
					. '`name` VARCHAR(64) NULL, '
					. '`email` VARCHAR(64) NULL, '
					. '`gender` VARCHAR(12) NULL, '
					. '`phone` VARCHAR(16) NULL, '
					. '`fax` VARCHAR(16) NULL, '
					. '`address` VARCHAR(255) NULL, '
					. '`subject` VARCHAR(64) NULL, '
					. '`message` TEXT NULL, '
					. '`captcha` VARCHAR(8) NULL, '
					. '`is_replied` INT(1) NOT NULL DEFAULT 0, '
					. '`status` TINYINT(1) NOT NULL, '
					. '`added` INT(11) UNSIGNED NOT NULL, '
					. '`modified` INT(11) UNSIGNED NOT NULL, '
					. 'INDEX (`name`) '
					. ') ENGINE=MYISAM DEFAULT CHARSET=utf8;';
	
			$this->db->query($sql);
		}

		if(!$this->db->query('SELECT * FROM `'.$this->table.'` LIMIT 0, 1;')) {
			$insert_data	= TRUE;
		}
        
		if ($insert_data) {
                    $sql    = 'INSERT INTO `'. $this->table .'` '
                            . '(`id`, `name`, `email`, `subject`,`message`, `status`, `added`, `modified`) '
                            . 'VALUES '
                            . '(\'1\', \'User One\', \'user1@user.org\', \'Subject One\', \'Message One\', \'1\', '.time().' , 0), '
                            . '(\'2\', \'User Two\', \'user2@user.org\', \'Subject Two\', \'Message Two\', \'1\', '.time().' , 0), '
                            . '(\'3\', \'User Three\', \'user3@user.org\', \'Subject Three\', \'Message Three\', \'1\', '.time().' , 0), '
                            . '(\'4\', \'User Four\', \'user4@user.org\', \'Subject Four\', \'Message Four\', \'1\', '.time().' , 0);';

                    if ($sql) $this->db->query($sql);
		}
		
		return $this->db->table_exists($this->table);
	}
	
	public function getContactHistory($id = null){
	    if(!empty($id)) {
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
	
	public function getAllContactHistory($options=''){
	    $data = array();
	    $this->db->order_by('added');
	    if ($options) {
	    	$this->db->where($options);	   
	    }
	    $Q = $this->db->get($this->table);
		if ($Q->num_rows() > 0){
		    //foreach ($Q->result_array() as $row){
			    //$data[] = $row;
		    //}
		    $data = $Q->result_object();
		}
	    $Q->free_result();
	    return $data;
	}
	
	public function getContactName_ById($id = null){
	    $data = '';
	    $options = array('id' => $id);
	    $Q = $this->db->get_where($this->table,$options,1);

	    if ($Q->num_rows() > 0){
		    foreach ($Q->result_object() as $row)
			    $data = $row->name;
	    }
	    $Q->free_result();
	    return $data;
	}
	
	public function setContactHistory($object=null){
				
	    $data = array(	    	
    	'subject_to' => $object['subject_to'],
	    'name' => $object['name'],
	    'gender' => $object['gender'],
	    'email' => $object['email'],	    
		'phone' => $object['phone'],
		'fax' => $object['fax'],
		'address' => $object['address'],
		'subject' => $object['subject'],
	    'message' => $object['message'],
	    'captcha' => $object['captcha'],
	    'is_replied' => 0,        
	    'status' => 1,
        'added' => time(),
	    );

	    // Insert User data
		$this->db->insert($this->table, $data);
		
		// Return last insert id primary
		$insert_id = $this->db->insert_id();					
			
		// Return last insert id primary
		return $insert_id;
		
	}
	
	public function setStatus($id=null,$status=null) {
	   
	    //Get user id
	    $this->db->where('id', $id);
	    
	    //Return result
	    return $this->db->update($this->table, array('status'=>$status,'modified'=>time()));

	}
	
	public function updateContactHistory($object=null){
	    $data = array(
    	'subject_to' => $object['subject_to'],
	    'name' => $object['name'],
	    'gender' => $object['gender'],
	    'email' => $object['email'],	    
		'phone' => $object['phone'],
		'fax' => $object['fax'],
		'address' => $object['address'],
		'subject' => $object['subject'],
	    'message' => $object['message'],
	    'captcha' => $object['captcha'],
	    'is_replied' => $object['is_replied'],  
	    'status' => $object['status'],
	    'modified' => time()
	    );
	    $this->db->where('id', $object['id']);
	    return $this->db->update($this->table, $data);
	}
	
	public function deleteContactHistory($id){
	    $this->db->where('id', $id);
	    return $this->db->delete($this->table);
	}
	
	// Query 
    public function query($sql='') {

    	return $this->db->query($sql)->result();

    }
}
