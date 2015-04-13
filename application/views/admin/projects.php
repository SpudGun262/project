<div id="adminHeader">
    <h1 class="row">Projects <small>Add new Projects and edit or delete existing ones</small></h1>
</div>

<div class="row">

    <?= $this->session->flashdata('error'); ?>

    <?= $this->session->flashdata('notice'); ?>

    <div class="adminProjectsTable">

        <!--When clicked run the addProject method in the projects controller-->
        <a href="<?= base_url('admin/projects/addProject') ?>" class="secondary button">&plus; Add New</a>
        <table id="projectsTable" class="display column">
            <thead>
            <tr>
                <th>Project Title</th>
                <th>Course</th>
                <th>File Name</th>
                <th>Data Added</th>
                <th><i class="fa fa-pencil fa-fw"></i>Edit Project</th>
                <th><i class="fa fa-trash-o fa-fw"></i>Delete Project</th>
            </tr>
            </thead>
            <tbody>
            <?php
            //for each of the projects, echo them as a single project inside a HTML table
            foreach ($projects as $project) {
                echo '<tr>';
                //Echo the title of the project
                echo '<td>' . $project['title'] . '</td>';
                //echo the name of the course the project is associated with
                echo '<td>' . $project['course_name'] . '</td>';
                //if the project has a file associated with it then echo the name of the file
                if ($project['file_name']) {
                    echo '<td><a href="' . $project['location'] . '" target="_blank">' . $project['file_name'] . '</a></td>';
                    //if the project does not have a file associated with it then echo NULL
                } else {
                    echo '<td>NULL</td>';
                }
                //reorder date to English standard (http://php.net/strtotime, http://php.net/manual/en/function.date.php)
                ////uses HTML5 time tag (http://html5doctor.com/the-time-element/)
                echo '<td><time datetime="' . $project['date_added'] . '">' . date('d-m-Y',
                        strtotime($project['date_added'])) . '</time></td>';
                //echo an edit button
                echo '<td><a href="' . base_url('admin/projects/editProject') . '/' . $project['project_id'] . '" class="radius button small">Edit</a></td>';
                echo '<td><a href="' . base_url('admin/projects/deleteProject') . '/' . $project['project_id'] . '" data-reveal-id="myModal' . $project['project_id'] . '" class="alert radius button small">Delete</a></td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';

            foreach ($projects as $project) {
                echo '<div id="myModal' . $project['project_id'] . '" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">';
                echo '<h2>Caution</h2>';
                echo '<p class="lead">You\'re about to delete a project with the title:</p>';
                echo '<p>' . $project['title'] . '.</p>';
                echo '<p class="lead">Are you sure?</p>';
                echo '<a href="' . base_url('admin/projects/deleteProject') . '/' . $project['project_id'] . '" class="alert radius button small right">Confirm delete</a>';
                echo '<a class="close secondary radius button small" aria-label="Close">Cancel</a>';
                echo '<a class="close-reveal-modal" aria-label="Close">&#215;</a>';
                echo '</div>';
            }
            ?>

    </div>

</div>

<script src="<?php echo asset_url() . 'js/deleteModal.js'; ?>"></script>
<script type="text/javascript" class="init">
    $(document).ready(function () {
        $('#projectsTable').DataTable({});
    });
</script>