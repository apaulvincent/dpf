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


});