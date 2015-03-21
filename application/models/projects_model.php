<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }

    public function get_projects() {
        //TODO: currently only projects that have a file and a tutor associated to them are pulled out of the db. Must be set so it still gets the record even if no file is assigned to it
        //select all from the projects table and join the courses, files, and tutors associated with the project
//        $this->db->select('*');
//        $this->db->from('project');
//        $this->db->join('course', 'course.course_id = project.course_id');
//        $this->db->join('file', 'file.project_id = project.project_id');
//        $this->db->join('tutor', 'tutor.tutor_id = project.tutor_id');
//        return $this->db->get();

//        $query = "
//            SELECT * FROM project
//            LEFT JOIN course
//            on course.course_id = project.course_id
//            LEFT JOIN file
//            on file.project_id = project.project_id
//            LEFT JOIN tutor
//            on tutor.tutor_id = project.tutor_id
//            ";

        $query = $this->db->query('
            SELECT  project.project_id, project.title, project.abstract, project.date_added, project.tutor_id, project.course_id,
            course.name,
            file.file_name, file.location,
            tutor.first_name, tutor.last_name, tutor.email
            FROM project
            LEFT JOIN course
            on course.course_id = project.course_id
            LEFT JOIN file
            on file.project_id = project.project_id
            LEFT JOIN tutor
            on tutor.tutor_id = project.tutor_id
            ORDER BY project.date_added DESC
        ');

        return $query;
    }

    public function add_project() {

        //insert into the database using the post data
        $data = array(
            'title' => $this->input->post('project_title'),
            'abstract' => $this->input->post('abstract'),
            //TODO: update tutor_id to insert current user
            'tutor_id' => '1',
            'course_id' => $this->input->post('course')
        );
        $this->db->insert('project', $data);

        //The id of the last insert. This is so it can be used in the file upload
        $insert_id = $this->db->insert_id();

        //File upload conditions
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|pdf';
        $config['max_size']	= '100';
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        $config['remove_spaces'] = TRUE;
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);

        //Return the location of the uploaded file so it can be added to the database
        $upload = $this->upload->data();

                //insert new file data into database
        $data = array(
            'file_name' => $upload['file_name'],
            'project_id' => $insert_id,
            'location' => $upload['full_path']
        );
        $this->db->insert('file', $data);
    }
}