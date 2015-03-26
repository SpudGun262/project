<?php

class Tutors extends CI_Controller
{


    //constructor
    function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->auth->checkLogin();
        $this->load->model('projects_model');
        $this->load->model('courses_model');
        $this->load->model('tutors_model');
        $this->load->library('form_validation');
        $this->load->helper('form', 'url');
    }

    public function index()
    {
        //run the get_tutors method in the tutors_model and assign the results to the $data['tutors'] variable
        $data['tutors'] = $this->tutors_model->get_tutors()->result_array();

        //load the correct views with the $data from the database
        $this->load->view('admin/incs/header');
        $this->load->view('admin/tutors', $data);
        $this->load->view('admin/incs/footer');
    }
    
    
    public function addTutor() {
        //The form validation rules are set. The tutor first name, last name and email are required for the validation to pass. It must also be clear of any code
        $this->form_validation->set_rules('first_name', 'First Name', 'required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('email', 'Email is already taken and the', 'required|max_length[200]|xss_clean|valid_email|is_unique[tutor.email]');

        
        //if the form passes validation then...
        if($this->form_validation->run()){

            //run the add_tutor method in the tutors_model
            $this->tutors_model->add_tutor();

            //redirect back to the tutors page
            redirect('admin/tutors');

            //if the form fails validation then...
        } else {

            //gather the data from the database again and load the tutors view
            //Any validation errors will be displayed on the page. This is done by validation_errors() method in the addTutor view
            $data['tutor'] =  $this->tutors_model->get_tutors()->result_array();
            $this->load->view('admin/incs/header');
            $this->load->view('admin/addTutor', $data);
            $this->load->view('admin/incs/footer');

        }
    }

}