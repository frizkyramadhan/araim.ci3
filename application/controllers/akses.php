<?php

class Akses extends CI_Controller{
        
    function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') == FALSE){
            redirect('login/process_login');
        }else {
        $this->load->model('akses_m');
        $this->load->model('karyawan_m');
        $this->load->model('login_m');
        }
    }
    
    function index() {
        $data['title'] = "User Access";
        $data['subtitle'] = "User Access";
        $this->load->view('header', $data);
        $this->load->view('nav');
    	$data['akses'] = $this->akses_m->selectAll();
        $this->load->view('akses/akses', $data);
        $this->load->view('footer');
    }
    
    function add() {
        $data['title'] = "User Access";
        $data['subtitle'] = "Add User Access";
        $this->load->view('header', $data);
        $this->load->view('nav');
        $dbres = $this->db->order_by('nik','asc')->get('karyawan');
        $ddmenu = array();
        foreach ($dbres->result_array() as $tablerow) {
            $ddmenu[$tablerow['id_karyawan']] = $tablerow['nik'].' - '.$tablerow['nama'];
        }
        $data['options'] = $ddmenu;
        if($_POST==NULL){
            $this->load->view('akses/add_akses', $data);
            $this->load->view('footer');
        } else {
            $this->akses_m->insert($_POST);
            redirect('akses');
        }
    }
    
    function delete($id) {
        $this->akses_m->delete($id);
        redirect('akses');
    }
    
    function edit($id) {
        $data['title'] = "User Access";
        $data['subtitle'] = "Edit User Access";
        $this->load->view('header', $data);
        $this->load->view('nav');
        $dbres = $this->db->order_by('nik','asc')->get('karyawan');
        $ddmenu = array();
        foreach ($dbres->result_array() as $tablerow) {
            $ddmenu[$tablerow['id_karyawan']] = $tablerow['nik'].' - '.$tablerow['nama'];
        }
        $data['options'] = $ddmenu;
        if($_POST==NULL){
            $data['akses'] = $this->akses_m->select($id);
            $data['select_level'] = $this->akses_m->select_level($id);
            $data['select_status'] = $this->akses_m->select_status($id);
            $this->load->view('akses/edit_akses', $data);
            $this->load->view('footer');
        } else {
            $this->akses_m->update($id);
            redirect('akses');
        }
    }
}
?>
