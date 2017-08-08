<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductCategory extends Admin_Controller {

    /**
     * Index Page for this controller.
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

            // Load Product Categories model
            $this->load->model('ProductCategories');

            // Load PageMenu model
            $this->load->model('Products');

            // Load Grocery CRUD
            $this->load->library('grocery_CRUD');

            // Set priviledge
            $class       = 'Product';
            $this->class = strtolower(get_class());
            $this->is_allowed = $this->module_function_list[$class];
    }

    public function index() {
        try {
            // Set our Grocery CRUD
            $crud = new grocery_CRUD();
            // Set CRUD language
            $crud->set_language($this->i18ln->native);
            // Order by Listing
            $crud->order_by('priority','ASC');
         	// Set tables
            $crud->set_table($this->ProductCategories->table);
            // Set CRUD subject
            $crud->set_subject(lang('Product Categories'));
            // Set columns
            $crud->columns('subject','type','priority','status','added','modified');
			// The fields that user will see on add and edit form
			$crud->fields('subject','type','url','priority','user_id','status','added','modified');
            // Changes the default field type
			$crud->field_type('user_id','hidden', $this->acl->user()->id);
			$crud->field_type('url', 'hidden');
            $crud->field_type('added', 'hidden');
			$crud->field_type('modified', 'hidden');

			// Set unique fields
			$crud->unique_fields('subject','url');

			if ($this->Languages->getActiveCount() > 1) {
				// Default column of multilanguage
				$crud->columns('subject','url','text','status','added','modified','translate');
				// Callback_column translate
				$crud->callback_column('translate',array($this,'_callback_translate'));
			}

			// This callback escapes the default auto field output of the field name at the add form
			$crud->callback_add_field('added',array($this,'_callback_time_added'));
			// This callback escapes the default auto field output of the field name at the edit form
			$crud->callback_edit_field('modified',array($this,'_callback_time_modified'));
			// This callback escapes the default auto field output of the field name at the add/edit form.
			// $crud->callback_field('status',array($this,'_callback_dropdown'));
            // Callback fields for priority
            $crud->callback_edit_field('priority',array($this,'_callback_priority_edit'));
            $crud->callback_add_field('priority',array($this,'_callback_priority_add'));

            // This callback escapes the default auto column output of the field name at the add form
			$crud->callback_column('added',array($this,'_callback_time'));
			$crud->callback_column('modified',array($this,'_callback_time'));
			// Set callback before database set
            $crud->callback_before_insert(array($this,'_callback_url'));
            $crud->callback_before_update(array($this,'_callback_url'));
            $crud->callback_after_delete(array($this,'_callback_after_delete'));

			// Sets the required fields of add and edit fields
			$crud->required_fields('subject','text','status');
        	$crud->set_rules('subject','Subject','trim|required|min_length[2]|max_length[72]|xss_clean');
        	$crud->set_rules('text','Text','trim|min_length[2]|xss_clean');

            // Set upload field
            // $crud->set_field_upload('file_name','uploads/pages');

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
			} else {
				// GC List Method
				/*
					// Get languages from db
					foreach($this->Languages->getAllLanguage() as $lang) {
						//default is the default language
						if($lang->default != 1) {
							$crud->add_action($lang->name, base_url('assets/admin/img/flags/'.$lang->prefix.'.png'),'page/insert_and_redirect/'.$lang->id);
						}
					}
				 *
				 */
			}

            // Set upload field
            $crud->set_field_upload('media','uploads/automobile');
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
            // Unset action
            $crud->unset_delete();
			// Load Grocery Crud
            $this->load($crud, 'productcategory');
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

	public function _callback_url($value, $primary_key) {
        // Set url_title() function to set readable text
        $value['url'] = url_title($value['subject'],'-',true);
        // Return update database
        return $value;
    }

    public function _callback_time ($value, $row) {
		return empty($value) ? '-' : date('D, d-M-Y',$value);
    }

    public function _callback_time_added ($value, $row) {
		$time = time();
		return '<input type="hidden" maxlength="50" value="'.$time.'" name="added">';
    }

    public function _callback_time_modified ($value, $row) {
		$time = time();
		return '<input type="hidden" maxlength="50" value="'.$time.'" name="modified">';
    }

	public function _callback_field_id ($value, $row) {
		return '<input type="hidden" maxlength="50" value="" name="field_id">';
    }

	public function _callback_lang_id ($value, $row) {
		return '<input type="hidden" maxlength="50" value="" name="lang_id">';
    }

    public function _callback_priority_add ($value, $row) {

        $count = $this->ProductGroups->find_count(['status !='=>'']) + 1;
        return '<input style="width:24px" type="text" maxlength="3" value="'.$count.'" name="priority">&nbsp;&nbsp;<small>Ordering Index</small>';
    }

    public function _callback_priority_edit ($value, $row) {
        $count = $value;
        return '<input style="width:24px" type="text" maxlength="3" value="'.$count.'" name="priority">&nbsp;&nbsp;<small>Ordering Index</small>';
    }

    private function load($crud, $nav) {
        $output = $crud->render();
        $output->nav = $nav;
        if ($crud->getState() == 'list') {
            // Set Page Title
            $output->page_title = lang('Product Category').' Listings';
            // Set Main Template
            $output->main       = 'template/admin/metronix';
            // Set Primary Template
            $this->load->view('template/admin/template.php', $output);
        } else {
            $this->load->view('template/admin/popup.php', $output);
        }
    }
}

/* End of file page.php */
/* Location: ./application/module/page/controllers/page.php */
