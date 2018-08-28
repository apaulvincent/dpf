<?php

global $DB_Helper, $DB_Content;

// echo '<pre>';
// var_dump($var);
// echo '</pre>';

?>


<?php if( $var['class'] == 'awards-credentials'): ?>

        <section class="reusable-block awards-block">
            <div class="container">
                <div class="row">
                    
                    <div class="col-12">    
                        <h1 class="block-title"> <?php echo $var['title'] ?></h1>
                    </div>
                    <?php  foreach ($var['images'] as $logo) { ?>

                    <div class="col-6 col-sm-4 col-md-2">
                        <img src="<?php echo $logo['url']; ?>" class="img-fluid">
                    </div>

                    <?php } ?>


                </div>
            </div>
        </section>

<?php elseif( $var['class'] == 'featured-in'): ?>

        <section class="reusable-block feat-block">
            <div class="container">
                <div class="row">
                    <div class="col-12">    
                        <h1 class="block-title"> <?php echo $var['title'] ?></h1>
                    </div>
                </div>

                <div class="row odd-grid">
                    <?php  foreach ($var['images'] as $logo) { ?>
                    <div class="col">
                        <img src="<?php echo $logo['url']; ?>" class="img-fluid">
                    </div>
                    <?php } ?>
                </div>

                <div class="row">
                    <div class="col-12">    
                        <h4><a href="<?php echo $var['link']; ?>" class="brand-b"><?php echo $var['link_text']; ?></a></h4>
                    </div>
                </div>
            </div>
        </section>

<?php

endif;


// echo '<pre>';
// var_dump($var);
// echo '</pre>';

?>


