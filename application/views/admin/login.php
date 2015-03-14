<?php

echo '<h1>Login</h1>';

if(isset($error)) {
    echo '<div>'.$error.'</div>';
}

echo form_open();
echo validation_errors();
echo form_input('username', set_value('username'), 'placeholder="Username"');
echo form_password('password', '', 'placeholder="Password" class="password"');
echo form_submit('submit', 'Login');
echo form_close();

//Add this link to improve navigation
echo '<a href="' . base_url() . '">Back to home page</a>';