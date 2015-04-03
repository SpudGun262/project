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


    public function viewProject($project_id) {

        $projectResult = $this->projects_model->getProject($project_id);
        if(!$projectResult){
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this project does not exist</div>');
            redirect('projects');
        }
        $data['projectResult'] = $projectResult->row_array();


        $this->load->view('incs/header');
        $this->load->view('project', $data);
        $this->load->view('incs/footer');
    }
}