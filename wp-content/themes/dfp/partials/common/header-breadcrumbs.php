<div class="breadcrumb-bar">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-5">
                <h2><?php the_title(); ?></h2>
            </div>
            <div class="col-12 col-lg-4 d-none d-lg-block">
                <div class="float-right">
                    <?php $DB_Content->get_page_breadcrumb(); ?>
                </div>
            </div>
            <div class="col-12 col-lg-3 d-none d-lg-block">
                <?php echo do_shortcode('[ssba-buttons]'); ?>
            </div>
        </div>
    </div>
</div>