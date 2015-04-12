<section id="mainContent">
    <div class="row">
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
        <div class="columns large-8">
            <article>

                <header class="column">
                    <h2><?= $proposalResult['title']; ?></h2>

                    <!-- TODO: Add link to tutor page to show tutors interests  -->
                    <p>Added by <strong><a href="<?=base_url('research');?>"><?= $proposalResult['first_name'] . ' ' . $proposalResult['last_name']; ?></a></strong> on
                        <strong><time datetime="<?= $proposalResult['date_added']; ?>">
                            <?= date('l jS F Y', strtotime($proposalResult['date_added'])); ?>
                        </time></strong>
                    </p>
                </header>

                <div class="column">

                    <p><?php

                        //nl2p is a function that adds <p> elements around newlines. It is custom made and sits in helpers->nl2p_helper
                        echo nl2p($proposalResult['desc']);

                        ?>
                    </p>

                </div>

            </article>
        </div>


        <div class="panel columns large-4">
            <h3>Are you interested in this project proposal <?= $this->session->userdata('user_auth')['first_name']; ?>
                ?</h3>

            <p>If you think this project could be for you <?= $this->session->userdata('user_auth')['first_name']; ?>,
                please click the button below and
                <strong><?= $proposalResult['first_name'] . ' ' . $proposalResult['last_name'] ?></strong> will be in
                touch with you.</p>

            <p>Alternatively you can email <?= $proposalResult['first_name'] . ' ' . $proposalResult['last_name'] ?> at
                <a href="mailto:<?= $proposalResult['email']; ?>"><?= $proposalResult['email']; ?></a></p>
            <a href="<?= base_url('proposals/doProposal') . '/' . $proposalResult['proposal_id']; ?>"
               class="button success radius">Attempt Project</a>
        </div>
    </div>
</section>