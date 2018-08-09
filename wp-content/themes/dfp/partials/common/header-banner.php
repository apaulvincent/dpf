<?php

	if($page_setup['show_banner'] == 0) {
		return;
	}

	switch($page_setup['banner_type']){
		case 'image-static':
			include(locate_template('partials/common/header-static-banner.php'));
		break;
		case 'image-slider':
			include(locate_template('partials/common/header-slider-banner.php'));
		break;
	}
?>