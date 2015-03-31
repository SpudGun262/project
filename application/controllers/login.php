<?php

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('user_auth');
    }

    function index()
    {
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == true) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            if (!$this->user_auth->login($email, $password)) {
                $data['error'] = 'Incorrect username and password, try again.';
            }
        }
        $data = $this->session->flashdata('notice');
        $this->load->view('incs/header');
        $this->load->view('user/login', $data);
        $this->load->view('incs/footer');
    }

    function logout()
    {
        //flashdata message set to inform user of logout
        $this->session->set_flashdata('logout', 'You have successfully logged out');
        $this->user_auth->logout();

    }
}