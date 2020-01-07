<?php

class Bapb extends CI_Controller {

    function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') == FALSE){
            redirect('login/process_login');
        }else {
        $this->load->model('bapb_m');
        $this->load->model('perbekalan_m');
        $this->load->model('login_m');
        }
    }
    
    public function index(){
        //penentuan judul
        $data['title'] = "Form Berita Acara Peminjaman Barang";
    	$data['subtitle'] = "Form Berita Acara Peminjaman Barang";
        $nik = $this->session->userdata('nik');
        $data_pengguna = $this->login_m->dataPengguna($nik);
        $level = $data_pengguna->level;
//        if ($level == 'Admin' || $level == 'Super User') {
            $data['bapb'] = $this->bapb_m->getAllBapb();
//        } else {
//            $data['bapb'] = $this->bapb_m->getAllBastByDept();
//        }
        //penentuan tampilan header, navigation, isi
        $this->load->view('header', $data);
        $this->load->view('nav');
        $this->load->view('bapb/bapb', $data);
        $this->load->view('footer');
        
    }
    
    function add() {
        $data['title'] = "Form Berita Acara Peminjaman Barang";
        $data['subtitle'] = "Add Form Berita Acara Peminjaman Barang";
        
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
            $this->load->view('bapb/set_user', $data);
            $this->load->view('footer');
        }else{
            redirect('bapb/add_bapb/'.$_POST['submit'].'/'.$_POST['receive']);
        }
    }
    
    function add_bapb($submit, $receive) {
        $data['title'] = "Form Berita Acara Peminjaman Barang";
        $data['subtitle'] = "Add Form Berita Acara Peminjaman Barang";
        
        $this->load->view('header', $data);
        $this->load->view('nav');
        
        $this->form_validation->set_rules('id_perbekalan','Inventories','required');
        $this->form_validation->set_message('required','Please select at least one inventory!');
        
        if($this->form_validation->run()==FALSE){
            $data['perbekalan'] = $this->perbekalan_m->getDataDetail($receive);
            $data['submit'] = $this->bapb_m->detail_submit($submit);
            $data['receive'] = $this->bapb_m->detail_receive($receive);
            $data['no_bapb'] = $this->bapb_m->generateAutoid();
            $this->load->view('bapb/add_bapb', $data);
            $this->load->view('footer');
        } else {
            foreach($this->input->post('id_perbekalan') as $perbekalan){
                $detail = array(
                    'no_bapb' => $this->input->post('no_bapb'),
                    'no_reg' => $this->input->post('no_reg'),
                    'date_bapb' => $this->input->post('date_bapb'),
                    'who_submit' => $this->input->post('who_submit'),
                    'who_receive' => $this->input->post('who_receive'),
					'duration' => $this->input->post('duration'),
                    'id_perbekalan' => $perbekalan
                );
                $this->db->insert('bapb', $detail);
            }
            redirect('bapb');
        }
    }

    public function delete($no_bapb){
        $this->bapb_m->delete($no_bapb);
        redirect('bapb');
    }
    
    function delete_row($no_bapb, $id) {
        $this->db->where('id_bapb', $id);
        $this->db->delete('bapb');
        
        redirect('bapb/edit_bapb/'.$no_bapb);
    }
    
    function detail($no_bapb) {
        $data['title'] = "Form Berita Acara Peminjaman Barang";
        $data['subtitle'] = "Detail Form Berita Acara Peminjaman Barang";
        $this->load->view('header', $data);
        $this->load->view('nav');
        
        $data['no_bapb'] = $no_bapb;
        $data['detail'] = $this->bapb_m->getBapbDetail($no_bapb);
        $data['detail_row'] = $this->bapb_m->getBapb($no_bapb);
        $data['submit'] = $this->bapb_m->who_submit($no_bapb);
        $data['receive'] = $this->bapb_m->who_receive($no_bapb);
        
        $this->load->view('bapb/detail', $data);
        $this->load->view('footer');
    }
    
    function edit_bapb($no_bapb) {
        $data['title'] = "Form Berita Acara Peminjaman Barang";
        $data['subtitle'] = "Edit Form Berita Acara Peminjaman Barang";
        $this->load->view('header', $data);
        $this->load->view('nav');
        
        $data['no_bapb'] = $no_bapb;
        $data['detail'] = $this->bapb_m->getBapbDetail($no_bapb);
        $data['detail_row'] = $this->bapb_m->getBapb($no_bapb);
        $data['submit'] = $this->bapb_m->who_submit($no_bapb);
        $data['receive'] = $this->bapb_m->who_receive($no_bapb);
        $receive = $this->bapb_m->who_receive($no_bapb);
        $nik = $receive->nik;
        $data['list'] = $this->bapb_m->getDataDetail($nik);
        $data['perbekalan'] = $this->bapb_m->detail_aset($no_bapb);
        
        $dbres_submit = $this->db->query('select * from karyawan, jabatan, departemen where karyawan.id_jabatan = jabatan.id_jabatan and jabatan.id_dept = departemen.id_dept and departemen.id_dept = "5" order by nik asc');
        $ddmenu_submit = array();
        foreach ($dbres_submit->result_array() as $tablerow) {
            $ddmenu_submit[$tablerow['id_karyawan']] = $tablerow['nik'].' - '.$tablerow['nama'].' - '.$tablerow['nama_jabatan'];
        }
        $data['select_submit'] = $ddmenu_submit;
        $data['option_submit'] = $this->bapb_m->select_submit($no_bapb);
        
        $dbres_list = $this->db->query('select * from karyawan k, perbekalan p, aset a where k.id_karyawan = p.id_karyawan and p.id_aset = a.id_aset and k.nik = "'. $nik.'" order by p.tanggal desc');
        $ddmenu_list = array();
        foreach ($dbres_list->result_array() as $tablerow) {
            $ddmenu_list[$tablerow['id_perbekalan']] = $tablerow['no_inv'].' - '.$tablerow['nama_aset'].' - '.$tablerow['merk'].' - '.$tablerow['sn'].' - '.$tablerow['nama'];
        }
        $data['select_list'] = $ddmenu_list;
        
        if($_POST==NULL) {
            $this->load->view('bapb/edit_bapb', $data);
            $this->load->view('footer');
        }else{
            if (isset($_POST['id_perbekalan'])?$_POST['id_perbekalan']:''){
                foreach($this->input->post('id_perbekalan') as $perbekalan){
                    $detail = array(
                        'no_bapb' => $this->input->post('no_bapb'),
                        'no_reg' => $this->input->post('no_reg'),
                        'date_bapb' => $this->input->post('date_bapb'),
                        'who_submit' => $this->input->post('who_submit'),
                        'who_receive' => $this->input->post('who_receive'),
						'duration' => $this->input->post('duration'),
                        'id_perbekalan' => $perbekalan
                    );
                    $this->db->insert('bapb', $detail);
                }
            }else{
                $this->bapb_m->update($no_bapb);
            }
            redirect('bapb/detail/'.$no_bapb);
        }
    }
        
    function print_bapb($no_bapb) {
        $data['no_bapb'] = $no_bapb;
        $data['detail'] = $this->bapb_m->getBapbDetail($no_bapb);
        $data['detail_row'] = $this->bapb_m->getBapb($no_bapb);
        $data['submit'] = $this->bapb_m->who_submit($no_bapb);
        $data['receive'] = $this->bapb_m->who_receive($no_bapb);
        $this->load->view('bapb/report', $data);
    }
    
}

?>
