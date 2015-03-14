<?php

class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->load->view('user/login_form');
    }

    function validate_credentials()
    {
        $this->load->model('membership_model');
        $query = $this->membership_model->validate();

        if($query)
        {
            $data = array(
                'username' => $this->input->post('username'),
                'is_logged_in' => true
            );
            $this->session->set_userdata($data);
            redirect('user/dashboard');
        }
        else
        {
            $this->load->view('user/dashboard');
        }
    }

    function signup()
    {
        $this->load->view('user/signup_form');
    }

    function create_member()
    {
        $this->load->library('form_validation');

        //Validation Rules
        //https://ellislab.com/codeigniter/user-guide/libraries/form_validation.html
        $this->form_validation->set_rules('first_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|callback_check_if_email_exists');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|callback_check_if_username_exists');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'trim|required|matches[password]');

        if ($this->form_validation->run() == FALSE) //didn't validate
        {
            $this->load->view('user/signup_form');
        }
        else
        {
            $this->load->model('membership_model');

            if($query = $this->membership_model->create_member())
            {
                $data['account_created'] = 'Your account has been created.';

                $this->load->view('user/login_form', $data);
            }
            else
            {
                $this->load->view('signup_form');
            }
        }
    }

    function check_if_username_exists($requested_username)
    {
        $this->load->model('membership_model');

        $username_available = $this->membership_model->check_if_username_exists($requested_username);

        if($username_available)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function check_if_email_exists($requested_email)
    {
        $this->load->model('membership_model');

        $email_available = $this->membership_model->check_if_email_exists($requested_email);

        if($email_available)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}