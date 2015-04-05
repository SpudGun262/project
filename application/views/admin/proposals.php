<div class="row">
    <h1>This is the admin proposals page</h1>

    <?=$this->session->flashdata('error');?>

    <?=$this->session->flashdata('notice');?>

    <div class="adminProposalsTable">

        <!--When clicked run the addproposal method in the proposals controller-->
        <a href="<?=base_url('admin/proposals/addProposal')?>" class="secondary button">&plus; Add New</a>

        <table class="column">
            <thead>
            <tr>
                <th>Proposal Title</th>
                <th>Course</th>
                <th>Associated Tutor</th>
                <th>Data Added</th>
                <th><i class="fa fa-pencil fa-fw"></i>Edit Proposal</th>
                <th><i class="fa fa-trash-o fa-fw"></i>Delete Proposal</th>
            </tr>
            </thead>
            <tbody>
            <?php
            //for each of the proposals, echo them as a single proposal inside a HTML table
            foreach ($proposals as $proposal) {
                echo '<tr>';
                    //Echo the title of the proposal
                    echo '<td>' . $proposal['title'] . '</td>';
                    //echo the name of the course the proposal is associated with
                    echo '<td>' . $proposal['course_name'] . '</td>';

                    //echo the first and last name of the tutor who uploaded the proposal
                        echo '<td>' . $proposal['first_name'] . ' ' . $proposal['last_name'] . '</td>';
                    //reorder date to English standard (http://php.net/strtotime, http://php.net/manual/en/function.date.php)
                    ////uses HTML5 time tag (http://html5doctor.com/the-time-element/)
                    echo '<td><time datetime="' . $proposal['date_added'] . '">' . date('d-m-Y', strtotime($proposal['date_added'])) . '</time></td>';
                    //echo an edit button
                    echo '<td><a href="' . base_url('admin/proposals/editProposal') .'/' . $proposal['proposal_id'] . '" class="radius button small">Edit</a></td>';
                    echo '<td><a  class="alert radius button small" data-reveal-id="myModal' . $proposal['proposal_id']. '">Delete</a></td>';
                    echo '<div id="myModal'.$proposal['proposal_id'].'" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">';
                        echo '<h2>Caution</h2>';
                        echo '<p class="lead">You\'re about to delete:</p>';
                        echo '<p>' . $proposal['title'] . '</p>';
                        echo '<p class="lead">Are you sure?</p>';
                        echo '<a href="' . base_url('admin/tutors/deleteTutor') .'/' . $proposal['proposal_id'] . '" class="alert radius button small right">Confirm delete</a>';
                        echo '<a class="close secondary radius button small" aria-label="Close">Cancel</a>';
                        echo '<a class="close-reveal-modal" aria-label="Close">&#215;</a>';
                    echo '</div>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>

</div>

<script src="<?php echo asset_url().'js/deleteModal.js'; ?>"></script>