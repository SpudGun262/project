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
        $this->load->model('courses_model');
        $this->load->library('form_validation');
    }

    public function index() {
        //run the get_projects method in the projects_model and assign the results to the $data['projects'] variable
        $data['projects'] =  $this->projects_model->get_projects()->result_array();

        //load the correct views with the $data from the database
        $this->load->view('admin/incs/header');
        $this->load->view('admin/projects', $data);
        $this->load->view('admin/incs/footer');
    }

    public function addProject() {

        //The form validation rules are set. The project title and abstract are required for the validation to pass. It must also be clear of any code
        $this->form_validation->set_rules('project_title', 'Title', 'required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('abstract', 'Abstract', 'required|max_length[200]|xss_clean');

        //if the form passes validation then...
        if($this->form_validation->run() == true){

            //run the add_project method in the projects_model
            $this->projects_model->add_project();

            //gather the data from the database again and load the projects view
            $data['projects'] =  $this->projects_model->get_projects()->result_array();
            $this->load->view('admin/incs/header');
            $this->load->view('admin/projects', $data);
            $this->load->view('admin/incs/footer');

        //if the form fails validation then...
        } else {

            //gather the data from the database again and load the projects view
            //Any validation errors will be displayed on the page. This is done by validation_errors() method in the addProject view
            $data['courses'] =  $this->courses_model->get_courses()->result_array();
            $this->load->view('admin/incs/header');
            $this->load->view('admin/addProject', $data);
            $this->load->view('admin/incs/footer');

        }
    }
}