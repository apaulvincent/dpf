<?php

    /*
    * Template Name: DFP Testimonials
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
                            $count = 0;

							if ( $wp_query->have_posts()):
								while ( $wp_query->have_posts() ): $wp_query->the_post();
						  
						?>


                        <div class="row">
                            <div class="col-12 col-lg-12">

                                <?php 
									if ( has_post_thumbnail() ) {
										echo '<div class="featured-image">';
										the_post_thumbnail('feat-banner-image');
										echo '</div>';
									}
								?>

                                <?php if( $count % 3 == 0 ): ?>
                                <div class="entry blog-entry" style="border-top: 5px solid #9900cc;">
                                <?php elseif( $count % 2 == 0 ): ?>
                                <div class="entry blog-entry" style="border-top: 5px solid #003399;">
                                <?php else: ?>
                                <div class="entry blog-entry" style="border-top: 5px solid #029bff;">
                                <?php endif; ?>
									
                                    <div class="post-meta text-right">
										<!-- <p style="font-size: 14px;"><strong><?php the_date('d.m.Y'); ?></strong></p> -->
                                        <!-- <p style="font-size: 14px;">By <strong><?php the_author(); ?></strong></p> -->
                                    </div>
                                    
                                    <div style="font-style: italic;">
									<?php 
										
                                        the_content(); 
                                        
                                    ?>
                                    </div>

									<h2><?php the_title(); ?></h2>

                                </div>
                            </div>
                        </div>

                        <?php 
                            $count++;
                            endwhile; 
                        ?>

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