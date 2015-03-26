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
        $this->load->model('tutors_model');
        $this->load->model('proposals_model');
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

    public function addProposal() {

        //The form validation rules are set. The proposal title and abstract are required for the validation to pass. It must also be clear of any code
        $this->form_validation->set_rules('proposal_title', 'Title', 'required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('desc', 'Description', 'required|xss_clean');

                //if the form passes validation then...
        if($this->form_validation->run()){

            //run the add_proposal method in the proposals_model
            $this->proposals_model->add_proposal();

            //redirect back to the proposals page
            redirect('admin/proposals');

            //if the form fails validation then...
        } else {

            //gather the data from the database again and load the proposals view
            //Any validation errors will be displayed on the page. This is done by validation_errors() method in the addProposal view
            $data['courses'] =  $this->courses_model->get_courses()->result_array();
            $data['tutors'] = $this->tutors_model->get_tutors()->result_array();
            $this->load->view('admin/incs/header');
            $this->load->view('admin/addProposal', $data);
            $this->load->view('admin/incs/footer');

        }
    }
}