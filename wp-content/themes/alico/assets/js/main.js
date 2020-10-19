;(function ($) {

    "use strict";

    /* ===================
     Page reload
     ===================== */
    var scroll_top;
    var window_height;
    var window_width;
    var scroll_status = '';
    var lastScrollTop = 0;
    $(window).on('load', function () {
        $(".ct-loader").fadeOut("slow");
        window_width = $(window).width();
        alico_col_offset();
        alico_header_sticky();
        alico_scroll_to_top();
        alico_quantity_icon();
        alico_footer_fixed();
        $('.ct-image-animate').addClass('active');
    });
    $(window).on('resize', function () {
        window_width = $(window).width();
        alico_col_offset();
        alico_footer_fixed();
    });

    $(window).on('scroll', function () {
        scroll_top = $(window).scrollTop();
        window_height = $(window).height();
        window_width = $(window).width();
        if (scroll_top < lastScrollTop) {
            scroll_status = 'up';
        } else {
            scroll_status = 'down';
        }
        lastScrollTop = scroll_top;
        alico_header_sticky();
        alico_scroll_to_top();
    });

    $(document).on('click', '.h-btn-search', function () {
        $('.ct-modal-search').addClass('open');
        $('body').addClass('ov-hidden');
        setTimeout(function(){
            $('.ct-modal-search .search-field').focus();
        },1000);
    });

    $(document).ready(function () {

        /* =================
         Menu Dropdown
         =================== */
        var $menu = $('.ct-main-navigation');
        $menu.find('.ct-main-menu li').each(function () {
            var $submenu = $(this).find('> ul.sub-menu');
            if ($submenu.length == 1) {
                $(this).hover(function () {
                    if ($submenu.offset().left + $submenu.width() > $(window).width()) {
                        $submenu.addClass('back');
                    } else if ($submenu.offset().left < 0) {
                        $submenu.addClass('back');
                    }
                }, function () {
                    $submenu.removeClass('back');
                });
            }
        });

        /* =================
         Menu Mobile
         =================== */
        $('.ct-main-navigation li.menu-item-has-children').append('<span class="ct-menu-toggle far fac-angle-down"></span>');
        $('.ct-menu-toggle').on('click', function () {
            $(this).toggleClass('toggle-open');
            $(this).parent().find('> .sub-menu').toggleClass('submenu-open');
            $(this).parent().find('> .sub-menu').slideToggle();
        });
        
        $("#ct-menu-mobile .open-menu").on('click', function () {
            $(this).toggleClass('opened');
            $('.ct-header-navigation').toggleClass('navigation-open');
        });

        $(".ct-menu-close").on('click', function () {
            $(this).parents('.header-navigation').removeClass('navigation-open');
            $('.ct-menu-overlay').removeClass('active');
            $('#ct-menu-mobile .open-menu').removeClass('opened');
            $('body').removeClass('ovhidden');
        });

        $(".ct-menu-overlay").on('click', function () {
            $(this).parents('#header-main').find('.header-navigation').removeClass('navigation-open');
            $(this).removeClass('active');
            $('#ct-menu-mobile .open-menu').removeClass('opened');
            $('.header-navigation').removeClass('navigation-open');
            $('body').removeClass('ovhidden');
        });

        /* ===================
         Search Toggle
         ===================== */
        $('.h-btn-form').click(function (e) {
            e.preventDefault();
            $('.ct-modal-contact-form').removeClass('remove').toggleClass('open');
        });
        $('.ct-close').click(function (e) {
            e.preventDefault();
            $(this).parents('.ct-widget-cart-wrap').removeClass('open');
            $(this).parents('.ct-modal').addClass('remove').removeClass('open');
            $(this).parents('#page').find('.site-overlay').removeClass('open');
            $(this).parents('body').removeClass('ov-hidden');
        });

        $('.ct-hidden-sidebar-overlay, .ct-widget-cart-overlay').click(function (e) {
            e.preventDefault();
            $(this).parent().toggleClass('open');
            $(this).parents('body').removeClass('ov-hidden');
        });

        /* Video 16:9 */
        $('.entry-video iframe').each(function () {
            var v_width = $(this).width();

            v_width = v_width / (16 / 9);
            $(this).attr('height', v_width + 35);
        });

        /* Video Light Box */
        $('.ct-video-button, .btn-video, .slider-video').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
        
        /* ====================
         Scroll To Top
         ====================== */
        $('.scroll-top').click(function () {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });

        /* =================
        Add Class
        =================== */
        $('.wpcf7-select').parent().addClass('wpcf7-menu');
        

        /* =================
         The clicked item should be in center in owl carousel
         =================== */
        var $owl_item = $('.owl-active-click');
        $owl_item.children().each(function (index) {
            $(this).attr('data-position', index);
        });
        $(document).on('click', '.owl-active-click .owl-item > div', function () {
            $owl_item.trigger('to.owl.carousel', $(this).data('position'));
        });

        /* Select */
        $('select').each(function () {
            $(this).niceSelect();
        });

        /* Newsletter */
        $('.widget_newsletterwidget, form.newsletter').each(function () {
            var email_text = $(this).find('.tnp-field-email label').text();
            $(this).find('.tnp-field-email label').remove();
            $(this).find(".tnp-email").each(function (ev) {
                if (!$(this).val()) {
                    $(this).attr("placeholder", email_text);
                }
            });
            var firstname_text = $(this).find('.tnp-field-firstname label').text();
            $(this).find('.tnp-field-firstname label').remove();
            $(this).find(".tnp-firstname").each(function (ev) {
                if (!$(this).val()) {
                    $(this).attr("placeholder", firstname_text);
                }
            });
            var lastname_text = $(this).find('.tnp-field-lastname label').text();
            $(this).find('.tnp-field-lastname label').remove();
            $(this).find(".tnp-lastname").each(function (ev) {
                if (!$(this).val()) {
                    $(this).attr("placeholder", lastname_text);
                }
            });
        });

        /* Search */
        $('.ct-modal-close').on('click', function () {
            $(this).parent().removeClass('open');
            $(this).parents('body').removeClass('ov-hidden');
        });
        $(document).on('click', function (e) {
            if (e.target.className == 'ct-modal ct-modal-search open')
                $('.ct-modal-search').removeClass('open');
            if (e.target.className == 'ct-hidden-sidebar open')
                $('.ct-hidden-sidebar').removeClass('open');
        });

        /* Hidden Sidebar */
        $(".h-btn-sidebar").on('click', function (e) {
            e.preventDefault();
            $('.ct-hidden-sidebar-wrap').toggleClass('open');
            $(this).parents('body').addClass('ov-hidden');
        });

        $(".ct-hidden-close").on('click', function (e) {
            e.preventDefault();
            $(this).parents('.ct-hidden-sidebar-wrap').removeClass('open');
            $(this).parents('body').removeClass('ov-hidden');
        });

        /* Cart Sidebar */
        $(".h-btn-cart, .btn-nav-cart").on('click', function (e) {
            e.preventDefault();
            $('.ct-widget-cart-wrap').toggleClass('open');
            $('.ct-header-navigation').removeClass('navigation-open');
            $('#ct-menu-mobile .open-menu').removeClass('opened');
            $(this).parents('body').addClass('ov-hidden');
        });

        /* Year Copyright */
        var _year_footer = $(".ct-footer-year"),
            _year_clone = _year_footer.parents(".site").find('.ct-year');
        _year_clone.after(_year_footer.clone());
        _year_footer.remove();
        _year_clone.remove();

        /* Comment Reply */
        $('.comment-reply a').append( '<i class="fa fa-angle-right"></i>' );

        /* Widget Menu */
        $('.ct-navigation-menu1.default a').append( '<i class="fac fac-angle-right"></i>' );

        /* Nav Slider */
        setTimeout(function () {
            $('.revslider-initialised').each(function () {
                $(this).find('.ct-slider-nav .slider-nav-right').on('click', function () {
                    $(this).parents('.revslider-initialised').find('.tp-rightarrow').trigger('click');
                });
                $(this).find('.ct-slider-nav .slider-nav-left').on('click', function () {
                    $(this).parents('.revslider-initialised').find('.tp-leftarrow').trigger('click');
                });
            });
            $('.ct-slider-nav').parents('.revslider-initialised').find('.tparrows').addClass('arrow-hidden');
        }, 300);

        /* Icon Form */
        setTimeout(function () {
            $('.input-filled').each(function () {
                var icon_input = $(this).find(".input-icon"),
                    control_wrap = $(this).find('.wpcf7-form-control');
                control_wrap.before(icon_input.clone());
                icon_input.remove();
            });
        }, 200);

        /* Same Height */
        $('.same-height').matchHeight();

        /* Demo Bar */
        $(".choose-demo").on('click', function () {
            $(this).parents('.ct-demo-bar').toggleClass('active');
        });

        /* Animate Time */
        $('.animate-time').each(function () {
            var eltime = 100;
            var elt_inner = $(this).children().length;
            var _elt = elt_inner - 1;
            $(this).find('> .grid-item > .wow').each(function (index, obj) {
                $(this).css('animation-delay', eltime + 'ms');
                if (_elt === index) {
                    eltime = 100;
                    _elt = _elt + elt_inner;
                } else {
                    eltime = eltime + 80;
                }
            });
        });

        /* Pricing */
        $('.ct-pricing-body').each(function () {
            $(this).find('.item--first').hover(function () {
                $(this).parent().addClass('item--first-active');
            }, function () {
                $(this).parent().removeClass('item--first-active');
            });
            $(this).find('.item--last').hover(function () {
                $(this).parent().addClass('item--last-active');
            }, function () {
                $(this).parent().removeClass('item--last-active');
            });
        });

        $(".item--nav").on('click', function () {
            $(this).parent().toggleClass('active');
            $(this).parents('.ct-pricing').find('.ct-pricing-monthly').toggleClass('pr-hide');
            $(this).parents('.ct-pricing').find('.ct-pricing-year').toggleClass('pr-active');
        });

        /* Cover Boxes */
        $('body:not(.elementor-editor-active) .ct-cover-boxes1 .ct-cover-item').each(function () {
            $(this).hover(function () {
                $(this).parents('.ct-cover-boxes1').find('.ct-cover-item').removeClass('active');
                $(this).addClass('active');
            });
        });

        /* Overlay particle */
        $('.ctf-author-box-link').removeAttr('target');

        setTimeout(function(){
            $('.elementor-section-wrap > .elementor-element').each(function () {
                var _el_image = $(this).find(".ct-image-animate"),
                    _row_image = _el_image.parents(".elementor-container");
                _row_image.before(_el_image.clone());
                _el_image.remove();

                var _el_text = $(this).find(".ct-text"),
                    _row_text = _el_text.parents(".elementor-container");
                _row_text.before(_el_text.clone());
                _el_text.remove();
            });
        }, 200);

        /* Blog */
        $( ".ct-blog-grid-layout1 .grid-item-inner" ).hover(
          function() {
            $( this ).find('.entry-readmore').slideToggle(300);
            $( this ).find('.entry-meta').slideToggle(300);
          }, function() {
            $( this ).find('.entry-readmore').slideToggle(300);
            $( this ).find('.entry-meta').slideToggle(300);
          }
        );

        /* Range Slider */
        $('.wpcf7-form').each(function () {
            var range = $(this).find('.ct-range-slider');
            var range_value = $(this).find('.ct-range-slider').attr('data-value');
            var range_maxvalue = $(this).find('.ct-range-slider').attr('data-maxvalue');
            var range_currency = $(this).find('.ct-range-slider').attr('data-currency');
            $(this).find( ".ct-range-slider" ).slider({
                range: "min",
                value: range_value,
                min: 1,
                max: range_maxvalue,
                slide: function( event, ui ) {
                    $(this).parent().find( ".ct-range-result" ).val( range_currency + ui.value );
                }
            });
            $(this).find( ".ct-range-result" ).val( range_currency + $(this).find( ".ct-range-slider" ).slider( "value" ) );
        });

        /* Pricing */
        $(".ct-pricing-tab-active .ct-pricing-tab-item").on('click', function () {
            $(this).parent().find('.ct-pricing-tab-item').removeClass('active');
            $(this).addClass('active');
        });
        $(".ct-pricing-tab-active .title-tab-monthly").on('click', function () {
            $(this).parents('.ct-pricing').find('.ct-pricing-monthly').removeClass('ct-pricing-hide');
            $(this).parents('.ct-pricing').find('.ct-pricing-year').addClass('ct-pricing-hide');
        });
        $(".ct-pricing-tab-active .title-tab-year").on('click', function () {
            $(this).parents('.ct-pricing').find('.ct-pricing-year').removeClass('ct-pricing-hide');
            $(this).parents('.ct-pricing').find('.ct-pricing-monthly').addClass('ct-pricing-hide');
        });

        /* Team */
        $('.item--social-btn').on('click', function () {
            $(this).toggleClass('active');
            $(this).parent().toggleClass('active');
        });

        /* Service */
        $( ".ct-service-grid4 .grid-item-inner" ).hover(
          function() {
            $( this ).find('.item-readmore').slideToggle(300);
          }, function() {
            $( this ).find('.item-readmore').slideToggle(300);
          }
        );

    });

    function alico_header_sticky() {
        var offsetTop = $('#ct-header-wrap').outerHeight();
        var h_header = $('.fixed-height').outerHeight();
        var offsetTopAnimation = offsetTop + 200;
        if($('#ct-header-wrap').hasClass('is-sticky')) {
            if (scroll_top > offsetTopAnimation) {
                $('#ct-header').addClass('h-fixed');
            } else {
                $('#ct-header').removeClass('h-fixed');   
            }
        }
        if (window_width > 992) {
            $('.fixed-height').css({
                'height': h_header
            });
        }
        if (scroll_status == 'up' && scroll_top > 0) {
            $('#ct-header').addClass('scroll-up');
        } else {
            $('#ct-header').removeClass('scroll-up');
        }
        if (scroll_status == 'down') {
            $('#ct-header').addClass('scroll-down');
        } else {
            $('#ct-header').removeClass('scroll-down');
        }
    }

    /* =================
     Column Offset
     =================== */
    function alico_col_offset() {
        var w_vc_row_lg = ($('#content').width() - 1200) / 2;
        if (window_width > 1200) {
            $('body:not(.rtl) .col-offset-left > .elementor-column-wrap > .elementor-widget-wrap').css('padding-left', w_vc_row_lg + 'px');
            $('body:not(.rtl) .col-offset-right > .elementor-column-wrap > .elementor-widget-wrap').css('padding-right', w_vc_row_lg + 'px');

            $('.rtl .col-offset-left > .elementor-column-wrap > .elementor-widget-wrap').css('padding-right', w_vc_row_lg + 'px');
            $('.rtl .col-offset-right > .elementor-column-wrap > .elementor-widget-wrap').css('padding-left', w_vc_row_lg + 'px');
        }
    }

    /* =================
     Footer Fixed
     =================== */
    function alico_footer_fixed() {
        setTimeout(function(){
            var h_footer = $('.fixed-footer .site-footer-custom').outerHeight() - 1;
            $('.fixed-footer .site-content').css('margin-bottom', h_footer + 'px');
        }, 300);
    }

    /* ====================
     Scroll To Top
     ====================== */
    function alico_scroll_to_top() {
        if (scroll_top < window_height) {
            $('.scroll-top').addClass('off').removeClass('on');
        }
        if (scroll_top > window_height) {
            $('.scroll-top').addClass('on').removeClass('off');
        }
    }

    /* ====================
     WooComerce Quantity
     ====================== */
    function alico_quantity_icon() {
        $('#content .quantity').append('<span class="quantity-icon"><i class="quantity-down fa fa-sort-desc"></i><i class="quantity-up fa fa-sort-asc"></i></span>');
        $('.quantity-up').on('click', function () {
            $(this).parents('.quantity').find('input[type="number"]').get(0).stepUp();
        });
        $('.quantity-down').on('click', function () {
            $(this).parents('.quantity').find('input[type="number"]').get(0).stepDown();
        });
        $('.woocommerce-cart-form .actions .button').removeAttr('disabled');
    }

    $( document ).ajaxComplete(function() {
       alico_quantity_icon();
    });

})(jQuery);
