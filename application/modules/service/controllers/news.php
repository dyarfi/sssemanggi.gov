<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends Admin_Controller {

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
            $class       = 'Newscenter';// get_class();
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

	public function detail($operation = '',$field_id='',$lang_id='', $prefix='') {
		
		/* Just make sure that you don't want to redirect him at the media_lang media but at medias */
		if($operation == '' || $operation == 'list') {
		   redirect(strtolower(__CLASS__).'/index');
		}
		
		$media_menu = $this->module_menu .' : '. $this->Languages->getLanguage($lang_id)->name;
		
		$crud = new grocery_CRUD();

        // Set CRUD language
    	$crud->set_language($this->i18ln->native);   
	
		// Set query select
		$crud->where('field_id',$field_id);
		$crud->where('lang_id',$lang_id);
        $crud->where('table','tbl_news');
		
		// Set tables
        $crud->set_table('tbl_translations');
		
		// Set subject
		$crud->set_subject('Translation ' . $media_menu);  
		
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
		$crud->callback_before_insert(array($this,'_callback_url'));			
 		// Set callback before database set
        $crud->callback_before_update(array($this,'_callback_url_translate'));
        
		// Sets the required fields of add and edit fields
		$crud->required_fields('subject','text','status');
        $crud->set_rules('subject','Subject','trim|required|min_length[3]|max_length[128]|xss_clean');
        $crud->set_rules('text','Text','trim|min_length[3]|xss_clean');   
		
		$state = $crud->getState();
		$state_info = $crud->getStateInfo();

		$crud->unset_list();
		
		$this->load($crud, 'media_detail');
		
	}
	
	public function translate($field_id='',$lang_id='',$prefix='') {	

		$this->db->where('lang_id',$lang_id);
		$this->db->where('field_id',$field_id);
        $this->db->where('table','tbl_news');
		
		$media_db = $this->db->get('tbl_translations');

		if($media_db->num_rows() == 0)
		{
			$object['table']	= 'tbl_news';
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
			redirect(ADMIN.strtolower(__CLASS__).'/detail/edit/'.$media_db->row()->id.'/'.$lang_id.'/'.$prefix);
		}		
		
	}
    
 	public function _callback_translate ($value, $row) {
		$links = '';
		
		$page_db = '';
		foreach($this->Languages->getAllLanguage(['status'=>1]) as $lang) {			
			// Find other than the default languages
			if($lang->default != 1) {
				$page_db = $this->db->where('lang_id',$lang->id)->where('field_id',$row->id)->where('table','tbl_news')->get('tbl_translations');
				$links .= '<a href="'.base_url(ADMIN).'/news/translate/'.$row->id.'/'.$lang->id.'/'.$lang->prefix.'" class="fancyframe iframe" title="Translation '.$lang->name.' - '.$row->subject.'"><img src="'.base_url('assets/admin/img/flags/'.$lang->prefix.'.png').'"/></a>'.($page_db->num_rows() != 0 ? '' : '&nbsp;<div class="label label-warning label-xs"><span class="fa fa-plus"></span></div>');
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

	public function _callback_url_translate($post_array, $primary_key) {

		// Set url subject
        $url 	= url_title($post_array['subject'],'-',true);
        $existed_db = $this->Content->findIdByUrl('medias',$url);

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

	public function _callback_is_highlight ($value, $row) {
		return ($value == 1) ? '<span class="label label-success label-sm">'.lang('Yes').'</span>' : '<span class="label label-info label-sm">'.lang('No').'</span>';
	}

    public function _callback_after_upload($uploader_response,$field_info, $files_to_upload) {
        $this->load->library('image_moo');

        //Is only one file uploaded so it ok to use it with $uploader_response[0].
        $file_uploaded  = $field_info->upload_path.'/'.$uploader_response[0]->name; 
        
        $thumbnail[1]      = $field_info->upload_path.'/thumb__800x400'.$uploader_response[0]->name;
        
        $this->image_moo
        ->load($file_uploaded)
        ->save($file_uploaded,true)
        ->resize_crop(800,400)
        ->save($thumbnail[1]);
         
        if ($this->image_moo->error) print $this->image_moo->display_errors(); else return true;
        
    }

    public function _callback_gallery ($value,$row) {
        if ($row->id) { 
            return '<a href="'.base_url(ADMIN).'/media_gallery/index/'.$row->id.'" class="fancyframe iframe"><span class="btn btn-default btn-mini glyphicon glyphicon-camera"></span></a>'; 
        } else { 
            return '-';
        }
    }
   	
   	public function _callback_after_delete($primary_key) {
   		// Delete translation field
	    return $this->db->delete('tbl_translations', ['field_id' => $primary_key, 'table' => 'tbl_news']);
	}
	
	public function _callback_media ($value,$row) {
	    if ($value) { 
            return '<a href="'.base_url('uploads/news').'/'.$value.'" class="fancyframe iframe"><img src="'.base_url('uploads/news').'/'.$value.'"/></a>'; 
        } else { 
            return '-';
        }
    }
	
	public function _callback_column_image($value,$row) {
	    if ($value) { 
            return '<a href="'.base_url('uploads/news').'/'.$value.'" class="fancyframe iframe"><img height="50" src="'.base_url('uploads/news').'/'.str_replace($value, 'thumb__800x400'.$value, $value).'"/></a>'; 
        } else { 
            return '-';
        }
    }

    public function _callback_field_highlight($value = '', $primary_key = null) {

		return 'Yes <input type="checkbox" maxlength="50" value="1" name="highlight"> No<input type="checkbox" maxlength="50" value="0" name="highlight">';
		
	}

	public function _callback_field_type($value = '', $primary_key = null) {

		return '<input type="hidden" maxlength="50" value="news" name="type">';
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

    private function load($crud, $nav) {
        $output = $crud->render();
        $output->nav = $nav;
        if ($crud->getState() == 'list') {
            // Set Media Title 
            $output->page_title = lang('News').' Listings';
            // Set Main Template
            $output->main       = 'template/admin/metronix';
            // Set Primary Template
            $this->load->view('template/admin/template.php', $output);
        } else {
         	// Set Page Title 
            $output->page_title = lang('News').' Listings';
        	// Set note for popup message
        	$output->notes 		= $this->notes;
        	// Set Primary Template            
            $this->load->view('template/admin/popup.php', $output);
        }    
    }
}

/* End of file media.php */
/* Location: ./application/module/media/controllers/media.php */