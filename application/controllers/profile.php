<?php

class Profile extends CI_Controller
{


    //constructor
    function __construct()
    {
        parent::__construct();
        $this->load->library('user_auth');
        $this->user_auth->checkLogin();
    }

    public function index() {
        $this->load->view('incs/header');
        $this->load->view('user/profile');
        $this->load->view('incs/footer');
    }
}