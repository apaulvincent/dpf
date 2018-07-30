<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<title></title>
<?php wp_head(); ?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB96rt6dlY8Gp_GFprNH5ug__wnownAQHs"></script>

</head>

<body <?php body_class(); ?>>
<?php
/*
do the essential prep
*/
global $DB_Base;
global $DB_Helpers;
global $DB_Content;

?>


<div id="site-wrap" class="site-wrap">

<?php echo $DB_Content->get_section_spacer('85', array('d-xl-none')); ?> 

<header class="site-header">

	<div class="site-header-inner">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="header-wrap">

						<a href="<?php echo home_url(); ?>" class="branding">
							<?php
								$site_logo = get_field('desktop_site_logo_light', 'option');
								if($site_logo) {
									echo "<img src='".$site_logo."' width='68'/>";
								} else{
									echo get_bloginfo('name');
								}
							?>
						</a>

						<div class="float-right">
							<div  class="site-controls d-none d-xl-block">
								<div class="social float-left">
									<?php include(locate_template('partials/common/socials.php')); ?>
								</div>
								<ul class="site-info float-right">
									<li><a href="mailto:<?php  echo get_field('email_address', 'option'); ?>"><i class="fas fa-envelope"></i><?php  echo get_field('email_address', 'option'); ?></a></li>
									<li><a href="tel:<?php  echo get_field('phone_number', 'option'); ?>"><i class="fas fa-phone"></i><?php  echo get_field('phone_number', 'option'); ?></a></li>
								</ul>
							</div>
							<?php include(locate_template('partials/common/header-mainnav.php')); ?>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php include(locate_template('partials/common/header-subnav.php')); ?>

	
</header><!-- #masthead -->

<button class="btn btn-full d-xl-none">
	<i class="fas fa-phone"></i> CALL SACOA
</button>

<?php include(locate_template('partials/common/header-banner.php')); ?>

<?php 
	// if( $page_config['meta']['show_breadcrumb'] == '1'):
	// 	include(locate_template('partials/common/header-breadcrumbs.php'));
	// endif; 
?>



