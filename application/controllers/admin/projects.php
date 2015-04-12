<?php

/**
 * Projects
 *
 * @package    CI
 * @subpackage Controller
 * @author     Tom Walker
 *
 */
class Projects extends CI_Controller
{


    /**
     * Constructor
     *
     * Loads in all the models, helpers and other things necessary for this class to work
     */
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

    /**
     * Index Function
     *
     * Gets data from the projects model and passes it over to the view using $data['projects']
     * Loads the admin header, admin projects page and admin footer
     *
     */
    public function index() {
        //run the get_projects method in the projects_model and assign the results to the $data['projects'] variable
        $data['projects'] =  $this->projects_model->get_projects()->result_array();

        //load the correct views with the $data from the database
        $this->load->view('admin/incs/header');
        $this->load->view('admin/projects', $data);
        $this->load->view('admin/incs/footer');
    }

    /**
     * Add Project
     *
     * Adds a project to the database if the validation is met
     * Else the user is returned to the add project view
     */
    public function addProject() {

        //The form validation rules are set. The project title and abstract are required for the validation to pass. It must also be clear of any code
        $this->form_validation->set_rules('project_title', 'Title', 'required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('abstract', 'Abstract', 'required|xss_clean');

        //File upload conditions
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|pdf';
        $config['max_size']	= '10000';
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        $config['remove_spaces'] = TRUE;
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->do_upload();

        //Set the file input to true, it will be set to false if it fails validation
        $data['file'] = true;

        //Checks to see if the post data is set and contains a file that could have errors
        //It will set the file input to false if any errors are found
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

    /**
     * Edit Project
     *
     * When a particular project is selected it is loaded from the database and loads it
     * When a form is submitted it is sent to the model for update
     *
     * @param $project_id
     */
    public function editProject($project_id) {

        //Gets a certain project from from the projects model
        $projectResult = $this->projects_model->getProject($project_id);

        //If a result is not returned set an error message and redirect back to the projects page
        if(!$projectResult){
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this project does not exist</div>');
            redirect('admin/projects');
        }

        //Stored the returned data in the $data variable as an array
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

        //Set the file input to true, it will be set to false if it fails validation
        $data['file'] = true;

        //Checks to see if the post data is set and contains a file that could have errors
        //It will set the file input to false if any errors are found
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

    /**
     * Delete Project
     *
     * Deletes a project from the database by passing its ID over to the project model
     *
     * @param $project_id
     */
    public function deleteProject($project_id) {

        //Gets a certain project from from the projects model
        $projectResult = $this->projects_model->getProject($project_id);

        //If a result is not returned set an error message and redirect back to the projects page
        if(!$projectResult){
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this project does not exist <a href="#" class="close">&times;</a></div>');
            redirect('admin/projects');
        }

        //Stored the returned data in the $data variable as an array
        $data['projectResult'] = $projectResult->row_array();

        //Delete the project with the returned ID using the deleteProject method in the projects model
        $this->projects_model->deleteProject($project_id);


        //Set the returned data in variables so it can be accessed easily
        $id = $data['projectResult']['project_id'];
        $title = $data['projectResult']['title'];
        $abstract = $data['projectResult']['abstract'];
        $dateAdded = $data['projectResult']['date_added'];
        $tutorId = $data['projectResult']['tutor_id'];
        $courseId = $data['projectResult']['course_id'];

        //Set a flashdata message to inform the user of which item they have deleted
        $this->session->set_flashdata('notice', '<div data-alert class="alert-box secondary radius">You just deleted ' . $title . ' <a href="#" class="close">&times;</a></div>');

        //Redirect to the projects page
        redirect('admin/projects');

    }

    /**
     * Delete Expired Project
     *
     * Deletes a project from the database by passing its ID over to the project model
     *
     * @param $project_id
     */
    public function deleteExpiredProject($project_id) {

        //Gets a certain project from from the projects model
        $projectResult = $this->projects_model->getProject($project_id);

        //If a result is not returned set an error message and redirect back to the projects page
        if(!$projectResult){
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this project does not exist <a href="#" class="close">&times;</a></div>');
            redirect('admin/dashboard');
        }

        //Stored the returned data in the $data variable as an array
        $data['projectResult'] = $projectResult->row_array();

        //Delete the project with the returned ID using the deleteProject method in the projects model
        $this->projects_model->deleteProject($project_id);

        //Set the returned data in variables so it can be accessed easily
        $id = $data['projectResult']['project_id'];
        $title = $data['projectResult']['title'];
        $abstract = $data['projectResult']['abstract'];
        $dateAdded = $data['projectResult']['date_added'];
        $tutorId = $data['projectResult']['tutor_id'];
        $courseId = $data['projectResult']['course_id'];

        //Set a flashdata message to inform the user of which item they have deleted
        $this->session->set_flashdata('notice', '<div data-alert class="alert-box secondary radius">You just deleted <strong>' . $title . '</strong>. <a href="#" class="close">&times;</a></div>');

        //Redirect to the dashboard
        redirect('admin/dashboard');


    }

    /**
     * Extend Project
     *
     * Extends the expiration date of a project by 12 months
     *
     * @param $project_id
     */
    public function extendProject($project_id) {

        //Gets a certain project from from the projects model
        $projectResult = $this->projects_model->getProject($project_id);

        //If a result is not returned set an error message and redirect back to the projects page
        if(!$projectResult){
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this project does not exist <a href="#" class="close">&times;</a></div>');
            redirect('admin/dashboard');
        }

        //Stored the returned data in the $data variable as an array
        $data['projectResult'] = $projectResult->row_array();

        //Extend the project with the returned ID using the extendProject method in the projects model
        $this->projects_model->extendProject($project_id);

        //Set the returned data in variables so it can be accessed easily
        $id = $data['projectResult']['project_id'];
        $title = $data['projectResult']['title'];
        $abstract = $data['projectResult']['abstract'];
        $dateAdded = $data['projectResult']['date_added'];
        $tutorId = $data['projectResult']['tutor_id'];
        $courseId = $data['projectResult']['course_id'];

        //Set a flashdata message to inform the user of which item has been extended
        $this->session->set_flashdata('notice', '<div data-alert class="alert-box secondary radius row">Successfully extended <strong>' . $title . '</strong> by 12 months. <a href="#" class="close">&times;</a></div>');

        //Redirect to the dashboard
        redirect('admin/dashboard');
    }
}