(function($) {
	
    $.pveqh = function(el, options) {

        var base = this;
        base.$el = $(el);
        base.el = el;
        //base.$el.data("pveqh", base);

        base.init = function() {
            base.options = $.extend({}, $.pveqh.defaultOptions, options);
            base.setup();
            base.winResize();
        };

        // --------------------------------------------------------------------- //
        // DEFAULT OPTIONS
        // --------------------------------------------------------------------- //

        $.pveqh.defaultOptions = {
            children : '[class*="col-"]', // default columns
            complete : null,
            compensate : 250
        };

        // --------------------------------------------------------------------- //
        // HELPERS
        // --------------------------------------------------------------------- //

		base.debounce = function (func, wait, immediate) {
		  var timeout;
		  return function() {

		      var context = this, args = arguments;
		      var later = function() {
		        timeout = null;
		        if (!immediate) func.apply(context, args);
		      };

		      var callNow = immediate && !timeout;

		      clearTimeout(timeout);
		      timeout = setTimeout(later, wait);
		      if (callNow) func.apply(context, args);
		  };
		};


        // --------------------------------------------------------------------- //
        // FUNCTIONS
        // --------------------------------------------------------------------- //

        base.setup = function() {
                        
            var columns = base.$el.find( base.options.children ); // replaced .children w/ .find
            var rowWidth = base.$el.width();
            var curCols = $();
            var curMax = 0;
            var curWidth = 0;

            // reset the height
            columns.css('height', 'auto');
            columns.each(function(i, e) {
                var w = $(e).width();
                var h = $(e).height();

                if(curWidth+w <= rowWidth) {
                    curCols = curCols.add(e);
                    curWidth+= w;
                    if(h>curMax) curMax = h;
                } else {
                    if(curCols.length>1) curCols.css('height', curMax+'px');
                    curCols = $(e);
                    curWidth = w;
                    curMax = h;
                }

            });
            
            if(curCols.length>1) curCols.css('height', curMax+'px');

            if ($.isFunction( base.options.complete ) ) {
                base.options.complete.call(this);
            }

        };

        base.winResize = function() {
           $(window).on('resize', base.reconstruct);
        };

        base.reconstruct = base.debounce(function() {
            base.setup();
        }, 250);

        // Run initializer
        base.init();
    }

    $.fn.pveqh = function(options){
        if(this.length){
            return this.each(function() {
                (new $.pveqh(this, options));
            });
        }
    }

})(jQuery);