<?php

//flashdata used to display logout message
echo $this->session->flashdata('logout');

echo '<h1>This is the homepage</h1>';


echo '<p><a href="' . base_url('admin/login') . '">Login</a></p>';