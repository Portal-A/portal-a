
/**
 * Masthead
 */

(function(window){

    var Masthead = function(el) {

        this.el = el;
        this.height = el.offsetHeight;
        this.init();
    
    };
    
    Masthead.prototype.init = function() {

        var that = this,
            prevScrollTop;
        
        APP.onScroll(function(scrollTop){

            if ( prevScrollTop < scrollTop ) {
                that.el.classList.remove('is-visible');
            } else {
                that.el.classList.add('is-visible');
            }

            if ( scrollTop > that.height ) {
                that.el.classList.add('is-fixed');
            } else {
                that.el.classList.remove('is-fixed');
            }

            prevScrollTop = scrollTop;

        });

    };

    document.querySelectorAll('.js-masthead').forEach(function(el){
        new Masthead(el);
    });

})(this);