<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Captcha
class Bookings extends CI_Model {

    public $table = 'bookings';

    function __construct(){
        // Call the Model constructor
        parent::__construct();
        // Set database library
        $this->db = $this->load->database('default', true);
        $this->table = $this->db->dbprefix($this->table);
    }

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