<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perbekalan_m extends CI_Model {

	function insert($set) {
            $this->db->insert('perbekalan', $set);
        }
        
        function update($id) {
            $this->db->where('id_perbekalan', $id)->update('perbekalan', $_POST);
        }
		
		function export() {
            return $this->db->query('
                select * from perbekalan, aset, karyawan, jabatan, departemen, project 
                where perbekalan.id_karyawan = karyawan.id_karyawan
                and perbekalan.id_aset = aset.id_aset 
                and karyawan.id_jabatan = jabatan.id_jabatan 
                and karyawan.id_project = project.id_project 
                and jabatan.id_dept = departemen.id_dept  
                order by perbekalan.tanggal desc')->result_array();
        }
        
        function select_nik($id) {
        $this->db->select('karyawan.id_karyawan');
        $this->db->from('karyawan, perbekalan');
        $this->db->where('karyawan.id_karyawan = perbekalan.id_karyawan');
        $this->db->where(array('id_perbekalan'=> $id));
        $id = $this->db->get()->row_array();
        return $id;
        }
		
		function select_status($id) {
        $this->db->select('perbekalan.status');
        $this->db->from('perbekalan');
        $this->db->where(array('id_perbekalan'=> $id));
        $id = $this->db->get()->row_array();
        return $id;
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
        return $this->db->get_where('perbekalan', array('id_perbekalan'=>$id))->row();
        }
        
        function getAllPerbekalan() {
            return $this->db->query('
            SELECT distinct karyawan.nik, karyawan.nama, project.kode_project, project.nama_project, jabatan.nama_jabatan 
            FROM perbekalan, karyawan, project, jabatan 
            where perbekalan.id_karyawan = karyawan.id_karyawan and karyawan.id_project = project.id_project and karyawan.id_jabatan = jabatan.id_jabatan 
            ORDER BY karyawan.nik asc')->result();
        }
		
		function getListPerbekalan(){
			$this->db->select('*');
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
			$this->db->order_by('perbekalan.tanggal','desc');
			$query = $this->db->get();
			return $query->result();
		}
        
        function getCheckedList() {
            $segs = $this->uri->segment_array();
            $this->db->select("*");
            $this->db->from('perbekalan');
            $this->db->where_in('id_perbekalan',$segs);
            $lists =  $this->db->get()->result();
            return $lists;
        }
        
        function getAllPerbekalanByDept() {
            
            $nik = $this->session->userdata('nik');
            $pengguna = $this->login_m->dataPengguna($nik);
            
            return $this->db->query('
                SELECT distinct k1.nik, k1.nama, project.kode_project, project.nama_project, j1.nama_jabatan 
                FROM perbekalan, karyawan k1, karyawan k2, project, jabatan j1, jabatan j2, departemen 
                where perbekalan.id_karyawan = k1.id_karyawan 
                and perbekalan.input_by = k2.id_karyawan
                and k1.id_project = project.id_project
                and k1.id_jabatan = j1.id_jabatan 
                and k2.id_jabatan = j2.id_jabatan 
                and j2.id_dept = departemen.id_dept 
                and departemen.nama_dept = "'.$pengguna->nama_dept.'"
                ORDER BY k1.nik asc')->result();
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
    
    function getDataDetail($nik) {
        $this->db->select('*');
        $this->db->from('perbekalan');
        $this->db->from('aset');
        $this->db->from('kategori');
        $this->db->from('karyawan');
        $this->db->from('jabatan');
        $this->db->from('project');
        $this->db->from('departemen');
        $this->db->where('karyawan.id_jabatan = jabatan.id_jabatan');
        $this->db->where('karyawan.id_project = project.id_project');
        $this->db->where('jabatan.id_dept = departemen.id_dept');
        $this->db->where('perbekalan.id_karyawan = karyawan.id_karyawan');
        $this->db->where('perbekalan.id_aset = aset.id_aset');
        $this->db->where('aset.id_kategori = kategori.id_kategori');
        $this->db->where('karyawan.nik = "'. $nik.'"');
        $this->db->order_by('perbekalan.tanggal','desc');
        $query = $this->db->get();
        return $query->result();
    }
    
    function getDataDetailByDept($nik) {
        $input = $this->session->userdata('nik');
        $pengguna = $this->login_m->dataPengguna($input);
        
        $this->db->select('*');
        $this->db->from('perbekalan');
        $this->db->from('aset');
        $this->db->from('kategori');
        $this->db->from('karyawan k1');
        $this->db->from('karyawan k2');
        $this->db->from('jabatan j1');
        $this->db->from('jabatan j2');
        $this->db->from('project');
        $this->db->from('departemen');
        $this->db->where('k1.id_jabatan = j1.id_jabatan');
        $this->db->where('k2.id_jabatan = j2.id_jabatan');
        $this->db->where('k1.id_project = project.id_project');
        $this->db->where('j2.id_dept = departemen.id_dept');
        $this->db->where('perbekalan.id_karyawan = k1.id_karyawan');
        $this->db->where('perbekalan.input_by = k2.id_karyawan');
        $this->db->where('perbekalan.id_aset = aset.id_aset');
        $this->db->where('aset.id_kategori = kategori.id_kategori');
        $this->db->where('k1.nik = "'. $nik.'"');
        $this->db->where('departemen.nama_dept = "'. $pengguna->nama_dept.'"');
        $this->db->order_by('perbekalan.tanggal','desc');
        $query = $this->db->get();
        return $query->result();
    }

    function getQrcode($nik) {
        $where = 'qrcode IS NOT NULL';
        $this->db->select('*');
        $this->db->from('perbekalan');
        $this->db->from('aset');
        $this->db->from('kategori');
        $this->db->from('karyawan');
        $this->db->from('jabatan');
        $this->db->from('project');
        $this->db->from('departemen');
        $this->db->where('karyawan.id_jabatan = jabatan.id_jabatan');
        $this->db->where('karyawan.id_project = project.id_project');
        $this->db->where('jabatan.id_dept = departemen.id_dept');
        $this->db->where('perbekalan.id_karyawan = karyawan.id_karyawan');
        $this->db->where('perbekalan.id_aset = aset.id_aset');
        $this->db->where('aset.id_kategori = kategori.id_kategori');
        $this->db->where('karyawan.nik = "'. $nik.'"');
        $this->db->where($where);
        $this->db->order_by('perbekalan.tanggal','desc');
        $query = $this->db->get();
        return $query->result();
    }
    
    function generateAutoid(){ 
             
        $query=$this->db->query("select max(id_perbekalan) as id from perbekalan");
        $result = $query->row_array();
        $num = $result['id']+1;
        switch (strlen($num)){
        case 1 : $no_inv = "00000".$num; break; 
        case 2 : $no_inv = "0000".$num; break; 
        case 3 : $no_inv = "000".$num; break; 
        case 4 : $no_inv = "00".$num; break;      
        case 5 : $no_inv = "0".$num; break;
        default: $no_inv = $num;    
            }
        return $no_inv; 
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

	function deletePerbekalan($nik){
		$this->db->query("delete pb from perbekalan pb inner join karyawan k on pb.id_karyawan = k.id_karyawan where k.nik = ".$nik);
	}
        
        function delete($id) {
            $this->db->where('id_perbekalan', $id);
            $this->db->delete('perbekalan');
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