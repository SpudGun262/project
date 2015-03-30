<h1>This is the add tutor page</h1>

<?php
//echo the validation errors if there is any
echo validation_errors('<div data-alert class="alert-box alert radius">', '</div>');

?>

<div class="row">

    <div class="large-6 medium-5 columns panel">

        <form data-abide action="<?php base_url('admin/tutors/addTutor') ?>" method="post">

            <div class="name-field">
                <label>First Name <small>required</small>
                    <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                    <input id="firstName" type="text" name="first_name" value="" placeholder="Add the tutors first name" required pattern="[-\sa-zA-Z]+$">
                </label>
                <small class="error">A first name is required and must not contain numbers or spaces.</small>
            </div>

            <div class="name-field">
                <label>Last Name <small>required</small>
                    <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                    <input id="lastName" type="text" name="last_name" value="" placeholder="Add the tutors last name" required pattern="[-\sa-zA-Z]+$">
                </label>
                <small class="error">A last name is required and must not contain numbers.</small>
            </div>

            <div class="email-field">
                <label>Email <small>required</small>
                    <input id="email" type="email" name="email" placeholder="Add the email address of the tutor" value="" required>
                </label>
                <small class="error">An email address is required.</small>
            </div>

            <div class="password-field">
                <label>Password <small>required </small><span class="viewPassword right">View Password</span><span class="hidePassword right hide">Hide Password</span>
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

            <div id="helpAdvice" class="panel">
                <h4>Need some help?</h4>
                <p>When you click one of the input boxes on the left, more information will appear here that should help you complete all the details need. Pretty cool huh?</p>
            </div>

            <div id="helpFirstName" class="hide panel">
                <h4>First Name <small>Required</small></h4>
                <p>Here you should enter the tutors first name. The name can not contain any numbers or spaces.</p>
            </div>

            <div id="helpLastName" class="hide panel">
                <h4>Last Name <small>Required</small></h4>
                <p>Here you should enter the tutors last name. Unlike first name, a tutors last name can contain spaces, hyphens. Although, it still can't have any numbers in it.</p>
            </div>

            <div id="helpEmail" class="hide panel">
                <h4>Email Address <small>Required</small></h4>
                <p>This should be a tutors university email address. They usually end in <strong>'@edgehill.ac.uk'</strong>. If you're unsure of this tutors email address, contact a member of IT Services</a></p>
            </div>

            <div id="helpPassword" class="hide panel">
                <h4>Password <small>Required</small></h4>
                <p>A tutor will use this password to login and upload projects and proposals. They will not be informed what this password is by the system. Instead, it is your responsibility to inform them of it. Once they have the password and can login, they can change it any time they like. Make sure it is secure and not easy to guess.</p>
                <p>Oh and if you forget what you wrote, just click <strong>'View Password'</strong>. Just remember to click it again if you don't want people around you to see! </p>
            </div>

            <div id="helpPasswordConfirm" class="hide panel">
                <h4>Confirm Password <small>Required</small></h4>
                <p>This password should match the one above and is here to help prevent any mistakes.</p>
            </div>

    </div>


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

//TODO: Improve this, its way too much code. The section below it, that is commented out, is an attempt but it doesn't not work right. You have to click an element, click away and click again for it to work
$( document).ready(function() {

   $("#firstName").focus(function(){
        $("#helpAdvice").addClass("hide");
        $("#helpFirstName").removeClass("hide");
    });
    $("#firstName").blur(function(){
        $("#helpAdvice").removeClass("hide");
        $("#helpFirstName").addClass("hide");
    });

    $("#lastName").focus(function(){
        $("#helpAdvice").addClass("hide");
        $("#helpLastName").removeClass("hide");
    });
    $("#lastName").blur(function(){
        $("#helpAdvice").removeClass("hide");
        $("#helpLastName").addClass("hide");
    });

    $("#email").focus(function(){
        $("#helpAdvice").addClass("hide");
        $("#helpEmail").removeClass("hide");
    });
    $("#email").blur(function(){
        $("#helpAdvice").removeClass("hide");
        $("#helpEmail").addClass("hide");
    });

    $("#password").focus(function(){
        $("#helpAdvice").addClass("hide");
        $("#helpPassword").removeClass("hide");
    });
    $("#password").blur(function(){
        $("#helpAdvice").removeClass("hide");
        $("#helpPassword").addClass("hide");
    });

    $("#passwordConfirm").focus(function(){
        $("#helpAdvice").addClass("hide");
        $("#helpPasswordConfirm").removeClass("hide");
    });
    $("#passwordConfirm").blur(function(){
        $("#helpAdvice").removeClass("hide");
        $("#helpPasswordConfirm").addClass("hide");
    });
});


//$(document).on('click', 'input', function() {
//    var inputId = this.id;
//    $("#" + inputId).focus(function () {
//        $("#helpAdvice").addClass("hide");
//        $("#help-" + inputId).removeClass("hide");
//    });
//    $("#" + inputId).blur(function () {
//        $("#helpAdvice").removeClass("hide");
//        $("#help-" + inputId).addClass("hide");
//    });
//});





</script>