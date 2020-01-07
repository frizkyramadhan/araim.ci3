<?php

class Login extends CI_Controller {
   
    function __construct() {
        parent::__construct();
        $this->load->model('login_m');
        //$this->load->model('akses_m');
    }
    
    public function index() {
        $session = $this->session->userdata('isLogin');
        if($session == FALSE){
            redirect('login/process_login');
        }  else {
            redirect('welcome');
        }
    }
    
     public function process_login()
  {
    $this->form_validation->set_rules('nik', 'NIK', 'required|trim|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
    $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
    
      if($this->form_validation->run()==FALSE)
      {
        $this->load->view('login');
      }else
      {
       $nik = $this->input->post('nik');
       $password = $this->input->post('password');
       
       $cek = $this->login_m->ambilPengguna($nik, $password);
        
        if($cek <> 0)
        {
          $nama = $this->login_m->dataPengguna($nik);
          //$kode_project = $this->login_m->dataPengguna($nik);
          
          $this->session->set_userdata('isLogin', TRUE);
          $this->session->set_userdata('nik',$nik);
          $this->session->set_userdata('nama', $nama);
          $this->session->set_userdata('kode_project', $kode_project);
          $this->session->set_userdata('nama_dept', $nama_dept);
          $this->session->set_userdata('id_karyawan', $id_karyawan);
          
          
          redirect('welcome');
        }else
        {
         echo " <script>
		            alert('Login Failed! Check your NIK and Password, or contact IT Officer HO Balikpapan');
		            history.go(-1);
		          </script>";        
        }
      }  
  }
  
  function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
  
  
  public function logout()
  {
      $this->session->set_userdata(array(
          'nik' => ''
      ));
      $this->session->sess_destroy();
        redirect('login');
  }

}
?>
