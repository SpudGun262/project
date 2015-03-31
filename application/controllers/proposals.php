<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proposals extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('user_auth');
        $this->user_auth->checkLogin();
        $this->load->model('proposals_model');
    }

    public function index() {
        $data['proposals'] =  $this->proposals_model->get_proposals()->result_array();
        $this->load->view('incs/header');
        $this->load->view('proposals', $data);
        $this->load->view('incs/footer');
    }
}