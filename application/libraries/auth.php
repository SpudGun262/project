<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Auth Library
 *
 * @author     Tom Walker
 *
 */
class Auth
{

    /**
     * Check Login
     *
     * Checks if the user is authenticated and redirects to the login page if not
     */
    function checkLogin()
    {
        //Load codeigniter core
        $CI =& get_instance();
        if (!$CI->session->userdata('auth')) {
            //Redirect to login page
            redirect('admin/login');
        }
    }

    /**
     * Login
     *
     * Logs the user into the system by checking if the user exists within the admin table of the database.
     * If not, it will return false, sending the user back to the login form
     *
     * @param null $username
     * @param null $password
     * @return bool
     */
    function login($username = null, $password = null)
    {

        // load codeigniter core
        $CI =& get_instance();
        // load database
        $CI->load->database();
        //Check the admin table and compare the password with the hash and salt that has been created
        $result = $CI->db->get_where('admin',
            array('username' => $username, 'password' => hash('sha256', $password . SALT)));

        //If a single result is returned from the database then...
        if ($result->num_rows() == 1) {

            //Record the data in an array
            $auth = $result->row_array();

            //Remove the users password from the data
            unset($auth['password']);

            //Now store the created data, with the password removed, in the session data so it can be accessed throughout the system
            $CI->session->set_userdata(array('auth' => $auth));

            // redirect to dashboard
            redirect('admin/dashboard');

        //If no result is returned then return false
        } else {
            return false;
        }

    }

    /**
     * Logout
     *
     * Logs the user out of the system and unset's the session data
     */
    function logout()
    {
        //Load codeigniter core
        $CI =& get_instance();

        //Unset the session data
        $CI->session->unset_userdata('auth');

        //Redirect back to the homepage of the site to improve navigation
        redirect('home');
    }

}