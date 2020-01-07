<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_m extends CI_Model {

	function insert($set) {
            $this->db->insert('form', $set);
        }
        
        function update($id) {
            $this->db->where('id_form', $id)->update('form', $_POST);
        }
        
        function getAllForm() {
            return $this->db->query('
            select distinct form.no_form, form.date, departemen.nama_dept, project.nama_project, project.kode_project from form, perbekalan, karyawan, project, jabatan, departemen
            where form.id_perbekalan = perbekalan.id_perbekalan 
            and perbekalan.input_by = karyawan.id_karyawan
            and karyawan.id_project = project.id_project
            and karyawan.id_jabatan = jabatan.id_jabatan
            and jabatan.id_dept = departemen.id_dept
            ORDER BY id_form desc')->result();
        }
        
        function getAllFormByDept() {
            $nik = $this->session->userdata('nik');
            $dept = $this->login_m->dataPengguna($nik);
            
            return $this->db->query('
            select distinct form.no_form, form.date, departemen.nama_dept, project.nama_project, project.kode_project from form, perbekalan, karyawan, project, jabatan, departemen
            where form.id_perbekalan = perbekalan.id_perbekalan 
            and perbekalan.input_by = karyawan.id_karyawan
            and karyawan.id_project = project.id_project
            and karyawan.id_jabatan = jabatan.id_jabatan
            and jabatan.id_dept = departemen.id_dept
            and nama_dept = "'.$dept->nama_dept.'"
            ORDER BY id_form desc')->result();
        }
        
        function getAllPerbekalanByDept() {
            
            $nik = $this->session->userdata('nik');
            $dept = $this->login_m->dataPengguna($nik);
            
            return $this->db->query('
            select * from perbekalan, aset, karyawan k1, karyawan k2, project, jabatan, departemen
            where perbekalan.id_aset = aset.id_aset
            and perbekalan.input_by = k1.id_karyawan
            and perbekalan.id_karyawan = k2.id_karyawan
            and k2.id_project = project.id_project
            and k1.id_jabatan = jabatan.id_jabatan
            and jabatan.id_dept = departemen.id_dept
            and nama_dept = "'.$dept->nama_dept.'"
            ORDER BY id_perbekalan desc')->result();
        }
        
        function getAllPerbekalanByDeptAndName($id) {
            $this->db->select('*');
            $this->db->from('perbekalan, karyawan');
            $this->db->where('karyawan.id_karyawan = perbekalan.id_karyawan');
            $this->db->where(array('id_perbekalan'=> $id));
            $id = $this->db->get()->row();
            return $id;
        }
        
        function inputBy($no_form) {
        $this->db->select('*');
        $this->db->from('form, karyawan, project, jabatan, departemen');
        $this->db->where('form.input_by = karyawan.id_karyawan');
        $this->db->where('karyawan.id_project = project.id_project');
        $this->db->where('karyawan.id_jabatan = jabatan.id_jabatan');
        $this->db->where('jabatan.id_dept = departemen.id_dept');
        $this->db->where(array('no_form'=> $no_form));
        $no_form = $this->db->get()->row_array();
        return $no_form;
         }
    
        function select_aset($id) {
        $this->db->select('aset.id_aset');
        $this->db->from('aset, perbekalan');
        $this->db->where('aset.id_aset = perbekalan.id_aset');
        $this->db->where(array('id_perbekalan'=> $id));
        $id = $this->db->get()->row_array();
        return $id;
        }
        
        function detail_aset($id) {
        $this->db->select('*');
        $this->db->from('aset, perbekalan, karyawan');
        $this->db->where('aset.id_aset = perbekalan.id_aset');
        $this->db->where('karyawan.id_karyawan = perbekalan.id_karyawan');
        $this->db->where(array('id_perbekalan'=> $id));
        $id = $this->db->get()->row();
        return $id;
        }
        
        function getInvByNo($id) {
        $this->db->select('*');
        $this->db->from('aset, perbekalan, karyawan');
        $this->db->where('aset.id_aset = perbekalan.id_aset');
        $this->db->where('karyawan.id_karyawan = perbekalan.id_karyawan');
        $this->db->where(array('id_perbekalan'=> $id));
        $id = $this->db->get()->row();
        return $id;
        }
        
        function select($id) {
        return $this->db->get_where('form', array('id_form'=>$id))->row();
        }
        
        function getAllPerbekalan() {
            return $this->db->query('
            SELECT distinct karyawan.nik, karyawan.nama, project.kode_project, project.nama_project, jabatan.nama_jabatan 
            FROM perbekalan, karyawan, project, jabatan 
            where perbekalan.id_karyawan = karyawan.id_karyawan and karyawan.id_project = project.id_project and karyawan.id_jabatan = jabatan.id_jabatan 
            ORDER BY karyawan.nik asc')->result();
        }
        
        function getCheckedList() {
            $segs = $this->uri->segment_array();
            $this->db->select("*");
            $this->db->from('perbekalan');
            $this->db->where_in('id_perbekalan',$segs);
            $lists =  $this->db->get()->result();
            return $lists;
        }
        
        function getKategoriList(){
            $result = array();
            $this->db->select('*');
            $this->db->from('kategori');
            $this->db->order_by('nama_kategori','ASC');
            $array_keys_values = $this->db->get();
            foreach ($array_keys_values->result() as $row)
            {
                $result[0]= '-Pilih Kategori-';
                $result[$row->id_kategori]= $row->nama_kategori;
            }
 
        return $result;
    }
 
    function getAsetList(){
        $kategori_id = $this->input->post('id_kategori');
        $result = array();
        $this->db->select('*');
        $this->db->from('aset');
        $this->db->where('id_kategori',$kategori_id);
        $this->db->order_by('nama_aset','ASC');
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-Pilih Aset-';
            $result[$row->id_aset]= $row->nama_aset;
        }
 
        return $result;
    }
    
    function getFormDetail($no_form) {
        $this->db->select('*');
        $this->db->from('form');
        $this->db->from('perbekalan');
        $this->db->from('aset');
        $this->db->from('karyawan');
        $this->db->from('jabatan');
        $this->db->from('project');
        $this->db->from('departemen');
        $this->db->where('karyawan.id_jabatan = jabatan.id_jabatan');
        $this->db->where('karyawan.id_project = project.id_project');
        $this->db->where('jabatan.id_dept = departemen.id_dept');
        $this->db->where('perbekalan.id_karyawan = karyawan.id_karyawan');
        $this->db->where('perbekalan.id_aset = aset.id_aset');
        $this->db->where('form.id_perbekalan = perbekalan.id_perbekalan');
        $this->db->where('form.no_form = "'. $no_form.'"');
        $this->db->order_by('form.no_form','desc');
        $query = $this->db->get();
        return $query->result();
    }
    
    function generateAutoid(){ 
             
        $query=$this->db->query("select max(id_form) as id from form");
        $result = $query->row_array();
        $num = $result['id']+1;
        switch (strlen($num)){
        case 1 : $no_form = "00000".$num; break; 
        case 2 : $no_form = "0000".$num; break; 
        case 3 : $no_form = "000".$num; break; 
        case 4 : $no_form = "00".$num; break;      
        case 5 : $no_form = "0".$num; break;
        default: $no_form = $num;    
            }
        return $no_form; 
    }

//	function getAllPerbekalan(){
//		return $this->db->query("SELECT b.`id_perbekalan`,a.`nik`,a.`nama`,c.`nama_aset`,`jumlah`,`remarks`,`tanggal` 
//                    FROM karyawan a JOIN perbekalan b ON a.`id_karyawan`=b.`id_karyawan`
//                    JOIN `aset` c ON b.`id_aset`=c.`id_aset`")->result_array();
//	}
        
//        function get_karyawan_by_nik($nik) {
//            return $this->db->query('SELECT karyawan.nik, karyawan.nama, jabatan.nama_jabatan, departemen.nama_dept, project.nama_project
//            FROM karyawan, jabatan, departemen, project
//            WHERE karyawan.id_jabatan=jabatan.id_jabatan
//            AND jabatan.id_dept=departemen.id_dept
//            AND karyawan.id_project=project.id_project
//            AND karyawan.nik ='.$nik)->result_array();
//        }
//        
//        function get_perbekalan_by_nik($nik) {
//            return $this->db->query('SELECT perbekalan.id_perbekalan, karyawan.id_karyawan, karyawan.nik, karyawan.nama, jabatan.nama_jabatan, departemen.nama_dept, project.nama_project, aset.nama_aset, kategori.nama_kategori, perbekalan.jumlah, perbekalan.remarks, perbekalan.tanggal
//                            FROM perbekalan, karyawan, aset, kategori, jabatan, departemen, project
//                            WHERE perbekalan.id_karyawan=karyawan.id_karyawan
//                            AND perbekalan.id_aset=aset.id_aset
//                            AND karyawan.id_jabatan=jabatan.id_jabatan
//                            AND jabatan.id_dept=departemen.id_dept
//                            AND karyawan.id_project=project.id_project
//                            AND aset.id_kategori=kategori.id_kategori
//                            AND karyawan.nik ='.$nik)->result_array();
//        }

	function deleteForm($no_form){
		$this->db->query("delete pb from perbekalan pb inner join karyawan k on pb.id_karyawan = k.id_karyawan where k.nik = ".$nik);
	}
        
        function delete($no_form) {
            $this->db->where('no_form', $no_form);
            $this->db->delete('form');
        }

//	function getPerbekalanById($id){
//		return $this->db->query("SELECT * FROM perbekalan WHERE `id_perbekalan` = ".$id)->result_array();
//	}

//	function updatePerbekalan($id,$idKaryawan,$idAsset,$jumlah,$remarks,$tanggal){
//		$this->db->query("UPDATE `perbekalan`
//							SET `id_karyawan` = '".$idKaryawan."',
//							  `id_aset` = '".$idAsset."',
//							  `jumlah` = '".$jumlah."',
//							  `remarks` = '".$remarks."',
//							  `tanggal` = '".$tanggal."'
//							WHERE `id_perbekalan` = '".$id."';");
//	}
        
//        function get_search() {
//            $match = $this->input->post('nik');
//            $this->db->select('*');
//            //$this->db->from('perbekalan, karyawan, aset');
//            $this->db->where('perbekalan.id_karyawan = karyawan.id_karyawan');
//            $this->db->where('perbekalan.id_aset = aset.id_aset');
//            $this->db->like('karyawan.nik',$match);
//            $query = $this->db->get('perbekalan, karyawan, aset');
//            return $query->row();
//        }

}

/* End of file perbekalan_m.php */
/* Location: ./application/models/perbekalan_m.php */