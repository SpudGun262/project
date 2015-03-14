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
        $result = $CI->db->get_where('admin', array('username' => $username, 'password' => $password));

        if($result->num_rows() > 0) {
            $auth = array(
                'username' => true
            );
            $CI->session->set_userdata(array('auth' => $auth));
            // redirect to dashboard
            redirect(base_url('admin/dashboard'), 'location');
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