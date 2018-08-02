<?php

	get_header();


	if ( have_posts() ) :

		/* Start the Loop */
		while ( have_posts() ) : the_post();

			the_content(); 

		endwhile;

		the_posts_pagination();


	endif;


get_footer();