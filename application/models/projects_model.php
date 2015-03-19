<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_projects() {
        $query = $this->db->get('project');
        return $query;
    }

    public function add_project() {

    }
}