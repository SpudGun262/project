<div class="row">
    <h1>Courses Admin Page</h1>

    <?=$this->session->flashdata('error');?>

    <?=$this->session->flashdata('notice', '<div class="notice">', '</div>');?>

    <!--When clicked run the addCourse method in the courses controller-->
    <a href="<?=base_url('admin/courses/addCourse')?>" class="secondary button">&plus; Add New</a>

    <table id="coursesTable" class="display column">
        <thead>
        <tr>
            <th>Course Name</th>
            <th><i class="fa fa-pencil fa-fw"></i>Edit Course</th>
            <th><i class="fa fa-trash-o fa-fw"></i>Delete Course</th>
        </tr>
        </thead>
        <?php
        //for each of the tutors, echo them as a single tutor inside a HTML table
        foreach ($courses as $course) {
              echo '<tr>
                        <td>' . $course['course_name'] . '</td>
                        <td><a href="' . base_url('admin/courses/editCourse') .'/' . $course['course_id'] . '" class="radius button small">Edit</a></td>
                        <td><a  class="alert radius button small" data-reveal-id="myModal' . $course['course_id'] . '">Delete</a></td>
                   </tr>';
        }
        foreach ($courses as $course) {
            echo '<div id="myModal' . $course['course_id'] . '" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
                    <h2>Caution</h2>
                    <p class="lead">You\'re about to delete:</p>
                    <p>' . $course['course_name'] . '.</p>
                    <p class="lead">Are you sure?</p>
                    <a href="' . base_url('admin/courses/deleteCourse') . '/' . $course['course_id'] . '" class="alert radius button small right">Confirm delete</a>
                    <a class="close secondary radius button small" aria-label="Close">Cancel</a>
                    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                </div>';
        }
        ?>
    </table>
</div>

<script src="<?php echo asset_url().'js/deleteModal.js'; ?>"></script>
<script type="text/javascript" class="init">
    $(document).ready(function(){
        $('#coursesTable').DataTable({
        });
    });
</script>