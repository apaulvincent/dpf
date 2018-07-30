<?php

global $DB_Helper, $DB_Content;

/*echo '<pre>';
 var_dump($var);
echo '</pre>';*/
if(!isset($content_scroller_limit)) $content_scroller_limit = 6;
if( !isset($order_by) ) $order_by = 'post_date';
if( !isset($order) ) $order = 'ASC';
$args = array(
	'posts_per_page' => $content_scroller_limit, 
	'offset'          => 0,
	'orderby'         => $order_by,
	'order'           => $order,
	'post_type'       => $select_post_type,
	'post_status'     => 'publish',
	'suppress_filters' => true,
	'tax_query' => array(
		
	)
);
if(!empty($post_tags)):
	$args['tax_query'][] = array(
			'taxonomy' => 'post_tag',
			'field' => 'ID',
			'terms' => $post_tags
		);
endif;

if(!empty($post_categories)):
	$args['tax_query'][] = array(
			'taxonomy' => 'category',
			'field' => 'ID',
			'terms' => $post_categories
		);
endif;

$posts = get_posts( $args );

?>

<div class="post-slider-block <?php echo ( $collapsible == 1 ) ? 'collapsible-block' : 'non-collapsible' ?>">


<?php if( $collapsible == 1 ): ?>
<h6 class="component-name">
	<span class="d-none d-lg-block"><?php echo $title; ?></span>
	<button class="d-lg-none collapsible-toggle"><?php echo $title; ?> <i class="fas fa-chevron-down"></i></button>
</h6>
<?php else : ?>
	<?php  echo ($title) ? '<h6 class="component-name">'. $title . '</h6>': ''; ?>
<?php endif; ?>


<?php if( $collapsible == 1 ): ?>
<div class="component-inner">
<?php endif; ?>
<div class="post-slider">

	<?php foreach ( $posts as $p ) : setup_postdata( $p ); ?>


	<?php 
		$banner_image_id = get_post_thumbnail_id($p->ID);
		$banner_image =  $DB_Helper->generate_image($banner_image_id, 'portrait_sm');
		// $banner_image_portrait_md = get_the_post_thumbnail_url($p->ID,'portrait_md');
		// $banner_image_landscape_md = get_the_post_thumbnail_url($p->ID,'landscape_md');
		
	?>

	<div class="slide">

		<?php if($select_post_type == 'download'): ?>

			<div class="tbl">
				<div class="tbl-cell slide-text-cell">
					<h4 class="title"><?php echo $p->post_title; ?></h4>
					<?php if($select_post_type != 'download'): ?>
					<span class="date"><?php echo date_format(date_create($p->post_date), 'd.m.y'); ?></span>
					<?php endif; ?>
					<p class="slide-text  d-none d-lg-block"><?php echo $DB_Helper->excerpt( $DB_Helper->strip_tags_content( $p->post_excerpt ) , 50); ?></p>
				</div>
				<div class="tbl-cell slide-img-cell">
						<?php echo $banner_image; ?>
				</div>
			</div>

			<?php echo $DB_Content->get_section_spacer('20'); ?> 

			<div class="btn-wrap">
				<a href="<?php echo get_field('file', $p->ID ); ?>" download class="btn btn-4 btn-box-icon icon-download">Download</a>
			</div>

		<?php else: ?>

			<h4 class="title"><?php echo $p->post_title; ?></h4>
			<?php if($select_post_type != 'download'): ?>
			<span class="date"><?php echo date_format(date_create($p->post_date), 'd.m.y'); ?></span>
			<?php endif; ?>
			<p class="slide-text d-none d-lg-block"><?php echo $DB_Helper->excerpt( $DB_Helper->strip_tags_content( $p->post_excerpt ) , 50); ?></p>
			<?php echo $DB_Content->get_section_spacer('20'); ?> 

			<a href="<?php echo get_permalink( $p->ID ); ?>" class="btn btn-4 btn-box-icon icon-arrow">Read more</a>
		<?php endif; ?>

	</div>

	<?php 
		endforeach; 
		wp_reset_postdata();
	?>
</div>

	<ul class="post-slider-nav text-right">
		<li class="indicator">0 of 0</li>
		<li class="prev"><i class="fas fa-chevron-up"></i></li>
		<li class="next"><i class="fas fa-chevron-down"></i></li>
	</ul>

<?php if( $collapsible == 1 ): ?>
</div>
<?php endif; ?>


</div>
