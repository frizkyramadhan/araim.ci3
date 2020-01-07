<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bapb_m extends CI_Model {

	function insert($set) {
            $this->db->insert('bapb', $set);
        }
        
        function update($no_bapb) {
            $this->db->where('no_bapb', $no_bapb)->update('bapb', $_POST);
        }
        
        function getAllBapb() {
            return $this->db->query('
            select distinct 
            b1.no_bapb, 
            b1.no_reg, 
            b1.date_bapb, 
            b1.who_receive,
			b1.duration,
            k.nama,
            p.kode_project,
            p.nama_project
            from bapb b1 
            left join karyawan k on b1.who_receive = k.id_karyawan
            left join project p on k.id_project = p.id_project
            order by b1.no_bapb desc
            ')->result();
        }
        
        function getAllBapbByDept() {
            $nik = $this->session->userdata('nik');
            $dept = $this->login_m->dataPengguna($nik);
            
            return $this->db->query('
            select distinct bapb.no_bapb, bapb.date_bapb, departemen.nama_dept, project.nama_project, project.kode_project from bapb, perbekalan, karyawan, project, jabatan, departemen
            where bapb.id_perbekalan = perbekalan.id_perbekalan 
            and bapb.who_submit = karyawan.id_karyawan 
            and bapb.who_receive = karyawan.id_karyawan 
            and perbekalan.id_karyawan = karyawan.id_karyawan
            and karyawan.id_project = project.id_project
            and karyawan.id_jabatan = jabatan.id_jabatan
            and jabatan.id_dept = departemen.id_dept
            and nama_dept = "'.$dept->nama_dept.'"
            ORDER BY id_bapb desc')->result();
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
        
        function who_submit($no_bapb) {
            $this->db->select('*');
            $this->db->from('bapb, karyawan, project, jabatan, departemen');
            $this->db->where('bapb.who_submit = karyawan.id_karyawan');
            $this->db->where('karyawan.id_project = project.id_project');
            $this->db->where('karyawan.id_jabatan = jabatan.id_jabatan');
            $this->db->where('jabatan.id_dept = departemen.id_dept');
            $this->db->where(array('no_bapb'=> $no_bapb));
            $no_bapb = $this->db->get()->row();
            return $no_bapb;
        }
        
        function who_receive($no_bapb) {
            $this->db->select('*');
            $this->db->from('bapb, karyawan, project, jabatan, departemen');
            $this->db->where('bapb.who_receive = karyawan.id_karyawan');
            $this->db->where('karyawan.id_project = project.id_project');
            $this->db->where('karyawan.id_jabatan = jabatan.id_jabatan');
            $this->db->where('jabatan.id_dept = departemen.id_dept');
            $this->db->where(array('no_bapb'=> $no_bapb));
            $no_bapb = $this->db->get()->row();
            return $no_bapb;
        }
    
        function select_submit($no_bapb) {
            $this->db->select('bapb.who_submit');
            $this->db->from('bapb, karyawan');
            $this->db->where('bapb.who_submit = karyawan.id_karyawan');
            $this->db->where(array('no_bapb'=> $no_bapb));
            $no_bapb = $this->db->get()->row_array();
            return $no_bapb;
        }
        
        function detail_aset($no_bapb) {
            $this->db->select('*');
            $this->db->from('bapb, perbekalan, aset');
            $this->db->where('bapb.id_perbekalan = perbekalan.id_perbekalan');
            $this->db->where('perbekalan.id_aset = aset.id_aset');
            $this->db->where(array('no_bapb'=> $no_bapb));
            $no_bapb = $this->db->get()->result();
            return $no_bapb;
        }
        
        function detail_submit($submit) {
            $this->db->select('*');
            $this->db->from('karyawan, project, jabatan, departemen');
            $this->db->where('karyawan.id_project = project.id_project');
            $this->db->where('karyawan.id_jabatan = jabatan.id_jabatan');
            $this->db->where('jabatan.id_dept = departemen.id_dept');
            $this->db->where(array('nik'=> $submit));
            $no_bapb = $this->db->get()->row();
            return $no_bapb;
        }
        
        function detail_receive($receive) {
            $this->db->select('*');
            $this->db->from('karyawan, project, jabatan, departemen');
            $this->db->where('karyawan.id_project = project.id_project');
            $this->db->where('karyawan.id_jabatan = jabatan.id_jabatan');
            $this->db->where('jabatan.id_dept = departemen.id_dept');
            $this->db->where(array('nik'=> $receive));
            $no_bapb = $this->db->get()->row();
            return $no_bapb;
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
        
        function select($no_bapb) {
            return $this->db->get_where('bapb', array('no_bapb'=>$no_bapb))->row();
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

        function getBapbDetail($no_bapb) {
            $this->db->select('*');
            $this->db->from('bapb');
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
            $this->db->where('bapb.id_perbekalan = perbekalan.id_perbekalan');
            $this->db->where('bapb.no_bapb = "'. $no_bapb.'"');
            $this->db->order_by('bapb.no_bapb','desc');
            $query = $this->db->get();
            return $query->result();
        }
        
        function getBapb($no_bapb) {
            $this->db->select('*');
            $this->db->from('bapb');
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
            $this->db->where('bapb.id_perbekalan = perbekalan.id_perbekalan');
            $this->db->where('bapb.no_bapb = "'. $no_bapb.'"');
            $this->db->order_by('bapb.no_bapb','desc');
            $query = $this->db->get();
            return $query->row();
        }

        function generateAutoid(){ 

            $query=$this->db->query("select max(no_bapb) as id from bapb");
            $result = $query->row_array();
            $num = $result['id']+1;
            switch (strlen($num)){
            case 1 : $no_bapb = "00000".$num; break; 
            case 2 : $no_bapb = "0000".$num; break; 
            case 3 : $no_bapb = "000".$num; break; 
            case 4 : $no_bapb = "00".$num; break;      
            case 5 : $no_bapb = "0".$num; break;
            default: $no_bapb = $num;    
                }
            return $no_bapb; 
        }

	function delete($no_bapb) {
            $this->db->where('no_bapb', $no_bapb);
            $this->db->delete('bapb');
        }
}

/* End of file perbekalan_m.php */
/* Location: ./application/models/perbekalan_m.php */