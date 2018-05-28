
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