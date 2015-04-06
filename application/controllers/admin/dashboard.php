<?php

class Dashboard extends CI_Controller
{


    //constructor
    function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->auth->checkLogin();
        $this->load->model('projects_model');
        $this->load->model('proposals_model');
    }

    public function index() {

        $data['expires'] =  $this->projects_model->checkExpiry()->result_array();
        $data['proposals'] = $this->proposals_model->checkInterest()->result_array();

        $this->load->view('admin/incs/header');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/incs/footer');
    }
}