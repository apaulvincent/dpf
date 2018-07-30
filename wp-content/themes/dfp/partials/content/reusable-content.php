<?php

global $DB_Helper, $DB_Content;

// echo '<pre>';
// var_dump($collapsible);
// // var_dump($reusable_content);
// echo '</pre>';

?>

<?php foreach ($reusable as $reuse): ?>

<?php  

    $new_var = array_merge( $reuse, array('collapsible' => $collapsible));

    echo $DB_Content->get_reusable_content($new_var); 

 ?>

<?php endforeach; ?>