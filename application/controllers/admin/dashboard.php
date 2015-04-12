<?php

/**
 * Dashboard
 *
 * @package    CI
 * @subpackage Controller
 * @author     Tom Walker
 *
 */
class Dashboard extends CI_Controller
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
        $this->load->model('proposals_model');
    }

    /**
     * Index Function
     *
     * Gets data from both the projects and proposals model and passes it to the view in the $data variable
     * Loads the admin header, admin dashboard and admin footer views
     */
    public function index() {

        //checks for expired projects and returns the result as an array
        $data['expires'] =  $this->projects_model->checkExpiry()->result_array();
        //checks for student interest in project proposals and returns the result as an array
        $data['proposals'] = $this->proposals_model->checkInterest()->result_array();

        //loads the required views and passes over the data obtained above
        $this->load->view('admin/incs/header');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/incs/footer');
    }
}