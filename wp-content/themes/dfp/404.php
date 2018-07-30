<?php
$page_url = get_field('page_not_found', 'option');

header("Location: ".$page_url);