<?php if ( ! defined('BASEPATH')) exit('No direct sSuccessfully allowed');

class Users_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function users_base(){
        $this->db->select('*');
        $this->db->from('user');
    }

    public function get_users(){
        $this->users_base();
        return $this->db->get();
    }

    public function add_user() {
        //insert into the database using the post data
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'password' => hash('sha256', $this->input->post('password').SALT)
        );
        $this->db->insert('user', $data);

        //The id of the last insert
        $insert_id = $this->db->insert_id();

       $this->session->set_flashdata('welcome', 'Welcome ' . $this->input->post('first_name') . ' ' . $this->input->post('last_name') . ' your account has been successfully created. You can now <a href="' . base_url('login') . '">login</a>.');
    }

    public function get_user() {

        $user_id = $this->session->userdata('user_auth')['user_id'];

        $this->users_base();
        $this->db->where('user.user_id', $user_id);
        $result = $this->db->get();
        if($result->num_rows() !== 1){
            return false;
        }
        return $result;

    }

    public function updateUser(){
        //update the database using the post data
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email')
        );

        $user_id = $this->session->userdata('user_auth')['user_id'];

        $this->db->where('user_id', $user_id);
        $this->db->update('user', $data);


        //Reset the session date with the new updated details
        $newUserData = array(
            'user_id' => $user_id,
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email')
        );
        $this->session->set_userdata(array('user_auth' => $newUserData));

        $this->session->set_flashdata('notice', '<div data-alert class="alert-box secondary radius">Successfully updated your profile.<a href="#" class="close">&times;</a></div>');


    }

    public function changePassword() {
        $data = array(
            'password' => hash('sha256', $this->input->post('password').SALT)
        );

        $user_id = $this->session->userdata('user_auth')['user_id'];

        $this->db->where('user_id', $user_id);
        $this->db->update('user', $data);

        $this->session->set_flashdata('notice', '<div data-alert class="alert-box secondary radius">Successfully updated your password.<a href="#" class="close">&times;</a></div>');
    }



}