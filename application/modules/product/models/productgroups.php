<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Groups
class ProductGroups Extends MY_Model {

	// Table name for this model
	public $_table = 'tbl_product_groups';

	// Set primary key
	public $primary_key = 'id';

	// Belong to relationship
	public $belongs_to = [
						'products' => [
							// Set relation Model
							'model' => 'product/Products',
							// Set Foreign Key to primary key
							'primary_key'=>'product_id']
						];

	public function __construct(){
		// Call the Model constructor
		parent::__construct();

		$this->db = $this->load->database('default', true);

		// Set default table
		//$this->table = $this->db->dbprefix($this->_table);

	}

	public function install() {

		$insert_data	= FALSE;

		if (!$this->db->table_exists($this->table))
                $insert_data	= FALSE;

                $sql	= 'CREATE TABLE IF NOT EXISTS `'.$this->table.'` ('
				. '`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, '
				. '`type` ENUM( \'automobile\', \'motorcycle\', \'marine\' ) NULL DEFAULT \'automobile\', '
				. '`subject` VARCHAR(255) NULL, '
                . '`url` VARCHAR(255) NULL, '
				. '`text` TEXT NULL, '
                . '`media` VARCHAR(255) NULL, '
				. '`user_id` TINYINT(3) NULL , '
				. '`count` INT(11) NULL , '
				. '`status` ENUM( \'publish\', \'unpublish\', \'deleted\' ) NULL DEFAULT \'publish\', '
				. '`added` INT(11) NULL, '
				. '`modified` INT(11) NULL, '
				. 'INDEX (`url`) '
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

	public function getCount($status = null){
		$data = array();
		$options = array('status' => $status);
		$this->db->where($options,1);
		$this->db->from($this->table);
		$data = $this->db->count_all_results();
		return $data;
	}

	public function getGroup($id = null){
		if(!empty($id)){
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

    public function getGroupByParentId($options = null,$limit=''){
	    if(!empty($options)){
		$data = array();
		$options = ($options) ? $options : array();
		$Q = $this->db->get_where($this->table,$options,($limit) ? $limit : '2000');
		if ($Q->num_rows() > 0){
            foreach ($Q->result_object() as $row){
                $data[] = $row;
            }
		}
		$Q->free_result();
		return $data;
	    }
	}

    public function getGroupByType($type = null){
		if(!empty($type)){
			$data = array();
			$options = array('type' => $type);
			$Q = $this->db->get_where($this->table,$options,1);
			if ($Q->num_rows() > 0){
				foreach ($Q->result_object() as $row)
				$data = $row;
			}
			$Q->free_result();
			return $data;
		}
	}

	public function getGroupByUrl($url = null){
		if(!empty($url)){
			$data = array();
			$options = array('url' => $url,'status'=>'publish');
			$Q = $this->db->get_where($this->table,$options,1);
			if ($Q->num_rows() > 0){
				foreach ($Q->result_object() as $row)
				$data = $row;
			}
			$Q->free_result();
			return $data;
		}
	}

	public function getProductGroupForPricelist($type='') {

		// Load products and productmodels
		$this->load->model('product/Products');
		$this->load->model('product/ProductModels');

		$groups = self::findAll(['status'=>'publish','type'=>$type],'id,subject',['priority'=>'ASC']);
		foreach ($groups as $group) {
			if ($group->id != 0) {
				foreach ($this->Products->with('model')->findAll(['status'=>'publish','type'=>$type,'group_id'=>$group->id,'is_pricelist'=>1],'id') as $gi => $id) {
					$globprods[$group->subject][] = $id->model;
				}
			}
		}

		return $globprods;
	}

	public function getAllGroup($admin=null){
		$data = array();
		$this->db->order_by('added');
		$Q = $this->db->get($this->table);
			if ($Q->num_rows() > 0){
				//foreach ($Q->result_object() as $row){
					//$data[] = $row;
				//}
				$data = $Q->result_object();
			}
		$Q->free_result();
		return $data;
	}

	public function setGroup($object=null){

		// Set Business data
		$data = array(
            'type'			=> $object['type'],
			'url'			=> $object['url'],
			'subject'		=> $object['subject'],
			'text'			=> $object['text'],
            'media'			=> $object['media'],
			'user_id'		=> $object['user_id'],
			'count'			=> $object['count'],
			'status'		=> $object['status'],
			'added'			=> time(),
			'modified'		=> $object['status']
		);

		// Insert Business data
		$this->db->insert($this->table, $data);

		// Return last insert id primary
		$insert_id = $this->db->insert_id();

		// Return last insert id primary
		return $insert_id;

	}

	// Delete Group
	public function deleteGroup($id) {

		// Check Type id
		$this->db->where('id', $id);

		// Delete Type form database
		return $this->db->delete($this->table);
	}
}
