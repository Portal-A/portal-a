/**
 * Smooth Scrolling
 */

(function(window, $){

    $('.js-smooth-scroll').each(function(){

        $el = $(this);
        
        $el.click(function(e){
            e.preventDefault();
            
            var target = $el.attr('href') || $el.data('target');

            $('html,body').animate({scrollTop: $(target).offset().top + 'px'});
        });

    });

})(this, jQuery);