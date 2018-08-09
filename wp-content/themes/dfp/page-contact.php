<?php

    /*
    * Template Name: DFP Contact
    */

	get_header();
	$page_setup = get_fields();

?>

	<?php if($page_setup['show_banner'] == 0): ?>

	<section class="title-bar" style="background-color: <?php echo $page_setup['title_bar_background']; ?>">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1 class="large"><?php echo the_title(); ?></h1>
				</div>
			</div>
		</div>
	</section>

	<?php endif; ?>

	<section class="main">
		<div class="container">
				<div class="row">

					<div class="col-12 col-lg-8">


						<?php

							if( have_rows('maps') ):
							while ( have_rows('maps') ) : the_row();

							$location = get_sub_field('location');

						?>

							<?php if( !empty($location) ): ?>
								<div class="map-container">
									<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
								</div>
							<?php endif; ?>

							<div class="entry blog-entry contact-entry">
								<?php echo get_sub_field('contact_info'); ?>
							</div>

						<?php

							endwhile;
							endif;

						?>


						<?php 
							if ( have_posts() ) :
							while ( have_posts() ) : the_post();
						?>
							<div>
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


	<section class="reusable-block tint-6 contact-form" id="dfp-sf-form-modal">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-4">
					<i class="fas fa-comment"></i>
					<?php echo do_shortcode('[sidebar_content ids="14555"]'); ?>
				</div>
			</div>
		</div>
	</section>



<?php 

get_footer();