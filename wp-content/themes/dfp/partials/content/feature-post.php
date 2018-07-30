<?php

global $DB_Helper, $DB_Content;

/*
$column
	- feature_content: post object
	- feature_content_category: taxonomy
	- image
	- image_placement
	- image_space_allocated: 25, 50, 75

	if feature_content is not empty use this; if feature_content is empty, find the most recent one from feature_content_category
*/

// echo '<pre>';
// var_dump($var);
// echo '</pre>';

$banner_image_id = get_post_thumbnail_id($feature_content->ID);
$banner_image =  $DB_Helper->generate_image($banner_image_id, 'landscape_md');
$banner_image_portrait_md = get_the_post_thumbnail_url($feature_content->ID,'portrait_md');
$banner_image_landscape_md = get_the_post_thumbnail_url($feature_content->ID,'landscape_md');

$block_content = $DB_Helper->strip_tags_content( $feature_content->post_excerpt );


// $additional_classes;
// $style_type;

?>


<div class="card featured-post-card <?php echo $style_type .' '. $additional_classes; ?>">
		<div class="card-body">

			<?php if($banner_image_landscape_md): ?>
			<a href="<?php echo get_permalink( $feature_content->ID ); ?>" class="img-wrap">
				<img src="<?php echo $banner_image_landscape_md; ?>">
			</a>

			<?php echo $DB_Content->get_section_spacer('10'); ?> 
			<?php endif; ?>


			<h4 class="title">
				<?php echo $feature_content->post_title; ?>
			</h4>
			<p><?php echo $DB_Helper->excerpt( $block_content, 20); ?></p>
			<a href="<?php echo get_permalink( $feature_content->ID ); ?>" class="btn btn-4 btn-box-icon icon-arrow">
				<?php echo $button_title; ?>
			</a>
		</div>
</div>
