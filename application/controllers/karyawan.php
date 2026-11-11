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
        $this->karyawan_m->ensure_hero_employee_id();
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
            $data['hero_employee_id'] = '';
            $data['error'] = '';
            $data['posted'] = array();
            $data['selected_jabatan'] = '';
            $data['selected_project'] = '';
            $this->load->view('karyawan/add_karyawan', $data);
            $this->load->view('footer');
        } else {
            $row = $this->_karyawan_row_from_post();
            if ($row === FALSE) {
                $data['hero_employee_id'] = $this->input->post('hero_employee_id');
                $data['error'] = 'Arka Hero employee was not found. Search by name or current NIK and pick a person.';
                $data['posted'] = array(
                    'nik' => $this->input->post('nik'),
                    'nama' => $this->input->post('nama'),
                    'email' => $this->input->post('email'),
                );
                $data['selected_jabatan'] = $this->input->post('id_jabatan');
                $data['selected_project'] = $this->input->post('id_project');
                $this->load->view('karyawan/add_karyawan', $data);
                $this->load->view('footer');
                return;
            }
            $this->karyawan_m->insert($row);
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
            $data['hero_employee_id'] = isset($data['karyawan']->hero_employee_id) ? $data['karyawan']->hero_employee_id : '';
            $data['error'] = '';
            $this->load->view('karyawan/edit_karyawan', $data);
            $this->load->view('footer');
        } else {
            $row = $this->_karyawan_row_from_post();
            if ($row === FALSE) {
                $data['karyawan'] = $this->karyawan_m->select($id);
                $data['karyawan']->nik = $this->input->post('nik');
                $data['karyawan']->nama = $this->input->post('nama');
                $data['karyawan']->email = $this->input->post('email');
                $data['select_jabatan'] = array('id_jabatan' => $this->input->post('id_jabatan'));
                $data['select_project'] = array('id_project' => $this->input->post('id_project'));
                $data['hero_employee_id'] = $this->input->post('hero_employee_id');
                $data['error'] = 'Arka Hero employee was not found. Search by name or current NIK and pick a person.';
                $this->load->view('karyawan/edit_karyawan', $data);
                $this->load->view('footer');
                return;
            }
            $this->karyawan_m->update($id, $row);
            redirect('karyawan');
        }
    }

    function search_hero() {
        $people = $this->karyawan_m->search_hero($this->input->get('q'));
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('data' => $people)));
    }

    function _karyawan_row_from_post() {
        $hero = $this->karyawan_m->confirmed_hero_employee_id($this->input->post('hero_employee_id'));
        if ($hero === FALSE) {
            return FALSE;
        }
        return array(
            'nik' => $this->input->post('nik'),
            'nama' => $this->input->post('nama'),
            'id_jabatan' => $this->input->post('id_jabatan'),
            'id_project' => $this->input->post('id_project'),
            'email' => $this->input->post('email'),
            'hero_employee_id' => $hero,
        );
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
