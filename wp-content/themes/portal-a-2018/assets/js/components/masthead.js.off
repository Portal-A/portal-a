
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

        var that = this;
        
        APP.onScroll(function(scrollTop){

            if ( scrollTop > that.height ) {
                that.el.classList.add('is-minimized');
            } else {
                that.el.classList.remove('is-minimized');
            }

        });

    };

    document.querySelectorAll('.js-masthead').forEach(function(el){
        new Masthead(el);
    });

})(this);