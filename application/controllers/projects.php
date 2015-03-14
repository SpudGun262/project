<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('projects_model');
    }

    public function index() {
        $data['projects'] =  $this->projects_model->get_projects()->result_array();
        $this->load->view('incs/header');
        $this->load->view('projects', $data);
        $this->load->view('incs/footer');
    }
}