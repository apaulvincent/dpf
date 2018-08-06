<?php

global $DB_Helper, $DB_Content;

// echo '<pre>';
// var_dump($block);
// echo '</pre>';

?>



<section class="reusable-block eq-blocks page-grid-block">
    
    <div class="container">
        <div class="wide-gutter row">
            
            <div class="col-12">    
                <h1 class="block-title"> <?php echo $block['title'] ?></h1>
            </div>

            <?php  foreach ($block['page_grid'] as $grid) { 
                
                $banner_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $grid['page'] ) , 'listing-image');
                $placeholder = $DB_Helper->get_placeholder_image_url(600, 600);
                $banner_image = $banner_image_url ? $banner_image_url[0] : $placeholder;
                    
            ?>

            <div class="col-12 col-lg-4 eq-block-wrap">
                <a href="<?php echo get_permalink( $grid['page'] ); ?>" class="eq-block" style="background-image: url(<?php echo $banner_image; ?>);">
                    <?php echo $grid['excerpt']; ?>
                </a>
            </div>

            <?php } ?>

        </div>
    </div>

</section>

