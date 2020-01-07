<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Departemen_m extends CI_Model {

    function selectAll() {
        return $this->db->order_by('nama_dept','asc')->get('departemen')->result();
    }
    
    function insert($set) {
        $this->db->insert('departemen', $set);
    }
    
    function delete($id) {
        $this->db->where('id_dept', $id);
        $this->db->delete('departemen');
    }
    
    function update($id) {
        $this->db->where('id_dept', $id)->update('departemen', $_POST);
    }
    
    function select($id) {
        return $this->db->get_where('departemen', array('id_dept'=>$id))->row();
    }

}
?>
