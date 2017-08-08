<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Class for User Groups
class Language extends Admin_Controller {
	
	public $_class_name;
	
	public function __construct() {
	    parent::__construct();

	    // Set class name
	    $this->_class_name = $this->controller;
	    
	    //Load user related model
	    $this->load->model('Users');
	    $this->load->model('UserProfiles');
	    $this->load->model('Languages');	    
	    
	}
	
	public function index() {	
        
	    $rows = $this->Languages->getAllLanguage();

	    if (@$rows) $data['rows'] = $rows;

	    // Data statutes value
	    $data['statuses']	= $this->configs['status'];
	    
	    // Default options
	    $data['options']	= $this->configs['enum_default'];
	    
	     // Default options
	    $data['is_system']	= $this->configs['enum_default'];

	    // Set class name to view
	    $data['class_name'] = $this->_class_name;
	    
	    // Main template
	    $data['main'] = 'language/language_index';

	    // Set module with URL request 
	    $data['module_title'] = $this->module;

	    // Set admin title page with module menu
	    $data['page_title'] = lang($this->module_menu);


	    $data['js_inline'] = "$('input[name=\"site_language\"]').change(function(){
								var rel = $(this).attr('rel');
								var val = $(this).val();
								// Submit form on Ajax								
								if (rel) {
									$.ajax({
										url: 'change',
										type:'POST',
										data: 'site_language=default&id='+val,
							            datatype: \"JSON\",
										success:function(data) {
											//$.setMessage('.message-handler','Updated!')
											var msg = jQuery.parseJSON(data);
											if(msg.result == 1) {
												window.location.href = base_ADM + '/language/index?active=current';
											}
										}			
									});		
								}
								
							});
							$('#blankpop').fancybox({
							            'transitionIn': 'fadeIn',
							            'transitionOut': 'fadeOut',
							            'speedIn': 200,
							            'speedOut': 200,            
							            'centerOnScroll':true,
							            'overlayShow': true,
										//'scrolling' : 'auto',
										//'aspectRatio' : true,
										'width'	: '720',
							            'minHeight': '320',
										'height': '480',
										'autoCenter' : true,
										'autoResize' : true,
										'fitToView' : true,
							            'padding':10,
							            onComplete : function() {
							                //$.fancybox.css({'position':'aboslute'});
							                var top = ($(window).height() / 2) - ($('#fancybox-wrap').outerHeight() / 2);
							                var left = ($(window).width() / 2) - ($('#fancybox-wrap').outerWidth() / 2);
							                $('#fancybox-wrap').css({ top: top, left: left});
							            }
							        });
							";

	    // Load admin template
	    $this->load->view('template/admin/template', $this->load->vars($data));
				
	}
	
	public function add(){
		
	    //Default data setup
	    $fields = array(
			    'name'=>'',
			    'url'=>'',
				'prefix'=>'',
				'native'=>'',			    
			    'default'=>'',
			    'is_system'=>'',
			    'status'=>'');

	    $errors = $fields;

	    // Set form validation rules
	    $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('url', 'Url', 'trim|required|xss_clean');
		$this->form_validation->set_rules('prefix', 'Prefix', 'trim|required|xss_clean');
		$this->form_validation->set_rules('native', 'Native', 'trim|required|xss_clean');	    
	    $this->form_validation->set_rules('status', 'Status','trim|required|xss_clean');

	    // Check if post is requested
	    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			// Validation form checks
			if ($this->form_validation->run() == FALSE) {

				// Set error fields
				$error = array();
				foreach(array_keys($fields) as $error) {
					$errors[$error] = form_error($error);
				}

				// Set previous post merge to default
				$fields = array_merge($fields, $this->input->post());

			} else {

				// Set data to add to database
				$this->Languages->setLanguage($this->input->post());

				// Set message
				$this->session->set_flashdata('message','Language created!');

				// Redirect after add
				redirect('admin/language');

			}
	    }	

	    // Set Action
	    $data['action'] = 'add';

	    // Set Param
	    $data['param']  = '';

	    // Set error data to view
	    $data['errors'] = $errors;

	    // Set field data to view
	    $data['fields'] = $fields;

	    // Group Status Data
	    $data['statuses']	= $this->configs['status'];	

	    // Post Fields
	    $data['fields']	= (object) $fields;
	    
	    // Set class name to view
	    $data['class_name'] = $this->_class_name;

	    // Main template
	    $data['main']	= 'language/language_form';		

	    // Set module with URL request 
	    $data['module_title'] = $this->module;

	    // Set admin title page with module menu
	    $data['page_title'] = lang($this->module_menu);

	    // Admin view template
	    $this->load->view('template/admin/template', $this->load->vars($data));
		
	}
	
	public function edit($id=0){
		
	    // Check if param is given or not and check from database
	    if (empty($id) || !$this->Languages->getLanguage($id)) {
		    $this->session->set_flashdata('message','Item not found!');
		    // Redirect to index
		    redirect(base_url().'admin/language');
	    }				

	    // Default data setup
	    $fields = array(
			    'name' => '',
			    'url' => '',
				'prefix' => '',
				'native' => '',
			    'status' => '');

	    $errors = $fields;

	    // Set form validation rules
	    $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('url', 'Url', 'trim|required|xss_clean');
		$this->form_validation->set_rules('prefix', 'Prefix', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('native', 'Native', 'trim|required|xss_clean');	    
	    $this->form_validation->set_rules('status', 'Status','trim|required|xss_clean');

	    // Check if post is requested		
	    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			// Validation form checks
			if ($this->form_validation->run() == FALSE) {

				// Set error fields
				$error = array();
				foreach(array_keys($fields) as $error) {
					$errors[$error] = form_error($error);
				}

				// Set previous post merge to default
				$fields = array_merge($fields, $this->input->post());						

			} else {

				$posts = array(
					'id'=>$id,
					'name' => $this->input->post('name'),
					'url' => $this->input->post('url'),
					'prefix' => $this->input->post('prefix'),
					'native' => $this->input->post('native'),
					'status' => $this->input->post('status')
				);

				// Set data to add to database
				$this->Languages->updateLanguage($posts);

				// Set message
				$this->session->set_flashdata('message','Language updated');

				// Redirect after add
				redirect('admin/language');

			}

	    } else {	

			// Set fields from database
			$fields = $this->Languages->getLanguage($id);		
	    }

	    // Set Action
	    $data['action'] = 'edit';

	    // Set Param
	    $data['param']	= $id;

	    // Set error data to view
	    $data['errors'] = $errors;

	    // Set field data to view
	    $data['fields'] = $fields;		

	    // Data statutes value
	    $data['statuses']	= $this->configs['status'];
	    
	    // Default options
	    $data['options']	= $this->configs['enum_default'];
	    
	    // Default system options
	    $data['is_system']	= $this->configs['is_system'];							

	    // Set class name to view
	    $data['class_name'] = $this->_class_name;
	    
	    // Set form to view
	    $data['main'] = 'language/language_form';			

	    // Set module with URL request 
	    $data['module_title'] = $this->module;

	    // Set admin title page with module menu
	    $data['page_title'] = lang($this->module_menu);

	    // Set admin template
	    $this->load->view('template/admin/template', $this->load->vars($data));

	}

	public function delete($id){
	    // Set delete method in model
	    $this->Languages->deleteLanguage($id);
	    // Set flash message to display
	    $this->session->set_flashdata('message','Language deleted');
	    // Redirect to index
	    redirect('admin/language');
	}	

	public function view($id=null){

	    if (empty($id) && (int) $id == 0) {
		    $this->session->set_flashdata('message',"Error submission.");
		    redirect("language","refresh");
	    }

	    $user = $this->Languages->getLanguage($id);
	    if (!count($user)){
		    redirect(ADMIN.'dashboard/index');
	    }
  
	    // Set Param
	    $data['param']	= $id;

		// Listing data
	    $data['listing']  = $this->Languages->getLanguage($id);
            
		// Set default statuses
		$data['statuses'] = $this->configs['status'];

		// Set default enum
		$data['options'] = $this->configs['enum_default'];
	    
	    // Default system options
	    $data['is_system']	= $this->configs['is_system'];

	    // Set class name to view
	    $data['class_name'] = $this->_class_name;
	    
	    // Main template
	    $data['main']	= 'language/language_view';

	    // Set module with URL request 
	    $data['module_title'] = $this->module;

	    // Set admin title page with module menu
	    $data['page_title'] = lang($this->module_menu);

		// Load admin template
	    $this->load->view('template/admin/template', $this->load->vars($data));
	}
	
	// Action for update item status
	public function change() {	

		if ($this->input->post('site_language') == 'default') {

			// Set to database
			$this->Languages->setPublicLanguage($this->input->post('id'));

			// Set message
			$this->session->set_flashdata('message','Site Language changed!');
			echo json_encode(['result'=>1]);
			// redirect(ADMIN.$this->_class_name.'/index');			

		} else if ($this->input->post('check') !='') {
			
			$rows	= $this->input->post('check');
			foreach ($rows as $row) {
				// Set id for load and change status
				$this->Languages->setStatus($row,$this->input->post('select_action'));
			}

			// Set message
			$this->session->set_flashdata('message','Status changed!');
			redirect(ADMIN.$this->_class_name.'/index');
			
		} else {
			
			// Set message
			$this->session->set_flashdata('message','Data not Available');
			redirect(ADMIN.$this->_class_name.'/index');		
			
		}
	}
	
	public function label($action='') {
		
		// Load Grocery CRUD
        $this->load->library('grocery_CRUD');

        // Set priviledge
        $class       = get_class();
        $this->class = strtolower(get_class());
        $this->module_function_list[$class];
        $this->is_allowed = $this->module_function_list[$class];

        try {
	    // Set our Grocery CRUD
            $crud = new grocery_CRUD();
            // Set CRUD language
            $crud->set_language($this->i18ln->native);
         	// Set tables
            $crud->set_table('tbl_translations');
            // Order by Listing
            $crud->order_by('menu_id','ASC');            
            // Set CRUD subject
            $crud->set_subject(lang('Pages'));                            
            // Set table relation
            $crud->set_relation('menu_id','tbl_page_menus','subject',null,'id ASC');
            // Set columns
            $crud->columns('subject','menu_id','text','status','added','modified');			
			// The fields that user will see on add and edit form
			$crud->fields('subject','url','menu_id','text','type','status','added','modified');
            // Set column display 
            $crud->display_as('menu_id','Menu');
			// Changes the default field type
			$crud->field_type('url', 'hidden');
			$crud->field_type('added', 'hidden');
			$crud->field_type('modified', 'hidden');
			// Set unique fields
			$crud->unique_fields('subject','url');

			if ($this->Languages->getActiveCount() > 1) {
				// Default column of multilanguage
				$crud->columns('subject','menu_id','text','status','added','modified','translate');			
				// Callback_column translate
				$crud->callback_column('translate',array($this,'_callback_translate'));
			}
			
			// This callback escapes the default auto field output of the field name at the add form
			$crud->callback_add_field('added',array($this,'_callback_time_added'));
			// This callback escapes the default auto field output of the field name at the edit form
			$crud->callback_edit_field('modified',array($this,'_callback_time_modified'));
			// This callback escapes the default auto field output of the field name at the add/edit form. 
			// $crud->callback_field('status',array($this,'_callback_dropdown'));
            
            // Callback Column 
            $crud->callback_column('gallery',array($this,'_callback_gallery'));
            
            // This callback escapes the default auto column output of the field name at the add form
			$crud->callback_column('added',array($this,'_callback_time'));
			$crud->callback_column('modified',array($this,'_callback_time'));  
			// Set callback before database set
            $crud->callback_before_insert(array($this,'_callback_url'));
            $crud->callback_before_update(array($this,'_callback_url'));
            $crud->callback_after_delete(array($this,'_callback_after_delete'));
			
			// Sets the required fields of add and edit fields
			$crud->required_fields('subject','text','status'); 
        	$crud->set_rules('subject','Subject','trim|required|min_length[3]|max_length[72]|xss_clean');
        	$crud->set_rules('text','Text','trim|min_length[3]|xss_clean');  

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
            $crud->set_field_upload('media','uploads/pages');
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
            $this->load($crud, 'page');
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
	
	}

	public function ajax($action='') {

	    //Check if the request via AJAX
	    if (!$this->input->is_ajax_request()) {
		    exit('No direct script access allowed');		
	    }	

	    //Define initialize result
	    $result['result'] = '';

	    //Update user profile via Ajax
	    if ($action == 'update' && $this->input->post() !== '') {

		    //Set User Data
		    $user_profile = $this->UserProfiles->setUserProfiles($this->input->post());

		    //Reload session if the user is logged in
		    //Set session data
		    //$this->session->set_userdata($user_profile);

		    if (!empty($user_profile) && $user_profile->status === 'active') {

			    $result['result']['code'] = 1;
			    $result['result']['text'] = 'Changes saved !';

		    } else if (!empty($user_profile) && $user->status !== 'active') { 

			    $result['result']['code'] = 2;
			    $result['result']['text'] = 'Your account profile is not active';			

		    } else {

			    $result['result']['code'] = 0;
			    $result['result']['text'] = 'Profile not found';			
		    }

	    }

	    // Load json template
	    $data['json'] = $result;

	    // Load admin template
	    $this->load->view('json', $this->load->vars($data));	
	}
		
}