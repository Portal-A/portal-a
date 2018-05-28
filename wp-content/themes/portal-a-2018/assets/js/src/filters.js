
/**
 * Toggles
 */

(function(window){

    var Filter = function(el) {

        this.el = el;
        this.sibs = PORTALA.siblings( el, '.js-filter' );
        this.activeClass = el.getAttribute('data-active-class') || 'is-active';
        this.target = el.getAttribute('href') || el.getAttribute('data-target');
        this.targetEl = document.querySelector(this.target);
        this.targetTemplate = null;
        this.targetLoaded = false;
        this.loadContent = parseInt( el.getAttribute('data-load-content') );
        
        if ( this.targetEl ) {
            this.init();
        }
    };
    
    Filter.prototype.init = function() {
        
        var template = this.targetEl.querySelector('script[type="html/mustache-template"]');

        if ( template ) {
            this.targetTemplate = template.innerText;
        }
        
        this.initEvents();

    };

    Filter.prototype.initEvents = function(){
        var that = this;

        this.el.addEventListener('click', function(e){
            e.preventDefault();

            that.el.classList.add(that.activeClass);
            that.sibs.forEach(function(sib){
                sib.classList.remove(that.activeClass);
            });

            if ( that.targetEl ) {
                that.targetEl.style.display = 'block';
                PORTALA.siblings(that.targetEl, '.js-filter-target').forEach(function(sib){
                    sib.style.display = 'none';
                });
            }

            if ( that.loadContent && ! that.targetLoaded ) {

                fetch( PA.api + 'pages/' + that.loadContent )
                    .then(function(response){
                        return response.json();
                    })
                    .then(function(data){
                        that.handleResponse(data);
                    })
                    .catch(function(error){
                        console.log(error);
                    });

            }

        });
    };

    Filter.prototype.handleResponse = function(data) {

        this.targetLoaded = true;

        var html = Mustache.render( this.targetTemplate, {
            title: data.title.rendered
        } );

        this.targetEl.innerHTML = html;

    };

    document.querySelectorAll('.js-filter').forEach(function(el){
        new Filter(el);
    });

})(this);