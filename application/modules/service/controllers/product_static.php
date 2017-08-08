<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_static extends Admin_Controller {

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
        $this->load->model('product_static_model');

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
            // Set tables
            $crud->set_table('tbl_service_product_static');
            // Set CRUD subject
            $crud->set_subject(lang('Product Static'));
            // Set columns
            $crud->columns('sps_subject','sps_text', 'sps_type' ,'sps_status','sps_added','sps_modified');
            // The fields that user will see on add and edit form
            $crud->fields('sps_subject','sps_url','sps_ext_url','sps_text','sps_title','sps_image_url','sps_type','sps_status','sps_added','sps_modified');

            $crud->display_as('sps_subject', 'Subject')
                ->display_as('sps_text', 'Text')
                ->display_as('sps_type', 'Type')
                ->display_as('sps_status', 'Status')
                ->display_as('sps_added', 'Added')
                ->display_as('sps_modified', 'Modified')
                ->display_as('sps_title', 'Title')
                ->display_as('sps_image_url', 'Thumbnail')
                ->display_as('sps_ext_url', 'Ext URL');
            // Changes the default field type
            $crud->field_type('sps_url', 'hidden');
            $crud->field_type('sps_added', 'hidden');
            $crud->field_type('sps_modified', 'hidden');
            $crud->field_type('sps_type','dropdown',array('automobile' => 'Automobile','motorcycle' => 'Motorcycle','marine' => 'Marine','sgo'=>'SGO','sgp'=>'SGP','sgc'=>'SGC'));

            $crud->set_field_upload('sps_image_url','uploads/static/service/');
            // Set unique fields
//            $crud->unique_fields('subject','url');

//            if ($this->Languages->getActiveCount() > 1) {
//                // Default column of multilanguage
//                $crud->columns('subject','is_highlight','media','publish_date','status','added','modified','translate');
//                // Callback_column translate
//                $crud->callback_column('translate',array($this,'_callback_translate'));
//            }

            // This callback escapes the default auto field output of the field name at the add form
            $crud->callback_add_field('sps_added',array($this,'_callback_time_added'));
            // This callback escapes the default auto field output of the field name at the edit form
            $crud->callback_edit_field('sps_modified',array($this,'_callback_time_modified'));
            // This callback escapes the default auto field output of the field name at the add/edit form.
            $crud->callback_add_field('sps_ext_url',array($this,'_callback_add_ext_url'));
            // This callback escapes the default auto field output of the field name at the edit form
            $crud->callback_edit_field('sps_ext_url',array($this,'_callback_edit_ext_url'));   
            // $crud->callback_field('sps_type',array($this,'_callback_field_type'));
            // $crud->callback_column('is_highlight',array($this,'_callback_is_highlight'));

            // This callback escapes the default auto column output of the field name at the add form
            $crud->callback_before_insert(array($this,'_callback_url'));
            $crud->callback_before_update(array($this,'_callback_url'));
            
            $crud->callback_column('sps_added',array($this,'_callback_time'));
            $crud->callback_column('sps_modified',array($this,'_callback_time'));
            // Set callback before database set
            $crud->callback_after_delete(array($this,'_callback_after_delete'));

            // Sets the required fields of add and edit fields
//            $crud->required_fields('subject','text','publish_date','status', 'type');
            $crud->set_rules('sps_subject','Subject','trim|required|min_length[3]|max_length[128]|xss_clean');
            $crud->set_rules('sps_text','Text','trim|min_length[3]|xss_clean');

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
            if(!$this->is_allowed[$this->class.'/product_static/index/delete']) {
                $crud->unset_delete();
            }
            if(!$this->is_allowed[$this->class.'/product_static/index/edit']) {
                $crud->unset_edit();
            }
            if(!$this->is_allowed[$this->class.'/product_static/index/read']) {
                $crud->unset_read();
            }
            if(!$this->is_allowed[$this->class.'/product_static/index/add']) {
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

        // echo '<pre>';
        $list_data = $this->product_static_model->get_list_home_type();

        $type = '<select name="sps_type">';
        $type .= '<option value="home">Home</option>';
        foreach($list_data as $type_data){
            $type .= '<option value="'.$type_data->sps_url.'">'.$type_data->sps_subject.'</option>';
        }
        $type .= '</select>';

        return $type;
        // return '<select name="sps_type">
        //         <option value="home">Home</option>
        //         <option value="motorcycle">MotorCycle</option>
        //         <option value="Marine">Marine</option>
        //         </select>';
    }

    public function _callback_time ($value, $row) {
        return empty($value) ? '-' : date('D, d-M-Y',$value);
    }

    public function _callback_time_added ($value, $row) {
        $time = time();
        return '<input type="hidden" maxlength="50" value="'.$time.'" name="sps_added">';
    }

    public function _callback_time_modified ($value, $row) {
        $time = time();
        return '<input type="hidden" maxlength="50" value="'.$time.'" name="sps_modified">';
    }

    public function _callback_add_ext_url ($value, $row) {
        return lang('no').' <input type="radio" value="0" name="sps_ext_url" checked>&nbsp;&nbsp;&nbsp;&nbsp;'.lang('yes').' <input type="radio" value="1" name="sps_ext_url"> ';
    }

    public function _callback_edit_ext_url ($value, $row) {     
        
        $input = lang('no').' <input type="radio" value="0" name="sps_ext_url" '.(($value == 0) ? 'checked':'').'>&nbsp;&nbsp;&nbsp;&nbsp;'.lang('yes').' <input type="radio" value="1" name="sps_ext_url" '.(($value==1) ? 'checked' :'').'> ';
                
        return $input;
    }

    public function _callback_url($value, $primary_key) {

        // Check if ext_url is true 
        if ($value['sps_ext_url'] != 1) {

           $url = url_title($value['sps_subject'],'-',true);
        
            // Set url_title() function to set readable text
            $value['sps_url'] = $url;

        }

        // Return update database
        return $value; 
    }   

    private function load($crud, $nav) {
        $output = $crud->render();
        $output->nav = $nav;
        if ($crud->getState() == 'list') {
            // Set Media Title
            $output->page_title = lang('Product Static').' Listings';
            // Set Main Template
            $output->main       = 'template/admin/metronix';
            // Set Primary Template
            $this->load->view('template/admin/template.php', $output);
        } else {
            // Set Page Title
            $output->page_title = lang('Product Static').' Listings';
            // Set note for popup message
            $output->notes 		= $this->notes;
            // Set JS Inline
            $output->js_inline  = "

            var input = $('input[name=\"sps_ext_url\"]');

            if ($('input[name=\"sps_ext_url\"]:checked').val() == 0) {

                $('#field-sps_url').attr('type','hidden');
                
            } else {
                
                var sel = $('#field-sps_url');
                sel.attr('type','text').detach().insertAfter(input.last());

            }

            
            input.change(function() { 

                var obj = $(this);
                if (obj.val() == 1) {
                    var sel = obj.parents('.form-div').find('#field-sps_url');
                    sel.attr('type','text').detach().insertAfter(obj.last());
                } else {
                    obj.parents('.form-div').find('#field-sps_url').attr('type','hidden');
                }

            });

            ";          
            // Set Primary Template
            $this->load->view('template/admin/popup.php', $output);
        }
    }
}

/* End of file media.php */
/* Location: ./application/module/media/controllers/media.php */