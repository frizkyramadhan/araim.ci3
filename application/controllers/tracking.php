<?php

class Tracking extends CI_Controller {

    function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') == FALSE){
            redirect('login/process_login');
        }else {
        $this->load->model('tracking_m');
        $this->load->model('perbekalan_m');
        $this->load->model('login_m');
        }
    }
    
    public function index(){
        //penentuan judul
        $data['title'] = "Tracking Inventory Data";
    	$data['subtitle'] = "Tracking Inventory Data";
        
        $this->load->view('header', $data);
        $this->load->view('nav');
        $data['list'] = "";
//        $get = $this->tracking_m->get();
        $this->load->view('tracking/tracking', $data);
        $this->load->view('footer');
        
    }
}

?>
