<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends Public_Controller {

	public function __construct() {
		parent::__construct();
        // Load site models
        $this->load->model('Captcha');
        $this->load->model('member/Members');
        $this->load->model('contact/Contacts');

        // Load Region models
        $this->load->model('region/Provinces');
        $this->load->model('region/Suburbans');
        $this->load->model('region/Urbandistricts');
        $this->load->model('region/Districts');

		// Set email to sent
		$this->emails = $this->Contacts->findAll(['attribute'=>'email_register','status'=>'publish'],'email');
    }

    public function index() {

        // Set result returned data
        $result = '';

        // Default data setup
        $fields = array(
                    'name_newsletter' => '',
                    'email_newsletter'    => '',
                    'phone_newsletter'    => '',
                    'province'      => '',
                    'urbandistrict' => '',
                    'suburban'      => '',
                    'address_newsletter'  => '',
                    'information'   => '',
                    'product'       => '',
                    'terms'         => '',
                    'captcha'       => '',
                );

        $errors = $fields;

        $this->form_validation->set_rules('name_newsletter', 'Nama', 'trim|required|min_length[5]|max_length[24]|xss_clean');
        $this->form_validation->set_rules('email_newsletter', 'Email','trim|valid_email|required|min_length[5]|max_length[36]|xss_clean');
        $this->form_validation->set_rules('phone_newsletter', 'No. Telephone / HP','trim|numeric|required|min_length[5]|max_length[32]');
        $this->form_validation->set_rules('province', 'Propinsi','trim|required');
        $this->form_validation->set_rules('urbandistrict', 'Kabupaten','trim|required');
        $this->form_validation->set_rules('suburban', 'Kecamatan','trim|required');
        $this->form_validation->set_rules('address_newsletter', 'Alamat','trim|required|xss_clean|min_length[5]|max_length[350]');
        $this->form_validation->set_rules('information', 'Informasi','trim|required|xss_clean|max_length[350]');
        $this->form_validation->set_rules('product', 'Produk','trim|required|xss_clean|max_length[350]');
        $this->form_validation->set_rules('terms', 'Terms','trim|required|xss_clean|max_length[1]');
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

                $object = array();

                // Main Members Identity
                $object['type']            = 'Subscriber';
                $object['identity']        = 'Email';

                // Subscriber data
                $object['fullname']        = $fields['name_newsletter'];
                $object['username']        = $fields['email_newsletter'];
                $object['email']           = $fields['email_newsletter'];
                $object['about']           = $fields['information'];
                $object['research_area']   = $fields['product'];

                // Account Profile
                $object['gender']          = $fields['gender'];
                $object['birthdate']       = $fields['birthdate'];

                // Address Contact
                $object['province']        = $fields['province'];
                $object['urbandistrict']   = $fields['urbandistrict'];
                $object['suburban']        = $fields['suburban'];
                $object['address']         = $fields['address_newsletter'];

                // Phones
                $object['phone_number']    = $fields['phone_newsletter'];

                // Status
                $object['verify']          = $fields['captcha'];
                $object['confirmation_hash'] = 'NULL';
                $object['confirmation_code'] = 'NULL';
                $object['confirmed']         = '0';
                $object['approved']          = '0';

                $object['status']          = '1';
                $object['completed']       = '0';

                // Set Member data
                $return = $this->Members->setMember($object);
                $member = $this->Members->get($return);

                if (!empty($return)) {

                    // Data to send to applicants
                    $message['site_name']       = $this->title_name->value;
                    $message['site_link']       = base_url();
                    $message['header']          = lang('account_registration');
                    // $message['messages']     = sprintf($this->lang->line('subscribe_email'), $object['username']);
                    $message['messages']        = 'Yth <b>'.$member->fullname.'</b>, Terima kasih atas pendaftaran anda di <b>Suzuki Update</b>. Anda akan segera mendapatkan berita promo dan info menarik seputar produk Suzuki. Berikut data diri anda :<hr>Nama : '.$member->fullname.'<br>Email : '.$member->email.'<br>Handphone : '.$member->phone_number.'<br>Propinsi : '.$this->Provinces->getProvince($member->province)->name.'<br>Kabupaten : '.$this->Urbandistricts->getUrbanDistrict($member->urbandistrict)->name.'<br>Kecamatan : '.$this->Suburbans->getSubUrban($member->suburban)->name.'<br>Alamat : '.$member->address.'<br>Informasi : '.$member->about.'<br>Produk : '.$member->research_area;
                    $message['site_copyright']  = $this->copyright->value;

                    // Set email template
                    $email_template = $this->load->view('admin/emails/site_contact',$this->load->vars($message),TRUE);

                    // Set email to sent
                    $to      = $object['email'];

                    // Set subject
                    $subject = $this->title_name->value.' - Suzuki Update';

                    // Remove unwanted string and Set email from
                    //$from = str_replace('http://www.', '','no-reply@'.$_SERVER['HTTP_HOST']);
                    $from = ADMIN_REPLY;

                    // Set email to clear first
                    $this->email->clear();

                    // Set email content
                    $this->email->from($from, $this->title_name->value);
                    $this->email->to($to);
                    $this->email->reply_to($from, $this->title_name->value);
                    $this->email->subject($subject);
                    $this->email->message($email_template);

                    // Check if sent to public
                    if($this->email->send()) {

                        // Data to send to email notification to admin
                        $message['site_name']       = $this->title_name->value;
                        $message['site_link']       = base_url();
                        $message['header']          = 'Suzuki Update';
                        //$message['messages']        = sprintf($this->lang->line('subscribe_email_admin'), $this->title_name->value, $object['username']);
                        $message['messages']        = 'Yth <b>'.$this->title_name->value.'</b>, <b>'.$member->fullname.'</b> telah mendaftarkan diri ke <b>Suzuki Update</b>.<hr>Nama : '.$member->fullname.'<br>Email : '.$member->email.'<br>Handphone : '.$member->phone_number.'<br>Propinsi : '.$this->Provinces->getProvince($member->province)->name.'<br>Kabupaten : '.$this->Urbandistricts->getUrbanDistrict($member->urbandistrict)->name.'<br>Kecamatan : '.$this->Suburbans->getSubUrban($member->suburban)->name.'<br>Alamat : '.$member->address.'<br>Informasi : '.$member->about.'<br>Produk : '.$member->research_area;
                        $message['site_copyright']  = $this->copyright->value;

                        // Set email template
                        $email_template = $this->load->view('admin/emails/site_contact',$this->load->vars($message),TRUE);

                        // Set email to sent
                        $to      = $this->email_info->value;

                        // Set subject
                        $subject = $this->title_name->value.' - Suzuki Update';

						// Clear queue first
                        $this->email->clear();
                        // Set email from
                        $this->email->from($from, $this->title_name->value);
                        // Set email to main contact first
                        $this->email->to($from);

                        // Set arrays of bcc's emails
                        $bcc_emails = '';
                        foreach ($this->emails as $key => $value) {
                            $bcc_emails[] = $value->email;
                        }

                        // Set email to bcc
                        $this->email->bcc($bcc_emails);
                        $this->email->reply_to($from, $this->title_name->value);
                        $this->email->subject($subject);
                        $this->email->message($email_template);
                        // Send email to main email and bccs
                        $this->email->send();
                        // Clear queue
                        $this->email->clear();

                    }

                    //print_r($this->email->print_debugger());
                    //exit;

                }

                // Set sent data
                $result = 'sent';

                // Set message
                //$this->session->set_flashdata('message', lang('subscribe_send'));
                $this->session->set_flashdata('message', 'Terima kasih Anda telah mendaftarkan diri anda di Suzuki Update');

            }

            // Check if the request via AJAX
            if ($this->input->is_ajax_request()) {

                $json['result'] = $result;

                if (!$result) {

                    $json['errors'] = $errors;
                }

                echo json_encode($json);
                exit;

            }  else {
                // Redirect after add
                redirect(base_url());
            }

        }

        // Load css in controller
        $data['css_files_ext'] = array(
            base_url('assets/public/css/jquery-ui.css')
            );

        // Load js in controller
        $data['js_files_ext'] = array(
            base_url('assets/public/js/libs/jquery-ui-1.11.0.min.js'),
            base_url('assets/public/js/libs/jquery.datepicker-min.js')
            );

        // Load JS execution
        $data['js_inline'] = '$( "#birthdate" ).datepicker({changeMonth:true,changeYear:true,yearRange:"-65:+0",});';

        // Set data from page menus
        $data['upload_path'] = 'uploads/pagemenus/';

        // Set contact email info data
        $data['email_info']         = $this->Settings->getByParameter('email_info');

        // Set contactus address info data
        $data['contactus_address']  = $this->Settings->getByParameter('contactus_address');

        // Set error data to view
        $data['errors']     = $errors;

        // Post Fields
        $data['fields']     = (object) $fields;

        // Set menu detail
        $detail = $this->PageMenus->find(['type'=>$this->uri->segment(1)]);

        // Set detail page
        $data['detail']       = $detail;

        // Set contact email info data
		$data['email_info']			= $this->Settings->getByParameter('email_info');

		// Set contactus address info data
		$data['contactus_address']	= $this->Settings->getByParameter('contactus_address');

     	// Captcha data
        $data['captcha']		= $this->Captcha->image();

        // Set main template Data for province
        $data['provinces']      = $this->Provinces->getAllProvince();

	    // Set main template
		$data['main']           = 'media_room';

        // Set data for js files
        //$data['js_files_ext'] = array('https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false');

        // Set site title page with module menu
        $data['page_title']   = ($detail->subject) ? $detail->subject : lang('contact_us');

		// Set meta description for html tags in template
		$this->meta_description = $this->clean_tags();

		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));

	}

    // -------------- CALLBACK METHODS -------------- //

    // Match Email post to Database
    public function match_email($email) {

        // Check email if empty
        if ($email == '') {
            $this->form_validation->set_message('match_email', 'The %s can not be empty.');
            return false;
        }
        // Check email if match
        else if ($this->Participants->getEmail($email) == 1) {
            $this->form_validation->set_message('match_email', 'The %s is already taken. <a href="'.base_url('account/forgot_password/?confirm='.base64_encode($email)).'" class="forgot-password">Forgot Password</a> Maybe ?');
            return false;
        } else {
            return true;
        }

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

/* End of file site_contact.php */
/* Location: ./application/controllers/site_contact.php */
