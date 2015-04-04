<?php echo '<pre>';
    print_r($projectResult);
echo '</pre>'; ?>

<!--TODO: Finish this page. Add the rest of the detail and style. Add option to favourite-->
<h1><?=$projectResult['title'];?>
    <small>
        <time datetime="<?=$projectResult['date_added'];?>">
            <span>Date Added: </span>
            <?=date('d/m/Y', strtotime($projectResult['date_added']));?>
        </time>
    </small>
</h1>





<h3>Abstract:</h3>
<p><?php

        //nl2p is a function that adds <p> elements around newlines. It is custom made and sits in libraries->functions
//        echo $this->my_functions->nl2p($projectResult['abstract']);

    echo nl2p($projectResult['abstract']);

    ?>
</p>



