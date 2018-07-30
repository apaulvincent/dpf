<?php

global $DB_Content;

if( $select_post_type == 'product'): 
    $taxonomy = 'product-cat';
elseif( $select_post_type == 'download'): 
    $taxonomy = 'category';
elseif( $select_post_type == 'insight'):
    $taxonomy = 'category';
endif;

$args = array(
    'hide_empty' => true,
);
$args = array('orderby' => 'name', 'order' => 'ASC');
$terms = get_terms($taxonomy, $args);

if(!isset($display_format)) $display_format = 'select-list';
if(!isset($list_title)) $list_title = 'Select Topic';

?>

<?php if ( $terms && !is_wp_error( $terms ) ) : ?>

<div class="category-listing <?php echo $additional_classes;?>">
<div class="row no-gutters">
    <?php
        switch($display_format){

            case 'select-list':
                ?>
                <select class="page-select">
                    <option value="">-- <?php echo $list_title; ?> --</option>
                <?php
                foreach ( $terms as $term ): 
                    ?>                   
                   <option value="<?php echo get_category_link($term->term_id); ?>"><?php echo $term->name; ?></option>
                    </div>

                <?php
                endforeach;
                ?>
            </select>
                <?php

            break;

            case 'link-grid':


                foreach ( $terms as $term ): 
                    $active_class = 'btn-1';

                    if(isset($current_term) && $current_term->slug == $term->slug) $active_class = 'btn-2';
                    ?>                   
                    <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                    <a href="<?php echo get_category_link($term->term_id); ?>" class="btn btn-primary btn-full <?php echo $active_class; ?>">
                      <?php echo $term->name; ?>
                    </a>
                    </div>

                <?php
                endforeach; 

            break;
        }
    ?>

</div>
</div>

<?php endif; ?>