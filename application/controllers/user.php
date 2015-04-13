<?php

/**
 * User
 *
 * @package    CI
 * @subpackage Controller
 * @author     Tom Walker
 *
 */
class User extends CI_Controller
{

    /**
     * Constructor
     *
     * Loads in all the models, helpers and other things necessary for this class to work
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('projects_model');
    }

    /**
     * Index Function
     *
     * Loads the sign up form
     */
    public function index() {

        //Load the header, sign up page and footer
        $this->load->view('incs/header');
        $this->load->view('user/signup');
        $this->load->view('incs/footer');
    }

    /**
     * Add User
     *
     * Check if the submitted form is valid and if so, adds the user to the database so they can login
     */
    public function addUser() {

        //Set the form validation
        $this->form_validation->set_rules('first_name', 'First Name', 'required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('email', 'Email may already taken and the', 'required|max_length[200]|xss_clean|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'password', 'required|max_length[200]|xss_clean|matches[passwordConfirm]');
        $this->form_validation->set_rules('passwordConfirm', 'confirm password', 'required|max_length[200]|xss_clean');


        //if the form passes validation then...
        if($this->form_validation->run()){

            //run the add_user method in the users_model
            $this->users_model->add_user();

            //redirect back to the home page
            redirect('home');

            //if the form fails validation then...
        } else {

            //gather the data from the database again and load the sign view
            //Any validation errors will be displayed on the page. This is done by validation_errors() method in the sign up view
            $data['user'] =  $this->users_model->get_users()->result_array();
            $this->load->view('incs/header');
            $this->load->view('user/signup', $data);
            $this->load->view('incs/footer');

        }

    }

    /**
     * User Profile Page
     *
     * Checks if the user is logged in and then loads there profile information for them
     */
    public function profile() {

        //Loads the user_auth library and checks that the user is authenticated
        $this->load->library('user_auth');
        $this->user_auth->checkLogin();

        //Gather data from the user model and store it in the variable $userResult
        $userResult = $this->users_model->get_user();

        //If no result is returned set a flashdata message and redirect to the home page
        if(!$userResult){
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this user does not exist <a href="#" class="close">&times;</a></div>');
            redirect('home');
        }

        //Store the user data in an array
        $data['userResult'] = $userResult->row_array();

        //Store any favourite the use has in an array
        $data['favourites'] = $this->projects_model->getFavourites()->result_array();

        //Load the header, user profile page with data and footer
        $this->load->view('incs/header');
        $this->load->view('user/profile', $data);
        $this->load->view('incs/footer');
    }

    /**
     * Update User
     *
     * When a form is submitted the form validation is check and if it passes the database is updated
     */
    public function updateUser() {

        //The form validation rules are set.
        $this->form_validation->set_rules('first_name', 'First Name', 'required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[200]|valid_email|xss_clean');

        //if the form passes validation then...
        if($this->form_validation->run()){

            //Run the updateUser method in the user model
            $this->users_model->updateUser();

            //Redirect to the user profile page
            redirect('user/profile');

        //If the validation fails then...
        } else {

            //Set a flashdata error message
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Failed to updated your profile.<a href="#" class="close">&times;</a></div>');

            //Redirect to the user profile page
            redirect('user/profile');
        }
    }

    /**
     * Change Password
     *
     * When the form is submitted the validation is check and a hash and salt is applied to the post data
     */
    public function changePassword() {

        //The form validation rules are set.
        $this->form_validation->set_rules('currentPassword', 'current password', 'required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('password', 'password', 'required|max_length[200]|xss_clean|matches[passwordConfirm]');
        $this->form_validation->set_rules('passwordConfirm', 'confirm new password', 'required|max_length[200]|xss_clean');

        //Get data from the user model and store it in $userResult
        $userResult = $this->users_model->get_user();

        //Turn the $userResult into a usable array
        $data['userResult'] = $userResult->row_array();

        //Hash and salt the password in the post data
        $currentPassword = hash('sha256', $this->input->post('currentPassword').SALT);

        //if the form passes validation then...
        if($this->form_validation->run() && $currentPassword == $data['userResult']['password']){

            //Run the changePassword method in the users model
            $this->users_model->changePassword();

            //Redirect to the user profile page
            redirect('user/profile');

        //If the validation fails then...
        } else {

            //Set a flashdata error message
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Failed to updated your password. Current password was incorrect.<a href="#" class="close">&times;</a></div>');

            //Redirect to the user profile page
            redirect('user/profile');
        }
    }

}