<div id="mobile-main-nav-drawer" class="mobile-main-nav-drawer">
	<?php
		wp_nav_menu(array(
			'menu' => 'Main Menu',
			'menu_class' => 'menu-inner',
			'container' => '',
			'container_class' => '',
			'before' => '', 
			'after' => '',
			'link_before' => '<span class="nav-text">',
			'link_after' => '</span>',
		));
	?>
</div>


<div id="search-drawer" class="search-drawer">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <button class="toggle-search">
                    <i class="icon icon-cross"></i>
                </button>

                <div class="search-inner">
                    <form action="<?php echo esc_url( home_url('/')); ?>" method="get" class="search-form">
                        <div class="form-group">
                            <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Start typing..." />
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
