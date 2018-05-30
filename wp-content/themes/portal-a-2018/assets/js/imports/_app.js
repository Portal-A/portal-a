
/**
 * Primary APP constructor.
 */

(function(window){

    var APP = function() {
    
        this.scrollCallbacks = [];

        this.init();

    };

    /**
     * Initialize
     */
    APP.prototype.init = function() {

        var that = this;

        // check if a specific view is being queried
        if ( this.hasViewQuery() ) {
            // if so, load it up
            this.handleViewQuery();
        }

        if ( window.history && document.querySelector('[data-load-content]') ) {

            // handle use of back/forward browser buttons
            window.onpopstate = function(event) {

                // has state, load up the appropriate view
                if ( event.state ) {
                    var redirect = event.state.type + '-' + event.state.id;
                    that.handleViewQuery( '?active_view=' + redirect );
                } 

                // no state, scroll top of current page
                else {
                    UTIL.scrollTo(0);
                }
            };

        }
    };

    /**
     * Adds a function to be run when the browser scrolls
     * 
     * @param {function} fn any valid function
     */
    APP.prototype.onScroll = function(fn){
        if (typeof fn == "function") {
            this.scrollCallbacks.push(fn);
        }
    };

    /**
     * Check for a view query
     */
    APP.prototype.hasViewQuery = function() {
        return location.search.indexOf('active_view') > -1;
    };

    /**
     * Parse query string key/value pairs into an object
     * 
     * @param {string} queryStr a valid URL query string
     */
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

    /**
     * Activate a view toggle and view based on a query string
     * 
     * @param {string} query a valid URL query string containing an 'active_view' key
     */
    APP.prototype.handleViewQuery = function( query ) {
        
        query = query ? query : location.search;
        query = this.parseQuery(query);
        
        if ( ! query.active_view ) 
            return;

        var targetEl = document.getElementById( query.active_view );

        if ( ! targetEl ) 
            return;

        this.activateViewToggle( document.querySelector('.js-view-toggle[href="#' + targetEl.getAttribute('id') + '"]') );
        this.activateView(targetEl);
    };

    /**
     * Activate a view
     * 
     * @param {DOM element} viewEl 
     */
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

    /**
     * Activate a view toggle
     * 
     * @param {DOM element} toggleEl 
     * @param {string} activeClass 
     */
    APP.prototype.activateViewToggle = function( toggleEl, activeClass ) {

        activeClass = activeClass ? activeClass : 'is-active';

        if ( ! toggleEl )
            return;

        toggleEl.classList.add(activeClass);
        UTIL.siblings( toggleEl, '.js-view-toggle' ).forEach(function(sib){
            sib.classList.remove(activeClass);
        });
    };

    // Globalize the APP object
    window.APP = new APP();

}(this));