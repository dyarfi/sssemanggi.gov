<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for PageMenus
class PageMenus Extends MY_Model {

	// Table name for this model
	public $_table = 'page_menus';

	// Set primary key
	public $primary_key = 'id';

	// Belong to and has many relationship
	public $has_many = ['pages' => [
							// Set relation Model
							'model' => 'page/Pages',
							// Set Foreign Key to primary key
							'primary_key'=>'menu_id'],
						];

	// Belong to and has many relationship
	public $belongs_to = ['pagegroups' => [
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
				. '`parent_id` INT(11) UNSIGNED NULL DEFAULT \'0\' , '
				. '`name` VARCHAR(128) NULL , '
				. '`subject` VARCHAR(255) NULL , '
                . '`synopsis` TEXT NULL , '
				. '`text` TEXT NULL , '
				. '`url` VARCHAR(255) NULL , '
				. '`media` VARCHAR(255) NULL , '
				. '`position` VARCHAR(255) NULL , '
				. '`ext_url` TINYINT(1) NOT NULL DEFAULT \'0\', '
				. '`sub_level` TINYINT(3) NULL , '
				. '`priority` TINYINT(3) NULL , '
				. '`is_system` TINYINT(3) NULL, '
				. '`has_child` TINYINT(3) NULL, '
				. '`user_id` TINYINT(3) NULL , '
				. '`count` INT(11) NULL , '
				. '`status` ENUM( \'publish\', \'unpublish\', \'deleted\' ) NULL DEFAULT \'publish\', '
				. '`added` INT(0) NULL , '
				. '`modified` INT(0) NULL , '
				. 'INDEX (`parent_id`, `name`, `sub_level`, `priority`, `status`) '
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
	public function getCount($status = null) {
		$data = array();
		$options = array('status' => $status);
		$this->db->where($options,1);
		$this->db->from('page_menus');
		$data = $this->db->count_all_results();
		return $data;
	}

	public function getPageMenu($id = null) {
		if(!empty($id)){
			$data = array();
			$options = array('id' => $id);
			$Q = $this->db->get_where('page_menus',$options,1);
			if ($Q->num_rows() > 0){
				foreach ($Q->result_object() as $row)
				$data = $row;
			}
			$Q->free_result();
			return $data;
		}
	}

	public function getMenu($menu=null) {
		if(!empty($menu)){
			$data = array();
			$options = array('subject' => $menu,'status' => 'publish');
			$Q = $this->db->get_where('page_menus',$options,1);
			if ($Q->num_rows() > 0){
				foreach ($Q->result_object() as $row)
				$data = $row;
			}
			$Q->free_result();
			return $data;
		}
	}

	public function getMenuByUrl($url=null) {
		if(!empty($url)){
			$data = array();
			$options = array('url' => $url,'status' => 'publish');
			$Q = $this->db->get_where('page_menus',$options,1);
			if ($Q->num_rows() > 0){
				foreach ($Q->result_object() as $row)
				$data = $row;
			}
			$Q->free_result();
			return $data;
		}
	}

	public function getPagesByMenu($menu = null) {
		if(!empty($menu)){
			$_menu = self::getMenu($menu);
			$data = array();
			$options = array('menu_id' => $_menu->id,'status'=>'publish');
			$Q = $this->db->get_where('pages',$options);
			if ($Q->num_rows() > 0){
				$data = $Q->result_object();
			}
			$Q->free_result();
			return $data;
		}
	}

	public function getAllPageMenu($admin=null) {
		$data = array();
		$this->db->order_by('added');
		$Q = $this->db->get('page_menus');
			if ($Q->num_rows() > 0){
				//foreach ($Q->result_object() as $row){
					//$data[] = $row;
				//}
				$data = $Q->result_object();
			}
		$Q->free_result();
		return $data;
	}

	public function getPagesGroupByType() {

		$_menu = self::with('pages')->findAll(['status'=>'publish','position'=>'top','url !='=>'home'],'*',['priority'=>'asc','type'=>'asc']);
		$data = [];
		foreach($_menu as $menu) {
			$data[$menu->type][] = $menu;
		}

		return $data;

	}

	public function getPageMenusInTop() {

		//$_menu = self::with('pages')->findAll(['status'=>'publish','position'=>'top_bottom','position'=>'top'],'*',['priority'=>'asc']);
		$_menu = self::executeQuery("SELECT * from {$this->table} WHERE status = 'publish' AND position IN ('top','top_bottom') ORDER BY priority ASC;")->result_object();
		$data = [];
		foreach($_menu as $menu) {
			$data[] = $menu;
			$menu->pages = self::executeQuery("SELECT * from tbl_pages WHERE status = 'publish' AND menu_id ='{$menu->id}';")->result_object();
 		}
		return $data;

	}

	public function getPageMenusInBottom() {

		//$_menu = self::findAll(['status'=>'publish','position'=>'top_bottom','position'=>'bottom'],'*',['priority'=>'asc']);
		$_menu = self::executeQuery("SELECT * from {$this->table} WHERE status = 'publish' AND position IN ('bottom') ORDER BY priority ASC;")->result_object();
		$data = [];
		foreach($_menu as $menu) {
			$data[] = $menu;
		}

		return $data;

	}
	
	public function deletePageMenu($id) {

		// Check page_menu id
		$this->db->where('id', $id);

		// Delete page_menu form database
		if ($this->db->delete('page_menus')) {

			// Check page_menu profile id
			$this->db->where('page_menu_id', $id);

			// Delete page_menu profile form database
			return $this->db->delete('page_menu_profiles');

		}
	}
}
