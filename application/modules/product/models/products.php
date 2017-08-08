<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Template
class Products Extends MY_Model {

	// Table name for this model
	public $_table = 'tbl_products';

	// Set primary key
	public $primary_key = 'id';

	// Belong to and has many relationship
	public $belongs_to = ['category' => [
							// Set relation Model
							'model' => 'product/ProductCategories',
							// Set Foreign Key to primary key
							'primary_key'=>'category_id']
						];

	// Belong to and has many relationship
	public $has_many = ['model' => [
							// Set relation Model
							'model' => 'product/ProductModels',
							// Set Foreign Key to primary key
							'primary_key'=>'product_id',
							],
						'accessory' => [
							// Set relation Model
							'model' => 'product/ProductAccessories',
							// Set Foreign Key to primary key
							'primary_key'=>'product_id',
							],
						'variant' => [
							// Set relation Model
							'model' => 'product/ProductVariants',
							// Set Foreign Key to primary key
							'primary_key'=>'product_id',
							],
						'service' => [
							// Set relation Model
							'model' => 'product/ProductServices',
							// Set Foreign Key to primary key
							'primary_key'=>'product_id',
							]
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
				. '`category_id` INT(11) UNSIGNED NULL, '
				. '`type` enum(\'automobile\',\'motorcycle\',\'marine\') NULL, '
				. '`name` VARCHAR(255) NULL, '
				. '`subject` VARCHAR(255) NULL, '
                . '`url` VARCHAR(255) NULL, '
				. '`synopsis` TEXT NULL, '
				. '`text` TEXT NULL, '
				. '`brochure` VARCHAR(128) NULL, '
				. '`cover` VARCHAR(255) NULL, '
				. '`thumbnail` VARCHAR(255) NULL, '
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
				. 'INDEX (`category_id`, `name`, `allow_comment`, `priority`) '
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

	public function getProduct($id = null){
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

    public function getProductByCategoryId($options = null,$limit=''){
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

	public function getProductByType($type = null){
		if(!empty($type)){
			$data = array();
			$options = array('type' => $type,'status'=>'publish');
			$this->db->order_by('added','DESC');
			$Q = $this->db->get_where($this->table,$options);
			if ($Q->num_rows() > 0){
				//foreach ($Q->result_object() as $row)
				//$data = $row;
				$data = $Q->result_object();
			}
			$Q->free_result();
			return $data;
		}
	}


	public function getProductByUrl($type=null, $url = null){
		if(!empty($type) && !empty($url)){
			$data = array();
			$options = array('type'=>$type,'url'=>$url,'status'=>'publish');
			$this->db->order_by('added','DESC');
			$Q = $this->db->get_where($this->table,$options,1);
			if ($Q->num_rows() > 0){
				foreach ($Q->result_object() as $row)
				$data = $row;
			}
			$Q->free_result();
			return $data;
		}
	}

	public function getProductByName($name = null){
		if(!empty($name)){
			$data = array();
			$options = array('name' => $name,'status'=>'publish');
			$Q = $this->db->get_where($this->table,$options,1);
			if ($Q->num_rows() > 0){
				foreach ($Q->result_object() as $row)
				$data = $row;
			}
			$Q->free_result();
			return $data;
		}
	}

	public function getAllProduct($admin=null){
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

	public function setProduct($object=null){

		// Set Business data
		$data = array(
			'category_id'   => $object['category_id'],
			'name'			=> $object['name'],
			'subject'		=> $object['subject'],
			'synopsis'		=> $object['synopsis'],
			'text'			=> $object['text'],
            'messages'		=> $object['messages'],
            'media'			=> $object['media'],
			'attribute'		=> $object['attribute'],
			'publish_date'	=> $object['publish_date'],
			'unpublish_date' => $object['unpublish_date'],
			'allow_comment' => $object['allow_comment'],
			'tags'			=> $object['tags'],
			'priority'		=> $object['priority'],
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

	// Delete page
	public function deleteProduct($id) {

		// Check page id
		$this->db->where('id', $id);

		// Delete page form database
		return $this->db->delete($this->table);
	}
}