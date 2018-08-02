<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

<?php if (is_page('contact')): ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB96rt6dlY8Gp_GFprNH5ug__wnownAQHs"></script>
<?php endif ?>


</head>

<body <?php body_class(); ?>>

<?php

$pid  = get_queried_object_id();

if( !$pid ) return;

$page_config['ID'] = $pid;
$page_config['page'] = get_queried_object();
$page_config['meta'] = get_fields($pid);

// echo '<pre>';
// print_r($page_config['meta']);
// echo '</pre>';

?>

<div id="site-wrap" class="site-wrap">

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

								<?php include(locate_template('partials/common/header-mainnav.php')); ?>

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->

	<?php include(locate_template('partials/common/header-subnav.php')); ?>


	<button class="btn btn-full d-xl-none call-btn">
		<i class="fas fa-phone"></i> DFP
	</button>

	<?php include(locate_template('partials/common/header-banner.php')); ?>


