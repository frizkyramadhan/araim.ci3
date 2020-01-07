<?php

class Jabatan_m extends CI_Model {

    function selectAll() {
        return $this->db->query('SELECT * FROM jabatan, departemen WHERE jabatan.id_dept = departemen.id_dept order by nama_dept asc')->result();
    }
    
    function insert($set) {
        $this->db->insert('jabatan', $set);
    }
    
    function delete($id) {
        $this->db->where('id_jabatan', $id);
        $this->db->delete('jabatan');
    }
    
    function update($id) {
        $this->db->where('id_jabatan', $id)->update('jabatan', $_POST);
    }
    
    function select($id) {
        return $this->db->get_where('jabatan', array('id_jabatan'=>$id))->row();
    }
    
    function select_departemen($id) {
        $this->db->select('departemen.id_dept');
        $this->db->from('departemen, jabatan');
        $this->db->where('departemen.id_dept = jabatan.id_dept');
        $this->db->where(array('id_jabatan'=> $id));
        $this->db->order_by('nama_dept','ASC');
        $id = $this->db->get()->row_array();
        return $id;
    }

}
?>
