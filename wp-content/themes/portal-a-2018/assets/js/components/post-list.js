
/**
 * Post List
 */

(function(window){

    var PostList = function(el) {

        this.el = el;
        this.postTemplate = el.querySelector('.js-post-template');
        this.postTemplate = this.postTemplate.innerText ? this.postTemplate.innerText : '';
        this.query = {
            page: 1,
            per_page: 9,
        }
        this.url = PA.api + 'posts/';
        this.posts = [];
        this.prevBtn = document.querySelector('.js-prev');
        this.nextBtn = document.querySelector('.js-next');

        this.init();

        console.log(this);
    };

    PostList.prototype.init = function(){
        this.getPosts();
        this.initEvents();
    };

    PostList.prototype.initEvents = function() {

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

    PostList.prototype.getPosts = function(){
        
        var that = this,
            queryString = UTIL.getQuery(this.query);
        
        fetch( this.url + '?' + queryString )
            .then(function(response){
                return response.json();
            })
            .then(function(json){
                that.updatePosts(json);
            })
            .catch(function(error){
                console.log(error);
            });
    };

    PostList.prototype.updatePosts = function(posts){
        
        this.posts = posts;

        var that = this,
            listHtml = [];
        
        posts.forEach(function(post){
            var postHtml = Mustache.render( that.postTemplate, post );
            listHtml.push(postHtml);
        });

        this.el.innerHTML = listHtml.join('');

        if ( this.page === 1 ) {
            this.prevBtn.classList.add('is-disabled');
        } else {
            this.prevBtn.classList.remove('is-disabled');
        }

        UTIL.scrollTo(this.el.scrollTop);
    };

    PostList.prototype.nextPage = function() {
        this.query.page = this.query.page + 1;
        this.getPosts();
    };
    
    PostList.prototype.prevPage = function() {
        this.query.page = this.query.page === 1 ? 1 : this.query.page - 1;
        this.getPosts();
    };

    UTIL.onDocumentReady(function(){

        document.querySelectorAll('.js-post-list').forEach(function(el){
            new PostList(el);
        });

    });

})(this);