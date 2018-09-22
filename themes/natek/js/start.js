/**
 * Website start here
 */
$(window).load(function () {
	
  $("#loading").hide(100);  
});
$(document).ready(function ($) {
	
	$('<div id="loading"><img src="'+image_path+'images/loading.gif" /></div>').appendTo('body');
	
	
	
	    "use strict"; // Start of use strict

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    });

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a:not(.dropdown-toggle)').click(function() {
        $('.navbar-toggle:visible').click();
    });

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    })

    // Initialize and Configure Scroll Reveal Animation
    window.sr = ScrollReveal();
    sr.reveal('.sr-icons', {
        duration: 600,
        scale: 0.3,
        distance: '0px'
    }, 200);
    sr.reveal('.sr-button', {
        duration: 1000,
        delay: 200
    });
    sr.reveal('.sr-contact', {
        duration: 600,
        scale: 0.3,
        distance: '0px'
    }, 300);

    // Initialize and Configure Magnific Popup Lightbox Plugin
    $('.popup-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
        }
    });	
    if ($(".btn-top").length > 0) {
        $(window).scroll(function () {
            var e = $(window).scrollTop();
            if (e > 300) {
                $(".btn-top").show()
            } else {
                $(".btn-top").hide()
            }
        });
        $(".btn-top").click(function () {
            $('body,html').animate({
                scrollTop: 0
            })
        });
    }
    if ($(".navbar-form .btn").length > 0) {
        $(".navbar-form .btn").click(function () {
				
            if ($(".navbar-form").hasClass("active")) {
                $(".navbar-form").removeClass("active");
				$(".navbar-form .btn").removeClass("active");
				
				
            }
            else {
                $(".navbar-form").addClass("active");
				 $(".navbar-form .btn").addClass("active");
                return false;
            }
        });
    }
	
    if ($('.flexslider-top').length > 0) {
        $('.flexslider-top').flexslider({
            animation: "none"
        });
    }
    if ($(".carousel").length > 0) {
        (function () {

            // store the slider in a local variable
            var $window = $(window),
                flexslider;

            // tiny helper function to add breakpoints
            function getGridSize() {
                return (window.innerWidth < 376) ? 1 :
                    (window.innerWidth < 768) ? 2 :
                        (window.innerWidth < 1080) ? 2 :
                            (window.innerWidth > 1199) ? 3 : 3;
            }


            $window.load(function () {
                $('.carousel').flexslider({
                    animation: "slide",
                    animationSpeed: 400,
                    animationLoop: false,
                    slideshow: true,
                    itemWidth: 210,
                    itemMargin: 40,
                    minItems: getGridSize(), // use function to pull in initial value
                    maxItems: getGridSize(), // use function to pull in initial value
                    start: function (slider) {
                        $('body').removeClass('loading');
                        flexslider = slider;
                    }
                });
            });

            // check grid size on resize event
            $window.resize(function () {
                var gridSize = getGridSize();

                flexslider.vars.minItems = gridSize;
                flexslider.vars.maxItems = gridSize;
            });
        }());
    }
    
    if( $(window).width() > 1199) {
        $(".flexslider-top .slides li").css("height", $(window).height() -  $("#mainNav").height());
    }
     if ($('#carousel').length > 0) {
     // The slider being synced must be initialized first
      $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 86,
        itemMargin: 5,
        asNavFor: '#slider'
      });
     
      $('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel"
      });
    } 


    
    $('ul.dropdown-menu [data-toggle=dropdown]').on('touchstart click', function (ev) {
        // Avoid following the href location when clicking
        ev.preventDefault();
        // Avoid having the menu to close when clicking
        ev.stopPropagation();
        // Re-add .open to parent sub-menu item

        if ($(this).parent().hasClass('open')) {
            $(this).parent().removeClass('open');
        }
        else {
            $(this).parent().addClass('open');
            $(this).parent().find("ul").parent().find("li.dropdown").addClass('open');
        }
    });

});
$(document).click(function () {
    $(".navbar-form, .navbar-form .btn").removeClass("active");
    $(".a").removeClass("show");
    $("#a").removeClass("normal");
});
$('.navbar-form input').click(function (event) {
    event.stopPropagation();
});


