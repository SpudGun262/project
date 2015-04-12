<?php

/**
 * Courses
 *
 * @package    CI
 * @subpackage Controller
 * @author     Tom Walker
 *
 */
class Courses extends CI_Controller
{

    /**
     * Constructor
     *
     * Loads in all the models, helpers and other things necessary for this class to work
     */
    function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->auth->checkLogin();
        $this->load->model('projects_model');
        $this->load->model('courses_model');
        $this->load->model('tutors_model');
        $this->load->library('form_validation');
        $this->load->helper('form', 'url');
    }

    /**
     * Index Function
     *
     * Gets data from the courses model and passes it over to the view using $data['courses']
     * Loads the admin header, admin courses page and admin footer
     *
     */
    public function index()
    {
        //run the get_courses method in the courses_model and assign the results to the $data['courses'] variable
        $data['courses'] = $this->courses_model->get_courses()->result_array();

        //load the correct views with the $data from the database
        $this->load->view('admin/incs/header');
        $this->load->view('admin/courses', $data);
        $this->load->view('admin/incs/footer');
    }


    /**
     * Add Course
     *
     * Adds a course to the database if form validation is met.
     * Else it will load the 'addCourse' view
     */
    public function addCourse()
    {
        //The form validation rules are set.
        $this->form_validation->set_rules('course_name', 'Course Name', 'required|max_length[200]|xss_clean');

        //if the form passes validation then...
        if($this->form_validation->run()){

            //run the add_course method in the courses_model
            $this->courses_model->add_course();

            //redirect back to the courses page
            redirect('admin/courses');

            //if the form fails validation then...
        } else {

            //run the get_courses method in the courses_model and assign the results to the $data['courses'] variable
            $data['courses'] = $this->courses_model->get_courses()->result_array();

            //load the correct views with the $data from the database
            $this->load->view('admin/incs/header');
            $this->load->view('admin/addCourse', $data);
            $this->load->view('admin/incs/footer');
        }
    }

    /**
     * Edit Course
     *
     * When a particular course is selected it is loaded from the database and loads it
     *
     * @param $course_id
     */
    public function editCourse($course_id) {

        //Gets a certain course from from the courses model
        $courseResult = $this->courses_model->getCourse($course_id);

        //If a result is not returned set an error message and redirect back to the courses page
        if(!$courseResult){
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this course does not exist <a href="#" class="close">&times;</a></div>');
            redirect('admin/courses');
        }

        //Stored the returned data in the $data variable as an array
        $data['courseResult'] = $courseResult->row_array();

        //The form validation rules are set
        $this->form_validation->set_rules('course_name', 'Course Name', 'required|max_length[200]|xss_clean');

        //if the form passes validation then...
        if($this->form_validation->run()){

            //run the editCourse method in the courses_model
            $this->courses_model->editCourse($course_id);

            //redirect back to the courses page
            redirect('admin/courses');

            //if the form fails validation then...
        } else {

            //gather the data from the database again and load the courses view
            //Any validation errors will be displayed on the page. This is done by validation_errors() method in the addCourse view
            $this->load->view('admin/incs/header');
            $this->load->view('admin/editCourse', $data);
            $this->load->view('admin/incs/footer');

        }
    }

    /**
     * Delete Course
     *
     * Deletes a course from the database by passing its ID over to the course model
     *
     * @param $course_id
     */
    public function deleteCourse($course_id){

        //Gets a certain course from from the courses model
        $courseResult = $this->courses_model->getCourse($course_id);
        //If a result is not returned set an error message and redirect back to the courses page
        if(!$courseResult){
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this course does not exist <a href="#" class="close">&times;</a></div>');
            redirect('admin/courses');
        }
        //Stored the returned data in the $data variable as an array
        $data['courseResult'] = $courseResult->row_array();

        //Run the delete method in the courses model
        $this->courses_model->deletecourse($course_id);

        //Take the course ID and name and store them in variables
        $id = $data['courseResult']['course_id'];
        $courseName = $data['courseResult']['course_name'];


        //Set flashdata informing the user of which item they have deleted
        $this->session->set_flashdata('notice', '<div data-alert class="alert-box secondary radius">You just deleted <strong>' . $courseName . '</strong><a href="#" class="close">&times;</a></div>');

        //Redirect to the courses page
        redirect('admin/courses');
    }

}
