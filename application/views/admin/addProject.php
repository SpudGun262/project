<h1>This is the add project page</h1>

<?php
    //echo the validation errors if there is any
    echo validation_errors('<div class="error">', '</div>');
    if(!$file && $this->input->post()) {
        echo $this->upload->display_errors('<div class="error">', '</div>');
    }
?>

<?php

echo '<div class="columns">';

    //open the HTML form
    echo form_open_multipart('admin/projects/addProject');

        //values for the project title input box
        $input = array(
        'name' => 'project_title'
        );
        //echo a HTML label and input
        echo form_label('Title', 'project_title').form_input($input);

        //values for the abstract input box
        $input = array(
        'name' => 'abstract'
        );
        //echo a HTML label and input
        echo form_label('Abstract', 'abstract').form_input($input);

        //echo a HTML select box
        echo '<select name="course">';
            //for each of the projects, echo the available courses as a option
            foreach ($courses as $course) {
                echo '<option value="' . $course['course_id'] . '">' . $course['name'] . '</option>';
            }
        //Close the select box
        echo '</select>';

        //Add a file
        $input = array(
            'type' => 'file',
            'name' => 'userfile',
        );
        echo form_label('Upload a file', 'userfile').form_upload($input);

        //values for the submit button
        $button = array(
        'name' => 'add_project',
        'value' => 'Add New Project',
        'class' => 'button radius'
        );
        //echo a submit button
        echo form_submit($button);

    //close the HTML form
    echo form_close();

echo '</div>';

?>