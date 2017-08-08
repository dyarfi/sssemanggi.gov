<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_Motorclub extends Public_Controller {

    public function __construct() {
        parent::__construct();      
        // Load site models
        $this->load->model('page/Pages');
        //$this->load->model('admin/ContactHistories');
        //$this->load->model('Captcha');
        
    }
    
    public function index() {
        
        // Set menu detail
        $detail = $this->Pages->find(['name'=>$this->uri->segment(1)]);

        // Set detail page
        $data['detail']       = $detail; 

        // Set data from page menus
        $data['upload_path'] = 'uploads/pagemenus/';                
    
        // Set main template
        $data['main']           = 'page_motorclub';

        // Set data for js files
        //$data['js_files_ext'] = array('https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false');
        
        // Set site title page with module menu
        $data['page_title']   = ($detail->subject) ? $detail->subject : lang('contact_us');
        
        // Set meta description for html tags in template
        $this->meta_description = $this->clean_tags();
        
        // Load admin template
        $this->load->view('template/public/template', $this->load->vars($data));
        
    }

    public function send_contact () {

        // Set menu detail
        $detail = $this->Content->find('page_menus', ['type'=>'contact-us','status'=>'publish']);
        $detail = $detail->{1};

        // Set detail page        
        $data['detail']       = $detail;     

        // Set pages data
        $data['pages'] = $this->Content->find('pages',['menu_id'=>$detail->field_id,'status'=>'publish'],['id'=>'ASC'],500);

        // Set page detail
        $page_detail         = $this->Content->find('pages',['name'=>$this->uri->segment(2),'status'=>'publish'],['id'=>'ASC'],1);
        $data['page_detail'] = $page_detail->{1};
        
        // Default data setup
        $fields = array(
                'name'      => '',
                'email'     => '',
                'subject'   => '',
                'phone'     => '',
                'message'   => '',
                'captcha'   => '');

        $errors = $fields;

        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[24]|xss_clean');
        $this->form_validation->set_rules('email', 'Email','trim|valid_email|required|min_length[5]|max_length[36]|xss_clean');
        $this->form_validation->set_rules('subject', 'Subject','trim|required|min_length[5]|max_length[82]');
        $this->form_validation->set_rules('phone', 'Phone','trim|numeric|required|min_length[5]|max_length[32]');        
        $this->form_validation->set_rules('message', 'Message','trim|required|min_length[5]|max_length[1000]');
        $this->form_validation->set_rules('captcha', 'Captcha', 'trim|xss_clean|max_length[6]|callback_match_captcha');     

        // Check if post is requested
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {           
            
            if ($_FILES) {
                $fields   = array_merge($_POST, $_FILES);
            }
            else {
                $fields   = $_POST;
            }
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
            }
            else
            {
            
                // Set return from database                 
                $return = $this->ContactHistories->setContactHistory($this->input->post());

                if (!empty($return)) {
                    
                    // Data to send to applicants
                    $message['site_name']       = $this->title_name->value;
                    $message['site_link']       = base_url();
                    $message['header']          = lang('thank_you');
                    $message['messages']        = sprintf($this->lang->line('email_contact_message'),$fields['name']);
                    $message['site_copyright']  = $this->copyright->value;

                    // Set email template
                    $email_template = $this->load->view('admin/emails/site_contact',$this->load->vars($message),TRUE);
                    
                    /*
                    $this->email->from('no-reply');
                    $this->email->to($fields['email']);
                    $this->email->reply_to('no-reply');
                    $this->email->subject($this->Settings->getByParameter('title_name')->value.' - '.$data['career']->subject);
                    $this->email->message($email_template);
                    $this->email->send();
                    */

                    // Set email to sent
                    $to      = $fields['email'];
                    
                    // Set subject
                    $subject = $this->title_name->value.' - '.lang('contact_info');

                    $from = str_replace('http://', '','no-reply@'.$_SERVER['HTTP_HOST']); 

                    // To send HTML mail, the Content-type header must be set
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                    // Additional headers
                    // $headers .= 'To: '.$_name.' <'.$_mail.'>' . "\r\n";
                    $headers .= 'From: '.$this->title_name->value.' <'.$from.'>' . "\r\n";
                    $headers .= 'Reply-To: '.$from.' <'.$from.'>' . "\r\n";
                    $headers .= 'X-Mailer: PHP/' . phpversion();
                    
                    // Mail it
                    if(mail($to, $subject, $email_template, $headers)) {

                        // Data to send to email notification to admin
                        $message['site_name']       = $this->title_name->value;
                        $message['site_link']       = base_url();            
                        $message['header']          = lang('information');
                        $message['messages']        = sprintf($this->lang->line('email_contact_message_admin'), $this->title_name->value, $fields['email'], $fields['subject'], $fields['name'], $fields['email'], $fields['subject'], $fields['message']);
                        $message['site_copyright']  = $this->copyright->value;

                        // Set email template
                        $email_template = $this->load->view('admin/emails/site_contact',$this->load->vars($message),TRUE);                                    

                        // Set email to sent
                        $to      = $this->email_info->value;
                        
                        // Set subject
                        $subject = $this->title_name->value.' - '.lang('contact_info');

                        // To send HTML mail, the Content-type header must be set
                        $headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                        // Additional headers
                        // $headers .= 'To: '.$_name.' <'.$_mail.'>' . "\r\n";
                        $headers .= 'From: '.$this->title_name->value.' <'.$from.'>' . "\r\n";
                        $headers .= 'Reply-To: '.$from.' <'.$from.'>' . "\r\n";
                        $headers .= 'X-Mailer: PHP/' . phpversion();

                        mail($to, $subject, $email_template, $headers);
                    }
                } 

                // Set message
                $this->session->set_flashdata('message',lang('message_sent'));

                // Redirect after add
                redirect(base_url('contact-us/page-contact/'.$detail->prefix));

            }

        }   

        // Load js for administrator login
        //$data['js_files'] = array(base_url('assets/admin/scripts/custom/form-user.js'));
        
        // Load JS execution
        //$data['js_inline'] = "FormUser.init();";

        // Set data from page menus
        $data['upload_path'] = 'uploads/pagemenus/';                 

        // Set contact email info data
        $data['email_info']         = $this->Settings->getByParameter('email_info');        
        
        // Set contactus address info data
        $data['contactus_address']  = $this->Settings->getByParameter('contactus_address');

        // Set Param
        $data['param']  = '';

        // Set error data to view
        $data['errors'] = $errors;

        // Post Fields
        $data['fields']     = (object) $fields;

        // Captcha data
        $data['captcha']    = $this->Captcha->image();

        // Main template
        $data['main']       = 'contact_form';       
        
        // Set data for js files
        //$data['js_files_ext'] = array('https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false');

        // Set site title page with module menu
        $data['page_title']   = ($field->{1}->subject) ? $field->{1}->subject : lang('contact_us');

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