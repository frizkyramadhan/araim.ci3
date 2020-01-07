<?php

class Project extends CI_Controller{
        
    function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') == FALSE){
            redirect('login/process_login');
        }else {
        $this->load->model('project_m');
        $this->load->model('login_m');
        }
    }
    
    function index() {
        $data['title'] = "Project Data";
        $data['subtitle'] = "Project Data";
        $data['project'] = $this->project_m->selectAll();
	$this->load->view('header', $data);
        $this->load->view('nav');
        $this->load->view('project/project', $data);
        $this->load->view('footer');
    }
    
    function add() {
        $data['title'] = "Project Data";
        $data['subtitle'] = "Add Project Data";
        $this->load->view('header', $data);
        $this->load->view('nav');
        if($_POST==NULL){
            $this->load->view('project/add_project');
            $this->load->view('footer');
        } else {
            $this->project_m->insert($_POST);
            redirect('project');
        }
    }
    
    function delete($id) {
        $this->project_m->delete($id);
        redirect('project');
    }
    
    function edit($id) {
        $data['title'] = "Project Data";
        $data['subtitle'] = "Edit Project Data";
        $this->load->view('header', $data);
        $this->load->view('nav');
        if($_POST==NULL){
            $data['project'] = $this->project_m->select($id);
            $this->load->view('project/edit_project', $data);
            $this->load->view('footer');
        } else {
            $this->project_m->update($id);
            redirect('project');
        }
    }
}
?>
