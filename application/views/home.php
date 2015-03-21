<?php

//flashdata used to display logout message
echo $this->session->flashdata('logout');

echo '<h1>This is the homepage</h1>';


echo '<p><a href="' . base_url('login') . '">Login</a></p>';

echo '<p><a href="' . base_url('admin/login') . '">Admin Login</a></p>';