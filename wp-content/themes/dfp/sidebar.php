<?php
		global $post;

		// determine parent of current page
		if ($post->post_parent) {

			$ancestors = get_post_ancestors($post->ID);
			$parent = $ancestors[count($ancestors) - 1];

		} else {
			$parent = $post->ID;
		}

		$p = wp_list_pages("title_li=&link_before=<i class=\"s arr-r-blue\"></i>&include=" . $parent . "&echo=0");
		$children = wp_list_pages("title_li=&link_after=<i class=\"icon-arr-right\"></i>&child_of=" . $parent . "&echo=0");

		if ($children) {
			echo '<div class="side-links"><h3>Also in this section</h3><ul>';
			//echo $p;
			echo $children;
			echo '</ul></div>';
		}


		$widget_ctrl = get_field('widget_controller');

		if ($widget_ctrl) :

			foreach ($widget_ctrl as $widget) {

				switch ($widget) {

					case 'appointment':
						echo do_shortcode('[cta_book_appointment]');
						break;
					
					case 'related_practitioners':
						echo do_shortcode('[related_practitioners]');
						break;
					
					case 'all_practitioners':
						echo do_shortcode('[all_practitioners]');
						break;
					
					case 'contact_info':
						echo do_shortcode('[contact_information]');
						break;
					
					default:
						break;
				}

			}
			
		endif;





?>