
/**
 * The 'Ability' component
 */

(function(window){

    var Ability = function(el) {

        this.el = el;
        this.parent = el.parentNode;
        this.siblings = UTIL.siblings(el, '.js-ability');
        // this.placeholder = document.createElement('div');

        this.init();

    };

    Ability.prototype.init = function() {

        // insert placeholder
        // this.parent.insertBefore( this.placeholder, this.el.nextSibling );

        // scope
        var that = this;

        // events
        this.el.addEventListener( 'click', function(event){

            event.preventDefault();

            if ( that.el.classList.contains('is-active') ) {
                that.deactivate();
            }
            else {
                that.activate();
            }

        });

    };

    Ability.prototype.activate = function() {

        // set classes
        this.el.classList.add('is-active');
        this.siblings.forEach(function(sib){
            sib.classList.remove('is-active');
            sib.classList.add('is-inactive');
        });
        
    };
    
    Ability.prototype.deactivate = function() {

        // set classes
        this.el.classList.remove('is-active');
        this.siblings.forEach(function(sib){
            sib.classList.remove('is-inactive');
        });
        
    };
    
    UTIL.onDocumentReady( function(){

        document.querySelectorAll('.js-ability').forEach(function(el){
            new Ability(el);
        });

    } );

})(this);