<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Projects Model
 *
 * @package    CI
 * @subpackage Model
 * @author     Tom Walker
 *
 */
class Projects_model extends CI_Model
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
        $this->load->helper('form', 'url', 'date');

    }

    /**
     * Projects Base Function
     *
     * Selects all data from the project table sorts by date added
     * No result is return, by doing this the function can be used by many others
     */
    public function project_base()
    {
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

    /**
     * Get Projects
     *
     * Extends the project_base method returns a result
     *
     * @return mixed
     */
    public function get_projects()
    {
        $this->project_base();

        return $this->db->get();
    }

    /**
     * Add Project
     *
     * Inserts a new project into the database
     */
    public function add_project()
    {

        //Store the ID of the current logged in user in a variable
        $admin_id = $this->session->userdata('auth')['admin_id'];

        //Create an expiry date for a project
        $dt = new DateTime();
        $dt->modify('+3 years');
        $date = $dt->format('Y-m-d H:i:s');

        //Create an array using the post data and variables
        $data = array(
            'title' => $this->input->post('project_title'),
            'abstract' => $this->input->post('abstract'),
            'tutor_id' => $admin_id,
            'course_id' => $this->input->post('course'),
            'expire' => $date
        );

        //Insert into data the project table
        $this->db->insert('project', $data);

        //The id of the last insert. This is so it can be used in the file upload
        $insert_id = $this->db->insert_id();

        //If a file has been uploaded then...
        if ($this->upload->do_upload()) {

            //Gather the upload data
            $upload_data = $this->upload->data();

            //Create an array using the post data and variables
            $data2 = array(
                'file_name' => $upload_data['file_name'],
                'project_id' => $insert_id,
                'location' => upload_url() . $upload_data['file_name']
            );

            //Insert into the file table
            $this->db->insert('file', $data2);
        }
    }

    /**
     * Get An Individual Project
     *
     * Extends the project_base method to return a single project
     *
     * @param $project_id
     * @return bool
     */
    public function getProject($project_id)
    {

        //Run the course_base method
        $this->project_base();

        //Select the project where the project ID matches the variable passed over
        $this->db->where('project.project_id', $project_id);

        //Sort the result in a variable
        $result = $this->db->get();

        //If there are no results  or more than 1, return false
        if ($result->num_rows() !== 1) {
            return false;
        }

        //Return the result
        return $result;
    }

    /**
     * Edit Project
     *
     * Edit a projects information based on the project selected
     *
     * @param $project_id
     */
    public function editProject($project_id)
    {

        //Create an array using the post data
        $data = array(
            'title' => $this->input->post('project_title'),
            'abstract' => $this->input->post('abstract'),
            'course_id' => $this->input->post('course')
        );

        //Select the project where the project ID matches the variable passed over
        $this->db->where('project.project_id', $project_id);

        //Update the project table with the created data
        $this->db->update('project', $data);

        //If a file has been uploaded then...
        if ($this->upload->do_upload()) {

            //Gather the upload data
            $upload_data = $this->upload->data();

            //Create an array using the post data
            $data2 = array(
                'file_name' => $upload_data['file_name'],
                'project_id' => $project_id,
                'location' => upload_url() . $upload_data['file_name']
            );

            //Select the file where the project ID matches the variable passed over
            $this->db->where('file.project_id', $project_id);

            //Update the file table with the created data
            $this->db->update('file', $data2);
        }
    }

    /**
     * Delete Project
     *
     * Delete the selected project from the database
     *
     * @param $project_id
     */
    public function deleteProject($project_id)
    {

        //Select the project where the project ID matches the variable passed over
        $this->db->where('project.project_id', $project_id);

        //Delete the item from the project table
        $this->db->delete('project');

    }

    /**
     * Check Project Expiry
     *
     * Checks expired projects based on the type of user that is logged in
     * If it is a God admin, all expired projects will be shown
     * If it is a standard admin, only their projects will be shown
     *
     * @return mixed
     */
    public function checkExpiry()
    {

        //Establish current date
        $dt = new DateTime();
        $date = $dt->format('Y-m-d');

        //If the user is a God admin, then...
        if ($this->session->userdata('auth')['admin_id'] == '9999') {

            //Select all expired projects from the database
            $this->db->select('*');
            $this->db->from('project');
            //Where 'expire' is equal to or less that current date
            $this->db->where('expire <=', $date);

            //Return the result
            return $this->db->get();
        } //If the user is a standard admin, then...
        else {

            //Select all expired projects from the database where the tutor ID matches the current logged in user
            $this->db->select('*');
            $this->db->from('project');
            //Where 'expire' is equal to or less that current date
            $this->db->where('expire <=', $date);
            $this->db->where('tutor_id', $this->session->userdata('auth')['admin_id']);

            //Return the result
            return $this->db->get();
        }

    }

    /**
     * Extend Project Expiry
     *
     * Extends the projects expiry date by 12 months
     *
     * @param $project_id
     */
    public function extendProject($project_id)
    {

        //Get the current date and add 12 months on to it
        $dt = new DateTime();
        $dt->modify('+1 year');
        $date = $dt->format('Y-m-d');

        //Store the new extended date in a variable
        $data = array(
            'expire' => $date
        );

        //Where the project ID matches the ID passed over
        $this->db->where('project.project_id', $project_id);

        //Update the project table with the $data
        $this->db->update('project', $data);

    }

    /**
     * Favourite A Project
     *
     * Favourite a selected project by adding it the database
     *
     * @param $project_id
     */
    public function favourite($project_id)
    {

        //First query the database to see if the user has already clicked favourite on the project
        $this->db->select('*');
        $this->db->from('favourite');
        $this->db->where(array(
            'project_id' => $project_id,
            'user_id' => $this->session->userdata('user_auth')['user_id']
        ));
        $query = $this->db->get();

        //If the number of rows returned is 0, this means the user has not clicked favourite. Therefore, insert the data into the database
        if ($query->num_rows() == 0) {

            $data = array(
                'project_id' => $project_id,
                'user_id' => $this->session->userdata('user_auth')['user_id'],
            );
            $this->db->insert('favourite', $data);

        } else {

            //If they have clicked favourite, redirect them and set an error message
            $this->session->set_flashdata('error',
                '<div data-alert class="alert-box secondary radius">This project has already been added to your favourites. View them in your <a href="' . base_url('user/profile') . '">profile page.</a></div>');

            $redirect = 'projects/viewProject/' . $project_id;
            redirect($redirect);
        }
    }

    /**
     * Get Favourite Projects
     *
     * Check the database to see if the logged in user has any favourites
     *
     * @return mixed
     */
    public function getFavourites()
    {
        //Select from the favourite table and join to the project and user table
        $this->db->select('
            favourite.project_id, favourite.user_id,
            project.title,
            user.first_name, user.last_name, user.email
        ');
        $this->db->from('favourite');
        $this->db->join('project', 'project.project_id = favourite.project_id', 'left');
        $this->db->join('user', 'user.user_id = favourite.user_id', 'left');
        $this->db->where('favourite.user_id', $this->session->userdata('user_auth')['user_id']);

        //Return the result
        return $this->db->get();
    }

    /**
     * Delete A Favourite
     *
     * Delete the selected project favourite from the database
     *
     * @param $project_id
     */
    public function deleteFavourite($project_id)
    {
        //Select where the project ID matches the varaible passed over and the user ID matches the current logged in user
        $this->db->where(array(
            'favourite.project_id' => $project_id,
            'favourite.user_id' => $this->session->userdata('user_auth')['user_id']
        ));

        //Delete from the favourite table
        $this->db->delete('favourite');

    }

}