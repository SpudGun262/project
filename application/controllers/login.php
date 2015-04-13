<?php

/**
 * Login
 *
 * @package    CI
 * @subpackage Controller
 * @author     Tom Walker
 *
 */
class Login extends CI_Controller
{

    /**
     * Constructor
     *
     * Loads in all the models, helpers and other things necessary for this class to work
     */
    function __construct()
    {
        parent::__construct();
        $this->load->library('user_auth');
    }

    /**
     * Index Function
     *
     * Sets up form validation and if it validates logs in the user
     * Loads the header, user login page and footer
     *
     */
    function index()
    {
        //Sets form validation for input fields
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean');

        //If the validation passes store the post data in variables
        if ($this->form_validation->run() == true) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            //If the user_auth library does not find a valid user then record an error message
            if (!$this->user_auth->login($email, $password)) {
                $data['error'] = '<div data-alert class="alert-box alert radius">Incorrect email or password. Please try again.</div>';
            }

        }

        //Load the views needed with the $data variable
        $this->load->view('incs/header');
        $this->load->view('user/login', $data);
        $this->load->view('incs/footer');
    }

    /**
     * Logout
     *
     * Sets a flashdata message to confirm to the user they have logged out
     * It then runs the logout method in the user auth library
     */
    function logout()
    {
        //flashdata message set to inform user of logout
        $this->session->set_flashdata('logout', 'You have successfully logged out');
        $this->user_auth->logout();

    }
}