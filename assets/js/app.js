/* globals $:false */
var width = $(window).width(),
    height = $(window).height(),
    $body,
    pslide, hslide,
    isMobile = false;
$(function() {
    var app = {
        init: function() {
            jQuery(document).ready(function($) {
                $body = $('body');
                var $opening = $('.opening');
                var $menu = $('header nav.primary');
                $opening.click(function(event) {
                    $(this).addClass('closed');
                });
                if ($(".wrap").hasClass('category')) {
                    $("html, body").mousewheel(function(event, delta) {
                        this.scrollLeft -= (delta);
                        event.preventDefault();
                    });
                }
                $(window).load(function() {
                    app.sizeSet();
                    app.deferImages();
                    $(".loader").fadeOut("fast");
                    $("#container").css('opacity', '1');
                    app.sliders();
                });
                $('#mce-error-response, #mce-success-response').bind("DOMSubtreeModified", function() {
                    $('form.validate .mc-field-group').hide();
                });
                $('.wrap.category.list .project .inner').hover(function() {
                    $menu.css('opacity', 0);
                }, function() {
                    $menu.css('opacity', 1);
                });
                $('.overview').click(function(event) {
                    $(this).toggleClass('active');
                    $('body').toggleClass('indexOpened');
                });
                $('.link').click(function(event) {
                    event.preventDefault();
                    newLocation = this.href;
                    el = $(this);
                    console.log(el);
                    if (el.is('nav.primary .category a')) {
                        $menu.find('.category').removeClass('active');
                        el.parent().addClass('active');
                        $("header").addClass('reduced');
                        setTimeout(function() {
                            $('#container').fadeOut(300, newpage);
                        }, 500);
                    } else if (el.is('.inner')) {
                        app.loadContent(el.data('target') + '/ajax', $('.ajax'));
                        history.pushState('project', null, el.data('target'));
                    } else {
                        newpage();
                    }
                });
                window.addEventListener('popstate', function(e) {
                    var page = e.state;
                    console.log(page);
                    if (page == null) {
                        $('.ajax').addClass('hidden');
                        $body.removeClass('project');
                    } else {
                        app.loadContent(el.data('target') + '/ajax', $('.ajax'));
                    }
                });
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
            $fsCloseBtn = $('.fullscreen.close');
            $('.fullscreen.open').on("click", function(event) {
                pslide.enterFullscreen();
                $fsCloseBtn.show();
            });
            $('.fullscreen.close').on("click", function(event) {
                pslide.exitFullscreen();
                $fsCloseBtn.hide();
            });
            $('.ajax .index-btn a').click(function(event) {
                event.preventDefault();
                history.pushState(null, null, $(this).attr('href'));
                $('.ajax').addClass('hidden');
                $body.removeClass('project');
            });
            if (pslide) {
                pslide.ev.on('rsAfterContentSet', function() {
                    pslide.updateThumbsSize();
                    $('.ajax').removeClass('hidden');
                    $body.addClass('project');
                });
            }
        },
        loadContent: function(url, target) {
            $.ajax({
                url: url,
                success: function(data) {
                    $(target).html(data);
                    app.sliders();
                }
            });
        },
        deferImages: function() {
            var imgDefer = document.getElementsByTagName('img');
            for (var i = 0; i < imgDefer.length; i++) {
                if (imgDefer[i].getAttribute('data-src')) {
                    imgDefer[i].setAttribute('src', imgDefer[i].getAttribute('data-src'));
                }
            }
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