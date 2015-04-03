<h1>Project Page</h1>


<table>
    <thead>
    <tr>
        <th>Project Title</th>
        <th>Short Description</th>
        <th>Course</th>
        <th>Date Added</th>
    </tr>
    </thead>

    <?php
    $maxLength = 100;

    foreach ($projects as $project) {
        echo '<tr>';
        echo '<td>' . $project['title'] . '</td>';
        if (strlen($project['abstract']) > $maxLength) {
            $stringCut = substr($project['abstract'], 0, $maxLength);
            $project['abstract'] = substr($stringCut, 0, strrpos($stringCut, ' '));
        }
        echo '<td>' . $project['abstract'] . '...</td>';
        echo '<td>' . $project['course_name'] . '</td>';
        //reorder date to English standard (http://php.net/strtotime, http://php.net/manual/en/function.date.php)
        //uses HTML5 time tag (http://html5doctor.com/the-time-element/)
        echo '<td><time datetime="' . $project['date_added'] . '">' . date('d-m-Y',
                strtotime($project['date_added'])) . '</time></td>';
        echo '<tr>';
    }
    ?>
</table>