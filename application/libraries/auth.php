<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth {

    function checkLogin() {
        // load codeigniter core
        $CI =& get_instance();
        if(!$CI->session->userdata('auth')) {
            // redirect to login page
            redirect(base_url('admin/login'), 'location');
        }
    }

    function login($username = NULL, $password = NULL) {

        // load codeigniter core
        $CI =& get_instance();
        // load database
        $CI->load->database();
        //Check the admin table and compare the password with the hash and salt that has been created
        $result = $CI->db->get_where('admin', array('username' => $username, 'password' => hash('sha256', $password.SALT)));

        if($result->num_rows() == 1) {

            $auth = $result->row_array();

            unset($auth['password']);

            $CI->session->set_userdata(array('auth' => $auth));
            // redirect to dashboard
            redirect('admin/dashboard');
        } else {
            return false;
        }

    }

    function logout() {
        // load codeigniter core
        $CI =& get_instance();
        $CI->session->unset_userdata('auth');
        //amended the redirect back to the homepage of the site to improve navigation
        redirect(base_url(''), 'location');
    }

}