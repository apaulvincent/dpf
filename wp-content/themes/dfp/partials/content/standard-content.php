<?php

global $DB_Helper, $DB_Content;

// echo '<pre>';
// var_dump($var);
// echo '</pre>';

?>


<?php if( $var['class'] == 'download-strip') : ?>
    <section class="cta-block-full tint-2 brand-1 <?php echo $var['class'] . '-block' ?> ">
        <?php echo $var['content']; ?>
    </section>
<?php else: ?>

    <section class="<?php echo $var['reusable_block_setup'] . '-block' ?> <?php echo $var['class']?>">

        <h4> <?php echo $var['title'] ?></h4>

        <?php echo $var['content']; ?>

        <?php if( $var['link_text'] && $var['link'] ): ?>
            <a href="<?php echo $var['link']; ?>" class="btn"><?php echo $var['link_text']; ?></a>
        <?php endif; ?>

    </section>

<?php endif; ?>



