<h1>This is the admin projects page</h1>

<a href="<?=base_url('admin/addProject')?>">&plus; Add New</a>

<div class="adminProjectsTable">
    <?php
    foreach ($projects as $project) {
        echo '<p>' . $project['title'] . '</p>';
        echo '<p>' . $project['name'] . '</p>';
        //reorder date to English standard (http://php.net/strtotime, http://php.net/manual/en/function.date.php)
        ////uses HTML5 time tag (http://html5doctor.com/the-time-element/)
        echo '<time datetime="' . $project['date_added'] . '">' . date('d-m-Y', strtotime($project['date_added'])) . '</time>';
        echo '<a href="' . base_url('admin/editProject') . '">Edit</a>';
    }
    ?>
</div>