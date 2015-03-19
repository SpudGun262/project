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
        $this->load->library('form_validation');
    }

    public function index() {
        $data['projects'] =  $this->projects_model->get_projects()->result_array();
        $this->load->view('admin/incs/header');
        $this->load->view('admin/projects', $data);
        $this->load->view('admin/incs/footer');
    }

    public function addProject() {

        //The form validation rules are set. The poll title is required for the validation to pass. It must also be clear of any code
        $this->form_validation->set_rules('project_title', 'Title', 'required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('abstract', 'Abstract', 'required|max_length[200]|xss_clean');

        if($this->form_validation->run() == true){

            echo 'Passed Validation';

        } else {

            $this->load->view('admin/incs/header');
            $this->load->view('admin/addProject');
            $this->load->view('admin/incs/footer');

        }
    }
}