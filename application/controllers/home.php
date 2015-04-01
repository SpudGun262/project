<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function index() {
        $this->load->view('incs/header');
        $this->load->view('home');
        $this->load->view('incs/footer');
    }
}