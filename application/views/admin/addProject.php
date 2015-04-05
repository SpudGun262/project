<h1>This is the add project page</h1>

<?php
//echo the validation errorsadditional is any
echo validation_errors('<div data-alert class="alert-box alert radius">', '</div>');
if (!$file && $this->input->post()) {
    echo $this->upload->display_errors('<div data-alert class="alert-box alert radius">', '</div>');
}
?>

<div class="row">

    <div class="large-6 medium-5 columns panel">

        <form data-abide action="<?php base_url('admin/tutors/addProject') ?>" method="post"
              enctype="multipart/form-data">

            <div class="name-field">
                <label>Project Title
                    <small>required</small>
                    <!-- Regular expression allows for lowercase letter, capital letters, spaces, hyphens, underscores and numbers -->
                    <input type="text" id="project_title" name="project_title" value="" required pattern="[a-z\d\-_\s]+$">
                </label>
                <small class="error">A project title is required and can only contain lowercase letter, capital letters,
                    spaces, hyphens, underscores and numbers.
                </small>
            </div>

            <div class="name-field">
                <label>Abstract
                    <small>required</small>
                    <!-- No regular expression as all characters are allowed. CodeIgniter will still look to clean out any malicious code -->
                    <textarea id="abstract" name="abstract" value="" required></textarea>
                </label>
                <small class="error">An abstract is required.</small>
            </div>

            <div>
                <label>Course
                    <small>required</small>
                    <select id="course" name="course" required>
                        <option value="">Please select a course</option>
                        <?php
                        foreach ($courses as $course) {
                            echo '<option value="' . $course['course_id'] . '">' . $course['course_name'] . '</option>';
                        }
                        ?>
                    </select>
                </label>
                <small class="error">A course is required.</small>
            </div>

            <div>
                <label>Upload a file
                    <?php
                    $input = array(
                        'id' => 'userfile',
                        'type' => 'file',
                        'name' => 'userfile'
                    );
                    echo form_upload($input);
                    ?>
                </label>
            </div>

            <input type="submit" name="add_project" value="Add New Project" class="button radius"> <a
                class="button radius secondary" href="<?= base_url('admin/projects') ?>">Cancel</a>

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

        //Display help for 'Title' field
        $("#project_title").focus(function() {
            $("#helpAndAdvice").replaceWith(
                '<div id="helpAndAdvice" class="panel callout">' +
                '<h4 id="helpHeader">Project Title <small>Required</small></h4>' +
                '<div id="helpText">' +
                '<p>Here you should enter the title of the project. The title can contain numbers, hyphens, underscores and spaces.</p>' +
                '</div>' +
                '</div>'
            );
        });

        //Display help for 'Description' field
        $("#abstract").focus(function() {
            $("#helpAndAdvice").replaceWith(
                '<div id="helpAndAdvice" class="panel callout">' +
                '<h4 id="helpHeader">Abstract <small>Required</small></h4>' +
                '<div id="helpText">' +
                '<p>Here you should enter the abstract for the project. Students will see a short version of this to determine if they want to read more.</p>' +
                '</div>' +
                '</div>'
            );
        });

        //Display help for 'Course' field
        $("#course").focus(function() {
            $("#helpAndAdvice").replaceWith(
                '<div id="helpAndAdvice" class="panel callout">' +
                '<h4 id="helpHeader">Course <small>Required</small></h4>' +
                '<div id="helpText">' +
                '<p>This should be the course that the project is from.</p>' +
                '</div>' +
                '</div>'
            );
        });

        //Display help for 'Tutor' field
        $("#userfile").focus(function() {
            $("#helpAndAdvice").replaceWith(
                '<div id="helpAndAdvice" class="panel callout">' +
                '<h4 id="helpHeader">File</h4>' +
                '<div id="helpText">' +
                '<p>You don\'t have to upload a file. However, if you think this project needs additional information, you can add it here. You may upload a GIF, JPEG, PNG or PDF. The maximum file size for an upload is 10 megabytes </p>' +
                '</div>' +
                '</div>'
            );
        });
    });

</script>