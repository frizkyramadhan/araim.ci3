<?php

class Komponen_m extends CI_Model
{

    function selectAll()
    {
        return $this->db->query('select * from komponen order by komponen asc')->result();
    }

    function insert($set)
    {
        $this->db->insert('komponen', $set);
    }

    function delete($id)
    {
        $this->db->where('id_komponen', $id);
        $this->db->delete('komponen');
    }

    function update($id)
    {
        $this->db->where('id_komponen', $id)->update('komponen', $_POST);
    }

    function select($id)
    {
        return $this->db->get_where('komponen', array('id_komponen' => $id))->row();
    }
}
