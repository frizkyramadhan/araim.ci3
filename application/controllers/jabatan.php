<?php

class Jabatan extends CI_Controller{
        
    function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') == FALSE){
            redirect('login/process_login');
        }else {
        $this->load->model('jabatan_m');
        $this->load->model('departemen_m');
        $this->load->model('login_m');
        }
        
    }
    
    function index() {
	$data['title'] = "Position Data";
	$data['subtitle'] = "Position Data";
        $data['jabatan'] = $this->jabatan_m->selectAll();
		$this->load->view('header', $data);
        $this->load->view('nav');
        $this->load->view('jabatan/jabatan', $data);
        $this->load->view('footer');
    }
    
    function add() {
        $data['title'] = "Position Data";
	$data['subtitle'] = "Add Position Data";
        $this->load->view('header', $data);
        $this->load->view('nav');
        $dbres = $this->db->order_by('nama_dept', 'ASC')->get('departemen');
        $ddmenu = array();
        foreach ($dbres->result_array() as $tablerow) {
            $ddmenu[$tablerow['id_dept']] = $tablerow['nama_dept'];
        }
        $data['options'] = $ddmenu;
        if($_POST==NULL){
            $this->load->view('jabatan/add_jabatan', $data);
            $this->load->view('footer');
        } else {
            $this->jabatan_m->insert($_POST);
            redirect('jabatan');
        }
    }
    
    function delete($id) {
        $this->jabatan_m->delete($id);
        redirect('jabatan');
    }
    
    function edit($id) {
        $data['title'] = "Position Data";
	$data['subtitle'] = "Edit Position Data";
        $this->load->view('header', $data);
        $this->load->view('nav');
        $dbres = $this->db->order_by('nama_dept', 'ASC')->get('departemen');
        $ddmenu = array();
        foreach ($dbres->result_array() as $tablerow) {
            $ddmenu[$tablerow['id_dept']] = $tablerow['nama_dept'];
        }
        $data['options'] = $ddmenu;
        if($_POST==NULL){
            $data['jabatan'] = $this->jabatan_m->select($id);
            $data['selected'] = $this->jabatan_m->select_departemen($id);
            $this->load->view('jabatan/edit_jabatan', $data);
            $this->load->view('footer');
        } else {
            $this->jabatan_m->update($id);
            redirect('jabatan');
        }       
    }
}
?>
