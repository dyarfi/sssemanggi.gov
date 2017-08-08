<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_Contact extends Public_Controller {

    public $email ='';

	public function __construct() {
		parent::__construct();
        // Load site models
        $this->load->model('contact/Contacts');
        $this->load->model('admin/ContactHistories');
     	$this->load->model('Captcha');
        // Set email to sent
        $this->emails = $this->Contacts->findAll(['attribute'=>'email_contact_us','status'=>'publish'],'email');
    }

    public function index() {

        // Default data setup
        $fields = array(
                        'name'       => '',
                        'subject_to' => '',
                        'email'      => '',
                        'gender'     => '',
                        'phone'      => '',
                        'fax'        => '',
                        'address'    => '',
                        'subject'    => '',
                        'message'    => '',
                        'captcha'    => ''
                    );

        $errors = $fields;

        $this->form_validation->set_rules('name', 'Nama', 'trim|required|min_length[5]|max_length[24]|xss_clean');
        $this->form_validation->set_rules('subject_to', 'Divisi', 'trim|required|min_length[5]|max_length[128]|xss_clean');
        $this->form_validation->set_rules('email', 'Email','trim|valid_email|required|min_length[5]|max_length[36]|xss_clean');
        $this->form_validation->set_rules('gender', 'Gender','trim|required|xss_clean');
        $this->form_validation->set_rules('phone', 'No.Telp','trim|numeric|required|min_length[5]|max_length[32]');
        $this->form_validation->set_rules('fax', 'Fax','trim|numeric|min_length[5]|max_length[32]');
        $this->form_validation->set_rules('address', 'Alamat','trim|min_length[5]|max_length[255]');
        $this->form_validation->set_rules('subject', 'Subjek','trim|required|min_length[5]|max_length[82]');
        $this->form_validation->set_rules('message', 'Pesan','trim|required|min_length[5]|max_length[1000]');
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
                // Set default value
                $fields['subject_to'] = $this->encrypt->decode($this->input->post('subject_to'));

                // Set return from database
                $return = $this->ContactHistories->setContactHistory($fields);

                if (!empty($return)) {

                    // Remove unwanted string and Set email from
                    //$from = str_replace('http://www.', '','no-reply@'.$_SERVER['HTTP_HOST']);
                    $from = ADMIN_REPLY;

                    // Set subject email
                    $subject = $this->title_name->value.' - '.lang('contact_info');

                    // Data to send to public
                    $message['site_name']       = $this->title_name->value;
                    $message['site_link']       = base_url();
                    $message['header']          = lang('thank_you');
                    $message['messages']        = sprintf($this->lang->line('email_contact_message'),$fields['name']);
                    $message['site_copyright']  = $this->copyright->value;

                    // Set email template
                    $email_template = $this->load->view('admin/emails/site_contact',$this->load->vars($message),TRUE);

                    // Set email to clear first
                    $this->email->clear();

                    // Set email content
                    $this->email->from($from, $this->title_name->value);
                    $this->email->to($fields['email']);
                    $this->email->reply_to($from, $this->title_name->value);
                    $this->email->subject($subject);
                    $this->email->message($email_template);

                    // Check if sent to public
                    if($this->email->send()) {

                        // Data to send to email notification to admin
                        $message['site_name']       = $this->title_name->value;
                        $message['site_link']       = base_url();
                        $message['header']          = lang('information');
                        $message['messages']        = sprintf($this->lang->line('email_contact_message_admin'), $this->title_name->value, $fields['email'], $fields['subject'], $fields['name'], $fields['gender'], $fields['email'], $fields['phone'], $fields['address'], $fields['subject'], $fields['message']);
                        $message['site_copyright']  = $this->copyright->value;

                        // Set email template
                        $email_template = $this->load->view('admin/emails/site_contact',$this->load->vars($message),TRUE);

                        // Set email to sent
                        $to      = $fields['subject_to'];
                        // Set subject
                        $subject = $this->title_name->value.' - '.lang('contact_info');

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

                    } else {

                    }
                }

                // Set message for successfull message sent
                //$this->session->set_flashdata('message',lang('message_sent'));
                $this->session->set_flashdata('message','Terima kasih atas informasi yang Anda sampaikan. Untuk itu, kami akan merespon pertanyaan / permintaan yang Anda kirimkan dengan cepat.');

                // Redirect after send contact form
                redirect(base_url('contact-us/sent'));

            }

        }

        // Set data from page menus
        $email['email_cs']    = $this->Settings->getByParameter('email_cs');
        $email['email_sales'] = $this->Settings->getByParameter('email_sales');

        // Set contact data
        $data['contact_emails'] = $email;

        // Set data from page menus
        $data['upload_path']    = 'uploads/pagemenus/';

        // Set contact email info data
        $data['email_info']         = $this->Settings->getByParameter('email_info');

        // Set contactus address info data
        $data['contactus_address']  = $this->Settings->getByParameter('contactus_address');

        // Set menu detail
        $detail = $this->PageMenus->find(['type'=>$this->uri->segment(1)]);

        // Set detail page
        $data['detail']       = $detail;

        // Set data from page menus
        $data['upload_path'] = 'uploads/pagemenus/';

        // Get all contact list
        $data['contact_list']       = $this->Contacts->findAll(['status'=>'publish','type'=>'head_office'],'*',['id'=>'asc']);

        // Set contact email info data
		$data['email_info']			= $this->Settings->getByParameter('email_info');

		// Set contactus address info data
		$data['contactus_address']	= $this->Settings->getByParameter('contactus_address');

     	// Captcha data
        $data['captcha']	= $this->Captcha->image();

        // Set error data to view
        $data['errors']     = $errors;

        // Post Fields
        $data['fields']     = (object) $fields;

	    // Set main template
		$data['main']       = 'contact';

        // Set data for js files
        //$data['js_files_ext'] = array('https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false');

        // Set site title page with module menu
        $data['page_title']     = ($detail->subject) ? $detail->subject : lang('contact_us');

		// Set meta description for html tags in template
		$this->meta_description = $this->clean_tags();

		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));

	}

    // Set sent page
    public function sent() {

        // Set menu detail
        $detail = $this->PageMenus->find(['type'=>$this->uri->segment(1)]);

        // Set detail page
        $data['detail']       = $detail;

        // Main template
        $data['main']         = 'contact_sent';

        // Set site title page with module menu
        $data['page_title']   = ($detail->subject) ? $detail->subject : lang('contact_us');

        // Admin view template
        $this->load->view('template/public/template', $this->load->vars($data));

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
