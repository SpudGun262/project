
<div class="header">
    <div class="row">

        <h1>Projects</h1>
        <h4 class="subheader">Explore projects from past students and learn what it is needed to undertake a computing project here.</h4>

    </div>
</div>

<div class="row">

    <div class="column">
        <table id="projectsTable" class="display">
            <thead>
            <tr>
                <th>Project Title</th>
                <th>Short Description</th>
                <th>Course</th>
                <th>Date Added</th>
            </tr>
            </thead>
            <tbody>


                <?php

                foreach ($projects as $project) {
                    echo '<tr>';
                        echo '<td><a href="' . base_url('projects/viewProject/') . '/' . $project['project_id'] . '">' . $project['title'] . '</a></td>';
                        echo '<td>' . maxLength($project['abstract']) . '...</td>';
                        echo '<td>' . $project['course_name'] . '</td>';
                        //reorder date to English standard (http://php.net/strtotime, http://php.net/manual/en/function.date.php)
                        //uses HTML5 time tag (http://html5doctor.com/the-time-element/)
                        echo '<td><time datetime="' . $project['date_added'] . '">' . date('d-m-Y', strtotime($project['date_added'])) . '</time></td>';
                    echo '</tr>';
                }
                ?>

            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript" class="init">
    $(document).ready(function(){
        $('#projectsTable').DataTable({
//            "bFilter": false
        });
    });
</script>