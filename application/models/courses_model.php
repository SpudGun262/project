<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Courses_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function courses_base(){
        $this->db->select('*');
        $this->db->from('course');
        $this->db->order_by('course.course_name', 'asc');
    }

    public function get_courses(){
        $this->courses_base();
        return $this->db->get();
    }

    public function add_course(){

        //insert into the database using the post data
        $data = array(
            'course_name' => $this->input->post('course_name')
        );
        $this->db->insert('course', $data);

        //The id of the last insert
        $insert_id = $this->db->insert_id();

        $this->session->set_flashdata('notice', '<div data-alert class="alert-box secondary radius">Successfully added <strong>' . $this->input->post('course_name') . '</strong><a href="#" class="close">&times;</a></div>');

    }

    public function getCourse($course_id) {
        $this->courses_base();
        $this->db->where('course.course_id', $course_id);
        $result = $this->db->get();
        if($result->num_rows() !== 1){
            return false;
        }
        return $result;
    }

    public function editCourse($course_id){
        //insert into the database using the post data
        $data = array(
            'course_name' => $this->input->post('course_name')
        );
        $this->db->where('course_id', $course_id);
        $this->db->update('course', $data);
    }

    public function deleteCourse($course_id){
        $this->db->where('course.course_id', $course_id);
        $this->db->delete('course');
    }
}