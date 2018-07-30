<?php

global $DB_Content;

/*
$column
	- pages: array of post objects
	- display_columns: 1,2,3,4

	use display_columns to set the layout of the page links
*/


// echo '<pre>';
// var_dump($var);
// echo '</pre>';


$select_markup = '<option value="">Please select</option>';

?>

<?php if($pages): ?>

<div class="page-link-block <?php echo $additional_classes; ?> <?php echo ( $collapsible == 1 ) ? 'collapsible-block' : 'non-collapsible' ?>">

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
		<ul>
			<?php foreach ( $pages as $p ) : setup_postdata( $p ); ?>
			<li>
				<a href="<?php echo get_permalink( $p ); ?>">
					<i class="far fa-bookmark"></i>
					<?php echo get_the_title($p); ?> 
				</a>
			</li>
			<?php 
				endforeach; 
			?>
		</ul>
	<?php if( $collapsible == 1 ): ?>
	</div>
	<?php endif; ?>
</div>

<?php endif; ?>