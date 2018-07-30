<?php

get_header('search');

global $DB_Base;
global $DB_Helper;
global $DB_Content;


?>


<?php echo $DB_Content->get_section_spacer('160', array('d-none', 'd-xl-block')); ?> 

<div class="main">
<div class="container">
<div class="row">
<div class="col-12">


    <?php echo $DB_Content->get_section_spacer('30'); ?> 

    <?php if ( have_posts() ) : ?>

        <div class="search-page-title">
            <h1><?php printf( __( 'Search results for: %s', '' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
        </div>

        <?php while ( have_posts() ) : the_post(); ?>

            <article class="search-list">
                <h3><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>

                <?php 
                    $page_data = get_page($post->ID);
                   // $content = $DB_Helper->get_content_by_id($post->ID); 
                    (!empty($page_data->post_excerpt) ) ? $content = $page_data->post_excerpt : $content = $page_data->post_content;
                    $content = $DB_Helper->strip_tags_content($content); 
                    $content = $DB_Helper->excerpt($content, 50); 

                    echo  '<p>' . $content .'</p>';
                    
                ?>

                <a href="<?php echo get_the_permalink(); ?>" class="btn btn-primary">read more</a>
            </article>

            <?php echo $DB_Content->get_section_spacer('30'); ?>

        <?php endwhile; // end of the lsoop. ?>
    <?php else : ?>

        <div class="page-404">
            <div class="page-title">
                <h2>Nothing Found</h2>
            </div>
            <div class="entry-content">
                <p>Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>
            </div>
        </div>


    <?php endif; ?>

     <?php echo $DB_Content->get_section_spacer('30'); ?>

</div>
</div>
</div>
</div>

<?php

get_footer();