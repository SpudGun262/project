<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proposals_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function proposal_base() {
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

    public function get_proposals() {
        $this->proposal_base();
        return $this->db->get();
    }

    public function add_proposal() {

        //insert into the database using the post data
        $data = array(
            'title' => $this->input->post('proposal_title'),
            'desc' => $this->input->post('desc'),
            'tutor_id' => $this->input->post('tutor'),
            'course_id' => $this->input->post('course')
        );
        $this->db->insert('proposal', $data);

        //The id of the last insert. This is so it can be used in the file upload
        $insert_id = $this->db->insert_id();

    }

    public function getProposal($proposal_id) {
        $this->proposal_base();
        $this->db->where('proposal.proposal_id', $proposal_id);
        $result = $this->db->get();
        if($result->num_rows() !== 1){
            return false;
        }
        return $result;
    }

    public function editProposal($proposal_id){
        //insert into the database using the post data
        $data = array(
            'title' => $this->input->post('proposal_title'),
            'desc' => $this->input->post('desc'),
            'tutor_id' => $this->input->post('tutor'),
            'course_id' => $this->input->post('course')
        );
        $this->db->where('proposal_id', $proposal_id);
        $this->db->update('proposal', $data);
    }

    public function deleteProposal($proposal_id) {

        $this->db->where('proposal.proposal_id', $proposal_id);
        $this->db->delete('proposal');

    }

    /**
     * @param $proposal_id
     */
    public function doProposal($proposal_id) {

        //First query the database to see if the user has already applied for the project
        $this->db->select('*');
        $this->db->from('interest');
        $this->db->where(array(
            'proposal_id' => $proposal_id,
            'user_id' => $this->session->userdata('user_auth')['user_id']
        ));
        $query = $this->db->get();

        //If the number of rows returned is 0, this means the student has not applied. Therefore, insert the data into the database
        if($query->num_rows() == 0) {

            //Get the tutor ID for this particular proposal
            $result = $this->getProposal($proposal_id)->row_array();

            $data = array(
                'proposal_id' => $proposal_id,
                'user_id' => $this->session->userdata('user_auth')['user_id'],
                'tutor_id' => $result['tutor_id']
            );
            $this->db->insert('interest', $data);

        } else {

            //If they have applied, redirect them and set an error message
            $this->session->set_flashdata('error', '<div data-alert class="alert-box secondary radius">You have already applied for this project. If you have not heard from the tutor 72 hours afters applying, try emailing them.</div>');
            redirect('proposals');
        }
    }

    public function checkInterest() {
        $this->db->select('
            interest.proposal_id, interest.user_id, interest.tutor_id,
            proposal.title,
            user.first_name, user.last_name, user.email
        ');
        $this->db->from('interest');
        $this->db->join('proposal', 'proposal.proposal_id = interest.proposal_id', 'left');
        $this->db->join('user', 'user.user_id = interest.user_id', 'left');
        $this->db->where('interest.tutor_id', $this->session->userdata('auth')['admin_id']);
        return $this->db->get();
    }

    public function deleteInterest($proposal_id, $user_id) {
        $this->db->where(array(
            'interest.proposal_id' => $proposal_id,
            'interest.user_id' => $user_id,
            'interest.tutor_id' => $this->session->userdata('auth')['admin_id']
        ));
        $this->db->delete('interest');
    }
}