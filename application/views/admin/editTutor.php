<div id="adminHeader">
    <h1 class="row">Edit Tutor <small>Amend the details of an existing Tutor</small></h1>
</div>
<div class="row">

    <?php
    //echo the validation errors if there is any
    echo validation_errors('<div data-alert class="alert-box alert radius">', '</div>');
    ?>

    <div class="large-6 medium-5 columns panel">

        <form data-abide method="post">

            <div class="name-field">
                <label>First Name
                    <small>required</small>
                    <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                    <input type="text" id="firstName" name="first_name" value="<?= $tutorResult['first_name'] ?>"
                           placeholder="Add the tutors first name" required pattern="[-\sa-zA-Z]+$">
                </label>
                <small class="error">A first name is required and must not contain numbers or spaces.</small>
            </div>

            <div class="name-field">
                <label>Last Name
                    <small>required</small>
                    <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                    <input type="text" id="lastName" name="last_name" value="<?= $tutorResult['last_name'] ?>"
                           placeholder="Add the tutors last name" required pattern="[-\sa-zA-Z]+$">
                </label>
                <small class="error">A last name is required and must not contain numbers.</small>
            </div>

            <div class="name-field">
                <label>Research Interest
                    <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                    <input id="researchInterest" type="text" name="research_interest" value="<?=$tutorResult['research_interest'] ?>" placeholder="Add the research interest of the tutor" pattern="[-\sa-zA-Z]+$">
                </label>
                <small class="error">Research Interests can only contain lowercase letter, capital letters, spaces and hyphens.</small>
            </div>

            <div class="email-field">
                <label>Email
                    <small>required</small>
                    <input type="email" id="email" name="email" placeholder="Add the email address of the tutor"
                           value="<?= $tutorResult['email'] ?>" required>
                </label>
                <small class="error">An email address is required.</small>
            </div>

            <input type="submit" name="edit_tutor" value="Edit Tutor" class="button radius"> <a
                class="button radius secondary" href="<?= base_url('admin/tutors') ?>">Cancel</a>

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