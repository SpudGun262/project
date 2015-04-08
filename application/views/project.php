<!--TODO: Finish this page. Add the rest of the detail and style. Add option to favourite-->
<?php
/**
 *
 * [project_id]
 * [title]
 * [abstract]
 * [date_added]
 * [tutor_id]
 * [course_id]
 * [course_name]
 * [file_name]
 * [location]
 * [first_name]
 * [last_name]
 * [email]
 *
 */
?>
<div class="row">

    <?=$this->session->flashdata('notice');?>
    <?=$this->session->flashdata('error');?>

    <?php
    $CI =& get_instance();
    if($CI->session->userdata('user_auth')) {
        echo '<div class="columns large-8">';
    } else {
        echo '<div class="column">';
    }
    ?>

        <article>

            <header>
                <h2><?=$projectResult['title'];?></h2>

                <!-- TODO: Add link to tutor page to show tutors interests  -->
                <p>Added by <strong><?=$projectResult['first_name'] . ' ' . $projectResult['last_name'];?></strong> on
                    <strong><time datetime="<?=$projectResult['date_added'];?>">
                        <?=date('l jS F Y', strtotime($projectResult['date_added']));?>
                    </time></strong>
                </p>
            </header>

            <?php
                //If the project has a file associated with it then echo a link to it
                if(isset($projectResult['location']))
                {?>

                    <div class="panel" >
                        <p> File associated with this project: <a href="<?=$projectResult['location'];?>" target="_blank" ><?=$projectResult['file_name'];?></a ></p >
                    </div>

                <?php
                }
            ?>
            <div>

                <p><?php

                    //nl2p is a function that adds <p> elements around newlines. It is custom made and sits in libraries->functions
                    echo nl2p($projectResult['abstract']);

                    ?>
                </p>

            </div>

        </article>
    </div>

    <?php

    if($CI->session->userdata('user_auth')) {
        echo '
            <div class="panel columns large-4">
                <h3>Would you like to favourite this project?</h3>
                <p>' . $this->session->userdata('user_auth')['first_name'] . ', any projects that you favourite can be found in your <a href="' . base_url('user/profile') . '" id="profile">profile page.</a></p>
                <a href="' . base_url('projects/favourite') .'/' . $projectResult['project_id'] . '" id="favourite" class="button success radius">Add To Favourites</a>
            </div >
            ';
    }
    ?>


</div>