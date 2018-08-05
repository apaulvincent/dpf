<?php

global $DB_Content;

$slides = $page_config['meta']['banner_slider']

?>

<?php if($slides): ?>

<div class="main-banner">

    <div class="banner-slider">
    
        <?php 
        
            foreach ($slides as $slide): 
            $banner_image_url = wp_get_attachment_image_src($slide['slide_image'], 'banner-image');

        ?>
        <div style="background-image: url(<?php echo $banner_image_url[0]; ?>);" >
            <div class="overlay"></div>
            <div class="slide-content">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <?php echo $slide['slide_content']; ?>
                            
                            <?php if($slide['button_url']): ?>
                            <?php echo $DB_Content->get_section_spacer('15', array('d-none', 'd-xl-block')); ?> 

                                <a href="<?php echo $slide['button_url']; ?>" class="btn btn-lg d-none d-lg-block">
                                    <span><?php echo $slide['button_text']; ?></span>
                                </a>

                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</div>


<?php

endif;

// echo '<pre>';
// var_dump($slides);
// echo '</pre>';
