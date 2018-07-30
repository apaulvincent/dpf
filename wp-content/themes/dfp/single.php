<?php

get_header();

	if ( have_posts() ) :

		/* Start the Loop */
		while ( have_posts() ) : the_post();

			$DB_Content->get_page_content();
			// echo '<h1>' . get_the_title() . '</h1>';

		endwhile;

		the_posts_pagination();

	else :
		include(locate_template('partials/error-no-content.php'));
	endif;

get_footer();