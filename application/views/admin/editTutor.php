<?php
echo validation_errors('<div class="error">', '</div>');

//open the HTML form
echo form_open_multipart();

    //values for the tutor title input box
    $input = array(
        'name' => 'first_name',
        'value' => $tutorResult['first_name']
    );
    //echo a HTML label and input
    echo form_label('First Name', 'first_name').form_input($input);
    
    //values for the abstract input box
    $input = array(
        'name' => 'last_name',
        'value' => $tutorResult['last_name']
    );
    //echo a HTML label and input
    echo form_label('Last Name', 'last_name').form_input($input);

    //values for the abstract input box
    $input = array(
        'name' => 'email',
        'value' => $tutorResult['email']
    );
    //echo a HTML label and input
    echo form_label('Email', 'email').form_input($input);
    

    
    //values for the submit button
    $button = array(
        'name' => 'edit_tutor',
        'value' => 'Edit tutor'
    );
    //echo a submit button
    echo form_submit($button);

//close the HTML form
echo form_close(); ?>

<p><a href="<?=base_url('admin/tutors')?>">Cancel</a></p>