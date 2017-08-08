<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Automobile extends Admin_Controller {

    /**
     * Index Company_Presentation for this controller.
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

			// Load Products
            $this->load->model('product/Products');

			// Load Product to Attributes
            //$this->load->model('product/ProductToAttributeGroups');

            //$this->load->model('page/PageMenus');

            // Load Grocery CRUD
            $this->load->library('grocery_CRUD');

            // Set priviledge
	        $class       = 'Product';
	        $this->class = strtolower(get_class());
	        $this->module_function_list[$class];
	        $this->is_allowed = $this->module_function_list[$class];

		 	$this->notes->media = [
					'ext' => 'jpg|jpeg',
					'dimension' => '1192x671'
				];
			$this->notes->thumbnail = [
					'ext' => 'jpg|jpeg',
					'dimension' => '600x385'
				];

    }

    public function index() {
        try {
	   		// Set our Grocery CRUD
            $crud = new grocery_CRUD();
            // Set CRUD language
            $crud->set_language($this->i18ln->native);
            // Works exactly the same way as codeigniter's where ($this->db->where)
            $crud->where('tbl_products.type','automobile');
            // Set tables
            $crud->set_table($this->Products->table);
            // Set relation
            $crud->set_relation('category_id','tbl_product_categories','subject',array('status' => 'publish'));
            // Set relation
            $crud->set_relation('group_id','tbl_product_groups','subject',array('type' => 'automobile'),'subject ASC');
            // Order by Listing
            $crud->order_by('priority','DESC');
            // Set CRUD subject
            $crud->set_subject(lang('Automobile'));
            // Set columns
            $crud->columns('subject','category_id','group_id','cover','media','media_plain','model','variant','accessory','service','status','added');
			// The fields that user will see on add and edit form
			$crud->fields('subject','url','category_id','group_id','text','cover','thumbnail','media','media_plain','attribute','specification','feature','price','messages','brochure','pricelist','priority','status','type','is_service','is_pricelist','added','modified');
            // Changes the default field type
            $crud->field_type('user_id','hidden', $this->acl->user()->id);
			$crud->field_type('url', 'hidden');
			$crud->field_type('type', 'hidden');
			$crud->field_type('added', 'hidden');
			$crud->field_type('modified', 'hidden');
			$crud->field_type('attribute', 'hidden');
			$crud->field_type('is_service','dropdown',array('0' => 'No', '1' => 'Yes'));
            $crud->field_type('is_pricelist','dropdown',array('0' => 'No', '1' => 'Yes'));
			// $crud->field_type('status','dropdown',array('1' => 'active', '2' => 'private','3' => 'spam' , '4' => 'deleted'));
			$crud->unset_texteditor('messages');
			// Set unique fields
			$crud->unique_fields('subject');
			// Set display field
			$crud->display_as('category_id','Category');
			// Set display field
			$crud->display_as('group_id','Group');

			if ($this->Languages->getActiveCount() > 1) {
				// Default column of multilanguage
				$crud->columns('subject','text'/*,'gallery'*/,'media','status','added','modified','translate');
				// Callback_column translate
				$crud->callback_column('translate',array($this,'_callback_translate'));
			}

			// -------------------- SPECIFICATION -------------------- //
			// This callback escapes the default auto field output of the field name at the add form
			$crud->callback_field('specification',array($this,'_callback_specification'));
			// -------------------- FEATURE -------------------------- //
			// This callback escapes the default auto field output of the field name at the edit form
			$crud->callback_field('feature',array($this,'_callback_feature'));
			// -------------------- PRICE ---------------------------- //
			// This callback escapes the default auto field output of the field name at the edit form
			$crud->callback_field('price',array($this,'_callback_price'));
            // -------------------- Brochure ---------------------------- //
            // This callback escapes the default auto field output of the field name at the edit form
            $crud->callback_field('brochure',array($this,'_callback_brochure'));

			// This callback escapes the default auto field output of the field name at the add form
			$crud->callback_add_field('added',array($this,'_callback_time_added'));
			// This callback escapes the default auto field output of the field name at the edit form
			$crud->callback_edit_field('modified',array($this,'_callback_time_modified'));
			// This callback escapes the default auto field output of the field name at the add/edit form.
			$crud->callback_field('type',array($this,'_callback_field_type'));

            // Callback Column
            $crud->callback_column('media',array($this,'_callback_column_media'));
            $crud->callback_column('cover',array($this,'_callback_cover'));
            $crud->callback_column('variant',array($this,'_callback_variant'));
            $crud->callback_column('accessory',array($this,'_callback_accessory'));
            $crud->callback_column('service',array($this,'_callback_column_service'));
            $crud->callback_column('model',array($this,'_callback_column_model'));

            // This callback escapes the default auto column output of the field name at the add form
			$crud->callback_column('added',array($this,'_callback_time'));
			$crud->callback_column('modified',array($this,'_callback_time'));

			// Set callback before database set
            $crud->callback_before_insert(array($this,'_callback_url'));
            $crud->callback_before_insert(array($this,'_callback_fields'));
            $crud->callback_after_delete(array($this,'_callback_after_delete'));

			// Sets the required fields of add and edit fields
			$crud->required_fields('subject','category_id','text','cover','status');
	        $crud->set_rules('subject','Subject','trim|required|min_length[3]|max_length[72]|xss_clean');
        	$crud->set_rules('text','Text','trim|min_length[3]|xss_clean');

            // Set callback after upload
            $crud->callback_after_upload(array($this,'_callback_after_upload'));

            // Set upload field
            $crud->set_field_upload('cover','uploads/automobile', $this->notes->cover['ext']);
            // Set upload field
            $crud->set_field_upload('media','uploads/automobile', $this->notes->cover['ext']);
            // Set upload field
            $crud->set_field_upload('media_plain','uploads/automobile', $this->notes->cover['ext']);
            // Set upload field
            $crud->set_field_upload('thumbnail','uploads/automobile', $this->notes->cover['ext']);

            // Set Callback update grocery input rewrite
            $crud->callback_update(array($this,'_callback_update'));

            // Set upload field
            //$crud->set_field_upload('media','uploads/pages', 'ppt|doc|pptx|docx|pdf');

  			// Changes the displaying label of the field.
			//$crud->display_as('media','File');

  			// Changes the displaying label of the field.
			$crud->display_as('cover','Logo');
			$crud->display_as('messages','Video');

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
				//$crud->callback_field('cover',array($this,'_callback_cover'));
				//$crud->callback_field('media',array($this,'_callback_media'));
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
            // Unset export
            $crud->unset_export();
            // Load Grocery Crud
            $this->load($crud, 'automobile_crud');
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
        $crud->where('table',$this->Templates->table);

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
        $crud->set_rules('subject','Subject','trim|required|min_length[3]|max_length[72]|xss_clean');
        $crud->set_rules('text','Text','trim|min_length[3]|xss_clean');

		$state = $crud->getState();
		$state_info = $crud->getStateInfo();

		$crud->unset_list();

		$this->load($crud, 'automobile_detail');

	}

	public function translate($field_id='',$lang_id='',$prefix='') {

		$this->db->where('lang_id',$lang_id);
		$this->db->where('field_id',$field_id);
        $this->db->where('table',$this->Templates->table);

		$media_db = $this->db->get('tbl_translations');

		if($media_db->num_rows() == 0)
		{
			$object['table']	= $this->Templates->table;
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
				$page_db = $this->db->where('lang_id',$lang->id)->where('field_id',$row->id)->where('table',$this->Templates->table)->get('tbl_translations');
				$links .= '<a href="'.base_url(ADMIN).'/product/translate/'.$row->id.'/'.$lang->id.'/'.$lang->prefix.'" class="fancyframe iframe" title="Translation '.$lang->name.' - '.$row->subject.'"><img src="'.base_url('assets/admin/img/flags/'.$lang->prefix.'.png').'"/></a>'.($page_db->num_rows() != 0 ? '' : '&nbsp;<div class="label label-warning label-xs"><span class="fa fa-plus"></span></div>');
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
        $existed_db = $this->Content->findIdByUrl('template_pages',$url);

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

 	public function _callback_update($post_array, $primary_key) {

 		$content['spesifikasi'] = $post_array['spesifikasi'];
 		$content['features'] 	= $post_array['features'];
 		$content['price'] 		= $post_array['price'];
 		$post_array['url'] 		= url_title($post_array['subject'],'-',true);
 		$post_array['attribute'] 	= json_encode($content);

 		unset($post_array['spesifikasi']);
 		unset($post_array['features']);
 		unset($post_array['price']);
 		//unset($post_array['service']);
 		unset($post_array['csrf_token']);

 		return $this->db->update($this->Products->table,$post_array,array('id' => $primary_key));

    }

	public function _callback_fields($post_array, $primary_key) {

 		$content['spesifikasi'] = $post_array['spesifikasi'];
 		$content['features'] 	= $post_array['features'];
 		$content['price'] 		= $post_array['price'];

		$post_array['url']		= url_title($post_array['subject'],'-',true);
 		$post_array['attribute'] 	= json_encode($content);

 		unset($post_array['spesifikasi']);
 		unset($post_array['features']);
 		unset($post_array['price']);
 		unset($post_array['csrf_token']);

 		return $post_array;

    }

    public function _callback_after_upload($uploader_response,$field_info, $files_to_upload) {
        $this->load->library('image_moo');

        //Is only one file uploaded so it ok to use it with $uploader_response[0].
        $file_uploaded  = $field_info->upload_path.'/'.$uploader_response[0]->name;

        $thumbnail[1]      = $field_info->upload_path.'/thumb__600x385'.$uploader_response[0]->name;
        $thumbnail[2]      = $field_info->upload_path.'/thumb__1192x671'.$uploader_response[0]->name;

        $this->image_moo
        ->load($file_uploaded)
        ->save($file_uploaded,true)
        ->resize_crop(600,385)
        ->save($thumbnail[1],true)
        //->resize_crop(1920,1080)
        ->resize(1192,671)
        ->save($thumbnail[2],true);

        if ($this->image_moo->error) print $this->image_moo->display_errors(); else return true;

    }

    public function _callback_brochure ($value,$row) {
        // base_url("assets/filemanager/dialog.php?type=2&relative_url=1&field_id=fieldID4&external=flipbook&fldr=flipbook&akey=".sha1('encryption+**&&^^%%$RGGGFR$&&UUJJZXCVZXCV'))
        // base_url("assets/grocery_crud/texteditor/kcfinder/browse.php?type=images&lang=bg&dir=images/public")
        return
        '<div class="input-group col-md-12">
            <input id="fieldID4" class="form-control col-md-8" type="text" name="brochure" value="'.$value.'" placeholder="Brochure">
            <span class="input-group-btn">
                <a class="btn btn-danger iframe-btn click-overlay" type="button" href="'.base_url("flipbook/mediapanel/dialog.php?type=2&relative_url=0&field_id=fieldID4&akey=".sha1('encryption+**&&^^%%$RGGGFR$&&UUJJZXCVZXCV')).'">Select</a>
            </span>
        </div>';
    }

    public function _callback_gallery ($value,$row) {
        if ($row->id) {
            return '<a href="'.base_url(ADMIN).'/media_gallery/index/'.$row->id.'" class="fancyframe iframe"><span class="btn btn-default btn-mini glyphicon glyphicon-camera"></span></a>';
        } else {
            return '-';
        }
    }

    public function _callback_variant ($value,$row) {
        if ($row->id) {
            return '<a href="'.base_url(ADMIN).'/productvariant/index/'.$row->id.'" class="fancyframe iframe"><span class="btn btn-default btn-mini glyphicon glyphicon-picture"></span></a>';
        } else {
            return '-';
        }
    }

    public function _callback_accessory ($value,$row) {
        if ($row->id) {
            return '<a href="'.base_url(ADMIN).'/productaccessory/index/'.$row->id.'" class="fancyframe iframe"><span class="btn btn-default btn-mini glyphicon glyphicon-tasks"></span></a>';
        } else {
            return '-';
        }
    }

    public function _callback_column_service($value,$row) {
        if ($row->id) {
            return '<a href="'.base_url(ADMIN).'/productservice/index/'.$row->id.'" class="fancyframe iframe"><span class="btn btn-default btn-mini glyphicon glyphicon-map-marker"></span></a>';
        } else {
            return '-';
        }
    }

    public function _callback_column_model($value,$row) {
        if ($row->id) {
            return '<a href="'.base_url(ADMIN).'/productmodel/index/'.$row->id.'" class="fancyframe iframe"><span class="btn btn-default btn-mini glyphicon glyphicon-tags"></span></a>';
        } else {
            return '-';
        }
    }

   	public function _callback_after_delete($primary_key) {
   		// Delete translation field
	    return $this->db->delete('tbl_translations', ['field_id' => $primary_key, 'table' => $this->Templates->table]);
	}

	public function _callback_cover ($value,$row) {
	    if ($value) {
            return '<a href="'.base_url('uploads/automobile').'/'.$value.'" class="fancyframe iframe"><img height="30" src="'.base_url('uploads/automobile').'/'.$value.'"/></a>';
        } else {
            return '-';
        }
    }

	public function _callback_media ($value,$row) {
	    if ($value) {
            return '<a href="'.base_url('uploads/automobile').'/'.$value.'" class="fancyframe iframe"><img height="30" src="'.base_url('uploads/automobile').'/'.$value.'"/></a>';
        } else {
            return '-';
        }
    }

	public function _callback_column_media($value,$row) {
	    if ($value) {
            return '<a href="'.base_url('uploads/automobile').'/'.$value.'" class="fancyframe iframe"><img height="40" src="'.base_url('uploads/automobile').'/'.str_replace($value, 'thumb__1192x671'.$value, $value).'"/></a>';
        } else {
            return '-';
        }
    }

  	public function _callback_field_type($value = '', $primary_key = null) {

		return '<input type="hidden" maxlength="50" value="automobile" name="type">';
	}

	public function _callback_url($post_array, $primary_key) {

		// Set url_title() function to set readable text
        $post_array['url'] = url_title($post_array['subject'],'-',true);
        // Return update database
        return $post_array;
    }

    public function _callback_time ($value, $row) {
		return empty($value) ? '-' : date('D, d-M-Y',$value);
    }

    public function _callback_specification($value='', $primary_key = null) {

    	$content = $this->Products->find(['id'=>$primary_key]);
		$attribute = json_decode($content->attribute, true);
		$return['spesifikasi'] = $attribute['spesifikasi'];

    	if (!$return['spesifikasi']) {
	    	$jsons = [
				'spesifikasi' => [
			    	'dimensi' 		=> [
			    		'attributes' => [
	    					[
			    				'name'	=> 'panjang_keseluruhan',
			    				'label' => 'Panjang Keseluruhan',
			    				'unit_label' => 'mm',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
		    				[
		    					'name'	=> 'lebar_keseluruhan',
			    				'label' => 'Lebar Keseluruhan',
			    				'unit_label' => 'mm',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
		    				[
		    					'name'	=> 'tinggi_keseluruhan',
			    				'label' => 'Tinggi Keseluruhan',
			    				'unit_label' => 'mm',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
		    				[
		    					'name'	=> 'jarak_poros_roda',
			    				'label' => 'Jarak Poros Roda',
			    				'unit_label' => 'mm',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
		    				[
		    					'name'	=> 'jarak_pijak_depan',
			    				'label' => 'Jarak Pijak Depan',
			    				'unit_label' => 'mm',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
							[
		    					'name'	=> 'jarak_pijak_belakang',
			    				'label' => 'Jarak Pijak Belakang',
			    				'unit_label' => 'mm',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
							[
		    					'name'	=> 'jarak_terendah',
			    				'label' => 'Jarak Terendah',
			    				'unit_label' => 'mm',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
							[
		    					'name'	=> 'radius_putar_minimum',
			    				'label' => 'Radius Putar Minimum',
			    				'unit_label' => 'm',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
    					]
					],
		    		'mesin' => [
		    		'attributes' => [
	    					[
			    				'name'	=> 'jenis',
			    				'label' => 'Jenis',
			    				'unit_label' => '',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
		    				[
		    					'name'	=> 'isi_silinder',
			    				'label' => 'Isi Silinder',
			    				'unit_label' => '',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
		    				[
		    					'name'	=> 'jumlah_katup',
			    				'label' => 'Jumlah Katup',
			    				'unit_label' => '',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
		    				[
		    					'name'	=> 'jumlah_silinder',
			    				'label' => 'Jumlah Silinder',
			    				'unit_label' => '',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
		    				[
		    					'name'	=> 'diameter_x_langkah',
			    				'label' => 'Diameter x Langkah',
			    				'unit_label' => '',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
							[
		    					'name'	=> 'perbandingan_kompresi',
			    				'label' => 'Perbandingan Kompresi',
			    				'unit_label' => '',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
							[
		    					'name'	=> 'daya_maksimum',
			    				'label' => 'Daya Maksimum',
			    				'unit_label' => '',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
							[
		    					'name'	=> 'momem_puntir_maksimum',
			    				'label' => 'Momem Puntir Maksimum',
			    				'unit_label' => '',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
							[
		    					'name'	=> 'sistem_bahan_bakar',
			    				'label' => 'Sistem Bahan Bakar',
			    				'unit_label' => '',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
    					]
					],
			    	'transmisi'	=> [
			    		'attributes' => [
    						[
			    				'name'	=> 'perbandingan_gigi_akhir',
			    				'label' => 'Perbandingan Gigi Akhir',
			    				'unit_label' => '',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
		    				[
		    					'name'	=> 'ratio_gear',
			    				'label' => 'Ratio Gear',
			    				'unit_label' => '',
			    				'type' 	=> 'textarea',
			    				'value'	=> ''
		    				]
    					]
					],
					'berat'	=> [
			    		'attributes' => [
    						[
			    				'name'	=> 'berat_kosong',
			    				'label' => 'Berat Kosong',
			    				'unit_label' => '',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
		    				[
		    					'name'	=> 'berat_kotor',
			    				'label' => 'Berat Kotor',
			    				'unit_label' => '',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				]
    					]
					],
					'rangka'	=> [
			    		'attributes' => [
    						[
			    				'name'	=> 'sistem_kemudi',
			    				'label' => 'Sistem Kemudi',
			    				'unit_label' => '',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
		    				[
		    					'name'	=> 'suspensi_depan',
			    				'label' => 'Suspensi Depan',
			    				'unit_label' => '',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
		    				[
		    					'name'	=> 'suspensi_belakang',
			    				'label' => 'Suspensi Belakang',
			    				'unit_label' => '',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
		    				[
		    					'name'	=> 'rem_depan',
			    				'label' => 'Rem Depan',
			    				'unit_label' => '',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
		    				[
		    					'name'	=> 'rem_belakang',
			    				'label' => 'Rem Belakang',
			    				'unit_label' => '',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				],
		    				[
		    					'name'	=> 'ukuran_ban',
			    				'label' => 'Ukuran Ban',
			    				'unit_label' => '',
			    				'type' 	=> 'text',
			    				'value'	=> ''
		    				]
    					]
					],
					'kapasitas'	=> [
			    		'attributes' => [
	    						[
				    				'name'	=> 'tempat_duduk',
				    				'label' => 'Tempat Duduk',
				    				'unit_label' => '',
				    				'type' 	=> 'text',
				    				'value'	=> ''
			    				],
			    				[
			    					'name'	=> 'tangki_bahan_bakar',
				    				'label' => 'Tangki Bahan Bakar',
				    				'unit_label' => '',
				    				'type' 	=> 'text',
				    				'value'	=> ''
			    				]
	    					]
	    				]
	    			]
				];
		} else {
			$jsons['spesifikasi']= $return['spesifikasi'];
		}

		$content = '<div class="tabs">';
	    	$content .= '<ul>';
	    	foreach ($jsons as $key => $json) {
	    		foreach ($json as $val => $values) {
					$content .= '<li><a href="#'.$val.'-tab">'.ucfirst(str_replace('_', ' ', $val)).'</a></li>';
				}
			}
	    	$content .= '</ul>';

	    	foreach ($jsons as $key => $json) {
	    		foreach ($json as $val => $values) {
	    			$content .= '<div id="'.$val.'-tab">';
	    				foreach ($values['attributes'] as $attribute) {
	    					if ($attribute['type'] === 'text') {
	    						$form_input = '<input type="'.$attribute['type'].'" id="'.$key.'['.$val.'][attributes]['.$attribute['name'].'][value]" name="'.$key.'['.$val.'][attributes]['.$attribute['name'].'][value]" value="'.$attribute['value'].'" placeholder="'.$attribute['unit_label'].'"/>';
	    					} else if ($attribute['type'] === 'textarea') {
	    						$form_input = '<textarea class="texteditor" id="'.$key.'['.$val.'][attributes]['.$attribute['name'].'][value]" name="'.$key.'['.$val.'][attributes]['.$attribute['name'].'][value]" placeholder="'.$attribute['unit_label'].'">'.$attribute['value'].'</textarea>';
	    					}
	    					$content .= '<div>
											<label for="'.$key.'['.$val.'][attributes]['.$attribute['name'].'][value]">'.$attribute['label'].'</label><br>
											'.$form_input.'
								  			<input type="hidden" id="'.$key.'['.$val.'][attributes]['.$attribute['name'].'][unit_label]" name="'.$key.'['.$val.'][attributes]['.$attribute['name'].'][unit_label]" value="'.$attribute['unit_label'].'"/>
								  			<input type="hidden" id="'.$key.'['.$val.'][attributes]['.$attribute['name'].'][name]" name="'.$key.'['.$val.'][attributes]['.$attribute['name'].'][name]" value="'.$attribute['name'].'"/>
								  			<input type="hidden" id="'.$key.'['.$val.'][attributes]['.$attribute['name'].'][label]" name="'.$key.'['.$val.'][attributes]['.$attribute['name'].'][label]" value="'.$attribute['label'].'"/>
								  			<input type="hidden" id="'.$key.'['.$val.'][attributes]['.$attribute['name'].'][type]" name="'.$key.'['.$val.'][attributes]['.$attribute['name'].'][type]" value="'.$attribute['type'].'"/>
							  			</div>';
						}
	    			$content .= '</div>';
				}
	    	}
    	$content .= '</div>';

    	return $content;

    }

	public function _callback_feature($value = '', $primary_key = null) {

		$content = $this->Products->find(['id'=>$primary_key]);
		$attribute = json_decode($content->attribute, true);
		$return['features'] = $attribute['features'];

    	if (!$return['features']) {
			$jsons = ['features' => [
					    	'exterior'	=> [
					    		'name'	=> 'exterior',
			    				'label' => 'Exterior',
			    				'unit_label' => '',
			    				'type' 	=> 'textarea',
			    				'value' => ''],
				    		'interior'  => [
					    		'name'	=> 'interior',
			    				'label' => 'Interior',
			    				'unit_label' => '',
			    				'type' 	=> 'textarea',
			    				'value' => ''],
					    	'performance'	 => [
					    		'name'	=> 'performance',
			    				'label' => 'Performance',
			    				'unit_label' => '',
			    				'type' 	=> 'textarea',
			    				'value' => ''],
							'safety'		 => [
					    		'name'	=> 'safety',
			    				'label' => 'Safety',
			    				'unit_label' => '',
			    				'type' 	=> 'textarea',
			    				'value' => '']
					]
			];
    	} else {
			$jsons['features']= $return['features'];
		}

		$content = '<div class="tabs">';
	    	$content .= '<ul>';
	    	foreach ($jsons as $key => $json) {
	    		foreach ($json as $val) {
					$content .= '<li><a href="#'.$val['name'].'-tab">'.$val['label'].'</a></li>';
				}
	    	}
	    	$content .= '</ul>';
	    	foreach ($jsons as $key => $json) {
	    		foreach ($json as $val) {
	    			if ($val['type'] === 'text') {
						$form_input = '<input type="text" id="'.$key.'['.$val['name'].'][value]" name="'.$key.'['.$val['name'].'][value]" value="'.$val['value'].'" placeholder="'.$val['unit_label'].'"/>';
					} else if ($val['type'] === 'textarea') {
						$form_input = '<textarea class="texteditor" id="'.$key.'['.$val['name'].'][value]" name="'.$key.'['.$val['name'].'][value]" placeholder="'.$val['unit_label'].'">'.$val['value'].'</textarea>';
					}
		    		$content .= '<div id="'.$val['name'].'-tab">';
						$content .= '<div>
						  			<label for="'.$key.'['.$val['name'].']">'.$val['label'].'</label><br>
						  			'.$form_input.'
						  			<input type="hidden" id="'.$key.'['.$val['name'].'][unit_label]" name="'.$key.'['.$val['name'].'][unit_label]" value="'.$val['unit_label'].'"/>
						  			<input type="hidden" id="'.$key.'['.$val['name'].'][name]" name="'.$key.'['.$val['name'].'][name]" value="'.$val['name'].'"/>
						  			<input type="hidden" id="'.$key.'['.$val['name'].'][label]" name="'.$key.'['.$val['name'].'][label]" value="'.$val['label'].'"/>
						  			<input type="hidden" id="'.$key.'['.$val['name'].'][type]" name="'.$key.'['.$val['name'].'][type]" value="'.$val['type'].'"/>
					  			</div>';
	    			$content .= '</div>';
    			}
	    	}
    	$content .= '</div>';
    	return $content;
    }

    public function _callback_price($value = '', $primary_key = null) {

		$content = $this->Products->find(['id'=>$primary_key]);
		$attribute = json_decode($content->attribute, true);
		$return['price'] = $attribute['price'];
		if (!$return['price']) {
	    	$jsons = ['price' => [
					    	'price_range' 		=> [
					    		'name'	=> 'price_range',
			    				'label' => 'Price Range',
			    				'unit_label' => '',
			    				'type' 	=> 'text',
			    				'value' => ''],
				    		'price_range_text' => [
					    		'name'	=> 'price_range_text',
			    				'label' => 'Price Range Text',
			    				'unit_label' => '',
			    				'type' 	=> 'text',
			    				'value' => '']
		    			]
	    			];
		} else  {
			$jsons['price']= $return['price'];
		}
    	$content = '<div class="tabs">';
	    	$content .= '<ul>';
	    	foreach ($jsons as $key => $json) {
	    		foreach ($json as $val) {
					$content .= '<li><a href="#'.$val['name'].'-tab">'.$val['label'].'</a></li>';
				}
	    	}
	    	$content .= '</ul>';
	    	foreach ($jsons as $key => $json) {
	    		foreach ($json as $val) {
	    			if ($val['type'] === 'text') {
						$form_input = '<input type="text" id="'.$key.'['.$val['name'].'][value]" name="'.$key.'['.$val['name'].'][value]" value="'.$val['value'].'" placeholder="'.$val['unit_label'].'"/>';
					} else if ($val['type'] === 'textarea') {
						$form_input = '<textarea class="texteditor" id="'.$key.'['.$val['name'].'][value]" name="'.$key.'['.$val['name'].'][value]" placeholder="'.$val['unit_label'].'">'.$val['value'].'</textarea>';
					}
		    		$content .= '<div id="'.$val['name'].'-tab">';
						$content .= '<div>
							  			<label for="'.$key.'['.$val['name'].']">'.$val['label'].'</label><br>
							  			'.$form_input.'
							  			<input type="hidden" id="'.$key.'['.$val['name'].'][unit_label]" name="'.$key.'['.$val['name'].'][unit_label]" value="'.$val['unit_label'].'"/>
						  				<input type="hidden" id="'.$key.'['.$val['name'].'][name]" name="'.$key.'['.$val['name'].'][name]" value="'.$val['name'].'"/>
						  				<input type="hidden" id="'.$key.'['.$val['name'].'][label]" name="'.$key.'['.$val['name'].'][label]" value="'.$val['label'].'"/>
							  			<input type="hidden" id="'.$key.'['.$val['name'].'][type]" name="'.$key.'['.$val['name'].'][type]" value="'.$val['type'].'"/>
						  			</div>';
	    			$content .= '</div>';
    			}
	    	}
    	$content .= '</div>';

		return $content;
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
            $output->page_title = lang('Automobile').' Listings';
            // Set Main Template
            $output->main       = 'template/admin/metronix';
            // Set Primary Template
            $this->load->view('template/admin/template.php', $output);
        } else {
			// Set Page Title
            $output->page_title = lang('Automobile').' Listings';
        	// Set note for popup message
        	$output->notes 		= $this->notes;
        	// Set JS Inline
        	$output->js_inline 	= '
                // Set modal z-index into
                $(".click-overlay").click(function() {
                    $(".fancybox-overlay").attr("style","z-index:9999 !important");
                });
                // Set Iframe for colorbox Image
                $(".iframe-btn").fancybox({
                    "width"     : 900,
                    "height"    : 600,
                    "minHeight" : 600,
                    "type"      : "iframe",
                    "autoScale" : false
                });
                function responsive_filemanager_callback(field_id){
                    console.log(field_id);
                    var url=jQuery("#"+field_id).val();
                    alert("update "+field_id+ " with "+url);
                    //your code
                }';
        	// Set Primary Template
            $this->load->view('template/admin/popup.php', $output);
        }
    }
}

/* End of file media.php */
/* Location: ./application/module/media/controllers/media.php */
