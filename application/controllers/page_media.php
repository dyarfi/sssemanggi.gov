<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_Media extends Public_Controller {

	public function __construct() {
		parent::__construct();
        // Load site models
        $this->load->model('contact/Contacts');
        $this->load->model('Captcha');
        $this->load->model('member/Members');

        // Load Region models
        $this->load->model('region/Provinces');
        //$this->load->model('region/Suburbans');
        //$this->load->model('region/Urbandistricts');
        //$this->load->model('region/Districts');

        // Set the member data from session
        $this->member = $this->session->userdata('member_session');

        // Set email to sent
        $this->emails = $this->Contacts->findAll(['attribute'=>'email_register','status'=>'publish'],'email');

    }

    public function index() {

        // Default data setup
        $fields = array(
                'firstname' => '',
                'lastname'  => '',
                'gender'    => '',
                'birthdate' => '',
                'email'     => '',
                'password'  => '',
                'password2' => '',
                'phone'     => '',
                'province'      => '',
                'urbandistrict' => '',
                'suburban'      => '',
                'address'       => '',
                'captcha'   => '');

        $errors = $fields;

        $this->form_validation->set_rules('firstname', 'Nama Awal', 'trim|required|min_length[5]|max_length[24]|xss_clean');
        $this->form_validation->set_rules('lastname', 'Nama Akhir', 'trim|required|min_length[5]|max_length[24]|xss_clean');

        $this->form_validation->set_rules('gender', 'Gender','trim|required|min_length[1]|max_length[32]');
        $this->form_validation->set_rules('birthdate', 'Tanggal Lahir','trim|required|min_length[1]|max_length[32]');
        $this->form_validation->set_rules('email', 'Email','trim|valid_email|required|min_length[5]|max_length[36]|xss_clean');

        $this->form_validation->set_rules('password', 'Password', 'required|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password Confirmation','trim|required|min_length[5]|max_length[82]');

        $this->form_validation->set_rules('phone', 'No.Telp','trim|numeric|required|min_length[5]|max_length[32]');

        $this->form_validation->set_rules('address', 'Alamat Lengkap','trim|required|xss_clean|max_length[350]');
        $this->form_validation->set_rules('province', 'Propinsi','trim|required');
        $this->form_validation->set_rules('urbandistrict', 'Kabupaten','trim|required');
        $this->form_validation->set_rules('suburban', 'Kecamatan','trim|required');

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
                $object['type']            = 'Media';
                $object['identity']        = 'Email';

                // Momy's data
                $object['fullname']        = $fields['firstname'] .' '. $fields['lastname'];
                $object['username']        = $fields['email'];
                $object['email']           = $fields['email'];
                $object['password']        = sha1($fields['password']);

                // Account Profile
                $object['gender']          = $fields['gender'];
                $object['birthdate']       = $fields['birthdate'];

                // Address Contact
                $object['province']        = $fields['province'];
                $object['urbandistrict']   = $fields['urbandistrict'];
                $object['suburban']        = $fields['suburban'];
                $object['address']         = $fields['address'];

                // Phones
                $object['phone_number']    = $fields['phone'];

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

                if (!empty($return)) {

                    // Data to send to applicants
                    $message['site_name']       = $this->title_name->value;
                    $message['site_link']       = base_url();
                    $message['header']          = lang('account_registration');
                    $message['messages']        = sprintf($this->lang->line('email_account_activation'), base_url('media-room/confirm/'.base64_encode($object['verify']."-:-".$object['email'])));
                    $message['site_copyright']  = $this->copyright->value;

                    // Set email template
                    $email_template = $this->load->view('admin/emails/site_contact',$this->load->vars($message),TRUE);

                    // Set email to sent
                    $to      = $fields['email'];

                    // Set subject
                    $subject = $this->title_name->value.' - '.lang('account_registration');

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
                        $message['header']          = lang('account_registration');
                        $message['messages']        = sprintf($this->lang->line('email_account_activation_admin'), $this->title_name->value, $object['fullname']);
                        $message['site_copyright']  = $this->copyright->value;

                        // Set email template
                        $email_template = $this->load->view('admin/emails/site_contact',$this->load->vars($message),TRUE);

                        // Set email to sent
                        $to      = $this->email_info->value;

                        // Set subject
                        $subject = $this->title_name->value.' - '.lang('account_registration');

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
                }

                // Set message
                $this->session->set_flashdata('message', lang('check_email_activation'));

                // Redirect after add
                redirect(base_url('media-room/sent'));

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
        $data['js_inline'] = '$( "#birthdate" ).datepicker({dateFormat: "dd/mm/yy",changeMonth:true,changeYear:true,yearRange:"-65:+0",});';

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

        // Get all contact list
        $data['contact_list']       = $this->Contacts->findAll(['status'=>'publish'],'*',['id'=>'asc']);

        // Set contact email info data
		$data['email_info']			= $this->Settings->getByParameter('email_info');

		// Set contactus address info data
		$data['contactus_address']	= $this->Settings->getByParameter('contactus_address');

     	// Captcha data
        $data['captcha']		= $this->Captcha->image();

        // Set main template
		$data['main']           = $this->member ? 'media_room_page' : 'media_room';

        // Set data for js files
        //$data['js_files_ext'] = array('https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false');

        // Set site title page with module menu
        $data['page_title']   = ($detail->subject) ? $detail->subject : lang('media');

		// Set meta description for html tags in template
		$this->meta_description = $this->clean_tags();

		// Load admin template
		$this->load->view('template/public/template', $this->load->vars($data));

	}

    public function login () {

        // Default data setup
        $fields = array(
                'email_login'     => '',
                'password_login'  => '');

        // Set default errors
        $errors = $fields;

        // Set default user
        $user   = '';

        // POST checking
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $fields = $_POST;

            $this->form_validation->set_rules('email_login', 'Email', 'trim|required|valid_email|min_length[5]|max_length[40]|xss_clean');
            $this->form_validation->set_rules('password_login', 'Password','trim|required|min_length[5]|max_length[40]|xss_clean');

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

                $result['errors'] = $errors;
            }
            else
            {

                // Reset to original fields
                $fields['email']    = $this->input->post('email_login');
                $fields['password'] = $this->input->post('password_login');

                // Check post data
                $user = $this->Members->login($fields);

                // Set message
                // $this->session->set_flashdata('message','User created!');

                $result['result']['code'] = 1;
                $result['result']['text'] = 'Logged In';

                // Redirect after add
                // redirect(ADMIN. $this->controller . '/index');

            }

            // User data checking
            if(!empty($user)) {

                if ($user == 'disabled') {

                    // Send notification result
                    $result['result']['code'] = 2;
                    $result['result']['text'] = 'Akun anda telah di '.$user;

                    // Set flash message to disabled account
                    // $this->session->set_flashdata('flashdata', 'Your account is disabled!');
                    // Redirect to login
                    // redirect(ADMIN.'authenticate/login');
                }

                $user_session->id = $user->id;
                $user_session->username = $user->username;
                $user_session->email = $user->email;
                // $user_session->group_id = $user->group_id;
                $user_session->status = $user->status;
                $user_session->last_login = $user->last_login;
                //$user_session->logged_in = true;
                //$user_session->name = $this->UserProfiles->getName($user->id);

                $ci_session = array(
                    'member_session'      => $user_session,
                );

                //Set session data
                $this->session->set_userdata($ci_session);

                // Redirect to page
                //redirect(base_url('media-room'));

            } else {

                // Send notification result
                $result['result']['code'] = 2;
                $result['result']['text'] = 'Tidak ada user dengan akun tersebut';

                $this->session->set_flashdata('flashdata', $userObj);

                // Redirect to page
                //redirect(base_url('media-room'));

            }
        }

        // Set error data to view
        $data['errors']     = $errors;

        // Post Fields
        $data['fields']     = (object) $fields;

        // Return data esult
        $data['json'] = $result;

        // Load data into view
        $this->load->view('json', $this->load->vars($data));

    }

    public function logout() {

        // Unset session members
        $this->session->unset_userdata('member_logged_in');
        $this->session->unset_userdata('member_logged_in_id');
        $this->session->unset_userdata('member_session');
        unset($this->member);
        // Redirect
        redirect(base_url());

    }

    // Account activation method
    public function activation($confirm='') {

        // Get activation code
        $confirm = base64_decode($confirm);
        $params  = explode("-:-",$confirm);

        // Set array for query
        $activation['verify']   = $params[0];
        $activation['email']    = $params[1];

        $activated = $this->Members->getActivation($activation);

        if (!empty($activated) && $activated->completed == 0) {

            // Unset first for duplication session
            $this->session->unset_userdata('participant');

            // Set user data session
            $this->session->set_userdata('participant', $activated);

            // Set flash message
            $this->session->set_flashdata('message',lang('account_activated'));

            // Redirect to dashboard
            redirect(base_url('media-room'));

        } else {

            // Set message
            $this->session->set_flashdata('message',lang('account_not_listed'));

            // Redirect to user page
            redirect(base_url('media-room'));

        }

    }

    // Set sent page
    public function sent() {

        // Set menu detail
        $detail = $this->PageMenus->find(['type'=>$this->uri->segment(1)]);

        // Set detail page
        $data['detail']       = $detail;

        // Main template
        $data['main']       = 'media_sent';

        // Set site title page with module menu
        $data['page_title']   = ($detail->subject) ? $detail->subject : lang('media');

        // Admin view template
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
