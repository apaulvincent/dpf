<?php

$banner_image_url = wp_get_attachment_image_src($page_config['meta']['banner_image'], 'full');

?>


<div class="main-banner feature">

    <div class="overlay"></div>

    <div class="banner-image-holder" style="background-image: url(<?php echo $banner_image_url[0]; ?>);"></div>

    <div class="banner-content">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <?php echo $page_config['meta']['banner_content']; ?>
                </div>

                    <?php  if( $page_config['meta']['show_banner_content_2'] == 1 ): ?>
                    <div class="col-12 col-lg-6 d-none d-lg-block">
                        <div class="fancy-list-wrap">
                            <?php echo $page_config['meta']['banner_content_2']; ?>
                        </div>    
                    </div>
                    <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="scroll-to">
        <i class="icon icon-chevron-down-lg"></i>
    </div>

</div>