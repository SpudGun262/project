<?php

/**
 * Proposals
 *
 * @package    CI
 * @subpackage Controller
 * @author     Tom Walker
 *
 */
class Proposals extends CI_Controller
{

    /**
     * Constructor
     *
     * Loads in all the models, helpers and other things necessary for this class to work
     */
    function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->auth->checkLogin();
        $this->load->model('projects_model');
        $this->load->model('courses_model');
        $this->load->model('tutors_model');
        $this->load->model('proposals_model');
        $this->load->library('form_validation');
        $this->load->helper('form', 'url');
    }

    /**
     * Index Function
     *
     * Gets data from the proposals model and passes it over to the view using $data['proposals']
     * Loads the admin header, admin proposals page and admin footer
     *
     */
    public function index()
    {
        //run the get_proposals method in the proposals_model and assign the results to the $data['proposals'] variable
        $data['proposals'] = $this->proposals_model->get_proposals()->result_array();

        //load the correct views with the $data from the database
        $this->load->view('admin/incs/header');
        $this->load->view('admin/proposals', $data);
        $this->load->view('admin/incs/footer');
    }

    /**
     * Add Proposal
     *
     * Adds a proposal to the database if the validation is met
     * Else the user is returned to the add proposals view
     */
    public function addProposal() {

        //The form validation rules are set. The proposal title and abstract are required for the validation to pass. It must also be clear of any code
        $this->form_validation->set_rules('proposal_title', 'Title', 'required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('desc', 'Description', 'required|xss_clean');
        $this->form_validation->set_rules('course', 'Course', 'required|xss_clean');
        $this->form_validation->set_rules('tutor', 'Tutor', 'required|xss_clean');

        //if the form passes validation then...
        if($this->form_validation->run()){

            //run the add_proposal method in the proposals_model
            $this->proposals_model->add_proposal();

            //redirect back to the proposals page
            redirect('admin/proposals');

            //if the form fails validation then...
        } else {

            //gather the data from the database again and load the proposals view
            //Any validation errors will be displayed on the page. This is done by validation_errors() method in the addProposal view
            $data['courses'] =  $this->courses_model->get_courses()->result_array();
            $data['tutors'] = $this->tutors_model->get_tutors()->result_array();
            $this->load->view('admin/incs/header');
            $this->load->view('admin/addProposal', $data);
            $this->load->view('admin/incs/footer');

        }
    }

    /**
     * Edit Proposal
     *
     * When a particular proposal is selected it is loaded from the database and data sent to the view
     * When a form is submitted it is sent to the model for update
     *
     * @param $proposal_id
     */
    public function editProposal($proposal_id) {

        //Gets a certain proposal from from the proposals model
        $proposalResult = $this->proposals_model->getProposal($proposal_id);

        //If a result is not returned set an error message and redirect back to the proposals page
        if(!$proposalResult){
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this proposal does not exist</div>');
            redirect('admin/proposals');
        }

        //Stored the returned data in the $data variable as an array
        $data['proposalResult'] = $proposalResult->row_array();

        //The form validation rules are set. The proposal title and abstract are required for the validation to pass. It must also be clear of any code
        $this->form_validation->set_rules('proposal_title', 'Title', 'required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('desc', 'Description', 'required|xss_clean');

        //if the form passes validation then...
        if($this->form_validation->run()){

            //run the add_proposal method in the proposals_model
            $this->proposals_model->editProposal($proposal_id);

            //redirect back to the proposals page
            redirect('admin/proposals');

            //if the form fails validation then...
        } else {

            //gather the data from the database again and load the proposals view
            //Any validation errors will be displayed on the page. This is done by validation_errors() method in the addproposal view
            $data['courses'] =  $this->courses_model->get_courses()->result_array();
            $data['tutors'] = $this->tutors_model->get_tutors()->result_array();
            $this->load->view('admin/incs/header');
            $this->load->view('admin/editProposal', $data);
            $this->load->view('admin/incs/footer');

        }
    }

    /**
     * Delete Proposal
     *
     * Deletes a proposal from the database by passing its ID over to the proposals model
     *
     * @param $proposal_id
     */
    public function deleteProposal($proposal_id) {

        //Gets a certain proposal from from the proposals model
        $proposalResult = $this->proposals_model->getProposal($proposal_id);

        //If a result is not returned set an error message and redirect back to the proposals page
        if(!$proposalResult){
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this proposal does not exist <a href="#" class="close">&times;</a></div>');
            redirect('admin/proposals');
        }

        //Stored the returned data in the $data variable as an array
        $data['proposalResult'] = $proposalResult->row_array();

        //Delete the proposal with the returned ID using the deleteProposal method in the proposals model
        $this->proposals_model->deleteProposal($proposal_id);

        //Set the returned data in variables so it can be accessed easily
        $id = $data['proposalResult']['proposal_id'];
        $title = $data['proposalResult']['title'];
        $desc = $data['proposalResult']['desc'];
        $dateAdded = $data['proposalResult']['date_added'];
        $tutorId = $data['proposalResult']['tutor_id'];
        $courseId = $data['proposalResult']['course_id'];

        //Set a flashdata message to inform the user of which item they have deleted
        $this->session->set_flashdata('notice', '<div data-alert class="alert-box secondary radius">You just deleted ' . $title . ' <a href="#" class="close">&times;</a></div>');

        //Redirect to the proposals page
        redirect('admin/proposals');

    }

    /**
     * Delete Proposal Interest
     *
     * This function takes both the proposal ID and the user ID to delete an interest entry from the database
     *
     * @param $proposal_id
     * @param $user_id
     */
    public function deleteInterest($proposal_id, $user_id) {

        //Run the deleteInterest method in the proposals model using the proposal and user ID passed over
        $this->proposals_model->deleteInterest($proposal_id, $user_id);

        //Redirect to the dashboard
        redirect('admin/dashboard');
    }

}