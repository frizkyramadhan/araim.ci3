<?php

class Bast extends CI_Controller {

    function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') == FALSE){
            redirect('login/process_login');
        }else {
        $this->load->model('bast_m');
        $this->load->model('perbekalan_m');
        $this->load->model('login_m');
        }
    }
    
    public function index(){
        //penentuan judul
        $data['title'] = "Form Berita Acara Serah Terima";
    	$data['subtitle'] = "Form Berita Acara Serah Terima";
        $nik = $this->session->userdata('nik');
        $data_pengguna = $this->login_m->dataPengguna($nik);
        $level = $data_pengguna->level;
//        if ($level == 'Admin' || $level == 'Super User') {
            $data['bast'] = $this->bast_m->getAllBast();
//        } else {
//            $data['bast'] = $this->bast_m->getAllBastByDept();
//        }
        //penentuan tampilan header, navigation, isi
        $this->load->view('header', $data);
        $this->load->view('nav');
        $this->load->view('bast/bast', $data);
        $this->load->view('footer');
        
    }
    
    function add() {
        $data['title'] = "Form Berita Acara Serah Terima";
        $data['subtitle'] = "Add Form Berita Acara Serah Terima";
        
        $this->load->view('header', $data);
        $this->load->view('nav');
        
        $dbres_submit = $this->db->query('select * from karyawan, jabatan, departemen where karyawan.id_jabatan = jabatan.id_jabatan and jabatan.id_dept = departemen.id_dept and departemen.id_dept = "5" order by nik asc');
        $ddmenu_submit = array();
        foreach ($dbres_submit->result_array() as $tablerow) {
            $ddmenu_submit[$tablerow['nik']] = $tablerow['nik'].' - '.$tablerow['nama'];
        }
        $data['submit'] = $ddmenu_submit;
        
        $dbres_receive = $this->db->query('select * from karyawan, jabatan, departemen where karyawan.id_jabatan = jabatan.id_jabatan and jabatan.id_dept = departemen.id_dept order by nik asc');
        $ddmenu_receive = array();
        foreach ($dbres_receive->result_array() as $tablerow) {
            $ddmenu_receive[$tablerow['nik']] = $tablerow['nik'].' - '.$tablerow['nama'];
        }
        $data['receive'] = $ddmenu_receive;
        
        if($_POST==NULL) {
            $this->load->view('bast/set_user', $data);
            $this->load->view('footer');
        }else{
            redirect('bast/add_bast/'.$_POST['submit'].'/'.$_POST['receive']);
        }
    }
    
    function add_bast($submit, $receive) {
        $data['title'] = "Form Berita Acara Serah Terima";
        $data['subtitle'] = "Add Form Berita Acara Serah Terima";
        
        $this->load->view('header', $data);
        $this->load->view('nav');
        
        $this->form_validation->set_rules('id_perbekalan','Inventories','required');
        $this->form_validation->set_message('required','Please select at least one inventory!');
        
        if($this->form_validation->run()==FALSE){
            $data['perbekalan'] = $this->perbekalan_m->getDataDetail($receive);
            $data['submit'] = $this->bast_m->detail_submit($submit);
            $data['receive'] = $this->bast_m->detail_receive($receive);
            $data['no_bast'] = $this->bast_m->generateAutoid();
            $this->load->view('bast/add_bast', $data);
            $this->load->view('footer');
        } else {
            foreach($this->input->post('id_perbekalan') as $perbekalan){
                $detail = array(
                    'no_bast' => $this->input->post('no_bast'),
                    'no_reg' => $this->input->post('no_reg'),
                    'date_bast' => $this->input->post('date_bast'),
                    'who_submit' => $this->input->post('who_submit'),
                    'who_receive' => $this->input->post('who_receive'),
                    'id_perbekalan' => $perbekalan
                );
                $this->db->insert('bast', $detail);
            }
            redirect('bast');
        }
    }

    public function delete($no_bast){
        $this->bast_m->delete($no_bast);
        redirect('bast');
    }
    
    function delete_row($no_bast, $id) {
        $this->db->where('id_bast', $id);
        $this->db->delete('bast');
        
        redirect('bast/edit_bast/'.$no_bast);
    }
    
    function detail($no_bast) {
        $data['title'] = "Form Berita Acara Serah Terima";
        $data['subtitle'] = "Detail Form Berita Acara Serah Terima";
        $this->load->view('header', $data);
        $this->load->view('nav');
        
        $data['no_bast'] = $no_bast;
        $data['detail'] = $this->bast_m->getBastDetail($no_bast);
        $data['detail_row'] = $this->bast_m->getBast($no_bast);
        $data['submit'] = $this->bast_m->who_submit($no_bast);
        $data['receive'] = $this->bast_m->who_receive($no_bast);
        
        $this->load->view('bast/detail', $data);
        $this->load->view('footer');
    }
    
    function edit_bast($no_bast) {
        $data['title'] = "Form Berita Acara Serah Terima";
        $data['subtitle'] = "Edit Form Berita Acara Serah Terima";
        $this->load->view('header', $data);
        $this->load->view('nav');
        
        $data['no_bast'] = $no_bast;
        $data['detail'] = $this->bast_m->getBastDetail($no_bast);
        $data['detail_row'] = $this->bast_m->getBast($no_bast);
        $data['submit'] = $this->bast_m->who_submit($no_bast);
        $data['receive'] = $this->bast_m->who_receive($no_bast);
        $receive = $this->bast_m->who_receive($no_bast);
        $nik = $receive->nik;
        $data['list'] = $this->bast_m->getDataDetail($nik);
        $data['perbekalan'] = $this->bast_m->detail_aset($no_bast);
        
        $dbres_submit = $this->db->query('select * from karyawan, jabatan, departemen where karyawan.id_jabatan = jabatan.id_jabatan and jabatan.id_dept = departemen.id_dept and departemen.id_dept = "5" order by nik asc');
        $ddmenu_submit = array();
        foreach ($dbres_submit->result_array() as $tablerow) {
            $ddmenu_submit[$tablerow['id_karyawan']] = $tablerow['nik'].' - '.$tablerow['nama'].' - '.$tablerow['nama_jabatan'];
        }
        $data['select_submit'] = $ddmenu_submit;
        $data['option_submit'] = $this->bast_m->select_submit($no_bast);
        
        $dbres_list = $this->db->query('select * from karyawan k, perbekalan p, aset a where k.id_karyawan = p.id_karyawan and p.id_aset = a.id_aset and k.nik = "'. $nik.'" order by p.tanggal desc');
        $ddmenu_list = array();
        foreach ($dbres_list->result_array() as $tablerow) {
            $ddmenu_list[$tablerow['id_perbekalan']] = $tablerow['no_inv'].' - '.$tablerow['nama_aset'].' - '.$tablerow['merk'].' - '.$tablerow['sn'].' - '.$tablerow['nama'];
        }
        $data['select_list'] = $ddmenu_list;
        
        if($_POST==NULL) {
            $this->load->view('bast/edit_bast', $data);
            $this->load->view('footer');
        }else{
            if (isset($_POST['id_perbekalan'])?$_POST['id_perbekalan']:''){
                foreach($this->input->post('id_perbekalan') as $perbekalan){
                    $detail = array(
                        'no_bast' => $this->input->post('no_bast'),
                        'no_reg' => $this->input->post('no_reg'),
                        'date_bast' => $this->input->post('date_bast'),
                        'who_submit' => $this->input->post('who_submit'),
                        'who_receive' => $this->input->post('who_receive'),
                        'id_perbekalan' => $perbekalan
                    );
                    $this->db->insert('bast', $detail);
                }
            }else{
                $this->bast_m->update($no_bast);
            }
            redirect('bast/detail/'.$no_bast);
        }
    }
        
    function print_bast($no_bast) {
        $data['no_bast'] = $no_bast;
        $data['detail'] = $this->bast_m->getBastDetail($no_bast);
        $data['detail_row'] = $this->bast_m->getBast($no_bast);
        $data['submit'] = $this->bast_m->who_submit($no_bast);
        $data['receive'] = $this->bast_m->who_receive($no_bast);
        $this->load->view('bast/report', $data);
    }
    
}

?>
