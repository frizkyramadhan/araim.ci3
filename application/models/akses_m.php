<?php

class Akses_m extends CI_Model {

    function selectAll() {
        return $this->db->query('select * from akses, karyawan, jabatan, departemen where akses.id_karyawan = karyawan.id_karyawan and karyawan.id_jabatan = jabatan.id_jabatan and jabatan.id_dept = departemen.id_dept')->result();
    }
    
    function get_by_nik($nik) {
        return $this->db->query("SELECT * FROM karyawan WHERE `nik` = ".$nik)->row_array();
    }
    
    function insert($set) {
        $this->db->insert('akses', $set);
    }
    
    function delete($id) {
        $this->db->where('id_akses', $id);
        $this->db->delete('akses');
    }
    
    function update($id) {
        $this->db->where('id_akses', $id)->update('akses', $_POST);
    }
    
    function select($id) {
        $this->db->select('nama, password, kode_project');
        $this->db->from('karyawan, akses, project');
        $this->db->where('karyawan.id_karyawan = akses.id_karyawan');
		$this->db->where('karyawan.id_project = project.id_project');
        $this->db->where(array('id_akses'=> $id));
        $id = $this->db->get()->row();
        return $id;
        
//        $sql = "SELECT karyawan.nama, akses.password 
//               FROM akses, karyawan 
//               WHERE akses.id_karyawan = karyawan.id_karyawan 
//               AND akses.id_akses = ?";
//        $this->db->query($sql, array($id));
        
//        return $this->db->get_where('akses, karyawan', array('id_akses'=>$id))->row();
    }
    
    function select_level($id) {
        $this->db->select('level');
        $this->db->from('akses');
        $this->db->where(array('id_akses'=> $id));
        $id = $this->db->get()->row_array();
        return $id;
    }
    
    function select_status($id) {
        $this->db->select('status');
        $this->db->from('akses');
        $this->db->where(array('id_akses'=> $id));
        $id = $this->db->get()->row_array();
        return $id;
    }

}
?>
