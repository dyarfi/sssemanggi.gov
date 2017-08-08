<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Captcha
class Dealers extends CI_Model {

    public $table = 'dealer_networks';

    function __construct(){
        // Call the Model constructor
        parent::__construct();
        // Set database library
        $this->db = $this->load->database('default', true);
        $this->table = $this->db->dbprefix($this->table);
    }

    public function get_dealer_by_province($province_id, $select = null)
    {
        //$where = array('province' => $province_id, 'tags' => 'Automobile', 'status' => 'publish', 'categories' => 'Semua > Sales | Service ');
        $where = array('province' => $province_id, 'status' => 'publish');        
        $query = $this->db->select($this->_generateSelect($select))->order_by('name')->get_where($this->table, $where);
        $result = array();
        if ($query->num_rows() > 0)
        {
            $result = $query->result();
            $query->free_result();
        }
        return $result;
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