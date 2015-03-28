<?php
echo validation_errors('<div class="error">', '</div>');

if(!$file && $this->input->post()) {
    echo $this->upload->display_errors('<div class="error">', '</div>');
}
//open the HTML form
echo form_open_multipart();

//values for the project title input box
$input = array(
    'name' => 'project_title',
    'value' => $projectResult['title']
);
//echo a HTML label and input
echo form_label('Title', 'project_title').form_input($input);

//values for the abstract input box
$input = array(
    'name' => 'abstract',
    'value' => $projectResult['abstract']
);
//echo a HTML label and input
echo form_label('Abstract', 'abstract').form_textarea($input);

//echo a HTML select box
echo form_label('Course', 'course');
echo '<select name="course">';
//for each of the projects, echo the available courses as a option
foreach ($courses as $course) {
    echo '<option value="' . $course['course_id'] . '"';

    if($course['course_id'] == $projectResult['course_id']) {
        echo ' selected="selected"';
    }

    echo '>' . $course['name'] . '</option>';
}
//Close the select box
echo '</select>';

//Add a file
$input = array(
    'type' => 'file',
    'name' => 'userfile'
);
echo form_label('Upload a file', 'userfile').form_upload($input);

//values for the submit button
$button = array(
    'name' => 'add_project',
    'value' => 'Edit Project'
);
//echo a submit button
echo form_submit($button);

//close the HTML form
echo form_close(); ?>

<p><a href="<?=base_url('admin/projects')?>">Cancel</a></p>