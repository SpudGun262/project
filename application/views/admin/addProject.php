<h1>This is the add project page</h1>

<?php
    //echo the validation errors if there is any
    echo validation_errors('<<div data-alert class="alert-box alert radius">', '</div>');
    if(!$file && $this->input->post()) {
        echo $this->upload->display_errors('<div data-alert class="alert-box alert radius">', '</div>');
    }
?>

<div class="columns">

    <form data-abide action="<?php base_url('admin/tutors/addProject') ?>" method="post" enctype="multipart/form-data">

        <div class="name-field">
            <label>Project Title <small>required</small>
                <!-- Regular expression allows for lowercase letter, capital letters, spaces, hyphens, underscores and numbers -->
                <input type="text" name="project_title" value="" required pattern="[a-z\d\-_\s]+$">
            </label>
            <small class="error">A project title is required and can only contain lowercase letter, capital letters, spaces, hyphens, underscores and numbers.</small>
        </div>

        <div class="name-field">
            <label>Abstract <small>required</small>
                <!-- No regular expression as all characters are allowed. CodeIgniter will still look to clean out any malicious code -->
                <textarea name="abstract" value="" required></textarea>
            </label>
            <small class="error">An abstract is required.</small>
        </div>

        <div>
            <label>Course <small>required</small>
                <select name="course" required>
                    <?php
                        foreach ($courses as $course) {
                            echo '<option value="' . $course['course_id'] . '">' . $course['name'] . '</option>';
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
                        'type' => 'file',
                        'name' => 'userfile',
                     );
                    echo form_upload($input);
                ?>
            </label>
        </div>

        <input type="submit" name="add_project" value="Add New Project" class="button radius">

    </form>

    <p><a href="<?=base_url('admin/projects')?>">Cancel</a></p>

</div>