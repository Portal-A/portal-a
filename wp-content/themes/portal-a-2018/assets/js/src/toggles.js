/**
 * Toggles
 */

(function(window, $){

    $('.js-filter').each(function(){

        var $el = $(this),
            $sibs = $el.siblings('.js-filter'),
            activeClass = $el.data('active-class') || 'is-active';
        
        $el.click(function(e){
            e.preventDefault();
            
            var target = $el.attr('href') || $el.data('target'),
                $target = $(target);

            $el.addClass(activeClass);
            $sibs.removeClass(activeClass);

            $target
                .show()
                .siblings('.js-filter-target')
                    .hide();

        });

    });

})(this, jQuery);