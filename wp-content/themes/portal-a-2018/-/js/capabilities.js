$( function() {

  var $container = $('.services-list'), animating = false;

  $('.services-list .service').each(function(index){
    var $el = $(this);
    setTimeout(function(){
      $el.animate({opacity:1},400);
    }, index * 300);
  });

  var callbackTimeout = null;
  var topSpot = 0;
  $container.on('click', '.service', function() {

    if (!animating) {
      var $service = $(this),
          $serviceContent = $service.find(".service-content"),
          $description = $serviceContent.find(".description"),
          $currentExpanded = $container.find(".service.is-expanded"),
          isExpanded = $service.hasClass("is-expanded"),
          isMiddle = $service.attr("id") === 'service-2' || $service.attr("id") === 'service-5',
          SPEED = 250,
          startTimeout = 0;

      animating = true;

      if ($currentExpanded.length && $currentExpanded != $service) {
        $currentExpanded.find(".description").animate({marginTop:10,opacity:0}, SPEED, function(){
          $currentExpanded.find(".service-content").animate({width: 320, marginLeft: 0}, SPEED, function(){
            $currentExpanded.find(".overlay").fadeOut(SPEED / 4);
            $currentExpanded.removeClass("is-expanded");
          });
        });

        startTimeout = SPEED * 2;
      }

      setTimeout(function(){

        if (!isExpanded) {
          $service.addClass("is-expanded");
          $serviceContent.find(".overlay").fadeTo(SPEED / 4,0.125);
          topSpot = (560 - $serviceContent.find('.description-holder').height()) / 2;
          if(isMiddle) {
            $serviceContent.animate({width: 992,marginLeft:'-336px'}, SPEED, function() {
              $description.animate({marginTop: topSpot,opacity:1}, SPEED);
              animating = false;
            });
          } else {
            $serviceContent.animate({width: 992}, SPEED, function() {
              $description.animate({marginTop: topSpot,opacity:1}, SPEED);
              animating = false;
            });
          }

        } else {
          $serviceContent.animate({marginLeft:'0px'}, SPEED);
          $description.animate({marginTop:10,opacity:0}, SPEED, function(){
            $serviceContent.animate({width: 320}, SPEED, function(){
              $serviceContent.find(".overlay").fadeOut(SPEED / 4);
              $service.removeClass("is-expanded");
              animating = false;
            });
          });
        }

      }, startTimeout);
    }
  });

});
