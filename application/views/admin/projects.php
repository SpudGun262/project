<h1>This is the admin projects page</h1>

<?=
//TODO: Style flash data
$this->session->flashdata('error', '<div class="error">', '</div>');?>

<?=$this->session->flashdata('notice', '<div class="notice">', '</div>');?>

<div class="adminProjectsTable column">

    <!--When clicked run the addProject method in the projects controller-->
    <a href="<?=base_url('admin/projects/addProject')?>" class="secondary button">&plus; Add New</a>

    <table >
        <thead>
            <tr>
                <th>Project Title</th>
                <th>Course</th>
                <th>File Name</th>
                <th>Data Added</th>
                <th>Edit Project</th>
                <th>Delete Project</th>
            </tr>
        </thead>
        <?php
        //for each of the projects, echo them as a single project inside a HTML table
        foreach ($projects as $project) {
            echo '<tr>';
                //Echo the title of the project
                echo '<td>' . $project['title'] . '</td>';
                //echo the name of the course the project is associated with
                echo '<td>' . $project['name'] . '</td>';
                //if the project has a file associated with it then echo the name of the file
                if ($project['file_name']){
                    echo '<td><a href="' . $project['location'] . '" target="_blank">' . $project['file_name'] . '</a></td>';
                //if the project does not have a file associated with it then echo NULL
                } else {
                    echo '<td>NULL</td>';
                }
                //echo the first and last name of the tutor who uploaded the project
//                echo '<td>' . $project['first_name'] . ' ' . $project['last_name'] . '</td>';
                //reorder date to English standard (http://php.net/strtotime, http://php.net/manual/en/function.date.php)
                ////uses HTML5 time tag (http://html5doctor.com/the-time-element/)
                echo '<td><time datetime="' . $project['date_added'] . '">' . date('d-m-Y', strtotime($project['date_added'])) . '</time></td>';
                //echo an edit button
                echo '<td><a href="' . base_url('admin/projects/editProject') .'/' . $project['project_id'] . '" class="radius button small">Edit</a></td>';
                echo '<td><a href="' . base_url('admin/projects/deleteProject') .'/' . $project['project_id'] . '" class="alert radius button small">Delete</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>