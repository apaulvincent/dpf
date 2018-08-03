<?php
/*
	- do we need a banner?
	- switch() thru the banner types
	- generate the banner:
*/


// var_dump($page_config);

	if($page_config['meta']['show_banner'] == 0) {
		echo '<div class="no-banner"></div>';
		return;
	}

	switch($page_config['meta']['banner_type']){
		case 'static-banner':
			include(locate_template('partials/common/header-static-banner.php'));
		break;
		case 'slider-banner':
			include(locate_template('partials/common/header-slider-banner.php'));
		break;
	}
?>