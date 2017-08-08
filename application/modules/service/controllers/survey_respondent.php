<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survey_Respondent extends Admin_Controller {

    /**
     * Index Media for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct() {
        parent::__construct();

        // Load Media model
        //$this->load->model('Media');

        // Load Grocery CRUD
        $this->load->library('grocery_CRUD');

        // Set priviledge
        $class       = 'Service';// get_class();
        //$this->class = strtolower(get_class());
        $this->class = strtolower($class);
        $this->module_function_list[$class];
        $this->is_allowed = $this->module_function_list[$class];
        $this->notes->media = [
            'ext' => 'jpg|jpeg',
            'dimension' => '800x400'
        ];

    }

    public function index() {
        try {
            // Set our Grocery CRUD
            $crud = new grocery_CRUD();
            // Set CRUD language
            $crud->set_language($this->i18ln->native);
            // Works exactly the same way as codeigniter's where ($this->db->where)
            // $crud->where("type = 'svc-artc' OR type = 'svc-evt' OR type = 'svc-blog'");
            // Set tables
            $crud->set_table('tbl_service_survey_respondent')->order_by('added','DESC');
            // Set CRUD subject
            $crud->set_subject(lang('Survey Respondent'));
            // The fields that user will see on add and edit form
            $crud->columns('ssr_name', 'ssr_email', 'ssr_phone_number','question');
            // Display field header
            $crud->display_as('ssr_name', 'Name')
                ->display_as('ssr_emal', 'Email')
                ->display_as('ssr_phone_number', 'Phone');

            $crud->callback_field('ssr_type',array($this,'_callback_field_type'));

            // This callback escapes the default auto column output of the field name at the add form
            $crud->callback_column('ssr_type',array($this,'_callback_type'));
            $crud->callback_column('question',array($this,'_callback_question'));
            
//            $crud->required_fields('subject','text','publish_date','status', 'type');
            $crud->set_rules('ssr_subject','Subject','trim|required|min_length[3]|max_length[128]|xss_clean');

            $state = $crud->getState();
            $state_info = $crud->getStateInfo();
            //print_r($state);

            if ($state == 'add') {
                // GC Add Method
            } else if($state == 'edit') {
                // GC Edit Method.
            } else if($state == 'detail') {
                // GC Edit Method.
                // exit('asdf');
            } else if($state == 'read') {
                // GC Edit Method.
            } else {
                // GC List Method
                /*
                    // Get languages from db
                    foreach($this->Languages->getAllLanguage() as $lang) {
                        //default is the default language
                        if($lang->default != 1) {
                            $crud->add_action($lang->name, base_url('assets/admin/img/flags/'.$lang->prefix.'.png'),'media/insert_and_redirect/'.$lang->id);
                        }
                    }
                 *
                 */
            }

            // Set allowed access
            if(!$this->is_allowed[$this->class.'/survey/index/delete']) {
                $crud->unset_delete();
            }
            if(!$this->is_allowed[$this->class.'/survey/index/edit']) {
                $crud->unset_edit();
            }
            //if(!$this->is_allowed[$this->class.'/survey/index/read']) {
                //$crud->unset_read();
            //}
            if(!$this->is_allowed[$this->class.'/survey/index/add']) {
                $crud->unset_add();
            }
            $crud->unset_add();
            $crud->unset_delete();            
            $crud->unset_edit();
            // Load Grocery Crud
            $this->load($crud, 'service');
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function _callback_field_type($value = '', $primary_key = null) {

        return '<select name="ssr_type">
                <option value="freetext">Teks Bebas</option>
                <option value="boolean">Pilihan</option>
                <option value="range">Jangka</option>
                <option value="objective">Objektif</option>
                </select>';
    }

    public function _callback_type ($value, $row) {
        $result = 'Text Bebas';
        if ($value == 'freetext')
        {
            $result = 'Teks Bebas';
        }
        else if ($value == 'boolean')
        {
            $result = 'Pilihan';
        }
        else if ($value == 'range')
        {
            $result = 'Jangka';
        } else if ($value == 'objective')
        {
            $result = 'Objektif';
        }
        return $result;
    }

    public function _callback_question ($value, $row) {
        $sql = "SELECT 
            tbl_service_survey_question.ssq_subject,
            tbl_service_survey_question.ssq_type,
            tbl_service_survey_answer.ssa_value
            FROM `tbl_service_survey_question` 
            LEFT JOIN `tbl_service_survey_answer` ON tbl_service_survey_question.ssq_id = tbl_service_survey_answer.ssq_id
            LEFT JOIN `tbl_service_survey_respondent` ON tbl_service_survey_answer.ssr_id = tbl_service_survey_respondent.ssr_id WHERE tbl_service_survey_respondent.ssr_id = '{$row->ssr_id}'";
        
        $query = $this->db->query($sql);
        $result = '';
        
        foreach ($query->result() as $results) {
            $result .= '<strong>'.$results->ssq_subject.'</strong>';
            if ($results->ssq_type == 'boolean') {
                $result .= '<h6>'.($results->ssa_value == 1 ? 'Ya':'Tidak').'</h6>&nbsp;';
            } else if ($results->ssq_type == 'objective') {                 
                $result .= '<h6>'.($results->ssa_value == 1 ? 'Memuaskan':'Mengecewakan').'</h6>&nbsp;';
            } else {                
                $result .= '<h6>'.$results->ssa_value.'</h6>';
            }

        }
        return $result;
    }

    private function load($crud, $nav) {
        $output = $crud->render();
        $output->nav = $nav;
        if ($crud->getState() == 'list') {
            // Set Media Title
            $output->page_title = lang('Survey').' Listings';
            // Set Main Template
            $output->main       = 'template/admin/metronix';
            // Set Primary Template
            $this->load->view('template/admin/template.php', $output);
        } else {
            // Set Page Title
            $output->page_title = lang('Survey').' Listings';
            // Set note for popup message
            $output->notes 		= $this->notes;
            // Set Primary Template
            $this->load->view('template/admin/popup.php', $output);
        }
    }
}

/* End of file media.php */
/* Location: ./application/module/media/controllers/media.php */