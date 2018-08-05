<?php

global $DB_Helper, $DB_Content;

// echo '<pre>';
// var_dump($var);
// echo '</pre>';

?>




<section class="reusable-block feat-block">

    <div class="container">
        <div class="row">
            
            <div class="col-12">    
                <h1 class="block-title"> <?php echo $var['title'] ?></h1>
            </div>
            <?php  foreach ($var['logos'] as $logo) { ?>

            <div class="col-6 col-md-2">
                <img src="<?php echo $logo['url']; ?>" class="img-fluid">
            </div>

            <?php } ?>


            <div class="col-12">    
                <h4><a href="<?php echo $var['link']; ?>" class="brand-b"><?php echo $var['link_text']; ?></a></h4>
            </div>

        </div>
    </div>

</section>





<?php


// echo '<pre>';
// var_dump($var);
// echo '</pre>';

?>


