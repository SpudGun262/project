<?php if (!defined('BASEPATH')) {
    exit('No direct sSuccessfully allowed');
}

/**
 * Tutors Model
 *
 * @package    CI
 * @subpackage Model
 * @author     Tom Walker
 *
 */
class Tutors_model extends CI_Model
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
     * Tutors Base Function
     *
     * Selects all data from the tutor table sorts by last name
     * No result is return, by doing this the function can be used by many others
     */
    public function tutors_base()
    {
        $this->db->select('*');
        $this->db->from('tutor');
        $this->db->order_by('tutor.last_name', 'asc');

    }

    /**
     * Get Tutors
     *
     * Extends the tutors_base method returns a result
     *
     * @return mixed
     */
    public function get_tutors()
    {
        $this->tutors_base();

        return $this->db->get();
    }

    /**
     * Add Tutor
     *
     * Inserts a new tutor into the database
     */
    public function add_tutor()
    {

        //Create an array using the post data
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'research_interest' => $this->input->post('research_interest'),
            'email' => $this->input->post('email')
        );

        //Insert into the tutor table using the $data
        $this->db->insert('tutor', $data);

        //The id of the last insert
        $insert_id = $this->db->insert_id();

        //Create an array using post data, the last inserted ID and hash and salt the password
        $data = array(
            'admin_id' => $insert_id,
            'username' => $this->input->post('email'),
            'password' => hash('sha256', $this->input->post('password') . SALT)
        );

        //Insert into the admin table using the data
        $this->db->insert('admin', $data);

        //Set a flash message to inform the user of a successful insert
        $this->session->set_flashdata('notice',
            '<div data-alert class="alert-box secondary radius">Successfully added ' . $this->input->post('first_name') . ' ' . $this->input->post('last_name') . ' <a href="#" class="close">&times;</a></div>');

    }

    /**
     * Get A Single Tutor
     *
     * Extends the tutors_base method to return a single tutor
     *
     * @param $tutor_id
     * @return bool
     */
    public function getTutor($tutor_id)
    {
        //Run the tutors_base method
        $this->tutors_base();

        //Select the tutor where the tutor ID matches the variable passed over
        $this->db->where('tutor.tutor_id', $tutor_id);

        //Store the result in a variable
        $result = $this->db->get();

        //If there are no results  or more than 1, return false
        if ($result->num_rows() !== 1) {
            return false;
        }

        //Return the result
        return $result;
    }

    /**
     * Edit Tutor
     *
     * Edit a tutors information based on the tutor selected
     *
     * @param $tutor_id
     */
    public function editTutor($tutor_id)
    {
        //insert into the database using the post data
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'research_interest' => $this->input->post('research_interest'),
            'email' => $this->input->post('email')
        );
        $this->db->where('tutor_id', $tutor_id);
        $this->db->update('tutor', $data);
    }

    /**
     * Delete Tutor
     *
     * Delete the selected tutor from the database
     *
     * @param $tutor_id
     */
    public function deleteTutor($tutor_id)
    {
        //Select the tutor where the tutor ID matches the variable passed over
        $this->db->where('tutor.tutor_id', $tutor_id);

        //Delete the item from the tutor table
        $this->db->delete('tutor');

    }
}