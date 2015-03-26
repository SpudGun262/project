<h1>This is the add proposal page</h1>

<?php
//echo the validation errors if there is any
echo validation_errors('<div class="error">', '</div>');

echo '<div class="columns">';

//open the HTML form
echo form_open_multipart('admin/proposals/addProposal');

//values for the proposal title input box
$input = array(
    'name' => 'proposal_title'
);
//echo a HTML label and input
echo form_label('Title', 'proposal_title').form_input($input);

//values for the abstract input box
$input = array(
    'name' => 'desc'
);
//echo a HTML label and input
echo form_label('Description', 'desc').form_input($input);

//echo a HTML select box
echo form_label('Course', 'course');
echo '<select name="course">';
//for each of the proposals, echo the available courses as a option
foreach ($courses as $course) {
    echo '<option value="' . $course['course_id'] . '">' . $course['name'] . '</option>';
}
//Close the select box
echo '</select>';

//echo HTML select box for tutors
echo form_label('Associated Tutor', 'tutor');
echo '<select name="tutor">';
foreach ($tutors as $tutor){
    echo '<option value="' . $tutor['tutor_id'] . '">' . $tutor['first_name'] . ' ' . $tutor['last_name'] . '</option>';
}
//Close the select box
echo '</select>';

//values for the submit button
$button = array(
    'name' => 'add_proposal',
    'value' => 'Add New proposal',
    'class' => 'button radius'
);
//echo a submit button
echo form_submit($button);

//close the HTML form
echo form_close();

echo '</div>';

?>