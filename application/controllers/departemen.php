<?php

class Departemen extends CI_Controller{
        
    function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') == FALSE){
            redirect('login/process_login');
        }else {
        $this->load->model('departemen_m');
        $this->load->model('login_m');
        }
    }
    
    function index() {
        $data['title'] = "Department Data";
        $data['subtitle'] = "Department Data";
        $data['departemen'] = $this->departemen_m->selectAll();
	$this->load->view('header', $data);
        $this->load->view('nav');
        $this->load->view('departemen/departemen', $data);
        $this->load->view('footer');
    }
    
    function add() {
        $data['title'] = "Department Data";
        $data['subtitle'] = "Add Department Data";
        $this->load->view('header', $data);
        $this->load->view('nav');
        if($_POST==NULL){
            $this->load->view('departemen/add_departemen');
            $this->load->view('footer');
        } else {
            $this->departemen_m->insert($_POST);
            redirect('departemen');
        }
    }
    
    function delete($id) {
        $this->departemen_m->delete($id);
        redirect('departemen');
    }
    
    function edit($id) {
        $data['title'] = "Department Data";
        $data['subtitle'] = "Edit Department Data";
        $this->load->view('header', $data);
        $this->load->view('nav');

        if($_POST==NULL){
            $data['departemen'] = $this->departemen_m->select($id);
            $this->load->view('departemen/edit_departemen', $data);
            $this->load->view('footer');
        } else {
            $this->departemen_m->update($id);
            redirect('departemen');
        }       
    }
}
?>
