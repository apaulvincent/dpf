<?php

global $DB_Helper, $DB_Content;

$slides = get_field('slider', $post->ID);

// var_dump($slides);

?>

<?php if($slides): ?>

<div class="main-banner">

    <div class="banner-slider">
    
        <?php 
        
            foreach ($slides as $slide): 
            $banner_image_url = wp_get_attachment_image_src($slide['slide_image'], 'full');

        ?>
        <div style="background-image: url(<?php echo $banner_image_url[0]; ?>);" >
            <div class="overlay"></div>
            <div class="slide-content">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <?php echo $slide['slide_content']; ?>
                            
                            <?php if($slide['button_url']): ?>
                            <?php echo $DB_Content->get_section_spacer('15', array('d-none', 'd-xl-block')); ?> 
                                <a href="<?php echo $slide['button_url']; ?>" class="btn btn-box-icon icon-arrow btn-lg"><?php echo $slide['button_text']; ?></a>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    

    <div class="scroll-to">
        <i class="pe-7s-angle-down"></i>
    </div>

</div>


<?php

endif;

// echo '<pre>';
// var_dump($slides);
// echo '</pre>';
