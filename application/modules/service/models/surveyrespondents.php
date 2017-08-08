<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Product static
class SurveyRespondents Extends MY_Model {

	public $_table = 'service_survey_respondent';

	// Set primary key
	public $primary_key = 'ssr_id';	
	
	    // Set belongs to
    public $belongs_to = array( 
        'survey_answer' => 
            array( 'model' => 'service/SurveyAnswers', 'primary_key' => 'ssr_id' )  
    );

	public function __construct() {
		// Call the Model constructor
		parent::__construct();
		
		$this->db = $this->load->database('default', true);
		
		// Set default table
		$this->table = $this->db->dbprefix($this->_table);
				
	}
}
