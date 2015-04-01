<?php

//flashdata used to display logout message
echo $this->session->flashdata('logout');

//flashdata message which displays when a new account is created
echo $this->session->flashdata('welcome');



echo '<h1>This is the homepage</h1>';

//If logged in, display welcome message
$CI =& get_instance();
if($CI->session->userdata('user_auth')) {
    echo 'Welcome ' . $this->session->userdata('user_auth')['first_name'];
}