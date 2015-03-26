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

}