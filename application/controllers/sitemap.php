<?php
 
Class Sitemap extends Public_Controller {
 
    public function __construct(){
        parent::__construct();
        $this->load->model('content');
    }
 
    public function index($lang='')
    {   

        //$data['urlslist'] = $this->content->sitemap(1);
       
        //print_r( $data['urlslist'] );
        $this->load->view("sitemap",$data='');
    }
}
 