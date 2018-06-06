
/**
 * Lightbox
 */

(function(window){

    var LightBoxToggle = function(el){

        this.el = el;
        this.templateSelector = el.getAttribute('data-template');
        this.template = document.querySelector(this.templateSelector);

        if ( ! this.template ) return;

        this.template = this.template.innerText;
        this.templateData = JSON.parse( el.getAttribute('data-template-data') );
        this.lightbox = null;
        this.closeBtn = null;

        var that = this;

        this.closeHandler = function(event){
            if ( that.closeBtn === event.target ) {
                that.destroyLightbox();
            }
        };

        this.init();

    };

    LightBoxToggle.prototype.init = function(){
        
        var that = this;

        this.el.addEventListener( 'click', function(event){

            event.preventDefault();

            var bgVideo = document.getElementById('background-video');
            if ( bgVideo ) {
                bgVideo.pause();
            }
            
            that.createLightbox( that.buildContent() );

        } );

    };

    LightBoxToggle.prototype.buildContent = function(){
        return Mustache.render( this.template, this.templateData );
    };

    LightBoxToggle.prototype.createLightbox = function(content){

        var that = this;

        content = content || '';

        document.body.classList.add('is-lightboxed');
        
        this.lightbox = document.createElement('div');
        this.lightbox.classList.add('pa-c-lightbox');
        this.lightbox.style.opacity = 0;
        this.lightbox.innerHTML = '<div class="pa-c-lightbox__inner"><button class="pa-b-close"></button>' + content + '</div>';

        document.body.appendChild(this.lightbox);
        UTIL.fadeIn(this.lightbox, 400, function(){
            that.lightbox.classList.add('is-visible');
        });

        this.closeBtn = this.lightbox.querySelector('.pa-b-close');
        this.closeBtn.addEventListener( 'click', this.closeHandler );

    };

    LightBoxToggle.prototype.destroyLightbox = function(){

        var that = this;
        that.lightbox.classList.remove('is-visible');

        setTimeout(function(){

            UTIL.fadeOut(that.lightbox, 400, function(){

                document.body.classList.remove('is-lightboxed');
                document.body.removeChild(that.lightbox);
        
                var bgVideo = document.getElementById('background-video');
                if ( bgVideo ) {
                    bgVideo.play();
                }

            });

        }, 400);

        this.closeBtn.removeEventListener( 'click', this.closeHandler );

    };

    UTIL.onDocumentReady(function(){

        document.querySelectorAll('.js-lightbox-toggle').forEach(function(el){
            new LightBoxToggle(el);
        });

    });

})(this);