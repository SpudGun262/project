<h1>This is the add tutor page</h1>

<?php
//echo the validation errors if there is any
echo validation_errors('<div data-alert class="alert-box alert radius">', '</div>');

?>

<div class="columns">

    <form data-abide action="<?php base_url('admin/tutors/addTutor') ?>" method="post">

        <div class="name-field">
            <label>First Name <small>required</small>
                <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                <input type="text" name="first_name" value="" required pattern="[-\sa-zA-Z]+$">
            </label>
            <small class="error">A first name is required and must not contain numbers or spaces.</small>
        </div>

        <div class="name-field">
            <label>Last Name <small>required</small>
                <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                <input type="text" name="last_name" value="" required pattern="[-\sa-zA-Z]+$">
            </label>
            <small class="error">A last name is required and must not contain numbers.</small>
        </div>

        <div class="email-field">
            <label>Email <small>required</small>
                <input type="email" name="email" value="" required>
            </label>
        <small class="error">An email address is required.</small>
        </div>

        <input type="submit" name="add_tutor" value="Add New tutor" class="button radius">

    </form>

</div>