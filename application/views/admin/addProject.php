<h1>This is the add project page</h1>

<?php echo validation_errors(); ?>

<?php echo form_open(); ?>

<label for="title">Title</label>
<input type="input" name="title" /><br />

<label for="text">Text</label>
<textarea name="text"></textarea><br />

<input type="submit" name="submit" value="Add new project" />

<?php echo form_close(); ?>