<h1>This is the add tutor page</h1>

<?php
//echo the validation errors if there is any
echo validation_errors('<div data-alert class="alert-box alert radius">', '</div>');

?>

<div class="row">

    <div class="large-6 medium-5 columns panel">

        <form data-abide action="<?=base_url('admin/tutors/addTutor') ?>" method="post">

            <div class="name-field">
                <label>First Name <small>required</small>
                    <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                    <input id="firstName" type="text" name="first_name" value="<?=set_value('first_name');?>" placeholder="Add the tutors first name" required pattern="[-\sa-zA-Z]+$">
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
                <label>Password <small>required </small><span class="viewPassword right"><i class="fa fa-eye fa-fw"></i>View Password</span><span class="hidePassword right hide"><i class="fa fa-eye-slash fa-fw"></i>Hide Password</span>
                    <input id="password" type="password"  name="password" placeholder="Give the tutor a password so they can login" required>
                </label>

                <small class="error">A password is required</small>
            </div>

            <div class="password-confirmation-field">
                <label>Confirm Password <small>required</small>
                    <input id="passwordConfirm" type="password" name="passwordConfirm" placeholder="Make sure this matches the one above" required data-equalto="password">
                </label>
                <small class="error">The password did not match</small>
            </div>


            <input type="submit" name="add_tutor" value="Add New tutor" class="button radius"> <a class="button radius secondary" href="<?=base_url('admin/tutors')?>">Cancel</a>

        </form>



    </div>

    <div class="large-6 medium-7 columns hide-for-small">

            <h2>Help &amp; Advice</h2>

            <div id="helpAndAdvice" class="panel callout">
                <h4 id="helpHeader">Need some help?</h4>
                <div id="helpText">
                    <p>When you click one of the input boxes on the left, more information will appear here that should help you complete all the details needed. Pretty cool huh?</p>
                </div>
            </div>

    </div>


</div>

<script src="<?php echo asset_url().'js/passwordReveal.js'; ?>"></script>

<script>
    /**
     * Help & Advice Function
     *
     * This large function replaces the text inside the 'Help & Advice' panel with contextual help.
     * When the user clicks on a form input field the text inside the 'Help & Advice' panel is replaced using the jQuery 'replaceWith()' method.
     */
    $(document).ready(function() {

        //Display help for 'First Name' field
        $("#firstName").focus(function() {
            $("#helpAndAdvice").replaceWith(
                '<div id="helpAndAdvice" class="panel callout">' +
                    '<h4 id="helpHeader">First Name <small>Required</small></h4>' +
                    '<div id="helpText">' +
                        '<p>Here you should enter the tutors first name. The name can not contain any numbers or spaces.</p>' +
                    '</div>' +
                '</div>'
            );
        });

        //Display help for 'Last Name' field
        $("#lastName").focus(function() {
            $("#helpAndAdvice").replaceWith(
                '<div id="helpAndAdvice" class="panel callout">' +
                    '<h4 id="helpHeader">Last Name <small>Required</small></h4>' +
                    '<div id="helpText">' +
                        '<p>Here you should enter the tutors last name. Unlike first name, a tutors last name can contain spaces and hyphens. Although, it still can\'t have any numbers in it.</p>' +
                    '</div>' +
                '</div>'
            );
        });

        //Display help for 'Email' field
        $("#email").focus(function() {
            $("#helpAndAdvice").replaceWith(
                '<div id="helpAndAdvice" class="panel callout">' +
                    '<h4 id="helpHeader">Email Address <small>Required</small></h4>' +
                    '<div id="helpText">' +
                        '<p>This should be a tutors university email address. They usually end in <strong>\'@edgehill.ac.uk\'</strong>.</p>' +
                        '<p>If you\'re unsure of this tutors email address, contact a member of <a href="https://www.edgehill.ac.uk/itservices/" target="_blank">IT Services</a></p>' +
                    '</div>' +
                '</div>'
            );
        });

        //Display help for 'Password' field
        $("#password").focus(function() {
            $("#helpAndAdvice").replaceWith(
                '<div id="helpAndAdvice" class="panel callout">' +
                    '<h4 id="helpHeader">Password <small>Required</small></h4>' +
                    '<div id="helpText">' +
                        '<p>A tutor will use this password to login and upload projects and proposals.</p>' +
                        '<p><em><strong>Project Bazaar will not inform them what their password. Instead, it is your responsibility to inform them of it.</strong></em></p>' +
                        '<p>Once they have the password and can login, they can change it any time they like. Make sure it is secure and not easy to guess.</p>' +
                        '<p>Oh and if you forget what you wrote, just click <strong>\'View Password\'</strong>. Just remember to click it again if you don\'t want people around you to see!</p>' +
                    '</div>' +
                '</div>'
            );
        });

        //Display help for 'Confirm Password' field
        $("#passwordConfirm").focus(function() {
            $("#helpAndAdvice").replaceWith(
                '<div id="helpAndAdvice" class="panel callout">' +
                    '<h4 id="helpHeader">Confirm Password <small>Required</small></h4>' +
                    '<div id="helpText">' +
                        '<p>This password should match the one above and is here to help prevent mistakes.</p>' +
                    '</div>' +
                '</div>'
            );
        });

    });

</script>