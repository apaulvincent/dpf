<div class="search-form-wrap">
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<input type="text" id="" class="search-field" value="<?php echo get_search_query(); ?>" name="s" autocomplete="new" placeholder="" />

	<button type="submit" class="search-submit">
		<i class="fa fa-search"></i>
	</button>
</form>
</div>