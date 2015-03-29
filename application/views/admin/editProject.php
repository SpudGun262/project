<?php
//echo the validation errors if there is any
echo validation_errors('<div data-alert class="alert-box alert radius">', '</div>');

//echo file validation errors if there is any
if(!$file && $this->input->post()) {
    echo $this->upload->display_errors('<div data-alert class="alert-box alert radius">', '</div>');
}

?>

<div class="columns">

    <form data-abide action="" method="post" enctype="multipart/form-data">

        <div class="name-field">
            <label>Project Title <small>required</small>
                <!-- Regular expression allows for lowercase letter, capital letters, spaces, hyphens, underscores and numbers -->
                <input type="text" name="project_title" value="<?=$projectResult['title']?>" required pattern="[a-z\d\-_\s]+$">
            </label>
            <small class="error">A project title is required and can only contain lowercase letter, capital letters, spaces, hyphens, underscores and numbers.</small>
        </div>

        <div class="name-field">
            <label>Abstract <small>required</small>
                <!-- No regular expression as all characters are allowed. CodeIgniter will still look to clean out any malicious code -->
                <textarea name="abstract" required><?=$projectResult['abstract']?></textarea>
            </label>
            <small class="error">An abstract is required.</small>
        </div>

        <div>
            <label>Course <small>required</small>
                <select name="course" required>
                    <option value="">Please select a course</option>
                    <?php
                    foreach ($courses as $course) {
                        echo '<option value="' . $course['course_id'] . '"';

                        if($course['course_id'] == $projectResult['course_id']) {
                            echo ' selected="selected"';
                        }

                        echo '>' . $course['name'] . '</option>';
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

        <input type="submit" name="edit_project" value="Edit Project" class="button radius">
    </form>

    <p><a class="button radius secondary" href="<?=base_url('admin/projects')?>">Cancel</a></p>

</div>