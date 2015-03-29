<?php
    //echo the validation errors if there is any
    echo validation_errors('<div data-alert class="alert-box alert radius">', '</div>');
?>

<div class="columns">

    <form data-abide method="post">

        <div class="name-field">
            <label>First Name <small>required</small>
                <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                <input type="text" name="first_name" value="<?=$tutorResult['first_name']?>" placeholder="Add the tutors first name" required pattern="[-\sa-zA-Z]+$">
            </label>
            <small class="error">A first name is required and must not contain numbers or spaces.</small>
        </div>

        <div class="name-field">
            <label>Last Name <small>required</small>
                <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                <input type="text" name="last_name" value="<?=$tutorResult['last_name']?>" placeholder="Add the tutors last name" required pattern="[-\sa-zA-Z]+$">
            </label>
            <small class="error">A last name is required and must not contain numbers.</small>
        </div>

        <div class="email-field">
            <label>Email <small>required</small>
                <input type="email" name="email" placeholder="Add the email address of the tutor" value="<?=$tutorResult['email']?>" required>
            </label>
            <small class="error">An email address is required.</small>
        </div>

        <input type="submit" name="edit_tutor" value="Edit Tutor" class="button radius">

    </form>

    <p><a class="button radius secondary" href="<?=base_url('admin/tutors')?>">Cancel</a></p>

</div>