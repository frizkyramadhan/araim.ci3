<?php

class Karyawan extends CI_Controller{
        
    function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') == FALSE){
            redirect('login/process_login');
        }else {
        $this->load->model('karyawan_m');
        $this->load->model('jabatan_m');
        $this->load->model('project_m');
        $this->load->model('login_m');
        }
    }
    
    function index() {
        $data['title'] = "Employee Data";
        $data['subtitle'] = "Employee Data";
        $this->load->view('header', $data);
        $this->load->view('nav');
        
        $nik = $this->session->userdata('nik');
        $data_pengguna = $this->login_m->dataPengguna($nik);
        $kode_project = $data_pengguna->kode_project;
        $level = $data_pengguna->level;
        if ($kode_project == '000H' && $level == "Admin") {
            $data['karyawan'] = $this->karyawan_m->selectAll();
        } else {
            $data['karyawan'] = $this->karyawan_m->getAllKaryawanByProject();
        }
        
        $this->load->view('karyawan/karyawan', $data);
        $this->load->view('footer');
    }
    
    function add() {
        $data['title'] = "Employee Data";
        $data['subtitle'] = "Add Employee Data";
        $this->load->view('header', $data);
        $this->load->view('nav');
        $dbres = $this->db->query('select * from jabatan order by nama_jabatan asc');
        $ddmenu = array();
        foreach ($dbres->result_array() as $tablerow) {
            $ddmenu[$tablerow['id_jabatan']] = $tablerow['nama_jabatan'];
        }
        $data['jabatan'] = $ddmenu;
        
        $dbres1 = $this->db->get('project');
        $ddmenu1 = array();
        foreach ($dbres1->result_array() as $tablerow) {
            $ddmenu1[$tablerow['id_project']] = $tablerow['nama_project'];
        }
        $data['project'] = $ddmenu1;
        
        if($_POST==NULL){
            $this->load->view('karyawan/add_karyawan', $data);
            $this->load->view('footer');
        } else {
            $this->karyawan_m->insert($_POST);
            redirect('karyawan');
        }
    }
    
    function add_multiple() {
        $data['title'] = "Employee Data";
        $data['subtitle'] = "Add Employee Data";
        $this->load->view('header', $data);
        $this->load->view('nav');
        
        if($_POST==NULL) {
            $this->load->view('karyawan/add_multiple');
            $this->load->view('footer');
        }else{
            redirect('karyawan/add_multiple_post/'.$_POST['banyak_data']);
        }
    }
    
    function add_multiple_post($banyak_data=0) {
        $data['title'] = "Employee Data";
        $data['subtitle'] = "Add Employee Data";
        $this->load->view('header', $data);
        $this->load->view('nav');
        
        $dbres = $this->db->order_by('nama_jabatan','asc')->get('jabatan');
        $ddmenu = array();
        foreach ($dbres->result_array() as $tablerow) {
            $ddmenu[$tablerow['id_jabatan']] = $tablerow['nama_jabatan'];
        }
        $data['jabatan'] = $ddmenu;
        
        $dbres1 = $this->db->get('project');
        $ddmenu1 = array();
        foreach ($dbres1->result_array() as $tablerow) {
            $ddmenu1[$tablerow['id_project']] = $tablerow['nama_project'];
        }
        $data['project'] = $ddmenu1;
        
        if($_POST==NULL) {
            $data['banyak_data'] = $banyak_data;
            $this->load->view('karyawan/add_multiple_form',$data);
            $this->load->view('footer');
        }else {
            foreach($_POST['data'] as $d){
                $this->db->insert('karyawan',$d);
            }
            redirect('karyawan');
        }
    }
    
    function delete($id) {
        $this->karyawan_m->delete($id);
        redirect('karyawan');
    }
    
    function edit($id) {
        $data['title'] = "Employee Data";
        $data['subtitle'] = "Edit Employee Data";
        $this->load->view('header', $data);
        $this->load->view('nav');
        $dbres = $this->db->order_by('nama_jabatan','asc')->get('jabatan');
        $ddmenu = array();
        foreach ($dbres->result_array() as $tablerow) {
            $ddmenu[$tablerow['id_jabatan']] = $tablerow['nama_jabatan'];
        }
        $data['jabatan'] = $ddmenu;
        
        $dbres1 = $this->db->get('project');
        $ddmenu1 = array();
        foreach ($dbres1->result_array() as $tablerow) {
            $ddmenu1[$tablerow['id_project']] = $tablerow['nama_project'];
        }
        $data['project'] = $ddmenu1;
        
        if($_POST==NULL){
            $data['karyawan'] = $this->karyawan_m->select($id);
            $data['select_jabatan'] = $this->karyawan_m->select_jabatan($id);
            $data['select_project'] = $this->karyawan_m->select_project($id);
            $this->load->view('karyawan/edit_karyawan', $data);
            $this->load->view('footer');
        } else {
            $this->karyawan_m->update($id);
            redirect('karyawan');
        }
    }
    
    function detail($nik) {
        $data['title'] = "Employee Data";
        $data['subtitle'] = "Detail Employee Data";
        $this->load->view('header', $data);
        $this->load->view('nav');
        $data['detail'] = $this->karyawan_m->select_by_nik($nik);
        $this->load->view('karyawan/detail', $data);
        $this->load->view('footer');
    }
}

?>
