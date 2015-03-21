<h1>This is the admin projects page</h1>

<!--When clicked run the addProject method in the projects controller-->
<a href="<?=base_url('admin/projects/addProject')?>">&plus; Add New</a>

<div class="adminProjectsTable">
    <table >
        <tr>
            <td>
                Project Title
            </td>
            <td>
               Course
            </td>
            <td>
                File Name
            </td>
            <td>
                Data Added
            </td>
            <td>
                Edit
            </td>
        </tr>
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
                echo '<td><a href="' . base_url('admin/editProject') . '">Edit</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>