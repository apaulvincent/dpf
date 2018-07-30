<?php
/*
	- do we need a banner?
	- switch() thru the banner types
	- generate the banner:
*/


// var_dump($page_config);

	if($page_config['meta']['show_banner'] == 0) {
		echo '<div class="no-banner "></div>';
		return;
	}

	switch($page_config['meta']['banner_type']){
		case 'image-feature':
			include(locate_template('partials/common/header-banner-image-feature.php'));
		break;
		case 'image-standard':
			include(locate_template('partials/common/header-banner-image-compact.php'));
		break;
		case 'video-feature':
			include(locate_template('partials/common/header-banner-video-feature.php'));
		break;
		case 'image-slider':
			include(locate_template('partials/common/header-banner-image-slider.php'));
		break;
	}
?>