<?php global $DB_Content; ?>

</div><!-- Site Wrap -->

<?php 

$content = get_fields($post->ID);


if( $content['content_reusable_blocks'] ) {

	foreach ( $content['content_reusable_blocks'] as $key => $value) {

		$block = get_fields($value);

		if( is_front_page() ) {
			if( $block['class'] == 'download-strip' || $block['reusable_block_setup'] == 'page-grid') {
				continue;
			}
		}

		echo $DB_Content->pass_file_to_var('partials/content/'. $block['reusable_block_setup'] .'.php', $block);

	}
}

?>


<footer class="site-footer">
		<div class="container">

			<div class="row">
				<div class="col-12 col-lg-4">
					<div class="search-form-wrap">
						<form action="<?php echo esc_url( home_url('/')); ?>" method="get" class="search-form">
								<input type="text" name="s" id="search" value="<?php the_search_query(); ?>" autocomplete="new" placeholder="" />
								<button type="submit"><i class="fa fa-search"></i></button>
						</form>
					</div>
				</div>
			</div>

			 <?php echo $DB_Content->get_section_spacer('30'); ?>
			 <?php echo $DB_Content->get_section_divider('full', ['tint-w']); ?>
			 <?php echo $DB_Content->get_section_spacer('30'); ?>

			<div class="row">
				<div class="col-12 col-lg-2">
					<ul class="footer-menu">
						<?php 
							wp_nav_menu(
								array(  
										'menu' => 'Footer 01',
										'menu_class' => '',
										'container' => '',
										'container_class' => '',
										'before' => '',
										'after' => '',
										'link_before' => '',
										'link_after' => '',
										'items_wrap' => '%3$s',
									)
							);
						?>
					</ul>
				</div>

				<div class="col-12 col-lg-2">
					<ul class="footer-menu">
						<?php 
							wp_nav_menu(
								array(  
										'menu' => 'Footer 02',
										'menu_class' => '',
										'container' => '',
										'container_class' => '',
										'before' => '',
										'after' => '',
										'link_before' => '',
										'link_after' => '',
										'items_wrap' => '%3$s',
									)
							);
						?>
					</ul>
				</div>

				<div class="col-12 col-lg-2">
					<ul class="footer-menu">
						<?php 
							wp_nav_menu(
								array(  
										'menu' => 'Footer 03',
										'menu_class' => '',
										'container' => '',
										'container_class' => '',
										'before' => '',
										'after' => '',
										'link_before' => '',
										'link_after' => '',
										'items_wrap' => '%3$s',
									)
							);
						?>
					</ul>
				</div>


				<div class="col-12 col-lg-2">
					<h5>Follow</h5>
					<div class="footer-socials">
						<?php include(locate_template('partials/common/socials.php')); ?>
					</div>
				</div>


				<div class="col-12 col-lg-2">
					<ul class="footer-site-info">
						<?php
							$site_copyright = get_field('site_copyright', 'option');
							$field_site_designer = get_field('field_site_designer', 'option');
						?>
						<li><?php echo $site_copyright; ?> <br><br></li> 
						<li><?php echo $field_site_designer ?> </li>
					</ul>
				</div>

				<div class="col-12 col-lg-2">
					<h5>Contact Us</h5>

					<?php 

						$contact_info_fields = get_field('contact_info_fields', 'option');

						if( $contact_info_fields ):
							echo '<ul class="footer-site-info">';

							foreach ($contact_info_fields as $field) {
								echo '<li>
										'.$field['contact_name'].'<br>
										P / '.$field['contact_phone'].'<br><br>
									</li>';
							}
							
							echo '</ul>';
						endif;

					?>

				</div>

			</div>
		</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
