<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Home
 *
 * @package    CI
 * @subpackage Controller
 * @author     Tom Walker
 *
 */
class Home extends CI_Controller {

    /**
     * Constructor
     *
     * Loads in all the models, helpers and other things necessary for this class to work
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Index Function
     *
     * Loads the header, home page and footer
     *
     */
    public function index() {
        $this->load->view('incs/header');
        $this->load->view('home');
        $this->load->view('incs/footer');
    }
}