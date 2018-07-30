<?php

global $post, $DB_Content;

// echo '<pre>';
// var_dump($var);
// echo '</pre>';


$select_markup = '';

$args = array(
    'post_type' => 'insight',
    'orderby' => 'date',
    'order' => 'DESC',
    'post__not_in' => array($post->ID)
);

$db_query = new WP_Query( $args );

if ( $db_query->have_posts() ) {
    $select_markup .= '<select class="insight-select" id=""><option value="">Select insight</option>';
    while ( $db_query->have_posts() ) {

        $db_query->the_post();

        $select_markup .= '<option value="'.get_permalink().'">'.get_the_title().'</option>';

    }
    $select_markup .= "</select>";
    wp_reset_postdata();
}

?>

<div class="insight-select-block <?php echo $additional_classes;?> <?php echo ( $collapsible == 1 ) ? 'collapsible-block' : 'non-collapsible' ?>">

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

<?php echo $select_markup; ?>

<?php if( $collapsible == 1 ): ?>
</div>
<?php endif; ?>

</div>

