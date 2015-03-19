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
        $this->db->from('project');
        $this->db->join('course', 'course.course_id = project.course_id');
        $this->db->join('file', 'file.project_id = project.project_id');
        $this->db->join('tutor', 'tutor.tutor_id = project.tutor_id');
        return $this->db->get();
    }

    public function add_project() {

    }
}