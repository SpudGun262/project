<h1>User Profile</h1>

<?php
echo $userResult['user_id'];
echo $userResult['first_name'];
echo $userResult['last_name'];
echo $userResult['password'];
echo $userResult['email'];
?>

<div class="row">

    <div class="columns">

        <dl class="sub-nav">
            <dd class="active"><a href="#">Edit Profile</a></dd>
            <dd><a href="<?=base_url('user/changePassword')?>">Change Password</a></dd>
        </dl>

    </div>

    <h1>Edit Profile</h1>
    <?= validation_errors('<div data-alert class="alert-box alert radius">', '</div>'); ?>

    <div class="columns panel">

        <form data-abide action="<?=base_url('user/addUser') ?>" method="post">

            <div class="name-field">
                <label>First Name <small>required</small>
                    <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                    <input id="firstName" type="text" name="first_name" value="<?=$userResult['first_name'];?>" placeholder="Add the tutors first name" required pattern="[-\sa-zA-Z]+$">
                </label>
                <small class="error">A first name is required and must not contain numbers or spaces.</small>
            </div>

            <div class="name-field">
                <label>Last Name <small>required</small>
                    <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                    <input id="lastName" type="text" name="last_name" value="<?=set_value('last_name');?>" placeholder="Add the tutors last name" required pattern="[-\sa-zA-Z]+$">
                </label>
                <small class="error">A last name is required and must not contain numbers.</small>
            </div>

            <div class="email-field">
                <label>Email <small>required</small>
                    <input id="email" type="email" name="email" placeholder="Add the email address of the tutor" value="<?=set_value('email');?>" required>
                </label>
                <small class="error">An email address is required.</small>
            </div>

            <div class="password-field">
                <label>Password <small>required </small><span class="viewPassword right">View Password</span><span class="hidePassword right hide">Hide Password</span>
                    <input id="password" type="password"  name="password" placeholder="Create a password" required>
                </label>

                <small class="error">A password is required</small>
            </div>

            <div class="password-confirmation-field">
                <label>Confirm Password <small>required</small>
                    <input id="passwordConfirm" type="password" name="passwordConfirm" placeholder="Make sure this matches the one above" required data-equalto="password">
                </label>
                <small class="error">The password did not match</small>
            </div>


            <input type="submit" name="add_user" value="Create Account" class="button radius"> <a class="button radius secondary" href="<?=base_url('home')?>">Cancel</a>

        </form>



    </div>

</div>
