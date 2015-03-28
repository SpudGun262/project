<?php
echo validation_errors('<div class="error">', '</div>');

//open the HTML form
echo form_open_multipart();

//values for the proposal title input box
$input = array(
    'name' => 'proposal_title',
    'value' => $proposalResult['title']
);
//echo a HTML label and input
echo form_label('Title', 'proposal_title').form_input($input);

//values for the abstract input box
$input = array(
    'name' => 'desc',
    'value' => $proposalResult['desc']
);
//echo a HTML label and input
echo form_label('Description', 'desc').form_textarea($input);

//echo a HTML select box
echo form_label('Course', 'course');
echo '<select name="course">';
//for each of the proposals, echo the available courses as a option
foreach ($courses as $course) {
    echo '<option value="' . $course['course_id'] . '"';

    if($course['course_id'] == $proposalResult['course_id']) {
        echo ' selected="selected"';
    }

    echo '>' . $course['name'] . '</option>';
}
//Close the select box
echo '</select>';

//echo a HTML select box
echo form_label('Tutor', 'tutor');
echo '<select name="tutor">';
//for each of the proposals, echo the available courses as a option
foreach ($tutors as $tutor) {
    echo '<option value="' . $tutor['tutor_id'] . '"';

    if($tutor['tutor_id'] == $proposalResult['tutor_id']) {
        echo ' selected="selected"';
    }

    echo '>' . $tutor['first_name'] . ' ' . $tutor['last_name'] . '</option>';
}
//Close the select box
echo '</select>';

//values for the submit button
$button = array(
    'name' => 'add_proposal',
    'value' => 'Edit proposal'
);
//echo a submit button
echo form_submit($button);

//close the HTML form
echo form_close(); ?>

<p><a href="<?=base_url('admin/proposals')?>">Cancel</a></p>