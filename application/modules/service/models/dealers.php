<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Dealers
class Dealers extends MY_Model {

    public $_table = 'dealers';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        // Set database library
        $this->db = $this->load->database('default', true);
        $this->table = $this->db->dbprefix($this->_table);
    }

    public function get_dealer_by_province($province_id, $select = null)
    {
        $where = array('province_id' => $province_id);
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