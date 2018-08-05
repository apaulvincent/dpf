<?php

global $DB_Helper, $DB_Content;

// echo '<pre>';
// var_dump($var);
// echo '</pre>';

?>




<section class="reusable-block awards-block">
    
    <div class="container">
        <div class="row">
            
            <div class="col-12">    
                <h1 class="block-title"> <?php echo $var['title'] ?></h1>
            </div>
            <?php  foreach ($var['logos'] as $logo) { ?>

            <div class="col-6 col-sm-4 col-md-2">
                <img src="<?php echo $logo['url']; ?>" class="img-fluid">
            </div>

            <?php } ?>


        </div>
    </div>

</section>





<?php


// echo '<pre>';
// var_dump($var);
// echo '</pre>';

?>


