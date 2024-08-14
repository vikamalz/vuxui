/**
 * WEBSITE: https://themefisher.com
 * TWITTER: https://twitter.com/themefisher
 * FACEBOOK: https://www.facebook.com/themefisher
 * GITHUB: https://github.com/themefisher/
 */

(function($) {
    "use strict";

    $(".history-scroller").niceScroll({
        cursorwidth: "10px",
        background: "#0d1015",
        cursorborder: "0",
        cursorborderradius: "0",
        autohidemode: false,
        zindex: 5
    });

    // testimonial-slider
    $('.testimonials').slick({
        dots: true,
        infinite: true,
        speed: 300,
        arrows: false,
        adaptiveHeight: true,
        
        slidesToShow: 2,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
    
    animatedProgressBar();
    windowHeight();
    previewPanel();

    function animatedProgressBar() {
        $(".progress").each(function() {
            var skillValue = $(this).find(".skill-label").attr("data-skill-value");
            $(this).find(".bar").animate({
                width: skillValue
            }, 1500);

            $(this).find(".skill-label").text(skillValue);
        });
    }

    function windowHeight() {
        if ($(window).height() <= 768) {
            $(".pt-table").addClass("desktop-768");
        } else {
            $(".pt-table").removeClass("desktop-768");
        }
    }

    /*----------------------------------------
        Isotope Masonry
    ------------------------------------------*/
    function isotopeMasonry() {
        $(".isotope-gutter").isotope({
            itemSelector: '[class^="col-"]',
            percentPosition: true
        });
        $(".isotope-no-gutter").isotope({
            itemSelector: '[class^="col-"]',
            percentPosition: true,
            masonry: {
                columnWidth: 1
            }
        });

        $(".filter a").on("click", function() {
            $(".filter a").removeClass("active");
            $(this).addClass("active");
            var selector = $(this).attr("data-filter");
            $(".isotope-gutter").isotope({
                filter: selector,
                animationOptions: {
                    duration: 750,
                    easing: "linear",
                    queue: false
                }
            });
            return false;
        });
    }

    /*=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        Preview Panel
    -=-=-=-=-=-=-=-=-=--=-=-=-=-=-*/
    function previewPanel() {
        $(".switcher-trigger").on("click", function() {
            $(".preview-wrapper").toggleClass("extend");
            return false;
        });
        
        // Load the saved color from localStorage when the page is loaded
        $(document).ready(function() {
            let savedColor = localStorage.getItem("selectedColor");
            if (savedColor) {
                $("#color-changer").attr("href", "css/colors/" + savedColor + ".css");
            }
        });
        
        if ($(window).width() < 768) {            
            //$(".preview-wrapper").removeClass("extend");
        }
    
        $(".color-options li").on("click", function() {
            let selectedColor = $(this).attr("data-color");
            $("#color-changer").attr("href", "css/colors/" + selectedColor + ".css");
    
            // Save the selected color to localStorage
            localStorage.setItem("selectedColor", selectedColor);
            
            return false;
        });
    }

	$(document).ready(function() {
		// Contact form AJAX submission
		$('#contact-form').on('submit', function(e) {
			e.preventDefault();
	
			$.ajax({
				type: 'POST',
				url: 'send_email.php',
				data: $(this).serialize(),
				dataType: 'json',
				success: function(response) {
					if (response.status === 'success') {
						$('.msg-success').show().text(response.message);
						$('.msg-failed').hide();
					} else {
						$('.msg-failed').show().text(response.message);
						$('.msg-success').hide();
					}
				},
				error: function() {
					$('.msg-failed').show().text("Something went wrong, please try again later.");
					$('.msg-success').hide();
				}
			});
		});
	});
	

    $(window).on("load", function() {
        isotopeMasonry();

        $(".preloader").addClass("active");
        setTimeout(function () {
            $(".preloader").addClass("done");
        }, 1000);
    });

})(jQuery);
