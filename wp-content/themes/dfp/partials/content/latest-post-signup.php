<?php

global $DB_Helper, $DB_Content;

$latest_post = $DB_Content->get_latest_article();

// echo '<pre>';
// var_dump($latest_post);
// echo '</pre>';

$banner_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $latest_post->ID ) , 'listing-image');
$placeholder = $DB_Helper->get_placeholder_image_url(600, 600);
$banner_image = $banner_image_url ? $banner_image_url[0] : $placeholder;


?>


<section class="reusable-block eq-blocks latest-post-signup-block">

    <div class="container">
        <div class="wide-gutter row">
            <div class="col-12 col-lg-6 eq-block-wrap">
                <a href="<?php echo get_permalink( $latest_post->ID ); ?>" class="eq-block tint-2 latest-post-block" style="background-image: url(<?php echo $banner_image; ?>);">
                    <h4><strong>The Latest</strong> / <?php echo $latest_post->post_title; ?></h4>
                </a>
            </div>
            <div class="col-12 col-lg-6 eq-block-wrap">

                <div class="eq-block tint-1">
                    <div class="singup-form">
                        <?php echo do_shortcode('[mc4wp_form id="1374"]'); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>