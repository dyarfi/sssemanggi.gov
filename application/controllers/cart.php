<?php
 
Class Cart extends Public_Controller {
 
    public function __construct(){
        parent::__construct();
        // Load Models
        $this->load->model('Captcha');        
        $this->load->model('member/Notifications');        
        $this->load->model('contact/Contacts');
        $this->load->model('contact/ContactHistories');

        // Set email to sent
        $this->emails = $this->Contacts->findAllBy('attribute','email_contact_us','email');
    }
 
    public function index () {

        // Set main template
        $data['data'] = '';
        
        // Load site template
        $this->load->view('json', $this->load->vars($data));
    }

    public function product_to_cart() {
        
        // load cart library
        // $this->load->library('cart');

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

        // Set main template
        $data['main']       = 'product_cart';

        // Load site template
        $this->load->view('template/public/blank', $this->load->vars($data));
    }

    public function send_order() {
        
        // Load models
        $this->load->model('product/Products');                
        $this->load->model('product/ProductModels');        
        $this->load->model('product/ProductVariants');

        // Default data setup
        $fields = array(
                'product_id'  => '',
                'name'  => '',
                'email'     => '',
                'phone'     => '',                
                'captcha'   => '',
                'address'   => '');

        $errors = $fields;

        $this->form_validation->set_rules('product_id', 'Produk', 'trim|required|min_length[1]|max_length[256]|xss_clean');        
        $this->form_validation->set_rules('name', 'Nama', 'trim|required|min_length[2]|max_length[256]|xss_clean');
        $this->form_validation->set_rules('email', 'Email','trim|required|valid_email|min_length[5]|max_length[36]|xss_clean');
        $this->form_validation->set_rules('phone', 'Telepon', 'trim|numeric|required|min_length[2]|max_length[512]|xss_clean');        
        $this->form_validation->set_rules('address', 'Alamat', 'trim|required|min_length[2]|max_length[512]|xss_clean');
        $this->form_validation->set_rules('captcha', 'Captcha', 'trim|xss_clean|max_length[6]|callback_match_captcha');     
                    
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

                // Set response message
                $response['data']['referer'] = $this->agent->is_referral() ? $this->agent->referrer() : $this->uri->uri_string();
                $response['status']  = '0';
                $response['message'] = 'Belum bisa disimpan';              

            }
            else
            {
                // Set the data we want to produce
                $email       = $this->input->post('email');
                $name        = ucfirst($this->input->post('name'));
                $product_id  = $this->input->post('product_id');                
                $model       = $this->input->post('model');
                $variant     = ucfirst($this->input->post('variant'));                
                $phone       = $this->input->post('phone');
                $address       = $this->input->post('address');

                if ($model) {
                    $order_message_data .= '<b>Harga :</b> '. $model .'<br>';
                }
                if ($variant) {
                    $order_message_data .= '<b>Varian :</b> '. $variant .'<br>';
                }

                // Set email message to public
                $order_message_public  = 'Yth <b>'. $name .'</b>, anda telah melakukan pemesanan produk kami : <br><hr/>';
                $order_message_public .= '<b>Produk :</b> '. $product_id .'<br>';
                $order_message_public .= $order_message_data;                
                $order_message_public .= '<b>Email :</b> '. $email .'<br>';                
                $order_message_public .= '<b>Telepon :</b> '. $phone .'<br>';
                $order_message_public .= '<b>Alamat :</b> '. $address .'<br>';
                $order_message_public .= '<hr/>';
                $order_message_public .= '* Harga berikut untuk wilayah JABODETABEK.<br/>';
                $order_message_public .= '* Harga belum termasuk PPn.<br/>';
                $order_message_public .= '* Pihak kami akan segera memproses pemesanan anda, terima kasih.';
                
                // Set object to save 
                $object['name']     = $name;                
                $object['email']    = $email;
                $object['type']     = 'enquiry';
                $object['subject']  = 'Email Enquiry - '.$product_id;                
                $object['subject_to'] = $product_id;
                $object['message']  = $order_message_public;
                $object['phone']    = $phone;
                $object['address']  = $address;
                $object['captcha']  = $this->input->post('captcha');                
                $object['added']    = time();
                $object['status']   = 1;

                $return = $this->ContactHistories->insert($object);

                if ($return) {

                    // Data to send to email notification to admin
                    $message['site_name']       = $this->title_name->value;
                    $message['site_link']       = base_url();
                    $message['header']          = 'Email Enquiry - '.$product_id;
                    $message['messages']        = $order_message_public;
                    $message['site_copyright']  = $this->copyright->value;

                    // Set email subject
                    $subject = $this->title_name->value . ' - Email Enquiry : '. $product_id;

                    // Set email template
                    $email_template = $this->load->view('admin/emails/site_contact',$this->load->vars($message),TRUE);    
                    
                    $from = ADMIN_REPLY;
                    $this->email->clear();
                    $this->email->from($from, $this->title_name->value);
                    $this->email->to($email);
                    $this->email->reply_to($from, $this->title_name->value);
                    $this->email->subject($subject);
                    $this->email->message($email_template);

                    // Check if sent to public
                    if($this->email->send()) { 

                        // Set email message to admin
                        $order_message_admin  = 'Yth <b>'. $this->title_name->value .'</b>, '.$name.' telah melakukan pemesanan produk : <br/><hr/>';
                        $order_message_admin .= '<b>Produk :</b> '. $product_id .'<br/>';
                        $order_message_admin .= $order_message_data;
                        $order_message_admin .= '<b>Email :</b> '. $email .'<br>';
                        $order_message_admin .= '<b>Telepon :</b> '. $phone .'<br>';
                        $order_message_admin .= '<b>Alamat :</b> '. $address .'<br>';                
                        $order_message_admin .= '<hr/>';
                        $order_message_admin .= 'Di mohon segera memproses pemesanan, terima kasih.';

                        // Data to send to email notification to admin
                        $message['site_name']       = $this->title_name->value;
                        $message['site_link']       = base_url();            
                        $message['header']          = 'Email Enquiry';
                        $message['messages']        = $order_message_admin;
                        $message['site_copyright']  = $this->copyright->value;

                        // Set email template
                        $email_template = $this->load->view('admin/emails/site_contact',$this->load->vars($message),TRUE);                                    
                        
                        // Set subject
                        $subject = $this->title_name->value . ' - Email Enquiry : '. $product_id;
                        
                        // Set email to be sent to admin
                        foreach ($this->emails as $key => $value) {
                            $this->email->clear();
                            $this->email->from($from, $this->title_name->value);
                            $this->email->to($value->email);
                            $this->email->reply_to($from, $this->title_name->value);
                            $this->email->subject($subject);
                            $this->email->message($email_template);
                            $this->email->send();
                            usleep(1000);
                        }

                    }          

                    // Set response message
                    $response['data']['referer'] = $this->agent->is_referral() ? $this->agent->referrer() : $this->uri->uri_string();
                    $response['status']  = '1';
                    $response['message'] = 'Telah disimpan, terima kasih untuk pemesanan anda';

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
        $data['result'] = $response;

        // Set Json        
        $data['json']   = $data;

        // Load site template
        $this->load->view('json', $this->load->vars($data));

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
 