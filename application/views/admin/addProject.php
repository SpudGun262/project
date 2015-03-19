<h1>This is the add project page</h1>

<?php echo validation_errors('<div class="error">', '</div>'); ?>

<?php echo form_open();

    $input = array(
    'name' => 'project_title'
    );

    echo form_label('Title', 'project_title').'<p>'.form_input($input).'</p>';

    $input = array(
    'name' => 'abstract'
    );

    echo form_label('Abstract', 'abstract').'<p>'.form_input($input).'</p>';

    $button = array(
    'name' => 'add_project',
    'value' => 'Add New Project'
    );
    echo form_submit($button);

echo form_close(); ?>