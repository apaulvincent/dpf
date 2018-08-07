<?php

	get_header();
	$content = get_fields($post->ID);

?>

	<section class="title-bar" style="background-color: <?php echo $content['title_bar_background']; ?>">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1 class="large"><?php echo the_title(); ?></h1>
				</div>
			</div>
		</div>
	</section>

	<section class="main">
		<div class="container">
				<div class="row">

					<div class="col-12 col-lg-8">

						<?php 
							if ( have_posts() ) :
							while ( have_posts() ) : the_post();
						?>


						<?php 

						if ( has_post_thumbnail() ) {
							echo '<div class="featured-image">';
							the_post_thumbnail('feat-banner-image');
							echo '</div>';
						}

						?>

							<div class="entry">
								<?php the_content(); ?>

								<?php if( get_field('content_link') ): ?>
									<div class="content-link">
										<?php echo get_field('content_link'); ?>
									</div>
								<?php endif; ?>

							</div>

						<?php 
							endwhile;
							endif; 
						?>

					</div>
					
					<div class="col-12 col-lg-3 offset-lg-1">
						<?php echo $DB_Content->get_section_spacer('30', ['d-lg-none']); ?>
						<?php get_sidebar(); ?>
					</div>

				</div>
		</div>
	</section>



<?php 

get_footer();