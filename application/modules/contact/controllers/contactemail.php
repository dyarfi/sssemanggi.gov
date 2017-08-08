<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ContactEmail extends Admin_Controller {

    /**
     * Index Contact for this controller.
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
			
            // Load Contact model
            $this->load->model('contact/Contacts');

            // Load Grocery CRUD
            $this->load->library('grocery_CRUD');

            // Set priviledge
            $class       = 'Contact';//get_class();
            $this->class = strtolower(get_class());
            $this->module_function_list[$class];
            $this->is_allowed = $this->module_function_list[$class];
			      
    }
	
    public function index() {
        try {
	    // Set our Grocery CRUD
            $crud = new grocery_CRUD();
            // Set CRUD language
            $crud->set_language($this->i18ln->native);            
            // Set tables
            $crud->set_table('tbl_contacts');
            // Works exactly the same way as codeigniter's where ($this->db->where)
            $crud->where('type','contact_email');
            // Set CRUD subject
            $crud->set_subject(lang('Contact Email'));                            
            // Set columns
            $crud->columns('subject','attribute','email','status','added','modified');
			// The fields that user will see on add and edit form
			$crud->fields('attribute','subject','email','url','type','status','added','modified');
            // Changes the default field type
            $crud->field_type('url', 'hidden');		
			$crud->field_type('added', 'hidden');
			$crud->field_type('modified', 'hidden');			
			$crud->field_type('type', 'hidden');
			// Set unique fields
			$crud->unique_fields('subject');
			// Set Attribute dropdown 
			$crud->field_type('attribute','dropdown',
				array(
					'email_booking_service' => 'Email Booking Service',
					'email_register' => 'Email Register',
					'email_customer_survey' => 'Email Customer Survey',
					'email_contact_us' => 'Email Contact Us',
				)
			);

			if ($this->Languages->getActiveCount() > 1) {
				// Default column of multilanguage
				$crud->columns('subject','type','text','status','added','modified','translate');
				// Callback_column translate
				$crud->callback_column('translate',array($this,'_callback_translate'));
			}
			
			// This callback escapes the default auto field output of the field name at the add form
			$crud->callback_add_field('added',array($this,'_callback_time_added'));
			// This callback escapes the default auto field output of the field name at the edit form
			$crud->callback_edit_field('modified',array($this,'_callback_time_modified'));
			// This callback escapes the default auto field output of the field name at the edit and add form
			$crud->callback_field('type',array($this,'_callback_type'));			
			
            // This callback escapes the default auto column output of the field name at the add form
			$crud->callback_column('added',array($this,'_callback_time'));
			$crud->callback_column('modified',array($this,'_callback_time'));
			$crud->callback_column('status',array($this,'_callback_status'));

			// Set callback before database set
            $crud->callback_after_delete(array($this,'_callback_after_delete'));
			
			// Sets the required fields of add and edit fields
			$crud->required_fields('subject','status');
	        $crud->set_rules('subject','Subject','trim|required|min_length[3]|max_length[72]|xss_clean');
	        $crud->set_rules('attribute','Attribute','trim|required|xss_clean');
        	$crud->set_rules('email','Email','trim|valid_email|min_length[3]|xss_clean');

            // Set callback after upload
            $crud->callback_after_upload(array($this,'_callback_after_upload'));
  
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
							$crud->add_action($lang->name, base_url('assets/admin/img/flags/'.$lang->prefix.'.png'),'contact/insert_and_redirect/'.$lang->id);
						}
					}
				 * 
				 */
			}
            // Set upload field
            $crud->set_field_upload('media','uploads/contacts','jpg|jpeg');
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
            $this->load($crud, 'contact_email');
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

	public function detail($operation = '',$field_id='',$lang_id='',$prefix='') {
		
		/* Just make sure that you don't want to redirect him at the contact_lang contact but at contacts */
		if($operation == '' || $operation == 'list') {
		   redirect(strtolower(__CLASS__).'/index');
		}
		
		$contact_menu = $this->module_menu .' : '. $this->Languages->getLanguage($lang_id)->name;
		
		$crud = new grocery_CRUD();
    
        // Set CRUD language
    	$crud->set_language($this->i18ln->native);   

		// Set query select
		$crud->where('field_id',$field_id);
		$crud->where('lang_id',$lang_id);
        $crud->where('table','tbl_contacts');
		
		// Set tables
        $crud->set_table('tbl_translations');
		
		// Set subject
		$crud->set_subject('Translation ' . $contact_menu);  
		
		// The fields that user will see on add and edit form
		$crud->fields('table','prefix','field_id','lang_id','subject','url','text','added','modified');
		
		// Changes the default field type
		$crud->field_type('table', 'hidden');
		$crud->field_type('url', 'hidden');
		$crud->field_type('added', 'hidden');
		$crud->field_type('modified', 'hidden');		
		$crud->field_type('prefix', 'hidden', $prefix);
		$crud->field_type('field_id', 'hidden', $id);
        $crud->field_type('lang_id', 'hidden', $lang_id);
        
		// This callback escapes the default auto field output of the field name at the add form
		$crud->callback_add_field('added',array($this,'_callback_time_added'));
		// This callback escapes the default auto field output of the field name at the edit form
		$crud->callback_edit_field('modified',array($this,'_callback_time_modified'));
		
 		// Set callback before database set
        $crud->callback_before_update(array($this,'_callback_url_translate'));
        
		// Sets the required fields of add and edit fields
		$crud->required_fields('subject','text','status');
        $crud->set_rules('subject','Subject','trim|required|min_length[3]|max_length[72]|xss_clean');
        $crud->set_rules('text','Text','trim|min_length[3]|xss_clean');  
		
		$state = $crud->getState();
		$state_info = $crud->getStateInfo();

		$crud->unset_list();
		
		$this->load($crud, 'contact_detail');
		
	}
	
	public function translate($field_id='',$lang_id='',$prefix='') {
						
		$this->db->where('lang_id',$lang_id);
		$this->db->where('field_id',$field_id);
        $this->db->where('table','tbl_contacts');
		
		$contact_db = $this->db->get('tbl_translations');

		if($contact_db->num_rows() == 0)
		{
			$object['table']	= 'tbl_contacts';
            $object['lang_id']	= $lang_id;            		                  
			$object['prefix']	= $prefix;
			$object['field_id']	= $field_id;
			$object['user_id']  = $this->user->id;
            $object['added']	= time();
			$object['status']  	= 1;
			$this->db->insert('tbl_translations', $object);
			redirect(ADMIN.strtolower(__CLASS__).'/detail/edit/'.$this->db->insert_id().'/'.$lang_id.'/'.$prefix);
		}
		else
		{
			redirect(ADMIN.strtolower(__CLASS__).'/detail/edit/'.$contact_db->row()->id.'/'.$lang_id.'/'.$prefix);
		}
		
	}
    
   public function _callback_translate ($value, $row) {
		$links = '';
		
		$page_db = '';
		foreach($this->Languages->getAllLanguage(['status'=>1]) as $lang) {			
			// Find other than the default languages
			if($lang->default != 1) {
				$page_db = $this->db->where('lang_id',$lang->id)->where('field_id',$row->id)->where('table','tbl_contacts')->get('tbl_translations');
				$links .= '<a href="'.base_url(ADMIN).'/contact/translate/'.$row->id.'/'.$lang->id.'/'.$lang->prefix.'" class="fancyframe iframe" title="Translation '.$lang->name.' - '.$row->subject.'"><img src="'.base_url('assets/admin/img/flags/'.$lang->prefix.'.png').'"/></a>'.($page_db->num_rows() != 0 ? '' : '&nbsp;<div class="label label-warning label-xs"><span class="fa fa-plus"></span></div>');
			}
		}
		return $links;
	}
	
    public function _callback_update_detail($post, $primary_key) {
		// Unset status first and change to 1
        unset($post['status']);
		$post['status']  	= 1;
		// Return update database
		return $this->db->update('tbl_translations',$post,['id' => $primary_key]);
	}

    public function _callback_after_upload($uploader_response,$field_info, $files_to_upload) {
        $this->load->library('image_moo');

        //Is only one file uploaded so it ok to use it with $uploader_response[0].
        $file_uploaded  = $field_info->upload_path.'/'.$uploader_response[0]->name; 
        
        $thumbnail[2]      = $field_info->upload_path.'/thumb__948x380'.$uploader_response[0]->name;        
        $thumbnail[3]      = $field_info->upload_path.'/thumb__600x300'.$uploader_response[0]->name;
        
        $this->image_moo
        ->load($file_uploaded)
        ->resize(948,380)
        ->save($thumbnail[2])
        ->resize(600,300)
        ->save($thumbnail[3]);
         
        if ($this->image_moo->error) print $this->image_moo->display_errors(); else return true;
        
    }
   	
   	public function _callback_after_delete($primary_key) {
   		// Delete translation field
	    return $this->db->delete('tbl_translations', ['field_id' => $primary_key, 'table' => 'tbl_contact']);
	}

	public function _callback_media ($value,$row) {
	    if ($value) { 
            return '<a href="'.base_url('uploads/contacts').'/'.$value.'" class="fancyframe iframe"><img src="'.base_url('uploads/contacts').'/thumb__600x300'.$value.'"/></a>'; 
        } else { 
            return '-';
        }
    }
	 
	public function _callback_url_translate($post_array, $primary_key) {

		// Set url subject
        $url 	= url_title($post_array['subject'],'-',true);
        $existed_db = $this->Content->findIdByUrl('contacts',$url);

        // Checking the id and url
		if ($existed_db->field_id != $post_array['field_id'] && $url == $existed_db->url) {
			$url = $url.time();			
		} else {
			$url = $url;
		}
		
		// Set default post
		$post_array['url'] = $url;
		
		// Return update database
        return $post_array; 
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

	public function _callback_type($value = '', $primary_key = null) {
		return '<input type="hidden" maxlength="50" value="contact_email" name="type" style="display:none">';
	}

	public function _callback_status($value, $row){
        $status = 'label label-primary';
        $status = ($value == 'deleted') ? 'label label-danger label-xs' : $status; 
        $status = ($value == 'unpublish') ? 'label label-warning label-xs' : $status; 
        return '<span class="'.$status.' label-xs center-block">'.$value.'</span>';
    }
    
    private function load($crud, $nav) {
        $output = $crud->render();
        $output->nav = $nav;
        if ($crud->getState() == 'list') {
            // Set Contact Title 
            $output->page_title = lang('Contact Email');
            // Set Main Template
            $output->main       = 'template/admin/metronix';
            // Set Primary Template
            $this->load->view('template/admin/template.php', $output);
        } else {
            $this->load->view('template/admin/popup.php', $output);
        }    
    }
}

/* End of file contact.php */
/* Location: ./application/module/contact/controllers/contact.php */