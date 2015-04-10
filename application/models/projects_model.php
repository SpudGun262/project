<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('form', 'url', 'date');

    }

    public function project_base() {
        //select all from the projects table and join the courses, files, and tutors associated with the project
        $this->db->select('project.project_id, project.title, project.abstract, project.date_added, project.tutor_id, project.course_id,
            course.course_name,
            file.file_name, file.location,
            tutor.first_name, tutor.last_name, tutor.email');
        $this->db->from('project');
        $this->db->join('course', 'course.course_id = project.course_id', 'left');
        $this->db->join('file', 'file.project_id = project.project_id', 'left');
        $this->db->join('tutor', 'tutor.tutor_id = project.tutor_id', 'left');
        $this->db->order_by('project.date_added', 'desc');
    }

    public function get_projects() {
        $this->project_base();
        return $this->db->get();
    }

    public function add_project() {

        $admin_id = $this->session->userdata('auth')['admin_id'];

        //Create an expiry date for a project
        $dt = new DateTime();
        $dt->modify('+3 years');
        $date = $dt->format('Y-m-d H:i:s');

        //insert into the database using the post data
        $data = array(
            'title' => $this->input->post('project_title'),
            'abstract' => $this->input->post('abstract'),
            'tutor_id' => $admin_id,
            'course_id' => $this->input->post('course'),
            'expire' => $date
        );
        $this->db->insert('project', $data);

        //The id of the last insert. This is so it can be used in the file upload
        $insert_id = $this->db->insert_id();

        if ($this->upload->do_upload()){

            $upload_data = $this->upload->data();

            //insert new file data into database
            $data2 = array(
                'file_name' => $upload_data['file_name'],
                'project_id' => $insert_id,
                'location' => upload_url().$upload_data['file_name']
            );
            $this->db->insert('file', $data2);
        }
    }

    public function getProject($project_id) {
        $this->project_base();
        $this->db->where('project.project_id', $project_id);
        $result = $this->db->get();
        if($result->num_rows() !== 1){
            return false;
        }
        return $result;
    }

    public function editProject($project_id){
        //insert into the database using the post data
        $data = array(
            'title' => $this->input->post('project_title'),
            'abstract' => $this->input->post('abstract'),
            'course_id' => $this->input->post('course')
        );
        $this->db->where('project.project_id', $project_id);
        $this->db->update('project', $data);

        if ($this->upload->do_upload())
        {

            $upload_data = $this->upload->data();

            //insert new file data into database
            $data2 = array(
                'file_name' => $upload_data['file_name'],
                'project_id' => $project_id,
                'location' => upload_url().$upload_data['file_name']
            );
            $this->db->where('file.project_id', $project_id);
            $this->db->update('file', $data2);
        }
    }

    public function deleteProject($project_id) {

        $this->db->where('project.project_id', $project_id);
        $this->db->delete('project');

        //TODO: Add delete file functionality
//        delete_files(upload_url().)
    }

    public function checkExpiry(){

        //Establish current date
        $dt = new DateTime();
        $date = $dt->format('Y-m-d');

        if($this->session->userdata('auth')['admin_id'] == '9999') {

            $this->db->select('*');
            $this->db->from('project');
            //Where 'expire' is equal to or less that current date
            $this->db->where('expire <=', $date);
            return $this->db->get();
        }
        else
        {
            $this->db->select('*');
            $this->db->from('project');
            //Where 'expire' is equal to or less that current date
            $this->db->where('expire <=', $date);
            $this->db->where('tutor_id', $this->session->userdata('auth')['admin_id']);

            return $this->db->get();
        }

    }

    public function extendProject($project_id) {

        $dt = new DateTime();
        $dt->modify('+1 year');
        $date = $dt->format('Y-m-d');

        $data = array(
            'expire' => $date
        );

        $this->db->where('project.project_id', $project_id);
        $this->db->update('project', $data);

    }
    
    public function favourite($project_id) {

        //First query the database to see if the user has already clicked favourite on the project
        $this->db->select('*');
        $this->db->from('favourite');
        $this->db->where(array(
            'project_id' => $project_id,
            'user_id' => $this->session->userdata('user_auth')['user_id']
        ));
        $query = $this->db->get();

        //If the number of rows returned is 0, this means the user has not clicked favourite. Therefore, insert the data into the database
        if($query->num_rows() == 0) {

            $data = array(
                'project_id' => $project_id,
                'user_id' => $this->session->userdata('user_auth')['user_id'],
            );
            $this->db->insert('favourite', $data);

        } else {

            //If they have clicked favourite, redirect them and set an error message
            $this->session->set_flashdata('error', '<div data-alert class="alert-box secondary radius">This project has already been added to your favourites. View them in your <a href="' . base_url('user/profile') . '">profile page.</a></div>');

            $redirect = 'projects/viewProject/' . $project_id;
            redirect($redirect);
        }
    }

    public function getFavourites() {
        $this->db->select('
            favourite.project_id, favourite.user_id,
            project.title,
            user.first_name, user.last_name, user.email
        ');
        $this->db->from('favourite');
        $this->db->join('project', 'project.project_id = favourite.project_id', 'left');
        $this->db->join('user', 'user.user_id = favourite.user_id', 'left');
        $this->db->where('favourite.user_id', $this->session->userdata('user_auth')['user_id']);
        return $this->db->get();
    }

    public function deleteFavourite($project_id){
        $this->db->where(array(
            'favourite.project_id' => $project_id,
            'favourite.user_id' => $this->session->userdata('user_auth')['user_id']
        ));
        $this->db->delete('favourite');


    }
    
}