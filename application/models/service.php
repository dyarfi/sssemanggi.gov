<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Captcha
class Service extends CI_Model {

    public $table = 'bookings';

    function __construct(){
        // Call the Model constructor
        parent::__construct();
        // Set database library
        $this->db = $this->load->database('default', true);
        $this->table = $this->db->dbprefix($this->table);
    }

    public function get_static_product($type){
    	$where = array('sps_type' => $type);
        $query = $this->db->select()->get_where('tbl_service_product_static', $where);
        $result = array();
        if ($query->num_rows() > 0)
        {
            $result = $query->result();
            $query->free_result();
        }
        return $result;
    }

    public function get_static_product_by_url($url){
    	$where = array('sps_url' => $url);
        $query = $this->db->select()->get_where('tbl_service_product_static', $where);
        $result = array();
        if ($query->num_rows() > 0)
        {
            $result = $query->row();
            $query->free_result();
        }
        return $result;
    }

    public function get_static_content_by_type($type){
    	//echo $type;
    	$where = array('ssc_type' => $type);
        $query = $this->db->select()->get_where('tbl_service_static_content', $where);
        $result = new stdClass();
        if ($query->num_rows() > 0)
        {
            $result = $query->row();
            $query->free_result();
        }
        return $result;
    }
}