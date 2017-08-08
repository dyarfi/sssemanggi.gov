<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BannerMiddle extends Admin_Controller {

    /**
     * Index Banner for this controller.
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
			
            // Load Banner model
            //$this->load->model('Banner');

            // Load Grocery CRUD
            $this->load->library('grocery_CRUD');

            // Set priviledge
            $class       = 'Banner';//get_class();
            $this->class = strtolower(get_class());
            $this->module_function_list[$class];
            $this->is_allowed = $this->module_function_list[$class];

			$this->notes->media = [
					'ext' => 'jpg|jpeg',
					'dimension' => '555x571'
				]; 
			      
    }
	
    public function index() {
        try {
	    	// Set our Grocery CRUD
            $crud = new grocery_CRUD();
            // Set CRUD language
            $crud->set_language($this->i18ln->native);            
            // Set tables
            $crud->set_table('tbl_banners')->where('tags','middle')->order_by('added','DESC');
            // Set CRUD subject
            $crud->set_subject('Middle Banner');                            
            // Set columns
            $crud->columns('subject','text','media','tags','status','added','modified');			
			// The fields that user will see on add and edit form
			$crud->fields('subject','name','media','tags','status','added','modified');
		 	// Changes the default field type
			$crud->field_type('url', 'hidden');
			$crud->field_type('added', 'hidden');
			$crud->field_type('modified', 'hidden');
			$crud->field_type('tags', 'hidden');			
			// Set unique fields
			$crud->unique_fields('subject');

			if ($this->Languages->getActiveCount() > 1) {
				// Default column of multilanguage
				$crud->columns('subject','name','media','tags','status','added','modified','translate');
				// Callback_column translate
				$crud->callback_column('translate',array($this,'_callback_translate'));
			}
			
			// This callback escapes the default auto field output of the field name at the add form
			$crud->callback_add_field('added',array($this,'_callback_time_added'));
			// This callback escapes the default auto field output of the field name at the edit form
			$crud->callback_edit_field('modified',array($this,'_callback_time_modified'));
			// This callback escapes the default auto field output of the field name at the add/edit form. 
			// $crud->callback_field('status',array($this,'_callback_dropdown'));
            
           	// Set callback column
            $crud->callback_column('media',array($this,'_callback_media'));
            
        	// This callback escapes the default auto field output of the field name at the add/edit form. 
			$crud->callback_field('tags',array($this,'_callback_field_tags'));

            // This callback escapes the default auto column output of the field name at the add form
			$crud->callback_column('added',array($this,'_callback_time'));
			$crud->callback_column('modified',array($this,'_callback_time'));  

			// Set callback before database set
            $crud->callback_before_insert(array($this,'_callback_url'));
            $crud->callback_before_update(array($this,'_callback_url'));            
            $crud->callback_after_delete(array($this,'_callback_after_delete'));
			
			// Sets the required fields of add and edit fields
			$crud->required_fields('subject','name','text','media','status'); 
			$crud->set_rules('subject','Subject','trim|required|min_length[3]|max_length[72]|xss_clean');
		 	$crud->set_rules('text','Text','trim|min_length[3]|xss_clean');          
		 	$crud->set_rules('name','URL','trim|required|min_length[3]|max_length[200]|callback_valid_url_format|xss_clean');
            
            $crud->unset_texteditor('text','synopsis')
			->field_type('attribute','string')
			->field_type('text','string')			
			->field_type('synopsis','string')
			->field_type('name','string')
			->display_as('name','URL Link');

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
							$crud->add_action($lang->name, base_url('assets/admin/img/flags/'.$lang->prefix.'.png'),'banner/insert_and_redirect/'.$lang->id);
						}
					}
				 * 
				 */
			}
            
			// Unset action 
            //$crud->unset_delete();
            
            // Set upload field
            $crud->set_field_upload('media','uploads/banners',$this->notes->media['ext']);
            
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

            $this->load($crud, 'middle_banner');
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

	public function detail($operation = '',$field_id='',$lang_id='',$prefix='') {
		
		/* Just make sure that you don't want to redirect him at the banner_lang banner but at banners */
		if($operation == '' || $operation == 'list') {
		   redirect(strtolower(__CLASS__).'/index');
		}
		
		$banner_menu = $this->module_menu .' : '. $this->Languages->getLanguage($lang_id)->name;
		
		$crud = new grocery_CRUD();
		
        // Set CRUD language
    	$crud->set_language($this->i18ln->native);   		
	
		// Set query select
		$crud->where('field_id',$field_id);
		$crud->where('lang_id',$lang_id);
        $crud->where('table','tbl_banners');
		
		// Set tables
        $crud->set_table('tbl_translations');
		
		// Set subject
		$crud->set_subject('Translation ' . $banner_menu);  
		
		// The fields that user will see on add and edit form
		$crud->fields('table','prefix','field_id','lang_id','subject','url','added','modified');
		
		// Changes the default field type
		$crud->field_type('table', 'hidden');
		$crud->field_type('url', 'hidden');
		$crud->field_type('added', 'hidden');
		$crud->field_type('modified', 'hidden');	
		$crud->field_type('prefix', 'hidden', $prefix);
		$crud->field_type('field_id', 'hidden', $id);
        $crud->field_type('lang_id', 'hidden', $lang_id);        
        $crud->field_type('synopsis','string'); 
        $crud->field_type('text','string');           
		$crud->unset_texteditor('text','synopsis');

		// This callback escapes the default auto field output of the field name at the add form
		$crud->callback_add_field('added',array($this,'_callback_time_added'));
		// This callback escapes the default auto field output of the field name at the edit form
		$crud->callback_edit_field('modified',array($this,'_callback_time_modified'));
		
		// Set callback before database set
		$crud->callback_before_insert(array($this,'_callback_url'));
		$crud->callback_before_update(array($this,'_callback_url'));
        
		// Sets the required fields of add and edit fields
		$crud->required_fields('subject','text','status');
		$crud->set_rules('subject','Subject','trim|required|min_length[3]|max_length[72]|xss_clean');
	 	$crud->set_rules('text','Text','trim|min_length[3]|xss_clean'); 

		$state = $crud->getState();
		$state_info = $crud->getStateInfo();

		$crud->unset_list();
		
		$this->load($crud, 'banner_detail');
		
	}
	
	public function translate($field_id='',$lang_id='',$prefix='') {
						
		$this->db->where('lang_id',$lang_id);
		$this->db->where('field_id',$field_id);
        $this->db->where('table','tbl_banners');
		
		$banner_db = $this->db->get('tbl_translations');

		if($banner_db->num_rows() == 0)
		{
			$object['table']	= 'tbl_banners';
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
			redirect(ADMIN.strtolower(__CLASS__).'/detail/edit/'.$banner_db->row()->id.'/'.$lang_id.'/'.$prefix);
		}
		
	}
    
 	public function _callback_translate ($value, $row) {
		$links = '';
		
		$page_db = '';
		foreach($this->Languages->getAllLanguage(['status'=>1]) as $lang) {			
			// Find other than the default languages
			if($lang->default != 1) {
				$page_db = $this->db->where('lang_id',$lang->id)->where('field_id',$row->id)->where('table','tbl_banners')->get('tbl_translations');
				$links .= '<a href="'.base_url(ADMIN).'/bannermiddle/translate/'.$row->id.'/'.$lang->id.'/'.$lang->prefix.'" class="fancyframe iframe" title="Translation '.$lang->name.' - '.$row->subject.'"><img src="'.base_url('assets/admin/img/flags/'.$lang->prefix.'.png').'"/></a>'.($page_db->num_rows() != 0 ? '' : '&nbsp;<div class="label label-warning label-xs"><span class="fa fa-plus"></span></div>');
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
        
        $thumbnail[3]      = $field_info->upload_path.'/thumb__555x571'.$uploader_response[0]->name;
        
        $this->image_moo
        ->load($file_uploaded)
        ->resize_crop(555,571)
        ->save($thumbnail[3]);
         
        if ($this->image_moo->error) print $this->image_moo->display_errors(); else return true;
        
    }

	/*
	 * Validate URL format
     *
     * @access  public
     * @param   string
     * @return  string
     */
    public function valid_url_format($str){
        $pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
        if (!preg_match($pattern, $str)){
            //$this->set_message('valid_url_format', 'The URL you entered is not correctly formatted.');
            $this->form_validation->set_message('valid_url_format', lang('matches'));
            return FALSE;
        }
 
        return TRUE;
    }  

    public function _callback_gallery ($value,$row) {
        if ($row->id) { 
            return '<a href="'.base_url(ADMIN).'/banner_gallery/index/'.$row->id.'" class="fancyframe iframe"><span class="btn btn-default btn-mini glyphicon glyphicon-camera"></span></a>'; 
        } else { 
            return '-';
        }
    }
   	
   	public function _callback_after_delete($primary_key) {
   		// Delete translation field
	    return $this->db->delete('tbl_translations', ['field_id' => $primary_key, 'table' => 'tbl_banner']);
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
    

  	public function _callback_field_tags($value = '', $primary_key = null) {

		return '<input type="hidden" maxlength="50" value="middle" name="tags">';
	}

 	public function _callback_media ($value,$row) {
	    if ($value) { 
            return '<a href="'.base_url('uploads/banners').'/'.$value.'" class="fancyframe iframe"><img height="40" src="'.base_url('uploads/banners').'/'.str_replace($value, 'thumb__555x571'.$value, $value).'"/></a>'; 
        } else { 
            return '-';
        }
    }
	
    private function load($crud, $nav) {
        $output = $crud->render();
        $output->nav = $nav;
        if ($crud->getState() == 'list') {
            // Set Banner Title 
            $output->page_title = lang('Banner').' Listings';
            // Set Main Template
            $output->main       = 'template/admin/metronix';
            // Set Primary Template
            $this->load->view('template/admin/template.php', $output);
        } else {
 			// Set Page Title 
            $output->page_title = lang('Banner').' Listings';
        	// Set note for popup message
        	$output->notes 		= $this->notes;
        	// Set Primary Template            
            $this->load->view('template/admin/popup.php', $output);
        }    
    }
}

/* End of file banner.php */
/* Location: ./application/module/banner/controllers/banner.php */