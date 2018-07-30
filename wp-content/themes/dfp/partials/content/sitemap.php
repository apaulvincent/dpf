<?php

global $DB_Helper, $DB_Content;

// echo '<pre>';
// var_dump($var);
// echo '</pre>';

?>


<div class="sitemap">

	<h3>Pages</h3>
	<ul class="sitemap-pages">
        <?php wp_list_pages(
        	array(
        	'exclude' => '', 
        	'title_li' => '',
        	'post_type' => 'page')
        ); 
        ?>
    </ul>

    <h3>Products</h3>
	<ul class="sitemap-pages">
        <?php wp_list_pages(
        	array(
        	'exclude' => '', 
        	'title_li' => '',
        	'post_type' => 'product')
        );
        ?>
    </ul>

    <h3>Downloads</h3>
	<ul class="sitemap-pages">
        <?php wp_list_pages(
        	array(
        	'exclude' => '', 
        	'title_li' => '',
        	'post_type' => 'download')
        );  
        ?>
    </ul>

    <h3>Insights</h3>
	<ul class="sitemap-pages">
        <?php wp_list_pages(
        	array(
        	'exclude' => '', 
        	'title_li' => '',
        	'post_type' => 'insight')
        );  
        ?>
    </ul>
    
</div>