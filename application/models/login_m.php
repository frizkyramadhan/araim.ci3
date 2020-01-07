<?php

class Login_m extends CI_Model{
    
    function __construct() {
        $this->load->model('akses_m');
	$this->load->model('karyawan_m');
	$this->load->model('project_m');
    }
    
    var $table = 'akses, karyawan, project';
    
//    function check_nik($nik,$password) {
//        $query = $this->db->get_where($this->table, array ('nik'=>$nik, 'password'=>$password, 'status'=>'Enable'), 1, 0);
//        if($query->num_rows() > 0){
//            return TRUE;
//        } else {
//            return FALSE;
//        }
//    }
    
    public function ambilPengguna($nik, $password) {
        $this->db->select('*');
        $this->db->from('akses');
        $this->db->from('karyawan');
        $this->db->where('akses.id_karyawan = karyawan.id_karyawan');
        $this->db->where('karyawan.nik', $nik);
        $this->db->where('akses.password', $password);
        $this->db->where('akses.status = "Enable"');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function dataPengguna($nik)
    {
        $this->db->select('nik');
        $this->db->select('nama');
        $this->db->select('level');
        $this->db->select('kode_project');
        $this->db->select('nama_dept');
        $this->db->select('karyawan.id_karyawan');
        $this->db->from('akses');
        $this->db->from('karyawan');
        $this->db->from('project');
        $this->db->from('jabatan');
        $this->db->from('departemen');
        $this->db->where('akses.id_karyawan = karyawan.id_karyawan');
        $this->db->where('karyawan.id_project = project.id_project');
        $this->db->where('karyawan.id_jabatan = jabatan.id_jabatan');
        $this->db->where('jabatan.id_dept = departemen.id_dept');
        $this->db->where('nik', $nik);
        $query = $this->db->get();
        return $query->row();
    }
    
}

?>
