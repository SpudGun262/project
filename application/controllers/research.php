<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Research extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('tutors_model');
    }

    public function index() {

        $data['interests'] = $this->tutors_model->get_tutors()->result_array();

        $this->load->view('incs/header');
        $this->load->view('research', $data);
        $this->load->view('incs/footer');
    }
}