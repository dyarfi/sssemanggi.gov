<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PageSocmed extends Admin_Controller {

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

            // Load Grocery CRUD
            $this->load->library('grocery_CRUD');

            // Load Pages model
            $this->load->model('page/PageSocmeds');
            // Set priviledge
            $class       = 'Page';
            $this->class = strtolower(get_class());
            $this->module_function_list[$class];
            $this->is_allowed = $this->module_function_list[$class];

			$this->notes->media = [
					'ext' => 'jpg|jpeg|png',
					'dimension' => '24x24'
				];

    }

    public function index() {
        try {
	        // Set our Grocery CRUD
            $crud = new grocery_CRUD();
            // Set CRUD language
            $crud->set_language($this->i18ln->native);
            // Set tables
            $crud->set_table('tbl_page_socmeds')->order_by('id','asc');
            // Set CRUD subject
            $crud->set_subject(lang('Social Medias'));
            // Set table relation
            //$crud->set_relation('group_id','tbl_page_groups','subject',['status'=>'publish'],'id DESC');
            // The fields that user will see on add and edit form
			$crud->fields('name','subject','url','text','media','priority','user_id','status','added','modified');
            // Set column
            $crud->columns('name','subject','url','media','status','modified');
            // Unsets the fields at the add form.
			$crud->unset_add_fields('count','added','modified');
			// Unsets the fields at the edit form.
			$crud->unset_edit_fields('count','added','modified');
            // Set custom field display for position
            $crud->field_type('subject','dropdown',array('suzuki-mobil'=>'Suzuki Mobil','suzuki-motor'=>'Suzuki Motor','suzuki-marine'=>'Suzuki Marine'));

            // Changes the default field type
            $crud->field_type('user_id','hidden', $this->acl->user()->id);
			//$crud->field_type('url','hidden');
			$crud->field_type('added','hidden');
			$crud->field_type('modified','hidden');

            // Set unique fields
			$crud->unique_fields('url');
            // This callback escapes the default auto field output of the field name at the add form
            $crud->callback_add_field('added',array($this,'_callback_time_added'));
			// This callback escapes the default auto field output of the field name at the edit form
			$crud->callback_edit_field('modified',array($this,'_callback_time_modified'));
			// This callback escapes the default auto field output of the field name at the add form
            //$crud->callback_add_field('ext_url',array($this,'_callback_add_ext_url'));
			// This callback escapes the default auto field output of the field name at the edit form
			//$crud->callback_edit_field('ext_url',array($this,'_callback_edit_ext_url'));
            // Callback fields for priority
            $crud->callback_edit_field('priority',array($this,'_callback_priority_edit'));
            $crud->callback_add_field('priority',array($this,'_callback_priority_add'));
            // Set callback column
            $crud->callback_column('media',array($this,'_callback_media'));
            $crud->callback_column('added',array($this,'_callback_time'));
			$crud->callback_column('modified',array($this,'_callback_time'));
            // Set callback before database set
            //$crud->callback_before_insert(array($this,'_callback_url'));
            //$crud->callback_before_update(array($this,'_callback_url'));
			$crud->callback_after_delete(array($this,'_callback_after_delete'));
            // Callback Column
            //$crud->callback_column('gallery',array($this,'_callback_gallery'));
            $crud->set_rules('subject','Subject','trim|required|min_length[3]|max_length[72]|xss_clean');
        	$crud->set_rules('text','Text','trim|min_length[3]|xss_clean');

            $state = $crud->getState();
			$state_info = $crud->getStateInfo();

			if ($state == 'add') {
				// GC Add Method
			} else if($state == 'edit') {
				// GC Edit Method.
			} else if($state == 'detail') {
				// GC Edit Method.
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
							$crud->add_action($lang->name, base_url('assets/admin/img/flags/'.$lang->prefix.'.png'),'news/insert_and_redirect/'.$lang->id);
						}
					}
				 *
				 */
			}
			// Sets the required fields of add and edit fields
			$crud->required_fields('subject','status');
            // Set upload field
            $crud->set_field_upload('media','uploads/static/icons', $this->notes->media['ext']);
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
            $this->load($crud, 'social_media');
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

   	public function _callback_media ($value,$row) {
	    if ($value) {
            return '<a href="'.base_url('uploads/static/icons').'/'.$value.'" class="fancyframe iframe"><img height="24" src="'.base_url('uploads/static/icons').'/'.$value.'"/></a>';
        } else {
            return '-';
        }
    }

   	public function _callback_after_delete($primary_key) {
   		// Delete translation field
	    return $this->db->delete('tbl_translations',['field_id' => $primary_key, 'table' => 'tbl_page_socmeds']);
	}

    public function _callback_after_upload($uploader_response,$field_info, $files_to_upload) {
        $this->load->library('image_moo');

        //Is only one file uploaded so it ok to use it with $uploader_response[0].
        $file_uploaded  = $field_info->upload_path.'/'.$uploader_response[0]->name;

        $thumbnail[1]      = $field_info->upload_path.'/thumb__276x233'.$uploader_response[0]->name;

        $this->image_moo
        ->load($file_uploaded)
        ->save($file_uploaded,true)
        ->resize_crop(276,233)
        ->save($thumbnail[1]);

        if ($this->image_moo->error) print $this->image_moo->display_errors(); else return true;

    }

    public function _callback_update_detail($post, $primary_key) {
		// Unset status first and change to 1
		unset($post['status']);
		$post['status']  	= 1;
		// Return update database
		return $this->db->update('tbl_translations',$post,['id' => $primary_key]);
	}

  	public function _callback_url($value, $primary_key) {

        // Check if ext_url is true
        if ($value['ext_url'] != 1) {

		   $url = url_title($value['subject'],'-',true);

            // Set url_title() function to set readable text
            $value['url'] = $url;

        }

        // Return update database
        return $value;
    }

    public function _callback_priority_add ($value, $row) {

        $count = $this->PageSocmeds->find_count(['status !='=>'']) + 1;
        return '<input style="width:24px" type="text" maxlength="3" value="'.$count.'" name="priority">&nbsp;&nbsp;<small>Ordering Index</small>';
    }

    public function _callback_priority_edit ($value, $row) {
        $count = $value;
        return '<input style="width:24px" type="text" maxlength="3" value="'.$count.'" name="priority">&nbsp;&nbsp;<small>Ordering Index</small>';
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

    public function _callback_add_ext_url ($value, $row) {
    	return lang('no').' <input type="radio" value="0" name="ext_url" checked>&nbsp;&nbsp;&nbsp;&nbsp;'.lang('yes').' <input type="radio" value="1" name="ext_url"> ';
    }

    public function _callback_edit_ext_url ($value, $row) {

        $input = lang('no').' <input type="radio" value="0" name="ext_url" '.(($value == 0) ? 'checked':'').'>&nbsp;&nbsp;&nbsp;&nbsp;'.lang('yes').' <input type="radio" value="1" name="ext_url" '.(($value==1) ? 'checked' :'').'> ';

    	return $input;
    }

    private function load($crud, $nav) {
        $output = $crud->render();
        $output->nav = $nav;
        if ($crud->getState() == 'list') {
            // Set Page Title
            $output->page_title = lang('Social Medias').' Listings';
            // Set Main Template
            $output->main       = 'template/admin/metronix';
            // Set Primary Template
            $this->load->view('template/admin/template.php', $output);
        } else {
    	    // Set Page Title
            $output->page_title = lang('Social Medias').' Listings';
         	// Set note for popup message
        	$output->notes 		= $this->notes;
        	// Set JS Inline
        	$output->js_inline 	= "// You can put inline javascript here";
            // Set Primary Template
            $this->load->view('template/admin/popup.php', $output);
        }
    }
}

/* End of file page.php */
/* Location: ./application/module/page/controllers/pagemenu.php */
