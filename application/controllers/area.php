<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Area extends Public_Controller {

	public function __construct() {
		parent::__construct();		

        // Load Region models
        $this->load->model('region/Provinces');
        $this->load->model('region/Suburbans');
        $this->load->model('region/Urbandistricts');
        $this->load->model('region/Districts');     

	}

	public function get_area ($param=null) {
		
		$ids = $this->input->post('id');
		
		if($param == 'province') {
            
            $result['result'] = $this->Urbandistricts->getByProvince($ids);
            $result['bindto'] = 'urbandistrict';
            $result['label'] = 'KABUPATEN';
            
		} else if($param == 'urbandistrict') {
            
            $result['result'] = $this->Suburbans->getByUrban($ids);
            $result['bindto'] = 'suburban';
            $result['label'] = 'KECAMATAN';
            
		} else if($param == 'suburban') {
            
            $result['result'] = $this->Districts->getBySubUrban($ids);
            
		}
				
		// Return data esult
		$data['json'] = $result;

		// Load data into view		
		$this->load->view('json', $this->load->vars($data));	
		
	}
}

/* End of file site_page.php */
/* Location: ./application/controllers/site_page.php */