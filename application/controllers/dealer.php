<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dealer extends Public_Controller {

	public function __construct() {
		parent::__construct();
        // Load site models
        $this->load->model('Captcha');
        $this->load->model('member/Members');
        $this->load->model('member/Notifications');
        $this->load->model('product/Products');
        $this->load->model('product/ProductModels');
        $this->load->model('service/Dealers');
        $this->load->model('service/DealerNetworks');
        $this->load->model('service/Bookings');
        $this->load->model('newscenter/News');

        // Load Region models
        //$this->load->model('region/Provinces');
        //$this->load->model('region/Suburbans');
        //$this->load->model('region/Urbandistricts');
        //$this->load->model('region/Districts');

        // Set the member data from session
        // Set member public data
        // $this->member    = self::_getMember($this->member->id);
        // $this->member = $this->DealerNetworks->with('news')->with('bookings')->findBy('dealer_member_id',$this->member->id);
        $this->member = $this->Members->get($this->member->id);

        // Check if member is dealer
        if($this->member->type == 'Service' || $this->session->userdata('member_logged_in_id') =='') {
            // Redirect if user member is a dealer
            redirect(base_url('services/auth/signout'));
        }

    }

    public function index() {

        // Set Date Period
        $currentDate = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
        //$currentDate->modify('+ 2 days');
        $currentDate = new DateTime($currentDate->format( 'd-m-Y' ), new DateTimeZone('Asia/Jakarta'));
        $availableInterval = new DateInterval('P0D');
        $availableDate = $currentDate;
        $availableDate->add($availableInterval);
        $rangeInterval = new DateInterval('P6D');
        $rangeDate = new DateTime($availableDate->format( 'd-m-Y' ), new DateTimeZone('Asia/Jakarta'));
        $rangeDate->add($rangeInterval);
        $periodsEnd = new DateTime($availableDate->format( 'd-m-Y' ), new DateTimeZone('Asia/Jakarta'));
        $periods = new DatePeriod(
            $availableDate,
            new DateInterval('P1D'),
            $periodsEnd->add(new DateInterval('P80D'))
        );
        //$months = [];
        //$days = [];
        //foreach ($periods as $period) {
            //$months[$period->format('F')][$period->format('U')] = date('d-m-Y',$period->format('U'));
        //}

        // Start year period from 2010 to now year
        $begin          = new DateTime( '2008-12-31 23:59:59' );
        $end            = new DateTime( 'NOW' );
        // 1 Year Period
        $intervalYear   = DateInterval::createFromDateString('1 year + 1 day');
        $years          = new DatePeriod($begin, $intervalYear, $end, DatePeriod::EXCLUDE_START_DATE);


        // ----- GET THE YEAR FIRST --------
        // Set selected time for month
        $year   = $this->input->get('year') != '' ? $this->input->get('year') : date('Y');

        // ----- GET THE MONTH SECOND ------
        // Set selected time for month
        $month  = $this->input->get('month') != '' ? $this->input->get('month') : date('F');

        // Get input year before and set the date after
        $dque   = $year != date('Y') ? $year : date('Y');
        // Start Date
        $sque   = new DateTime( $year.'-01-01 23:59:59 + 1 month + 1 day' );
        // End Date
        $eque   = new DateTime( $year.'-12-01 00:00:00' );
        // Current date
        $cque   = new DateTime( date('Y').'-'.$month.'-01 23:59:59' );
        // Differentiate Date
        $interval = $sque->diff($begin);
        // Add interval in Start Date
        $eque->add($interval);

        $_intervalYear   = DateInterval::createFromDateString('-'.$interval->y.' years');
        $periods = new DatePeriod(
            new DateTime( $year.'-01-01 23:59:59' ),
            new DateInterval('P1D'),
            new DateTime( $year.'-12-31 23:59:59' )
        );

        //unset($months);
        foreach ($periods as $period) {
            $months[$period->format('F')][$period->format('U')] = date('d-m-Y',$period->format('U'));
            //echo $period->format('Y-m-d H:i:s').'<br/>';
        }
        //print_r($months);
        //exit;

        // ----- GET THE YEAR AND MONTH IF EXISTED -----
        // Set selected time for date
        $date   = $this->input->get('date') != '' ? $this->input->get('date') : $cque->format('d-m-Y');

        // If the Dealers select month other than the current month date if the current date
        if ($year != '' && $year != date('Y')) {

            //$month = 'January';
            $qmonth = date('m',strtotime($month));
            $qdate = date('d-'.$qmonth.'-'.$year,$date);
            $date  = date('d-m-Y',strtotime($qdate));
        }
        else if ($year == '' && $month != date('F') && $this->input->get('date') == '') {

            $date_tmp = strtotime('01-'.$month.'-'.date('Y'));
            $date = date('d-m-Y',$date_tmp);
        // Check if year existed and not the same as the current
        } else if ($this->input->get('year') != '' && $year != date('Y') && $month != date('F')) {

            $month = ($month != 'January') ? $month : 'January';
            $qmonth = date('m',strtotime($month));
            $qdate = date('d-'.$qmonth.'-'.$year,$date);
            $date  = date('d-m-Y',strtotime($qdate));

        // Check if month is in query and the date not requested yet
        } else if ($year != date('Y') && $month == date('F') && $this->input->get('date') == '') {

            // $date = date('d-m-Y');
            $qmonth = date('m',strtotime($month));
            $qdate = date('d-'.$qmonth.'',$date);
            $date  = date('d-m-Y',strtotime($qdate.'-'.$year));

        // Or else set today's date
        } else {

            //print_r($date < date('d-m-Y'));

            if ($month == date('F') && $this->input->get('date') == '') {

                $date = date('d-m-Y');

            } else {

                $date = ($date != date('d-m-Y') ? $date : date('d-m-Y'));

            }

        }

        // Set if the date que if less than current date
        $data['outofdate']  = (strtotime($date) >= strtotime(date('d-m-Y'))) ? 1 : 0;
        // Selected period
        $data['year_que']   = $year;
        $data['month_que']  = $month;
        $data['date_que']   = $date;
        // Display Periods
        $data['months']     = $months;
        $data['years']      = $years;

        // Load css in controller
        $data['css_files_ext'] = array(
            base_url('assets/public/css/jquery-ui.css'),
            base_url('assets/public/css/jquery.datetimepicker.min.css')
            );

        // Load js in controller
        $data['js_files_ext'] = array(
            base_url('assets/public/js/libs/jquery-ui-1.11.0.min.js'),
            base_url('assets/public/js/libs/jquery.datepicker-min.js'),
            base_url('assets/public/js/libs/jquery.datetimepicker.full.min.js'),
            base_url('assets/public/js/libs/ckeditor/ckeditor.js'),
            base_url('assets/public/js/libs/ckeditor/adapters/jquery.js'),
            base_url('assets/public/js/libs/ckeditor/config.js'),
            base_url('assets/public/js/libs/push.js/push.min.js')
            );

        // Load JS execution
        // $data['js_inline'] = "";

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
                                    '11'=>'Paket D (Kelipatan 40000 KM)',
									'12'=>'Suzuki Product Quality Update'
                                ];

        // Set news with dealer data
        $data['rows']         = $this->News->with('member')->find_all(['type'=>'svc-artc','user_id !='=>'0','status'=>'publish'], '*', ['id'=>'added']);

        // Set dealer data
        $dealer               = $this->DealerNetworks->findBy('dealer_member_id',$this->member->id);
        $data['dealer']       = $dealer;

        // Set dealer data
        $dealer_config         = json_decode($this->member->attribute);
        $data['dealer_config'] = $dealer_config;

        // Setting the limit of the booking order
        $l = $dealer_config->setting_three->value;
        $l = ($l == 0 || $l == '') ? $dealer_config->setting_three->default : $l;

        // Set dealer booking data
        $dealer_bookings = $this->Bookings->findAll(['dealer_id'=>$dealer->id,'date'=>strtotime($date)],'*',['id'=>'ASC']);
        $bookings = [];
        for($i=$dealer_config->setting_four->value;$i<$dealer_config->setting_five->value;$i++) {
            $_bookings[$i] = '';
            $b=0;
            foreach ($dealer_bookings as $key => $books) {
                if($i == $books->time) {
                    $_bookings[$i][]  = $dealer_bookings[$key];
                } //else {
                    //$bookings[$i][] = '';
                //}
                $b++;
            }
        }
        foreach ($_bookings as $_books => $mil) {
            for($m=0;$m<$l;$m++){
                if ($_bookings[$_books][$m]) {
                    $bookings[$_books] = $mil;
                } else {
                    $bookings[$_books][$m] = '';
                }
            }
        }

        // Set vehicles data
        $data['vehicles'] = $this->Products->findAll(['status !='=>'deleted','type'=>'automobile'],'id,url,subject',['subject'=>'ASC']);

        // Set dealer booking data
        $data['dealer_bookings']       = $bookings;

        // Set dealer data
        $data['dealer_blog']  = $this->News->findAllBy('user_id',$this->member->id);

        // Set dealer data
        $data['notifications'] = $this->Notifications->findAll(['user_id'=>$dealer->id,'status'=>2],'*',['id'=>'DESC']);

        // Set contact email info data
		$data['email_info']			= $this->Settings->getByParameter('email_info');

		// Set contactus address info data
		$data['contactus_address']	= $this->Settings->getByParameter('contactus_address');

     	// Captcha data
        $data['captcha']		= $this->Captcha->image();

        // Set main template
		//$data['main']           = $this->member ? 'media_room_page' : 'media_room';
        $data['main']           = 'services/page/dealer/dealer';

        // Set data for js files
        //$data['js_files_ext'] = array('https://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false');

        $data['js_inline']      ="
        var refreshId = setInterval(function() {
        $.ajax({
                type:'POST',
                dataType: 'json',
                url: base_URL + 'xhr/get_notification',
                data: { dealer_id : $('.push_notification').attr('id') },
                success: function(message){
                    var response = message.response;
                    if (response.data !== false && typeof response.data !== 'undefined') {
                        if ($('.push_notification').find('ul li').not('[name!='+response.data.id+']')) {
                            $('.push_notification').find('ul li:eq(0)').before('<li id=\"'+response.data.id+'\"><span class=\"fa fa-check\" aria-hidden=\"true\"></span> '+response.data.text+'</li>');
                            Push.create('', {
                                body: response.data.text,
                                icon: {
                                    x16: base_URL + 'assets/static/img/logo-suzu.jpg',
                                    x32: base_URL + 'assets/static/img/logo-suzu.jpg'
                                },
                                timeout: 5000
                            });
                        }
                    }
              }
        });
    }, 30000);";

        /*
    var refreshId = setInterval(function() {
        $.ajax({
                type:'POST',
                dataType: "json",
                url: base_URL + "xhr/get_notification",
                data: { dealer_id : $(".push_notification").attr('id') },
                success: function(message){
                    var response = message.response;
                    if (response.data !== false && typeof response.data !== "undefined") {
                        if ($('.push_notification').find('ul li').not('[name!='+response.data.id+']')) {
                            $('.push_notification').find('ul li:eq(0)').before('<li id="'+response.data.id+'"><span class="fa fa-check" aria-hidden="true"></span> '+response.data.text+'</li>');
                            Push.create('', {
                                body: response.data.text,
                                icon: {
                                    x16: base_URL + 'assets/static/img/logo-suzu.jpg',
                                    x32: base_URL + 'assets/static/img/logo-suzu.jpg'
                                },
                                timeout: 5000
                            });
                        }
                    }
              }
        });
    }, 20000);
    //console.log(refreshId);
    */
        // Set site title page with module menu
        $data['page_title'] =  lang('Dealer') . ($detail->subject ? ' - '.$detail->subject : '');

        // Set meta description for html tags in template
        $this->meta_description = $this->clean_tags($detail->text);

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
            $this->form_validation->set_rules('password_login', 'Password','trim|required|min_length[4]|max_length[40]|xss_clean');

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
                $member = $this->DealerNetworks->login($fields);

                // Set message
                // $this->session->set_flashdata('message','User created!');

                $result['result']['code'] = 1;
                $result['result']['text'] = 'Logged In';

                // Redirect after add
                // redirect(ADMIN. $this->controller . '/index');

            }

            // User data checking
            if(!empty($member)) {

                if ($member == 'disabled') {

                    // Send notification result
                    $result['result']['code'] = 2;
                    $result['result']['text'] = 'Akun anda telah di '.$member;

                    // Set flash message to disabled account
                    // $this->session->set_flashdata('flashdata', 'Your account is disabled!');
                    // Redirect to login
                    // redirect(ADMIN.'authenticate/login');
                }

                $user_session->id = $member->id;
                $user_session->fullname = $member->fullname;
                $user_session->email = $member->email;

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
        redirect(base_url('services/auth/signout'));

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

    // Set update booking
    public function booking_update() {

        // Set detail page
        $data['detail']       = $detail;

        // Main template
        $data['main']       = 'media_sent';

        // Set site title page with module menu
        $data['page_title']   = ($detail->subject) ? $detail->subject : lang('media');

        // Admin view template
        $this->load->view('template/public/template', $this->load->vars($data));

    }

    // Export booking data by Dealer
    public function book_export($date_book='',$member_id="") {

        // Set service type
        $service_type   = [
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
                                ];

        // Set dealer data
        $member                = $this->Members->get($member_id);
        $dealer                = $this->DealerNetworks->findBy('dealer_member_id',$member_id);

        $dealer_config         = json_decode($member->attribute);

        // Setting the limit of the booking order
        $l = $dealer_config->setting_three->value;

        // Set dealer booking data
        $dealer_bookings = $this->Bookings->findAll(['dealer_id'=>$dealer->id,'date'=>strtotime($date_book)],'*',['id'=>'ASC']);
        //print_r($dealer_bookings);
        //exit;
        $bookings = [];
        for($i=$dealer_config->setting_four->value;$i<$dealer_config->setting_five->value;$i++) {
            $_bookings[$i] = '';
            $b=0;
            foreach ($dealer_bookings as $key => $books) {
                if($i == $books->time) {
                    $_bookings[$i][]  = $dealer_bookings[$key];
                } //else {
                    //$bookings[$i][] = '';
                //}
                $b++;
            }
        }
        foreach ($_bookings as $_books => $mil) {
            for($m=0;$m<$l;$m++){
                if ($_bookings[$_books][$m]) {
                    $bookings[$_books] = $mil;
                } else {
                    $bookings[$_books][$m] = '';
                }
            }
        }

        // Header Content Type
        header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
        header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header ("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
        header ("Content-type: application/vnd.ms-excel");
        header ("Content-Disposition: attachment; filename=\"booking-".date("dmYHi")."-".url_title(strtolower($dealer->name)).".xls" );
        header ("Content-Description: Generated Report" );
        header ("Content-Type: application/force-download");

        echo '<table class="row ten booking-table-list" border="1">
              <thead>
                <tr>
                    <td colspan="5" align="left" style="background-color:yellow"><h3>Booking Date : '.$date_book.'</h3></td>
                    <td colspan="4" align="right" style="background-color:yellow"><h3>'.$dealer->name.'</h3></td>
                </tr>
                <tr align="center">
                  <th colspan="5" style="background-color:#f2f2f2"><h3>Customer Data</h3></th>
                  <th colspan="4" style="background-color:#f2f2f2"><h3>Booking Data</h3></th>
                </tr>
                <tr align="center">
                  <th>Hour / Type</th>
                  <th>ID Order</th>
                  <th>Car</th>
                  <th>License</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Booked</th>
                  <th>Package</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>';
            foreach ($bookings as $time => $books) {
                $time = (strlen($time)==1) ? '0'.$time.':00' : $time.':00';
                echo '<tr id="hour-'.$time.'"><td colspan="9" class="info-bg"><h3>\''.$time.'</h3></td></tr>';
                  foreach($books as $book) {
                        if (!empty($book)) {
                            echo '<tr align="center">
                                    <td>
                                        <span class="'.($book->book_type ? 'primary' :'success').' label">'.($book->book_type ? 'ONLINE' :'OFFLINE').'</span>
                                    </td>
                                    <td>'.(($book->order_id) ? $book->order_id : '-').'</td>
                                    <td>';
                                            // Set vehicle model type
                                            $vehicle_type = $this->ProductModels->get($book->vehicle_type);
                                            if ($book->service_member_id != 0) {
                                                $vehicle = $this->Bookings->_getBookingVehicle($book->service_vehicle_id);
                                            } else {
                                                $vehicle = $this->Products->get($book->service_vehicle_id);
                                            }
                                            echo $vehicle->subject .' | '.$vehicle_type->subject;

                                    echo '</td>';
                                    echo '<td>'.$book->license_number.'</td>';
                                    echo '<td>'.$book->name.'</td>';
                                    echo '<td>\''.$book->phone.'</td>';
                                    echo '<td>'.date('D, d-M-Y', $book->date).'</td>';
                                    echo '<td>'.($book->service_type ? $service_type[$book->service_type] : $book->custom).'</td>';
                                    echo '<td>'.(($book->approved == 0) ? '<span class="red-text">Wait Approval</span>' : '<span class="blue-text">Approved</span>').'</td>';
                                echo '</tr>';
                        } else {
                        echo '
                        <tr align="center">
                            <td><span class="warning label">EMPTY</span></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>';
                        }
                    }
                }
            echo '<tbody>';
        echo '</table>';
        exit;
    }

    // Export all booking data by Dealer
    public function book_export_all($member_id="") {

        // Set service type
        $service_type   = [
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
                                ];

        // Set dealer data
        $member                = $this->Members->get($member_id);
        $dealer                = $this->DealerNetworks->findBy('dealer_member_id',$member_id);

        $dealer_config         = json_decode($member->attribute);

        // Setting the limit of the booking order
        $l = $dealer_config->setting_three->value;

        $date_book = '';
        $bookings = $this->Bookings->findAllBy('dealer_id',$dealer->id,'*',['date'=>'DESC']);

        // Header Content Type
        header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
        header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header ("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
        header ("Content-type: application/vnd.ms-excel");
        header ("Content-Disposition: attachment; filename=\"booking-".date("dmYHi")."-".url_title(strtolower($dealer->name)).".xls" );
        header ("Content-Description: Generated Report" );
        header ("Content-Type: application/force-download");

        /*
        Name
        Email
        Phone
        Vin number
        License number
        Dealer
        Vehicle
        Tipe
        Waktu
        Tanggal
        */

        echo '<table class="row ten booking-table-list" border="1">
              <thead>
                <tr>
                    <td colspan="5" align="left" style="background-color:yellow"><h3>Date : '.date("d-F-Y H:i").'</h3></td>
                    <td colspan="6" align="right" style="background-color:yellow"><h3>'.$dealer->name.'</h3></td>
                </tr>
                <tr align="center">
                  <th colspan="5" style="background-color:#f2f2f2"><h3>Customer Data</h3></th>
                  <th colspan="6" style="background-color:#f2f2f2"><h3>Booking Data</h3></th>
                </tr>
                <tr align="center">
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Vin number</th>
                  <th>License number</th>
                  <th>ID Order</th>
                  <th>Vehicle</th>
                  <th>Tipe</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>';
                foreach ($bookings as $books) {
                echo '<tr>';
                    echo '<td>'.$books->name.'</td>';
                    echo '<td>'.$books->email.'</td>';
                    echo '<td>'.$books->phone.'</td>';
                    echo '<td>'.$books->vin_number.'</td>';
                    echo '<td>'.$books->license_number.'</td>';
                    echo '<td>'.$books->order_id.'</td>';
                    // Set vehicle model type
                    $vehicle_type = $this->ProductModels->get($books->vehicle_type);
                    if ($books->service_member_id != 0) {
                        $vehicle = $this->Bookings->_getBookingVehicle($books->service_vehicle_id);
                    } else {
                        $vehicle = $this->Products->get($books->service_vehicle_id);
                    }
                    echo '<td>'.$vehicle->subject .(($vehicle_type->subject) ? ' | '.$vehicle_type->subject : '').'</td>';
                    echo '<td>'.($books->service_type ? $service_type[$books->service_type] : $books->custom).'</td>';
                    echo '<td>'.(($books->date != 0) ? date('d-F-Y',$books->date) : '-').'</td>';
                    echo '<td>'.$books->time.'</td>';
                    echo '<td>'.(($books->approved == 0) ? 'Wait Approval' : 'Approved').'</td>';
                echo '</tr>';
                }
            echo '<tbody>';
        echo '</table>';
        exit;
    }

    // Export booking data by Dealer
    public function book_print($date_book='',$member_id="") {

        // Set service type
        $service_type   = [
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
                                ];

        // Set dealer data
        $member                = $this->Members->get($member_id);
        $dealer                = $this->DealerNetworks->findBy('dealer_member_id',$member_id);
        $dealer_config         = json_decode($member->attribute);

        // Setting the limit of the booking order
        $l = $dealer_config->setting_three->value;

        // Set dealer booking data
        $dealer_bookings = $this->Bookings->findAll(['dealer_id'=>$dealer->id,'date'=>strtotime($date_book)],'*',['id'=>'ASC']);

        $bookings = [];
        for($i=$dealer_config->setting_four->value;$i<$dealer_config->setting_five->value;$i++) {
            $_bookings[$i] = '';
            $b=0;
            foreach ($dealer_bookings as $key => $books) {
                if($i == $books->time) {
                    $_bookings[$i][]  = $dealer_bookings[$key];
                } //else {
                    //$bookings[$i][] = '';
                //}
                $b++;
            }
        }
        foreach ($_bookings as $_books => $mil) {
            for($m=0;$m<$l;$m++){
                if ($_bookings[$_books][$m]) {
                    $bookings[$_books] = $mil;
                } else {
                    $bookings[$_books][$m] = '';
                }
            }
        }

        echo '<!DOCTYPE html>
                <head>
                <meta charset="utf-8">
                    <title>booking-'.date("dmYHi").'-'.url_title(strtolower($dealer->name)).'"</title>
                    <style type="text/css">
                    body
                    {
                        background-color: #FFFFFF;
                        font-family:Arial,Verdana,Tahoma;
                        font-size:0.86em;
                        margin: 0px;  /* this affects the margin on the html before sending to printer */
                    }
                    table {
                        font-size:0.86em;
                        border-collapse: collapse;
                    }
                    table, th, td {
                           border: 1px solid black;
                           padding:5px;
                    }
                    </style>
                    <style type="text/css" media="print">
                    @page
                    {
                        size:  auto;   /* auto is the initial value */
                        margin: 3mm;  /* this affects the margin in the printer settings */
                    }
                    html
                    {
                        background-color: #FFFFFF;
                        margin: 0px;  /* this affects the margin on the html before sending to printer */
                    }

                    body
                    {
                        font-family:Arial,Verdana,Tahoma;
                        margin: 10mm 15mm 10mm 15mm; /* margin you want for the content */
                    }
                    table {
                        font-size:0.86em;
                        border-collapse: collapse;
                    }
                    table, th, td {
                        border: 1px solid black;
                        padding:5px;
                    }
                    </style>
                </head>';
        echo '<body onload="window.print();">';
        echo '<table class="row ten booking-table-list">
              <thead>
                <tr>
                    <td colspan="5" align="left" style="background-color:#cccccc"><h3>Booking Date : '.$date_book.'</h3></td>
                    <td colspan="4" align="right" style="background-color:#cccccc"><h3>'.$dealer->name.'</h3></td>
                </tr>
                <tr align="center">
                  <th colspan="5" style="background-color:#f2f2f2"><h3>Customer Data</h3></th>
                  <th colspan="4" style="background-color:#f2f2f2"><h3>Booking Data</h3></th>
                </tr>
                <tr align="center">
                  <th>Hour / Type</th>
                  <th>ID Order</th>
                  <th>Car</th>
                  <th>License</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Booked</th>
                  <th>Package</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>';
            foreach ($bookings as $time => $books) {
                $time = (strlen($time)==1) ? '0'.$time.':00' : $time.':00';
                echo '<tr id="hour-'.$time.'"><td colspan="9" class="info-bg"><h3>'.$time.'</h3></td></tr>';
                  foreach($books as $book) {
                        if (!empty($book)) {
                            echo '<tr align="center">
                                    <td>
                                        <span class="'.($book->book_type ? 'primary' :'success').' label">'.($book->book_type ? 'ONLINE' :'OFFLINE').'</span>
                                    </td>
                                    <td>'.(($book->order_id) ? $book->order_id : '-').'</td>
                                    <td>';
                                            // Set vehicle model type
                                            $vehicle_type = $this->ProductModels->get($book->vehicle_type);
                                            if ($book->service_member_id != 0) {
                                                $vehicle = $this->Bookings->_getBookingVehicle($book->service_vehicle_id);
                                            } else {
                                                $vehicle = $this->Products->get($book->service_vehicle_id);
                                            }
                                            echo $vehicle->subject .' | '.$vehicle_type->subject;

                                    echo '</td>';
                                    echo '<td>'.$book->license_number.'</td>';
                                    echo '<td>'.$book->name.'</td>';
                                    echo '<td>'.$book->phone.'</td>';
                                    echo '<td>'.date('D, d-M-Y', $book->date).'</td>';
                                    echo '<td>'.($book->service_type ? $service_type[$book->service_type] : $book->custom).'</td>';
                                    echo '<td>'.(($book->approved == 0) ? '<span class="red-text">Wait Approval</span>' : '<span class="blue-text">Approved</span>').'</td>';
                                echo '</tr>';
                        } else {
                        echo '
                        <tr align="center">
                            <td><span class="warning label">EMPTY</span></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>';
                        }
                    }
                }
            echo '<tbody>';
        echo '</table>';
        echo '</body>';
        echo '</html>';
    }

    private function _getMember ($member_id) {

        $network = $this->Members->with('dealernetworks')->get($member_id);
        $member  = $this->DealerNetworks->with('news')->findAllBy('dealer_member_id',$member_id);

        $member->dealernetworks = $network->dealernetworks;

        return $member;
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
