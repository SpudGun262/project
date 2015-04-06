<div class="row">
    <h1>Admin Login</h1>

    <?php

    if(isset($error)) {
        echo '<div>'.$error.'</div>';
    }

    echo form_open();
    echo validation_errors();
    echo form_input('username', set_value('username'), 'placeholder="Username"');
    echo form_password('password', '', 'placeholder="Password" class="password"');
    echo form_submit('submit', 'Login', 'class="radius button"');
    echo form_close();

    //Add this link to improve navigation
    echo '<a href="' . base_url() . '">Back to home page</a>';

    ?>

</div>