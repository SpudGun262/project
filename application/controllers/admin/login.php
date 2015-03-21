<?php

class Login extends CI_Controller {

    // variables

    //constructor
    function __construct(){
        parent ::__construct();
        $this->load->library('auth');
    }


    function index() {
        $this->form_validation->set_rules('username','username','trim|required|xss_clean');
        $this->form_validation->set_rules('password','password','trim|required|xss_clean');
        if($this->form_validation->run() == true){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if(!$this->auth->login($username, $password)) {
                $data['error'] = 'Incorrect username and password, try again.';
            }
        }
        $this->load->view('admin/incs/header');
        $this->load->view('admin/login', $data);
        $this->load->view('admin/incs/footer');
    }

    function logout() {
        //flashdata message set to inform user of logout
        $this->session->set_flashdata('logout', 'You have successfully logged out');
        $this->auth->logout();

    }

}