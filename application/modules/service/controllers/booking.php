<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends Admin_Controller {

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
        $class       = 'Service';// get_class();
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
            $crud->where("tbl_service_booking.approved = '1'");
            // Order by Listing
            $crud->order_by('date','DESC');
            // Set tables
            $crud->set_table('tbl_service_booking');
            // Set CRUD subject
            $crud->set_subject(lang('Booking Approval'));
            // Set columns
            //$crud->columns('service_member_id', 'dealer_id', 'service_vehicle_id', 'service_type', 'service_package', 'time', 'date');
            $crud->columns('name','email','phone','vin_number','license_number','dealer_id','service_vehicle_id', 'service_type', /*'service_package',*/ 'time', 'date');
            // Set relation
            //$crud->set_relation('dealer_id','tbl_dealers','subject');

            $crud->display_as('dealer_id', 'Dealer')
                ->display_as('service_member_id', 'Member')
                ->display_as('service_vehicle_id', 'Vehicle')
                ->display_as('service_type', 'Tipe')
                //->display_as('service_package', 'Paket')
                ->display_as('time', 'Waktu')
                ->display_as('date', 'Tanggal');

            $crud->set_relation('dealer_id','tbl_dealer_networks','name');
            $crud->set_relation('service_member_id','tbl_service_member','fullname');
            //$crud->set_relation('service_vehicle_id','tbl_service_vehicle','vin_number');

            // The fields that user will see on add and edit form
            $crud->fields('service_member_id', 'dealer_id', 'service_vehicle_id', 'service_type', /*'service_package',*/ 'time', 'date');

            // Callback Column
            //$crud->callback_column('media',array($this,'_callback_column_image'));
            $crud->callback_column('date',array($this,'_callback_date'));
            $crud->callback_column('time',array($this,'_callback_time'));
            $crud->callback_column('service_vehicle_id',array($this,'_callback_vehicle'));
            // Set callback for service type
            $crud->field_type('service_type','dropdown',[
                            '1'=>'Free Service 1 (1000 KM)',
                            '2'=>'Free Service 2 (5000 KM)',
                            '3'=>'Free Service 3 (10000 KM)',
                            '4'=>'Free Service 4 (20000 KM)',
                            '5'=>'Free Service 5 (30000 KM)',
                            '6'=>'Free Service 6 (40000 KM)',
                            '7'=>'Free Service 7 (50000 KM)',
                            '8'=>'Paket A (Kelipatan 5000 KM)',
                            '9'=>'Paket B (Kelipatan 10000 KM)',
                            '10'=>'Paket C (Kelipatan 20000 KM)',
                            '11'=>'Paket D (Kelipatan 40000 KM)',
                            '12'=>'Suzuki Product Quality Update'
                            ]
                        );

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
            if(!$this->is_allowed[$this->class.'/booking_approval/index/delete']) {
                $crud->unset_delete();
            }
            if(!$this->is_allowed[$this->class.'/booking_approval/index/edit']) {
                $crud->unset_edit();
            }
            if(!$this->is_allowed[$this->class.'/booking_approval/index/read']) {
                $crud->unset_read();
            }
            if(!$this->is_allowed[$this->class.'/booking_approval/index/add']) {
                $crud->unset_add();
            }
            // Load Grocery Crud
            $this->load($crud, 'service');
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function _callback_date($value, $row)
    {
        return date('d-m-Y', $value);
    }

    public function _callback_time($value, $row)
    {
        return (strlen($value) == 1) ? '0'.$value.':00' : $value . ':00';
    }

    public function _callback_vehicle($value, $row)
    {
        $this->load->model('product/Products');
        $this->load->model('service/ServiceVehicles');
        if($row->service_member_id == 0) {

            return $this->Products->get($row->service_vehicle_id)->subject;

        } else {

            $vehicle_id = $this->ServiceVehicles->get($row->service_vehicle_id)->vehicle_type;
            return $this->Products->get($vehicle_id)->subject;
        }
    }

    private function load($crud, $nav) {
        $output = $crud->render();
        $output->nav = $nav;
        if ($crud->getState() == 'list') {
            // Set Media Title
            $output->page_title = lang('Booking').' Listings';
            // Set Main Template
            $output->main       = 'template/admin/metronix';
            // Set Primary Template
            $this->load->view('template/admin/template.php', $output);
        } else {
            // Set Page Title
            $output->page_title = lang('Booking').' Listings';
            // Set note for popup message
            $output->notes 		= $this->notes;
            // Set Primary Template
            $this->load->view('template/admin/popup.php', $output);
        }
    }
}

/* End of file media.php */
/* Location: ./application/module/media/controllers/media.php */
