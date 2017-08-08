<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductModel extends Admin_Controller {

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
        $this->load->model('product/ProductModels');

		// Load Grocery CRUD
		// $this->load->library('grocery_CRUD');

		// Set priviledge
        $class       = 'Product';
        $this->class = strtolower(get_class());
        $this->module_function_list[$class];
        $this->is_allowed = $this->module_function_list[$class];

    }

    public function index($id="") {

        // Check if the request via AJAX
        if ($this->input->is_ajax_request() && $this->input->post()) {

            $post = $this->input->post();
            if ($post['id']) {
                // Edit new Product Service
                $post['modified'] = time();
                unset($post['csrf_token']);
                $result = $this->ProductModels->update($post['id'],$post,true);
            } else {
                // Save new Product Service
                $post['id'] = NULL;
                $post['added'] = time();
                unset($post['csrf_token']);
                $result = $this->ProductModels->insert($post,true);
            }

            echo $result;
            exit;
         }

        // Set main product
        $data['product'] = $this->Products->get($id);

        // Set main product
        $data['productmodels'] = $this->ProductModels->findAllBy('product_id', $id);

        // Load JS inpage execution
        $data['js_inline'] = "
                        $('#form-model').submit(function(){
                            var link = $(this).attr('action');
                            if (link){
                                var pid = $(this).attr('pid');
                                $.ajax({
                                type: 'POST',
                                url: link,
                                data: $(this).serialize(),
                                datatype: 'JSON',
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
                        $('.model-edit-btn').click(function() {
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
                                        $('input[name=group_name]').val(response.data.group_name);
                                        $('textarea[name=text]').val(response.data.text);
                                        $('input[name=price]').val(response.data.price);
                                        window.location.replace('#form-model');
                                    }
                                },
                                error: function (request,setting){
                                }
                                });
                            }
                            return false;
                        });
                        $('.model-delete-btn').click(function() {
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
                            $('input[name=group_name]').val('');
                            $('textarea[name=text]').val('');
                            $('input[name=price]').val('');
                        });
                        ";

        // Set admin title page with module menu
        $data['js_files'] = [
                            base_url('assets/grocery_crud/texteditor/ckeditor/ckeditor.js'),
                            base_url('assets/grocery_crud/texteditor/ckeditor/adapters/jquery.js'),
                            base_url('assets/grocery_crud/js/jquery_plugins/config/jquery.ckeditor.config.js')
                            ];

        // Set main template
        $data['main'] = 'product/productmodel_index';

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

            $data = $this->ProductModels->findBy('id',$id,'id,subject,group_name,text,price',['added'=>'DESC']);

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

            $data = $this->ProductModels->delete($id);

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

    public function _callback_after_upload($uploader_response) {

        // Load image moo
        $this->load->library('image_moo');

        //Is only one file uploaded so it ok to use it with $uploader_response[0].
        $file_uploaded      = $uploader_response;

        $pathinfo_image     = pathinfo($uploader_response);

        $thumbnail[1]       = $pathinfo_image['dirname'].'/thumb__150x150'.$pathinfo_image['basename'];

        $this->image_moo
        ->load($file_uploaded)
        ->save($file_uploaded,true)
        ->resize_crop(150,150)
        ->save($thumbnail[1],true);

        if ($this->image_moo->error) print $this->image_moo->display_errors(); else return true;

    }

    private function load($crud, $nav) {
        $output = $crud->render();
        $output->nav = $nav;
        if ($crud->getState() == 'list') {
            // Set Page Title
            $output->page_title = 'Product Model Listings';
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
