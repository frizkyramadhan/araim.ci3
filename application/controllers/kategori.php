<?php

class Kategori extends CI_Controller{
        
    function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') == FALSE){
            redirect('login/process_login');
        }else {
        $this->load->model('kategori_m');
        $this->load->model('login_m');
        }
    }
    
    function index() {
        $data['title'] = "Asset Category Data";
        $data['subtitle'] = "Asset Category Data";
        $this->load->view('header', $data);
        $this->load->view('nav');
        $data['kategori'] = $this->kategori_m->selectAll();
        $this->load->view('kategori/kategori', $data);
        $this->load->view('footer');
    }
    
    function add() {
        $data['title'] = "Asset Category Data";
        $data['subtitle'] = "Asset Category Data";
        $this->load->view('header', $data);
        $this->load->view('nav');
        if($_POST==NULL){
            $this->load->view('kategori/add_kategori');
            $this->load->view('footer');
        } else {
            $this->kategori_m->insert($_POST);
            redirect('kategori');
        }
    }
    
    function delete($id) {
        $this->kategori_m->delete($id);
        redirect('kategori');
    }
    
    function edit($id) {
        $data['title'] = "Asset Category Data";
        $data['subtitle'] = "Asset Category Data";
        $this->load->view('header', $data);
        $this->load->view('nav');
        if($_POST==NULL){
            $data['kategori'] = $this->kategori_m->select($id);
            $this->load->view('kategori/edit_kategori', $data);
            $this->load->view('footer');
        } else {
            $this->kategori_m->update($id);
            redirect('kategori');
        }
        
    }
}

?>
