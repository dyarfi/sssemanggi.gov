<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Attributes
class ProductServiceAttributes Extends MY_Model {    

	// Table name for this model
	public $_table = 'product_service_attributes';

	// Set primary key
	public $primary_key = 'id';

	// Belong to and has many relationship
	public $belongs_to = ['productservices' => [
							// Set relation Model
							'model' => 'product/ProductServices',
							// Set Foreign Key to primary key
							'primary_key'=>'service_id']
						];
	
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
				. '`product_id` INT(11) UNSIGNED NULL, '
				. '`type` enum(\'csr\',\'promo\',\'news\',\'awards\') NULL, '
				. '`name` VARCHAR(255) NULL, '
				. '`subject` VARCHAR(255) NULL, '
                . '`url` VARCHAR(255) NULL, '
				. '`synopsis` TEXT NULL, '
				. '`text` TEXT NULL, '
                . '`media` VARCHAR(255) NULL, '
				. '`attribute` TEXT NULL, '
                . '`messages` TEXT NULL, '
				. '`allow_comment` TINYINT(1) NULL, '
				. '`is_highlight` TINYINT(1) NULL DEFAULT 0, '
				. '`publish_date` DATE NULL, '
				. '`location` VARCHAR(255) NULL, '				
				. '`tags` TEXT NULL, '
				. '`priority` TINYINT(3) NULL, '
				. '`user_id` TINYINT(3) NULL , '
				. '`count` INT(11) NULL , '	
				. '`status` ENUM( \'publish\', \'unpublish\', \'deleted\' ) NULL DEFAULT \'publish\', '
				. '`added` INT(11) NULL, '
				. '`modified` INT(11) NULL, '
				. 'INDEX (`product_id`, `name`, `allow_comment`, `priority`) '
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
	
	// Delete page
	public function deleteProduct($id) {
		
		// Check page id
		$this->db->where('id', $id);
		
		// Delete page form database
		return $this->db->delete($this->table);		
	}	
}
