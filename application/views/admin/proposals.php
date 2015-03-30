<h1>This is the admin proposals page</h1>

<?=
//TODO: Style flash data
$this->session->flashdata('error', '<div class="error">', '</div>');?>

<?=$this->session->flashdata('notice', '<div class="notice">', '</div>');?>

<div class="adminProposalsTable column">

    <!--When clicked run the addproposal method in the proposals controller-->
    <a href="<?=base_url('admin/proposals/addProposal')?>" class="secondary button">&plus; Add New</a>

    <table >
        <thead>
        <tr>
            <th>Proposal Title</th>
            <th>Course</th>
            <th>Associated Tutor</th>
            <th>Data Added</th>
            <th>Edit proposal</th>
            <th>Delete proposal</th>
        </tr>
        </thead>
        <?php
        //for each of the proposals, echo them as a single proposal inside a HTML table
        foreach ($proposals as $proposal) {
            echo '<tr>';
            //Echo the title of the proposal
            echo '<td>' . $proposal['title'] . '</td>';
            //echo the name of the course the proposal is associated with
            echo '<td>' . $proposal['name'] . '</td>';

            //echo the first and last name of the tutor who uploaded the proposal
                echo '<td>' . $proposal['first_name'] . ' ' . $proposal['last_name'] . '</td>';
            //reorder date to English standard (http://php.net/strtotime, http://php.net/manual/en/function.date.php)
            ////uses HTML5 time tag (http://html5doctor.com/the-time-element/)
            echo '<td><time datetime="' . $proposal['date_added'] . '">' . date('d-m-Y', strtotime($proposal['date_added'])) . '</time></td>';
            //echo an edit button
            echo '<td><a href="' . base_url('admin/proposals/editProposal') .'/' . $proposal['proposal_id'] . '" class="radius button small">Edit</a></td>';
            echo '<td><a href="' . base_url('admin/proposals/deleteProposal') .'/' . $proposal['proposal_id'] . '" class="alert radius button small">Delete</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>

<script src="<?php echo asset_url().'js/deleteModal.js'; ?>"></script>