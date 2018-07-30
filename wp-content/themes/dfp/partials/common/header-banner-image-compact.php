<?php

global $DB_Helper, $DB_Content;

?>


<div class="main-banner compact">


    <?php if( $page_config['meta']['show_breadcrumb'] == '1'): ?>
    <div class="breadcrumb-bar">
        <div class="container">
        <div class="row">
        <div class="col-12">
            <h3><?php the_title(); ?></h3>
            <?php $DB_Content->get_page_breadcrumb(); ?>
        </div>
        </div>
        </div>
    </div>
    <?php endif; ?>


    <div class="banner-image-holder" style="background-image: url(<?php echo $page_config['meta']['banner_image']['sizes']['banner_lg']; ?>);"></div>

    <div class="banner-content">

        <div class="container">
        <div class="row">
        <div class="col-12">
            <h1 class="fancy-heading"><?php  echo  $DB_Helper->format_heading($page_config['meta']['banner_title']) ?></h1>
            <?php echo $page_config['meta']['banner_text']; ?>
        </div>
        </div>
        </div>

    </div>

</div>


<?php

// echo '<pre>';
// var_dump($page_config['meta']);
// echo '</pre>';

