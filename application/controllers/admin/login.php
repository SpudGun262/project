<?php

/**
 * Login
 *
 * @package    CI
 * @subpackage Controller
 * @author     Tom Walker
 *
 */
class Login extends CI_Controller {


    /**
     * Constructor
     *
     * Loads in all the models, helpers and other things necessary for this class to work
     */
    function __construct(){
        parent ::__construct();
        $this->load->library('auth');
    }


    /**
     * Index Function
     *
     * Sets up form validation and if it validates logs in the user
     * Loads the header, admin login page and admin footer
     *
     */
    function index() {

        //Sets the validation rules for the username and password input fields
        $this->form_validation->set_rules('username','username','trim|required|xss_clean');
        $this->form_validation->set_rules('password','password','trim|required|xss_clean');

        //If the validation passes then...
        if($this->form_validation->run() == true){

            //Store the username and password from the post data in a variable
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            //Checks to see if the data is found in the database but using the auth library
            //If it is not found then an error is logged
            if(!$this->auth->login($username, $password)) {
                $data['error'] = 'Incorrect username and password, try again.';
            }
        }

        //If no form is submitted, load the header, admin login and admin footer views
        $this->load->view('incs/header');
        $this->load->view('admin/login', $data);
        $this->load->view('admin/incs/footer');
    }

    /**
     * Logout
     *
     * Sets a flashdata message to confirm to the user they have logged out
     * It then runs the logout method in the auth library
     */
    function logout() {
        //flashdata message set to inform user of logout
        $this->session->set_flashdata('logout', 'You have successfully logged out');
        $this->auth->logout();

    }

}