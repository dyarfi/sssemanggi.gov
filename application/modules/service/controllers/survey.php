<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survey extends Admin_Controller {

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
//            $crud->where("type = 'svc-artc' OR type = 'svc-evt' OR type = 'svc-blog'");
            // Set tables
            $crud->set_table('tbl_service_survey_question')->order_by('ssq_id','asc');
            // Set CRUD subject
            $crud->set_subject(lang('Survey'));
            // Set columns
            $crud->columns('ssq_subject', 'ssq_type'/*, 'chart'*/);
            // The fields that user will see on add and edit form
            //$crud->columns('ssq_subject', 'ssq_type');

            $crud->display_as('ssq_subject', 'Subject')
                ->display_as('ssq_type', 'Tipe');

            $crud->callback_field('ssq_type',array($this,'_callback_field_type'));

            // This callback escapes the default auto column output of the field name at the add form
            $crud->callback_column('ssq_type',array($this,'_callback_type'));
            //$crud->callback_column('chart',array($this,'_callback_chart'));
          
//          $crud->required_fields('subject','text','publish_date','status', 'type');
            $crud->set_rules('ssq_subject','Subject','trim|required|min_length[3]|max_length[128]|xss_clean');

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
            if(!$this->is_allowed[$this->class.'/survey/index/read']) {
                $crud->unset_read();
            }
            if(!$this->is_allowed[$this->class.'/survey/index/add']) {
                $crud->unset_add();
            }
            // Load Grocery Crud
            $this->load($crud, 'service');
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function _callback_field_type($value = '', $primary_key = null) {

        return '<select name="ssq_type">
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

    public function _callback_chart($value,$row) {

        return '<a href="'.base_url(ADMIN).'/service/survey_dashboard/index?active=current&data_id='.$row->ssq_id.'&quest_type='.$row->ssq_type.'" class="fancyframe iframe"><span class="btn btn-default btn-mini glyphicon glyphicon glyphicon-adjust"></span></a>';

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