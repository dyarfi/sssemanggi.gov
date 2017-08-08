<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Product static
class Surveys Extends MY_Model {

	public $_table = 'service_survey_question';

	// Set primary key
	public $primary_key = 'ssq_id';	

	// Belong to and has many relationship
	public $has_many = ['survey_answers' => [
							// Set relation Model
							'model' => 'service/SurveyAnswers',
							// Set Foreign Key to primary key
							'primary_key'=>'ssq_id',
							],
						'survey_respondent' => [
							// Set relation Model
							'model' => 'service/SurveyRespondents',
							// Set Foreign Key to primary key
							'primary_key'=>'product_id',
							]
						];
	
	public function __construct() {
		
		// Call the Model constructor
		parent::__construct();
		
		$this->db = $this->load->database('default', true);
		
		// Set default table
		$this->table = $this->db->dbprefix($this->_table);
				
	}
}
