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
        $this->form_validation->set_rules('abstract', 'Abstract', 'required|max_length[200]|xss_clean');

        //File upload conditions
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|pdf';
        $config['max_size']	= '100';
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        $config['remove_spaces'] = TRUE;
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->do_upload();

        $data['file'] = true;

        if($this->input->post()) {
            if ($_FILES['userfile']['error'] != UPLOAD_ERR_NO_FILE) {
                if ($this->upload->display_errors() !== '') {
                    $data['file'] = false;
                }
            }
        }
        //if the form passes validation then...
        if($this->form_validation->run() == true && $data['file']){

            //run the add_proposal method in the proposals_model
            $this->proposals_model->add_proposal();

            //redirect back to the proposals page
            redirect('admin/proposals');

            //if the form fails validation then...
        } else {

            //gather the data from the database again and load the proposals view
            //Any validation errors will be displayed on the page. This is done by validation_errors() method in the addproposal view
            $data['courses'] =  $this->courses_model->get_courses()->result_array();
            $this->load->view('admin/incs/header');
            $this->load->view('admin/addproposal', $data);
            $this->load->view('admin/incs/footer');

        }
    }
}