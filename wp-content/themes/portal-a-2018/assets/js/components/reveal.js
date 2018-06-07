
/**
 * The 'Reveal' component
 */

(function(window){

    var Reveal = function(el) {

        this.el = el;
        this.originalText = this.el.innerText;
        this.target = el.getAttribute('data-target') || '';
        this.targetEl = document.getElementById(this.target);

        if ( ! this.targetEl ) 
            return;

        this.loadUrl = this.targetEl.getAttribute('data-load-content');
        this.template = this.targetEl.querySelector('script[type="html/mustache-template"]');
        this.finished = false;

        this.init();

    };

    Reveal.prototype.init = function() {

        var that = this;

        this.el.addEventListener( 'click', function(event){

            event.preventDefault();

            if ( ! that.finished ) {

                if ( that.loadUrl ){

                    that.el.innerText = 'Loading...';

                    fetch(that.loadUrl)
                        .then(function(response){
                            return response.json();
                        })
                        .then(function(json){
                            that.handleResponse(json);
                        })
                        .catch(function(error){
                            console.log(error);
                        });

                } else {

                    that.revealContent();

                }
            
            }

        });

    };

    Reveal.prototype.handleResponse = function(json) {
        
        var html = Mustache.render( this.template.innerText, json );

        this.revealContent(html);

    };

    Reveal.prototype.revealContent = function( html ) {

        if ( html ) {
            this.targetEl.innerHTML = html;
        }

        UTIL.fadeIn( this.targetEl );

        UTIL.scrollTo( this.targetEl.offsetTop );

        this.el.innerText = this.originalText;
        this.el.setAttribute( 'disabled', 'disabled' );

    };
    
    UTIL.onDocumentReady( function(){

        document.querySelectorAll('.js-reveal').forEach(function(el){
            new Reveal(el);
        });

    } );

})(this);