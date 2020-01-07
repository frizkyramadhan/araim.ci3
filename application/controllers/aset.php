<?php

class Aset extends CI_Controller{
        
    function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') == FALSE){
            redirect('login/process_login');
        }else {
        $this->load->model('aset_m');
        $this->load->model('kategori_m');
        $this->load->model('login_m');
        }
    }
    
    function index() {
        $data['title'] = "Asset Data";
        $data['subtitle'] = "Asset Data";
        $data['aset'] = $this->aset_m->selectAll();
        $this->load->view('header', $data);
        $this->load->view('nav');
        $this->load->view('aset/aset', $data);
        $this->load->view('footer');
    }
    
    function add() {
        $data['title'] = "Asset Data";
        $data['subtitle'] = "Add Asset Data";
        $data['aset'] = $this->aset_m->selectAll();
        $this->load->view('header', $data);
        $this->load->view('nav');
        $dbres = $this->db->order_by('nama_kategori','asc')->get('kategori');
        $ddmenu = array();
        foreach ($dbres->result_array() as $tablerow) {
            $ddmenu[$tablerow['id_kategori']] = $tablerow['nama_kategori'];
        }
        $data['options'] = $ddmenu;
        if($_POST==NULL){
            $this->load->view('aset/add_aset', $data);
            $this->load->view('footer');
        } else {
            $this->aset_m->insert($_POST);
            redirect('aset');
        }
    }
    
    function delete($id) {
        $this->aset_m->delete($id);
        redirect('aset');
    }
    
    function edit($id) {
        $data['title'] = "Asset Data";
        $data['subtitle'] = "Edit Asset Data";
        
        $this->load->view('header', $data);
        $this->load->view('nav');
        $dbres = $this->db->order_by('nama_kategori','asc')->get('kategori');
        $ddmenu = array();
        foreach ($dbres->result_array() as $tablerow) {
            $ddmenu[$tablerow['id_kategori']] = $tablerow['nama_kategori'];
        }
        $data['options'] = $ddmenu;
        
        if($_POST==NULL){
            $data['aset'] = $this->aset_m->select($id);
            $data['selected'] = $this->aset_m->select_kategori($id);
            $this->load->view('aset/edit_aset', $data);
            $this->load->view('footer');
        } else {
            $this->aset_m->update($id);
            redirect('aset');
        }
        
    }
}

?>
