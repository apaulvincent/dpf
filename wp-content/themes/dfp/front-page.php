<?php

get_header(); 


$content = get_fields($post->ID);


if( $content['content_reusable_blocks'] ) {

	foreach ( $content['content_reusable_blocks'] as $key => $id) {

		$block = get_fields($id);

		if($block['reusable_block_setup'] == 'download-strip') {
			include(locate_template('partials/content/'. $block['reusable_block_setup'] .'.php'));
		}
		

	}

}


?>


	<section class="main">
		<div class="container">
				<div class="row">


					<div class="col-12">

						<?php if ( have_posts() ) :

							while ( have_posts() ) : the_post();

								the_content();

							endwhile;

						endif; ?>

					</div>
				</div>
		</div>
	</section>


<?php

get_footer();
