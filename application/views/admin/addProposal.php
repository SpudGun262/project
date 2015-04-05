<h1>This is the add proposal page</h1>

<?php
//echo the validation errors if there is any
echo validation_errors('<div data-alert class="alert-box alert radius">', '</div>');
?>

<div class="row">

    <div class="large-6 medium-5 columns panel">

        <form data-abide action="<?php base_url('admin/tutors/addProposal') ?>" method="post">

            <div class="name-field">
                <label>Proposal Title <small>required</small>
                    <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                    <input type="text" id="proposal_title" name="proposal_title" value="<?=set_value('title');?>" placeholder="Add the proposal title" required pattern="[a-z\d\-_\s]+$">
                </label>
                <small class="error">A proposal title is required and can only contain lowercase letter, capital letters, spaces, hyphens, underscores and numbers.</small>
            </div>

            <div class="name-field">
                <label>Description <small>required</small>
                    <!-- No regular expression as all characters are allowed. CodeIgniter will still look to clean out any malicious code -->
                    <textarea id="desc" name="desc" value="<?=set_value('desc');?>" required></textarea>
                </label>
                <small class="error">A description is required.</small>
            </div>

            <div>
                <label>Course <small>required</small>
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
                <label>Tutor <small>required</small>
                    <select id="tutor" name="tutor" required>
                        <option value="">Please select a tutor</option>
                        <?php
                        foreach ($tutors as $tutor) {
                            echo '<option value="' . $tutor['tutor_id'] . '">' . $tutor['first_name'] . ' ' . $tutor['last_name'] . '</option>';
                        }
                        ?>
                    </select>
                </label>
                <small class="error">A tutor is required.</small>
            </div>

            <input type="submit" name="add_proposal" value="Add New Proposal" class="button radius"> <a class="button radius secondary" href="<?=base_url('admin/proposals')?>">Cancel</a>

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
        $("#proposal_title").focus(function() {
            $("#helpAndAdvice").replaceWith(
                '<div id="helpAndAdvice" class="panel callout">' +
                '<h4 id="helpHeader">Proposal Title <small>Required</small></h4>' +
                '<div id="helpText">' +
                '<p>Here you should enter the title of the proposal project. The title can contain numbers, hyphens, underscores and spaces.</p>' +
                '</div>' +
                '</div>'
            );
        });

        //Display help for 'Description' field
        $("#desc").focus(function() {
            $("#helpAndAdvice").replaceWith(
                '<div id="helpAndAdvice" class="panel callout">' +
                '<h4 id="helpHeader">Description <small>Required</small></h4>' +
                '<div id="helpText">' +
                '<p>Here you should enter a description for your project proposal. Students will read this description to determin if they want to do this project or not. The more detail the better.</p>' +
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
                '<p>This should be the course that the project proposal is aimed at or intended for.</p>' +
                '</div>' +
                '</div>'
            );
        });

        //Display help for 'Tutor' field
        $("#tutor").focus(function() {
            $("#helpAndAdvice").replaceWith(
                '<div id="helpAndAdvice" class="panel callout">' +
                '<h4 id="helpHeader">Tutor <small>Required</small></h4>' +
                '<div id="helpText">' +
                '<p>If you\'re entering this project proposal for another tutor, here is your chance to select that tutor. This is the person who will be notified if a student shows interest in the project proposal.</p>' +
                '</div>' +
                '</div>'
            );
        });
    });

</script>

