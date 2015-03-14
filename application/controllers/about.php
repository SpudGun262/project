<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

    public function index(){
        $this->load->view('incs/header');
        $this->load->view('about');
        $this->load->view('incs/footer');
    }
}