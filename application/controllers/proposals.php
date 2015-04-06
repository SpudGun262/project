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

    public function viewProposal($proposal_id) {

        $this->load->library('user_auth');
        $this->user_auth->checkLogin();

        $proposalResult = $this->proposals_model->getProposal($proposal_id);
        if(!$proposalResult){
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this proposal does not exist</div>');
            redirect('proposals');
        }
        $data['proposalResult'] = $proposalResult->row_array();


        $this->load->view('incs/header');
        $this->load->view('user/proposal', $data);
        $this->load->view('incs/footer');
    }

    public function doProposal($proposal_id){

        $proposalResult = $this->proposals_model->getProposal($proposal_id);
        if(!$proposalResult){
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this proposal does not exist</div>');
            redirect('proposals');
        }

        $this->proposals_model->doProposal($proposal_id);

        $this->session->set_flashdata('notice', '<div data-alert class="alert-box success radius">Your request has been sent.</div>');

        redirect('proposals');
    }
}