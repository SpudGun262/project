<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddProject extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('projects_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['projects'] =  $this->projects_model->get_projects()->result_array();
        $this->load->view('admin/incs/header');
        $this->load->view('admin/addProject', $data);
        $this->load->view('admin/incs/footer');
    }
}
