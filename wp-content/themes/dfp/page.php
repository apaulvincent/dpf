<?php

	get_header();

?>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1 class="mega"><?php echo the_title(); ?></h1>
				</div>
			</div>
		</div>
	</section>

	<section class="main">
		<div class="container">
				<div class="row">

					<div class="col-8">

						<?php 
							if ( have_posts() ) :
							while ( have_posts() ) : the_post();
						?>

							<div class="entry">
								<?php the_content(); ?>
							</div>

						<?php 
							endwhile;
							endif; 
						?>

					</div>
					
					<div class="col-3 offset-1">
						sidebar
					</div>

				</div>
		</div>
	</section>



<?php 

get_footer();