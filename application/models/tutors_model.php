<?php if ( ! defined('BASEPATH')) exit('No direct sSuccessfully allowed');

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
            'research_interest' => $this->input->post('research_interest'),
            'email' => $this->input->post('email')
        );
        $this->db->insert('tutor', $data);

        //The id of the last insert
        $insert_id = $this->db->insert_id();

        $data = array(
            'admin_id' => $insert_id,
            'username' => $this->input->post('email') ,
            'password' => hash('sha256', $this->input->post('password').SALT)
        );

        $this->db->insert('admin', $data);

        $this->session->set_flashdata('notice', '<div data-alert class="alert-box secondary radius">Successfully added ' . $this->input->post('first_name') . ' ' . $this->input->post('last_name') . ' <a href="#" class="close">&times;</a></div>');

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