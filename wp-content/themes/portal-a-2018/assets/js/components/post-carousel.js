
/**
 * Post List
 */

(function(window, $){

    if ( !$ ) {
        return;
    }

    var PostCarousel = function(el) {

        this.el = el;
        this.query = {
            page: PA.wp_query.query_vars.paged || 1,
            per_page: PA.wp_query.post_count,
        };
        this.max_num_pages = PA.wp_query.max_num_pages;
        this.url = PA.api + 'posts/';
        this.populatedPages = [this.query.page];
        this.prevBtn = document.querySelector('.js-prev');
        this.nextBtn = document.querySelector('.js-next');
        this.carouselSettings = {
            arrows: false,
            infinite: false,
        };

        var postTemplateEl = el.querySelector('.js-post-template');
        this.postTemplate = postTemplateEl.innerText ? postTemplateEl.innerText : '';
        this.el.removeChild(postTemplateEl);

        this.init();
    };

    PostCarousel.prototype.init = function(){ 
        $(this.el).slick(this.carouselSettings);
        this.updateControls();
        this.initEvents();
    };

    PostCarousel.prototype.initEvents = function() {

        var that = this;

        this.prevBtn.addEventListener('click', function(event){
            event.preventDefault();
            that.prevPage();
        });
        
        this.nextBtn.addEventListener('click', function(event){
            event.preventDefault();
            that.nextPage();
        });

    };

    PostCarousel.prototype.getPosts = function(){
        
        var that = this,
            queryString = UTIL.getQuery(this.query);
        
        return fetch( this.url + '?' + queryString )
            .then(function(response){
                that.populatedPages.push( that.query.page );
                return response.json();
            })
            .catch(function(error){
                console.log(error);
            });
    };

    PostCarousel.prototype.updateControls = function() {
        // prev button
        if ( this.query.page === 1 ) {
            this.prevBtn.classList.add('is-disabled');
        } else {
            this.prevBtn.classList.remove('is-disabled');
        }
        // next button
        if ( this.query.page === this.max_num_pages ) {
            this.nextBtn.classList.add('is-disabled');
        } else {
            this.nextBtn.classList.remove('is-disabled');
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

        postSlide.innerHTML = listHtml.join('');

        $(this.el).slick( 'slickAdd', postSlide.outerHTML, addBefore );

    };

    PostCarousel.prototype.nextPage = function() {
        var that = this,
            nextPage = this.query.page + 1;

        this.query.page = nextPage;
        
        UTIL.scrollTo( $('.pa-c-hero').height() );

        if ( this.populatedPages.indexOf( nextPage ) > -1 ) {
            $(this.el).slick('slickNext');
            that.updateControls();
        } 
        else {
            this.getPosts()
                .then(function(json){
                    that.addSlide(json);
                    $(that.el).slick('slickNext');
                    that.updateControls();
                });
        }
    };

    PostCarousel.prototype.prevPage = function() {
        var that = this,
            prevPage = this.query.page - 1;

        this.query.page = prevPage;
        
        UTIL.scrollTo( $('.pa-c-hero').height() );

        if ( this.populatedPages.indexOf( prevPage ) > -1 ) {
            $(this.el).slick('slickPrev');
            that.updateControls();
        } 
        else {
            this.getPosts()
                .then(function(json){
                    that.addSlide(json, true);
                    $(that.el).slick('slickPrev');
                    that.updateControls();
                });
        }
    };

    UTIL.onDocumentReady(function(){

        document.querySelectorAll('.js-post-carousel').forEach(function(el){
            new PostCarousel(el);
        });

    });

})( this, window.jQuery ? jQuery : null );