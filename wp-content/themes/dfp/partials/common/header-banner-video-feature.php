<?php

global $DB_Helper;

$page_config['meta'] = get_fields($post->ID);

?>


<div class="main-banner">
    <div class="banner-image-holder" style="background-image: url(<?php echo $page_config['meta']['banner_image']['sizes']['banner_lg']; ?>);"></div>

    <div class="banner-content">

        <h1 class="fancy-heading"><?php  echo  $DB_Helper->format_heading($page_config['meta']['banner_title']) ?></h1>
        <?php echo $page_config['meta']['banner_text']; ?>

    </div>


    <div class="scroll-to">
        <span>Explore Linfox</span>
        <i class="icon icon-chevron-down-lg"></i>
    </div>

</div>


<?php

// echo '<pre>';
// var_dump($page_config['meta']);
// echo '</pre>';

