<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductAccessory extends Admin_Controller {

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
        $this->load->model('product/ProductAccessories');
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
                $result = $this->ProductAccessories->update($post['id'],$post,true);

            } else {
                // Save new Product Service
                $post['added'] = time();
                unset($post['csrf_token']);
                $result = $this->ProductAccessories->insert($post,true);

                // Set callback for resize crop image
                $this->_callback_after_upload($this->input->post('media'));
            }

            echo $result;
            exit;
         }

        // Set main product
        $data['product'] = $this->Products->get($id);

        // Set main product
        $data['productaccessories'] = $this->ProductAccessories->findAllBy('product_id', $id);

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
                        $('#form-accessory').submit(function(){
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
                        $('.accessory-edit-btn').click(function() {
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
                                        $('textarea[name=text]').val(response.data.text);
                                        $('input[name=attribute]').val(response.data.attribute);
                                        $('input[name=media]').val(response.data.media);
                                        window.location.replace('#form-accessory');

                                    }
                                },
                                error: function (request,setting){
                                }
                                });
                            }
                            return false;
                        });
                        $('.accessory-delete-btn').click(function() {
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
                            $('input[name=attribute]').val('');
                            $('textarea[name=text]').val('');
                            $('input[name=media]').val('');
                        });
                        ";

        // Set main template
        $data['main'] = 'product/productaccessories_index';

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

            $data = $this->ProductAccessories->findBy('id',$id,'id,subject,text,media,attribute',['added'=>'DESC']);

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

            $data = $this->ProductAccessories->delete($id);

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
            $output->page_title = 'Product Accesories Listings';
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
