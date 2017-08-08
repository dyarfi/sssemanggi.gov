<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Static_content extends Admin_Controller {

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
            // Order by Listing
            $crud->order_by('ssc_publish_date','DESC');
            // Set tables
            $crud->set_table('tbl_service_static_content');
            // Set CRUD subject
            $crud->set_subject(lang('Static Content'));
            // Set columns
            $crud->columns('ssc_subject','ssc_text','ssc_publish_date', 'ssc_type' ,'ssc_status','ssc_added','ssc_modified');
            // The fields that user will see on add and edit form
            $crud->fields('ssc_subject','ssc_url','ssc_text','ssc_type', 'ssc_publish_date','ssc_status','ssc_added','ssc_modified');

            $crud->display_as('ssc_subject', 'Subject')
                ->display_as('ssc_text', 'Text')
                ->display_as('ssc_publish_date', 'Publish Date')
                ->display_as('ssc_type', 'Type')
                ->display_as('ssc_status', 'Status')
                ->display_as('ssc_added', 'Added')
                ->display_as('ssc_modified', 'Modified');
            // Changes the default field type
            $crud->field_type('ssc_url', 'hidden');
            $crud->field_type('ssc_added', 'hidden');
            $crud->field_type('ssc_modified', 'hidden');
            $crud->field_type('ssc_type','dropdown',array('24jamsera' => 'Layanan 24 Jam Sera','halo_suzuki'=>'Halo Suzuki'));

            // Set unique fields
//            $crud->unique_fields('subject','url');

//            if ($this->Languages->getActiveCount() > 1) {
//                // Default column of multilanguage
//                $crud->columns('subject','is_highlight','media','publish_date','status','added','modified','translate');
//                // Callback_column translate
//                $crud->callback_column('translate',array($this,'_callback_translate'));
//            }

            // This callback escapes the default auto field output of the field name at the add form
            $crud->callback_add_field('ssc_added',array($this,'_callback_time_added'));
            // This callback escapes the default auto field output of the field name at the edit form
            $crud->callback_edit_field('ssc_modified',array($this,'_callback_time_modified'));
            // This callback escapes the default auto field output of the field name at the add/edit form.
            // $crud->callback_field('ssc_type',array($this,'_callback_field_type'));
            // $crud->callback_column('is_highlight',array($this,'_callback_is_highlight'));

            // This callback escapes the default auto column output of the field name at the add form
            $crud->callback_column('ssc_added',array($this,'_callback_time'));
            $crud->callback_column('ssc_modified',array($this,'_callback_time'));
            // Set callback before database set
            $crud->callback_before_insert(array($this,'_callback_url'));
            $crud->callback_before_update(array($this,'_callback_url'));
            $crud->callback_after_delete(array($this,'_callback_after_delete'));

            // Sets the required fields of add and edit fields
//            $crud->required_fields('subject','text','publish_date','status', 'type');
            $crud->set_rules('ssc_subject','Subject','trim|required|min_length[3]|max_length[128]|xss_clean');
            $crud->set_rules('ssc_text','Text','trim|min_length[3]|xss_clean');

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
            if(!$this->is_allowed[$this->class.'/tips/index/delete']) {
                $crud->unset_delete();
            }
            if(!$this->is_allowed[$this->class.'/tips/index/edit']) {
                $crud->unset_edit();
            }
            if(!$this->is_allowed[$this->class.'/tips/index/read']) {
                $crud->unset_read();
            }
            if(!$this->is_allowed[$this->class.'/tips/index/add']) {
                $crud->unset_add();
            }
            // Load Grocery Crud
            $this->load($crud, 'service');
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function _callback_after_delete($primary_key) {
        // Delete translation field
//        return $this->db->delete('tbl_translations', ['field_id' => $primary_key, 'table' => 'tbl_news']);
        return true;
    }

    public function _callback_field_type($value = '', $primary_key = null) {

        return '<select name="ssc_type">
                <option value="automobile">Automobile</option>
                <option value="motorcycle">MotorCycle</option>
                <option value="Marine">Marine</option>
                </select>';
    }

    public function _callback_url($value, $primary_key) {
        // Set url_title() function to set readable text
        $value['ssc_url'] = url_title($value['ssc_subject'],'-',true);
        // Return update database
        return $value;
    }

    public function _callback_time ($value, $row) {
        return empty($value) ? '-' : date('D, d-M-Y',$value);
    }

    public function _callback_time_added ($value, $row) {
        $time = time();
        return '<input type="hidden" maxlength="50" value="'.$time.'" name="ssc_added">';
    }

    public function _callback_time_modified ($value, $row) {
        $time = time();
        return '<input type="hidden" maxlength="50" value="'.$time.'" name="ssc_modified">';
    }

    private function load($crud, $nav) {
        $output = $crud->render();
        $output->nav = $nav;
        if ($crud->getState() == 'list') {
            // Set Media Title
            $output->page_title = lang('Static Content').' Listings';
            // Set Main Template
            $output->main       = 'template/admin/metronix';
            // Set Primary Template
            $this->load->view('template/admin/template.php', $output);
        } else {
            // Set Page Title
            $output->page_title = lang('Static Content').' Listings';
            // Set note for popup message
            $output->notes 		= $this->notes;
            // Set Primary Template
            $this->load->view('template/admin/popup.php', $output);
        }
    }
}

/* End of file media.php */
/* Location: ./application/module/media/controllers/media.php */