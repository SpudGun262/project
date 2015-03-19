<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_projects() {
        $this->db->select('*');
        $this->db->from('projects');
        $query = $this->db->get();
        return $query->result;



//        $query = $this->db->get('project');
//        return $query;

//        $this->db->select('*');
//        $this->db->from('links');
//        $this->db->join('redirects', 'redirects.url_string = links.alias');
//        $query = $this->db->get();
//
//        return $query->result;
    }

    public function add_project() {

    }
}