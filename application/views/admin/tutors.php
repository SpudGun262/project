

<div class="adminTutorsTable row">
    <h1>This is the admin tutors page</h1>
    <?=$this->session->flashdata('error');?>

    <?=$this->session->flashdata('notice', '<div class="notice">', '</div>');?>

    <!--When clicked run the addtutor method in the tutors controller-->
    <a href="<?=base_url('admin/tutors/addTutor')?>" class="secondary button">&plus; Add New</a>

    <table >
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email Address</th>
            <th><i class="fa fa-pencil fa-fw"></i>Edit tutor</th>
            <th><i class="fa fa-trash-o fa-fw"></i>Delete tutor</th>
        </tr>
        </thead>
        <?php
        //for each of the tutors, echo them as a single tutor inside a HTML table
        foreach ($tutors as $tutor) {
            echo '<tr>';
            //Echo the first name of the tutor
            echo '<td>' . $tutor['first_name'] . '</td>';
            //echo the last name of the tutor
            echo '<td>' . $tutor['last_name'] . '</td>';
            //echo the email address of the tutor
            echo '<td>' . $tutor['email'] . '</td>';
            //echo an edit button
            echo '<td><a href="' . base_url('admin/tutors/editTutor') .'/' . $tutor['tutor_id'] . '" class="radius button small">Edit</a></td>';
            //echo an delete button
            echo '<td><a  class="alert radius button small" data-reveal-id="myModal' . $tutor['tutor_id']. '">Delete</a></td>';
            echo '<div id="myModal'.$tutor['tutor_id'].'" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">';
                echo '<h2>Caution</h2>';
                echo '<p class="lead">You\'re about to delete:</p>';
                echo '<p>' . $tutor['first_name'] . ' ' . $tutor['last_name'] . '.</p>';
                echo '<p class="lead">Are you sure?</p>';
                echo '<a href="' . base_url('admin/tutors/deleteTutor') .'/' . $tutor['tutor_id'] . '" class="alert radius button small">Confirm delete</a>';
                echo '<a class="close secondary radius button small right" aria-label="Close">Cancel</a>';
                echo '<a class="close-reveal-modal" aria-label="Close">&#215;</a>';
            echo '</div>';
            echo '</tr>';
        }
        ?>
    </table>
</div>

<script src="<?php echo asset_url().'js/deleteModal.js'; ?>"></script>