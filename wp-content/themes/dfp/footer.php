<?php global $DB_Content; ?>

</div><!-- Site Wrap -->

<?php 

$page_setup = get_fields();


if( $page_setup['content_reusable_blocks'] ) {

	foreach ( $page_setup['content_reusable_blocks'] as $key => $value) {

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
				<div class="col-12 col-md-6 col-lg-2">
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

				<div class="col-12 col-md-6 col-lg-2">
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

				<div class="col-12 col-md-6 col-lg-2">
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


				<div class="col-12 col-md-6 col-lg-2">
					<h5>Follow</h5>
					<div class="footer-socials">
						<?php include(locate_template('partials/common/socials.php')); ?>
					</div>
					<br>
					<ul class="footer-menu footer-menu-last">
						<?php 
							wp_nav_menu(
								array(  
										'menu' => 'Footer 04',
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


				<div class="col-12 col-md-6  col-lg-2">
					<ul class="footer-site-info">
						<?php
							$site_copyright = get_field('site_copyright', 'option');
							$field_site_designer = get_field('field_site_designer', 'option');
						?>
						<li><?php echo $site_copyright; ?> <br><br></li> 
						<li><?php echo $field_site_designer ?> </li>
					</ul>
				</div>

				<div class="col-12 col-md-6 col-lg-2">
					<h5>Contact Us</h5>

					<?php 

						$contact_info_fields = get_field('contact_info_fields', 'option');

						if( $contact_info_fields ):
							echo '<ul class="footer-site-info">';

							foreach ($contact_info_fields as $key => $field) {

								$p = 'P / ';
								if($key == 2) {
									$p = 'M / ';
								}

								echo '<li>
										'.$field['contact_name'].'<br>' . $p . 
										'<a href="tel:'. $field['contact_phone'].'">'. $field['contact_phone'].'</a> <br><br>
									</li>';
							}
							
							echo '</ul>';
						endif;

					?>

				</div>

			</div>
		</div>
</footer>



<!-- Modal: SF Form-->
<?php if ( !is_page('contact') ): ?>
<div class="modal fade" id="dfp-sf-form-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span class="pe-7s-close"></span>
		</button>
	  </div>
      <div class="modal-body">
		<i class="fas fa-comment"></i>
	  	<?php echo do_shortcode('[sidebar_content ids="14555"]'); ?>
      </div>
    </div>
  </div>
</div>
<?php endif ?>

<!-- Modal: Subscribe Form-->
<div class="modal fade" id="dfp-subscribe-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span class="pe-7s-close"></span>
		</button>
	  </div>
      <div class="modal-body">
	  	<?php echo do_shortcode('[mc4wp_form id="3533" element_id="mc4wp-newsletter-signup"]'); ?>
      </div>
    </div>
  </div>
</div>




<div class="social-share d-none d-lg-block">
	<?php echo do_shortcode('[ssba-buttons]'); ?>
</div>

<?php wp_footer(); ?>

</body>
</html>




