<?php

global $DB_Helper;

/*
	$column:
	- title
	- content
*/
?>

<div class="title-block">
	<h3><?php  echo  $DB_Helper->format_heading($title) ?></h3>
	<div class="sub-title">
		<?php echo $content; ?>
	</div>
</div>