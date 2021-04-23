<?php

class Komponen extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('isLogin') == FALSE) {
            redirect('login/process_login');
        } else {
            $this->load->model('komponen_m');
            $this->load->model('login_m');
        }
    }

    function index()
    {
        $data['title'] = "Component Data";
        $data['subtitle'] = "Component Data";
        $data['komponen'] = $this->komponen_m->selectAll();
        $this->load->view('header', $data);
        $this->load->view('nav');
        $this->load->view('komponen/komponen', $data);
        $this->load->view('footer');
    }

    function add()
    {
        $data['title'] = "Component Data";
        $data['subtitle'] = "Add Component Data";
        $data['komponen'] = $this->komponen_m->selectAll();
        $this->load->view('header', $data);
        $this->load->view('nav');

        if ($_POST == NULL) {
            $this->load->view('komponen/add_komponen', $data);
            $this->load->view('footer');
        } else {
            $this->komponen_m->insert($_POST);
            redirect('komponen');
        }
    }

    function delete($id)
    {
        $this->komponen_m->delete($id);
        redirect('komponen');
    }

    function edit($id)
    {
        $data['title'] = "Component Data";
        $data['subtitle'] = "Edit Component Data";

        $this->load->view('header', $data);
        $this->load->view('nav');

        if ($_POST == NULL) {
            $data['komponen'] = $this->komponen_m->select($id);
            $this->load->view('komponen/edit_komponen', $data);
            $this->load->view('footer');
        } else {
            $this->komponen_m->update($id);
            redirect('komponen');
        }
    }
}
