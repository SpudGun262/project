<h1>This is the admin projects page</h1>

<a href="<?=base_url('admin/addProject')?>">&plus; Add New</a>

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
                Added By
            </td>
            <td>
                Data Added
            </td>
        </tr>
        <?php
        foreach ($projects as $project) {
            echo '<tr>';
                echo '<td>' . $project['title'] . '</td>';
                echo '<td>' . $project['name'] . '</td>';
                if ($project['file_name']){
                    echo '<td>' . $project['file_name'] . '</td>';
                } else {
                    echo '<td>NULL</td>';
                }
                echo '<td>' . $project['first_name'] . ' ' . $project['last_name'] . '</td>';
                //reorder date to English standard (http://php.net/strtotime, http://php.net/manual/en/function.date.php)
                ////uses HTML5 time tag (http://html5doctor.com/the-time-element/)
                echo '<td><time datetime="' . $project['date_added'] . '">' . date('d-m-Y', strtotime($project['date_added'])) . '</time></td>';
                echo '<td><a href="' . base_url('admin/editProject') . '">Edit</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>