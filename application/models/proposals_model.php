<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Proposals Model
 *
 * @package    CI
 * @subpackage Model
 * @author     Tom Walker
 *
 */
class Proposals_model extends CI_Model
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
     * Projects Base Function
     *
     * Selects all data from the proposal table sorts by date added
     * No result is return, by doing this the function can be used by many others
     */
    public function proposal_base()
    {
        //select all from the proposal table and join the courses and tutors associated with the proposal
        $this->db->select('
        proposal.proposal_id, proposal.title, proposal.desc, proposal.date_added, proposal.tutor_id, proposal.course_id,
        course.course_name,
        tutor.first_name, tutor.last_name, tutor.email
        ');
        $this->db->from('proposal');
        $this->db->join('course', 'course.course_id = proposal.course_id', 'left');
        $this->db->join('tutor', 'tutor.tutor_id = proposal.tutor_id', 'left');
        $this->db->order_by('proposal.date_added', 'desc');

    }

    /**
     * Get Projects
     *
     * Extends the proposal_base method returns a result
     *
     * @return mixed
     */
    public function get_proposals()
    {
        $this->proposal_base();

        return $this->db->get();
    }

    /**
     * Add Proposal
     *
     * Inserts a new proposal into the database
     */
    public function add_proposal()
    {

        //insert into the database using the post data
        $data = array(
            'title' => $this->input->post('proposal_title'),
            'desc' => $this->input->post('desc'),
            'tutor_id' => $this->input->post('tutor'),
            'course_id' => $this->input->post('course')
        );
        $this->db->insert('proposal', $data);

    }

    /**
     * Get An Individual Proposal
     *
     * Extends the proposal_base method to return a single proposal
     *
     * @param $proposal_id
     * @return bool
     */
    public function getProposal($proposal_id)
    {
        //Run the proposal_base method
        $this->proposal_base();

        //Select the proposal where the proposal ID matches the variable passed over
        $this->db->where('proposal.proposal_id', $proposal_id);

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
     * Edit Proposal
     *
     * Edit a proposals information based on the proposal selected
     *
     * @param $proposal_id
     */
    public function editProposal($proposal_id)
    {
        //Create an array using the post data
        $data = array(
            'title' => $this->input->post('proposal_title'),
            'desc' => $this->input->post('desc'),
            'tutor_id' => $this->input->post('tutor'),
            'course_id' => $this->input->post('course')
        );

        //Select the proposal where the proposal ID matches the variable passed over
        $this->db->where('proposal_id', $proposal_id);

        //Update the proposal table with the data
        $this->db->update('proposal', $data);
    }

    /**
     * Delete A Proposal
     *
     * Delete the selected proposal from the database
     *
     * @param $proposal_id
     */
    public function deleteProposal($proposal_id)
    {

        //Select the proposal where the proposal ID matches the variable passed over
        $this->db->where('proposal.proposal_id', $proposal_id);

        //Delete the item from the proposal table
        $this->db->delete('proposal');

    }

    /**
     * Do A Proposal
     *
     * Lets a user register interest in a proposal by storing it in the database
     *
     * @param $proposal_id
     */
    public function doProposal($proposal_id)
    {

        //First query the database to see if the user has already applied for the project
        $this->db->select('*');
        $this->db->from('interest');
        $this->db->where(array(
            'proposal_id' => $proposal_id,
            'user_id' => $this->session->userdata('user_auth')['user_id']
        ));
        $query = $this->db->get();

        //If the number of rows returned is 0, this means the student has not applied. Therefore, insert the data into the database
        if ($query->num_rows() == 0) {

            //Get the tutor ID for this particular proposal
            $result = $this->getProposal($proposal_id)->row_array();

            //Create an array from the post data, variables and session data
            $data = array(
                'proposal_id' => $proposal_id,
                'user_id' => $this->session->userdata('user_auth')['user_id'],
                'tutor_id' => $result['tutor_id']
            );

            //Add the entry to the database interest table using the data
            $this->db->insert('interest', $data);

        } else {

            //If they have applied, redirect them and set an error message
            $this->session->set_flashdata('error',
                '<div data-alert class="alert-box secondary radius">You have already applied for this project. If you have not heard from the tutor 72 hours afters applying, try emailing them.</div>');
            redirect('proposals');
        }
    }

    /**
     * Check Interest
     *
     * Checks the database to see if any interest has been shown to a proposal
     *
     * @return mixed
     */
    public function checkInterest()
    {
        //select all from the interest table and join the proposal and user table associated with the proposal
        $this->db->select('
            interest.proposal_id, interest.user_id, interest.tutor_id,
            proposal.title,
            user.first_name, user.last_name, user.email
        ');
        $this->db->from('interest');
        $this->db->join('proposal', 'proposal.proposal_id = interest.proposal_id', 'left');
        $this->db->join('user', 'user.user_id = interest.user_id', 'left');
        $this->db->where('interest.tutor_id', $this->session->userdata('auth')['admin_id']);

        //Return the result
        return $this->db->get();
    }

    /**
     * Delete Interest
     *
     * Deletes interest from the database using the proposal ID and user ID
     *
     * @param $proposal_id
     * @param $user_id
     */
    public function deleteInterest($proposal_id, $user_id)
    {
        //Select where the passed over variable matches on in the database
        //The user ID is the same as the passed over variable
        //And the tutor ID matches the current logged in user
        $this->db->where(array(
            'interest.proposal_id' => $proposal_id,
            'interest.user_id' => $user_id,
            'interest.tutor_id' => $this->session->userdata('auth')['admin_id']
        ));

        //Delete from the interest table
        $this->db->delete('interest');
    }
}