/* globals $:false */
var width = $(window).width(),
    height = $(window).height(),
    $body,
    pslide, hslide,
    isMobile = false,
    isScrolling = false;
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
                if (!$.cookie("intro")) {
                    app.createCookie('intro', 'seen', 120);
                }
                if ($(".wrap").hasClass('category')) {
                    $index = $('.category.index');
                    $("html, body").on('mousewheel', function(event, delta) {
                        if ($body.hasClass('indexClosed')) {
                            this.scrollLeft -= (delta);
                            event.preventDefault();
                        } else if (!isMobile) {
                            event.preventDefault();
                            
                            var dir = event.deltaY > 0 ? 'up' : 'down',
                                vel = Math.abs(event.deltaY);
                                var currentS = $index.scrollTop();

                            if (dir == 'up' && !isScrolling && vel > 5) {
                                $($index).scrollTo(currentS - height, 800);
                                isScrolling = true;
                                setTimeout(function() {
                                    isScrolling = false;
                                }, 900);
                            }
                            if (dir == 'down' && !isScrolling && vel > 5) {
                                $($index).scrollTo(currentS + height, 800);
                                isScrolling = true;
                                setTimeout(function() {
                                    isScrolling = false;
                                }, 900);
                            }
                            //return false;
                        }
                    });
                }
                if ($("header").hasClass('category')) {
                    $("#container").css('opacity', '1');
                }
                $(window).load(function() {
                    app.sizeSet();
                    app.sliders();
                    $("#container").css('opacity', '1');
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
                    $('body').toggleClass('indexClosed');
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
                $('body').on('click', '.ajax .index-btn a', function(event) {
                    event.preventDefault();
                    app.goIndex();
                });
                //ESC
                $(document).keyup(function(e) {
                    if (e.keyCode === 27) app.goIndex();
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
            if (pslide) {
                pslide.ev.on('rsAfterContentSet', function() {
                    pslide.updateThumbsSize();
                    $('.ajax').removeClass('hidden');
                    $body.addClass('project');
                    setTimeout(function() {
                        $('.loader').removeClass('loading');
                    }, 600);
                });
            }
        },
        goIndex: function() {
            history.pushState(null, null, $(this).attr('href'));
            $('.ajax').addClass('hidden');
            $body.removeClass('project');
        },
        loadContent: function(url, target) {
            $('.loader').addClass('loading');
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