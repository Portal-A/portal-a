
/**
 * Post List
 * REQUIRES: slick.min.js, jQuery
 */

(function(window, $){

    // if no jQuery, bail out
    if ( !$ ) {
        return;
    }

    var PostCarousel = function(el) {

        var post_count = Math.max( PA.wp_query.post_count, 9 ),
            found_posts = PA.wp_query.found_posts,
            pa_query = PA.wp_query.query,
            pa_query_vars = PA.wp_query.query_vars;
            // pa_queried_object = PA.wp_query.queried_object;

        this.el = el;
        this.page = pa_query_vars.paged || 1;
        this.perPage = parseInt( post_count );
        this.postCount = parseInt( found_posts );
        this.max_num_pages = this.getMaxPages( this.postCount, this.perPage );
        this.postsUrl = PA.api + 'posts/';
        this.populatedPages = [this.page];
        this.upperPaging = document.querySelector('.js-upper-paging');
        this.prevBtn = document.querySelectorAll('.js-prev');
        this.nextBtn = document.querySelectorAll('.js-next');
        this.currentPageEl = document.querySelectorAll('.js-current-page');
        this.totalPagesEl = document.querySelectorAll('.js-total-pages');
        this.carousel = null;
        this.carouselSettings = {
            arrows: false,
            infinite: false,
        };
        this.catDisplay = document.querySelector('.js-cat-display');
        this.currentCat = pa_query.category_name ? PA.wp_query.queried_object_id : 0;
        this.basePath = location.pathname.split('page')[0];

        var postTemplateEl = el.querySelector('.js-post-template');
        this.postTemplate = postTemplateEl.innerText ? postTemplateEl.innerText : '';
        this.el.removeChild(postTemplateEl);
        
        console.log(this);

        this.init();

    };

    PostCarousel.prototype.init = function(){ 
        this.carousel = $(this.el).slick(this.carouselSettings);
        this.updateControls();
        this.initEvents();
        this.initCategories();
        window.postcarousel = this;
    };

    PostCarousel.prototype.initEvents = function() {

        var that = this;

        // prev button
        this.prevBtn.forEach(function(el){
            el.addEventListener('click', function(event){
                event.preventDefault();
                that.prevPage();
            });
        });
        
        // next button
        this.nextBtn.forEach(function(el){
            el.addEventListener('click', function(event){
                event.preventDefault();
                that.nextPage();
            });
        });

        // browser back/forward buttons
        window.onpopstate = function(event) {
            
            var statePage = event.state ? event.state.page : 1,
                direction = that.page > statePage ? 'prev' : 'next';
            
            that.page = statePage;

            if ( direction === 'next' ) {
                that.carousel.slick('slickNext');
            } else {
                that.carousel.slick('slickPrev');
            }
            
            that.updateControls();
        };

    };

    PostCarousel.prototype.initCategories = function() {
        var that = this;

        document.querySelectorAll('.js-cat-link').forEach(function(link){

            link.addEventListener( 'click', function(event){
                event.preventDefault();

                var linkText = link.innerText,
                    linkId = parseInt( link.getAttribute('data-cat-id') );

                // update settings
                that.currentCat = linkId;
                that.postCount = parseInt( link.getAttribute('data-count') );
                that.max_num_pages = that.getMaxPages( that.postCount , that.perPage);
                that.page = 1;
                that.basePath = link.getAttribute('href').split(PA.site_url)[1];
                    
                // display category name
                if ( "all" === linkText.toLowerCase() ) {
                    that.catDisplay.innerText = " ";
                } else {
                    that.catDisplay.innerText = "Category: " + link.innerText.trim();
                }

                // remove active state on links
                document.querySelectorAll('.js-cat-link').forEach(function(_link){
                    _link.classList.remove('pa-u-color-primary');
                    _link.classList.remove('pa-u-underline');
                });

                // set active state on link
                link.classList.add('pa-u-color-primary');
                link.classList.add('pa-u-underline');

                // scroll to top
                UTIL.scrollTo( $('.pa-c-hero').height() );

                // run function after .scrollTo() has finished
                setTimeout( function(){

                    // go back to first slide, `true` arg means don't animate
                    that.carousel.slick('slickGoTo', 0, true);
    
                    // remove all slides
                    for ( var i = 0; i < that.populatedPages.length; i++ ) {
                        that.carousel.slick('slickRemove', 0);
                    }

                    // update populatedPages list
                    that.populatedPages = [that.page];

                    // get category posts
                    var args = {};
                    if ( linkId ) {
                        args.categories = linkId;
                    }
                    that.getPosts(args)
                        .then(function(json){
                            that.addSlide( json );
                            that.updateControls();
                            that.updateURL();
                            that.updatePaging();
                        });

                }, 500 );

            });

        });

    };

    PostCarousel.prototype.getPosts = function(args){
        
        args = (typeof args === 'object') ? args : {};

        var defaults = {
            page: 1,
            per_page: this.perPage,
        };
        var query = Object.assign({}, defaults, args);

        var that = this,
            queryString = UTIL.getQuery(query);
        
        console.log(this.postsUrl + '?' + queryString);
        
        return fetch( this.postsUrl + '?' + queryString )
            .then(function(response){
                return response.json();
            })
            .catch(function(error){
                console.log(error);
            });
    };

    PostCarousel.prototype.updateControls = function() {
        // prev button
        if ( this.page === 1 ) {
            this.upperPaging.style.opacity = '0';
            this.prevBtn.forEach(function(el){
                el.classList.add('is-disabled');
            });
        } else {
            this.upperPaging.style.opacity = '1';
            this.prevBtn.forEach(function(el){
                el.classList.remove('is-disabled');
            });
        }
        // next button
        if ( this.page === this.max_num_pages ) {
            this.nextBtn.forEach(function(el){
                el.classList.add('is-disabled');
            });
        } else {
            this.nextBtn.forEach(function(el){
                el.classList.remove('is-disabled');
            });
        }
    };
    
    PostCarousel.prototype.addSlide = function(posts, addBefore){
        
        var that = this;

        // assign current posts
        this.posts = posts;

        // build post list
        var listHtml = [];
        
        var postSlide = document.createElement('div');
        postSlide.classList.add('pa-c-post-slide');
        
        posts.forEach(function(post){
            var postHtml = Mustache.render( that.postTemplate, post );
            listHtml.push(postHtml);
        });

        postSlide.innerHTML = '<div class="pa-l-flexbox does-wrap with-gutters">' + listHtml.join('') + '</div>';

        this.carousel.slick( 'slickAdd', postSlide.outerHTML, addBefore );

    };

    PostCarousel.prototype.nextPage = function() {
        var nextPage = this.page + 1;

        this.page = nextPage;
        
        UTIL.scrollTo( $('.pa-c-hero').height() );

        if ( this.populatedPages.indexOf( nextPage ) > -1 ) {
            this.carousel.slick('slickNext');
            this.updateControls();
            this.updateURL();
            this.updatePaging();
        } 
        else {
            var that = this;
                args = {
                    page: nextPage
                };

            if ( this.currentCat ) {
                args.categories = this.currentCat;
            }

            this.getPosts(args)
                .then(function(json){
                    that.populatedPages.push(nextPage);
                    that.addSlide(json);
                    that.carousel.slick('slickNext');
                    that.updateControls();
                    that.updateURL();
                    that.updatePaging();
                });
        }
    };

    PostCarousel.prototype.prevPage = function() {
        var prevPage = this.page - 1;

        this.page = prevPage;
        
        UTIL.scrollTo( $('.pa-c-hero').height() );

        if ( this.populatedPages.indexOf( prevPage ) > -1 ) {
            this.carousel.slick('slickPrev');
            this.updateControls();
            this.updateURL();
            this.updatePaging();
        } 
        else {
            var that = this;
                args = {
                    page: prevPage
                };

            if ( this.currentCat ) {
                args.categories = this.currentCat;
            }

            this.getPosts(args)
                .then(function(json){
                    that.populatedPages.push(prevPage);
                    that.addSlide(json, true);
                    that.carousel.slick('slickPrev');
                    that.updateControls();
                    that.updateURL();
                    that.updatePaging();
                });
        }
    };

    PostCarousel.prototype.updateURL = function() {
        if ( ! window.history ) {
            return;
        }

        var path = this.basePath,
            newUrl = this.page === 1 ? PA.site_url + path : PA.site_url + path + 'page/' + this.page;

        history.pushState( 
            { page: this.page }, 
            'page ' + this.page, 
            newUrl
        );
    };

    PostCarousel.prototype.getMaxPages = function( total, perPage ) {
        return Math.ceil( parseInt(total) / parseInt(perPage) );
    };

    PostCarousel.prototype.updatePaging = function( current, total ) {

        current = current ? current : this.page;
        total = total ? total : this.max_num_pages;

        this.currentPageEl.forEach(function(el){
            el.innerText = current;
        });
        this.totalPagesEl.forEach(function(el){
            el.innerText = total;
        });

    };

    UTIL.onDocumentReady(function(){

        document.querySelectorAll('.js-post-carousel').forEach(function(el){
            new PostCarousel(el);
        });

    });

})( this, window.jQuery ? jQuery : null );