<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ServiceMember_approval extends Admin_Controller {

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
            $crud->where("type = 'Service'");
            $crud->where("approved = '0' and confirmed = '1'");
            // Order by Listing
            $crud->order_by('id','DESC');
            // Set tables
            $crud->set_table('tbl_members');
            // Set relation tables
            // $crud->set_relation_n_n('tags', 'tbl_tags_to_news', 'tbl_tags', 'news_id', 'tag_id', 'subject', 'priority');
            // Set CRUD subject
            $crud->set_subject(lang('Member Approval'));
            // Set columns
            $crud->columns('username','email','phone_number','fullname', 'gender' ,'birthdate');
            // The fields that user will see on add and edit form
            $crud->fields('username','email','phone_number','fullname', 'gender' ,'birthdate', 'approved', 'status');

            // This callback escapes the default auto field output of the field name at the add/edit form.
            //$crud->callback_field('type',array($this,'_callback_field_type'));

            // Callback Column
            //$crud->callback_column('media',array($this,'_callback_column_image'));
             $crud->callback_column('gender',array($this,'_callback_gender'));

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
            if(!$this->is_allowed[$this->class.'/member_approval/index/delete']) {
                $crud->unset_delete();
            }
            if(!$this->is_allowed[$this->class.'/member_approval/index/edit']) {
                $crud->unset_edit();
            }
            if(!$this->is_allowed[$this->class.'/member_approval/index/read']) {
                $crud->unset_read();
            }
            if(!$this->is_allowed[$this->class.'/member_approval/index/add']) {
                $crud->unset_add();
            }
            $crud->unset_print();
            $crud->unset_export();
            // Load Grocery Crud
            $this->load($crud, 'member_approval');
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function _callback_gender($value, $row)
    {
        if ($value == '1') {
            return 'Male';
        } else {
            return 'Female';
        }
    }

    private function load($crud, $nav) {
        $output = $crud->render();
        $output->nav = $nav;
        if ($crud->getState() == 'list') {
            // Set Media Title
            $output->page_title = lang('Member Approval').' Listings';
            // Set Main Template
            $output->main       = 'template/admin/metronix';
            // Set Primary Template
            $this->load->view('template/admin/template.php', $output);
        } else {
            // Set Page Title
            $output->page_title = lang('Member Approval').' Listings';
            // Set note for popup message
            $output->notes 		= $this->notes;
            // Set Primary Template
            $this->load->view('template/admin/popup.php', $output);
        }
    }
}

/* End of file media.php */
/* Location: ./application/module/media/controllers/media.php */
