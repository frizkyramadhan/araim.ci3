<?php

class Karyawan_m extends CI_Model {

    function selectAll() {
        return $this->db->query('select * from (karyawan k left outer join jabatan j on k.id_jabatan = j.id_jabatan) left outer join project p on k.id_project = p.id_project order by k.nik asc')->result();
    }
    
    function insert($set) {
        $this->db->insert('karyawan', $set);
    }

    function ensure_hero_employee_id() {
        if ($this->db->field_exists('hero_employee_id', 'karyawan')) {
            return;
        }
        $this->db->query('ALTER TABLE `karyawan` ADD `hero_employee_id` varchar(36) DEFAULT NULL');
    }
    
    function delete($id) {
        $this->db->where('id_karyawan', $id);
        $this->db->delete('karyawan');
    }
    
    function update($id, $set) {
        $this->db->where('id_karyawan', $id)->update('karyawan', $set);
    }

    function search_hero($q) {
        $q = trim((string) $q);
        if (strlen($q) < 2) {
            return array();
        }
        $payload = $this->_hero_lookup(array('q' => $q));
        if (!is_array($payload) || !isset($payload['data']) || !is_array($payload['data'])) {
            return array();
        }
        $people = array();
        foreach ($payload['data'] as $row) {
            if (!is_array($row) || !isset($row['id']) || !$this->_is_uuid($row['id'])) {
                continue;
            }
            $people[] = array(
                'id' => $row['id'],
                'name' => isset($row['name']) ? $row['name'] : '',
                'nik' => isset($row['nik']) ? (string) $row['nik'] : '',
            );
        }
        return $people;
    }

    /**
     * Empty input stores NULL. A value is kept only when Hero's lookup
     * returns that same employees.id. Administration ids and bare NIKs are rejected.
     */
    function confirmed_hero_employee_id($id) {
        $id = trim((string) $id);
        if ($id === '') {
            return NULL;
        }
        if (!$this->_is_uuid($id)) {
            return FALSE;
        }
        $payload = $this->_hero_lookup(array('id' => $id));
        if (!is_array($payload) || !isset($payload['data'][0]['id']) || $payload['data'][0]['id'] === '') {
            return FALSE;
        }
        if (strcasecmp($payload['data'][0]['id'], $id) !== 0) {
            return FALSE;
        }
        return $payload['data'][0]['id'];
    }

    function _is_uuid($id) {
        return (bool) preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i', $id);
    }

    function _hero_lookup($query) {
        $base = $this->config->item('hero_api_base');
        if (!$base) {
            return NULL;
        }
        $url = rtrim($base, '/').'/api/employees/lookup?'.http_build_query($query);
        $body = $this->_hero_get($url);
        if ($body === NULL || $body === '') {
            return NULL;
        }
        $decoded = json_decode($body, TRUE);
        return is_array($decoded) ? $decoded : NULL;
    }

    function _hero_get($url) {
        $headers = array('Accept: application/json');
        $key = $this->config->item('hero_api_key');
        if ($key) {
            $headers[] = 'X-API-Key: '.$key;
        }
        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $body = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if ($body === FALSE || $code >= 400) {
                return NULL;
            }
            return $body;
        }
        $context = stream_context_create(array(
            'http' => array(
                'timeout' => 5,
                'header' => implode("\r\n", $headers)."\r\n",
            ),
        ));
        $body = @file_get_contents($url, FALSE, $context);
        return $body === FALSE ? NULL : $body;
    }
    
    function select($id) {
        return $this->db->get_where('karyawan', array('id_karyawan'=>$id))->row();
    }
    
    function select_by_nik($nik) {
        $this->db->select('*');
        $this->db->from('karyawan');
        $this->db->join('jabatan','karyawan.id_jabatan = jabatan.id_jabatan','left outer');
        $this->db->join('project','karyawan.id_project = project.id_project','left outer');
		$this->db->join('departemen','departemen.id_dept = jabatan.id_dept','left outer');
        $this->db->where(array('karyawan.nik'=>$nik));
        $nik = $this->db->get()->row();
        return $nik;
    }
    
    function select_jabatan($id) {
        $this->db->select('jabatan.id_jabatan');
        $this->db->from('jabatan, karyawan');
        $this->db->where('jabatan.id_jabatan = karyawan.id_jabatan');
        $this->db->where(array('id_karyawan'=> $id));
        $id = $this->db->get()->row_array();
        return $id;
    }
    
    function select_project($id) {
        $this->db->select('project.id_project');
        $this->db->from('project, karyawan');
        $this->db->where('project.id_project = karyawan.id_project');
        $this->db->where(array('id_karyawan'=> $id));
        $id = $this->db->get()->row_array();
        return $id;
    }
    
    function select_dept($id) {
        $this->db->select('*');
        $this->db->from('karyawan, departemen, jabatan');
        $this->db->where('karyawan.id_jabatan = jabatan.id_jabatan');
        $this->db->where('departemen.id_dept = jabatan.id_dept');
        $this->db->where(array('karyawan.id_karyawan'=> $id));
        $id = $this->db->get()->row();
        return $id;
    }
    
    function getAllKaryawanByProject() {
            
            $nik = $this->session->userdata('nik');
            $kode_project = $this->login_m->dataPengguna($nik);
            
            return $this->db->query('select * from (karyawan k left outer join jabatan j on k.id_jabatan = j.id_jabatan) left outer join project p on k.id_project = p.id_project where p.kode_project = "'.$kode_project->kode_project.'"
            ORDER BY k.nik asc')->result();
        }
}
?>
