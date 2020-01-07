<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') == FALSE){
            redirect('login/process_login');
        }else {
            $this->load->model('login_m');
            $this->load->model('akses_m');
        }
    }

	
    function index()
    {
            $data['title'] = "Dashboard";
            $data['subtitle'] = "Dashboard";
            $this->load->view('header', $data);
            $this->load->view('nav');
            $nik = $this->session->userdata('nik');
            $data['pengguna'] = $this->login_m->dataPengguna($nik);
            $this->load->view('welcome');
            $this->load->view('footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */