<h1>Login</h1>

<?php
echo $this->session->flashdata('notice');
?>
<?php
echo $this->session->flashdata('error');
?>

<div class="row">

    <?php
    echo validation_errors('<div data-alert class="alert-box alert radius">', '</div>');

    if(isset($error)) {
        echo $error;
    }

    ?>

    <form data-abide method="post">

        <div class="email-field">
            <label>Email <small>required</small>
                <input id="email" type="email" name="email" value="<?=set_value('email');?>" required>
            </label>
            <small class="error">An email address is required.</small>
        </div>

        <div class="password-field">
            <label>Password <small>required </small><span class="viewPassword right"><i class="fa fa-eye fa-fw"></i>View Password</span><span class="hidePassword right hide"><i class="fa fa-eye-slash fa-fw"></i>Hide Password</span>
                <input id="password" type="password"  name="password" value="" required>
            </label>
            <small class="error">A password is required</small>
        </div>

        <input type="submit" name="login" value="Login" class="button radius">

    </form>

<a href="<?=base_url()?>">Back to home page</a>

</div>

<script>
    /**
     * Reveal Password Function
     *
     * This function enables the user to reveal the contents of the password they have typed.
     * When the element with the class of 'viewPassword' is clicked the password input field changes its type from 'password' to 'text' and therefore revealing its contents.
     * If the element is clicked again the field will revert back to a password input.
     */
    $( document).ready(function() {

        $(".viewPassword").click(function () {
            $("#password").attr("type", "text");
            $(this).addClass("hide");
            $(".hidePassword").removeClass("hide");
        });

        $(".hidePassword").click(function () {
            $("#password").attr("type", "password");
            $(this).addClass("hide");
            $(".viewPassword").removeClass("hide");
        });

    });

</script>