<?php

class Projects extends CI_Controller
{


    //constructor
    function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->auth->checkLogin();
    }

    public function index() {
        $this->load->view('admin/incs/header');
        $this->load->view('admin/projects');
        $this->load->view('admin/incs/footer');
    }
}