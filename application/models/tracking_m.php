<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracking_m extends CI_Model {

	function search($keyword) {
            $this->db->select('*');
            $this->db->from('perbekalan, aset, karyawan');
            $this->db->where('perbekalan.id_aset = aset.id_aset');
            $this->db->where('perbekalan.id_karyawan = karyawan.id_karyawan');
            $this->db->like('karyawan.nik',$keyword);
            $this->db->or_like('perbekalan.no_inv',$keyword);
            $this->db->or_like('perbekalan.sn',$keyword);
            $this->db->or_like('perbekalan.pn',$keyword);
            $this->db->or_like('perbekalan.merk',$keyword);
            $this->db->or_like('perbekalan.model',$keyword);
            $this->db->or_like('aset.nama_aset',$keyword);
        }
        
        function get(){
            $this->db->distinct('no_inv, sn, pn');
            $query = $this->db->get('perbekalan');
            if($query->num_rows > 0){
              foreach ($query->result_array() as $row){
                $row_set[] = htmlentities(stripslashes($row['no_inv'])); //build an array
                $row_set[] = htmlentities(stripslashes($row['sn'])); //build an array
                $row_set[] = htmlentities(stripslashes($row['pn'])); //build an array
              }
              echo json_encode($row_set); //format the array into json data
            }
          }
}

/* End of file perbekalan_m.php */
/* Location: ./application/models/perbekalan_m.php */