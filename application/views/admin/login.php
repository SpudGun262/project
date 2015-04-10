<div class="row">
    <h1>Admin Login</h1>

    <?php

    if(isset($error)) {
        echo '<div>'.$error.'</div>';
    }

    echo validation_errors('<div data-alert class="alert-box alert radius">', '</div>');

    echo '<form method="post" accept-charset="utf-8" class="column">';
    echo form_input('username', set_value('username'), 'placeholder="Username"');
    echo form_password('password', '', 'placeholder="Password" class="password"');
    echo form_submit('submit', 'Login', 'class="radius button"');
    echo form_close();

    ?>

</div>