<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * About
 *
 * @package    CI
 * @subpackage Controller
 * @author     Tom Walker
 *
 */
class About extends CI_Controller {

    /**
     * Constructor
     *
     * Loads in all the models, helpers and other things necessary for this class to work
     */
    function __construct()
    {
        parent::__construct();

    }

    /**
     * Index Function
     *
     * Loads the header, about page and footer
     *
     */
    public function index(){
        $this->load->view('incs/header');
        $this->load->view('about');
        $this->load->view('incs/footer');
    }
}