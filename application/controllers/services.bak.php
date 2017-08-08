<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services extends Public_Controller {

    var $logged_in = false;

    public function __construct() {
        parent::__construct();

        // Load models
        $this->load->model('product/Products');
        $this->load->model('product/ProductModels');        
        $this->load->model('member/Members');    
        $this->load->model('member/Notifications');
        $this->load->model('newscenter/News');
        $this->load->model('service/ServiceMemberVehicles');
        $this->load->model('service/ServiceVehicles');
        $this->load->model('service/DealerNetworks');
        $this->load->model('service/Bookings');

        $this->load->model('dealers');
        //$this->load->model('bookings');

        $this->load->model('service');
        $this->load->library('randomtext');          
        $this->load->model('contact/Contacts');

        // Set email register to sent
        $this->emails_register = $this->Contacts->findAllBy('attribute','email_register','email');
        // Set email survey to sent
        $this->emails_survey = $this->Contacts->findAllBy('attribute','email_customer_survey','email');
        // Set email booking service to sent
        $this->emails_booking = $this->Contacts->findAllBy('attribute','email_booking_service','email');

        // Check if the user logged in or not
        $this->logged_in = (($this->session->userdata('member_logged_in') == null) ? false : $this->session->userdata('member_logged_in'));
        // Set member public data
        $this->member    = self::_getMember($this->member->id);

        // Check if member is dealer
        //print_r($this->session->userdata);
        //exit;
        if($this->member->type == 'Dealer') {
            // Redirect if user member is a dealer
            redirect(base_url('dealer'));
        }
    }

    public function index() {

        // Set user login        
        $data['logged_in'] = $this->logged_in;
                
        // Set site title page with module menu
        $data['page_title'] =  lang('Service');

        // Load js in controller        
        $data['js_files_ext'] = array(
            base_url('assets/public/js/libs/jquery-ui-1.11.0.min.js'),
            base_url('assets/public/js/libs/jquery.datepicker-min.js')
            );

        $select = $this->db->query('SELECT id, name FROM tbl_provinces ORDER BY name ASC');
        $provinces = array();
        if ($select->num_rows() > 0)
        {
            $provinces = $select->result();
            $select->free_result();
        }
        $data['provinces'] = $provinces;

        $vehicles = array();
        if ($this->logged_in)
        {
            $data['booking_automobile'] = true;
            $select = $this->db->query('SELECT id, name FROM tbl_provinces ORDER BY name ASC');
            $provinces = array();
            if ($select->num_rows() > 0)
            {
                $provinces = $select->result();
                $select->free_result();
            }
            $member_id = $this->member->id;
            $select = $this->db->query("SELECT `service_vehicle_id`, `vin_number`, `plate_number`, `vehicle_type`, `subject` FROM tbl_service_member_vehicle a JOIN tbl_service_vehicle b ON a.`service_vehicle_id` = b.`id` JOIN tbl_products c ON b.`vehicle_type` = c.`id` WHERE a.`service_member_id` = '{$member_id}'");
            if ($select->num_rows() > 0)
            {
                $vehicles = $select->result();
                $select->free_result();
            }
            $data['provinces'] = $provinces;
            $data['vehicles'] = $vehicles;

        } else {

            $vehicles = $this->db->query("SELECT `id`, `subject` FROM tbl_products WHERE `type` = 'automobile' AND `status` IN ('publish','unpublish');")->result();
            
        }

        $data['vehicles'] = $vehicles;

        // Surveys
        $this->db->order_by('ssq_id','desc');
        $surveys = $this->db->get('tbl_service_survey_question');
        $survey = ($surveys->num_rows() > 0) ? true : false;
        if ($survey)
        {
            $surveys = $surveys->result();
        }

        $data['survey'] = $survey;
        $data['surveys'] = $surveys;

        $currentDate = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
        $currentDate = new DateTime($currentDate->format( 'm/d/Y' ), new DateTimeZone('Asia/Jakarta'));
        $availableInterval = new DateInterval('P2D');
        $availableDate = $currentDate;
        $availableDate->add($availableInterval);
        $rangeInterval = new DateInterval('P6D');
        $rangeDate = new DateTime($availableDate->format( 'm/d/Y' ), new DateTimeZone('Asia/Jakarta'));
        $rangeDate->add($rangeInterval);
        $periodsEnd = new DateTime($availableDate->format( 'm/d/Y' ), new DateTimeZone('Asia/Jakarta'));
        $periods = new DatePeriod(
            $availableDate,
            new DateInterval('P1D'),
            $periodsEnd->add(new DateInterval('P80D'))
        );
        
        $months = '';
        foreach ($periods as $period)
        {   
            for($i=8;$i<18;$i++) {
                $time = (strlen($i)==1) ? '0'.$i.':00' : $i.':00';
                $months[$period->format('F')][$period->format('U')][] = $time;                
            }
        }

        $data['months'] = $months;

        $data['periods'] = $periods;

        // Load JS execution
        $data['js_inline'] = '$( "#birthdate" ).datepicker({dateFormat: "dd/mm/yy",changeMonth:true,changeYear:true,yearRange:"-65:+0",});';

        // Set main template
        $data['main']       = 'services/page/service/index';     

        // Set meta description for html tags in template
        $this->meta_description = $this->clean_tags();
        
        // Load admin template
        $this->load->view('template/public/template', $this->load->vars($data));

    }

    public function service()
    {

        $vehicles = array();
        if ($this->logged_in)
        {
            $data['booking_automobile'] = true;
            $select = $this->db->query('SELECT id, name FROM tbl_provinces ORDER BY name ASC');
            $provinces = array();
            if ($select->num_rows() > 0)
            {
                $provinces = $select->result();
                $select->free_result();
            }
            $member_id = $this->member->id;
            $select = $this->db->query("SELECT `service_vehicle_id`, `vin_number`, `plate_number`, `subject` FROM tbl_service_member_vehicle a JOIN tbl_service_vehicle b ON a.`service_vehicle_id` = b.`id` JOIN tbl_products c ON b.`vehicle_type` = c.`id` WHERE a.`service_member_id` = '{$member_id}'");
            if ($select->num_rows() > 0)
            {
                $vehicles = $select->result();
                $select->free_result();
            }
            $data['provinces'] = $provinces;
            $data['vehicles'] = $vehicles;

        } else {

            $vehicles = $this->db->query("SELECT `id`, `subject` FROM tbl_products WHERE `type` = 'automobile' AND `status` IN ('publish','unpublish');")->result();
            
        }

        $data['vehicles'] = $vehicles;
        
        $currentDate = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
        $currentDate = new DateTime($currentDate->format( 'm/d/Y' ), new DateTimeZone('Asia/Jakarta'));
        $availableInterval = new DateInterval('P2D');
        $availableDate = $currentDate;
        $availableDate->add($availableInterval);
        $rangeInterval = new DateInterval('P6D');
        $rangeDate = new DateTime($availableDate->format( 'm/d/Y' ), new DateTimeZone('Asia/Jakarta'));
        $rangeDate->add($rangeInterval);
        $periodsEnd = new DateTime($availableDate->format( 'm/d/Y' ), new DateTimeZone('Asia/Jakarta'));
        $periods = new DatePeriod(
            $availableDate,
            new DateInterval('P1D'),
            $periodsEnd->add(new DateInterval('P80D'))
        );
        
        $months = '';
        foreach ($periods as $period)
        {   
            for($i=8;$i<18;$i++) {
                $time = (strlen($i)==1) ? '0'.$i.':00' : $i.':00';
                $months[$period->format('F')][$period->format('U')][] = $time;                
            }
        }

        $data['months'] = $months;
        $data['periods'] = $periods;
    
        $select = $this->db->query('SELECT id, name FROM tbl_provinces ORDER BY name ASC');
        $provinces = array();
        if ($select->num_rows() > 0)
        {
            $provinces = $select->result();
            $select->free_result();
        }
        $data['provinces'] = $provinces;

        // Surveys
        $this->db->order_by('ssq_id','desc');
        $surveys = $this->db->get('tbl_service_survey_question');
        $survey = ($surveys->num_rows() > 0) ? true : false;
        if ($survey)
        {
            $surveys = $surveys->result();
        }

        $data['survey'] = $survey;
        $data['surveys'] = $surveys;
        
        // Set user login        
        $data['logged_in'] = $this->logged_in;
                
        // Set site title page with module menu
        $data['page_title'] =  lang('Service');

        // Load js in controller        
        $data['js_files_ext'] = array(
            base_url('assets/public/js/libs/jquery-ui-1.11.0.min.js'),
            base_url('assets/public/js/libs/jquery.datepicker-min.js')
            );

        // Load JS execution
        $data['js_inline'] = '$( "#birthdate" ).datepicker({dateFormat: "dd/mm/yy",changeMonth:true,changeYear:true,yearRange:"-65:+0",});';

        // Set main template
        $data['main']       = 'services/page/service/index';     

        // Set meta description for html tags in template
        $this->meta_description = $this->clean_tags();
        
        // Load admin template
        $this->load->view('template/public/template', $this->load->vars($data));
    }

    public function service_automobile_booking()
    {
        if ($this->input->is_ajax_request()) {
            $response   = array('success' => false, 'message' => null, 'data' => null);
            $post       = $this->input->post();

            // Get dealer limit for booking / hour
            $dealer     = $this->DealerNetworks->get($post['dealer_id']);
            $member     = $this->Members->get($dealer->dealer_member_id);
            $attribute  = json_decode($member->attribute);

            // Set setting of the dealer
            $weekend    = $attribute->setting_one->value;
            $close      = $attribute->setting_two->value;
            $limit      = $attribute->setting_three->value;

            // Set unique order ID
            $post['order_id'] = strtoupper(random_string('alnum',4) .'-'. random_string('numeric',4));

            // Check if dealer is close or not
            if (!$close) {

                $select = $this->db->query("SELECT id FROM tbl_service_booking WHERE dealer_id = '{$post['dealer_id']}' AND `time` = '{$post['time']}' AND `date` = '{$post['date']}' LIMIT 0,{$limit}");

                // Set checking for bookings and dealer settings
                if ($select->num_rows() < $limit)
                {
                    unset($post['province']);
                    $post['service_member_id'] = $this->session->userdata('member_logged_in_id');
                    $post['created'] = time();

                    // Insert POST Data
                    $insert = $this->db->insert('tbl_service_booking', $post);
                    $insert_id = $this->db->insert_id();

                    $time = (strlen($post['time']) == 1) ? '0'.$post['time'].':00' : $post['time'] . ':00';

                    // Set dealer data                
                    $_dealer        = $this->DealerNetworks->get($post['dealer_id']);
                    $dealer->emails = explode('\n\r', $_dealer->email); 

                    // Set user booking data
                    $booking = $this->Bookings->with('dealer')->get($insert_id);

                    // Set vehicle model type
                    $vehicle_type = $this->ProductModels->get($booking->vehicle_type);                    

                    $package_arr = [
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
                                '11'=>'Paket D (Kelipatan 40000 KM)'
                                ];

                    $package = (($package_arr[$post['service_type']]) ? $package_arr[$post['service_type']] : $post['custom']);

                    if ($booking->service_member_id != 0) {
                        $vehicle = $this->Bookings->_getBookingVehicle($booking->service_vehicle_id);
                    } else {
                        $vehicle = $this->Products->get($booking->service_vehicle_id);
                    }

                    if ($insert && $this->db->affected_rows() == 1)
                    {
                        $response['success'] = true;
                        $response['message'] = 'Anda telah terdaftar booking dengan ID Order : '.$booking->order_id.' di Bengkel Resmi Suzuki '.$booking->dealer->name.' yang beralamat di '.$booking->dealer->address.', '.$booking->dealer->city.'. Pada tanggal '.date('d-m-Y', $booking->date).' pukul '.$time.'.';
                        $response['data']['referer'] = base_url('services/automobile');

                        // ***** Emailing the admin and user ***** //
                        // Set email
                        $email = $post['email'];

                        // Set subject
                        $subject = $this->title_name->value.' - Booking Service Online';

                        // Data to send to public
                        $message['site_name']       = $this->title_name->value;
                        $message['site_link']       = base_url();
                        //$message['header']          = lang('account_registration');
                        $message['header']          = 'Booking Service Online';
                        //$message['messages']        = '<b>'.$post['name'].'</b>, pesanan anda telah dicatat. Menunggu persetujuan administrator.';
                        $message['messages']        = 'Yth <b>'.$booking->name.'</b>, Terima kasih atas Booking Service yang Anda lakukan pada Bengkel Resmi Suzuki kami <b>'.$booking->dealer->name.'</b> yang beralamat di '.$booking->dealer->address.', '.$booking->dealer->city.'. Untuk itu, kami akan merespon permintaan Booking Service yang Anda kirimkan kepada kami.<hr>ID Order : <b>'.$booking->order_id.'</b><br>Name : '.$booking->name.'<br>Telepon : '.$booking->phone.'<br>Email : '.$booking->email.'<br>Nomor VIN : '.$booking->vin_number.'<br>STNK : '.$booking->license_number.'<br>Nama di STNK : '.$booking->license_name.'<br>Tanggal : '.date('d-m-Y', $booking->date).'<br>Jam : '.$time.'<br>Kendaraan : '.$vehicle->subject.'<br>Tipe Mesin : '.$vehicle_type->subject.'<br>Paket Servis : '.$package.'<hr/><br>Dealer : <b>'.$booking->dealer->name.'</b><br/>Alamat : '.$booking->dealer->address.', '.$booking->dealer->city;
                        $message['site_copyright']  = $this->copyright->value;

                        // Set email template
                        $email_template = $this->load->view('admin/emails/site_contact',$this->load->vars($message),TRUE);

                        // Set email to clear first
                        $this->email->clear();

                        // Remove unwanted string and Set email from
                        //$from = str_replace('http://www.', '','no-reply@'.$_SERVER['HTTP_HOST']);
                        $from = ADMIN_REPLY;
                        $this->email->from($from, $this->title_name->value);
                        $this->email->to($email);
                        $this->email->reply_to($from, $this->title_name->value);
                        $this->email->subject($subject);
                        $this->email->message($email_template);

                        // Check if sent to public
                        if($this->email->send()) { 

                            // Data to send to email notification to admin
                            $message['site_name']       = $this->title_name->value;
                            $message['site_link']       = base_url();            
                            //$message['header']          = lang('account_registration');
                            $message['header']          = 'Booking Service Online';
                            $message['messages']        = '<b>'. $this->title_name->value .'</b>, '.$booking->name.' telah melakukan Booking Service online di <b>'.$booking->dealer->name.'</b>. <hr>ID Order : <b>'.$booking->order_id.'</b><br>Name : '.$booking->name.'<br>Telepon : '.$booking->phone.'<br>Email : '.$booking->email.'<br>Nomor VIN : '.$booking->vin_number.'<br>STNK : '.$booking->license_number.'<br>Nama di STNK : '.$booking->license_name.'<br>Tanggal : '.date('d-m-Y', $booking->date).'<br>Jam : '.$time.'<br>Kendaraan : '.$vehicle->subject.'<br>Tipe Mesin : '.$vehicle_type->subject.'<br>Paket Servis : '.$package.'<hr/><br>Dealer : '.$booking->dealer->name.'<br/>Alamat : '.$booking->dealer->address.', '.$booking->dealer->city;
                            $message['site_copyright']  = $this->copyright->value;

                            // Set email template
                            $email_template = $this->load->view('admin/emails/site_contact',$this->load->vars($message),TRUE);                                    

                            // Set email to sent
                            $to      = $this->email_info->value;
                            
                            // Set subject
                            $subject = $this->title_name->value.' - Booking Service Online';

                            foreach ($this->emails_booking as $key => $value) {
                                $this->email->clear();
                                $this->email->from($from, $this->title_name->value);
                                $this->email->to($value->email);
                                $this->email->reply_to($from, $this->title_name->value);
                                $this->email->subject($subject);
                                $this->email->message($email_template);
                                $this->email->send();
                                usleep(1000);
                            }

                            if(is_array($dealer->emails)) {

                                // Data to send to email notification to admin
                                $message['site_name']       = $this->title_name->value;
                                $message['site_link']       = base_url();            
                                //$message['header']          = lang('account_registration');
                                $message['header']          = 'Booking Service Online';
                                $message['messages']        = '<b>'.$booking->dealer->name.'</b>, '.$booking->name.' telah melakukan Booking Service online. <hr>ID Order : <b><a href="'.base_url('dealer?date='.date('d-m-Y', $booking->date)).'" target="_blank">'.$booking->order_id.'</a></b><br>Name : '.$booking->name.'<br>Telepon : '.$booking->phone.'<br>Email : '.$booking->email.'<br>Nomor VIN : '.$booking->vin_number.'<br>STNK : '.$booking->license_number.'<br>Nama di STNK : '.$booking->license_name.'<br>Tanggal : '.date('d-m-Y', $booking->date).'<br>Jam : '.$time.'<br>Kendaraan : '.$vehicle->subject.'<br>Tipe Mesin : '.$vehicle_type->subject.'<br>Paket Servis : '.$package;                                
                                $message['site_copyright']  = $this->copyright->value;

                                // Set email template
                                $email_template = $this->load->view('admin/emails/site_contact',$this->load->vars($message),TRUE);    
                                
                                foreach ($dealer->emails as $keys => $emails) {
                                    $this->email->clear();
                                    $this->email->from($from, $this->title_name->value);
                                    $this->email->to($emails);
                                    $this->email->reply_to($from, $this->title_name->value);
                                    $this->email->subject($subject);
                                    $this->email->message($email_template);
                                    $this->email->send();
                                    usleep(1000);
                                }
                            }

                            // Set message
                            //$this->session->set_flashdata('message', 'Yth <b>'.$booking->name.'</b>, Terima kasih atas Booking Service yang Anda lakukan pada Bengkel Resmi Suzuki kami <b>'.$booking->dealer->name.'</b>. Untuk itu, kami akan merespon permintaan Booking Service yang Anda kirimkan kepada kami.<hr>ID Order : '.$booking->order_id.'<br>Tanggal : '.date('d-m-Y', $booking->date).'<br>Jam : '.$time.'<br/>Alamat : '.$booking->dealer->address.', '.$booking->dealer->city);                            
                            $this->session->set_flashdata('message', 'Terima kasih atas Booking Service yang Anda lakukan pada Bengkel Resmi Suzuki kami.
Untuk itu, kami akan merespon permintaan Booking Service yang Anda kirimkan kepada kami.');

                        }

                    }
                    else
                    {
                        $response['message'] = 'Gagal memasukkan pesanan. Silakan coba beberapa saat lagi.';
                    }
                }
                else
                {
                    $response['message'] = 'Tanggal dan waktu ini telah memenuhi kuota, coba tanggal dan waktu yang lain.';
                }
            }    
            else {

                $response['message'] = 'Mohon maaf, di tempat kami '.$dealer->name.' belum bisa melayani booking service.';

            }   

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }

    }

    public function service_automobile()
    {   
        
        $select = $this->db->query('SELECT id, name FROM tbl_provinces ORDER BY name ASC');
        $provinces = array();
        if ($select->num_rows() > 0)
        {
            $provinces = $select->result();
            $select->free_result();
        }
        $data['provinces'] = $provinces;
        
        $vehicles = array();
        if ($this->logged_in)
        {
            $data['booking_automobile'] = true;
            $select = $this->db->query('SELECT id, name FROM tbl_provinces ORDER BY name ASC');
            $provinces = array();
            if ($select->num_rows() > 0)
            {
                $provinces = $select->result();
                $select->free_result();
            }
            $member_id = $this->member->id;
            $select = $this->db->query("SELECT `service_vehicle_id`, `vin_number`, `plate_number`, `subject` FROM tbl_service_member_vehicle a JOIN tbl_service_vehicle b ON a.`service_vehicle_id` = b.`id` JOIN tbl_products c ON b.`vehicle_type` = c.`id` WHERE a.`service_member_id` = '{$member_id}'");
            if ($select->num_rows() > 0)
            {
                $vehicles = $select->result();
                $select->free_result();
            }
            $data['provinces'] = $provinces;
            $data['vehicles'] = $vehicles;

        } else {

            $vehicles = $this->db->query("SELECT `id`, `subject` FROM tbl_products WHERE `type` = 'automobile' AND `status` IN ('publish','unpublish');")->result();
            
        }

        $data['vehicles'] = $vehicles;

        $currentDate = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
        $currentDate = new DateTime($currentDate->format( 'm/d/Y' ), new DateTimeZone('Asia/Jakarta'));
        $availableInterval = new DateInterval('P2D');
        $availableDate = $currentDate;
        $availableDate->add($availableInterval);
        $rangeInterval = new DateInterval('P6D');
        $rangeDate = new DateTime($availableDate->format( 'm/d/Y' ), new DateTimeZone('Asia/Jakarta'));
        $rangeDate->add($rangeInterval);
        $periodsEnd = new DateTime($availableDate->format( 'm/d/Y' ), new DateTimeZone('Asia/Jakarta'));
        $periods = new DatePeriod(
            $availableDate,
            new DateInterval('P1D'),
            $periodsEnd->add(new DateInterval('P80D'))
        );
        
        $months = '';
        foreach ($periods as $period)
        {   
            for($i=8;$i<18;$i++) {
                $time = (strlen($i)==1) ? '0'.$i.':00' : $i.':00';
                $months[$period->format('F')][$period->format('U')][] = $time;                
            }
        }

        $data['months'] = $months;
        $data['periods'] = $periods;

        $data['product_statics'] = $this->service->get_static_product('automobile');

        // Set site title page with module menu
        $data['page_title'] =  lang('Service');

        // Set is login user
        $data['logged_in']  = $this->logged_in;

        // Surveys
        $this->db->order_by('ssq_id','desc');
        $surveys = $this->db->get('tbl_service_survey_question');
        $survey = ($surveys->num_rows() > 0) ? true : false;
        if ($survey)
        {
            $surveys = $surveys->result();
        }

        $data['survey'] = $survey;
        $data['surveys'] = $surveys;

        // Load js in controller        
        $data['js_files_ext'] = array(
            base_url('assets/public/js/libs/jquery-ui-1.11.0.min.js'),
            base_url('assets/public/js/libs/jquery.datepicker-min.js')
            );

        // Load JS execution
        $data['js_inline'] = '$( "#birthdate" ).datepicker({dateFormat: "dd/mm/yy",changeMonth:true,changeYear:true,yearRange:"-65:+0",});';

        // Set main template
        $data['main']       = 'services/page/service/automobile';        

        // Set meta description for html tags in template
        $this->meta_description = $this->clean_tags();
        
        // Load admin template
        $this->load->view('template/public/template', $this->load->vars($data));
    }

    public function survey()
    {

    }

    public function survey_detail($detail)
    {

    }

    public function survey_save()
    {
        if ($this->input->is_ajax_request() && $this->input->post()) {
            $response = array('success' => false, 'message' => null, 'data' => null);
            $post = $this->input->post();
            $post['added'] = time();

            $this->form_validation->set_rules('ssr_name', 'Nama', 'trim|required|xss_clean|max_length[36]');
            $this->form_validation->set_rules('ssr_email', 'Email', 'trim|valid_email|required|min_length[5]|max_length[36]|xss_clean');
            $this->form_validation->set_rules('captcha', 'Captcha', 'trim|xss_clean|max_length[6]|callback_match_captcha');
            $this->form_validation->set_error_delimiters('', '');
            // Validation form checks
            if ($this->form_validation->run() == FALSE)
            {
                // Set error fields
                $error = array();
                foreach(array_keys($post) as $error) {
                    $errors[$error] = form_error($error);
                }

                // Set previous post merge to default
                $response['success'] = '';
                $response['message'] = ['errors'=>array_filter($errors)];

            }
            else
            {
                try
                {
                    $respondent = $post;
                    unset($respondent['question']);
                    unset($respondent['captcha']);
                    $answers = array_diff($post, $respondent);
                    $insert_respondent = $this->db->insert('tbl_service_survey_respondent', $respondent);
                    $id_respondent = $this->db->insert_id();
                    foreach ($answers as $answer)
                    {
                        foreach ($answer as $question => $value)
                        {
                            $this->db->insert('tbl_service_survey_answer', array('ssr_id' => $id_respondent, 'ssq_id' => $question, 'ssa_value' => $value));
                        }
                    }
                    $response['success'] = true;
                    $response['message'] = 'Terimakasih telah mengisi form survey ini. Data survey anda telah dikirim.';

                    // Emailing the user and admin
                    // Set email
                    $email = $post['ssr_email'];

                    // Set subject
                    //$subject = $this->title_name->value.' - '.lang('account_registration');                
                    $subject = $this->title_name->value.' - '.lang('Survey');

                    // Data to send to public
                    $message['site_name']       = $this->title_name->value;
                    $message['site_link']       = base_url();
                    //$message['header']          = lang('account_registration');
                    $message['header']          = lang('Survey') . ' Online';
                    //$message['messages']        = '<b>'.$post['name'].'</b>, pesanan anda telah dicatat. Menunggu persetujuan administrator.';
                    $message['messages']        = '<b>'.$post['ssr_name'].'</b>,Terima kasih atas Survey Anda.';
                    $message['site_copyright']  = $this->copyright->value;

                    // Set email template
                    $email_template = $this->load->view('admin/emails/site_contact',$this->load->vars($message),TRUE);

                    // Set email to clear first
                    $this->email->clear();

                    // Remove unwanted string and Set email from
                    //$from = str_replace('http://www.', '','no-reply@'.$_SERVER['HTTP_HOST']);
                    $from = ADMIN_REPLY;
                    $this->email->from($from, $this->title_name->value);
                    $this->email->to($email);
                    $this->email->reply_to($from, $this->title_name->value);
                    $this->email->subject($subject);
                    $this->email->message($email_template);

                    // Check if sent to public
                    if ($this->email->send()) {

                        // Set respondent data
                        $respondent_data .= '<span>Nama : '.$post['ssr_name'].'</span><br>';
                        $respondent_data .= '<span>Email : '.$post['ssr_email'].'</span><br>';                    
                        $respondent_data .= '<span>Telepon : '.$post['ssr_phone_number'].'</span><br>';
                        $respondent_data .= '<span>Alamat : '.$post['ssr_address'].'</span><br>';
                        $respondent_data .= '<span>VIN Number : '.$post['ssr_vin_number'].'</span><br>';

                        // Data to send to email notification to admin
                        $message['site_name']       = $this->title_name->value;
                        $message['site_link']       = base_url();            
                        $message['header']          = lang('Survey Respondent');
                        $message['messages']        = sprintf($this->lang->line('email_survey_respondent_admin'), $this->title_name->value, $post['ssr_name'], $respondent_data, self::_getSurveyRespondent($id_respondent));
                        $message['site_copyright']  = $this->copyright->value;

                        // Set email template
                        $email_template = $this->load->view('admin/emails/site_contact',$this->load->vars($message),TRUE);                                    

                        // Set email to sent
                        $to      = $this->email_info->value;
                        
                        // Set subject
                        $subject = $this->title_name->value.' - '.lang('Survey Respondent');

                        // Send emails
                        /************************* uncomment this after testing */
                        foreach ($this->emails_survey as $key => $value) {
                            $this->email->clear();
                            $this->email->from($from, $this->title_name->value);
                            $this->email->to($value->email);
                            $this->email->reply_to($from, $this->title_name->value);
                            $this->email->subject($subject);
                            $this->email->message($email_template);
                            $this->email->send();
                            usleep(1000);
                        }
                        /**************************/

                    }

                } catch (Exception $e)
                {
                    $response['message'] = $e->getMessage();
                }
            }

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }

    }

    public function service_automobile_tips($detail = null)
    {
        
        $view = 'service/page/service/automobile_tips';
        if (!($detail == null))
        {
            $tip = $this->db->select('sts_subject, sts_url, sts_text, sts_publish_date')->where(array('sts_status' => 'publish', 'sts_type' => 'automobile', 'sts_url' => $detail))->order_by('sts_publish_date', 'desc')->limit(1)->get('tbl_service_tips');
            if ($tip->num_rows() == 1)
            {
                $data['detail'] = $tip->row();
                $tips = $this->db->select('sts_subject, sts_url, sts_text, sts_publish_date')->where(array('sts_status' => 'publish', 'sts_type' => 'automobile'))->order_by('sts_publish_date', 'desc')->get('tbl_service_tips');
                $data['tips'] = $tips->result();
                $view = 'services/page/service/automobile_tips_detail';
            }
            else
            {
                redirect('services/automobile/tips ');
            }
        }
        else
        {
            $this->load->helper('text');
            $tips = $this->db->select('sts_subject, sts_url, sts_text, sts_publish_date')->where(array('sts_status' => 'publish', 'sts_type' => 'automobile'))->order_by('sts_publish_date', 'desc')->get('tbl_service_tips');
            $data['tips'] = $tips->result();
            $view = 'services/page/service/automobile_tips';
        }
        
        // Set site title page with module menu
        $data['page_title'] =  lang('Service');

        // Set is login user
        $data['logged_in']  = $this->logged_in;
        
        // Set main template
        $data['main']       = $view;        

        // Set meta description for html tags in template
        $this->meta_description = $this->clean_tags();
        
        // Load admin template
        $this->load->view('template/public/template', $this->load->vars($data));

    }

    public function service_automobile_article($type = 'article', $detail = null)
    {
        
        $view = 'service/page/service/automobile_article';
        $where_type = ($type == 'article') ? 'svc-artc' : ( ($type == 'event') ? 'svc-evt' : 'svc-blog' );
        $data['sidebar_title'] = ($type == 'article') ? 'Article' : ( ($type == 'event') ? 'Event' : 'Blog' );
        $data['type'] = $type;
        if (!($detail == null))
        {
            $tip = $this->db->select('subject, url, text, publish_date')->where(array('status' => 'publish', 'type' => $where_type, 'url' => $detail))->limit(1)->get('tbl_news');
            if ($tip->num_rows() == 1)
            {
                $data['detail'] = $tip->row();
                $tips = $this->db->select('subject, url, text, publish_date')->where(array('status' => 'publish', 'type' => $where_type))->order_by('publish_date', 'desc')->get('tbl_news');
                $data['tips'] = $tips->result();
                $view = 'services/page/service/automobile_article_detail';
            }
            else
            {
                redirect('services/automobile/'.$type);
            }
        }
        else
        {
            $this->load->helper('text');
            $tips = $this->db->select('subject, url, text, publish_date')->where(array('status' => 'publish', 'type' => $where_type))->order_by('publish_date', 'desc')->get('tbl_news');
            $data['tips'] = $tips->result();
            $view = 'services/page/service/automobile_article';
        }

        // Set site title page with module menu
        $data['page_title'] =  lang('Service');

        // Set is login user
        $data['logged_in']  = $this->logged_in;
        
        // Set main template
        $data['main']       = $view;        

        // Set meta description for html tags in template
        $this->meta_description = $this->clean_tags();
        
        // Load admin template
        $this->load->view('template/public/template', $this->load->vars($data));
    }

    public function service_motorcycle()
    {
        // Product static
        $data['product_statics'] = $this->service->get_static_product('motorcycle');

        // Set site title page with module menu
        $data['page_title'] =  lang('Service');

        // Set is login user
        $data['logged_in']  = $this->logged_in;

        // Set main template
        $data['main']       = 'services/page/service/motorcycle';

        // Set meta description for html tags in template
        $this->meta_description = $this->clean_tags();
        
        // Load admin template
        $this->load->view('template/public/template', $this->load->vars($data));

    }

    public function service_marine()
    {
        // Product static
        $data['product_statics'] = $this->service->get_static_product('marine');

        // Set site title page with module menu
        $data['page_title'] =  lang('Service');

        // Set is login user
        $data['logged_in']  = $this->logged_in;

        // Set main template
        $data['main']       = 'services/page/service/marine';

        // Set meta description for html tags in template
        $this->meta_description = $this->clean_tags();
        
        // Load admin template
        $this->load->view('template/public/template', $this->load->vars($data));

    }

    public function service_layanan24jamsera()
    {
        // Product static
        $data['sera'] = $this->service->get_static_content_by_type('24jamsera');

        // Set site title page with module menu
        $data['page_title'] =  lang('Service');

        // Set is login user
        $data['logged_in']  = $this->logged_in;

        // Set main template
        $data['main']       = 'services/page/service/layanan-24-jam-sera';

        // Set meta description for html tags in template
        $this->meta_description = $this->clean_tags();
        
        // Load admin template
        $this->load->view('template/public/template', $this->load->vars($data));

    }

    public function service_halosuzuki()
    {
        // Product static
        $data['halo'] = $this->service->get_static_content_by_type('halo_suzuki');

        // Set site title page with module menu
        $data['page_title'] =  lang('Service');

        // Set is login user
        $data['logged_in']  = $this->logged_in;

        // Set main template
        $data['main']       = 'services/page/service/halo-suzuki';

        // Set meta description for html tags in template
        $this->meta_description = $this->clean_tags();
        
        // Load admin template
        $this->load->view('template/public/template', $this->load->vars($data));

    }

    public function service_sgo()
    {
        // Set site title page with module menu
        $data['page_title'] =  lang('Service');

        // Set is login user
        $data['logged_in']  = $this->logged_in;

        // Product static
        $data['product_statics'] = $this->service->get_static_product('sgo');        

        // Set main template
        $data['main']       = 'services/page/service/sgo';

        // Set meta description for html tags in template
        $this->meta_description = $this->clean_tags();
        
        // Load admin template
        $this->load->view('template/public/template', $this->load->vars($data));
    }

    public function service_sgp()
    {
     
        // Set site title page with module menu
        $data['page_title'] =  lang('Service');

        // Set is login user
        $data['logged_in']  = $this->logged_in;

        // Product static
        $data['product_statics'] = $this->service->get_static_product('sgp');        

        // Set main template
        $data['main']           = 'services/page/service/sgp';

        // Set meta description for html tags in template
        $this->meta_description = $this->clean_tags();
        
        // Load admin template
        $this->load->view('template/public/template', $this->load->vars($data));
    } 

    public function service_sgc()
    {
     
        // Set site title page with module menu
        $data['page_title'] =  lang('Service');

        // Set is login user
        $data['logged_in']  = $this->logged_in;

        // Product static
        $data['product_statics'] = $this->service->get_static_product('sgc');        

        // Set main template
        $data['main']           = 'services/page/service/sgc';

        // Set meta description for html tags in template
        $this->meta_description = $this->clean_tags();
        
        // Load admin template
        $this->load->view('template/public/template', $this->load->vars($data));
    } 

    public function auth_signin()
    {   

        // Check ajax and post
        if ($this->input->is_ajax_request()) {

            // Set default
            $response = array('success' => false, 'message' => null, 'data' => null);

            // Default data setup
            $fields = array(
                    'username_signin'  => '',
                    'password_signin'  => '');

            // Set default errors
            $errors = $fields;

            // POST checking
            if($_SERVER['REQUEST_METHOD'] === 'POST') {

                $fields = $this->input->post();

                $this->form_validation->set_rules('username_signin', 'Username', 'trim|required|min_length[5]|max_length[50]|xss_clean');
                $this->form_validation->set_rules('password_signin', 'Password','trim|required|min_length[5]|max_length[50]|xss_clean');

                $this->form_validation->set_error_delimiters('', '');
                // Validation form checks
                if ($this->form_validation->run() == FALSE)
                {
                    // Set error fields
                    $error = array();
                    foreach(array_keys($fields) as $error) {
                        $errors[$error] = form_error($error);
                    }

                    // Set previous post merge to default
                    $fields = array_merge($fields, $this->input->post());

                    unset($errors['csrf_token'],$errors['referer']);
                    $response['message'] = json_encode(implode(' ', $errors));
                }
                else
                {
        
                    // Set account
                    $password   = sha1($fields['password_signin']);
                    $user       = $fields['username_signin'];

                    $select = $this->db->query("SELECT id, type, confirmed, approved, status FROM tbl_members WHERE password = '{$password}' AND (username = '{$user}' OR email = '{$user}') LIMIT 0,1");

                    if ($select->num_rows() == 1)
                    {
                        $row = $select->row();
                        $select->free_result();
                        if ((int)$row->confirmed == 1)
                        {
                            if ((int)$row->approved == 1)
                            {
                                if ((int)$row->status == 1)
                                {
                                    $this->session->set_userdata('member_logged_in', true);
                                    $this->session->set_userdata('member_logged_in_id', (int)$row->id);
                                    $response['success'] = true;
                                    $response['message'] = 'Selamat datang kembali!';
                                    
                                    // Set sessions
                                    $user_session->id = $row->id;
                                    $user_session->fullname = $row->fullname;
                                    $user_session->email = $row->email;
                                    $ci_session = array(
                                        'member_session'      => $user_session,
                                    );
                                    //Set session data
                                    $this->session->set_userdata($ci_session);                                
                                    // Redirect                         
                                    $response['data']['referer'] = $post['referer'];
                                    
                                }
                                else
                                {
                                    $response['message'] = 'Member tidak aktif.';
                                }
                            }
                            else
                            {
                                $response['message'] = 'Member belum di-approve.';
                            }
                        }
                        else
                        {
                            $response['message'] = 'Member belum dikonfirmasi.';
                        }
                    }
                    else
                    {
                        $response['message'] = 'Member tidak ditemukan.';
                    }
                }

            }

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }

    }

    public function auth_forgot()
    {
        if ($this->input->is_ajax_request() && $this->input->post()) {
            $response = array('success' => false, 'message' => null, 'data' => null);
            $post = $this->input->post();
            $email = $post['email-forgot-password'];
            $select = $this->db->query("SELECT id, username, type, confirmed, approved, status FROM tbl_members WHERE email = '{$email}' AND username != '' LIMIT 0,1");
            if ($select->num_rows() == 1 && $email)
            {
                $row = $select->row();
                $select->free_result();

                //print_r($post);
                //print_r($row);
                $response['message'] = 'Member dengan email tersebut tidak ditemukan.';
                /*
                if ((int)$row->confirmed == 1)
                {
                    if ((int)$row->approved == 1)
                    {
                        if ((int)$row->status == 1)
                        {
                            // Set response
                            $response['success'] = true;
                            $response['message'] = 'Selamat datang kembali!';
                            
                            // Redirect                         
                            $response['data']['referer'] = $post['referer'];
                            
                        }
                        else
                        {
                            $response['message'] = 'Member tidak aktif.';
                        }
                    }
                    else
                    {
                        $response['message'] = 'Member belum di-approve.';
                    }
                }
                else
                {
                    $response['message'] = 'Member belum dikonfirmasi.';
                }
                */
            }
            else
            {
                $response['message'] = 'Member dengan email tersebut tidak ditemukan.';
            }

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }

    }

    public function auth_signout()
    {
        $this->session->unset_userdata('member_logged_in');
        $this->session->unset_userdata('member_logged_in_id');
        $this->session->unset_userdata('member_session');
        unset($this->member);
        redirect('services');
    }

    public function auth_confirm_validate()
    {
        if ($this->input->is_ajax_request())
        {
            $response = array('success' => false, 'message' => null, 'data' => null);
            $post = $this->input->post();
            $select = $this->db->query("SELECT id FROM tbl_members WHERE confirmation_hash = '{$post['confirmation_hash']}' AND confirmed = '0' LIMIT 0,1");
            if ($select->num_rows == 1)
            {
                $id = $select->row()->id;
                $select->free_result();
                $select = $this->db->query("SELECT id FROM tbl_members WHERE confirmation_hash = '{$post['confirmation_hash']}' AND confirmed = '0' AND id = '{$id}' AND confirmation_code = '{$post['confirmation_code']}' LIMIT 0,1");
                if ($select->num_rows == 1)
                {
                    $member_id = $id;
                    $select = $this->db->query("SELECT id FROM tbl_service_vehicle WHERE vin_number = '{$post['vin_number']}' LIMIT 0,1");
                    $vehicle_id = 0;
                    if ($select->num_rows() == 1)
                    {
                        $vehicle_id = $select->row()->id;
                        $select->free_result();
                    }
                    else
                    {
                        $data = $post;
                        unset($data['confirmation_code']);
                        unset($data['confirmation_hash']);
                        $insert = $this->db->insert('tbl_service_vehicle', $data);
                        {
                            if ($insert && $this->db->affected_rows() == 1)
                            {
                                $vehicle_id = $this->db->insert_id();
                            }
                        }
                    }
                    if ($vehicle_id > 0)
                    {
                        $select = $this->db->query("SELECT id FROM tbl_service_member_vehicle WHERE service_member_id = '{$member_id}' AND service_vehicle_id = '{$vehicle_id}' LIMIT 0,1");
                        $continue = true;
                        if ($select->num_rows() == 0)
                        {
                            $data = array('service_member_id' => $member_id, 'service_vehicle_id' => $vehicle_id, 'created' => time());
                            $insert = $this->db->insert('tbl_service_member_vehicle', $data);
                            if (!($insert && $this->db->affected_rows() == 1))
                            {
                                $continue = false;
                                $response['message'] = 'Gagal ketika mengkonfirmasi, silakan coba beberapa saat lagi.';
                            }
                        }
                        if ($continue)
                        {   // ['approved' => '1'] by pass administrator to auto approved ['status'=>1] and activate the member account status
                            $update = $this->db->where(array('id' => $member_id))->update('tbl_members', array('approved' => '1','confirmed' => '1'));
                            if ($update && $this->db->affected_rows() == 1)
                            {
                                $response['success'] = true;
                                $response['message'] = 'Member Confirmed!';
                                $response['data']['referer'] = base_url('services');
                            }
                            else
                            {
                                $response['message'] = 'Gagal ketika mengkonfirmasi, silakan coba beberapa saat lagi.';
                            }
                        }
                    }
                    else
                    {
                        $response['message'] = 'Gagal ketika mengkonfirmasi, silakan coba beberapa saat lagi.';
                    }
                }
                else
                {
                    $response['message'] = 'Kode konfirmasi salah.';
                }
            }
            else
            {
                $response['message'] = 'Konfirmasi tidak ditemukan atau sudah kadaluarsa.';
            }
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }

    }

    public function auth_confirm($confirmation_hash)
    {
        $select = $this->db->query("SELECT id FROM tbl_members WHERE confirmation_hash = '{$confirmation_hash}' AND confirmed = '0' LIMIT 0,1");
        $exists = ($select->num_rows() == 1) ? true : false;
        $select->free_result();
        $products = array();
        if ($exists)
        {
            $select = $this->db->query("SELECT id, subject FROM tbl_products WHERE type = 'automobile'");
            if ($select->num_rows() > 0)
            {
                $products = $select->result();
                $select->free_result();
            }
        }
        
        // Set site title page with module menu
        $data['page_title'] =  lang('Service');

        // Set is login user
        $data['logged_in']              = $this->logged_in;
        $data['confirmation_hash']      = $confirmation_hash;
        $data['confirm_hash_exists']    = $exists;
        $data['products']               = $products;

        // Set main template
        $data['main']       = 'services/page/auth/confirm';

        // Set meta description for html tags in template
        $this->meta_description = $this->clean_tags();
        
        // Load admin template
        $this->load->view('template/public/template', $this->load->vars($data));
    }

    public function auth_signup()
    {
        if ($this->input->is_ajax_request())
        {
            $post = $this->input->post();
            unset($post['csrf_token']);
            $select = $this->db->query("SELECT * FROM tbl_members WHERE email = '{$post['email']}' AND type != 'Subscriber'; ");
            $response = array('success' => false, 'message' => null, 'data' => null);
            if ($select->num_rows() == 0)
            {
                $select = $this->db->query("SELECT * FROM tbl_members WHERE username = '{$post['username']}' AND type != 'Subscriber';");
                if ($select->num_rows() == 0)
                {
                    $continue = true;
                    if (strlen(trim($post['phonenumber'])) > 0)
                    {
                        $select = $this->db->query("SELECT * FROM tbl_members WHERE phone_number = '{$post['phonenumber']}' AND type != 'Subscriber';");
                        if ($select->num_rows() > 0)
                        {
                            $response['message'] = 'Nomor telepon sudah terdaftar';
                            $continue = false;
                        }
                    }
                    if ($continue)
                    {
                        unset($post['repassword']);
                        $post['phone_number'] = $post['phonenumber'];
                        $post['type']         = 'Service';
                        unset($post['phonenumber']);
                        $birthdate = DateTime::createFromFormat('d/m/Y', $post['birthdate']);
                        $post['birthdate'] = $birthdate->format('Y-m-d');
                        $post['confirmation_hash'] = $this->randomtext->random(32, RandomText::RANDOM_ALPHA);
                        $post['confirmation_code'] = $this->randomtext->random(5, RandomText::RANDOM_ALPHA_NUMERIC);
                        $post['password'] = sha1($post['password']);
                        try{
                            $insert = $this->db->insert('tbl_members', $post);
                            if ($insert && $this->db->affected_rows() == 1)
                            {
                                $this->sendEmail($post['email'], $post['fullname'], $post['confirmation_hash'], $post['confirmation_code']);
                                $response['success'] = true;
                                $response['data']['referer'] = base_url("services/auth/confirm/{$post['confirmation_hash']}");
                            }
                        } catch (Exception $e)
                        {
                            $response['message'] = $e->getMessage();
                        }
                    }
                }
                else
                {
                    $response['message'] = 'Username sudah terdaftar';
                }
            }
            else
            {
                $response['message'] = 'E-Mail sudah terdaftar';
            }
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
        }
    }

    private function sendEmail($email, $fullname, $confirmation_hash, $confirmation_code)
    {
    
        // Set subject
        $subject = $this->title_name->value.' - '.lang('account_registration');

        // Data to send to public
        $message['site_name']       = $this->title_name->value;
        $message['site_link']       = base_url();
        $message['header']          = lang('account_registration');
        $message['messages']        = 'Kode konfirmasi aktivasi <b>'.$confirmation_code.'</b>.';
        $message['site_copyright']  = $this->copyright->value;

        // Set email template
        $email_template = $this->load->view('admin/emails/site_contact',$this->load->vars($message),TRUE);

        // Set email to clear first
        $this->email->clear();

        // Remove unwanted string and Set email from
        //$from = str_replace('http://www.', '','no-reply@'.$_SERVER['HTTP_HOST']);
        $from = ADMIN_REPLY;
        $this->email->from($from, $this->title_name->value);
        $this->email->to($email);
        $this->email->reply_to($from, $this->title_name->value);
        $this->email->subject($subject);
        $this->email->message($email_template);

        // Check if sent to public
        if($this->email->send()) { 

            // Data to send to email notification to admin
            $message['site_name']       = $this->title_name->value;
            $message['site_link']       = base_url();            
            $message['header']          = lang('account_registration');
            $message['messages']        = sprintf($this->lang->line('email_account_activation_admin'), $this->title_name->value, $fullname);
            $message['site_copyright']  = $this->copyright->value;

            // Set email template
            $email_template = $this->load->view('admin/emails/site_contact',$this->load->vars($message),TRUE);                                    

            // Set email to sent
            $to      = $this->email_info->value;
            
            // Set subject
            $subject = $this->title_name->value.' - '.lang('account_registration');

            foreach ($this->emails_register as $key => $value) {
                $this->email->clear();
                $this->email->from($from, $this->title_name->value);
                $this->email->to($value->email);
                $this->email->reply_to($from, $this->title_name->value);
                $this->email->subject($subject);
                $this->email->message($email_template);
                $this->email->send();
                usleep(1000);
            }
            
            // Set email to clear first
            //$this->email->clear();

            // Set email content            
            //$this->email->from($from);
            //$this->email->to($to);
            //$this->email->reply_to($from, $this->title_name->value);
            //$this->email->subject($subject);
            //$this->email->message($email_template);

            // Send email to administrator
            //$this->email->send();

            //print_r($this->email->print_debugger());
            //exit;

        }

    }

    public function rest_booking_check($dealer_id)
    {
        $currentDate = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
        $currentDate = new DateTime($currentDate->format( 'm/d/Y' ), new DateTimeZone('Asia/Jakarta'));
        $availableInterval = new DateInterval('P2D');
        $availableDate = $currentDate;
        $availableDate->add($availableInterval);
        $rangeInterval = new DateInterval('P6D');
        $rangeDate = new DateTime($availableDate->format( 'm/d/Y' ), new DateTimeZone('Asia/Jakarta'));
        $rangeDate->add($rangeInterval);
        $periodsEnd = new DateTime($availableDate->format( 'm/d/Y' ), new DateTimeZone('Asia/Jakarta'));
        $periods = new DatePeriod(
            $availableDate,
            new DateInterval('P1D'),
            $periodsEnd->add(new DateInterval('P80D'))
        );
        $periodDates = array();
        $timePeriods = array();
        for($i=8;$i<18;$i++)
        {
            array_push($timePeriods, $i);
        }
        foreach($periods as $period)
        {
            $periodDates[$period->format('U')] = $timePeriods;
        }
        $result = $this->Bookings->getAvailableBooking($dealer_id, $availableDate->format('U'), $rangeDate->format('U'), $periodDates);
        $response = array('success' => true, 'message' => null, 'data' => $periodDates);
        if (!(is_null($result)))
        {
            $response['data'] = $result;
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function rest_booking_check_html($dealer_id)
    {
        $currentDate = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
        $currentDate = new DateTime($currentDate->format( 'm/d/Y' ), new DateTimeZone('Asia/Jakarta'));
        $availableInterval = new DateInterval('P2D');
        $availableDate = $currentDate;
        $availableDate->add($availableInterval);
        $rangeInterval = new DateInterval('P6D');
        $rangeDate = new DateTime($availableDate->format( 'm/d/Y' ), new DateTimeZone('Asia/Jakarta'));
        $rangeDate->add($rangeInterval);
        $periodsEnd = new DateTime($availableDate->format( 'm/d/Y' ), new DateTimeZone('Asia/Jakarta'));
        $periods = new DatePeriod(
            $availableDate,
            new DateInterval('P1D'),
            $periodsEnd->add(new DateInterval('P80D'))
        );
        
        $months = '';
        foreach ($periods as $period)
        {   
            for($i=8;$i<18;$i++) {
                $months[$period->format('F')][$period->format('U')][] = $i;
                $periodDates[$period->format('U')][] = $i;
            }
        }
        
        $return = $this->Bookings->getAvailableBooking($dealer_id, $availableDate->format('U'), $rangeDate->format('U'), $periodDates);            
        $i=1;
        foreach ($months as $month => $keys) {                    
        $html .='<div class="tab-contents '.($i==1 ? 'active' : '').'" id="'.$month.'">';
        $html .='<table class="book-table columns twelve">';
            $html .='<tr width="1%"><th>Date</th><th colspan="11" class="text-left">'.$month.'</th></tr>';
            foreach($keys as $value => $values) {
                list($d, $h) = explode('-', date('d-D-y, M',$value));
                $html .='<tr'.(($h == 'Sat' || $h == 'Sun') ? ' class="holiday"' : '').'><td class="content-td">'. date('d-D-y, M',$value) .'</td>';                        
                foreach ($values as $val => $cell) {                                
                    $form = (strlen($cell)==1) ? '0'.$cell.':00' : $cell.':00';
                    $html .='<td'.($form == '12:00' ? ' class="noon"' :'').'>';   
                    $html .= '<a href="javascript:;" data-key="'.$value.'-'.$cell.'">'.$form.'</a>';
                    $html .= '</td>';
                }
                $html .='</tr>';
                $j++;
            }            
            $i++;
        $html .='</table>';
        $html .='</div>';
        }

        $result = $html;

        if (!(is_null($result)))
        {
            $response = $result;
        }
        $this->output
            ->set_content_type('text/html')
            ->set_output($response);
    }

    public function rest_dealers($province_id = null)
    {
        $result = array('success' => false, 'message' => null);
        if ($province_id == null)
        {
            $result['message'] = 'Province ID is required';
        }
        else
        {
            $dealers = $this->dealers->get_dealer_by_province($province_id, 'id,name,address');
            if (count($dealers) > 0)
            {
                $result['success'] = true;
                $result['data'] = $dealers;
            }
            else
            {
                $result['message'] = 'No Dealers Found';
            }
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));

    }

    public function product_static($type, $sps_url = null){
    
        $product = $this->service->get_static_product_by_url($sps_url);
        $title_breacrumb = "";
        $static_pages = "";

        if ($sps_url == 'periodic-service' || $sps_url == 'periodic-servicing' || $sps_url == 'periodic-maintenance') {

            $this->load->model('product/Products');
            $this->load->model('product/ProductModels');

            $static_pages = $this->Products->with('service')->findAll(['type'=>$type,'is_service'=>1],'id,subject,type,media_plain,thumbnail',['subject'=>'ASC']);
            //print_r($this->Products->with('model')->findAllBy('type',$type,'id,subject,type,thumbnail',['subject'=>'ASC']));
            //print_r($this->Products->with('model')->with('service')->get(1));
            //exit;
        }


        if($type=='automobile'){
            $title_breacrumb = "Servis Mobil";
        }else if($type=='motorcycle'){
            $title_breacrumb = "Servis Motor";
        }else if($type=='marine'){
            $title_breacrumb = "Servis Marine";
        }

        $data['static_pages'] = $static_pages;

        $data['product'] = $product;
        $data['breadcrumb'][] =  (object) array('url'=>$type,'title'=>$title_breacrumb);
        $data['breadcrumb'][] =  (object) array('url'=>$type.'/'.$product->sps_url,'title'=>$product->sps_subject);

        // Set site title page with module menu
        $data['page_title'] = lang('Service');

        // Set is login user
        $data['logged_in']  = $this->logged_in;

        // Set main template
        $data['main']       = 'services/page/service/product_static';

        // Set meta description for html tags in template
        $this->meta_description = $this->clean_tags();
        
        // Load admin template
        $this->load->view('template/public/template', $this->load->vars($data));
    }

    public function profile() {
        
        // Set site title page with module menu
        $data['page_title'] =  lang('Service');

        // Set is login user
        $data['logged_in']  = $this->logged_in;

        // Set products
        $data['products']  = $this->Products->findAll(['type'=>'automobile','status'=>'publish'],'id,subject,text',['subject'=>'asc']);

        // Set dealer data
        $data['notifications'] = $this->Notifications->findAll(['user_id'=>$this->member->id,'status'=>1]);        

        // Set main template
        $data['main']       = 'services/page/profile';

        // Load js in controller        
        $data['js_files_ext'] = array(
            base_url('assets/public/js/libs/jquery-ui-1.11.0.min.js'),
            base_url('assets/public/js/libs/jquery.datepicker-min.js'),
            base_url('assets/public/js/libs/jquery-cloneya.min.js')
        );

        // Load JS execution
        $data['js_inline'] = '
            $( "#birthdate" ).datepicker({dateFormat: "dd/mm/yy",changeMonth:true,changeYear:true,yearRange:"-65:+0",});
            $("#form-profile").submit(function() {
                var action = $(this).attr("action");
                var $form = $.ajax({
                        url: action,
                        timeout:30000,
                        datatype:"json",
                        type:"POST",
                        data:$(this).serialize()
                    });
                    $form.always(function(){

                    });
                    $form.done(function(response){
                        alert("Updated!");
                        window.location.replace("profile");
                        if(response.success)
                        {
                            // alert(response.message);
                            closePop();
                        }
                        else
                        {
                            alert(response.message);
                        }
                    });
                    $form.fail(function(jqXHR,textStatus){
                        if(textStatus=="timeout"){
                        } else {
                        }
                    });
                return false;
            });
            $("#form-vehicle").submit(function() {
                var action = $(this).attr("action");
                var $form = $.ajax({
                        url: action,
                        timeout:30000,
                        datatype:"json",
                        type:"POST",
                        data:$(this).serialize()
                    });
                    $form.always(function(){

                    });
                    $form.done(function(response){
                        alert("Updated!");
                        window.location.replace("profile");
                        if(response.success)
                        {
                            // alert(response.message);
                            //closePop();
                        }
                        else
                        {
                            //alert(response.message);
                        }
                    });
                    $form.fail(function(jqXHR,textStatus){
                        if(textStatus=="timeout"){
                        } else {
                        }
                    });
                return false;
            });
            //$(".prodinfo").cloneya();
            $("#clone-form-update").cloneya({
                minimum         : 1,
                maximum         : 2,
                cloneThis       : ".toclone",
                valueClone      : false,
                dataClone       : false,
                deepClone       : false,
                cloneButton     : ".clone",
                //deleteButton    : ".delete",
                clonePosition   : "after",
                serializeID     : true,
                ignore          : "label.error",
                preserveChildCount  : false
            }).on("after_append.cloneya", function (event, toclone, newclone) {
                newclone.find("hr").last().after(\'<button type="submit" class="purple small fill-button button-add" name="submit" value="simpan">Simpan <i class="icon-check"></i></button>\');
                newclone.find("a.clone").remove();
            });
        ';

        // Set meta description for html tags in template
        $this->meta_description = $this->clean_tags();
        
        // Load admin template
        $this->load->view('template/public/template', $this->load->vars($data));
    }

    public function profile_update() {
        
        if ($this->input->is_ajax_request()) {

            // Set default
            $result = array('success' => false, 'message' => null);
            // Filter post
            $post = $this->input->post();
            
            // Check if this input exists or not
            if ($post["base64"] != '' && preg_match("/data:image\//i",$post["base64"])) {

                // Get the data sent and replace unwanted string
                $base64img = str_replace('data:image/png;base64,', '', $post["base64"]);
                $base64img = str_replace('data:image/jpeg;base64,', '', $base64img);

                $size = getimagesize($post["base64"]);
                
                $exts = '.jpg';
                if ($size['mime'] == 'image/png') {
                    $exts = '.png';
                } else if ($size['mime'] == 'image/gif') {
                    $exts = '.gif';
                } 

                // Decode base64 data sent
                $return = base64_decode($base64img);
                $filename = time().uniqid() . $exts;

                // Generate unique image name 
                $file = 'uploads/users/' . $filename;

                // Put file to upload directory
                if (file_put_contents($file, $return) && $post['base64']) { 

                    $post["file_name"] = $filename;

                }

            }

            $birthdate = DateTime::createFromFormat('d/m/Y', $post['birthdate']);
            $post['birthdate'] = $birthdate->format('Y-m-d');
            unset($post['csrf_token'],$post['base64']);

            $updated = $this->Members->update($post['id'], $post);

            if ($updated == null)
            {
                $result['message'] = 'Can not save at the moment';
            }
            else
            {
                if (count($updated) > 0)
                {
                    $result['success'] = true;
                    $result['data'] = $updated;
                }
                else
                {
                    $result['message'] = 'No Data Found';
                }
            }
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));
        }
    }

    public function profile_vehicle_update() {
        
        if ($this->input->is_ajax_request()) {

            $result = array('success' => false, 'message' => null);

            $post = array_filter($this->input->post());
            unset($post['csrf_token']);

            // $updated = $this->Members->update($post['id'], $post);
            $vehicle['vehicle_type'] = $post['vehicle_type'];
            $vehicle['vin_number']   = $post['vin_number'];
            $vehicle['plate_number'] = $post['plate_number'];
            $vehicle['registered_name'] = $post['registered_name'];

            $this->db->insert('service_vehicle', $vehicle);

            unset($vehicle);

            if ($insert_id = $this->db->insert_id()) {
                
                $vehicle['service_member_id']    = $post['service_member_id'];
                $vehicle['service_vehicle_id']   = $insert_id;
                $vehicle['created']              = time();
                $this->db->insert('service_member_vehicle', $vehicle);                    
                $updated = 1;

                unset($vehicle, $post);
            }

            if ($updated == null)
            {
                $result['message'] = 'Can not save at the moment';
            }
            else
            {
                if (count($updated) > 0)
                {
                    $result['success'] = true;
                    $result['data'] = $updated;
                }
                else
                {
                    $result['message'] = 'No Data Found';
                }
            }
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));
        }
    }

     public function profile_booking_history() {
        
        // Set site title page with module menu
        $data['page_title'] =  lang('Service');

        // Set is login user
        $data['logged_in']  = $this->logged_in;

        // Set products
        // $data['products']  = $this->Products->findAllBy('status','publish','id,subject,text',['subject'=>'asc']);
        $data['booking_history'] = $this->Bookings->findAllBy('service_member_id',$this->member->id,'*',['id'=>'DESC']);

        // Set service type
        $data['service_type']   = [
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
                                    '11'=>'Paket D (Kelipatan 40000 KM)'
                                ];

        // Set main template
        $data['main']       = 'services/page/profile_booking_history';

        // Load js in controller        
        $data['js_files_ext'] = array(
            base_url('assets/public/js/libs/jquery-ui-1.11.0.min.js'),
            base_url('assets/public/js/libs/jquery.datepicker-min.js')
        );

        // Load JS execution
        $data['js_inline'] = '
            $( "#birthdate" ).datepicker({dateFormat: "dd/mm/yy",changeMonth:true,changeYear:true,yearRange:"-65:+0",});
            $("#form-profile").submit(function() {
                var action = $(this).attr("action");
                var $form = $.ajax({
                        url: action,
                        timeout:30000,
                        datatype:"json",
                        type:"POST",
                        data:$(this).serialize()
                    });
                    $form.always(function(){

                    });
                    $form.done(function(response){
                        alert(response);
                        if(response.success)
                        {
                            alert(response.message);
                            closePop();
                        }
                        else
                        {
                            alert(response.message);
                        }
                    });
                    $form.fail(function(jqXHR,textStatus){
                        if(textStatus=="timeout"){
                        } else {
                        }
                    });
                return false;
            });
        ';

        // Set meta description for html tags in template
        $this->meta_description = $this->clean_tags();
        
        // Load admin template
        $this->load->view('template/public/template', $this->load->vars($data));
    }

    public function profile_blog () {

        // Set products
        // $data['products']  = $this->Products->findAllBy('status','publish','id,subject,text',['subject'=>'asc']);
        // $data['blogs'] = $this->Members->with('blog')->findAllBy('id',$this->member->id,'*');
        
        // Set is login user
        $data['logged_in']  = $this->logged_in;

        // Set site title page with module menu
        $data['page_title'] =  'Profile - Blog';

        // Set main template
        $data['main']       = 'services/page/profile_blog';

        // Load js in controller        
        $data['js_files_ext'] = array(
            base_url('assets/public/js/libs/jquery-ui-1.11.0.min.js'),
            base_url('assets/public/js/libs/jquery.datepicker-min.js'),
            base_url('assets/public/js/libs/ckeditor/ckeditor.js'),
            base_url('assets/public/js/libs/ckeditor/adapters/jquery.js'),
            base_url('assets/public/js/libs/ckeditor/config.js')
        );

        // Load JS execution
        $data['js_inline'] = '
            $( "#birthdate" ).datepicker({dateFormat: "dd/mm/yy",changeMonth:true,changeYear:true,yearRange:"-65:+0",});
            $("#form-profile").submit(function() {
                var action = $(this).attr("action");
                var $form = $.ajax({
                        url: action,
                        timeout:30000,
                        datatype:"json",
                        type:"POST",
                        data:$(this).serialize()
                    });
                    $form.always(function(){

                    });
                    $form.done(function(response){
                        alert(response);
                        if(response.success)
                        {
                            alert(response.message);
                            closePop();
                        }
                        else
                        {
                            alert(response.message);
                        }
                    });
                    $form.fail(function(jqXHR,textStatus){
                        if(textStatus=="timeout"){
                        } else {
                        }
                    });
                return false;
            });
        ';

        // Set meta description for html tags in template
        $this->meta_description = $this->clean_tags();
        
        // Load admin template
        $this->load->view('template/public/template', $this->load->vars($data));
    }

    /*
    private function _getMemberVehicles ($member_id) {
        
        $select = $this->db->query("
            SELECT tbl_products.subject, tbl_service_vehicle.id, tbl_service_vehicle.vin_number, tbl_service_vehicle.plate_number, tbl_service_vehicle.registered_name, tbl_members.file_name
            FROM tbl_members
            LEFT JOIN tbl_service_member_vehicle 
            ON tbl_members.id = tbl_service_member_vehicle.service_member_id
            LEFT JOIN tbl_service_vehicle 
            ON tbl_service_vehicle.id = tbl_service_member_vehicle.service_vehicle_id
            LEFT JOIN tbl_products 
            ON tbl_products.id = tbl_service_vehicle.vehicle_type
            WHERE tbl_members.id = '{$member_id}'
        ");
        return $select->result();
    }
    */
    private function _getMember ($member_id) {

        $member = $this->Members->with('vehicle')->with('blog')->get($member_id);
        $vehicle = $this->ServiceMemberVehicles->with('service_vehicle')->findAllBy('service_member_id',$member_id); 

        $member->vehicle = $vehicle;

        return $member;
    } 

    private function _getSurveyRespondent ($member_id) {

        $sql = "SELECT 
            tbl_service_survey_question.ssq_subject,
            tbl_service_survey_question.ssq_type,
            tbl_service_survey_answer.ssa_value
            FROM tbl_service_survey_question 
            LEFT JOIN tbl_service_survey_answer ON tbl_service_survey_question.ssq_id = tbl_service_survey_answer.ssq_id
            LEFT JOIN tbl_service_survey_respondent ON tbl_service_survey_answer.ssr_id = tbl_service_survey_respondent.ssr_id WHERE tbl_service_survey_respondent.ssr_id = {$member_id}";
        
        $query = $this->db->query($sql);
        $result = '<br>';
        foreach ($query->result() as $results) {
            $result .= '<strong>'.$results->ssq_subject.'</strong><br>';
            if ($results->ssq_type == 'boolean') {
                $result .= '<span>'.($results->ssa_value == 1 ? 'Ya':'Tidak').'</span><br>';
            } else if ($results->ssq_type == 'objective') {                 
                $result .= '<span>'.($results->ssa_value == 1 ? 'Memuaskan':'Mengecewakan').'</span><br>';
            } else {                
                $result .= '<span>'.$results->ssa_value.'</span><br>';
            }
        }
        $result .= '<br>';
        return $result;
    }

    // ********** CALLBACKS *********** // 

    // Match Captcha post to Database
    public function match_captcha($captcha) {       
        
        // Check captcha if empty
        if ($captcha == '') {
            $this->form_validation->set_message('match_captcha', lang('required'));
            return false;
        }
        // Check captcha if match
        else if (!$this->Captcha->match($captcha)) {
            $this->form_validation->set_message('match_captcha', lang('regex_match'));
            return false;
        } else {
            return true;
        }
    }   
}

/* End of file services.php */
/* Location: ./application/controllers/services.php */