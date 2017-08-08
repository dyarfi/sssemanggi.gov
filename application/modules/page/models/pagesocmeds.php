<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for PageMenus
class PageSocmeds Extends MY_Model {

	// Table name for this model
	public $_table = 'page_socmeds';

	// Set primary key
	public $primary_key = 'id';

	// Belong to and has many relationship
	//public $has_many = ['pages' => [
							// Set relation Model
							//'model' => 'page/Pages',
							// Set Foreign Key to primary key
							//'primary_key'=>'menu_id'],
						// /];

	// Simply set $soft_delete to be TRUE and rows will magically be marked as deleted
	// public $soft_delete = TRUE;

	public function __construct() {
	    // Call the Model constructor
		parent::__construct();

	    // Set default db
	    $this->db = $this->load->database('default', true);
	    // Set default table
	    $this->_table = $this->db->dbprefix($this->_table);
	    $this->table = $this->_table;

	}

	public function install() {

		$insert_data	= FALSE;

		if (!$this->db->table_exists($this->table))
                    $insert_data	= TRUE;

                $sql	= 'CREATE TABLE IF NOT EXISTS `'.$this->table.'` ('
				. '`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY , '
				. '`name` VARCHAR(128) NULL , '
				. '`subject` VARCHAR(255) NULL , '
                . '`text` TEXT NULL , '
				. '`url` VARCHAR(255) NULL , '
				. '`media` VARCHAR(255) NULL , '
				. '`position` VARCHAR(255) NULL , '
				. '`ext_url` TINYINT(1) NOT NULL DEFAULT \'0\', '
				. '`priority` TINYINT(3) NULL , '
				. '`user_id` TINYINT(3) NULL , '
				. '`count` INT(11) NULL , '
				. '`status` ENUM( \'publish\', \'unpublish\', \'deleted\' ) NULL DEFAULT \'publish\', '
				. '`added` INT(0) NULL , '
				. '`modified` INT(0) NULL , '
				. 'INDEX (`priority`, `status`) '
				. ') ENGINE=MYISAM DEFAULT CHARSET=utf8;';

		$this->db->query($sql);

                if(!$this->db->query('SELECT * FROM `'.$this->table.'` LIMIT 0 , 1;'))
                        $insert_data	= TRUE;

		if ($insert_data) {
                    $sql	= '';
                    if($sql) $this->db->query($sql);
		}

		return $this->db->table_exists($this->table);

	}

	public function getSocmedsByType(){

		$groups = array('suzuki-mobil'=>'Suzuki Mobil','suzuki-motor'=>'Suzuki Motor','suzuki-marine'=>'Suzuki Marine');

		$data = [];
		foreach($groups as $group => $val) {
			$data[$val] = self::findAll(['subject'=> $group],'*',['priority'=>'asc']);
		}

		return $data;

	}

}
