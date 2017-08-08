<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Model Class Object for Product static
class SurveyQuestions Extends MY_Model {

	public $_table = 'service_survey_question';

	// Set primary key
	public $primary_key = 'ssq_id';	

	// Set hars many
	public $has_many = array( 
	 	'survey_answers' => array(
	 		'model'=>'service/SurveyAnswers',			
	 		'primary_key'=>'ssq_id'
	 		)
	 	);
	
	public function __construct() {
		// Call the Model constructor
		parent::__construct();
		
		$this->db = $this->load->database('default', true);
		
		// Set default table
		$this->table = $this->db->dbprefix($this->_table);
				
	}

	public function count_user_answer_by_questions ($id ='',$date_start='',$date_end='') {

        $this->load->model('service/SurveyAnswers');        
        $this->load->model('service/SurveyRespondents');
        
        if ($date_start && $date_end) {     
            $this->db->cache_on();   
        	$surveys = $this->execute_query("SELECT ssq_type, count( ssa_value ) as count, ssa_value, added FROM `tbl_service_survey_answer` LEFT JOIN `tbl_service_survey_question` ON ( tbl_service_survey_answer.ssq_id = tbl_service_survey_question.ssq_id ) LEFT JOIN `tbl_service_survey_respondent` ON ( tbl_service_survey_answer.ssr_id = tbl_service_survey_respondent.ssr_id ) WHERE tbl_service_survey_respondent.added BETWEEN '".strtotime($date_start)."' AND '".strtotime($date_end)."' AND tbl_service_survey_question.ssq_id ={$id} GROUP BY tbl_service_survey_answer.ssa_value ORDER BY added ASC")->result();
            //print_r($surveys);
        	//print_r($this->last_query);
            //exit;
            //$i = range(1,11);
            foreach ($surveys as $survey) {
                //print_r(date('Y-m-d',$survey->added));
                if ($survey->ssq_type == 'boolean') {
                    //print_r($survey->ssa_value);
                    //exit;
                    if ($survey->ssa_value == 1) {
                        $result[]   = ['Ya : '. $survey->count, (int) $survey->count];
                    } 
                    if ($survey->ssa_value == 0) {
                        $result[]   = ['Tidak : '. $survey->count, (int) $survey->count];
                    }
                    //print_r($result);
                } else if ($survey->ssq_type == 'range') { 

                    $temp = '';
                    for ($i=1; $i <= 10; $i++) {
                        $temp = [(int) $survey->ssa_value, (int) $survey->count];
                    }
                    $result[] = $temp;           

                } else if ($survey->ssq_type == 'freetext') {

                    $result[]     = ['ssa_value'=>$survey->ssa_value,'added'=>$survey->added];
                    
                } else if ($survey->ssq_type == 'objective') {

                    if ($survey->ssa_value == 1) {
                        $result[]   = ['Memuaskan : '. $survey->count, (int) $survey->count];
                    } 
                    if ($survey->ssa_value == 0) {
                        $result[]   = ['Mengecewakan : '. $survey->count, (int) $survey->count];
                    }
                    
                } else {

                }                
            }
            //print_r($result);
            //exit;
            return $result; 
        	//exit;
    	} else {
    		$survey = $this->get($id);
    	}

        $result = array();

        if ($survey->ssq_type == 'boolean') {

        	$result[] 	= ['Ya : '. $this->SurveyAnswers->findCount(['ssq_id'=>$id,'ssa_value'=>1]),$this->SurveyAnswers->findCount(['ssq_id'=>$id,'ssa_value'=>1])];
			$result[] 	= ['Tidak : '. $this->SurveyAnswers->findCount(['ssq_id'=>$id,'ssa_value'=>0]),$this->SurveyAnswers->findCount(['ssq_id'=>$id,'ssa_value'=>0])];
        	
        } else if ($survey->ssq_type == 'range') { 

        	for ($i=1; $i <= 10; $i++) {
				
    			$result[] = [$i,$this->SurveyAnswers->findCount(['ssq_id'=>$id,'ssa_value'=>$i])];
        		//$result[] = [];

        	}        	

        } else if ($survey->ssq_type == 'freetext') {

        	$result 	= $this->SurveyAnswers->findAllBy('ssq_id',$id);
        	
        } else if ($survey->ssq_type == 'objective') {

        	$result[] 	= ['Memuaskan : '. $this->SurveyAnswers->findCount(['ssq_id'=>$id,'ssa_value'=>1]),$this->SurveyAnswers->findCount(['ssq_id'=>$id,'ssa_value'=>1])];
			$result[] 	= ['Mengecewakan : '. $this->SurveyAnswers->findCount(['ssq_id'=>$id,'ssa_value'=>0]),$this->SurveyAnswers->findCount(['ssq_id'=>$id,'ssa_value'=>0])];
        	
        } else {

        }

        //exit;      
        return $result;   
	}
}
