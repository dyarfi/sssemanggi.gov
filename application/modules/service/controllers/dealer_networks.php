<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dealer_Networks extends Admin_Controller {
    
    public function __construct() {
            parent::__construct();

            // Load Members model
            $this->load->model('service/DealerNetworks');
            
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
            // Set tables
            $crud->set_table($this->DealerNetworks->table);
            // Set CRUD subject
            $crud->set_subject('Dealers');
            // Set table relation
            $crud->set_relation('province','tbl_provinces','name');
            // Set table relation
            $crud->set_relation('dealer_member_id','tbl_members','fullname');
            
            // Set column
            $crud->columns('dealer_member_id','sis_code','name','province','address','zip_code','email','geolocation_lat','geolocation_long','dealer_status','phone_one','phone_two','fax','status');
            // Set fields
            $crud->fields('sis_code','name','province','address','maps','geolocation_lat','geolocation_long','zip_code','email','dealer_status','phone_one','phone_two','fax','status');
            
            // Set column display             
            $crud->display_as('province','Propinsi');            
            $crud->display_as('categories','Kategori');            
            $crud->display_as('province','Propinsi');
            $crud->display_as('tambahan_body_paint','Body Paint');
            
			// This callback escapes the default auto field output of the field name at the edit form
			//$crud->callback_edit_field('modified',array($this,'_callback_time_modified'));
			// This callback escapes the default auto field output of the field name at the add/edit form. 
			// $crud->callback_field('status',array($this,'_callback_dropdown'));
			// This callback escapes the default auto column output of the field name at the add form
			//$crud->callback_column('file_name',array($this,'_callback_filename'));
            // Callback for google maps mapping coordinate
            $crud->callback_field('maps',array($this,'_callback_maps'));
			//$crud->callback_column('added',array($this,'_callback_time'));
			//$crud->callback_column('modified',array($this,'_callback_time'));  
			//$crud->callback_column('fb_pic_url',array($this,'callback_pic'));
            //$crud->callback_column('photo_url',array($this,'_callback_pic'));
            $crud->field_type('url', 'hidden');
            $crud->field_type('geolocation_lat', 'hidden');
            $crud->field_type('geolocation_long', 'hidden');            
            $crud->unset_texteditor('address','email');            
            
            // Set callback before database set
            $crud->callback_before_insert(array($this,'_callback_url'));
            $crud->callback_before_update(array($this,'_callback_url'));
			//$crud->unset_columns('completed');
			// Sets the required fields of add and edit fields
			// $crud->required_fields('subject','name','text','status'); 
            // Set upload field
            // $crud->set_field_upload('file_name','uploads/users');
			$state = $crud->getState();

		    // Check ajaxed requested and POST method
            if ($this->input->is_ajax_request() && $this->input->post('location') && $this->input->post('dealer_id')) {

                $position = $this->input->post('location');

                $data = array(
                   'geolocation_lat' => floatval($position['lat']),
                   'geolocation_long' => floatval($position['lng'])
                );
                $this->db->where('id', $this->input->post('dealer_id'));
                $this->db->update('tbl_dealer_networks', $data);   

            }
            // Check CRUD states
			if ($state == 'export')
			{
				//Do your awesome coding here.
				$crud->callback_column('file_name',array($this,'_callback_filename_url'));				
			} 
			
			//$crud->unset_add();
			//$crud->unset_edit();
			//$crud->unset_delete();
            $this->load($crud, 'services');
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    
    public function _callback_time ($value, $row) {
		return empty($value) ? '-' : date('D, d-M-Y',$value);
    }
    
    public function _callback_time_added ($value, $row) {
		$time = time();
		return '<input type="hidden" maxlength="50" value="'.$time.'" name="added">';
    }
    
    public function _callback_time_modified ($value, $row) {
		$time = time();
		return '<input type="hidden" maxlength="50" value="'.$time.'" name="modified">';
    }
        
	public function _callback_filename($value, $row) {
		$row->file_name = strip_tags($row->file_name);
        return $row->file_name ? '<div class="text-center"><a href="'.base_url('uploads/users/'.$row->file_name).'" class="image-thumbnail"><img height="110px" src="'.base_url('uploads/users/'.$row->file_name).'"/></a></div>' : '-';
    }
    
	public function _callback_filename_url($value, $row) {
		return ($row->file_name) ? base_url('uploads/users/'.$row->file_name) : '-';
	}
	
    public function _callback_maps($value = '', $primary_key = null) {
        $html = '<div id="floating-panel">
                      <input id="address" type="textbox" value="">
                      <input id="send" type="button" value="Geocode">
                      <input id="dealer_id" type="hidden" value="'.$primary_key.'">
                 </div>
                <div id="map" style="width: 500px;height: 300px;"></div>';
        return $html;
    }
    
    private function load($crud, $nav) {
        $output = $crud->render();
        $output->nav = $nav;
        if ($crud->getState() == 'list') {
            // Set Media Title 
            $output->page_title = lang('Dealer').' Listings';
            // Set Main Template
            $output->main       = 'template/admin/metronix';
            // Set Primary Template
            $this->load->view('template/admin/template.php', $output);
        } else {
            // Set Page Title 
            $output->page_title = lang('Dealer').' Listings';
            // Set note for popup message
            $output->notes      = $this->notes;
            // Set external js 
            $output->js_files = array_merge($output->js_files,['https://maps.googleapis.com/maps/api/js?key=AIzaSyDbboZY7KeTOi5V6-zJNUsQG_-THlw6tyQ&amp;region=ID']);
            // Set execution external js
            $output->js_inline = '
                                var map_id = document.getElementById("map");

                                if (map_id !== null) {
                                    function initMap() {
                                        var map = new google.maps.Map(map_id, {
                                          zoom: 3,
                                          center: {lat: -2.213, lng: 121.755}
                                        });

                                        var geocoder = new google.maps.Geocoder();

                                        document.getElementById("send").addEventListener("click", function() {
                                          geocodeAddress(geocoder, map);
                                        });
                                        
                                        google.maps.event.addListenerOnce(map, "idle", function(){
                                          checkValue(map);
                                        });

                                    }

                                    function geocodeAddress(geocoder, resultsMap) {
                                        var address = document.getElementById("address").value;
                                        var dealer_id = document.getElementById("dealer_id").value;
                                        
                                        geocoder.geocode({"address": address}, function(results, status) {
                                            if (status === "OK") {
                                                if (typeof results[0] !== "undefined") {
                                                    var position = { lat : parseFloat(results[0].geometry.location.lat()), lng : parseFloat(results[0].geometry.location.lng()) };
                                                    resultsMap.setZoom(18);
                                                    resultsMap.setCenter(position);
                                                    var marker = new google.maps.Marker({
                                                        map: resultsMap,
                                                        position: position
                                                    });
                                                    $.ajax({
                                                        method:"POST",
                                                        url: base_ADM + "/dealer_networks/index/change",
                                                        data: { dealer_id : dealer_id, location : position}
                                                    }).done(function(message) {
                                                        alert("Reloading latitude longitude, please wait..");
                                                        setInterval(window.location.reload(),3000);
                                                    });
                                                }
                                            } else {
                                                alert("Geocode was not successful for the following reason: " + status + ", please make sure you have the correct address");
                                            }                                            
                                        });
                                    }

                                    function checkValue(resultsMap) {
                                        if ($("input[name=geolocation_lat]").val() != "" && $("input[name=geolocation_long]").val() != "") {
                                            var lat = $("input[name=geolocation_lat]").val();
                                            var long = $("input[name=geolocation_long]").val();
                                            
                                            $("#address").attr("value", lat +","+ long);
                                            var address =  $("#address").val();
                                            if (address != "") {
                                                var geometry = {lat:parseFloat(lat), lng:parseFloat(long)};
                                                var marker = new google.maps.Marker({
                                                    position: geometry,
                                                    draggable:true,
                                                    map: resultsMap
                                                });
                                                resultsMap.setZoom(18);
                                                resultsMap.setCenter(geometry);
                                                
                                            }
                                            google.maps.event.addListener(marker, "dragend", function(marker){
                                                var latLng = marker.latLng; 
                                                var dealer_id = document.getElementById("dealer_id").value;
                                                currentLatitude = latLng.lat();
                                                currentLongitude = latLng.lng();
                                                $("#address").attr("value", currentLatitude +","+ currentLongitude);
                                                var position = { lat : currentLatitude, lng : currentLongitude };
                                                $.ajax({
                                                    method:"POST",
                                                    url: base_ADM + "/dealer_networks/index/change",
                                                    data: { dealer_id : dealer_id, location : position}
                                                }).done(function(message) {
                                                    alert("Reloading latitude longitude, please wait..");
                                                    setInterval(window.location.reload(),3000);
                                                });
                                             });

                                        }
                                    }

                                    initMap();
                                }';
            // Set Primary Template            
            $this->load->view('template/admin/popup.php', $output);
        }      
    }
}