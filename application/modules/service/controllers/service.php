<?php

class Service extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
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

    public function index()
    {
        try {
            // Set our Grocery CRUD
            $crud = new grocery_CRUD();
            // Set CRUD language
            $crud->set_language($this->i18ln->native);
            // Works exactly the same way as codeigniter's where ($this->db->where)
            $crud->where('type','news');
            // Order by Listing
            $crud->order_by('publish_date','DESC');
            // Set tables
            $crud->set_table('tbl_news');
            // Set relation tables
            $crud->set_relation_n_n('tags', 'tbl_tags_to_news', 'tbl_tags', 'news_id', 'tag_id', 'subject', 'priority');
            // Set CRUD subject
            $crud->set_subject(lang('News'));
            // Set columns
            $crud->columns('subject','text','media','publish_date','status','added','modified');
            // The fields that user will see on add and edit form
            $crud->fields('subject','url','text','media','type','tags','publish_date','status','added','modified');
            // Changes the default field type
            $crud->field_type('url', 'hidden');
            $crud->field_type('type', 'hidden');
            $crud->field_type('added', 'hidden');
            $crud->field_type('modified', 'hidden');
            // Set unique fields
            $crud->unique_fields('subject','url');

            if ($this->Languages->getActiveCount() > 1) {
                // Default column of multilanguage
                $crud->columns('subject','is_highlight','media','publish_date','status','added','modified','translate');
                // Callback_column translate
                $crud->callback_column('translate',array($this,'_callback_translate'));
            }

            // This callback escapes the default auto field output of the field name at the add form
            $crud->callback_add_field('added',array($this,'_callback_time_added'));
            // This callback escapes the default auto field output of the field name at the edit form
            $crud->callback_edit_field('modified',array($this,'_callback_time_modified'));
            // This callback escapes the default auto field output of the field name at the add/edit form.
            $crud->callback_field('highlight',array($this,'_callback_field_highlight'));
            // This callback escapes the default auto field output of the field name at the add/edit form.
            $crud->callback_field('type',array($this,'_callback_field_type'));

            // Callback Column
            $crud->callback_column('media',array($this,'_callback_column_image'));
            // $crud->callback_column('is_highlight',array($this,'_callback_is_highlight'));

            // This callback escapes the default auto column output of the field name at the add form
            $crud->callback_column('added',array($this,'_callback_time'));
            $crud->callback_column('modified',array($this,'_callback_time'));
            // Set callback before database set
            $crud->callback_before_insert(array($this,'_callback_url'));
            $crud->callback_before_update(array($this,'_callback_url'));
            $crud->callback_after_delete(array($this,'_callback_after_delete'));

            // Sets the required fields of add and edit fields
            $crud->required_fields('subject','text','media','publish_date','status');
            $crud->set_rules('subject','Subject','trim|required|min_length[3]|max_length[128]|xss_clean');
            $crud->set_rules('text','Text','trim|min_length[3]|xss_clean');

            // Set callback after upload
            $crud->callback_after_upload(array($this,'_callback_after_upload'));

            // Set upload field
            $crud->set_field_upload('media','uploads/news', $this->notes->media['ext']);

            // Changes the displaying label of the field.
            $crud->display_as('media','Image');

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
                $crud->callback_field('media',array($this,'_callback_media'));
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
            if(!$this->is_allowed[$this->class.'/index/delete']) {
                $crud->unset_delete();
            }
            if(!$this->is_allowed[$this->class.'/index/edit']) {
                $crud->unset_edit();
            }
            if(!$this->is_allowed[$this->class.'/index/read']) {
                $crud->unset_read();
            }
            if(!$this->is_allowed[$this->class.'/index/add']) {
                $crud->unset_add();
            }
            // Load Grocery Crud
            $this->load($crud, 'newscenter');
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }


}