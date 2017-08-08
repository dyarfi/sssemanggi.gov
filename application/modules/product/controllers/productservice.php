<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductService extends Admin_Controller {

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
        $this->load->model('product/ProductServices');
        $this->load->model('product/ProductServiceAttributes');
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
                $result = $this->ProductServices->update($post['id'],$post,true);
            } else {
                // Save new Product Service
                $post['added'] = time();
                // This must be set to publish after all input data all are done !!!!
                $post['status'] = 'unpublish';
                unset($post['csrf_token']);
                $result = $this->ProductServices->insert($post,true);
            }

            echo $result;
            exit;
         }

        // Set main product
        $data['product'] = $this->Products->get($id);

        // Set main product services
        $data['productservices']    = $this->ProductServices->with('productserviceattributes')->with('models')->findAllBy('product_id', $id, '*', ['model_id'=>'ASC']);

        // Set main product models
        $data['productmodels']      = $this->ProductModels->findAllBy('product_id', $id);

        // Load JS inpage execution
        $data['js_inline'] = "
                        // Clear form in the #form-service-items form
                        $('.get-service-list').live('click',function() {
                            $('#form-service-items').find('input').val('');
                            $('.title-item').html($(this).data('title'));
                        });
                        // Set modal z-index into
                        $('.click-overlay').click(function() {
                            //$('.modal-backdrop, .modal-backdrop.fade.in').attr('style','z-index:9 !important');
                            $('.fancybox-overlay').attr('style','z-index:9999 !important');
                        });
                        // Set Iframe for colorbox Image
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
                            alert('update '+field_id+ ' with '+url);
                            //your code
                        }
                        $('#form-services').submit(function(){
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
                        $('.service-edit-btn').click(function() {
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
                                        $('select[name=model_id] option[value='+response.data.model_id+']').prop('selected',true);
                                        $('input[name=subject]').val(response.data.subject);
                                        $('textarea[name=text]').val(response.data.text);
                                        window.location.replace('#form-services');
                                    }
                                },
                                error: function (request,setting){
                                }
                                });
                            }
                            return false;
                        });
                        $('.service-delete-btn').click(function() {
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
                            $('textarea[name=text]').val('');
                        });
                        // Submit form service items
                        $('#form-service-items').submit(function() {
                            var form = $(this);
                            var url  = form.attr('action');
                            if (form.find('input[name=name]').val() == '') {
                                alert('Name should not empty!');
                            } else if (form.find('input[name=price]').val() == '') {
                                alert('Price should not empty!');
                            } else if (form.find('input[name=quantity]').val() == '') {
                                alert('Quantity should not empty!');
                            } else if (form.find('input[name=media]').val() == '') {
                                alert('Media should not empty!');
                            } else {
                                $.ajax({
                                    type: 'POST',
                                    url: url,
                                    data: form.serialize(),
                                    datatype: 'JSON',
                                    async: false,
                                    cache: false,
                                    success: function(response) {
                                        //if(response.success) {
                                            //setInterval(window.location.reload(),3000);
                                        //} else {
                                            //alert('Can not delete at the moment');
                                        //}
                                        $('#datatable_ajax').dataTable().fnDraw();
                                        $('#form-service-items').find('input[name!=service_id]').val('');
                                    },
                                    error: function (request,setting){
                                    }
                                });
                            }
                            return false;
                        });
                        // DataTables
                        $('.dataTable').DataTable({'bDestroy': false, 'bLengthChange': false, 'iDisplayLength': 10});
                        $('.dataTables_filter input, .dataTables_length select').addClass('form-control');
                        // Ajax DataTables
                        TableAjax.init();
                        // Editable DataTables
                        // TableEditable.init();
                        // Edit service item
                        $('.edit-service-item').live('click',function(){
                            var form = $('#form-service-items');
                            var id   = $(this).data('id');
                            var url  = base_ADM + '/productservice/list_items/' + id;
                            $.ajax({
                                type: 'POST',
                                url: url,
                                data: {id : id},
                                datatype: 'JSON',
                                async: false,
                                cache: false,
                                success: function(response) {
                                    if(response.success) {
                                        $.each(response.data, function (key, value) {
                                            //console.log(value);
                                            form.find('input[name='+key+']').val(value);
                                        });
                                        //setInterval(window.location.reload(),3000);
                                    } else {
                                        alert('Can not view service items at the moment');
                                    }
                                },
                                error: function (request,setting){
                                }
                            });
                            // ================= GET JSON DATA ================== //
                            //form.find('input[name=name]').val('asdf');
                            //form.find('input[name=price]').val('asdf');
                            //form.find('input[name=quantity]').val('asdf');
                            //form.find('input[name=media]').val('asdf');
                        });
                        // Delete service item
                        $('.delete-service-item').live('click',function(){
                            var form = $('#form-service-items');
                            var id   = $(this).data('id');
                            var url  = base_ADM + '/productservice/list_item_delete/' + id;
                            $.ajax({
                                type: 'POST',
                                url: url,
                                data: {id : id},
                                datatype: 'JSON',
                                async: false,
                                cache: false,
                                success: function(response) {
                                    if(response.success) {
                                        $('#datatable_ajax').dataTable().fnDraw();
                                    } else {
                                        alert('Can not delete service item at the moment');
                                    }
                                },
                                error: function (request,setting){
                                }
                            });
                        });
                        //$('input[name=price]').autoNumeric('init', { currencySymbol : 'Rp' });
                        $('input[name=price], .autonumeric').autoNumeric({aSep: '.', aDec: ',','aPad':false,'vMin': '00000000','vMax':'99999999'});
                        $('.autonumeric').live('keyup, blur', function() {
                            $(this).autoNumeric('update');
                        });
                        $('.autonumeric').autoNumeric('update');
                        ";

        // Set admin title page with module menu
        $data['js_files'] = [
                            base_url('assets/grocery_crud/texteditor/ckeditor/ckeditor.js'),
                            base_url('assets/grocery_crud/texteditor/ckeditor/adapters/jquery.js'),
                            base_url('assets/grocery_crud/js/jquery_plugins/config/jquery.ckeditor.config.js'),
                            base_url('assets/admin/scripts/custom/form-datatables.js'),
                            base_url('assets/admin/plugins/autoNumeric-min.js'),
                            //base_url('assets/admin/scripts/custom/form-datatable-editables.js')
                            ];

        // Set main template
        $data['main'] = 'product/productservice_index';

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

            $data = $this->ProductServices->findBy('id',$id,'id,model_id,subject,text',['added'=>'DESC']);

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

            $data = $this->ProductServices->delete($id);

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

    public function view($id="") {

        // Check if the request via AJAX
        if ($this->input->is_ajax_request()) {

            $rows = $this->ProductServiceAttributes->findAllBy('service_id',$id);
            $total_records = $this->ProductServiceAttributes->find_count(['service_id'=>$id]);
            /*
             * Paging
             */

            $iTotalRecords = $total_records;
            $iDisplayLength = intval($_REQUEST['iDisplayLength']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($_REQUEST['iDisplayStart']);
            $sEcho = intval($_REQUEST['sEcho']);

            $records = array();
            $records["aaData"] = array();

            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;

            //$status_list = array(
                //array("success" => "Pending"),
                //array("info" => "Closed"),
                //array("danger" => "On Hold"),
                //array("warning" => "Fraud")
            //);

            $c=0;
            for($i = $iDisplayStart; $i < $end; $i++) {
                //$status = $status_list[rand(0, 2)];
                $id = ($i + 1);
                $records["aaData"][] = array(
                  $rows[$c]->name,
                  '<div style="text-align:center"><img height="60px" src="'.base_url($rows[$c]->media).'"/></div>',
                  $rows[$c]->quantity,
                  '<span class="autonumeric price">'.$rows[$c]->price.'</span>',
                  '<a class="edit edit-service-item" href="#form-service-items" data-id="'.$rows[$c]->id.'"> Edit </a>',
                  '<a class="delete delete-service-item" href="javascript:;" data-id="'.$rows[$c]->id.'"> Delete </a>',
                );
                $c++;
            }

            if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
                $records["sStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
                $records["sMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
            }

            $records["sEcho"] = $sEcho;
            $records["iTotalRecords"] = $iTotalRecords;
            $records["iTotalDisplayRecords"] = $iTotalRecords;
        }

        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($records));

        //echo json_encode($records);
    }

    // Get service item list
    public function list_items($id="") {

        // Check if the request via AJAX
        if ($this->input->is_ajax_request()) {

            // Set default response
            $response = array('success' => false, 'message' => null, 'data' => null);

            $data = $this->ProductServiceAttributes->findBy('id',$id,'id,service_id,name,price,quantity,media',['added'=>'DESC']);

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

    // Get service item list
    public function list_item_delete($id="") {

        // Check if the request via AJAX
        if ($this->input->is_ajax_request()) {

            // Set default response
            $response = array('success' => false, 'message' => null, 'data' => null);

            $data = $this->ProductServiceAttributes->delete($id);

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

    // Change service item list
    public function store($id='') {

        //print_r($this->input->post());
        //exit;

        // Check if the request via AJAX
        if ($this->input->is_ajax_request() && $this->input->post()) {

            $post = $this->input->post();
            if ($post['id']) {
                // Edit new Product Service
                $post['modified'] = time();
                unset($post['csrf_token']);
                $result = $this->ProductServiceAttributes->update($post['id'],$post,true);
            } else {
                // Save new Product Service
                $post['added'] = time();
                unset($post['csrf_token']);
                $result = $this->ProductServiceAttributes->insert($post,true);
            }

            echo $result;
            exit;
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
            $output->page_title = 'Product Service Listings';
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
