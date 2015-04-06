<div class="row">

    <h1>Proposal page</h1>

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
                echo '<h2>' . $proposal['title'] . '</h2>';
                echo '<p><small>Added by ' . $proposal['first_name'] . ' ' . $proposal['last_name'] . ' on ';
                    //reorder date to English standard (http://php.net/strtotime, http://php.net/manual/en/function.date.php)
                    //uses HTML5 time tag (http://html5doctor.com/the-time-element/)
                    echo '<time datetime="' . $proposal['date_added'] . '">' . date('l jS F Y', strtotime($proposal['date_added'])) . '</time>';
                echo '</small></p>';
                echo '<p>' . maxLength($proposal['desc']) . '...';
                echo '<p><a href="' . base_url('proposals/viewProposal/') . '/' . $proposal['proposal_id'] . '" class="button radius">View More</a></p>';
            echo '</div>';
            echo '<hr/>';

        }

        ?>
    </div>

</div>