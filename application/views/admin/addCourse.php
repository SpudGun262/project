<h1>This is the add course page</h1>

<?php
//echo the validation errors if there is any
echo validation_errors('<div data-alert class="alert-box alert radius">', '</div>');

?>

<div class="row">

    <div class="large-6 medium-5 columns panel">

        <form data-abide action="<?=base_url('admin/courses/addCourse') ?>" method="post">

            <div class="name-field">
                <label>Course Name <small>required</small>
                    <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                    <input id="courseName" type="text" name="course_name" value="<?=set_value('course_name');?>" placeholder="Add the course name" required pattern="[a-z\d\-_\s]+$">
                </label>
                <small class="error">A course name is required and can only contain lowercase letter, capital letters, spaces, hyphens, underscores and numbers.</small>
            </div>

            <input type="submit" name="add_course" value="Add New Course" class="button radius"> <a class="button radius secondary" href="<?=base_url('admin/courses')?>">Cancel</a>

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
        $("#courseName").focus(function() {
            $("#helpAndAdvice").replaceWith(
                '<div id="helpAndAdvice" class="panel callout">' +
                '<h4 id="helpHeader">Course Name <small>Required</small></h4>' +
                '<div id="helpText">' +
                '<p>Here you should enter the course name. Most characters are allowed here.</p>' +
                '</div>' +
                '</div>'
            );
        });
    });

</script>