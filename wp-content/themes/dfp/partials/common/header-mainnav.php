<nav class="main-menu d-none d-xl-block">
	
	<ul class="inner">
		<?php 
			wp_nav_menu(
				array(  'menu' => 'Main Navigation',
					    'menu_class' => '',
					    'container' => '',
					    'container_class' => '',
						'before' => '',
						'depth' => 1,
					    'after' => '',
					    'link_before' => '',
					    'link_after' => '',
					    'items_wrap' => '%3$s'
					)
			);
		?>
		<li>
			<span class="search-drawer-toggle"><i class="fa fa-search"></i></span>
		</li>
	</ul>

</nav>


<nav class="mobile-toggles d-xl-none">
	<ul>
		<li>
			<button class="search-drawer-toggle"><i class="fa fa-search"></i></button>
		</li>
		<li>
			<button class="mobile-main-nav-toggle">
				<i class="fa fa-bars"></i>
			</button>
		</li>
	</ul>
</nav>
