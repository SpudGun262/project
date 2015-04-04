

<?php

print_r($expires);

?>


<div class="row">

    <h1>This is the dashboard</h1>

    <?=$this->session->flashdata('error');?>

    <?=$this->session->flashdata('notice', '<div class="notice">', '</div>');?>


    <h3>Projects Due To Expire</h3>
    <table>
        <thead>
        <tr>
            <th>Project Name</th>
            <th>Date Added</th>
            <th><i class="fa fa-file-text-o fa-fw"></i>View Project</th>
            <th><i class="fa fa-clock-o fa-fw"></i>Extend Project</th>
            <th><i class="fa fa-trash-o fa-fw"></i>Delete Project</th>
        </tr>
        </thead>
        <?php
        if(!empty($expires)) {

            foreach ($expires as $expire) {
                echo '<tr>';

                    echo '<td>' . $expire['title'] . '</td>';

                    echo '<td>' . date('l jS F Y', strtotime($expire['date_added'])) . '</td>';

                    echo '<td><a href="' . base_url('projects/viewProject') . '/' . $expire['project_id'] . '"  target="_blank" class="radius button info small">View</a></td>';
                        //TODO: implement project extend functionality
                    echo '<td><a data-reveal-id="myModal' . str_replace(' ', '', $expire['title']) . '" class="radius button success small">Extend</a></td>';
                    //echo an delete button
                    echo '<td><a  class="alert radius button small" data-reveal-id="myModal' . $expire['project_id'] . '">Delete</a></td>';
                    echo '<div id="myModal' . $expire['project_id'] . '" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">';
                        echo '<h2>Caution</h2>';
                        echo '<p class="lead">You\'re about to delete:</p>';
                        echo '<p>' . $expire['title'] . '</p>';
                        echo '<p class="lead">This action cannot be undone. Are you sure?</p>';
                        echo '<a href="' . base_url('admin/projects/deleteExpiredProject') . '/' . $expire['project_id'] . '" class="alert radius button small">Confirm delete</a>';
                        echo '<a class="close secondary radius button small right" aria-label="Close">Cancel</a>';
                        echo '<a class="close-reveal-modal" aria-label="Close">&#215;</a>';
                    echo '</div>';
                    echo '<div id="myModal' . str_replace(' ', '', $expire['title']) . '" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">';
                        echo '<h2>Caution</h2>';
                        echo '<p class="lead">You\'re about to extend:</p>';
                        echo '<p>' . $expire['title'] . '</p>';
                        echo '<p class="lead">This will add 12 months onto the expiry of that project. Are you sure?</p>';
                        echo '<a href="' . base_url('admin/projects/extendProject') . '/' . $expire['project_id'] . '" class="radius button small">Confirm Extend</a>';
                        echo '<a class="close secondary radius button small right" aria-label="Close">Cancel</a>';
                        echo '<a class="close-reveal-modal" aria-label="Close">&#215;</a>';
                    echo '</div>';
                echo '</tr>';
            }
        } else {
            //TODO: Sort this so the table doesn't show if no entries
            echo '<p data-alert class="alert-box success radius">Woohoo! Nothing is due to expire</p>';
        }
        ?>
    </table>
</div>


<script src="<?php echo asset_url().'js/deleteModal.js'; ?>"></script>