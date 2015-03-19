<h1>This is the admin projects page</h1>

<button><a href="<?=base_url('admin/addProject')?>">&plus; Add New</a></button>


<?php
foreach ($projects as $project) {
    echo '<h2>' . $project['title'] . '</h2>';
    echo '<p>' . $project['abstract'] . '</p>';
    //reorder date to English standard (http://php.net/strtotime, http://php.net/manual/en/function.date.php)
    ////uses HTML5 time tag (http://html5doctor.com/the-time-element/)
    echo '<time datetime="' . $project['date_added'] . '">' . date('d-m-Y', strtotime($project['date_added'])) . '</time>';
}
?>