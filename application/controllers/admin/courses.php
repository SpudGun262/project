<?php

class Courses extends CI_Controller
{

    //constructor
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

    public function index()
    {
        //run the get_courses method in the courses_model and assign the results to the $data['courses'] variable
        $data['courses'] = $this->courses_model->get_courses()->result_array();

        //load the correct views with the $data from the database
        $this->load->view('admin/incs/header');
        $this->load->view('admin/courses', $data);
        $this->load->view('admin/incs/footer');
    }


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

    public function editCourse($course_id) {

        $courseResult = $this->courses_model->getCourse($course_id);
        if(!$courseResult){
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this course does not exist <a href="#" class="close">&times;</a></div>');
            redirect('admin/courses');
        }
        $data['courseResult'] = $courseResult->row_array();

        //The form validation rules are set
        $this->form_validation->set_rules('course_name', 'Course Name', 'required|max_length[200]|xss_clean');

        //if the form passes validation then...
        if($this->form_validation->run()){

            //run the editcourse method in the courses_model
            $this->courses_model->editCourse($course_id);

            //redirect back to the courses page
            redirect('admin/courses');

            //if the form fails validation then...
        } else {

            //gather the data from the database again and load the courses view
            //Any validation errors will be displayed on the page. This is done by validation_errors() method in the addcourse view
//            $data['courses'] =  $this->courses_model->get_courses()->result_array();
            $this->load->view('admin/incs/header');
            $this->load->view('admin/editCourse', $data);
            $this->load->view('admin/incs/footer');

        }
    }
    
    public function deleteCourse($course_id){
        $courseResult = $this->courses_model->getCourse($course_id);
        if(!$courseResult){
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this course does not exist <a href="#" class="close">&times;</a></div>');
            redirect('admin/courses');
        }
        $data['courseResult'] = $courseResult->row_array();

        $this->courses_model->deletecourse($course_id);


        $id = $data['courseResult']['course_id'];
        $courseName = $data['courseResult']['course_name'];


        //TODO: Implement a undo
        $this->session->set_flashdata('notice', '<div data-alert class="alert-box secondary radius">You just deleted <strong>' . $courseName . '</strong><a href="#" class="close">&times;</a></div>');

        redirect('admin/courses');
    }

}
