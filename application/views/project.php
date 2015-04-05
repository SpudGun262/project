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

    <article>

        <header>
            <h2><?=$projectResult['title'];?></h2>

            <!-- TODO: Add link to tutor page to show tutors interests  -->
            <p>Added by <?=$projectResult['first_name'] . ' ' . $projectResult['last_name'];?> on
                <time datetime="<?=$projectResult['date_added'];?>">
                    <?=date('l jS F Y', strtotime($projectResult['date_added']));?>
                </time>
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
            //        echo $this->my_functions->nl2p($projectResult['abstract']);

                echo nl2p($projectResult['abstract']);

                ?>
            </p>

        </div>

    </article>
</div>

