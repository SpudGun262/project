<h1>This is the dashboard</h1>
<div>

    <?= $this->session->flashdata('error'); ?>

    <?= $this->session->flashdata('notice'); ?>

    <div class="row">
        <h3>Projects Due To Expire</h3>
        <?php
        if (!empty($expires)) {
            echo '<table class="column">
                    <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Date Added</th>
                        <th><i class="fa fa-file-text-o fa-fw"></i>View Project</th>
                        <th><i class="fa fa-clock-o fa-fw"></i>Extend Project</th>
                        <th><i class="fa fa-trash-o fa-fw"></i>Delete Project</th>
                    </tr>
                    </thead>
                    <tbody>';

            foreach ($expires as $expire) {
                    echo '<tr>
                            <td>' . $expire['title'] . '</td>
                            <td>' . date('l jS F Y', strtotime($expire['date_added'])) . '</td>
                            <td><a href="' . base_url('projects/viewProject') . '/' . $expire['project_id'] . '"  target="_blank" class="radius button info small">View</a></td>
                            <td><a data-reveal-id="myModal' . str_replace(' ', '', $expire['title']) . '" class="radius button success small">Extend</a></td>
                            <td><a  class="alert radius button small" data-reveal-id="myModal' . $expire['project_id'] . '">Delete</a></td>
                            <div id="myModal' . $expire['project_id'] . '" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
                                <h2>Caution</h2>
                                <p class="lead">You\'re about to delete:</p>
                                <p>' . $expire['title'] . '</p>
                                <p class="lead">This action cannot be undone. Are you sure?</p>
                                <a href="' . base_url('admin/projects/deleteExpiredProject') . '/' . $expire['project_id'] . '" class="alert radius button small right">Confirm delete</a>
                                <a class="close secondary radius button small" aria-label="Close">Cancel</a>
                                <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                            </div>
                            <div id="myModal' . str_replace(' ', '', $expire['title']) . '" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
                                <h2>Caution</h2>
                                <p class="lead">You\'re about to extend:</p>
                                <p>' . $expire['title'] . '</p>
                                <p class="lead">This will add 12 months onto the expiry of that project. Are you sure?</p>
                                <a href="' . base_url('admin/projects/extendProject') . '/' . $expire['project_id'] . '" class="radius button small right">Confirm Extend</a>
                                <a class="close secondary radius button small" aria-label="Close">Cancel</a>
                                <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                            </div>
                        </tr>
                    </tbody>
                </table>';
            }
        }

        else

        {

            echo '<p data-alert class="alert-box success radius">Woohoo! Nothing is due to expire</p>';

        }
        ?>
    </div>
</div>


<script src="<?php echo asset_url() . 'js/deleteModal.js'; ?>"></script>