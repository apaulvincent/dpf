<?php

global $DB_Helper, $DB_Content;

// echo '<pre>';
// var_dump($var);
// echo '</pre>';

?>

<a href="<?php echo $var['link']; ?>" 
    style="color: <?php echo $var['text_color'];?>; background-color: <?php echo $var['background_color'];?>" 
    class="<?php echo $var['reusable_block_setup'] ?> <?php echo $var['class']?>">

    <?php echo $var['link_text']; ?>
</a>



