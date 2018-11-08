<?php

    /*
    * Template Name: DFP Listing
    */

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
							if(!empty( get_the_content() )):
						?>

                        <div class="row">
                            <div class="col-12 col-lg-3">
                                &nbsp;
                            </div>
                            <div class="col-12 col-lg-9">
                                <div class="entry blog-entry">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>

						<?php 
							endif; 
							endwhile;
							wp_reset_postdata();
							endif; 
						?>


						<?php 

							$cat = $content['post_category'] ? $content['post_category'] : '';
							$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : '1';

							$args = array(
								'post_type'      => 'post',
								'posts_per_page' => 8, 
								'paged'          => $paged,
								'cat' 			 => array($cat)
							);
							  
							$wp_query = new WP_Query( $args );

							if ( $wp_query->have_posts()):
								while ( $wp_query->have_posts() ): $wp_query->the_post();
						  
						?>


                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <div class="post-meta">
                                    <h3><?php the_date(); ?></h3>
                                    <p>By <?php the_author(); ?></p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-9">

                                <?php 
									if ( has_post_thumbnail() ) {
										echo '<div class="featured-image">';
										the_post_thumbnail('feat-banner-image');
										echo '</div>';
									}
								?>

                                <div class="entry blog-entry">
									<h2><?php the_title(); ?></h2>
									
									<?php 
										
										if ( has_category('testimonial') ) {
											the_content(); 
										} else {
											the_excerpt(); 
											echo '<a href="' . get_permalink() . '" class="btn btn-1">More</a>';
										}
									
									?>

                                </div>
                            </div>
                        </div>

						<?php endwhile; ?>

						<div class="paging-wrap bottom">
							<?php wp_pagination(); ?>
						</div>

						<?php  
							wp_reset_postdata();
							
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