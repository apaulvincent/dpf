<?php

global $DB_Helper, $DB_Content;

// echo '<pre>';
// var_dump($var);
// echo '</pre>';

?>


<section class="reusable-block eq-blocks offices-block tint-8">
    
    <div class="container">
        <div class="wide-gutter row">
            
            <div class="col-12">    
                <h1 class="block-title"> <?php echo $var['title'] ?></h1>

    			 <?php echo $DB_Content->get_section_spacer('30'); ?>
            </div>

            <?php 

            $contact_info_fields = get_field('contact_info_fields', 'option');

            if( $contact_info_fields ):

                foreach ($contact_info_fields as $key => $field) {

                    $p = ' P / ';
                    if($key == 2) {
                        $p = ' M / ';
                    }

                    echo '<div class="col-12 col-lg-4 eq-block-wrap"><div class="eq-block tint-w card-'.$key.'"><h4><strong>'.$field['contact_name'].' / </strong>';

                    echo $field['contact_address'] ? $field['contact_address'] : '';
                    echo $field['contact_phone'] ? $p . $field['contact_phone'] : '';
                    echo $field['contact_email'] ? ',&nbsp;E&nbsp;/&nbsp;' . $field['contact_email'] : '';
                    
                    echo '</h4></div></div>';
                }
                
            endif;

            ?>

        </div>
    </div>

</section>





<?php


// echo '<pre>';
// var_dump($var);
// echo '</pre>';

?>


