<?php

class Projects extends CI_Controller
{


    //constructor
    function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->auth->checkLogin();
        $this->load->model('projects_model');
    }

    public function index() {
        $data['projects'] =  $this->projects_model->get_projects()->result_array();
        $this->load->view('admin/incs/header');
        $this->load->view('admin/projects', $data);
        $this->load->view('admin/incs/footer');
    }

    public function addProject() {
        $this->load->view('admin/incs/header');
        $this->load->view('admin/addProject');
        $this->load->view('admin/incs/footer');
    }
}