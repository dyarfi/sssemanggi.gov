<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for News
class News Extends MY_Model {

	// Table name for this model
	public $_table = 'news';

	// Set primary key
	public $primary_key = 'id';

	// Set has many
	public $has_many = array(
		'tagstonews' => array(
			'model'=>'newscenter/TagsToNews',
			'primary_key'=>'news_id'
			)
		);

	// Set belongs to
	public $belongs_to = array(
			'users' => array( 'model' => 'admin/Users', 'primary_key' => 'user_id' ),
			'member' => array( 'model' => 'member/Members', 'primary_key' => 'user_id' ),
			//'dealer' => array( 'model' => 'service/DealerNetworks', 'primary_key' => 'user_id' )
		);


	public function __construct() {
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
				. '`category_id` INT(11) NULL , '
				. '`name` VARCHAR(255) NULL, '
				. '`subject` VARCHAR(255) NULL, '
                . '`url` VARCHAR(255) NULL, '
                . '`type` VARCHAR(10) NULL, '
				. '`synopsis` TEXT NULL, '
				. '`text` TEXT NULL, '
                . '`cover` VARCHAR(255) NULL, '
                . '`media` VARCHAR(255) NULL, '
				. '`attribute` TEXT NULL, '
				. '`publish_date` DATE NULL DEFAULT \'0000-00-00\', '
				. '`allow_comment` TINYINT(1) NULL, '
				. '`is_highlight` TINYINT(1) NULL DEFAULT 0, '
				. '`tags` TEXT NULL, '
				. '`priority` TINYINT(3) NULL, '
				. '`user_id` TINYINT(3) NULL , '
				. '`count` INT(11) NULL , '
				. '`status` ENUM( \'publish\', \'unpublish\', \'deleted\' ) NULL DEFAULT \'publish\', '
				. '`added` INT(11) NULL, '
				. '`modified` INT(11) NULL, '
				. 'INDEX (`name`, `allow_comment`, `priority`) '
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

	public function getCount($where = null){
		$data = array();
		$options = ['status'=>'publish'];
		if ($where) {
			$options = array_merge($where,['status'=>'publish']);
		}
		$this->db->where($options,1);
		$this->db->from($this->table);
		$data = $this->db->count_all_results();
		return $data;
	}

	public function getNews($id = null){
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

	public function getNewsByName($name = null){
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

	public function getNewsByUrl($url = null){
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

	public function getAllNews($status=null){
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

	public function getAllNewsByMenu($menu=null){
		$data = array();
		$this->db->order_by('added');
		$this->db->where('menu_id',$menu);
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

	public function setNews($object=null){

		// Set News data
		$data = array(
			'name'			=> $object['name'],
			'subject'		=> $object['subject'],
            'url'           => $object['url'],
            'type'          => $object['type'],
			'synopsis'		=> $object['synopsis'],
			'text'			=> $object['text'],
            'media'			=> $object['media'],
			'attribute'		=> $object['attribute'],
			'allow_comment' => $object['allow_comment'],
			'tags'			=> $object['tags'],
			'priority'		=> $object['priority'],
			'publish_date'	=> $object['publish_date'],
			'user_id'		=> $object['user_id'],
			'count'			=> $object['count'],
			'status'		=> $object['status'],
			'added'			=> time(),
			'modified'		=> '0',
		);

		// Insert News data
		$this->db->insert($this->table, $data);

		// Return last insert id primary
		$insert_id = $this->db->insert_id();

		// Return last insert id primary
		return $insert_id;

	}

	public function updateNews($object=null){

	    $data = array(
			'name'			=> $object['name'],
			'subject'		=> $object['subject'],
            'url'           => $object['url'],
            'type'          => $object['type'],
			'synopsis'		=> $object['synopsis'],
			'text'			=> $object['text'],
            'media'			=> $object['media'],
			'attribute'		=> $object['attribute'],
			'allow_comment' => $object['allow_comment'],
			'tags'			=> $object['tags'],
			'priority'		=> $object['priority'],
			'publish_date'	=> $object['publish_date'],
			'user_id'		=> $object['user_id'],
			'count'			=> $object['count'],
			'status'		=> $object['status'],
			'modified'		=> time()
	    );

	    $this->db->where('id', $object['id']);
	    return $this->db->update($this->table, $data);
	}

	public function count_view ($id){

    	$session = $this->session->userdata('viewed');
		$ids	 = $session->viewed->news->id;

		//print_r($viewed);
		//print_r($this->session->userdata('viewed'));
		//exit;

		$_ids = $viewed->viewed->news->id;
		$viewed->viewed->news->id = array_merge($id,$_ids);
		//$this->session->set_userdata('viewed', $viewed);

		foreach ($session as $key => $val) {
				if (!in_array($id, $val->news->id)) {
	    			// exit;
	    			$obj = $this->get($id);
	    			$this->update($id, ['count' => $obj->count + 1], TRUE);
	    		}
    		//$viewed['viewed']['news'] = ['id' => $id];
    		//$this->session->set_userdata('viewed', $viewed);
    	}

	}

	// Delete media
	public function deleteNews($id) {

		// Check media id
		$this->db->where('id', $id);

		// Delete media form database
		return $this->db->delete($this->table);
	}
}
