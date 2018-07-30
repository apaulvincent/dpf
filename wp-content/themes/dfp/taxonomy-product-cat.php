<?php
/*
 * Archive Template
 */

get_header('search');

global $DB_Content, $DB_Helper;

$page = get_page_by_path( 'products' );

$banner_image_id = get_field('banner_image', $page->ID);
$banner_content = get_field('banner_content', $page->ID);

$banner_image = wp_get_attachment_image_src($banner_image_id,'full');

?>


<div class="main-banner feature">
    <div class="overlay"></div>
    <div class="banner-image-holder" style="background-image: url(<?php echo $banner_image[0]; ?>);"></div>
    <div class="banner-content">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <?php echo $banner_content; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="scroll-to">
        <i class="icon icon-chevron-down-lg"></i>
    </div>
</div>

<div class="breadcrumb-bar">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-5">
                <h2><?php echo get_the_title( $page ); ?></h2>
            </div>
            <div class="col-12 col-lg-4 d-none d-lg-block">
                <div class="float-right">
                    <?php $DB_Content->get_page_breadcrumb(); ?>
                </div>
            </div>
            <div class="col-12 col-lg-3 d-none d-lg-block">
                <?php echo do_shortcode('[ssba-buttons]'); ?>
            </div>
        </div>
    </div>
</div>


<div id="main" class="main">
    <div class="container">
        <div class="row">



        <?php if ( have_posts() ) : ?>
        
				<div class="col-xs-12 col-md-12 col-lg-9">

                            <p><?php echo $page->post_content; ?></p>
                            <div class="spacer " style="margin-bottom: 20px;"></div>

                          <?php 
                                $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
                            ?>
                            <div class="category-listing">
                                <div class="row no-gutters">
                                     <?php  echo  $DB_Content->pass_file_to_var('partials/content/category-listing.php', array(
                                        'select_post_type' => 'product-cat',
                                        'display_format' => 'link-grid', 
                                        'list_title' => '',
                                        'current_term' => $current_term),
                                    );  ?>
                                </div>
                            </div>

                            <div class="page-title">
                            <h3><?php single_term_title(); ?></h3>
                            <?php the_archive_description(); ?>
                            </div>

                            <div class="paging-wrap">
                                <?php wp_pagination(); ?>
                            </div>
                            
                            <div class="section-listing">
                            <div class="row">

                        <?php  while( have_posts() ): the_post();

                            // $banner_image_portrait_md = get_the_post_thumbnail_url($post->ID,'landscape_md');

                            $banner_image_id = get_field('banner_image', $post->ID);
                            $banner_image_portrait_md = wp_get_attachment_image_src($banner_image_id,'landscape_md');
                            
                            $content = get_the_excerpt();
                            $content = strip_tags_content($content);

                            $markup .=  '<div class="col-lg-4">';
                            $markup .=  '<div class="card">';
                                $markup .=  '<a href="'.get_permalink().'" class="card-image" style="background-image: url('.$banner_image_portrait_md[0].')">';
                                $markup .=  '</a>';
                                $markup .=  '<div class="card-body">';
                                $markup .=  '<h4>'.get_the_title().'</h4>';
                                
                                $markup .=  '<span class="date">'. date_format(date_create($post->post_date), 'm.d.j').'</span>';

                                $markup .=  '<p>'.excerpt($content, 20).'</p>';
                                $markup .=  '<a href="'.get_permalink().'" class="btn btn-4 btn-box-icon icon-arrow">Read more</a>';
                                $markup .=  '</div>';
                            $markup .=  '</div>';
                            $markup .=  '</div>';

                         endwhile; 
                         echo $markup ;

                        ?>
                        </div>
                        </div>


                        <div class="paging-wrap bottom">
                            <?php wp_pagination(); ?>
                        </div>
               

				</div>
            <?php endif; ?>

                <div class="col-xs-12 col-md-12 col-lg-3">
                    <div class="sidebar">

                        <div class="sidebar-block reusable-content">
                            <div class="collapsible-block">
                                <h6 class="component-name">
                                    <span class="d-none d-lg-block">Company Contacts</span>
                                    <button class="collapsible-toggle d-lg-none">Company Contacts 
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </h6>
                                <div class="component-inner">
                                    <h4>Contacts</h4>
                                    <?php echo do_shortcode('[select_company_contacts]'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-block reusable-content">
                            <?php 
                                $col = array();
                                $col['title'] = 'FEATURED DOWNLOADS';
                                $col['collapsible'] = 1;
                                $col['select_post_type'] = 'download';
                                echo $DB_Content->pass_file_to_var('partials/content/post-scroller.php', $col); 
                            ?>
                        </div>
                    </div>
                </div>


        </div>
    </div>
</div>



<?php get_footer(); ?>