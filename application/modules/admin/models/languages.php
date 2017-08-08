<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Language
class Languages Extends CI_Model {
	// Table name for this model
	public $table = 'languages'; 
	
	public function __construct() {
	    // Call the Model constructor
	    parent::__construct();

	    // Set default db
	    $this->db = $this->load->database('default', true);		
	    // Set default table
	    $this->table = $this->db->dbprefix($this->table);
	}
	
	public function install () {
		$insert_data		= FALSE;
		
		if (!$this->db->table_exists($this->table)) {
			$insert_data	= TRUE;

			$sql	= 'CREATE TABLE IF NOT EXISTS `'. $this->table .'` ('
					. '`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, '
					. '`name` VARCHAR(64) NOT NULL, '
					. '`url` VARCHAR(48) NULL, '
					. '`prefix` VARCHAR(8) NULL, '
					. '`native` VARCHAR(48) NULL, '					
					. '`default` TINYINT(1) NULL DEFAULT 0, '
					. '`site_language` TINYINT(1) NOT NULL DEFAULT 0, '					
					. '`is_system` TINYINT(1) NOT NULL DEFAULT 0, '
					. '`status` TINYINT(1) NOT NULL DEFAULT 1, '
					. '`added` INT(11) UNSIGNED NOT NULL, '
					. '`modified` INT(11) UNSIGNED NOT NULL, '
					. 'PRIMARY KEY (`id`), '
                    . 'KEY `name` (`name`,`status`)'
					. ') ENGINE=MyISAM DEFAULT CHARSET=utf8;';
	
			$this->db->query($sql);
		}

		if(!$this->db->query('SELECT * FROM `'.$this->table.'` LIMIT 0 , 1;')) {
			$insert_data	= TRUE;
		}

		if ($insert_data) {
			$sql	= 'INSERT INTO `'. $this->table .'` '
					. '(`id`, `name`, `url`, `prefix`, `native`, `default`, `site_language`,`is_system`, `status`, `added`, `modified`) '
					. 'VALUES '
					. '(1, \'Indonesia\', \'indonesia\', \'id\',\'indonesian\', 0, 0, 0, 1, '.time().', 0), '
					. '(2, \'English\', \'english\', \'en\',\'english\' 1, 1, 1, 1, '.time().', 0), '
					. '(3, \'Arab\', \'arab\', \'ar\', \'arabian\'0, 0, 0, 0, '.time().', 0);';

			if ($sql) $this->db->query($sql);
		}
		
		return $this->db->table_exists($this->table);
	}
	

	public function setSiteLanguage ($language) {

		if ($language = $this->getByUrl($language)->url) {
		
			// Set expired time for about a month
			$time_expired = 7200 + 60 * 60 * 24 * 30;
			
			// Set language from database 
			//$this->config->set_item('language', $language);
            $this->config->set_item('language', $language);
			
			// Set cookie from default variables
			//$this->input->set_cookie("language",$language,$time_expired);			
			$this->session->unset_userdata('language');
            $this->session->set_userdata('language', $language);
				
            // Redirect to previous page
			if ($this->input->get('rel')) {
				// Redirect to where the page is requested
				// $this->output->set_header('Referer:'.$this->input->get('rel'));
				redirect($this->input->get('rel'));
			} else {
				// Redirect to referrer
				redirect($this->agent->referrer());
			}
		} else {

			return redirect(base_url());
			
		}

	}
	
	public function getLanguage($id = null){
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
	
	public function getAllLanguage($where=''){
	    $data = array();
	    $this->db->order_by('added');
		if ($where) {
			$this->db->where($where);
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
	
	public function getName_ById($id = null){
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

	public function getUrl_ById($id = null){
	    $data = '';
	    $options = array('id' => $id);
	    $Q = $this->db->get_where($this->table,$options,1);

	    if ($Q->num_rows() > 0){
			foreach ($Q->result_object() as $row)
				$data = $row->url;
	    }
	    $Q->free_result();
	    return $data;
	}
        
	public function getByPrefix($prefix = null){
	    $data = '';
	    $options = array('prefix' => $prefix);
        $Q = $this->db->get_where($this->table,$options,1);
        if ($Q->num_rows() > 0){
			foreach ($Q->result_object() as $row) {
				$data = $row;
			}
	    }
        
	    $Q->free_result();
	    return $data;
	}
	
	public function getByUrl($url = null){
	    $data = '';
	    $options = array('url' => $url);
        $Q = $this->db->get_where($this->table,$options,1);		
        if ($Q->num_rows() > 0){
			foreach ($Q->result_object() as $row) {
				$data = $row;
			}
	    }
        
	    $Q->free_result();
	    return $data;
	}
	
	public function getDefault($prefix = null) {
	    $data = '';
	    $options = array('default' => 1, /*'is_system' => 1,*/ 'status' => 1);
	    $Q = $this->db->get_where($this->table,$options,1);
	    if ($Q->num_rows() > 0){
		    foreach ($Q->result_object() as $row){
			    $data = $row;
		    }
		}
	    $Q->free_result();
	    return $data;
	}

    public function getDefaultSiteLanguage () {
		$data = '';
	    $options = array('site_language' => 1, 'status' => 1);
	    $Q = $this->db->get_where($this->table,$options,1);
	    if ($Q->num_rows() > 0){
		    foreach ($Q->result_object() as $row){
			    $data = $row;
		    }
		}
	    $Q->free_result();
	    return $data;
    }

    public function getActiveLanguage($prefix = null) {
	    $data = '';
	    $options = array('status' => 1,'is_system' => 0);
	    $Q = $this->db->get_where($this->table,$options,1);
	    if ($Q->num_rows() > 0){
		    foreach ($Q->result_object() as $row){
			    $data = $row;
		    }
		}
	    $Q->free_result();
	    return $data;
	}
	
	public function getActiveCount() {
	    $data = '';
	    $options = array('status' => 1);
	    $this->db->where($options);
	    $Q = $this->db->get($this->table);
		$data = $Q->num_rows();
	    $Q->free_result();
	    return $data;
	}

	public function setPublicLanguage($id=null){

		if ($id) {

			$data = ['site_language'=>0];		    
			$updated = $this->db->where('site_language', 1)->update($this->table, $data);

		    if ($updated) {
				
				return $this->db->where('id', $id)->update($this->table, ['site_language'=>1]);
			
			}
		}

	}
	
	public function setLanguage($object=null) {
				
	    $data = array(
			'name' => $object['name'],
			'url' => @$object['url'],
			'prefix' => @$object['prefix'],
			'added' => time(),
			'status' => $object['status']
	    );

	    $this->db->insert($this->table, $data);
		
		return $this->db->insert_id();
	}
	
	public function setStatus($id=null,$status=null) {
	   
	    //Get user id
	    $this->db->where('id', $id);
	    
	    //Return result
	    return $this->db->update($this->table, array('status'=>$status,'modified'=>time()));

	}
	
	public function updateLanguage($object=null){
	    $data = array(
			'name' => $object['name'],
			'url' => $object['url'],
			'prefix' => @$object['prefix'],			
			'status' => $object['status'],
			'modified' => time(),
	    );
	    $this->db->where('id', $object['id']);
	    return $this->db->update($this->table, $data);
	}
	
	public function deleteLanguage($id){
	    $this->db->where('id', $id);
	    return $this->db->delete($this->table);
	}
}
