/**
 * Main Scripts
 */

$(document).ready(function() {
  // if ($('.home').length > 0) {

  //   var videobackground;
  //   var fileName = $('#bgVideo').data('bgvideo');
  //   var file = fileName.substr(fileName.lastIndexOf('/') + 1);
  //   var fileNoExt = file.substr(0, file.lastIndexOf('.'));
  //   var root = fileName.replace(file, '');

  //   videobackground = new $.backgroundVideo($(".video-holder #bgVideo"), {
  //     align: "centerXY",
  //     path: root,
  //     width: 1280,
  //     height: 720,
  //     filename: fileNoExt,
  //     types: ["mp4", "ogv", "webm"],
  //     preload: true,
  //     autoplay: true,
  //     muted: true
  //   });

  //   if (Modernizr.touch){
  //     // Show the image please
  //     $('.video-holder').addClass('image');
  //     $('#bgVideo').remove();
  //   }

  //   $('#bgVideo video').bind('play', function (e) {
  //     setTimeout(function() {
  //       $('#bgVideo').removeClass('loading');
  //     }, 500 );
  //   });

  // }

  // Prevent having to double click on nav on mobile devices
  // From http://stackoverflow.com/questions/3038898/ipad-iphone-hover-problem-causes-the-user-to-double-click-a-link
  $('.pa-c-masthead a').on('click touchend', function(e) {
    var el = $(this);
    var link = el.attr('href');
    window.location = link;
  });

});


// Slideshow
(function($){
    $.fn.fuzzshow = function(options) {
    	this.each(function() {
			var $this = $(this);

			// Defaults and Options
			$this.data = $this.data('fuzzshow');
			$this.data = $.extend({
				slides : $('<div/>'),
				previous : $('<div/>'),
				next : $('<div/>'),
				picks : $('<div/>'),
				slide_time : 5000,
				slide_type : 'fade'
		    }, options);

			// Slideshow Setup
			$this.data.interval = setInterval(slide_next, $this.data.slide_time);
			$this.data.previous.click(function() {
				clearInterval($this.data.interval);
				slide_previous();
				return false;
			});
			$this.data.next.click(function() {
				clearInterval($this.data.interval);
				slide_next();
				return false;
			});
			$this.data.picks.each(function(index) {
				$(this).click(slide_pick);
			});

			$this.addClass('current');
			$this.data.slides.hide();
			$this.data.slides.removeClass('current').eq(0).addClass('current').fadeIn();
			$this.data.picks.removeClass('current').eq(0).addClass('current');

			// Slide Functions
			function slide_previous() {
				var current = $this.data.slides.filter('.current');
				var current_index = $this.data.slides.index(current);
				$(current).fadeOut().removeClass('current');
				$this.data.picks.filter('.current').removeClass('current');
				if (current_index == 0) {
					$this.data.slides.last().fadeIn(2000).addClass('current');
					$this.data.picks.last().addClass('current');
				}
				else {
					$this.data.slides.eq(current_index - 1).fadeIn(2000).addClass('current');
					$this.data.picks.eq(current_index - 1).addClass('current');
				}
	   		}
	   		function slide_next() {
	   			var current = $this.data.slides.filter('.current');
				var current_index = $this.data.slides.index(current);
				$(current).fadeOut().removeClass('current');
				$this.data.picks.filter('.current').removeClass('current');
				if (current_index == $this.data.slides.length - 1) {
					$this.data.slides.first().fadeIn(2000).addClass('current');
					$this.data.picks.first().addClass('current');
				}
				else {
					$this.data.slides.eq(current_index + 1).fadeIn(2000).addClass('current');
					$this.data.picks.eq(current_index + 1).addClass('current');
				}
	   		}
	   		function slide_pick() {
	   			var current = $this.data.picks.filter('.current');
	   			var index = $this.data.picks.index($(this));
	   			if (index != $this.data.picks.index(current)) {
	   				clearInterval($this.data.interval);
	   				$this.data.slides.filter('.current').fadeOut().removeClass('current');
	   				$(current).removeClass('current');
	   				$(this).addClass('current');
	   				$this.data.slides.eq(index).fadeIn(2000).addClass('current');
	   			}
	   			return false;
	   		}
   		});
   		return this;
    };
})(jQuery);

var retina = window.devicePixelRatio > 1 ? true : false;

// Site Specific
$(document).ready(function(){

  // Header logo swap for animated gif
  $('.js-logo').hover(
    function() {
      var src = $(this).attr("src");
      $(this).attr("src", src.replace(/\.png$/i, ".gif"));
      console.log('enter');
    },
    function() {
      var src = $(this).attr("src");
      $(this).attr("src", src.replace(/\.gif$/i, ".png"));
      console.log('leave');
  });

  // video modal
  // if (Modernizr.touch) {
  //   var videoURL = $('.reel-button').data('video');
  //   $('.reel-button').attr('href', videoURL);
  // } else {
  //   $('.reel-button').magnificPopup({
  //     type:'inline',
  //     callbacks: {
  //       open: function() {
  //         $('#video_background').get(0).pause();
  //         $('#reel video').get(0).play();
  //         $('.video').addClass('mute');
  //       },
  //       close: function() {
  //         $('#video_background').get(0).play();
  //         $('#reel video').get(0).pause();
  //         $('.video').removeClass('mute');
  //       }
  //     }
  //   });
  // }

	// Delay Loading of Images
	$('img').each(function () {
		var src = $(this).attr('data-src');
		var retina_src = $(this).attr('data-src-retina');
		if (retina_src != undefined && retina) {
			$(this).attr('src', retina_src).show();
		}
		else if (src != null) {
			$(this).attr('src', src).show();
		}
	});

	// Delay Loading of Video
	$('video').each(function (){
		var mp4_src = $(this).attr('mp4-src');
		var webm_src = $(this).attr('webm-src');
		if (mp4_src != null & webm_src != null) {
			$(this).html('<source src="'+mp4_src+'" type="video/mp4"><source src="'+webm_src+'" type="video/webm">');
		}
	});

	// Home Slideshow
	$('.slideshow').fuzzshow({
		slides : $('.slideshow .slide'),
		previous : $('.slideshow a.previous'),
		next : $('.slideshow a.next'),
		picks : $('.slideshow .picks a'),
		slide_time : 5000,
		slide_fade : 600
	});

	$(window).resize(function() {
		$('.page-id-2 .slide').height($(window).height() - 140);
	});

	$(window).resize();

	$('.slideshow .slide').each(function(e) {
		$(this).backstretch($(this).attr('data-image'));
	});

	// About
	$('.page-id-10 .content .right h2:first').addClass('first');
	$('.page-id-10 .partner:last').addClass('partner-right');
	$('.page-id-10 .coin:last').addClass('coin-right');

	var delay = 300;
	if ($('.page-id-10').length > 0) {
		$('.coin').each(function() {
			var img = $(this);
			setTimeout(function() {
				img.fadeTo(600, 1);
			}, delay);
			delay += 300;
		});
	}

  // Tabs
  $(function() {
    $( "#tabs" ).tabs({
      beforeLoad: function( event, ui ) {
        ui.jqXHR.fail(function() {
          ui.panel.html("Couldn't load this tab. Try reloading the page- if you're still experiencing issues, feel free to reach out to us at info@portal-a.com.");
        });
      }
    });
  });

  if($('#tabs #ui-id-3[aria-hidden="false"]')) {
  	console.log("something");
  }


	// WORK PAGE
	if ($('.work-link').length > 0) {

		$('video').each(function(){
			$(this).prop('muted', true);
		});

		// Play video on hover
		$('.works').on('mouseenter', '.work-link', function() {
			$(this).find('video').get(0).play();
			$(this).prop('muted', true);
		}).on('mouseleave', '.work-link', function() {
			$(this).find('video').get(0).pause();
		});

	}


	// SINGLE WORK PAGES

		// Load Images
		if ($('.page-id-8').length > 0 || $('.single-work').length > 0) {
			$('.middle .press').each(function() {
				var img = $(this);
				setTimeout(function() {
					img.fadeTo(600, 1);
				}, delay);
				delay += 300;
			});
		}

	// Press
  setTimeout(function(){
    $('.meta').each(function() {
      $(this).height($(this).closest('.press').height());
      $(this).removeClass('loading');
    });
  }, 100 );

	$('.bottom .row:last-child').addClass('last');
	$('.presses a').mouseenter(function(){
		$(this).find('.quotemark').animate({
			marginTop: '-5px'
		}, 400 );
	}).mouseleave(function(){
		$(this).find('.quotemark').animate({
			marginTop: '0'
		}, 400 );
	});
	$('.presses h3 a').mouseenter(function(){
		$(this).find('.arrow').stop().animate({
			marginLeft: '0'
		}, 400 );
	}).mouseleave(function(){
		$(this).find('.arrow').stop().animate({
			marginLeft: '-25px'
		}, 400 );
	});

	// Logo
	// if ($.support.opacity) { pulse_out($('.mainhead .middle')); }

	// About
	var delay = 300;
	if ($('.page-id-10').length > 0) {

    // Things
    $('.email-address').bind('mouseenter', function(e) {
      $(this).closest('.partner-name').find('.partner-email').addClass('active');
    }).bind('mouseleave', function(e) {
      $(this).closest('.partner-name').find('.partner-email').removeClass('active');
    });

    // Other things
    $('.partner-email').bind('mouseenter', function(e) {
      $(this).closest('.partner-name').find('.email-address').addClass('active');
    }).bind('mouseleave', function(e) {
      $(this).closest('.partner-name').find('.email-address').removeClass('active');
    });

		$('.team-member').each(function() {
			var img = $(this);
			setTimeout(function() {
				img.fadeTo(600, 1);
			}, delay);
			delay += 300;
		});
	}
	$('.team-member a:link').mouseenter(function(){
		$(this).children('.hover-photo').show();
	}).mouseleave(function(){
		$(this).children('.hover-photo').hide();
	});

	// Partners
	$('.partner-block').each(function() {
		var img = $(this);
		setTimeout(function() {
			img.fadeTo(600, 1);
		}, delay);
		delay += 300;
	});

  //$('.partner-block a').mouseenter(function() {
    //$(this).find('.brand-color').stop().animate({
      //filter: 'alpha(opacity=100)',
      //opacity: 1
    //}, 400);
  //}).mouseleave(function() {
    //$(this).find('.brand-color').stop().animate({
      //filter: 'alpha(opacity=0)',
      //opacity: 0
    //}, 400);
  //});

	// Contact
	var delay = 300;
	if ($('.page-id-6').length > 0) {
		$('.location').each(function() {
			var map = $(this);
			setTimeout(function() {
				map.fadeTo(600, 1);
			}, delay);
			delay += 300;
		});
	}

	// Header Lines
	$('.mainhead a').append('<span class="line" />');


  // Meta

});

/*
function pulse_in(element) {
	$(element).fadeTo(2000, 1, function() { pulse_out(element) });
}

function pulse_out(element) {
	$(element).fadeTo(2000, .6, function() { pulse_in(element) });
}
*/
