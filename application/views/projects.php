<?php

echo '<h1>Project Page</h1>';

foreach ($projects as $project) {
    echo '<h2>' . $project['title'] . '</h2>';
    echo '<p>' . $project['abstract'] . '</p>';
    //reorder date to English standard (http://php.net/strtotime, http://php.net/manual/en/function.date.php)
    //uses HTML5 time tag (http://html5doctor.com/the-time-element/)
    echo '<time datetime="' . $project['date_added'] . '">' . date('d-m-Y', strtotime($project['date_added'])) . '</time>';
}