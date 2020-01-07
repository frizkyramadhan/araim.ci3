<?php

class Form extends CI_Controller {

    function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') == FALSE){
            redirect('login/process_login');
        }else {
        $this->load->model('form_m');
        $this->load->model('login_m');
        }
    }
    
    public function index(){
        //penentuan judul
        $data['title'] = "Asset Allocation Form";
    	$data['subtitle'] = "Asset Allocation Form";
        $nik = $this->session->userdata('nik');
        $data_pengguna = $this->login_m->dataPengguna($nik);
        $level = $data_pengguna->level;
        if ($level == 'Admin' || $level == 'Super User') {
            $data['form'] = $this->form_m->getAllForm();
        } else {
            $data['form'] = $this->form_m->getAllFormByDept();
        }
        //penentuan tampilan header, navigation, isi
        $this->load->view('header', $data);
        $this->load->view('nav');
        $this->load->view('form/form', $data);
        $this->load->view('footer');
        
    }
    
    function add() {
        $data['title'] = "Asset Allocation Form";
        $data['subtitle'] = "Add Asset Allocation Form";
        
        $this->load->view('header', $data);
        $this->load->view('nav');
        
        $this->form_validation->set_rules('id_perbekalan','Inventories','required');
        $this->form_validation->set_message('required','Please select at least one inventory!');
        
        if($this->form_validation->run()==FALSE){
            $data['perbekalan'] = $this->form_m->getAllPerbekalanByDept();
            $data['no_form'] = $this->form_m->generateAutoid();
            $this->load->view('form/add_form', $data);
            $this->load->view('footer');
        } else {
            foreach($this->input->post('id_perbekalan') as $perbekalan){
                $detail = array(
                    'no_form' => $this->input->post('no_form'),
                    'date' => $this->input->post('date'),
                    'input_by' => $this->input->post('input_by'),
                    'id_perbekalan' => $perbekalan
                );
                $this->db->insert('form', $detail);
            }
            redirect('form');
        }
    }

    public function delete($no_form){
        $this->form_m->delete($no_form);
        redirect('form');
    }
    
    function delete_item($no_form, $id) {
        $this->db->where('id_form', $id);
        $this->db->delete('form');
        
        redirect('form/detail/'.$no_form);
    }
    
    function detail($no_form) {
        $data['title'] = "Asset Allocation Form";
        $data['subtitle'] = "Detail Asset Allocation Form";
        $this->load->view('header', $data);
        $this->load->view('nav');
        
        $data['no_form'] = $no_form;
        $data['detail'] = $this->form_m->getFormDetail($no_form);
        $data['input_by'] = $this->form_m->inputBy($no_form);
        
        $this->load->view('form/detail', $data);
        $this->load->view('footer');
    
    }
    
    function detail_aset($id) {
        $data['title'] = "Inventory Data";
        $data['subtitle'] = "Asset Detail";
        $this->load->view('header', $data);
        $this->load->view('nav');
        if($_POST==NULL){
            $data['detail'] = $this->perbekalan_m->detail_aset($id);
            $this->load->view('perbekalan/detail_aset', $data);
            $this->load->view('footer');
        } else {
            redirect('perbekalan');
        }
    }
    
    function edit($nik1, $id) {
        $data['title'] = "Inventory Data";
        $data['subtitle'] = "Edit Inventory Data";
        
        $this->load->view('header', $data);
        $this->load->view('nav');
        //penentuan dropdown nik site
        $nik = $this->session->userdata('nik');
        $data_pengguna = $this->login_m->dataPengguna($nik);
        $kode_project = $data_pengguna->kode_project;
        if ($kode_project == '000H'){
            $dbres_nik = $this->db->query('select * from karyawan order by nik asc ');
        } else {
            $dbres_nik = $this->db->query('select * from karyawan, project where karyawan.id_project = project.id_project and project.kode_project = "'. $data_pengguna->kode_project.'" order by nik asc');
        }
        $ddmenu_nik = array();
        foreach ($dbres_nik->result_array() as $tablerow) {
            $ddmenu_nik[$tablerow['id_karyawan']] = $tablerow['nik'];
        }
        $data['nik_options'] = $ddmenu_nik;
        
        $dbres_aset = $this->db->query('select * from aset, kategori where aset.id_kategori = kategori.id_kategori order by nama_kategori asc');
        $ddmenu_aset = array();
        foreach ($dbres_aset->result_array() as $tablerow) {
            $ddmenu_aset[$tablerow['id_aset']] = $tablerow['nama_aset']." - ".$tablerow['nama_kategori'];
        }
        $data['aset_options'] = $ddmenu_aset;
        
        if($_POST==NULL){
            $data['perbekalan'] = $this->perbekalan_m->select($id);
            $data['select_nik'] = $this->perbekalan_m->select_nik($id);
            $data['select_aset'] = $this->perbekalan_m->select_aset($id);
            $this->load->view('perbekalan/edit_perbekalan', $data);
            $this->load->view('footer');
        } else {
            $this->perbekalan_m->update($id);
            redirect('perbekalan/detail/'.$nik1);
        }
    }
    
    function print_form ($no_form) {
        $data['no_form'] = $no_form;
        $data['detail'] = $this->form_m->getFormDetail($no_form);
        $data['input_by'] = $this->form_m->inputBy($no_form);
        $this->load->view('form/report', $data);
    }
    
//    function execute(){
//        $perbekalan = $this->db->query('select * from perbekalan')->result();
//        foreach ($perbekalan as $id){
//            $this->db->set('input_by', 47);
//            $this->db->where('id_perbekalan', $id->id_perbekalan);
//            $this->db->update('perbekalan');
//        }
//        redirect('perbekalan');
//    }
}

?>
