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
        <ul class="tabs" data-tab>
            <li class="tab-title active"><a href="#panel1">Edit Profile</a></li>
            <li class="tab-title"><a href="#panel2">Change Password</a></li>
            <li class="tab-title"><a href="#panel3">Tab 3</a></li>
            <li class="tab-title"><a href="#panel4">Tab 4</a></li>
        </ul>
    </div>
    <div class="tabs-content columns">
        <div class="content active" id="panel1">

            <?= validation_errors('<div data-alert class="alert-box alert radius">', '</div>'); ?>
            <?=$this->session->flashdata('notice');?>

            <div class="columns panel">
                <!--TODO: get this to submit to the right location-->
                <form data-abide action="<?=base_url('user/updateUser') ?>" method="post">

                    <div class="name-field">
                        <label>First Name <small>required</small>
                            <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                            <input id="firstName" type="text" name="first_name" value="<?=$userResult['first_name'];?>" placeholder="Add the tutors first name"  required pattern="[-\sa-zA-Z]+$">
                        </label>
                        <small class="error">A first name is required and must not contain numbers or spaces.</small>
                    </div>

                    <div class="name-field">
                        <label>Last Name <small>required</small>
                            <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                            <input id="lastName" type="text" name="last_name" value="<?=$userResult['last_name'];?>" placeholder="Add the tutors last name" required pattern="[-\sa-zA-Z]+$">
                        </label>
                        <small class="error">A last name is required and must not contain numbers.</small>
                    </div>

                    <div class="email-field">
                        <label>Email <small>required</small>
                            <input id="email" type="email" name="email" placeholder="Add the email address of the tutor" value="<?=$userResult['email'];?>" required>
                        </label>
                        <small class="error">An email address is required.</small>
                    </div>


                    <input type="submit" name="update_profile" value="Update Profile" class="button radius">

                </form>

            </div>

        </div>
        <div class="content" id="panel2">
            <?= validation_errors('<div data-alert class="alert-box alert radius">', '</div>'); ?>

            <div class="columns panel">
                <!--TODO: get this to submit to the right location-->
                <form data-abide action="<?=base_url('user/addUser') ?>" method="post">

                    <div class="password-field">
                        <label>Current Password <small>required </small>
                            <input id="currentPassword" type="password"  name="currentPassword" required>
                        </label>

                        <small class="error">A current password is required</small>
                    </div>

                    <div class="password-field">
                        <label>New Password <small>required </small><span class="viewPassword right"><i class="fa fa-eye fa-fw"></i>View Password</span><span class="hidePassword right hide"><i class="fa fa-eye-slash fa-fw"></i>Hide Password</span>
                            <input id="password" type="password"  name="password" required>
                        </label>

                        <small class="error">A new password is required</small>
                    </div>

                    <div class="password-confirmation-field">
                        <label>Confirm New Password <small>required</small>
                            <input id="passwordConfirm" type="password" name="passwordConfirm" placeholder="Make sure this matches the one above" required data-equalto="password">
                        </label>
                        <small class="error">The password did not match</small>
                    </div>


                    <input type="submit" name="change_password" value="Change Password" class="button radius">

                </form>

            </div>
        </div>
        <div class="content" id="panel3">
            <p>This is the third panel of the basic tab example. This is the third panel of the basic tab example.</p>
        </div>
        <div class="content" id="panel4">
            <p>This is the fourth panel of the basic tab example. This is the fourth panel of the basic tab example.</p>
        </div>
    </div>




</div>

<script src="<?php echo asset_url().'js/passwordReveal.js'; ?>"></script>
