require('./vendors/jquery.validate.min.js');
require('./vendors/bootstrap.min.js');
require('./maps');
require('./sliders');
require('./drawers');

$(document).ready(function(){


    $( "#sf-contact-form" ).validate();

    // $( "#sf-contact-form" ).validate({
    //         rules: {
    //         "hiddenRecaptcha": {

    //             required: function () {
    //                 console.log( "response="+grecaptcha.getResponse() );
    //                 if (grecaptcha.getResponse() == '') {
    //                     return true;
    //                 } else {
    //                     return false;
    //                 }
    //             }
    //         }
    //     }  
    // });


    $('.dfp-sf-form-modal-btn').on('click', function(e){
        e.preventDefault();
        
        // If contact form, scroll to form

        if( $('section.contact-form').length > 0 ) {

            window.location = '#dfp-sf-form-modal'

        } else {

            $('#dfp-sf-form-modal').modal('show');
        }

    })


    $('.dfp-subscribe-modal-btn').on('click', function(e){
        e.preventDefault();
        $('#dfp-subscribe-modal').modal('show');
    })


});