<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Captcha
class Bookings extends MY_Model {

    // Set table name
    public $_table = 'service_booking';

    // Set primary key
    public $primary_key = 'id'; 

    // Set belongs to
    public $belongs_to = array( 
        'dealer' => array( 'model' => 'service/DealerNetworks', 'primary_key' => 'dealer_id' ),        
        'member' => array( 'model' => 'member/Members', 'primary_key' => 'service_member_id' )   
    );

    function __construct(){
        // Call the Model constructor
        parent::__construct();
        // Set database library
        $this->db = $this->load->database('default', true);
        $this->table = $this->db->dbprefix($this->_table);
    }

    /*
    public function getAvailableBooking($dealer_id, $start, $end, $periods)
    {
        $query = "SELECT id, time, date FROM tbl_bookings WHERE dealer_id = {$dealer_id} AND (date BETWEEN {$start} AND {$end}) ORDER BY date ASC";
        $select = $this->db->query($query);
        if ($select->num_rows() > 0)
        {
            $results = $select->result();
            $select->free_result();
            $booked = array();
            foreach ($results as $row)
            {
                if(array_key_exists($row->date, $booked))
                {
                    array_push($booked[$row->date], (int)$row->time);
                }
                else
                {
                    $booked[$row->date] = array((int)$row->time);
                }
            }
            $result = array();
            foreach ($periods as $key => $value)
            {
                if (array_key_exists($key, $booked))
                {
                    $times = array_diff($value, $booked[$key]);
                    $result[$key] = array_values($times);
                }
            }
            return $result;
        }
        return;
    }
    */
    
    public function getAvailableBooking($dealer_id, $start, $end, $periods)
    {
 
        $query = "SELECT id, time, date FROM tbl_service_booking WHERE dealer_id = {$dealer_id} AND (date BETWEEN {$start} AND {$end}) AND approved = 1 ORDER BY date ASC";
        $select = $this->db->query($query);
        if ($select->num_rows() > 0)
        {
            $results = $select->result();
            //print_r($results);
            //exit;
            $select->free_result();
            $booked = array();
            foreach ($results as $row)
            {
                if(array_key_exists($row->date, $booked))
                {
                    array_push($booked[$row->date], (int)$row->time);
                }
                else
                {
                    $booked[$row->date] = [(int)$row->time];
                }                
                //print_r($row);
            }
            //print_r($booked);
            $result = array();
            foreach ($periods as $key => $value)
            {   
                //print_r($booked[$key]);    
                //if(count($booked[$key]) == 2) {
                if($booked[$key]) {                  
                    $result[$key] = array_diff($value, $booked[$key]);
                    //print_r($result[$key]);
                    //exit;                
                } else {
                    $times = $value;
                    $result[$key] = array_values($times);
                }
                
                /*
                if (array_key_exists($key, $booked))
                {
                    $times = array_diff($value, $booked[$key]);
                    $result[$key] = array_values($times);
                } 
                */
            }
            //print_r($result);
            //exit;
            return $result;
        }
        return;
    }
    
    public function _getBookingVehicle ($vehicle_id) {

        $sql = "SELECT `service_vehicle_id`, `vin_number`, `plate_number`, `subject` FROM tbl_service_member_vehicle a JOIN tbl_service_vehicle b ON a.`service_vehicle_id` = b.`id` JOIN tbl_products c ON b.`vehicle_type` = c.`id` WHERE a.`service_vehicle_id` = '{$vehicle_id}'";
        $query = $this->db->query($sql);
        $return = '';
        foreach ($query->result() as $result) {
            $return = $result;
        }
        return $return;
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