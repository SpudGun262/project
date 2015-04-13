<h1>User Profile</h1>


<div class="row">

    <?= validation_errors('<div data-alert class="alert-box alert radius">', '</div>'); ?>
    <?=$this->session->flashdata('notice');?>
    <?=$this->session->flashdata('error');?>


    <div class="columns">
        <ul class="tabs" data-tab>
            <li class="tab-title active large-4 small-12"><a href="#panel1">Edit Profile</a></li>
            <li class="tab-title large-4 small-12"><a href="#panel2">Change Password</a></li>
            <li class="tab-title large-4 small-12"><a href="#panel3">Favourites</a></li>
        </ul>
    </div>
    <div class="tabs-content columns">
        <div class="content active" id="panel1">

            <div class="columns panel">

                <form data-abide action="<?=base_url('user/updateUser') ?>" method="post">

                    <div class="name-field">
                        <label>First Name <small>required</small>
                            <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                            <input id="firstName" type="text" name="first_name" value="<?=$userResult['first_name'];?>" placeholder="Your first name"  required pattern="[-\sa-zA-Z]+$">
                        </label>
                        <small class="error">A first name is required and must not contain numbers or spaces.</small>
                    </div>

                    <div class="name-field">
                        <label>Last Name <small>required</small>
                            <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                            <input id="lastName" type="text" name="last_name" value="<?=$userResult['last_name'];?>" placeholder="Your last name" required pattern="[-\sa-zA-Z]+$">
                        </label>
                        <small class="error">A last name is required and must not contain numbers.</small>
                    </div>

                    <div class="email-field">
                        <label>Email <small>required</small>
                            <input id="email" type="email" name="email" placeholder="Your email address" value="<?=$userResult['email'];?>" required>
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
                <form data-abide action="<?=base_url('user/changePassword') ?>" method="post">

                    <div class="password-field">
                        <label>Current Password <small>required </small>
                            <input id="currentPassword" type="password"  name="currentPassword" >
                        </label>

                        <small class="error">A current password is required</small>
                    </div>

                    <div class="password-field">
                        <label>New Password <small>required </small><span class="viewPassword right"><i class="fa fa-eye fa-fw"></i>View Password</span><span class="hidePassword right hide"><i class="fa fa-eye-slash fa-fw"></i>Hide Password</span>
                            <input id="password" type="password"  name="password" >
                        </label>

                        <small class="error">A new password is required</small>
                    </div>

                    <div class="password-confirmation-field">
                        <label>Confirm New Password <small>required</small>
                            <input id="passwordConfirm" type="password" name="passwordConfirm" placeholder="Make sure this matches the one above"  data-equalto="password">
                        </label>
                        <small class="error">The password did not match</small>
                    </div>


                    <input type="submit" name="change_password" value="Change Password" class="button radius">

                </form>

            </div>
        </div>

        <div class="content" id="panel3">

                <?php
                /**
                 * [project_id]
                 * [user_id]
                 * [title]
                 * [first_name]
                 * [last_name]
                 * [email]
                 */
                ?>


            <?php
            
            if(!empty($favourites)){
                
                echo
                    '<table class="column">
                        <thead>
                            <tr>
                                <th>Project Name</th>
                                <th><i class="fa fa-file-text-o fa-fw"></i>View Project</th>
                                <th><i class="fa fa-trash-o fa-fw"></i>Delete From Favourites</th>
                            </tr>
                        </thead>
                        <tbody>
                    ';

                foreach ($favourites as $favourite) {
                    echo
                        '<tr>
                            <td>' . $favourite['title'] . '</td>
                            <td><a href="' . base_url('projects/viewProject') . '/' . $favourite['project_id'] . '" class="radius button info small">View</a></td>
                            <td><a  class="alert radius button small" data-reveal-id="myModal' . $favourite['project_id'] . '">Delete</a></td>
                        </tr>
                        ';
                }
                
                echo
                    '
                        </tbody>
                    </table>
                    ';

                foreach ($favourites as $favourite) {
                    echo
                        '<div id="myModal' . $favourite['project_id'] . '" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
                        <h2>Caution</h2>
                        <p class="lead">You\'re about to delete:</p>
                        <p>' . $favourite['title'] . '</p>
                        <p class="lead">This will remove the project from your favourites. The action cannot be undone but you can re-add the project manually. Are you sure?</p>
                        <a href="' . base_url('projects/deleteFavourite') . '/' . $favourite['project_id'] . '" class="alert radius button small right">Confirm delete</a>
                        <a class="close secondary radius button small" aria-label="Close">Cancel</a>
                        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                    </div>
                    ';
                }
            }
            else
            {
                echo
                    '
                    <div class="column">
                        <p data-alert class="alert-box secondary radius">You have no projects in your favourites. Why don\'t you <a href="'. base_url('projects') .'">view some projects?</a></p>
                    </div>
                    ';
            }
            
            ?>
            
        </div>
    </div>




</div>

<script src="<?php echo asset_url().'js/passwordReveal.js'; ?>"></script>
<script src="<?php echo asset_url().'js/deleteModal.js'; ?>"></script>
