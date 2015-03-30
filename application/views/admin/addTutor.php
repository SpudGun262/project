<h1>This is the add tutor page</h1>

<?php
//echo the validation errors if there is any
echo validation_errors('<div data-alert class="alert-box alert radius">', '</div>');

?>

<div class="row">

    <form data-abide action="<?php base_url('admin/tutors/addTutor') ?>" method="post">

        <div class="name-field">
            <label>First Name <small>required</small>
                <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                <input type="text" name="first_name" value="" placeholder="Add the tutors first name" required pattern="[-\sa-zA-Z]+$">
            </label>
            <small class="error">A first name is required and must not contain numbers or spaces.</small>
        </div>

        <div class="name-field">
            <label>Last Name <small>required</small>
                <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                <input type="text" name="last_name" value="" placeholder="Add the tutors last name" required pattern="[-\sa-zA-Z]+$">
            </label>
            <small class="error">A last name is required and must not contain numbers.</small>
        </div>

        <div class="email-field">
            <label>Email <small>required</small>
                <input type="email" name="email" placeholder="Add the email address of the tutor" value="" required>
            </label>
            <small class="error">An email address is required.</small>
        </div>

        <div class="password-field">
            <label>Password <small>required </small><span class="viewPassword right">View Password</span><span class="hidePassword right hide">Hide Password</span>
                <input type="password" id="password" name="password" placeholder="Give the tutor a password so they can login" required>
            </label>

            <small class="error">A password is required</small>
        </div>

        <div class="password-confirmation-field">
            <label>Confirm Password <small>required</small>
                <input type="password" name="passwordConfirm" placeholder="Make sure this matches the one above" required data-equalto="password">
            </label>
            <small class="error">The password did not match</small>
        </div>


        <input type="submit" name="add_tutor" value="Add New tutor" class="button radius">

    </form>
    <p><a class="button radius secondary" href="<?=base_url('admin/tutors')?>">Cancel</a></p>
</div>
<script>
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