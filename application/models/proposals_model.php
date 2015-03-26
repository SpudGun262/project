<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proposals_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function proposal_base() {
        //select all from the proposal table and join the courses, files, and tutors associated with the proposal
        $this->db->select('
        proposal.proposal_id, proposal.title, proposal.desc, proposal.date_added, proposal.tutor_id, proposal.course_id,
        course.name,
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
}