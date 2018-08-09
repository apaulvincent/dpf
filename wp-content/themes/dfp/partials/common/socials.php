<?php

$social_fields = get_field('social_media_fields', 'option');

if( $social_fields ):
    echo "<ul>";

   foreach ($social_fields as $field) {

        switch($field['social_name']){

            case 'facebook':
                echo '<li><a href="'.$field['social_url'].'" target-"blank"><i class="fab fa-facebook-f"></i></a>';
                break;
            case 'twitter':
                echo '<li><a href="'.$field['social_url'].'" target-"blank"><i class="fab fa-twitter"></i></a>';
                break;
            case 'youtube':
                echo '<li><a href="'.$field['social_url'].'" target-"blank"><i class="fab fa-youtube"></i></a>';
                break;
            case 'linkedin':
                echo '<li><a href="'.$field['social_url'].'" target-"blank"><i class="fab fa-linkedin"></i></a>';
                break;
            case 'google':
                echo '<li><a href="'.$field['social_url'].'" target-"blank"><i class="fab fa-google-plus-square"></i></a>';
                break;
        }

   }
   
   echo "</ul>";
endif;