<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Dealers
class DealerNetworks extends MY_Model {

   // Table name for this model
    public $_table = 'dealer_networks';

    // Set primary key
    public $primary_key = 'id'; 

    // Belong to and has many relationship    
    public $belongs_to = ['member' => [
                            // Set relation Model
                            'model' => 'member/Members',
                            // Set Foreign Key to primary key
                            'primary_key'=>'dealer_member_id']
                        ];
    
    // Set has many
    public $has_many = array( 
        'bookings' => array(
            'model'=>'service/Bookings',
            'primary_key'=>'dealer_id'
            ),
        );

    
    public function __construct() {
        // Call the Model constructor
        parent::__construct();
        
        $this->db = $this->load->database('default', true);
        
        // Set default table
        $this->table = $this->db->dbprefix($this->_table);
                
    }

    // Authenticate function for dealer login
    public function login($object=null){        
        if(!empty($object)){
        $data = array();
        $options = array(
                'email' => $object['email'], 
                'password' => sha1($object['password']));

        $Q = $this->db->get_where($this->table,$options,1);
        if ($Q->num_rows() > 0){                
            foreach ($Q->result_object() as $row) {
                if (intval($row->status) === 1 || $row->status === 'publish') {
                    // Update login state to true
                    // $this->setLoggedIn($row->id);
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

}