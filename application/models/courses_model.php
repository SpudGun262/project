<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Courses Model
 *
 * @package    CI
 * @subpackage Model
 * @author     Tom Walker
 *
 */
class Courses_model extends CI_Model
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
     * Courses Base Function
     *
     * Selects all data from the courses table sorts by course name
     * No result is return, by doing this the function can be used by many others
     */
    public function courses_base(){
        $this->db->select('*');
        $this->db->from('course');
        $this->db->order_by('course.course_name', 'asc');
    }

    /**
     * Get Courses
     *
     * Extends the course_base method returns a result
     *
     * @return mixed
     */
    public function get_courses(){

        //Run the course_base method
        $this->courses_base();

        //Return the result
        return $this->db->get();
    }

    /**
     * Add Course
     *
     * Inserts a new course into the database
     */
    public function add_course(){

        //Create an array using the post data
        $data = array(
            'course_name' => $this->input->post('course_name')
        );

        //Insert into data the course table
        $this->db->insert('course', $data);

        //The id of the last insert
        $insert_id = $this->db->insert_id();

        //Set a flash message to inform the user of a successful entry
        $this->session->set_flashdata('notice', '<div data-alert class="alert-box secondary radius">Successfully added <strong>' . $this->input->post('course_name') . '</strong><a href="#" class="close">&times;</a></div>');

    }

    /**
     * Get An Individual Course
     *
     * Extends the course_base method to return a single course
     *
     * @param $course_id
     * @return bool
     */
    public function getCourse($course_id) {

        //Run the course_base method
        $this->courses_base();

        //Select the course where the course ID matches the variable passed over
        $this->db->where('course.course_id', $course_id);

        //Get the result and store it in a variable
        $result = $this->db->get();

        //If there are no results  or more than 1, return false
        if($result->num_rows() !== 1){
            return false;
        }

        //Return the data
        return $result;
    }

    /**
     * Edit Course
     *
     * Edit an courses information based on the course selected
     *
     * @param $course_id
     */
    public function editCourse($course_id){

        //Select the course where the course ID matches the variable passed over
        $data = array(
            'course_name' => $this->input->post('course_name')
        );

        //Select the course where the course ID matches the variable passed over
        $this->db->where('course_id', $course_id);

        //Update the course table with the created data
        $this->db->update('course', $data);
    }

    /**
     * Delete Course
     *
     * Delete the selected course from the database
     *
     * @param $course_id
     */
    public function deleteCourse($course_id){

        //Select the course where the course ID matches the variable passed over
        $this->db->where('course.course_id', $course_id);

        //Delete the course from the course table
        $this->db->delete('course');
    }
}