/* globals $:false */
var width = $(window).width(),
    height = $(window).height(),
    pslide, hslide,
    isMobile = false;
$(function() {
    var app = {
        init: function() {
            jQuery(document).ready(function($) {
                var $opening = $('.opening');
                var $menu = $('header nav.primary');
                $opening.click(function(event) {
                    $(this).fadeOut(500);
                });
                if ($(".wrap").hasClass('category')) {
                    $("body").mousewheel(function(event, delta) {
                        this.scrollLeft -= (delta);
                        event.preventDefault();
                    });
                    $menu.addClass('reduced');
                }
                $(window).load(function() {
                 app.sizeSet();
                app.sliders();
                });
                
                $('#mce-error-response, #mce-success-response').bind("DOMSubtreeModified", function() {
                    $('form.validate .mc-field-group').hide();
                });
                $fsCloseBtn = $('.fullscreen.close');
                $('.fullscreen.open').click(function(event) {
                    pslide.enterFullscreen();
                    $fsCloseBtn.show();
                });
                $('.fullscreen.close').click(function(event) {
                    pslide.exitFullscreen();
                    $fsCloseBtn.hide();
                });
                $('.project .inner').click(function(event) {
                    window.location = $(this).data('target');
                });
                $('.project .inner').hover(function() {
                  $menu.css('opacity', 0);
                }, function() {
                  $menu.css('opacity', 1);
                });
                $('.overview').click(function(event) {
                    $(this).toggleClass('active');
                    $('.category.wrap').toggleClass('list index');
                });
                // $('.link').click(function() {
                //     event.preventDefault();
                //     newLocation = this.href;
                //     if ($(this).is('.logo')) {
                //         if (isMobile) {
                //             $('nav.mobile').toggleClass('is-visible');
                //         } else {
                //             $('header').removeClass('reduced');
                //             setTimeout(function() {
                //                 $('#container').fadeOut(300, newpage);
                //             }, 600);
                //         }
                //     } else if ($(this).is('.home .link:not(".logo")')) {
                //         $('header').addClass('reduced');
                //         setTimeout(function() {
                //             $('#container').fadeOut(300, newpage);
                //         }, 600);
                //     } else {
                //         newpage();
                //     }
                // });
            });
            $(window).resize(function(event) {
                app.sizeSet();
            });
        },
        sizeSet: function() {
            width = $(window).width();
            height = $(window).height();
            if (width <= 1100) {
                isMobile = true;
            } else {
                isMobile = false;
            }
        },
        createCookie: function(name, value, minutes) {
            var date = new Date();
            date.setTime(date.getTime() + (minutes * 60 * 1000));
            $.cookie(name, value, {
                expires: date
            });
        },
        sliders: function() {
            jQuery.rsCSS3Easing.codemm = 'cubic-bezier(0.305, 0.000, 0.210, 1.000)';
            $(".projectslider.royalSlider").royalSlider({
                //autoScaleSlider: true,
                //imageScalePadding: 60,
                //autoScaleSlider: true,
                transitionSpeed: 500,
                controlNavigation: 'thumbnails',
                usePreloader: false,
                loop: true,
                thumbs: {
                    spacing: 20,
                    arrowsAutoHide: true
                }
            });
            pslide = $(".projectslider.royalSlider").data('royalSlider');
            $('.rsNav').before($('.fullscreen.open'));
            $(".loader").fadeOut("fast");
            $("#container").css('opacity', '1');
        }
    };
    app.init();
});

function rand(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function arrayRand(myArray) {
    var rand = myArray[Math.floor(Math.random() * myArray.length)];
    return rand;
}

function newpage() {
    window.location = newLocation;
}