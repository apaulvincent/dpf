<?php

global $DB_Helper, $DB_Content;

// echo '<pre>';
// var_dump($var);
// echo '</pre>';

?>


<?php if( $collapsible == 1 ): ?>

<div class="standard-content-block <?php echo $additional_classes; ?> collapsible-block">
	<h4 class="component-name">
		<span class="d-none d-lg-block"><?php echo $title; ?></span>
		<button class="collapsible-toggle d-lg-none"><?php echo $title; ?> 
			<i class="fas fa-chevron-down"></i>
		</button>
	</h4>
	<div class="component-inner">
		<?php echo $content; ?>

		<?php if( $button_title && $button_url ): ?>
			<a href="<?php echo $button_url; ?>" class="btn btn-4 btn-box-icon icon-arrow"><?php echo $button_title; ?></a>
		<?php endif; ?>

	</div>
</div>

<?php else : ?>

	<div class="standard-content-block <?php echo $additional_classes; ?> non-collapsible">
		<?php  echo ($title) ? '<h4 class="component-name">'. $title . '</h4>': ''; ?>

		<?php echo $content; ?>

		<?php echo $DB_Content->get_section_spacer('20'); ?> 

		<?php if( $button_title && $button_url ): ?>
			<a href="<?php echo $button_url; ?>" class="btn btn-4 btn-box-icon icon-arrow"><?php echo $button_title; ?></a>
		<?php endif; ?>

	</div>


<?php endif; ?>