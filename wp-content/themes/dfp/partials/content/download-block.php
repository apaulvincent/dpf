<?php

global $DB_Helper, $DB_Content;

/*
$column
	- feature_content: post object
	- feature_content_category: taxonomy
	- image
	- image_placement
	- image_space_allocated: 25, 50, 75

	if feature_content is not empty use this; if feature_content is empty, find the most recent one from feature_content_category
*/

// echo '<pre>';
// var_dump($var);
// echo '</pre>';

$file = get_field( 'file', $select_download->ID);



?>


<?php if( $download_style == 'v1'): // Button Only ?> 

        <div class="card download-button-block">
                <?php if($file): ?>
                    <a href="<?php echo $file; ?>" target="blank" class="btn btn-1 btn-box-icon icon-download" style="margin-right: 40px;">
                    <?php echo $title; ?>
                    </a>
                <?php endif; ?>
        </div>

<?php else: // Default Style ?>

        <div class="card download-card <?php echo $style_type .' '. $additional_classes; ?>">
                <div class="card-body">

                    <h6><i class="pe-7s-download"></i><?php echo $title; ?></h6>

                    <?php if($file): ?>
                    <div class="row no-gutters button-group">
                        <div class="col-6">
                            <a href="<?php echo $file; ?>" download class="btn btn-2 btn-full" style="padding-left: 0; padding-right: 0;">
                                Download
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="<?php echo $file; ?>" target="blank" class="btn btn-1 btn-full" style="padding-left: 0; padding-right: 0;">
                                View online
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
        </div>

<?php endif; ?>