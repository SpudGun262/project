<?php

class Membership_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function validate()
    {
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', md5($this->input->post('password')));
        $query = $this->db->get('user');

        if($query->num_rows == 1)
        {
            return TRUE;
        }
    }

    function create_member()
    {
        $username = $this->input->post('username');

        $new_member_insert_data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
//            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password'))
        );

        $insert = $this->db->insert('user', $new_member_insert_data);
        return $insert;
    }

//    function check_if_username_exists($username)
//    {
//        $this->db->where('username', $username);
//        $result = $this->db->get('user');
//
//        if($result->num_rows() > 0)
//        {
//            return FALSE; //name is take
//        }
//        else
//        {
//            return TRUE;   //can be used
//        }
//    }

    function check_if_email_exists($email)
    {
        $this->db->where('email', $email);
        $result = $this->db->get('user');

        //If more than 0 then email is taken
        if($result->num_rows() > 0)
        {
            return FALSE; //email is taken
        }
        else
        {
            return TRUE;   //can be used
        }
    }
}