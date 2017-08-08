<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Members
class Members Extends MY_Model {
    
    // Table name for this model
    public $_table = 'members';

    // Set primary key
    public $primary_key = 'id'; 

	// Belong to and has many relationship
	public $has_many = ['dealernetwork' => [
							// Set relation Model
							'model' => 'service/DealerNetworks',
							// Set Primary Key
							'primary_key' => 'dealer_member_id'
							],
						'booking' => [
							// Set relation Model
							'model' => 'service/Bookings',
							// Set Primary Key
							'primary_key' => 'service_member_id'
							],						
						'blog' => [
							// Set relation Model
							'model' => 'newscenter/News',
							// Set Primary Key
							'primary_key' => 'user_id'
							],
						'notification' => [
							// Set relation Model
							'model' => 'member/Notifications',
							// Set Primary Key
							'primary_key' => 'user_id'
							],		
						//'vehicle' => [
							// Set relation Model
							//'model' => 'service/ServiceMemberVehicles',
							// Set Primary Key
							//'primary_key' => 'service_member_id'
						//	]
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
				. '`identifier_id` VARCHAR(64) NULL, '
                . '`identity` VARCHAR(32) NULL, '
				. '`profile_url` VARCHAR(255) NULL, '
                . '`photo_url` VARCHAR(512) NULL, '
                . '`email` VARCHAR(72) NULL, '
                . '`website` VARCHAR(72) NULL, '
                . '`password` VARCHAR(100) NULL, '
				. '`username` VARCHAR(255) NULL, '
				. '`fullname` VARCHAR(255) NULL, '
				. '`gender` VARCHAR(12) NULL, '
				. '`age` TINYINT(2) NULL, '
                . '`nationality_id` INT(11) NULL, '
                . '`research_area` VARCHAR(255) NULL, '
                . '`occupation` VARCHAR(64) NULL, '
                . '`about` TEXT NULL, '
                . '`address` VARCHAR(512) NULL, '
                . '`region` VARCHAR(64) NULL, '
				. '`phone_number` VARCHAR(32) NULL, '
                . '`phone_home` VARCHAR(32) NULL, '
                . '`id_number` VARCHAR(32) NULL, '
				. '`file_name` VARCHAR(512) NULL, '
				. '`confirmation_hash` CHAR(32) NULL, '
				. '`confirmation_code` CHAR(5) NULL, '                               
                . '`verify` VARCHAR(8) NULL, '
				. '`completed` TINYINT(1) NULL, '
                . '`logged_in` TINYINT(1) NOT NULL DEFAULT 0, '
                . '`last_login` INT(11) NULL, '
                . '`session_id` VARCHAR(40) NOT NULL, '
				. '`status` TINYINT(1) NOT NULL DEFAULT 0, '
				. '`join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, '
                . '`modified` INT(11) NULL, '
				. 'INDEX (`fullname`) '
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
		$options = array();
		if ($status) {
			$options = array('status' => $status);
		}
		$this->db->where($options,1);
		$this->db->from($this->table);
		$data = $this->db->count_all_results();
		return $data;
    }
    
    public function getMemberByIdentity($identifier_id='',$identity='') {
        
        if(!empty($identifier_id)){
			$data = array();
			$options = array('identifier_id' => $identifier_id,'identity'=>$identity);
			$Q = $this->db->get_where($this->table,$options,1);
			if ($Q->num_rows() > 0){
				foreach ($Q->result_object() as $row)
				$data = $row;
			}
			$Q->free_result();
			return $data;
		}
        
    }
    
    public function getActivation($params='') {
    	
    	if(!empty($params)){
			$data = array();
			$options = $params;
			$Q = $this->db->get_where($this->table,$options,1);
			if ($Q->num_rows() > 0){
				foreach ($Q->result_object() as $row)
				$data = $row;
			}
            if (!empty($data)) {
                //Get user id
                $this->db->where('id', $data->id);
                // Set data to update
                $update = array('completed'=>1,'status'=>1,'logged_in'=>1,'session_id'=>$this->session->userdata('session_id'),'last_login'=>time());
                //Return result
                $this->db->update($this->table, $update);
            }
            $Q->free_result();
            return $data;
		}        
    }
    
    public function getMember($id = null){
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

    public function getAllMember($admin=null){
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
    
    // Get participant's Email from posts 
	public function getEmail($email=null){
	    if(!empty($email)){
		$data = array();

		// Option and query result
		$options = array('email' => $email);			
		$Q = $this->db->get_where($this->table,$options,1);

		// Check result
		if($Q->num_rows() > 0) {
                // Return true if not exists
                return true;
            } else {
                // Return false if exists
                return false;
            }		 
	    }
	}
    
    // Get participant's by their Email from posts 
    public function getByEmail($email = null){
	    if(!empty($email)){
		$data = array();
		$options = array('email' => $email);
		$Q = $this->db->get_where($this->table,$options,1);
		if ($Q->num_rows() > 0){
			foreach ($Q->result_object() as $row)
			$data = $row;
		}
		$Q->free_result();
		return $data;
	    }
	}
	// Get all Members Join stats by join_date
	public function getJoinStats() {
	    
		/* SELECT count(`part_id`) `total_join`, date(`join_date`) `join_date` FROM `tbl_participants` WHERE date(`join_date`) >= '2014-10-25' AND date(`join_date`) <= '2015-03-25' GROUP BY date(`join_date`) ORDER BY `join_date` ASC */
		
	    $sql = 'SELECT count(`id`) `total_join`, date(`join_date`) `join_date` '
                    .'FROM `'. $this->table .'`'
                    .'WHERE date(`join_date`) >= \''.date('Y-m-d',strtotime("-5 month", time())).'\' '
                    .'AND date(`join_date`) <= \''.date('Y/m/d').'\' '
                    .'GROUP BY date(`join_date`) ORDER BY `join_date` ASC';
	    
	    $query = $this->db->query($sql);
            
	    return $query->result_object();
	}
    
    // Authenticate function for user login
	public function login($object=null){		
	    if(!empty($object)){
		$data = array();
		$options = array(
				'email' => $object['email'], 
				'password' => sha1($object['password']));

		$Q = $this->db->get_where($this->table,$options,1);
		if ($Q->num_rows() > 0){				
		    foreach ($Q->result_object() as $row) {
                if (intval($row->status) === 1) {
                    // Update login state to true
                    $this->setLoggedIn($row->id);
                    $data = $row;
                } else {
                    $data = 'disabled';
                }
		    }
		} 			 
        
		$Q->free_result();
		return $data;
	    }
	}
	/*
    public function setActivation($object='') {
        //Get user id
	    $this->db->where('id', $object->id);
        // Set data to update
        $update = array('status'=>1,'completed'=>1,'logged_in'=>1,'session_id'=>$this->session->userdata('session_id'),'last_login'=>time());
	    //Return result
	    return $this->db->update($this->table, $update);
	}
    */
	public function setLastLogin($id=null) {
	    //Get user id
	    $this->db->where('id', $id);
	    //Return result
	    return $this->db->update($this->table, array('last_login'=>time(),'logged_in'=>0));
	}
	
	public function setLoggedIn($id=null) {
	    //Get user id
	    $this->db->where('id', $id);
	    //Return result
	    return $this->db->update($this->table, array('logged_in'=>1,'session_id'=>$this->session->userdata('session_id')));
	}
	
	public function setPassword($user=null,$changed=''){
		
	    $password = ($changed) ? $changed : random_string('alnum', 8);

	    $data = array('password' => sha1($password));

	    $this->db->where('id', $user->id);
	    $this->db->update($this->table, $data); 

	    return $password;
		
	}
    
    public function setMember($object=null){

		// Set Member data
		$data = array(			
			'type' => @$object['type'],            
            'identifier_id' => @$object['identifier_id'],
            'identity'      => @$object['identity'],
            'profile_url'   => @$object['profile_url'],
            'identity'  => @$object['identity'],
            'email'		=> @$object['email'],
            'password'	=> @$object['password'],            
            'username'	=> @$object['username'],
            'fullname'	=> @$object['fullname'],
            'gender'	=> @$object['gender'],
            'website'	=> @$object['website'],
            'age'       => @$object['age'],
            'nationality_id' => @$object['nationality_id'],
			'id_number'	=> @$object['id_number'],
            'research_area' => @$object['research_area'],
            'occupation' => @$object['occupation'],
            'about' => @$object['about'],
            'province'	=> @$object['province'],            
            'urbandistrict'	=> @$object['urbandistrict'],            
            'suburban'	=> @$object['suburban'],            
            'address'	=> @$object['address'],
            'phone_number' => @$object['phone_number'],
            'photo_url'	=> @$object['photo_url'],
            'confirmation_hash'	=> @$object['confirmation_hash'],
            'confirmation_code'	=> @$object['confirmation_code'],            
            'confirmed'	=> @$object['confirmed'],
            'approved'	=> @$object['approved'],            
            'verify'	=> @$object['verify'],
            'completed'	=> @$object['completed'],
            'status' => @$object['status']
		);

		// Insert Member data
		$this->db->insert($this->table, $data);

		// Return last insert id primary
		$insert_id = $this->db->insert_id();

		// Return last insert id primary
		return $insert_id;

    }	
	
	public function updateMember($object=null){
	    
	    // Update User data             
	    $this->db->where('id', $object['id']);      

	    // Return last insert id primary
	    $update = $this->db->update($this->table, $object);	

	    return $update;
	}

    // Delete page
    public function deleteMember($id) {

		// Check page id
		$this->db->where('id', $id);

		// Delete page form database
		return $this->db->delete($this->table);		
    }	

    // Query 
    public function query($sql='') {

    	return $this->db->query($sql)->result();

    }
	
}
