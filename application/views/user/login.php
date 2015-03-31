<h1>Login</h1>

<?=$this->session->flashdata('notice');?>

    <?php
    echo form_open();
    echo validation_errors();
    echo form_input('email', set_value('email'), 'placeholder="Email"');
    echo form_password('password', '', 'placeholder="Password" class="password"');
    echo form_submit('submit', 'Login', 'class="radius button"');
    echo form_close();



echo '<a href="' . base_url() . '">Back to home page</a>';

?>