<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proposals_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_proposals() {
        $query = $this->db->get('proposal');
        return $query;
    }
}