<div class="header">
    <div class="row">
        <h1>Research Interests</h1>
        <h4 class="subheader">Want to discuss a project idea with a tutor that has similar interests to you? Need to contact a tutor about your project? Find their research interests and email address here.</h4>
    </div>
</div>


<div class="row">

    <div class="column">
        <table id="researchInterestsTable" class="display">
            <thead>
                <tr>
                    <th>Tutor</th>
                    <th>Email Address</th>
                    <th>Research Interests</th>
                </tr>
            </thead>
            <tbody>


            <?php

            foreach ($interests as $interest) {
                echo '<tr>';
                    echo '<td>' . $interest['first_name'] .' ' . $interest['last_name'] . '</td>';
                    echo '<td>' . $interest['email'] . '</td>';
                    echo '<td>' . $interest['research_interest'] . '</td>';
                echo '</tr>';
            }
            ?>

            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript" class="init">
    $(document).ready(function(){
        $('#researchInterestsTable').DataTable({
//            "bFilter": false
        });
    });
</script>