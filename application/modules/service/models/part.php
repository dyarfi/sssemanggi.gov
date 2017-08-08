<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Template
class Part Extends MY_Model {    

	// Table name for this model
	public $_table = 'service_part';

	// Set primary key
	public $primary_key = 'part_id';

	// Belong to and has many relationship
	public $belongs_to = ['products' => [
							// Set relation Model
							'model' => 'product/Products',
							// Set Foreign Key to primary key
							'primary_key'=>'part_id']
						,'service_part_reff' => [
							// Set relation Model
							'model' => 'service/Part_reff',
							// Set Foreign Key to primary key
							'primary_key'=>'part_reff_id']
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
				. '`part_no` varchar(50) NOT NULL PRIMARY KEY, '
				. '`product_id` int(11) NULL, '
				. '`part_reff_id` int(11) NULL, '
				. '`part_description` text NULL, '
				. '`part_qty` int(11) NULL, '
				. '`part_price` float NULL, '
				. '`part_remark` text NULL, '
				. '`user_id` TINYINT(3) NULL , '
				. '`added` INT(11) NULL, '
				. '`modified` INT(11) NULL, '
				. 'INDEX (`part_reff_id`) '
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
}
