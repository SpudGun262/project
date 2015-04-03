<?php print_r($projectResult); ?>

<!--TODO: Finish this page. Add the rest of the detail and style-->
<h1><?=$projectResult['title'];?>
    <small>
        <time datetime="<?=$projectResult['date_added'];?>">
            <span>Date Added: </span>
            <?=date('d/m/Y', strtotime($projectResult['date_added']));?>
        </time>
    </small>
</h1>





<h3>Abstract:</h3>
<p><?=$projectResult['abstract'];?></p>



