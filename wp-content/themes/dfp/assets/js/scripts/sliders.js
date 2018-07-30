require('./vendors/slick');

(function($) {

	$(function(){

		$('.banner-slider').slick({
			dots: true,
			arrows: false,
			infinite: true,
			autoplay: true,
			pauseOnHover: false,
			autoplaySpeed: 6000
		});


		$('.home-slider').slick({
			dots: true,
			arrows: false,
			infinite: true,
			autoplay: true,
			pauseOnHover: false,
			autoplaySpeed: 3000
		});




		$('.post-slider').on('init', function(event, slick){
			

			var _this = $(this);
			var prevBtn = $(this).next('.post-slider-nav').find('.prev');
			var nextBtn = $(this).next('.post-slider-nav').find('.next');
			var indicator = $(this).next('.post-slider-nav').find('.indicator');

			prevBtn.on('click', function() {
				_this.slick('slickPrev');
			});

			nextBtn.on('click', function() {
				_this.slick('slickNext');
			});

			var slideToShow = slick.options.slidesToShow;
			var slideCount = slick.$slides.length > slideToShow ? slick.$slides.length : slideToShow;
			
			slideCount = Math.ceil(slideCount / slideToShow);
			
			indicator.text('1 of ' + slideCount)

		}).slick({
			dots: false,
			arrows: false,
			infinite: true,
			autoplay: true,
			pauseOnHover: true,
			autoplaySpeed: 6000,
		  	slidesToShow: 1,
			slidesToScroll: 1,
			fade:true,
			speed: 1000,

		}).on('afterChange', function (event, slick, currentSlide) {

			var prevBtn = $(this).next('.post-slider-nav').find('.prev');
			var nextBtn = $(this).next('.post-slider-nav').find('.next');

			var indicator = $(this).next('.post-slider-nav').find('.indicator');
			var slideToShow = slick.options.slidesToShow;
			
			var slideCount = slick.$slides.length > slideToShow ? slick.$slides.length : slideToShow;
				slideCount = Math.ceil(slideCount / slideToShow);
			
			var currentSlide = (currentSlide / slideToShow) + 1;
		
			indicator.text(currentSlide + ' of ' + slideCount)
			
		});

	});
}(jQuery));
