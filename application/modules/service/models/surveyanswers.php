<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Product static
class SurveyAnswers Extends MY_Model {

	public $_table = 'service_survey_answer';

	// Set primary key
	public $primary_key = 'ssa_id';	

    // Set belongs to
    public $belongs_to = array( 
        'survey_question' => 
            array( 'model' => 'service/SurveyQuestions', 'primary_key' => 'ssq_id' )  
    );
	
	public function __construct() {
		// Call the Model constructor
		parent::__construct();
		
		$this->db = $this->load->database('default', true);
		
		// Set default table
		$this->table = $this->db->dbprefix($this->_table);
				
	}
}
