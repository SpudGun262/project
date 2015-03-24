<?php

class Projects extends CI_Controller
{


    //constructor
    function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->auth->checkLogin();
        $this->load->model('projects_model');
        $this->load->model('courses_model');
        $this->load->library('form_validation');
        $this->load->helper('form', 'url');
    }

    public function index() {
        //run the get_projects method in the projects_model and assign the results to the $data['projects'] variable
        $data['projects'] =  $this->projects_model->get_projects()->result_array();

        //load the correct views with the $data from the database
        $this->load->view('admin/incs/header');
        $this->load->view('admin/projects', $data);
        $this->load->view('admin/incs/footer');
    }

    public function addProject() {

        //The form validation rules are set. The project title and abstract are required for the validation to pass. It must also be clear of any code
        $this->form_validation->set_rules('project_title', 'Title', 'required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('abstract', 'Abstract', 'required|max_length[200]|xss_clean');

        //File upload conditions
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|pdf';
        $config['max_size']	= '100';
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        $config['remove_spaces'] = TRUE;
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->do_upload();

        $data['file'] = true;

        if($this->input->post()) {
            if ($_FILES['userfile']['error'] != UPLOAD_ERR_NO_FILE) {
                if ($this->upload->display_errors() !== '') {
                    $data['file'] = false;
                }
            }
        }
        //if the form passes validation then...
        if($this->form_validation->run() == true && $data['file']){

            //run the add_project method in the projects_model
            $this->projects_model->add_project();

            //redirect back to the projects page
            redirect('admin/projects');

        //if the form fails validation then...
        } else {

            //gather the data from the database again and load the projects view
            //Any validation errors will be displayed on the page. This is done by validation_errors() method in the addProject view
            $data['courses'] =  $this->courses_model->get_courses()->result_array();
            $this->load->view('admin/incs/header');
            $this->load->view('admin/addProject', $data);
            $this->load->view('admin/incs/footer');

        }
    }

    public function editProject($project_id) {

        $projectResult = $this->projects_model->getProject($project_id);
        if(!$projectResult){
            //TODO: use flashdata and redirect back to projects root
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this project does not exist</div>');
            redirect('admin/projects');
        }
        $data['projectResult'] = $projectResult->row_array();

        //The form validation rules are set. The project title and abstract are required for the validation to pass. It must also be clear of any code
        $this->form_validation->set_rules('project_title', 'Title', 'required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('abstract', 'Abstract', 'required|xss_clean');

        //File upload conditions
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|pdf';
        $config['max_size']	= '100';
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        $config['remove_spaces'] = TRUE;
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->do_upload();

        $data['file'] = true;

        if($this->input->post()) {
            if ($_FILES['userfile']['error'] != UPLOAD_ERR_NO_FILE) {
                if ($this->upload->display_errors() !== '') {
                    $data['file'] = false;
                }
            }
        }
        //if the form passes validation then...
        if($this->form_validation->run() == true && $data['file']){

            //run the add_project method in the projects_model
            $this->projects_model->editProject($project_id);

            //redirect back to the projects page
            redirect('admin/projects');

            //if the form fails validation then...
        } else {

            //gather the data from the database again and load the projects view
            //Any validation errors will be displayed on the page. This is done by validation_errors() method in the addProject view
            $data['courses'] =  $this->courses_model->get_courses()->result_array();
            $this->load->view('admin/incs/header');
            $this->load->view('admin/editProject', $data);
            $this->load->view('admin/incs/footer');

        }
    }

    public function deleteProject($project_id) {

        $projectResult = $this->projects_model->getProject($project_id);
        if(!$projectResult){
            //TODO: use flashdata and redirect back to projects root
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this project does not exist <a href="#" class="close">&times;</a></div>');
            redirect('admin/projects');
        }
        $data['projectResult'] = $projectResult->row_array();

        $this->projects_model->deleteProject($project_id);

        $this->session->set_flashdata('notice', '<div data-alert class="alert-box secondary radius">You just deleted ' . $data['projectResult']['title'] . ' <a href="#" class="close">&times;</a></div>');

        redirect('admin/projects');


//        $print = print_r($projectResult);
//        $print2 = print_r($project_id);
//
//
//        $data2 = array(
//            $print,
//        $print2
//        );
//
//        $this->load->view('admin/projects', $data2);

    }
}