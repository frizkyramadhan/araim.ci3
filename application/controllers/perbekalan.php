<?php

class Perbekalan extends CI_Controller {

    function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') == FALSE){
            redirect('login/process_login');
        }else {
        $this->load->model('perbekalan_m');
        $this->load->model('karyawan_m');
        $this->load->model('aset_m');
        $this->load->model('login_m');
        }
    }
    
    public function index(){
        //penentuan judul
        $data['title'] = "Inventory Data";
    	$data['subtitle'] = "Inventory Data";
        //jika yg login orang HO, muncul semua data, jika yg login orang site, yg muncul hanya data site
        $nik = $this->session->userdata('nik');
        $data_pengguna = $this->login_m->dataPengguna($nik);
        $level = $data_pengguna->level;
        if ($level == 'Admin' || $level == 'Super User' || $level == 'Read Only') {
            $data['perbekalan'] = $this->perbekalan_m->getAllPerbekalan();
			$data['list'] = $this->perbekalan_m->getListPerbekalan();
        } else {
            $data['perbekalan'] = $this->perbekalan_m->getAllPerbekalanByDept();
			$data['list'] = $this->perbekalan_m->getListPerbekalan();
        }
        //penentuan tampilan header, navigation, isi
        $this->load->view('header', $data);
        $this->load->view('nav');
        $this->load->view('perbekalan/perbekalan', $data);
        $this->load->view('footer');
        
    }
    
    function add($nik) {
        $data['title'] = "Inventory Data";
        $data['subtitle'] = "Add Inventory Data";
        
        $this->load->view('header', $data);
        $this->load->view('nav');

        //penentuan dropdown aset
        $dbres_aset = $this->db->query('select * from aset, kategori where aset.id_kategori = kategori.id_kategori order by nama_kategori asc');
        $ddmenu_aset = array();
        foreach ($dbres_aset->result_array() as $tablerow) {
            $ddmenu_aset[$tablerow['id_aset']] = $tablerow['nama_aset']." - ".$tablerow['nama_kategori'];
        }
        $data['aset_options'] = $ddmenu_aset;
        
        $this->form_validation->set_rules("tanggal",'Date','required');
        $this->form_validation->set_rules("merk",'Merk','required');
        $this->form_validation->set_rules("model",'Model','required');
        $this->form_validation->set_rules("sn",'Serial Number','required|is_unique[perbekalan.sn]');
        $this->form_validation->set_rules("po",'PO','required');
		$this->form_validation->set_rules("jumlah",'Qty','required');
        $this->form_validation->set_rules("remarks",'Remarks','required');
		$this->form_validation->set_rules("spesifikasi",'Specification','required');
		$this->form_validation->set_rules("lokasi",'Location','required');
        
        if($this->form_validation->run()==FALSE){
            $user = $this->db->query("select * from karyawan where nik = ".$nik)->row();
            $data['user'] = $user;
            $data['no_inv'] = $this->perbekalan_m->generateAutoid();
            $this->load->view('perbekalan/add_perbekalan', $data);
            $this->load->view('footer');
        } else {
            $this->perbekalan_m->insert($_POST);
            redirect('perbekalan/detail/'.$nik);
        }
    }
    
    function add_multiple(){
        $data['title'] = "Inventory Data";
        $data['subtitle'] = "Add Inventory Data";
        $this->load->view('header', $data);
        $this->load->view('nav');
        
        $nik = $this->session->userdata('nik');
        $data_pengguna = $this->login_m->dataPengguna($nik);
        $kode_project = $data_pengguna->kode_project;
        if ($kode_project == '000H'){
            $dbres_nama = $this->db->query('select * from karyawan order by nik asc ');
        } else {
            $dbres_nama = $this->db->query('select * from karyawan, project where karyawan.id_project = project.id_project and project.kode_project = "'. $data_pengguna->kode_project.'" order by nik asc');
        }
        $ddmenu_nama = array();
        foreach ($dbres_nama->result_array() as $tablerow) {
            $ddmenu_nama[$tablerow['nik']] = $tablerow['nik'].' - '.$tablerow['nama'];
        }
        $data['nik'] = $ddmenu_nama;
        
        $this->form_validation->set_rules('banyak_data','Items','required|greater_than[0]');
        
        if($this->form_validation->run()==FALSE) {
            $this->load->view('perbekalan/add_multiple', $data);
            $this->load->view('footer');
        }else{
            redirect('perbekalan/add_multiple_post/'.$_POST['nik'].'/'.$_POST['banyak_data']);
        }
    }
    
    function add_multiple_post($nik, $banyak_data=0) {
        $data['title'] = "Inventory Data";
        $data['subtitle'] = "Add Inventory Data";
        $this->load->view('header', $data);
        $this->load->view('nav');
        
        $dbres_aset = $this->db->query('select * from aset, kategori where aset.id_kategori = kategori.id_kategori order by nama_kategori asc');
        $ddmenu_aset = array();
        foreach ($dbres_aset->result_array() as $tablerow) {
            $ddmenu_aset[$tablerow['id_aset']] = $tablerow['nama_aset']." - ".$tablerow['nama_kategori'];
        }
        $data['aset_options'] = $ddmenu_aset;
        
        $data['banyak_data'] = $banyak_data;
        
        for($i=1;$i<=$banyak_data;$i++){
            $this->form_validation->set_rules("data[$i][tanggal]",'Date','required');
            $this->form_validation->set_rules("data[$i][merk]",'Merk','required');
            $this->form_validation->set_rules("data[$i][model]",'Model','required');
            $this->form_validation->set_rules("data[$i][sn]",'Serial Number','required|is_unique[perbekalan.sn]');
			$this->form_validation->set_rules("data[$i][po]",'PO','required');
            $this->form_validation->set_rules("data[$i][jumlah]",'Qty','required');
            $this->form_validation->set_rules("data[$i][remarks]",'Remarks','required');
			$this->form_validation->set_rules("data[$i][spesifikasi]",'Specification','required');
			$this->form_validation->set_rules("data[$i][lokasi]",'Location','required');
        }
        
        if($this->form_validation->run()==FALSE) {    
            $data['nik'] = $nik;
            $data['detail'] = $this->perbekalan_m->getDataDetail($nik);
            $data['no_inv'] = $this->perbekalan_m->generateAutoid();
            $this->load->view('perbekalan/add_multiple_form',$data);
            $this->load->view('footer');
        }else {
            foreach($_POST['data'] as $d){
                $this->db->insert('perbekalan',$d);
            }
            redirect('perbekalan/detail/'.$nik);
        }
    }

    public function delete($nik){
        $this->perbekalan_m->deletePerbekalan($nik);
        redirect('perbekalan');
    }
    
    function delete_perbekalan($nik, $id) {
        $this->db->where('id_perbekalan', $id);
        $this->db->delete('perbekalan');
        
        redirect('perbekalan/detail/'.$nik);
    }
    
    function detail($nik) {
        $data['title'] = "Inventory Data";
        $data['subtitle'] = "Inventory Data Detail";
        $this->load->view('header', $data);
        $this->load->view('nav');
        
        $check = $this->input->post('check',true);
        if($check != ''){
            $checked = implode('/', $check);
        }
        $input = $this->session->userdata('nik');
        $pengguna = $this->login_m->dataPengguna($input);
        if($_POST == NULL){
            if ($pengguna->level == "User"){
                $data['detail'] = $this->perbekalan_m->getDataDetailByDept($nik);
            } else {
                $data['detail'] = $this->perbekalan_m->getDataDetail($nik);
            }
            
            $data['nik'] = $nik;    
            $this->load->view('perbekalan/detail', $data);
            $this->load->view('footer');
        }else{
            redirect('perbekalan/print_form/'.$checked);
        }
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
			$data['select_status'] = $this->perbekalan_m->select_status($id);
            $this->load->view('perbekalan/edit_perbekalan', $data);
            $this->load->view('footer');
        } else {
            $this->perbekalan_m->update($id);
            redirect('perbekalan/detail/'.$nik1);
        }
    }
    
    function transfer($no_inv, $id_perbekalan) {
        $data['title'] = "Inventory Data";
        $data['subtitle'] = "Transfer Inventory Data";
        $this->load->view('header', $data);
        $this->load->view('nav');
        
        $dbres_aset = $this->db->query('select * from aset order by nama_aset asc');
        $ddmenu_aset = array();
        foreach ($dbres_aset->result_array() as $tablerow) {
            $ddmenu_aset[$tablerow['id_aset']] = $tablerow['nama_aset'];
        }
        $data['aset_options'] = $ddmenu_aset;
        
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
            $ddmenu_nik[$tablerow['id_karyawan']] = $tablerow['nik'].' - '.$tablerow['nama'];
        }
        $data['nik_options'] = $ddmenu_nik;
        
        $this->form_validation->set_rules("tanggal",'Date','required');
        $this->form_validation->set_rules("remarks",'Remarks','required');
        
        //pengubahan status menjadi Mutated pada saat transfer di klik
        $this->db->set('status','Mutated');
        $this->db->where('id_perbekalan',$id_perbekalan);
        $this->db->update('perbekalan');
        
        if($this->form_validation->run()==FALSE){
            $data['transfer'] = $this->perbekalan_m->getInvByNo($id_perbekalan);
            $this->load->view('perbekalan/transfer', $data);
            $this->load->view('footer');
        } else {
            $this->perbekalan_m->insert($_POST);
            redirect('perbekalan');
        }
    }
    
    function print_form () {
        $data['lists'] = $this->perbekalan_m->getCheckedList();
        $this->load->view('perbekalan/print_form', $data);
    }
    
    // function execute(){
        // $perbekalan = $this->db->query('select * from perbekalan')->result();
        // foreach ($perbekalan as $id){
            // $this->db->set('input_by', 47);
            // $this->db->where('id_perbekalan', $id->id_perbekalan);
            // $this->db->update('perbekalan');
        // }
        // redirect('perbekalan');
    // }
	
	function export(){
        $header = $this->set_header();
        $data = array($header);
     
        $filename  = 'Arkananta Asset Inventory Management Report';
        $loop = 0;
        
        foreach($this->perbekalan_m->export() as $row){   
            $content[$loop] = array($row['no_inv'], $row['nama_aset'], $row['merk'], $row['model'], $row['tanggal'], $row['nama'], $row['nama_project']);
            array_push($data, $content[$loop]);
            $loop++;    
        }
        $this->load->helper('to_excel');
        array_to_excel($data, $filename);
        
    }
   
    function set_header(){
        return array('Inventory No.','Asset','Merk','Model','Date','PIC','Project');
    }

    function coba_qrcode(){
        $qrCode = new Endroid\QrCode\QrCode('Life is too short to be generating QR codes');

        header('Content-Type: '.$qrCode->getContentType());
        echo $qrCode->writeString();
    }

    function qrcode($nik, $id){
        $perbekalan = $this->perbekalan_m->detail_aset($id);
        //var_dump($perbekalan);
        $isi_teks = "No. Inventori = ".$perbekalan->no_inv."\n";
        $isi_teks .= "Nama Aset = ".$perbekalan->nama_aset."\n";
        $isi_teks .= "Merk = ".$perbekalan->merk."\n";
        $isi_teks .= "Model = ".$perbekalan->model."\n";
        $isi_teks .= "Spesifikasi = ".$perbekalan->spesifikasi."\n";
        $isi_teks .= "Lokasi = ".$perbekalan->lokasi."\n";
        $isi_teks .= "Keterangan = ".$perbekalan->remarks."\n";
        // $qrCode = new Endroid\QrCode\QrCode('No. Inventori = '.$perbekalan->no_inv.'');
        $qrCode = new Endroid\QrCode\QrCode($isi_teks);
        $qrCode->writeFile('img/qrcode/qr-'.$perbekalan->id_perbekalan.'.png');
        //$qrCode->setText($isi_teks);

        $this->db->set('qrcode','qr-'.$perbekalan->id_perbekalan.'.png');
        $this->db->where('id_perbekalan',$id);
        $this->db->update('perbekalan');  
        redirect('perbekalan/detail/'.$nik);
    }

    function delete_qrcode($nik, $id) {
        $this->db->where('id_perbekalan',$id);
        $query = $this->db->get('perbekalan');
        $row = $query->row();

        unlink("./img/qrcode/$row->qrcode");

        $data = array ('id_perbekalan' => $id, 'qrcode' => "");
        $this->db->where('id_perbekalan', $id);
        $this->db->update('perbekalan', $data);
        redirect('perbekalan/detail/'.$nik);
    }

    function print_qrcode($nik){
        $data['title'] = 'QR Code Inventory Data';
        $data['qrcode'] = $this->perbekalan_m->getQrcode($nik);
        $this->load->view('perbekalan/print_qrcode', $data);
        // $html = $this->load->view('perbekalan/print_qrcode', $data, true);
        // $this->fungsi->PdfGenerator($html, 'QR-Code', 'A4', 'Landscape');
    }
}
?>