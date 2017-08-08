<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for PageGroups
class PageGroups Extends MY_Model {

	// Table name for this model
	public $_table = 'page_groups';

	// Set primary key
	public $primary_key = 'id';

	// Belong to and has many relationship
	public $has_many = ['page_groups' => [
							// Set relation Model
							'model' => 'page/PageGroups',
							// Set Foreign Key to primary key
							'primary_key'=>'group_id'],
						];

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
				. '`url` VARCHAR(255) NULL , '
                . '`text` TEXT NULL , '
				. '`media` VARCHAR(255) NULL , '
				. '`priority` TINYINT(3) NULL , '
				. '`user_id` TINYINT(3) NULL , '
				. '`count` INT(11) NULL , '
				. '`status` ENUM( \'publish\', \'unpublish\', \'deleted\' ) NULL DEFAULT \'publish\', '
				. '`added` INT(0) NULL , '
				. '`modified` INT(0) NULL'
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
	public function getCount($status = null){
		$data = array();
		$options = array('status' => $status);
		$this->db->where($options,1);
		$this->db->from('page_groups');
		$data = $this->db->count_all_results();
		return $data;
	}

	public function getAllMenuByGroups () {

		// Load menus
		$this->load->model('page/PageMenus');

		$groups = self::findAll(['status'=>'publish'],'*',['priority'=>'asc']);
		$data = [];
		foreach($groups as $group) {
			if($group->show_subject == 1) {
				$data[$group->subject] = $this->PageMenus->with('pages')->findAll(['group_id'=> $group->id,'status'=>'publish','url !='=>'home','id !='=>16],'*',['priority'=>'asc']);
			} else {
				$data['&nbsp;'] = $this->PageMenus->with('pages')->findAll(['group_id'=> $group->id,'status'=>'publish','url !='=>'home','id !='=>16],'*',['priority'=>'asc']);
			}
		}

		return $data;

	}

}
