<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proposals extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        $this->load->library('user_auth');
//        $this->user_auth->checkLogin();
        $this->load->model('proposals_model');
    }

    public function index() {
        $data['proposals'] = $this->proposals_model->get_proposals()->result_array();

        $CI =& get_instance();
        if(!$CI->session->userdata('user_auth')) {
            $this->load->view('incs/header');
            $this->load->view('proposals');
            $this->load->view('incs/footer');
        } else {
            $this->load->view('incs/header');
            $this->load->view('user/proposals', $data);
            $this->load->view('incs/footer');
        }
    }
}