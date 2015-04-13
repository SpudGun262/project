<?php if (!defined('BASEPATH')) {
    exit('No direct sSuccessfully allowed');
}

/**
 * Users Model
 *
 * @package    CI
 * @subpackage Model
 * @author     Tom Walker
 *
 */
class Users_model extends CI_Model
{

    /**
     * Constructor
     *
     * Loads in all the models, helpers and other things necessary for this class to work
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Users Base Function
     *
     * Selects all data from the user table
     * No result is return, by doing this the function can be used by many others
     */
    public function users_base()
    {
        $this->db->select('*');
        $this->db->from('user');
    }

    /**
     * Get Users
     *
     * Extends the users_base method returns a result
     * @return mixed
     */
    public function get_users()
    {
        $this->users_base();

        return $this->db->get();
    }

    /**
     * Add User
     *
     * Inserts a new user into the database
     */
    public function add_user()
    {
        //insert into the database using the post data
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'password' => hash('sha256', $this->input->post('password') . SALT)
        );
        $this->db->insert('user', $data);

        //Set a flash message to inform the user that their account has been created
        $this->session->set_flashdata('welcome',
            'Welcome ' . $this->input->post('first_name') . ' ' . $this->input->post('last_name') . ' your account has been successfully created. You can now <a href="' . base_url('login') . '">login</a>.');
    }

    /**
     * Get A Single Tutor
     *
     * Extends the tutors_base method to return a single tutor
     *
     * @return bool
     */
    public function get_user()
    {
        //Create a variable containing the ID of the current user
        $user_id = $this->session->userdata('user_auth')['user_id'];

        //Run the users_base method
        $this->users_base();

        //Select where the user ID matches the current user ID
        $this->db->where('user.user_id', $user_id);

        //Store the result in a variable
        $result = $this->db->get();

        //If there are no results  or more than 1, return false
        if ($result->num_rows() !== 1) {
            return false;
        }

        //Return the result
        return $result;

    }

    /**
     * Update User Details
     */
    public function updateUser()
    {
        //Create an array using the post data
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email')
        );

        //Create a variable containing the ID of the current user
        $user_id = $this->session->userdata('user_auth')['user_id'];

        //Select where the user ID matches the current user ID
        $this->db->where('user_id', $user_id);

        //Update the user table using $data
        $this->db->update('user', $data);


        //Reset the session date with the new updated details
        $newUserData = array(
            'user_id' => $user_id,
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email')
        );

        //Store the new details in the session data
        $this->session->set_userdata(array('user_auth' => $newUserData));

        //Set a flash message to inform the user that their account has been updated
        $this->session->set_flashdata('notice',
            '<div data-alert class="alert-box secondary radius">Successfully updated your profile.<a href="#" class="close">&times;</a></div>');


    }

    /**
     * Change Password
     *
     * Changes a users password with a new password of their choice
     */
    public function changePassword()
    {
        //Create an array using the post data which applying a hash and salt to the password
        $data = array(
            'password' => hash('sha256', $this->input->post('password') . SALT)
        );

        //Create a variable containing the ID of the current user
        $user_id = $this->session->userdata('user_auth')['user_id'];

        //Select where the user ID matches the current user ID
        $this->db->where('user_id', $user_id);

        //Update the user table using $data
        $this->db->update('user', $data);

        //Set a flash message to inform the user that their password has been updated
        $this->session->set_flashdata('notice',
            '<div data-alert class="alert-box secondary radius">Successfully updated your password.<a href="#" class="close">&times;</a></div>');
    }


}