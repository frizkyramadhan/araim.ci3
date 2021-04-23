<?php

class Aset_m extends CI_Model {

    function selectAll() {
        return $this->db->query('select * from aset, kategori where aset.id_kategori = kategori.id_kategori')->result();
    }
    
    function insert($set) {
        $this->db->insert('aset', $set);
    }
    
    function delete($id) {
        $this->db->where('id_aset', $id);
        $this->db->delete('aset');
    }
    
    function update($id) {
        $this->db->where('id_aset', $id)->update('aset', $_POST);
    }
    
    function select($id) {
        return $this->db->get_where('aset', array('id_aset'=>$id))->row();
    }
    
    function select_kategori($id) {
        $this->db->select('kategori.id_kategori');
        $this->db->from('kategori, aset');
        $this->db->where('kategori.id_kategori = aset.id_kategori');
        $this->db->where(array('id_aset'=> $id));
        $this->db->order_by('nama_kategori','asc');
        $id = $this->db->get()->row_array();
        return $id;
    }

}
