
/**
 * Initialize
 */

(function(window){

    var APP = function() {
    
        this.scrollCallbacks = [];

        this.init();

    };

    APP.prototype.init = function() {

        var that = this;

        if ( this.isRedirect() ) {

            this.handleRedirect();

        }

        if ( window.history && document.querySelector('[data-load-content]') ) {

            window.onpopstate = function(event) {
                if ( event.state ) {
                    var redirect = event.state.type + '-' + event.state.id;
                    that.handleRedirect( '?pa_redirect_to=' + redirect );
                }
            };

        }
    };

    APP.prototype.onScroll = function(fn){
        if (typeof fn == "function") {
            this.scrollCallbacks.push(fn);
        }
    };

    APP.prototype.isRedirect = function() {
        return location.search.indexOf('pa_redirect_to') > -1;
    };

    APP.prototype.parseQuery = function(queryStr) {
        var query = queryStr.substr(1).split('&'),
            queryObj = {};

        query.forEach(function(keyval){
            var key = keyval.split('=')[0],
                val = keyval.split('=')[1];
            
            queryObj[key] = val;
        });

        return queryObj;
    };

    APP.prototype.handleRedirect = function( query ) {
        
        query = query ? query : location.search;
        query = this.parseQuery(query);
        
        if ( ! query.pa_redirect_to ) 
            return;

        var targetEl = document.getElementById( query.pa_redirect_to );

        if ( ! targetEl ) 
            return;

        this.activateViewToggle( document.querySelector('.js-view-toggle[href="#' + targetEl.getAttribute('id') + '"]') );
        this.activateView(targetEl);
    };

    APP.prototype.activateView = function( viewEl ) {

        var template = viewEl.querySelector('script[type="html/mustache-template"]'),
            loadContent = parseInt( viewEl.getAttribute('data-load-content') ),
            dataViewTop = viewEl.getAttribute('data-view-top'),
            viewTop;

        // Show view and hide others

        viewEl.style.display = 'block';
        UTIL.siblings(viewEl, '.js-view-target').forEach(function(sib){
            sib.style.display = 'none';
        });

        // Scroll to appropriate part of the page

        viewTop = viewEl.offsetTop;

        if ( dataViewTop ) {
            var viewTopEl = document.querySelector(dataViewTop);
            viewTop = viewTopEl ? viewTopEl.offsetTop : viewTop;
        }
        
        UTIL.scrollTo( viewTop );

        // Check for template

        if ( ! template )
            return;
        
        template = template.innerText;

        // fetch content

        if ( loadContent ) {

            viewEl.classList.add('is-loading');

            fetch( PA.api + 'pages/' + loadContent )
                .then(function(response){
                    return response.json();
                })
                .then(function(data){
                    targetLoaded = true;
                    viewEl.classList.remove('is-loading');
                    UTIL.scrollTo( viewTop );
                    handleResponse(data);
                })
                .catch(function(error){
                    console.log(error);
                });

        }

        function handleResponse(data) {
    
            var html = Mustache.render( template, data );
            viewEl.innerHTML = html;

            if ( window.history ) {
                history.pushState( data, '', data.link );
            }
    
        }

    };

    APP.prototype.activateViewToggle = function( toggleEl, activeClass ) {

        activeClass = activeClass ? activeClass : 'is-active';

        if ( ! toggleEl )
            return;

        toggleEl.classList.add(activeClass);
        UTIL.siblings( toggleEl, '.js-view-toggle' ).forEach(function(sib){
            sib.classList.remove(activeClass);
        });
    };

    window.APP = new APP();

}(this));