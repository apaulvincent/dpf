<?php global $DB_Content; ?>

</div><!-- Site Wrap -->



<footer class="site-footer">

	<section class="main-footer">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-2">

					<a href="<?php echo home_url(); ?>" class="branding">
						<?php
							$site_logo = get_field('desktop_site_logo', 'option');
							if($site_logo) {
								echo "<img src='".$site_logo."' width='68'/>";
							} else{
								echo get_bloginfo('name');
							}
						?>
					</a>
					
				</div>
				<div class="col-12 col-lg-7">

					<ul class="footer-site-info">
						<?php
							$address = get_field('address', 'option');
							$phone = get_field('phone_number', 'option');
							$fax = get_field('fax_number', 'option');
							$email = get_field('email_address', 'option');
						?>
						<li><?php echo $address; ?> <strong>&middot;</strong></li> 
						<li><span>P: </span>+<?php echo '<a href="tel:'.$phone.'">'.$phone.'</a>'; ?> <strong>&middot;</strong></li>
						<li><span>F: </span>+<?php echo $fax ; ?> <strong>&middot;</strong></li>
						<li><span>E: </span><?php echo '<a href="mailto:'.$email.'">'.$email.'</a>'; ?></li>
					</ul>

					<ul class="footer-menu">
						<?php 
							wp_nav_menu(
								array(  
										'menu' => 'Footer Menu',
										'menu_class' => '',
										'container' => '',
										'container_class' => '',
										'before' => '',
										'after' => '<strong>&middot;</strong>',
										'link_before' => '',
										'link_after' => '',
										'items_wrap' => '%3$s',
									)
							);
						?>
					</ul>

				</div>
				<div class="col-12 col-lg-3">
					<div class="footer-socials">
						<?php include(locate_template('partials/common/socials.php')); ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<small><?php echo get_field('site_copyright', 'option'); ?></small>
				</div>
			</div>
		</div>
	</section>

</footer>

<?php wp_footer(); ?>

</body>
</html>
