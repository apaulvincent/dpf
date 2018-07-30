<?php
/*
 * Archive Template
 */

get_header('search');

?>

	<section class="primary ui-card">
		<div class="container">
			<div class="row">

		<?php if ( have_posts() ) : ?>
				<div class="col-sm-12 col-md-12">
					<div class="row">

						<div class="col-sm-12 col-md-12">
							<div class="page-title">
                                <h1><?php single_term_title(); ?></h1>
                                <?php the_archive_description(); ?>
							</div>
						</div>

						<div class="col-sm-12 col-md-12">
							<div class="paging-wrap">
								<?php wp_pagination(); ?>
							</div>
						</div>

                        <?php  while( have_posts() ): the_post(); ?>

                                <article class="list-item">
                                    <div class="col-xs-12 col-sm-3">
                                        
                                        <?php if (has_post_thumbnail() ): ?>
                                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' ); ?>
                                            <a href="<?php echo get_the_permalink(); ?>" class="img-wrap">
                                                <img src="<?php echo $image[0]; ?>" alt="">
                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo get_the_permalink(); ?>" class="img-wrap">
                                                <?php
                                                    $fallback = get_field('field_fallback_image', 'option');
                                                    echo '<img src="'.$fallback['sizes']['thumbnail'].'">';
                                                ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-xs-12 col-sm-9">
                                        <div class="entry-content">
                                            <h3><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <small class="date"><?php echo get_the_date(); ?></small>
                                            <a href="<?php echo get_the_permalink(); ?>" class="btn wire">read more</a>
                                        </div>
                                    </div>
                                </article>

                        <?php endwhile; ?>

                    <div class="col-sm-12 col-md-12">
						<div class="paging-wrap bottom">
							<?php wp_pagination(); ?>
						</div>
					</div>

					</div>
				</div>
			<?php endif; ?>




			</div>
		</div><!-- end entry -->
	</section><!-- end primary -->





<?php get_footer(); ?>