<?php

echo '<h1>Proposal page</h1>';


foreach ($proposals as $proposal) {
    echo '<h2>' . $proposal['title'] . '</h2>';
    echo '<p>' . $proposal['desc'] . '</p>';
    //reorder date to English standard (http://php.net/strtotime, http://php.net/manual/en/function.date.php)
    //uses HTML5 time tag (http://html5doctor.com/the-time-element/)
    echo '<time datetime="' . $proposal['date_added'] . '">' . date('d-m-Y', strtotime($proposal['date_added'])) . '</time>';
}
