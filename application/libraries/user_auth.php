<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_auth extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }


    function checkLogin() {
        // load codeigniter core
        $CI =& get_instance();
        if(!$CI->session->userdata('auth')) {
            // redirect to login page
            $this->session->set_flashdata('notice', '<div data-alert class="alert-box radius">Sorry, to view proposals you must login.<a class="close">&times;</a></div>');
            redirect(base_url('login'));
        }
    }

    function login($email = NULL, $password = NULL) {

        // load codeigniter core
        $CI =& get_instance();
        // load database
        $CI->load->database();
        //Check the admin table and compare the password with the hash and salt that has been created
        $result = $CI->db->get_where('user', array('email' => $email, 'password' => hash('sha256', $password.SALT)));

        if($result->num_rows() > 0) {
            $auth = array(
                'email' => true
            );
            $CI->session->set_userdata(array('user_auth' => $auth));
            // redirect to dashboard
            redirect(base_url(), 'location');
        } else {
            return false;
        }

    }

    function logout() {
        // load codeigniter core
        $CI =& get_instance();
        $CI->session->unset_userdata('user_auth');
        //amended the redirect back to the homepage of the site to improve navigation
        redirect(base_url(''), 'location');
    }

}