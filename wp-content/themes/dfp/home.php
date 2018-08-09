<?php

get_header();

$posts_page = get_option( 'page_for_posts' );
$content = get_fields($posts_page);

?>

    <section class="title-bar" style="background-color: <?php echo $content['title_bar_background']; ?>">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="large"><?php echo get_the_title($posts_page); ?></h1>
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
                                    <?php the_excerpt(); ?>
                                    <a href="<?php echo get_permalink(); ?>" class="btn btn-1">More</a>
                                </div>

                            </div>
                        </div>

						<?php  endwhile; ?>
                        
                        <div class="paging-wrap bottom">
                            <?php wp_pagination(); ?>
                        </div>

                        <?php endif; ?>

					</div>
					
					<div class="col-12 col-lg-3 offset-lg-1">
						<?php echo $DB_Content->get_section_spacer('30', ['d-lg-none']); ?>
                        <?php get_sidebar(); ?>
                        
                        <?php if( is_dynamic_sidebar( 'sidebar-widget' ) ): ?>
                        <?php dynamic_sidebar( 'sidebar-widget' ); ?>
                        <?php endif; ?>
                        
					</div>

				</div>
		</div>
	</section>

<?php

get_footer();