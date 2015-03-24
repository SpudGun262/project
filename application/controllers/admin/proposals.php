<?php

class Proposals extends CI_Controller
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
        $this->load->helper('form', 'url');
    }

    public function index()
    {
        //run the get_proposals method in the proposals_model and assign the results to the $data['proposals'] variable
        $data['proposals'] = $this->proposals_model->get_proposals()->result_array();

        //load the correct views with the $data from the database
        $this->load->view('admin/incs/header');
        $this->load->view('admin/proposals', $data);
        $this->load->view('admin/incs/footer');
    }
}