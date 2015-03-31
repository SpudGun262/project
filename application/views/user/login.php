<h1>Login</h1>

<?=$this->session->flashdata('notice');?>

    <?php
    echo form_open('login/validate_credentials');
    echo form_input('username', 'Username');
    echo form_password('password', '', 'placeholder="Password" class="password"');
    echo form_submit('submit', 'Login');
    echo anchor('login/signup', 'Create Account');
    ?>
