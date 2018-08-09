<?php

get_header();


if ( in_category('project-advisory') ) { 

    $page = get_page_by_path('project-advisory');

} elseif ( in_category('landmark-projects') ) { 

    $page = get_page_by_path('project-funding');

} elseif ( in_category('key-workout-projects') ) { 

    $page = get_page_by_path('project-workouts');

} else {

    $page = get_page_by_path('blog');
}


$content = get_fields($page->ID);

?>

<section class="title-bar" style="background-color: <?php echo $content['title_bar_background']; ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="large"><?php echo get_the_title($page->ID); ?></h1>
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
                                    <?php the_content(); ?>
								</div>
								
								<?php 
									$args = array(
											'title_reply'=>'Leave a comment',
											'label_submit'=>'Post'
										);

									comment_form($args); 
								?>

                            </div>
                        </div>

						<?php  endwhile; ?>
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