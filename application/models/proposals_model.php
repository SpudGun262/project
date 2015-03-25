<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proposals_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function proposal_base() {
        //select all from the proposal table and join the courses, files, and tutors associated with the project
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
}