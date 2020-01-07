<?php

class Karyawan_m extends CI_Model {

    function selectAll() {
        return $this->db->query('select * from (karyawan k left outer join jabatan j on k.id_jabatan = j.id_jabatan) left outer join project p on k.id_project = p.id_project order by k.nik asc')->result();
    }
    
    function insert($set) {
        $this->db->insert('karyawan', $set);
    }
    
    function delete($id) {
        $this->db->where('id_karyawan', $id);
        $this->db->delete('karyawan');
    }
    
    function update($id) {
        $this->db->where('id_karyawan', $id)->update('karyawan', $_POST);
    }
    
    function select($id) {
        return $this->db->get_where('karyawan', array('id_karyawan'=>$id))->row();
    }
    
    function select_by_nik($nik) {
        $this->db->select('*');
        $this->db->from('karyawan');
        $this->db->join('jabatan','karyawan.id_jabatan = jabatan.id_jabatan','left outer');
        $this->db->join('project','karyawan.id_project = project.id_project','left outer');
		$this->db->join('departemen','departemen.id_dept = jabatan.id_dept','left outer');
        $this->db->where(array('karyawan.nik'=>$nik));
        $nik = $this->db->get()->row();
        return $nik;
    }
    
    function select_jabatan($id) {
        $this->db->select('jabatan.id_jabatan');
        $this->db->from('jabatan, karyawan');
        $this->db->where('jabatan.id_jabatan = karyawan.id_jabatan');
        $this->db->where(array('id_karyawan'=> $id));
        $id = $this->db->get()->row_array();
        return $id;
    }
    
    function select_project($id) {
        $this->db->select('project.id_project');
        $this->db->from('project, karyawan');
        $this->db->where('project.id_project = karyawan.id_project');
        $this->db->where(array('id_karyawan'=> $id));
        $id = $this->db->get()->row_array();
        return $id;
    }
    
    function select_dept($id) {
        $this->db->select('*');
        $this->db->from('karyawan, departemen, jabatan');
        $this->db->where('karyawan.id_jabatan = jabatan.id_jabatan');
        $this->db->where('departemen.id_dept = jabatan.id_dept');
        $this->db->where(array('karyawan.id_karyawan'=> $id));
        $id = $this->db->get()->row();
        return $id;
    }
    
    function getAllKaryawanByProject() {
            
            $nik = $this->session->userdata('nik');
            $kode_project = $this->login_m->dataPengguna($nik);
            
            return $this->db->query('select * from (karyawan k left outer join jabatan j on k.id_jabatan = j.id_jabatan) left outer join project p on k.id_project = p.id_project where p.kode_project = "'.$kode_project->kode_project.'"
            ORDER BY k.nik asc')->result();
        }
}
?>
