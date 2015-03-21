<div id="register_form">
    <h1>Create a Account</h1>
    <?= validation_errors('<div class="error">', '</div>'); ?>
    <?php
        echo form_open('login/create_member');
        echo form_input('first_name', set_value('first_name'), 'placeholder="First Name"');
        echo form_input('last_name', set_value('last_name'), 'placeholder="Last Name"');
        echo form_input('email', set_value('email'), 'placeholder="Email Address"');
        echo form_input('username', set_value('username'), 'placeholder="Username"');
        echo form_password('password', '', 'placeholder="Password" class="password"');
        echo form_password('password_confirm', '', 'placeholder="Confirm Password" class="password"');
        echo form_submit('submit', 'Create Account');
    ?>
</div>