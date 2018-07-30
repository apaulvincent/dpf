require('./maps');
require('./sliders');
require('./drawers');

$(document).ready(function(){

    $('.scroll-to').on('click', function (e) {
        e.preventDefault();
            $('html, body').animate({
                scrollTop: $('#main').offset().top
            }, 400);
    });

    $('.page-link-select').on('click', 'button', function(){
        var val = $(this).parents('.page-link-select').find('select').val();
        
        if(val != '') {
           window.location = val;
        }
    });

$('.download-select').on('change', function(){
        var val = $(this).val();
        if(val != '') {
           $(this).closest('div.download-select-container').find('a.download-link').attr('href', val);
        }
    });
 $('.page-select').on('change', function(){
        var val = $(this).val();
        if(val != '') {
           window.location = val;
        }
    });
 
    $('.insight-select').on('change', function(){
        var val = $(this).val();
        if(val != '') {
           window.location = val;
        }
    });

    $('.contact-select').on('change', 'select', function(){
        $('.contact-select ul').hide();
        $('.contact-select ul[data-contact-select="'+ $(this).val() +'"]').show();
    });

    $('.collapsible-block').on('click', '.collapsible-toggle', function(e){
        e.preventDefault();
        $(this).toggleClass('on');
        $(this).parents('.collapsible-block').find('.component-inner').slideToggle('fast'); 

        var slider = $(this).parents('.collapsible-block').find('.post-slider');
        slider.slick('refresh');

    });


    $('select').wrap('<div class="select-wrap"/>');

});