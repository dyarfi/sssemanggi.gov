<?php

Class Xhr extends Public_Controller {

    public function __construct(){
        parent::__construct();
        // Load Models
        $this->load->model('Captcha');
        $this->load->model('member/Notifications');
    }

    public function index () {

        // Set main template
        $data['data'] = '';

        // Load site template
        $this->load->view('json', $this->load->vars($data));
    }

    // Blog lookup data by Member and Dealer
    public function blog() {

        // Load models
        $this->load->model('newscenter/News');

        // Set defaults
        $fields ='';
        $errors ='';

        // Check ajaxed requested and POST method
        if ($this->input->is_ajax_request()) {

             //Default data setup
            $fields = array(
                    'blog_member_id' => '',
                    'blog_subject'   => '',
                    'blog_tags'      => '',
                    'blog_text'      => '',
                    'blog_media'     => '',
                    'base64'         => '',
                );

            $errors = $fields;

            // Set form validation rules
            $this->form_validation->set_rules('blog_member_id', 'Member ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('blog_subject', 'Blog Subject', 'trim|required|xss_clean');
            $this->form_validation->set_rules('blog_text', 'Blog Text', 'trim|required|xss_clean');

            // Check if post is requested
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                // Set default
                $fields   = $_POST;

                // Validation form checks
                if ($this->form_validation->run() == FALSE) {

                    // Set error fields
                    $error = array();
                    foreach(array_keys($fields) as $error) {
                        $errors[$error] = form_error($error);
                    }

                    unset($fields['base64']);

                    // Set previous post merge to default
                    $fields = array_merge($fields, $this->input->post());

                    // Set error data to view
                    $data['errors'] = $errors;

                    // Post Fields
                    $data['fields'] = (object) $fields;

                } else {

                    // Check if this input exists or not
                    if ($fields["base64"] != '' && preg_match("/data:image\//i",$fields["base64"])) {

                        // Get the data sent and replace unwanted string
                        $base64img = str_replace('data:image/png;base64,', '', $fields["base64"]);
                        $base64img = str_replace('data:image/jpeg;base64,', '', $base64img);

                        $size = getimagesize($fields["base64"]);

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
                        $file = 'uploads/news/' . $filename;

                        // Put file to upload directory
                        if (file_put_contents($file, $return) && $fields['base64']) {

                            $fields["media"] = $filename;

                        }

                    }

                    // Set data to add to database
                    $object['media'] =  $fields['media'];

                    $object['user_id'] = $this->input->post('blog_member_id');
                    $object['subject'] = $this->input->post('blog_subject');
                    $object['url']     = url_title($object['subject']);
                    $object['tags']    = $this->input->post('blog_tags');
                    $object['text']    = $this->input->post('blog_text');
                    $object['type']    = $this->input->post('blog_type');
                    $object['publish_date'] = date('Y-m-d',time());
                    $object['added']    = time();
                    $object['status']   = 'unpublish';

                    if ($this->input->post('blog_id') == '') {

                        // Set data to add to database
                        $this->News->setNews($object);

                    } else {

                        // Set blog id to be edited
                        $object['id'] = $this->input->post('blog_id');
                        $this->News->updateNews($object);

                    }

                    // Set message
                    $this->session->set_flashdata('message','Blog Tersimpan!');

                    // Set response message
                    $response['data']['referer'] = $this->agent->is_referral() ? $this->agent->referrer() : $this->uri->uri_string();
                    $response['status']  = '1';
                    $response['message'] = 'Blog menunggu untuk persetujuan';

                    // Redirect after add
                    // redirect('service/blog');

                }
            }

        }

        // Set result data to view
        $data['response'] = $response;

        // Set Json
        $data['json']   = $data;

        // Load site template
        $this->load->view('json', $this->load->vars($data));

    }

    // Blog Lookup
    public function blog_lookup() {

        // Load models
        $this->load->model('newscenter/News');

        // Check ajaxed requested and POST method
        if ($this->input->is_ajax_request() && $_SERVER['REQUEST_METHOD'] == 'POST') {

            $news_id = $this->encrypt->decode($this->input->post('edit'));
            $blog = $this->News->get($news_id);

            $response['result'] = $blog;
        }

        // Set result data to view
        $data['response'] = $response;

        // Set Json
        $data['json']   = $data;

        // Load site template
        $this->load->view('json', $this->load->vars($data));

    }
     // Blog unpublish
    public function blog_unpublish() {

        // Load models
        $this->load->model('newscenter/News');

        // Check ajaxed requested and POST method
        if ($this->input->is_ajax_request() && $_SERVER['REQUEST_METHOD'] == 'POST') {

            $news_id = $this->encrypt->decode($this->input->post('edit'));
            $blog = $this->News->update($news_id, ['status'=>'unpublish']);

            $response['result'] = $blog;
        }

        // Set result data to view
        $data['response'] = $response;

        // Set Json
        $data['json']   = $data;

        // Load site template
        $this->load->view('json', $this->load->vars($data));

    }

    // Booking Lookup
    public function book_lookup() {

        // Load models
        $this->load->model('member/Members');
        $this->load->model('service/Bookings');

        // Check ajaxed requested and POST method
        if ($this->input->is_ajax_request() && $_SERVER['REQUEST_METHOD'] == 'POST') {

            // Set post data en encrypt
            $post = $this->encrypt->decode($this->input->post('book'));
            list($book_date, $book_time, $dealer_id, $member_id) = explode(':',$post);

            // Set dealer data
            $member = $this->Members->get($member_id);
            $config = json_decode($member->attribute);

            // Check default limit booking / hour
            $count   = $this->Bookings->findCount(['date'=>$book_date,'time'=>$book_time,'dealer_id'=>$dealer_id]);

            $result  = '';
            $errors  = '';
            $message = '';

            if ((int) $count + 1 > (int) $config->setting_three->value) {

                $result  = $count;
                $errors  = 1;
                $message = 'Maaf booking lebih dari batas per jam';

            } else if($count == 0) {

            } else {

            }

            $result['book_date'] = $book_date;
            $result['book_time'] = $book_time;

            $response['result']  = $result;
            $response['message'] = $message;

        }

        // Set result data to view
        $data['response'] = $response;

        // Set Json
        $data['json']   = $data;

        // Load site template
        $this->load->view('json', $this->load->vars($data));

    }

    // Cancelling book by Member and Dealer
    public function book_cancel() {

        // Load models
        $this->load->model('service/Bookings');

        // Check ajaxed requested and POST method
        if ($this->input->is_ajax_request() && $_SERVER['REQUEST_METHOD'] == 'POST') {

            $book_id = $this->encrypt->decode($this->input->post('book'));
            $book = $this->Bookings->update($book_id, ['approved' => '0']);

            $response['data']['referer'] = $this->agent->is_referral() ? $this->agent->referrer() : $this->uri->uri_string();
            $response['status']  = '1';
            $response['result'] = $book;
        }

        // Set result data to view
        $data['response'] = $response;

        // Set Json
        $data['json']   = $data;

        // Load site template
        $this->load->view('json', $this->load->vars($data));

    }

    // Approved booking by Dealer
    public function book_approved() {

        // Load models
        $this->load->model('service/Bookings');

        // Check ajaxed requested and POST method
        if ($this->input->is_ajax_request() && $_SERVER['REQUEST_METHOD'] == 'POST') {

            $book_id = $this->encrypt->decode($this->input->post('book'));
            $book = $this->Bookings->update($book_id, ['approved' => '1']);

            $response['data']['referer'] = $this->agent->is_referral() ? $this->agent->referrer() : $this->uri->uri_string();
            $response['status']  = '1';
            $response['result'] = $book;
        }

        // Set result data to view
        $data['response'] = $response;

        // Set Json
        $data['json']   = $data;

        // Load site template
        $this->load->view('json', $this->load->vars($data));

    }

    // Delete booking by Dealer
    public function book_delete() {

        // Load models
        $this->load->model('service/Bookings');

        // Check ajaxed requested and POST method
        if ($this->input->is_ajax_request() && $_SERVER['REQUEST_METHOD'] == 'POST') {

            $book_id = $this->encrypt->decode($this->input->post('book'));
            $book = $this->Bookings->delete($book_id);

            $response['data']['referer'] = $this->agent->is_referral() ? $this->agent->referrer() : $this->uri->uri_string();
            $response['status']  = '1';
            $response['result'] = $book;
        }

        // Set result data to view
        $data['response'] = $response;

        // Set Json
        $data['json']   = $data;

        // Load site template
        $this->load->view('json', $this->load->vars($data));

    }

    // Get products model by products
    public function find_model() {

        // Load models
        $this->load->model('product/Products');

        // Check ajaxed requested and POST method
        if ($this->input->is_ajax_request() && $_SERVER['REQUEST_METHOD'] == 'POST') {

            $models = $this->Products->with('model')->findBy('id',$this->input->post('product_id'),'id,subject');

            $response['status'] = '1';
            $response['result'] = is_array($models->model) ? $models->model : '';

        }

        // Set result data to view
        $data['response'] = $response;

        // Set Json
        $data['json']   = $data;

        // Load site template
        $this->load->view('json', $this->load->vars($data));

    }

    // Callback for date lookup
    public function date_lookup() {

        // Check ajaxed requested and POST method
        if ($this->input->is_ajax_request() && $_SERVER['REQUEST_METHOD'] == 'POST') {

            $month = $this->input->post('value');

            // Set selected time for date
            $date   = $this->input->get('date') ? $this->input->get('date') : date('d-m-Y');

            // mktime ([ int $hour = date("H") [, int $minute = date("i") [, int $second = date("s") [, int $month = date("n") [, int $day = date("j") [, int $year = date("Y") [, int $is_dst = -1 ]]]]]]] )
            // $time = date("d-m-Y", mktime(0, 0, 0, date('m', strtotime($month)), 1, date('Y')));

            // Set Date Period
            $currentDate = new DateTime(strtotime($month), new DateTimeZone('Asia/Jakarta'));
            //$currentDate = new DateTime($currentDate->format( 'm/d/Y' ), new DateTimeZone('Asia/Jakarta'));
            /*
            $availableInterval = new DateInterval('P2D');
            $availableDate = $currentDate;
            $availableDate->add($availableInterval);
            $rangeInterval = new DateInterval('P6D');
            $rangeDate = new DateTime($availableDate->format( 'm/d/Y' ), new DateTimeZone('Asia/Jakarta'));
            $rangeDate->add($rangeInterval);
            $periodsEnd = new DateTime($availableDate->format( 'm/d/Y' ), new DateTimeZone('Asia/Jakarta'));
            */
            $availableDate = $currentDate;
            $periodsEnd = new DateTime($availableDate->format( 'm/d/Y' ), new DateTimeZone('Asia/Jakarta'));
            $periods = new DatePeriod(
                $availableDate,
                new DateInterval('P1D'),
                $periodsEnd->add(new DateInterval('P1M'))
            );
            $months = [];
            $days = [];
            foreach ($periods as $period) {
                //print_r(date('d-m-Y',$period->format('U')).', ');
                // $months[$period->format('F')][$period->format('U')] = date('d-m-Y',$period->format('U'));
            }
            exit;
            $data['month_que'] = $month;
            $data['date_que'] = $date;
            $data['months'] = $months;

            //print_r($periods);

            $response['result'] = $blog;
        }

        // Set result data to view
        $data['response'] = $response;

        // Set Json
        $data['json']   = $data;

        // Load site template
        $this->load->view('json', $this->load->vars($data));

    }
    // Config setting dealer
    public function config_dealer() {

        // Load models
        $this->load->model('member/Members');

        // Check ajaxed requested and POST method
        if ($this->input->is_ajax_request() && $_SERVER['REQUEST_METHOD'] == 'POST') {

            $member_id = $this->encrypt->decode($this->input->post('member_id'));

            $post = $this->input->post();

            $attribute = [
                            'setting_zero' =>[
                                'label' =>'Buka Sabtu',
                                'type'  => 'boolean',
                                'value' => (int) $post['setting_zero'] ? 1 : 0
                            ],
                            'setting_one' =>[
                                'label' =>'Buka Minggu',
                                'type'  => 'boolean',
                                'value' => (int) $post['setting_one'] ? 1 : 0
                            ],
                            'setting_two' =>[
                                'label' =>'Dealer Sedang Tutup',
                                'type'  => 'boolean',
                                'value' => (int) $post['setting_two'] ? 1 : 0
                            ],
                            'setting_three' =>[
                                'label' =>'Limit booking / jm',
                                'type'  => 'text',
                                'value' => (int) $post['setting_three'] ? (int) $post['setting_three'] : 5
                            ],
                            'setting_four' =>[
                                'label' =>'Jam Buka',
                                'type'  => 'text',
                                'default' => 6,
                                'value' => (int) $post['setting_four'] ? (int) $post['setting_four'] : 6
                            ],
                            'setting_five' =>[
                                'label' =>'Jam Tutup',
                                'type'  => 'text',
                                'default' => 24,
                                'value' => (int) $post['setting_five'] ? (int) $post['setting_five'] : 24
                            ]
                        ];

            // Update to database
            $object['attribute'] = json_encode($attribute);

            // Value validation
            $send = false;
            if ((int) $post['setting_three'] > 35) {

                // Set message
                $message = ', Maksimum 35 slot per jam';

            } else
            if ((int) $post['setting_three'] < 1) {

                // Set message
                $message = ', Minimum 1 slot per jam';

            } else
            if ((int) $post['setting_four'] < 6) {

                // Set message
                $message = ', Minimum jam 6';

            } else
            if ((int) $post['setting_four'] >= 24) {

                // Set message
                $message = ', Minimum jam 6';

            } else
            if ((int) $post['setting_five'] > 24) {

                // Set message
                $message = ', Maksimum jam 24';

            } else
            if ((int) $post['setting_four'] > $post['setting_five']) {

                // Set message
                $message = ', Minimum jam tutup harus lebih besar dari jam buka maksimum';

            } else
            if ((int) $post['setting_five'] < $post['setting_four']) {

                // Set message
                $message = ', Maksimum jam buka kurang dari minimum jam tutup';

            } else {

                // Send true instead
                $send = true;
            }

            if ($send) {

                // Update database
                $config = $this->Members->update($member_id, $object);

                // Set response message
                $response['status']  = '1';
                $response['message'] = 'Telah disimpan';

            } else {

                // Set response message
                $response['status']  = '0';
                $response['message'] = 'Belum bisa disimpan'.$message;
            }
        }

        // Set response message referer
        $response['data']['referer'] = $this->agent->is_referral() ? $this->agent->referrer() : $this->uri->uri_string();

        // Set result data to view
        $data['response'] = $response;

        // Set Json
        $data['json']   = $data;

        // Load site template
        $this->load->view('json', $this->load->vars($data));

    }
    // Config email dealer
    public function config_email_dealer() {

        // Load models
        $this->load->model('member/Members');
        $this->load->model('service/DealerNetworks');

        // Check ajaxed requested and POST method
        if ($this->input->is_ajax_request() && $_SERVER['REQUEST_METHOD'] == 'POST') {

            $dealer_id = $this->encrypt->decode($this->input->post('dealer_id'));

            $post = $this->input->post('dealer_email_contact');

            $email_contacts = explode(PHP_EOL, $post);

            $object['email'] = implode('\n\r',$email_contacts);

            $config = $this->DealerNetworks->update($dealer_id, $object);

            if ($config) {

                // Set response message
                $response['data']['referer'] = $this->agent->is_referral() ? $this->agent->referrer() : $this->uri->uri_string();
                $response['status']  = '1';
                $response['message'] = 'Telah disimpan';

            } else {

                // Set response message
                $response['data']['referer'] = $this->agent->is_referral() ? $this->agent->referrer() : $this->uri->uri_string();
                $response['status']  = '0';
                $response['message'] = 'Belum bisa disimpan';
            }
        }

        // Set result data to view
        $data['response'] = $response;

        // Set Json
        $data['json']   = $data;

        // Load site template
        $this->load->view('json', $this->load->vars($data));

    }

    public function dealer_primary_email () {

        // Load models
        $this->load->model('member/Members');

        // Default data setup
        $fields = array(
                'member_id' => '',
                'dealer_email_contact'     => '');

        $errors = $fields;

        $this->form_validation->set_rules('member_id', 'Member', 'trim|required|min_length[2]|max_length[256]|xss_clean');
        $this->form_validation->set_rules('dealer_primary_email', 'Email','trim|required|valid_email|min_length[5]|max_length[36]|xss_clean');

        $this->form_validation->set_error_delimiters('<span class="warning light">', '</span>');

        // Check ajaxed requested and POST method
        if ($this->input->is_ajax_request() && $_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($_FILES) {
                $fields   = array_merge($_POST, $_FILES);
            }
            else {
                $fields   = $_POST;
            }

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

            }
            else
            {
                $member_id = $this->encrypt->decode($this->input->post('member_id'));

                $email = $this->input->post('dealer_primary_email');

                $object['email'] = $email;

                $return = $this->Members->update($member_id, $object);

                if ($return) {

                    // Set additional data
                    $member = $this->Members->get($member_id);

                    // Data to send to email notification to admin
                    $message['site_name']       = $this->title_name->value;
                    $message['site_link']       = base_url();
                    $message['header']          = 'Email Akun Dealer';
                    $message['messages']        = 'Email : <b>'.$email.'</b> adalah email utama untuk akun Dealer Suzuki anda <b>'.$member->fullname.'</b>. Selanjutnya, silahkan ganti password anda. <br><br><br><br>Terima kasih';
                    $message['site_copyright']  = $this->copyright->value;

                    // Set email subject
                    $subject = $this->title_name->value . ' - Email untuk akun Dealer '. $member->fullname;

                    // Set email template
                    $email_template = $this->load->view('admin/emails/site_contact',$this->load->vars($message),TRUE);

                    $from = ADMIN_REPLY;
                    $this->email->clear();
                    $this->email->from($from, $this->title_name->value);
                    $this->email->to($email);
                    $this->email->reply_to($from, $this->title_name->value);
                    $this->email->subject($subject);
                    $this->email->message($email_template);
                    $this->email->send();

                    // Set response message
                    $response['data']['referer'] = $this->agent->is_referral() ? $this->agent->referrer() : $this->uri->uri_string();
                    $response['status']  = '1';
                    $response['message'] = 'Telah disimpan, mohon rubah password anda untuk melanjutkan';

                } else {

                    // Set response message
                    $response['data']['referer'] = $this->agent->is_referral() ? $this->agent->referrer() : $this->uri->uri_string();
                    $response['status']  = '0';
                    $response['message'] = 'Belum bisa disimpan';
                }
            }
        }

        // Set result data to view
        $response['errors'] = $errors;
        $response['fields'] = $fields;

        // Set result data to view
        $data['response'] = $response;

        // Set Json
        $data['json']   = $data;

        // Load site template
        $this->load->view('json', $this->load->vars($data));

    }

    public function dealer_password () {

        // Load models
        $this->load->model('member/Members');

        // Default data setup
        $fields = array(
                'password' => '',
                'password1'     => '');

        $errors = $fields;

        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[2]|max_length[256]|xss_clean');
        $this->form_validation->set_rules('password1', 'Retype Password','trim|required|matches[password]');

        $this->form_validation->set_error_delimiters('<span class="warning light">', '</span>');

        // Check ajaxed requested and POST method
        if ($this->input->is_ajax_request() && $_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($_FILES) {
                $fields   = array_merge($_POST, $_FILES);
            }
            else {
                $fields   = $_POST;
            }

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

            }
            else
            {
                $member_id = $this->encrypt->decode($this->input->post('member_id'));

                $password = $this->input->post('password');

                $object['password'] = sha1($password);

                $return = $this->Members->update($member_id, $object);

                if ($return) {

                    // Set additional data
                    $member = $this->Members->get($member_id);

                    // Data to send to email notification to admin
                    $message['site_name']       = $this->title_name->value;
                    $message['site_link']       = base_url();
                    $message['header']          = 'Akun Dealer';
                    $message['messages']        = 'Password : <b>'.$password.'</b> adalah password utama untuk akun Dealer Suzuki anda <b>'.$member->fullname.'</b>. Selanjutnya, logout dahulu dan silahkan lanjutkan login dengan password baru. <br><br><br><br>Terima kasih';
                    $message['site_copyright']  = $this->copyright->value;

                    // Set email subject
                    $subject = $this->title_name->value . ' - Akun Dealer untuk '. $member->fullname;

                    // Set email template
                    $email_template = $this->load->view('admin/emails/site_contact',$this->load->vars($message),TRUE);

                    $from = ADMIN_REPLY;
                    $this->email->clear();
                    $this->email->from($from, $this->title_name->value);
                    $this->email->to($member->email);
                    $this->email->reply_to($from, $this->title_name->value);
                    $this->email->subject($subject);
                    $this->email->message($email_template);
                    $this->email->send();

                    // Set response message
                    $response['data']['referer'] = $this->agent->is_referral() ? $this->agent->referrer() : $this->uri->uri_string();
                    $response['status']  = '1';
                    $response['message'] = 'Telah disimpan, mohon logout terlebih dahulu dan login dengan menggunakan password baru';

                } else {

                    // Set response message
                    $response['data']['referer'] = $this->agent->is_referral() ? $this->agent->referrer() : $this->uri->uri_string();
                    $response['status']  = '0';
                    $response['message'] = 'Belum bisa disimpan';
                }
            }
        }

        // Set result data to view
        $response['errors'] = $errors;
        $response['fields'] = $fields;

        // Set result data to view
        $data['response'] = $response;

        // Set Json
        $data['json']   = $data;

        // Load site template
        $this->load->view('json', $this->load->vars($data));

    }

    public function get_notification() {

        $response = '';

        if ( $this->input->is_ajax_request() && $this->input->post('dealer_id') != '' ) {


            $notification       = $this->Notifications->find(['user_id'=>$this->input->post('dealer_id'),'status'=>1], '*',['id'=>'ASC']);
            $response['data']   = $notification;

            // Set response message
            //$response['data']['referer'] = $this->agent->is_referral() ? $this->agent->referrer() : $this->uri->uri_string();
            $response['status']  = '1';
            $response['message'] = 'OK';

            // Set notification read
            $this->Notifications->update($notification->id,['status'=>'2','modified'=>time()]);

        } else {

            // Set response message
            // $response['data']['referer'] = $this->agent->is_referral() ? $this->agent->referrer() : $this->uri->uri_string();
            $response['status']  = '0';
            $response['message'] = 'NOT FOUND';
        }


        // Set result data to view
        $response['errors'] = $errors;
        $response['fields'] = $fields;

        // Set result data to view
        $data['response'] = $response;

        // Set Json
        $data['json']   = $data;

        // Load site template
        $this->load->view('json', $this->load->vars($data));

    }

    // Config email dealer
    public function booking() {

        // Load models
        $this->load->model('service/Bookings');
        $this->load->model('product/Products');
        $this->load->model('product/ProductModels');

        // Default data setup
        $fields = array(
                'dealer_id' => '',
                'name'      => '',
                'email'     => '',
                'phone'     => '',
                'book_type' => '',
                'service_vehicle_id' => '',
                'vehicle_type' => '',
                'service_type' =>'',
                'vin_number' => '',
                'license_number' => '',
                'license_name'   => '',
                'date' => '',
                'time' => '',
                'captcha'   => '');

        $errors = $fields;

        $this->form_validation->set_rules('name', 'Nama', 'trim|required|min_length[5]|max_length[24]|xss_clean');
        $this->form_validation->set_rules('email', 'Email','trim|valid_email|min_length[5]|max_length[36]|xss_clean');
        $this->form_validation->set_rules('phone', 'No.Telp','trim|numeric|required|min_length[5]|max_length[32]');
        $this->form_validation->set_rules('service_vehicle_id', 'Kendaraan','trim|required|xss_clean|max_length[350]');
        $this->form_validation->set_rules('vehicle_type', 'Tipe Mesin','trim|required');
        $this->form_validation->set_rules('service_type', 'Tipe Servis','trim|required');
        $this->form_validation->set_rules('vin_number', 'Nomor VIN','trim|required');
        $this->form_validation->set_rules('license_number', 'Nomor Polisi','trim|required');
        $this->form_validation->set_rules('license_name', 'Nama Pada STNK','trim|required');
        $this->form_validation->set_rules('date', 'Tanggal','trim|required');
        $this->form_validation->set_rules('time', 'Jam','trim|required');

        $this->form_validation->set_rules('captcha', 'Captcha', 'trim|xss_clean|max_length[6]|callback_match_captcha');

        $this->form_validation->set_error_delimiters('<span class="warning light">', '</span>');

        // Check if post is requested
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($_FILES) {
                $fields   = array_merge($_POST, $_FILES);
            }
            else {
                $fields   = $_POST;
            }

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

            }
            else
            {
                // Set time
                $time = (strlen($fields['time']) == 1) ? '0'.$fields['time'].':00' : $fields['time'] . ':00';

                $object = array();

                // Set unique order ID
                $object['order_id']  = strtoupper(random_string('alnum',4) .'-'. random_string('numeric',4));
                $object['dealer_id'] = $fields['dealer_id'];
                $object['name']      = $fields['name'];
                $object['email']     = $fields['email'];
                $object['phone']     = $fields['phone'];
                $object['book_type'] = $fields['book_type'];
                $object['service_vehicle_id'] = $fields['service_vehicle_id'];
                $object['vehicle_type']     = $fields['vehicle_type'];
                $object['service_type']     = $fields['service_type'];
                $object['vin_number']       = $fields['vin_number'];
                $object['license_number']   = $fields['license_number'];
                $object['license_name']     = $fields['license_name'];
                $object['date']             = $fields['date'];
                $object['time']             = $time;
                $object['custom']           = $fields['custom'];

                $object['created']         = time();
                $object['approved']        = '1';
                $object['status']          = '1';

                // Set Member data
                $return = $this->Bookings->insert($object);
                $insert_id = $this->db->insert_id();

                if (!empty($return)) {

                    if ($fields['email'] != '') {

                        // Set booking data
                        $booking = $this->Bookings->with('dealer')->get($insert_id);

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

                        $package = (($package_arr[$fields['service_type']]) ? $package_arr[$fields['service_type']] : $fields['custom']);

                        if ($booking->service_member_id != 0) {
                            $vehicle = $this->Bookings->_getBookingVehicle($booking->service_vehicle_id);
                        } else {
                            $vehicle = $this->Products->get($booking->service_vehicle_id);
                        }

                        // Set vehicle model type
                        $vehicle_type = $this->ProductModels->get($booking->vehicle_type);

                        $response['success'] = true;
                        $response['message'] = 'Anda telah terdaftar booking di Bengkel Resmi Suzuki '.$booking->dealer->name.' yang beralamat di '.$booking->dealer->address.', '.$booking->dealer->city.'. Pada tanggal '.date('d-m-Y', $booking->date).' pukul '.$time.'.';
                        $response['data']['referer'] = base_url('services/automobile');

                        // Emailing the admin and user
                        // Set email
                        $email = $fields['email'];

                        // Set subject
                        $subject = 'Booking Online Service';

                        // Data to send to public
                        $message['site_name']       = $this->title_name->value;
                        $message['site_link']       = base_url();
                        $message['header']          = 'Booking Service Online';
                        $message['messages']        = 'Yth <b>'.$booking->name.'</b>, Terima kasih atas Booking Service yang Anda lakukan pada Bengkel Resmi Suzuki kami <b>'.$booking->dealer->name.'</b> yang beralamat di '.$booking->dealer->address.', '.$booking->dealer->city.'. Untuk itu, kami akan merespon permintaan Booking Service yang Anda kirimkan kepada kami.<hr>ID Order : <b>'.$booking->order_id.'</b><br>Name : '.$booking->name.'<br>Telepon : '.$booking->phone.'<br>Email : '.$booking->email.'<br>Nomor VIN : '.$booking->vin_number.'<br>STNK : '.$booking->license_number.'<br>Nama di STNK : '.$booking->license_name.'<br>Tanggal : '.date('d-m-Y', $booking->date).'<br>Jam : '.$time.'<br>Kendaraan : '.$vehicle->subject.'<br>Tipe Mesin : '.$vehicle_type->subject.'<br>Paket Servis : '.$package.'<hr/><br>Dealer : '.$booking->dealer->name.'<br/>Alamat : '.$booking->dealer->address.', '.$booking->dealer->city;
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
                        $this->email->send();

                    }

                    // Set response message
                    $response['data']['referer'] = $this->agent->is_referral() ? $this->agent->referrer() : $this->uri->uri_string();
                    $response['status']  = '1';
                }

                // Set message
                $this->session->set_flashdata('message', 'Booking Service Tersimpan, dengan nomor ID Order : '.$booking->order_id);

                // Redirect after add
                //redirect(base_url('media-room/sent'));

            }

        }

        // Set result data to view
        $response['errors'] = $errors;
        $response['fields'] = $fields;

        // Set result data to view
        $data['response'] = $response;

        // Set Json
        $data['json']   = $data;

        // Load site template
        $this->load->view('json', $this->load->vars($data));

    }

    // Callback service map
    public function service_map() {

        // Load dealer network
        $this->load->model('service/DealerNetworks');

        $post = $this->input->post('q');
        $pieces = explode(', ', $post);

        if ($this->input->post('all_map') != 1) {
            $searchTermBits = array();
            foreach ($pieces as $term) {
                $term = trim($term);
                if (!empty($term)) {
                    $searchTermBits[] = "name LIKE '%$term%'";
                }
            }
            $locations = $this->DealerNetworks->execute_query("SELECT * FROM tbl_urban_districts WHERE ".implode(' OR ', $searchTermBits)." LIMIT 0, 1;");

            $result = '';
            foreach ($locations->result() as $location) {
                $result = $location->province_id;
            }
            // Set map base on user base location
            $locations_dealers = $this->DealerNetworks->findAllBy('province',$result, 'id,name,address,city,phone_one,phone_two,geolocation_lat,geolocation_long');

        } else {
            // Set all map
            $locations_dealers = $this->DealerNetworks->findAll(['status'=>'publish'],'id,name,address,city,phone_one,phone_two,geolocation_lat,geolocation_long');
        }        

        $errors = '';
        $fields = '';
        //$response = $locations_dealers;

        // Set result data to view
        $response['errors'] = $errors;
        $response['fields'] = $locations_dealers;

        // Set result data to view
        $data['response'] = $response;

        // Set Json
        $data['json']   = $data;

        // Load site template
        $this->load->view('json', $this->load->vars($data));
    }

    public function product_to_cart() {

        // load cart library
        $this->load->library('cart');

        // Load models
        $this->load->model('product/Products');
        $this->load->model('product/ProductModels');
        $this->load->model('product/ProductVariants');

        //Set default
        $product = '';
        $variant = '';

        // Check if post is requested via ajax
        if ( $this->input->is_ajax_request() && $_SERVER['REQUEST_METHOD'] == 'POST') {

            $product = $this->Products->with('model')->get($this->input->post('id'));
            $variant = $this->ProductVariants->with('color')->get($this->input->post('variant'));
        }

        // Set result data to view
        $data['product'] = $product;
        $data['variant'] = $variant;

        // Load site template
        $this->load->view('template/public/blank', $this->load->vars($data));
    }

    public function add_to_cart() {

        // load cart library
        $this->load->library('cart');

        // Load models
        $this->load->model('product/Products');
        $this->load->model('product/ProductModels');
        $this->load->model('product/ProductVariants');

        // Check if post is requested via ajax
        if ( $this->input->is_ajax_request() && $_SERVER['REQUEST_METHOD'] == 'POST') {

            $product = $this->Products->with('model')->get($this->input->post('id'));

            // print_r($product);
            // print_r($this->ProductModels->findAllBy('product_id',$this->input->post('id')));

            $data = array(
                   'id'      => 'sku_123ABC',
                   'qty'     => 1,
                   'price'   => 39.95,
                   'name'    => 'T-Shirt',
                   'options' => array('Size' => 'L', 'Color' => 'Red')
                );

            $this->cart->insert($data);
        }

        $errors = '';
        $fields = '';

        // Set result data to view
        $response['errors'] = $errors;
        $response['fields'] = $locations_dealers;

        // Set result data to view
        $data['response'] = $response;

        // Set Json
        $data['json']   = $data;

        // Load site template
        $this->load->view('json', $this->load->vars($data));
    }

    // Callback image after upload
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

    // Handle upload image files
    public function handle_upload() {

        if (isset($_FILES['blog_media']) && !empty($_FILES['blog_media']['name']))
          {
          if ($this->upload->do_upload('blog_media'))
          {
            // set a $_POST value for 'cv_file' that we can use later
            $upload_data    = $this->upload->data();
            $_POST['blog_media'] = $upload_data['file_name'];
            return true;
          }
          else
          {
            // possibly do some clean up ... then throw an error
            $this->form_validation->set_message('handle_upload', $this->upload->display_errors());
            return false;
          }
        }
        else
        {
          // throw an error because nothing was uploaded
          $this->form_validation->set_message('handle_upload', lang('required'));
          return false;
        }
    }

    // Reload Captcha to the view
    public function reload_captcha() {

        // Send image to display Captcha
        $captcha = $this->Captcha->image();

        // Echo captcha Image
        echo $captcha['image'];
        exit;

    }

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
