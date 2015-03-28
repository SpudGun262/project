<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tutors_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function tutors_base(){
        $this->db->select('*');
        $this->db->from('tutor');
        $this->db->order_by('tutor.last_name', 'asc');

    }

    public function get_tutors(){
        $this->tutors_base();
        return $this->db->get();
    }

    public function add_tutor() {

        //insert into the database using the post data
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email')
        );
        $this->db->insert('tutor', $data);

        //The id of the last insert
        $insert_id = $this->db->insert_id();
    }

    public function getTutor($tutor_id) {
        $this->tutors_base();
        $this->db->where('tutor.tutor_id', $tutor_id);
        $result = $this->db->get();
        if($result->num_rows() !== 1){
            return false;
        }
        return $result;
    }

    public function editTutor($tutor_id){
        //insert into the database using the post data
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email')
        );
        $this->db->where('tutor_id', $tutor_id);
        $this->db->update('tutor', $data);
    }

    public function deleteTutor($tutor_id) {

        $this->db->where('tutor.tutor_id', $tutor_id);
        $this->db->delete('tutor');

    }
}