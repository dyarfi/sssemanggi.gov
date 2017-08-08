<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Dealers
class ServiceVehicles extends MY_Model {

   // Table name for this model
    public $_table = 'tbl_service_vehicle';

    // Set primary key
    public $primary_key = 'id'; 

    // Set belongs to
    public $belongs_to = array( 
        'service_member_vehicle' => 
            array( 'model' => 'service/ServiceMemberVehicles', 'primary_key' => 'service_vehicle_id' )  
    );
    
    public function __construct() {
        // Call the Model constructor
        parent::__construct();
        
        $this->db = $this->load->database('default', true);
        
        // Set default table
        $this->table = $this->db->dbprefix($this->_table);
                
    }

    private function _generateSelect($select)
    {
        $result = '*';
        if ($select == null)
        {
            $result = '*';
        } else if (is_array($select)) {
            if (count($select) > 0)
            {
                $result = implode(',', $select);
            }
        } else if (strlen(trim($select)) > 0) {
            $result = $select;
        }
        return $result;
    }

}