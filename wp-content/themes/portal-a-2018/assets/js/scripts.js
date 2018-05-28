/*! Portal A 2018 - v3.0.0
 * https://portal-a.com
 * Copyright (c) 2018; * Licensed GPLv2+ */


/**
 * Easing functions http://goo.gl/5HLl8
 */
Math.easeInOutQuad = function (t, b, c, d) {
    t /= d / 2;
    if (t < 1) {
        return c / 2 * t * t + b
    }
    t--;
    return -c / 2 * (t * (t - 2) - 1) + b;
};

/**
 * .forEach() support for NodeList
 */
if (window.NodeList && !NodeList.prototype.forEach) {
    NodeList.prototype.forEach = function (callback, thisArg) {
        thisArg = thisArg || window;
        for (var i = 0; i < this.length; i++) {
            callback.call(thisArg, this[i], i, this);
        }
    };
}


/**
 * Initialize
 */

(function(window){

    var PORTALA = function() {
    
        this.scrollCallbacks = [];

    };

    PORTALA.prototype.onScroll = function(fn){
        if (typeof fn == "function") {
            this.scrollCallbacks.push(fn);
        }
    };

    PORTALA.prototype.scrollTo = function( to, duration, callback ){

        var that = this,
            start = position(),
            change = to - start,
            currentTime = 0,
            increment = 20,
            requestFrame =  window.requestAnimationFrame ||
                            window.webkitRequestAnimationFrame ||
                            window.mozRequestAnimationFrame ||
                            window.msRequestAnimationFrame ||
                            window.oRequestAnimationFrame ||
                            // IE Fallback, you can even fallback to onscroll
                            function (callback) {
                                window.setTimeout(callback, 1000 / 60);
                            };
    
        duration = (typeof (duration) === 'undefined') ? 500 : duration;

        animateScroll();

        // because it's so fucking difficult to detect the scrolling element, just move them all
        function move(amount) {
            document.documentElement.scrollTop = amount;
            document.body.parentNode.scrollTop = amount;
            document.body.scrollTop = amount;
        }

        function position() {
            return document.documentElement.scrollTop || document.body.parentNode.scrollTop || document.body.scrollTop;
        }

        function animateScroll() {
            // increment the time
            currentTime += increment;
            // find the value with the quadratic in-out easing function
            var val = Math.easeInOutQuad(currentTime, start, change, duration);
            // move the document.body
            move(val);
            // do the animation unless its over
            if (currentTime < duration) {
                requestFrame(animateScroll);
            } 
            else {
                if (callback && typeof (callback) === 'function') {
                    // the animation is done so lets callback
                    callback();
                }
            }
        };
        
    };

    PORTALA.prototype.siblings = function(el, selector) {

        return Array.prototype.filter.call(el.parentNode.children, function(child){
            if ( child !== el ) {
                if ( selector ) {
                    // if selector is a class
                    if ( selector[0] === '.' ) {
                        return child.classList.contains(selector.substr(1));
                    } 
                    // if selector is an ID
                    else if ( selector[0] === '#' ) {
                        return child.getAttribute('id') === selector.substr(1);
                    }
                    else {
                        return child;
                    }
                } else {
                    return child;
                }
            } else {
                return false;
            }
        });

    };

    window.PORTALA = new PORTALA();

}(this));

/**
 * Smooth Scrolling
 */

(function(window){

    document.querySelectorAll('.js-smooth-scroll').forEach(function(el){

        el.addEventListener('click', function(e){
            e.preventDefault();
            
            var target = el.getAttribute('href') || el.getAttribute('data-target');

            PORTALA.scrollTo( document.querySelector(target).offsetTop );
        });

    });

})(this);

/**
 * Toggles
 */

(function(window){

    document.querySelectorAll('.js-filter').forEach(function(el){

        var sibs = PORTALA.siblings( el, '.js-filter' ),
            activeClass = el.getAttribute('data-active-class') || 'is-active';
        
            el.addEventListener('click', function(e){
            e.preventDefault();
            
            var target = el.getAttribute('href') || el.getAttribute('data-target'),
                targetEl = document.querySelector(target);

            el.classList.add(activeClass);
            sibs.forEach(function(sib){
                sib.classList.remove(activeClass);
            });

            targetEl.style.display = 'block';
            PORTALA.siblings(targetEl, '.js-filter-target').forEach(function(sib){
                sib.style.display = 'none';
            });

        });

    });

})(this);
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIl9fZXh0ZW5kcy5qcyIsIl9pbml0LmpzIiwic21vb3RoLXNjcm9sbC5qcyIsInRvZ2dsZXMuanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUN4QkE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQ3BHQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FDbkJBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsImZpbGUiOiJzY3JpcHRzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiXG4vKipcbiAqIEVhc2luZyBmdW5jdGlvbnMgaHR0cDovL2dvby5nbC81SExsOFxuICovXG5NYXRoLmVhc2VJbk91dFF1YWQgPSBmdW5jdGlvbiAodCwgYiwgYywgZCkge1xuICAgIHQgLz0gZCAvIDI7XG4gICAgaWYgKHQgPCAxKSB7XG4gICAgICAgIHJldHVybiBjIC8gMiAqIHQgKiB0ICsgYlxuICAgIH1cbiAgICB0LS07XG4gICAgcmV0dXJuIC1jIC8gMiAqICh0ICogKHQgLSAyKSAtIDEpICsgYjtcbn07XG5cbi8qKlxuICogLmZvckVhY2goKSBzdXBwb3J0IGZvciBOb2RlTGlzdFxuICovXG5pZiAod2luZG93Lk5vZGVMaXN0ICYmICFOb2RlTGlzdC5wcm90b3R5cGUuZm9yRWFjaCkge1xuICAgIE5vZGVMaXN0LnByb3RvdHlwZS5mb3JFYWNoID0gZnVuY3Rpb24gKGNhbGxiYWNrLCB0aGlzQXJnKSB7XG4gICAgICAgIHRoaXNBcmcgPSB0aGlzQXJnIHx8IHdpbmRvdztcbiAgICAgICAgZm9yICh2YXIgaSA9IDA7IGkgPCB0aGlzLmxlbmd0aDsgaSsrKSB7XG4gICAgICAgICAgICBjYWxsYmFjay5jYWxsKHRoaXNBcmcsIHRoaXNbaV0sIGksIHRoaXMpO1xuICAgICAgICB9XG4gICAgfTtcbn1cbiIsIlxuLyoqXG4gKiBJbml0aWFsaXplXG4gKi9cblxuKGZ1bmN0aW9uKHdpbmRvdyl7XG5cbiAgICB2YXIgUE9SVEFMQSA9IGZ1bmN0aW9uKCkge1xuICAgIFxuICAgICAgICB0aGlzLnNjcm9sbENhbGxiYWNrcyA9IFtdO1xuXG4gICAgfTtcblxuICAgIFBPUlRBTEEucHJvdG90eXBlLm9uU2Nyb2xsID0gZnVuY3Rpb24oZm4pe1xuICAgICAgICBpZiAodHlwZW9mIGZuID09IFwiZnVuY3Rpb25cIikge1xuICAgICAgICAgICAgdGhpcy5zY3JvbGxDYWxsYmFja3MucHVzaChmbik7XG4gICAgICAgIH1cbiAgICB9O1xuXG4gICAgUE9SVEFMQS5wcm90b3R5cGUuc2Nyb2xsVG8gPSBmdW5jdGlvbiggdG8sIGR1cmF0aW9uLCBjYWxsYmFjayApe1xuXG4gICAgICAgIHZhciB0aGF0ID0gdGhpcyxcbiAgICAgICAgICAgIHN0YXJ0ID0gcG9zaXRpb24oKSxcbiAgICAgICAgICAgIGNoYW5nZSA9IHRvIC0gc3RhcnQsXG4gICAgICAgICAgICBjdXJyZW50VGltZSA9IDAsXG4gICAgICAgICAgICBpbmNyZW1lbnQgPSAyMCxcbiAgICAgICAgICAgIHJlcXVlc3RGcmFtZSA9ICB3aW5kb3cucmVxdWVzdEFuaW1hdGlvbkZyYW1lIHx8XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgd2luZG93LndlYmtpdFJlcXVlc3RBbmltYXRpb25GcmFtZSB8fFxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHdpbmRvdy5tb3pSZXF1ZXN0QW5pbWF0aW9uRnJhbWUgfHxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB3aW5kb3cubXNSZXF1ZXN0QW5pbWF0aW9uRnJhbWUgfHxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB3aW5kb3cub1JlcXVlc3RBbmltYXRpb25GcmFtZSB8fFxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIC8vIElFIEZhbGxiYWNrLCB5b3UgY2FuIGV2ZW4gZmFsbGJhY2sgdG8gb25zY3JvbGxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBmdW5jdGlvbiAoY2FsbGJhY2spIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgd2luZG93LnNldFRpbWVvdXQoY2FsbGJhY2ssIDEwMDAgLyA2MCk7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgfTtcbiAgICBcbiAgICAgICAgZHVyYXRpb24gPSAodHlwZW9mIChkdXJhdGlvbikgPT09ICd1bmRlZmluZWQnKSA/IDUwMCA6IGR1cmF0aW9uO1xuXG4gICAgICAgIGFuaW1hdGVTY3JvbGwoKTtcblxuICAgICAgICAvLyBiZWNhdXNlIGl0J3Mgc28gZnVja2luZyBkaWZmaWN1bHQgdG8gZGV0ZWN0IHRoZSBzY3JvbGxpbmcgZWxlbWVudCwganVzdCBtb3ZlIHRoZW0gYWxsXG4gICAgICAgIGZ1bmN0aW9uIG1vdmUoYW1vdW50KSB7XG4gICAgICAgICAgICBkb2N1bWVudC5kb2N1bWVudEVsZW1lbnQuc2Nyb2xsVG9wID0gYW1vdW50O1xuICAgICAgICAgICAgZG9jdW1lbnQuYm9keS5wYXJlbnROb2RlLnNjcm9sbFRvcCA9IGFtb3VudDtcbiAgICAgICAgICAgIGRvY3VtZW50LmJvZHkuc2Nyb2xsVG9wID0gYW1vdW50O1xuICAgICAgICB9XG5cbiAgICAgICAgZnVuY3Rpb24gcG9zaXRpb24oKSB7XG4gICAgICAgICAgICByZXR1cm4gZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50LnNjcm9sbFRvcCB8fCBkb2N1bWVudC5ib2R5LnBhcmVudE5vZGUuc2Nyb2xsVG9wIHx8IGRvY3VtZW50LmJvZHkuc2Nyb2xsVG9wO1xuICAgICAgICB9XG5cbiAgICAgICAgZnVuY3Rpb24gYW5pbWF0ZVNjcm9sbCgpIHtcbiAgICAgICAgICAgIC8vIGluY3JlbWVudCB0aGUgdGltZVxuICAgICAgICAgICAgY3VycmVudFRpbWUgKz0gaW5jcmVtZW50O1xuICAgICAgICAgICAgLy8gZmluZCB0aGUgdmFsdWUgd2l0aCB0aGUgcXVhZHJhdGljIGluLW91dCBlYXNpbmcgZnVuY3Rpb25cbiAgICAgICAgICAgIHZhciB2YWwgPSBNYXRoLmVhc2VJbk91dFF1YWQoY3VycmVudFRpbWUsIHN0YXJ0LCBjaGFuZ2UsIGR1cmF0aW9uKTtcbiAgICAgICAgICAgIC8vIG1vdmUgdGhlIGRvY3VtZW50LmJvZHlcbiAgICAgICAgICAgIG1vdmUodmFsKTtcbiAgICAgICAgICAgIC8vIGRvIHRoZSBhbmltYXRpb24gdW5sZXNzIGl0cyBvdmVyXG4gICAgICAgICAgICBpZiAoY3VycmVudFRpbWUgPCBkdXJhdGlvbikge1xuICAgICAgICAgICAgICAgIHJlcXVlc3RGcmFtZShhbmltYXRlU2Nyb2xsKTtcbiAgICAgICAgICAgIH0gXG4gICAgICAgICAgICBlbHNlIHtcbiAgICAgICAgICAgICAgICBpZiAoY2FsbGJhY2sgJiYgdHlwZW9mIChjYWxsYmFjaykgPT09ICdmdW5jdGlvbicpIHtcbiAgICAgICAgICAgICAgICAgICAgLy8gdGhlIGFuaW1hdGlvbiBpcyBkb25lIHNvIGxldHMgY2FsbGJhY2tcbiAgICAgICAgICAgICAgICAgICAgY2FsbGJhY2soKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9XG4gICAgICAgIH07XG4gICAgICAgIFxuICAgIH07XG5cbiAgICBQT1JUQUxBLnByb3RvdHlwZS5zaWJsaW5ncyA9IGZ1bmN0aW9uKGVsLCBzZWxlY3Rvcikge1xuXG4gICAgICAgIHJldHVybiBBcnJheS5wcm90b3R5cGUuZmlsdGVyLmNhbGwoZWwucGFyZW50Tm9kZS5jaGlsZHJlbiwgZnVuY3Rpb24oY2hpbGQpe1xuICAgICAgICAgICAgaWYgKCBjaGlsZCAhPT0gZWwgKSB7XG4gICAgICAgICAgICAgICAgaWYgKCBzZWxlY3RvciApIHtcbiAgICAgICAgICAgICAgICAgICAgLy8gaWYgc2VsZWN0b3IgaXMgYSBjbGFzc1xuICAgICAgICAgICAgICAgICAgICBpZiAoIHNlbGVjdG9yWzBdID09PSAnLicgKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICByZXR1cm4gY2hpbGQuY2xhc3NMaXN0LmNvbnRhaW5zKHNlbGVjdG9yLnN1YnN0cigxKSk7XG4gICAgICAgICAgICAgICAgICAgIH0gXG4gICAgICAgICAgICAgICAgICAgIC8vIGlmIHNlbGVjdG9yIGlzIGFuIElEXG4gICAgICAgICAgICAgICAgICAgIGVsc2UgaWYgKCBzZWxlY3RvclswXSA9PT0gJyMnICkge1xuICAgICAgICAgICAgICAgICAgICAgICAgcmV0dXJuIGNoaWxkLmdldEF0dHJpYnV0ZSgnaWQnKSA9PT0gc2VsZWN0b3Iuc3Vic3RyKDEpO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgIGVsc2Uge1xuICAgICAgICAgICAgICAgICAgICAgICAgcmV0dXJuIGNoaWxkO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuIGNoaWxkO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgcmV0dXJuIGZhbHNlO1xuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcblxuICAgIH07XG5cbiAgICB3aW5kb3cuUE9SVEFMQSA9IG5ldyBQT1JUQUxBKCk7XG5cbn0odGhpcykpOyIsIlxuLyoqXG4gKiBTbW9vdGggU2Nyb2xsaW5nXG4gKi9cblxuKGZ1bmN0aW9uKHdpbmRvdyl7XG5cbiAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCcuanMtc21vb3RoLXNjcm9sbCcpLmZvckVhY2goZnVuY3Rpb24oZWwpe1xuXG4gICAgICAgIGVsLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24oZSl7XG4gICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgICAgICBcbiAgICAgICAgICAgIHZhciB0YXJnZXQgPSBlbC5nZXRBdHRyaWJ1dGUoJ2hyZWYnKSB8fCBlbC5nZXRBdHRyaWJ1dGUoJ2RhdGEtdGFyZ2V0Jyk7XG5cbiAgICAgICAgICAgIFBPUlRBTEEuc2Nyb2xsVG8oIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IodGFyZ2V0KS5vZmZzZXRUb3AgKTtcbiAgICAgICAgfSk7XG5cbiAgICB9KTtcblxufSkodGhpcyk7IiwiXG4vKipcbiAqIFRvZ2dsZXNcbiAqL1xuXG4oZnVuY3Rpb24od2luZG93KXtcblxuICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy5qcy1maWx0ZXInKS5mb3JFYWNoKGZ1bmN0aW9uKGVsKXtcblxuICAgICAgICB2YXIgc2licyA9IFBPUlRBTEEuc2libGluZ3MoIGVsLCAnLmpzLWZpbHRlcicgKSxcbiAgICAgICAgICAgIGFjdGl2ZUNsYXNzID0gZWwuZ2V0QXR0cmlidXRlKCdkYXRhLWFjdGl2ZS1jbGFzcycpIHx8ICdpcy1hY3RpdmUnO1xuICAgICAgICBcbiAgICAgICAgICAgIGVsLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24oZSl7XG4gICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgICAgICBcbiAgICAgICAgICAgIHZhciB0YXJnZXQgPSBlbC5nZXRBdHRyaWJ1dGUoJ2hyZWYnKSB8fCBlbC5nZXRBdHRyaWJ1dGUoJ2RhdGEtdGFyZ2V0JyksXG4gICAgICAgICAgICAgICAgdGFyZ2V0RWwgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKHRhcmdldCk7XG5cbiAgICAgICAgICAgIGVsLmNsYXNzTGlzdC5hZGQoYWN0aXZlQ2xhc3MpO1xuICAgICAgICAgICAgc2licy5mb3JFYWNoKGZ1bmN0aW9uKHNpYil7XG4gICAgICAgICAgICAgICAgc2liLmNsYXNzTGlzdC5yZW1vdmUoYWN0aXZlQ2xhc3MpO1xuICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgIHRhcmdldEVsLnN0eWxlLmRpc3BsYXkgPSAnYmxvY2snO1xuICAgICAgICAgICAgUE9SVEFMQS5zaWJsaW5ncyh0YXJnZXRFbCwgJy5qcy1maWx0ZXItdGFyZ2V0JykuZm9yRWFjaChmdW5jdGlvbihzaWIpe1xuICAgICAgICAgICAgICAgIHNpYi5zdHlsZS5kaXNwbGF5ID0gJ25vbmUnO1xuICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgfSk7XG5cbiAgICB9KTtcblxufSkodGhpcyk7Il19
