<h1>This is the add proposal page</h1>

<?php
//echo the validation errors if there is any
echo validation_errors('<div data-alert class="alert-box alert radius">', '</div>');
?>

<div class="columns">

    <form data-abide action="<?php base_url('admin/tutors/addProposal') ?>" method="post">

        <div class="name-field">
            <label>Proposal Title <small>required</small>
                <!-- Regular expression allows for lowercase letter, capital letters, spaces and hyphens -->
                <input type="text" name="proposal_title" value="" placeholder="Add the proposal title" required pattern="[a-z\d\-_\s]+$">
            </label>
            <small class="error">A first name is required and must not contain numbers or spaces.</small>
        </div>

        <div class="name-field">
            <label>Description <small>required</small>
                <!-- No regular expression as all characters are allowed. CodeIgniter will still look to clean out any malicious code -->
                <textarea name="desc" value="" required></textarea>
            </label>
            <small class="error">A description is required.</small>
        </div>

        <div>
            <label>Course <small>required</small>
                <select name="course" required>
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
                <select name="tutor" required>
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

        <input type="submit" name="add_proposal" value="Add New Proposal" class="button radius">

    </form>

    <p><a class="button radius secondary" href="<?=base_url('admin/proposals')?>">Cancel</a></p>

</div>

