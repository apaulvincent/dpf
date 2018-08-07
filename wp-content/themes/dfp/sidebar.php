<?php

	global $DB_Content;

	$content = get_fields($post->ID);


	// For expert advice
	// Featured articles
	echo do_shortcode('[sidebar_content]');


	// Other reusable blocks
	if( $content['sidebar_reusable_block'] ) {

		foreach ( $content['sidebar_reusable_block'] as $key => $value) {

			$block = get_fields($value);

			echo $DB_Content->pass_file_to_var('partials/content/'. $block['reusable_block_setup'] .'.php', $block);

		}
	}

?>