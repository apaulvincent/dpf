<?php

global $DB_Content;

$image = $page_setup['banner_image'];
$content = $page_setup['banner_content'];

?>

<?php if($image): ?>

<div class="main-banner">

        <?php 

            $banner_image_url = wp_get_attachment_image_src($image, 'banner-image');

        ?>

        <div class="banner-static" style="background-image: url(<?php echo $banner_image_url[0]; ?>);">
            <div class="banner-content">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <?php echo $content; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>


<?php

endif;

// echo '<pre>';
// var_dump($slides);
// echo '</pre>';
