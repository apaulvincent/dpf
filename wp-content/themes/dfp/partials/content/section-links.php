<?php

global $DB_Helper, $DB_Content;

/*
$column
	- title
	- content
	- button_title
	- button_url
	- image
	- image_placement
	- image_space_allocated: 25, 50, 75
	- site_section_parent_page


	display select list of links to all site_section_parent_page child pages
*/

// echo '<pre>';
// var_dump($var);
// echo '</pre>';

?>



<div class="card">
		<?php if( !empty($image) ): ?>
			<a href="<?php echo $button_url; ?>" class="card-image" style="background-image: url(<?php echo $image["sizes"]['landscape_sm']?>);"></a>
		<?php endif; ?>

		<div class="card-body">
			<h3><?php echo $title; ?></h3>
			<?php echo $content; ?>
		</div>

		<?php if( $button_url && $button_title): ?>
		<div class="card-footer">
			<a href="<?php echo $button_url; ?>" class="btn btn-2 float-lg-right"><?php echo $button_title; ?></a>
		</div>
		<?php endif; ?>
</div>

