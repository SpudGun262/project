<?php

class Proposals extends CI_Controller
{


    //constructor
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

    public function index()
    {
        //run the get_proposals method in the proposals_model and assign the results to the $data['proposals'] variable
        $data['proposals'] = $this->proposals_model->get_proposals()->result_array();

        //load the correct views with the $data from the database
        $this->load->view('admin/incs/header');
        $this->load->view('admin/proposals', $data);
        $this->load->view('admin/incs/footer');
    }

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

    public function editProposal($proposal_id) {

        $proposalResult = $this->proposals_model->getProposal($proposal_id);
        if(!$proposalResult){
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this proposal does not exist</div>');
            redirect('admin/proposals');
        }
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

    public function deleteProposal($proposal_id) {

        $proposalResult = $this->proposals_model->getProposal($proposal_id);
        if(!$proposalResult){
            $this->session->set_flashdata('error', '<div data-alert class="alert-box alert radius">Sorry this proposal does not exist <a href="#" class="close">&times;</a></div>');
            redirect('admin/proposals');
        }
        $data['proposalResult'] = $proposalResult->row_array();

        $this->proposals_model->deleteProposal($proposal_id);


        $id = $data['proposalResult']['proposal_id'];
        $title = $data['proposalResult']['title'];
        $desc = $data['proposalResult']['desc'];
        $dateAdded = $data['proposalResult']['date_added'];
        $tutorId = $data['proposalResult']['tutor_id'];
        $courseId = $data['proposalResult']['course_id'];

//        $data2 = array(
//            $id,
//            $title,
//            $abstract,
//            $dateAdded,
//            $tutorId,
//            $courseId
//        );

        //TODO: Implement a undo
        $this->session->set_flashdata('notice', '<div data-alert class="alert-box secondary radius">You just deleted ' . $title . ' <a href="#" class="close">&times;</a></div>');

        redirect('admin/proposals');

//        $print = print_r($undoData);
//        $print2 = print_r($proposal_id);
//
//
//        $data2 = array(
//            $print
//        );
//
//        $this->load->view('admin/proposals', $data2);

    }


}