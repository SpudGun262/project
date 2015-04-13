<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Research
 *
 * @package    CI
 * @subpackage Controller
 * @author     Tom Walker
 *
 */
class Research extends CI_Controller
{

    /**
     * Constructor
     *
     * Loads in all the models, helpers and other things necessary for this class to work
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tutors_model');
    }

    /**
     * Index Function
     *
     * Gathers data from the tutors model and passes it over to the view using $data['interests']
     *
     */
    public function index() {

        //Get data from the tutors model and return an array
        $data['interests'] = $this->tutors_model->get_tutors()->result_array();

        //Load the header, research page with data and footer
        $this->load->view('incs/header');
        $this->load->view('research', $data);
        $this->load->view('incs/footer');
    }
}