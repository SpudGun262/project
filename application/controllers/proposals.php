<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Proposals
 *
 * @package    CI
 * @subpackage Controller
 * @author     Tom Walker
 *
 */
class Proposals extends CI_Controller {

    /**
     * Constructor
     *
     * Loads in all the models, helpers and other things necessary for this class to work
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('proposals_model');
    }

    /**
     * Index Function
     *
     * Gathers data from the proposals model and passes it over to the view using $data['proposals']
     * If the user is not logged in it Loads the header, proposals page and footer
     * Else it will load the user proposals page which lets the user see the proposals
     *
     */
    public function index() {
        //Get data from the proposals model and return an array
        $data['proposals'] = $this->proposals_model->get_proposals()->result_array();

        //Check if the user is logged in and load the correct view accordingly
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

    /**
     * View Individual Proposal
     *
     * Checks if the user is logged in and if so, displays the data for the selected proposal
     *
     * @param $proposal_id
     */
    public function viewProposal($proposal_id) {

        //Check if the user is an authenticated user
        $this->load->library('user_auth');
        $this->user_auth->checkLogin();

        //Gets a certain project from from the proposals model
        $proposalResult = $this->proposals_model->getProposal($proposal_id);

        //If no result is returned set a flashdata message and redirect to the proposals page
        if(!$proposalResult){
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this proposal does not exist</div>');
            redirect('proposals');
        }

        //Stored the returned data in the $data variable as an array
        $data['proposalResult'] = $proposalResult->row_array();

        //Load the header, user proposal page with data and footer
        $this->load->view('incs/header');
        $this->load->view('user/proposal', $data);
        $this->load->view('incs/footer');
    }

    /**
     * Do A Proposal
     *
     * This function lets a user assign their interest to a project by send the proposal ID to the doProposal method in the proposal model
     *
     * @param $proposal_id
     */
    public function doProposal($proposal_id){

        //Gets a certain project from from the proposals model
        $proposalResult = $this->proposals_model->getProposal($proposal_id);

        //If no result is returned set a flashdata message and redirect to the proposals page
        if(!$proposalResult){
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this proposal does not exist</div>');
            redirect('proposals');
        }

        //Run the doProposal method in the proposals model and send over the chosen proposal ID
        $this->proposals_model->doProposal($proposal_id);

        //Set a flash message to inform users of a successful action
        $this->session->set_flashdata('notice', '<div data-alert class="alert-box success radius">Your request has been sent.</div>');

        //Redirect to the proposals page
        redirect('proposals');
    }
}