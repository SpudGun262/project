<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Projects
 *
 * @package    CI
 * @subpackage Controller
 * @author     Tom Walker
 *
 */
class Projects extends CI_Controller {

    /**
     * Constructor
     *
     * Loads in all the models, helpers and other things necessary for this class to work
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('projects_model');
    }

    /**
     * Index Function
     *
     * Gathers data from the projects model and passes it over to the view using $data['projects']
     * Loads the header, projects page and footer
     *
     */
    public function index() {
        $data['projects'] =  $this->projects_model->get_projects()->result_array();
        $this->load->view('incs/header');
        $this->load->view('projects', $data);
        $this->load->view('incs/footer');
    }


    /**
     * View Project
     *
     * Gets an individual project from the database and sends the data to the view using $data['projectResult'];
     *
     * @param $project_id
     */
    public function viewProject($project_id) {

        //Gets a certain project from from the projects model
        $projectResult = $this->projects_model->getProject($project_id);

        //If a result is not returned set an error message and redirect back to the projects page
        if(!$projectResult){
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this project does not exist</div>');
            redirect('projects');
        }

        //Stored the returned data in the $data variable as an array
        $data['projectResult'] = $projectResult->row_array();

        //Load the header, project page with data and footer
        $this->load->view('incs/header');
        $this->load->view('project', $data);
        $this->load->view('incs/footer');
    }

    /**
     * Favourite A Project
     *
     * Finds the individual project the user wants to favourite and sends the data to the projects model to be added
     *
     * @param $project_id
     */
    public function favourite($project_id) {

        //Gets a certain project from from the projects model
        $projectResult = $this->projects_model->getProject($project_id);

        //If a result is not returned set an error message and redirect back to the project page the user was already on
        if(!$projectResult){
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this project does not exist</div>');

            //Redirect back to the page the user was on
            $redirect = 'projects/viewProject/' . $project_id;
            redirect($redirect);
        }

        //Run the favourite method in the projects model using the project ID that has been passed over
        $this->projects_model->favourite($project_id);

        //Inform the user of a successful add
        $this->session->set_flashdata('notice', '<div data-alert class="alert-box success radius">This project has been added to your favourites. You can find them in your <a href="' . base_url('user/profile') . '">profile page.</a></div>');

        //Redirect back to the page the user was on
        $redirect = 'projects/viewProject/' . $project_id;
        redirect($redirect);
    }

    /**
     * Delete A Favourite
     *
     * Deletes a previously made favourite using the project ID
     *
     * @param $project_id
     */
    public function deleteFavourite($project_id){

        //Send the project ID over to the deleteFavourite method in the projects model
        $this->projects_model->deleteFavourite($project_id);

        //Inform the user that they have removed the favourite
        $this->session->set_flashdata('notice', '<div data-alert class="alert-box secondary radius">Successfully removed a project from your favourites. <a href="#" class="close">&times;</a></div>');

        //Redirect back to the user profile page
        redirect('user/profile');
    }


}