<div class="header">
    <div class="row">

        <h1>Proposals</h1>
        <h4 class="subheader">Explore projects proposals posted by tutors. Get ideas for your project and apply to complete a project proposal here</h4>

    </div>
</div>

<div class="row">

    <?= $this->session->flashdata('notice'); ?>
    <?= $this->session->flashdata('error'); ?>

    <?php

    /**
     * [proposal_id]
     * [title]
     * [desc]
     * [date_added]
     * [tutor_id]
     * [course_id]
     * [course_name]
     * [first_name]
     * [last_name]
     * [email]
     */
    ?>

    <div class="column">

        <?php

        foreach ($proposals as $proposal) {
            echo '<div class="">';
                echo '<h3>' . $proposal['title'] . '</h3>';
                echo '<p><small>Added by <a href="'.base_url('research').'"> ' . $proposal['first_name'] . ' ' . $proposal['last_name'] . '</a> on ';
                    //reorder date to English standard (http://php.net/strtotime, http://php.net/manual/en/function.date.php)
                    //uses HTML5 time tag (http://html5doctor.com/the-time-element/)
                    echo '<time datetime="' . $proposal['date_added'] . '">' . date('l jS F Y', strtotime($proposal['date_added'])) . '</time>';
                echo '</small></p>';
                echo '<p>' . maxLengthLong($proposal['desc']) . '...';
                echo '<p><a href="' . base_url('proposals/viewProposal/') . '/' . $proposal['proposal_id'] . '" class="button radius right">View More</a></p>';
            echo '</div>';
            echo '<hr/>';

        }

        ?>
    </div>

</div>