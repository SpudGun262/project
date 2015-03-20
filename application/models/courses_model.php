<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Courses_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_courses(){
        return $this->db->get('course');
    }
}