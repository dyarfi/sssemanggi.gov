<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductVariant extends Admin_Controller {

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

        // Load Product Attributes model
        $this->load->model('product/Products');
        $this->load->model('product/ProductVariants');
        $this->load->model('product/ProductColors');

		// Load Grocery CRUD
		$this->load->library('grocery_CRUD');

		// Set priviledge
        $class       = 'Product';
        $this->class = strtolower(get_class());
        $this->module_function_list[$class];
        $this->is_allowed = $this->module_function_list[$class];


    }

    public function index($id="") {

        // Check if the request via AJAX
        if ($this->input->is_ajax_request() && $this->input->post()) {

            // Set or Insert data Accessories
            $post = $this->input->post();

            // Get the id if existed
            if ($post['id']) {
                // Edit new Product Service
                $post['modified'] = time();
                unset($post['csrf_token']);
                $result = $this->ProductVariants->update($post['id'],$post,true);

            } else {
                // Save new Product Service
                $post['added'] = time();
                unset($post['csrf_token']);
                $result = $this->ProductVariants->insert($post,true);

            }

            echo $result;
            exit;
         }

        // Set main product
        $data['product'] = $this->Products->get($id);

        // Set main product
        $data['product_colors'] = $this->ProductColors->findAll(['status'=>'publish']);

        // Set main product
        $data['productvariants'] = $this->ProductVariants->findAllBy('product_id', $id,'*',['priority'=>'ASC']);

        // Load JS inpage execution
        $data['js_inline'] = "
                        $('.iframe-btn').fancybox({
                            'width'     : 900,
                            'height'    : 600,
                            'minHeight' : 600,
                            'type'      : 'iframe',
                            'autoScale' : false
                        });
                        function responsive_filemanager_callback(field_id){
                            console.log(field_id);
                            var url=jQuery('#'+field_id).val();
                            alert('update '+field_id+\" with \"+url);
                            //your code
                        }
                        $('#form-variants').submit(function(){
                            var val  = $(this).find('input#fieldID4').val();
                            var link = $(this).attr('action');
                            if (link){
                                var pid = $(this).attr('pid');
                                $.ajax({
                                type: 'POST',
                                url: link,
                                data: $(this).serialize(),
                                datatype: 'JSON',
                                async: false,
                                cache: false,
                                success: function(msg){
                                    if (msg == 1) {
                                        alert('Please wait while updating data');
                                    }
                                    $('.clear-form').click();
                                    setInterval(window.location.reload(),3000);
                                },
                                error: function (request,setting){
                                }
                                });
                                  //window.location = window.location;
                              //window.location.reload();
                            }
                            return false;
                        });
                        $('.variant-edit-btn').click(function() {
                            var link = $(this).attr('rel');
                            if (link){
                                $.ajax({
                                type: 'GET',
                                url: link,
                                data: $(this).serialize(),
                                datatype: 'JSON',
                                async: false,
                                cache: false,
                                success: function(response) {
                                    if(response.success)
                                    {
                                        $('input[name=id]').val(response.data.id);
                                        $('input[name=subject]').val(response.data.subject);
                                        $('input[name=media]').val(response.data.media);
                                        $('#color_id option[value='+response.data.color_id+']').prop('selected',true);
                                        $('input[name=priority]').val(response.data.priority);
                                        window.location.replace('#form-variants');
                                    }
                                },
                                error: function (request,setting){
                                }
                                });
                            }
                            return false;
                        });
                        $('.variant-delete-btn').click(function() {
                            var link = $(this).attr('rel');
                            var answer = confirm('Confirm Delete?');
                            if (link){
                                if (answer){
                                    $.ajax({
                                        type: 'GET',
                                        url: link,
                                        data: $(this).serialize(),
                                        datatype: 'JSON',
                                        async: false,
                                        cache: false,
                                        success: function(response) {
                                            if(response.success) {
                                                setInterval(window.location.reload(),3000);
                                            } else {
                                                alert('Can not delete at the moment');
                                            }
                                        },
                                        error: function (request,setting){
                                        }
                                    });
                                }
                            }
                            return false;
                        });
                        $('.clear-form').click(function(){
                            $('input[name=id]').val('');
                            $('input[name=subject]').val('');
                            $('select[name=color_id]').val('');
                            $('input[name=media]').val('');
                            $('input[name=priority]').val('');
                        });
                        ";

        // Set main template
        $data['main'] = 'product/productvariants_index';

        // Set module with URL request
        $data['module_title'] = $this->module;

        // Set admin title page with module menu
        $data['page_title'] = lang($this->module_menu);

        // Load admin template
        $this->load->view('template/admin/blank', $this->load->vars($data));

    }

    public function edit($id="") {

        // Check if the request via AJAX
        if ($this->input->is_ajax_request()) {

            // Set default response
            $response = array('success' => false, 'message' => null, 'data' => null);

            $data = $this->ProductVariants->findBy('id',$id,'id,subject,color_id,media,priority,attribute',['added'=>'DESC']);

            if ($data) {
                $response['success'] = true;
                $response['message'] = true;
                $response['data']    = $data;
            }

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));

         }

    }

    public function delete($id="") {

        // Check if the request via AJAX
        if ($this->input->is_ajax_request()) {

            // Set default response
            $response = array('success' => false, 'message' => null, 'data' => null);

            $data = $this->ProductVariants->delete($id);

            if ($data) {
                $response['success'] = true;
                $response['message'] = true;
                $response['data']    = $data;
            }

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));

         }

    }

    public function _callback_url($value, $primary_key) {
        // Set url_title() function to set readable text
        $value['url'] = url_title($value['name'],'-',true);
        // Return update database
		return $value;
    }

    public function _callback_time ($value, $row) {
		return empty($value) ? '-' : date('D, d-M-Y',$value);
    }

    public function _callback_gallery ($value,$row) {
        if ($row->id) {
            return '<a href="'.base_url(ADMIN).'/conference_gallery/index/'.$row->id.'" class="fancyframe iframe"><span class="btn btn-default btn-mini glyphicon glyphicon-camera"></span></a>';
        } else {
            return '-';
        }
    }

    public function _callback_banner ($value,$row) {
        if ($row->id) {
            return '<a href="'.base_url(ADMIN).'/conference_banner/index/'.$row->id.'" class="fancyframe iframe"><span class="btn btn-default btn-mini glyphicon glyphicon-picture"></span></a>';
        } else {
            return '-';
        }
    }

    public function _callback_set_link ($value, $row) {
		if ($row->user_id == NULL) {
			return '<a href="'.base_url(ADMIN).'/employee/set/'.$row->id.'" class="fa fa-arrow-circle-left">&nbsp;</a>';
		} else {
			return 'Already Employed';
		}
    }

    private function load($crud, $nav) {
        $output = $crud->render();
        $output->nav = $nav;
        if ($crud->getState() == 'list') {
            // Set Page Title
            $output->page_title = 'Product Variant Listings';
            // Set Main Template
            $output->main       = 'template/admin/metronix';
            // Set Primary Template
            $this->load->view('template/admin/popup_uploader.php', $output);
        } else {
            $this->load->view('template/admin/popup_uploader.php', $output);
        }
    }
}

/* End of file Product Attributes.php */
/* Location: ./application/module/career/controllers/Product Attributes.php */
