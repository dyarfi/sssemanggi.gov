<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Class for ContactHistory
class ContactHistory extends Admin_Controller {
	
    public $_class_name;

    public function __construct() {
	parent::__construct();

		// Set class name
		$this->_class_name = $this->controller;

		//Load user related model
		$this->load->model('ContactHistories');		

    }

    public function index() {		
    	
    	// Set empty query
    	$options = '';

    	// Set if user not a superadmin
    	if ($this->user->group_id > 1) {

    		// Set database query
    		$options = array('id >' => 1);

    	}

    	// Get Contact Historys
		$rows = $this->ContactHistories->getAllContactHistory($options);

		if (@$rows) $data['rows'] = $rows;

		// Data statutes value
		$data['statuses']	= $this->configs['status'];

		// Set class name to view
		$data['class_name'] = $this->_class_name;

		// Main template
		$data['main'] = 'users/contacthistory_index';

		// Set module with URL request 
		$data['module_title'] = $this->module;

		// Set admin title page with module menu
		$data['page_title'] = lang($this->module_menu);

		// Load admin template
		$this->load->view('template/admin/template', $this->load->vars($data));

    }

    public function add(){

		//Default data setup
		$fields = array(
			    'name' => '',
			    'email' => '',
			    'subject' => '',
			    'message' => '',
			    'status' => '');

		$errors = $fields;

		// Set form validation rules
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email','trim|valid_email|required|min_length[5]|max_length[36]|callback_match_email|xss_clean');
	    $this->form_validation->set_rules('subject', 'Subject','trim|xss_clean|max_length[75]');	    	    
	    $this->form_validation->set_rules('message', 'Message','trim|xss_clean|max_length[1000]');	    
	    $this->form_validation->set_rules('status', 'Status','trim|required|xss_clean');

		// Check if post is requested
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			// Validation form checks
			if ($this->form_validation->run() == FALSE) {

			// Set error fields
			$error = array();
			foreach(array_keys($fields) as $error) {
				$errors[$error] = form_error($error);
			}

			// Set previous post merge to default
			$fields = array_merge($fields, $this->input->post());

			} else {

			// Set data to add to database
			$this->ContactHistories->setContactHistory($this->input->post());

			// Set message
			$this->session->set_flashdata('message','Contact History created!');

			// Redirect after add
			redirect('admin/contacthistory');

			}
		}	

		// Set Action
		$data['action'] = 'add';

		// Set Param
		$data['param']	= '';

		// Set error data to view
		$data['errors'] = $errors;

		// Set field data to view
		$data['fields'] = $fields;

		// Data statutes value
		$data['statuses']	= $this->configs['status'];	

		// Post Fields
		$data['fields']	= (object) $fields;

		// Main template
		$data['main']	= 'users/contacthistory_form';		

		// Set class name to view
		$data['class_name'] = $this->_class_name;

		// Set module with URL request 
		$data['module_title'] = $this->module;

		// Set admin title page with module menu
		$data['page_title'] = lang($this->module_menu);

		// Admin view template
		$this->load->view('template/admin/template', $this->load->vars($data));

    }

    public function edit($id=0){

		// Check if param is given or not and check from database
		if (empty($id) || !$this->ContactHistories->getContactHistory($id)) {
			$this->session->set_flashdata('message','Item not found!');
			// Redirect to index
			redirect(base_url().'admin/contacthistory');
		}				

		//Default data setup
		$fields = array(
			    'name' => '',
			    'email' => '',
			    'subject' => '',
			    'message' => '',
			    'status' => '');

		$errors = $fields;

		// Set form validation rules
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email','trim|valid_email|required|min_length[5]|max_length[36]|callback_match_email|xss_clean');
	    $this->form_validation->set_rules('subject', 'Subject','trim|xss_clean|max_length[75]');	    	    
	    $this->form_validation->set_rules('message', 'Message','trim|xss_clean|max_length[1000]');	    
	    $this->form_validation->set_rules('status', 'Status','trim|required|xss_clean');

		// Check if post is requested		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			// Validation form checks
			if ($this->form_validation->run() == FALSE) {

				// Set error fields
				$error = array();
				foreach(array_keys($fields) as $error) {
					$errors[$error] = form_error($error);
				}

				// Set previous post merge to default
				$fields = array_merge($fields, $this->input->post());						

			} else {

				$posts = array(
					'id'=>$id,
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'subject' => $this->input->post('subject'),
					'message' => $this->input->post('message'),					
					'status' => $this->input->post('status')
				);

				// Set data to add to database
				$this->ContactHistories->updateContactHistory($posts);

				// Set message
				$this->session->set_flashdata('message','Contact History updated');

				// Redirect after add
				redirect('admin/contacthistory');

			}

		} else {	

			// Set fields from database
			$fields = $this->ContactHistories->getContactHistory($id);		
		}

		// Set Action
		$data['action'] = 'edit';

		// Set Param
		$data['param']	= $id;

		// Set error data to view
		$data['errors'] = $errors;

		// Set field data to view
		$data['fields'] = $fields;		

		// Set default statuses
		$data['statuses'] = $this->configs['status'];

		// Set form to view
		$data['main'] = 'users/contacthistory_form';			

		// Set class name to view
		$data['class_name'] = $this->_class_name;

		// Set module with URL request 
		$data['module_title'] = $this->module;

		// Set admin title page with module menu
		$data['page_title'] = lang($this->module_menu);

		// Set admin template
		$this->load->view('template/admin/template', $this->load->vars($data));

    }
    public function delete($id){
		// Set delete method in model
		$this->ContactHistories->deleteContactHistory($id);
		// Set flash message to display
		$this->session->set_flashdata('message','Contact History deleted');
		// Redirect to index
		redirect('admin/contacthistory');
    }	

    public function view($id=null){

		if (empty($id) && (int) $id == 0) {
			$this->session->set_flashdata('message',"Error submission.");
			redirect("contachistory","refresh");
		}

		$contachistories = $this->ContactHistories->getContactHistory($id);
		if (!count($contachistories)){
			redirect(ADMIN.'dashboard/index');
		}

		// Set Param
		$data['param']	= $id;

		// Listing data
		$data['listing']  = $this->ContactHistories->getContactHistory($id);

		// Set default statuses
		$data['statuses'] = $this->configs['status'];

		// Set default enum
		$data['options'] = $this->configs['enum_default'];

		// Set class name to view
		$data['class_name'] = $this->_class_name;

		// Main template
		$data['main']	= 'users/contacthistory_view';

		// Set module with URL request 
		$data['module_title'] = $this->module;

		// Set admin title page with module menu
		$data['page_title'] = lang($this->module_menu);

		// Set admin template
		$this->load->view('template/admin/template', $this->load->vars($data));
    }

    // Action for update item status
    public function change() {	
		if ($this->input->post('check') !='') {
			$rows	= $this->input->post('check');
			foreach ($rows as $row) {
				// Set id for load and change status
				$this->ContactHistories->setStatus($row,$this->input->post('select_action'));
			}
			// Set message
			$this->session->set_flashdata('message','Status changed!');
			redirect(ADMIN.$this->_class_name.'/index');
		} else {	
			// Set message
			$this->session->set_flashdata('message','Data not Available');
			redirect(ADMIN.$this->_class_name.'/index');			
		}
    }

    public function ajax($action='') {

	//Check if the request via AJAX
	if (!$this->input->is_ajax_request()) {
		exit('No direct script access allowed');		
	}	

	//Define initialize result
	$result['result'] = '';

	//Update user profile via Ajax
	if ($action == 'update' && $this->input->post() !== '') {

		//Set User Data
		$user_profile = $this->UserProfiles->setUserProfiles($this->input->post());

		//Reload session if the user is logged in
		//Set session data
		//$this->session->set_userdata($user_profile);

		if (!empty($user_profile) && $user_profile->status === 'active') {

			$result['result']['code'] = 1;
			$result['result']['text'] = 'Changes saved !';

		} else if (!empty($user_profile) && $user->status !== 'active') { 

			$result['result']['code'] = 2;
			$result['result']['text'] = 'Your account profile is not active';			

		} else {

			$result['result']['code'] = 0;
			$result['result']['text'] = 'Profile not found';			
		}

	}

	// Load json template
	$data['json'] = $result;

	// Load admin template for json output
	$this->load->view('json', $this->load->vars($data));	
    }
		
}