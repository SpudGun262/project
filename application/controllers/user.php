<?php

class User extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
    }

    public function index() {
        $this->load->view('incs/header');
        $this->load->view('user/signup');
        $this->load->view('incs/footer');
    }

    public function addUser() {
        $this->form_validation->set_rules('first_name', 'First Name', 'required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('email', 'Email may already taken and the', 'required|max_length[200]|xss_clean|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'password', 'required|max_length[200]|xss_clean|matches[passwordConfirm]');
        $this->form_validation->set_rules('passwordConfirm', 'confirm password', 'required|max_length[200]|xss_clean');


        //if the form passes validation then...
        if($this->form_validation->run()){

            //run the add_tutor method in the tutors_model
            $this->users_model->add_user();

            //redirect back to the tutors page
            redirect('home');

            //if the form fails validation then...
        } else {

            //gather the data from the database again and load the tutors view
            //Any validation errors will be displayed on the page. This is done by validation_errors() method in the addTutor view
            $data['user'] =  $this->users_model->get_users()->result_array();
            $this->load->view('incs/header');
            $this->load->view('user/signup', $data);
            $this->load->view('incs/footer');

        }

    }

}