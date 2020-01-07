<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bast_m extends CI_Model {

	function insert($set) {
            $this->db->insert('bast', $set);
        }
        
        function update($no_bast) {
            $this->db->where('no_bast', $no_bast)->update('bast', $_POST);
        }
        
        function getAllBast() {
            return $this->db->query('
            select distinct 
            b1.no_bast, 
            b1.no_reg, 
            b1.date_bast, 
            b1.who_receive,
            k.nama,
            p.kode_project,
            p.nama_project
            from bast b1 
            left join karyawan k on b1.who_receive = k.id_karyawan
            left join project p on k.id_project = p.id_project
            order by b1.no_bast desc
            ')->result();
        }
        
        function getAllBastByDept() {
            $nik = $this->session->userdata('nik');
            $dept = $this->login_m->dataPengguna($nik);
            
            return $this->db->query('
            select distinct bast.no_bast, bast.date_bast, departemen.nama_dept, project.nama_project, project.kode_project from bast, perbekalan, karyawan, project, jabatan, departemen
            where bast.id_perbekalan = perbekalan.id_perbekalan 
            and bast.who_submit = karyawan.id_karyawan 
            and bast.who_receive = karyawan.id_karyawan 
            and perbekalan.id_karyawan = karyawan.id_karyawan
            and karyawan.id_project = project.id_project
            and karyawan.id_jabatan = jabatan.id_jabatan
            and jabatan.id_dept = departemen.id_dept
            and nama_dept = "'.$dept->nama_dept.'"
            ORDER BY id_bast desc')->result();
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
            return $query->result_array();
        }
        
        function who_submit($no_bast) {
            $this->db->select('*');
            $this->db->from('bast, karyawan, project, jabatan, departemen');
            $this->db->where('bast.who_submit = karyawan.id_karyawan');
            $this->db->where('karyawan.id_project = project.id_project');
            $this->db->where('karyawan.id_jabatan = jabatan.id_jabatan');
            $this->db->where('jabatan.id_dept = departemen.id_dept');
            $this->db->where(array('no_bast'=> $no_bast));
            $no_bast = $this->db->get()->row();
            return $no_bast;
        }
        
        function who_receive($no_bast) {
            $this->db->select('*');
            $this->db->from('bast, karyawan, project, jabatan, departemen');
            $this->db->where('bast.who_receive = karyawan.id_karyawan');
            $this->db->where('karyawan.id_project = project.id_project');
            $this->db->where('karyawan.id_jabatan = jabatan.id_jabatan');
            $this->db->where('jabatan.id_dept = departemen.id_dept');
            $this->db->where(array('no_bast'=> $no_bast));
            $no_bast = $this->db->get()->row();
            return $no_bast;
        }
    
        function select_submit($no_bast) {
            $this->db->select('bast.who_submit');
            $this->db->from('bast, karyawan');
            $this->db->where('bast.who_submit = karyawan.id_karyawan');
            $this->db->where(array('no_bast'=> $no_bast));
            $no_bast = $this->db->get()->row_array();
            return $no_bast;
        }
        
        function detail_aset($no_bast) {
            $this->db->select('*');
            $this->db->from('bast, perbekalan, aset');
            $this->db->where('bast.id_perbekalan = perbekalan.id_perbekalan');
            $this->db->where('perbekalan.id_aset = aset.id_aset');
            $this->db->where(array('no_bast'=> $no_bast));
            $no_bast = $this->db->get()->result();
            return $no_bast;
        }
        
        function detail_submit($submit) {
            $this->db->select('*');
            $this->db->from('karyawan, project, jabatan, departemen');
            $this->db->where('karyawan.id_project = project.id_project');
            $this->db->where('karyawan.id_jabatan = jabatan.id_jabatan');
            $this->db->where('jabatan.id_dept = departemen.id_dept');
            $this->db->where(array('nik'=> $submit));
            $no_bast = $this->db->get()->row();
            return $no_bast;
        }
        
        function detail_receive($receive) {
            $this->db->select('*');
            $this->db->from('karyawan, project, jabatan, departemen');
            $this->db->where('karyawan.id_project = project.id_project');
            $this->db->where('karyawan.id_jabatan = jabatan.id_jabatan');
            $this->db->where('jabatan.id_dept = departemen.id_dept');
            $this->db->where(array('nik'=> $receive));
            $no_bast = $this->db->get()->row();
            return $no_bast;
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
        
        function select($no_bast) {
            return $this->db->get_where('bast', array('no_bast'=>$no_bast))->row();
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
            $lists = $this->db->get()->result();
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

        function getBastDetail($no_bast) {
            $this->db->select('*');
            $this->db->from('bast');
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
            $this->db->where('bast.id_perbekalan = perbekalan.id_perbekalan');
            $this->db->where('bast.no_bast = "'. $no_bast.'"');
            $this->db->order_by('bast.no_bast','desc');
            $query = $this->db->get();
            return $query->result();
        }
        
        function getBast($no_bast) {
            $this->db->select('*');
            $this->db->from('bast');
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
            $this->db->where('bast.id_perbekalan = perbekalan.id_perbekalan');
            $this->db->where('bast.no_bast = "'. $no_bast.'"');
            $this->db->order_by('bast.no_bast','desc');
            $query = $this->db->get();
            return $query->row();
        }

        function generateAutoid(){ 

            $query=$this->db->query("select max(no_bast) as id from bast");
            $result = $query->row_array();
            $num = $result['id']+1;
            switch (strlen($num)){
            case 1 : $no_bast = "00000".$num; break; 
            case 2 : $no_bast = "0000".$num; break; 
            case 3 : $no_bast = "000".$num; break; 
            case 4 : $no_bast = "00".$num; break;      
            case 5 : $no_bast = "0".$num; break;
            default: $no_bast = $num;    
                }
            return $no_bast; 
        }

	function delete($no_bast) {
            $this->db->where('no_bast', $no_bast);
            $this->db->delete('bast');
        }
}

/* End of file perbekalan_m.php */
/* Location: ./application/models/perbekalan_m.php */