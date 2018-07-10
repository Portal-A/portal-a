
/**
 * Utilities
 */

(function(window){

    var UTIL = {};

    UTIL.requestFrame = function(callback){
        var requestFrame =  window.requestAnimationFrame ||
                            window.webkitRequestAnimationFrame ||
                            window.mozRequestAnimationFrame ||
                            window.msRequestAnimationFrame ||
                            window.oRequestAnimationFrame ||
                            // IE Fallback, you can even fallback to onscroll
                            function (callback) {
                                window.setTimeout(callback, 1000 / 60);
                            };

        requestFrame(callback);
    };

    UTIL.scrollTo = function( to, duration, callback ){

        var that = this,
            start = position(),
            change = to - start,
            currentTime = 0,
            increment = 20;//,
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
                UTIL.requestFrame(animateScroll);
            } 
            else {
                if (callback && typeof (callback) === 'function') {
                    // the animation is done so lets callback
                    callback();
                }
            }
        };
        
    };

    UTIL.siblings = function(el, selector) {

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

    UTIL.wrap = function (toWrap, wrapperAtts) {
        wrapper = document.createElement('div');
        if ( wrapperAtts ) {
            Object.keys(wrapperAtts).forEach(function(attr){
                wrapper.setAttribute(attr, wrapperAtts[attr]);
            });
        }
        toWrap.parentNode.appendChild(wrapper);
        return wrapper.appendChild(toWrap);
    };    

    UTIL.onDocumentReady = function(fn) {
        if (document.attachEvent ? document.readyState === "complete" : document.readyState !== "loading"){
            fn();
        } else {
            document.addEventListener('DOMContentLoaded', fn);
        }
    };

    UTIL.fadeIn = function( el, duration, callback) {
        el.style.opacity = 0;

        duration = duration ? duration : 400;

        var last = new Date().getTime();
        var tick = function() {
            el.style.opacity = +el.style.opacity + (new Date() - last) / duration;
            last = new Date().getTime();
      
            if ( +el.style.opacity < 1 ) {
                UTIL.requestFrame(tick);
            } else {
                if ( callback ) {
                    callback();
                }
            }
        };
      
        tick();
    };
    
    UTIL.fadeOut = function( el, duration, callback) {
        el.style.opacity = 0;

        duration = duration ? duration : 400;

        var last = new Date().getTime();
        var tick = function() {
            el.style.opacity = +el.style.opacity - (new Date() - last) / duration;
            last = new Date().getTime();
      
            if ( +el.style.opacity > 0 ) {
                UTIL.requestFrame(tick);
            } else {
                if ( callback ) {
                    callback();
                }
            }
        };
      
        tick();
    };

    UTIL.getQuery = function( queryObj ) {
        var queryStr = [];

        Object.keys(queryObj).forEach(function(key){
            queryStr.push(key + '=' + queryObj[key]);
        });

        return queryStr.join('&');
    };

    window.UTIL = UTIL;

})(this);