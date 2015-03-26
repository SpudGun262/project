<h1>This is the admin tutors page</h1>

<?=
//TODO: Style flash data
$this->session->flashdata('error', '<div class="error">', '</div>');?>

<?=$this->session->flashdata('notice', '<div class="notice">', '</div>');?>

<div class="adminTutorsTable column">

    <!--When clicked run the addtutor method in the tutors controller-->
    <a href="<?=base_url('admin/tutors/addTutor')?>" class="secondary button">&plus; Add New</a>

    <table >
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email Address</th>
            <th>Edit tutor</th>
            <th>Delete tutor</th>
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
            echo '<td><a href="' . base_url('admin/tutors/deleteTutor') .'/' . $tutor['tutor_id'] . '" class="alert radius button small">Delete</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>