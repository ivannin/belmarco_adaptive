jQuery(function($){
/*$(window).resize(function () {
    var windowWidth = $(window).width();

    if (windowWidth > 720) {

        if ($(".tabs-info").is(':visible')) {
            var tab = $(".tab:first")
            tabWork(tab);
        }
    }

});*/

$(document).keydown(function (e) {
    switch (e.keyCode) {
        case 27:
            $('.infoblock').infoBlock('close');
            break;
    }
});

$(document).ready(function () {

    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) { // код для мобильных устройств
        $(".kind-btn").click(function () {
            element = $(this);
            showBlock(element);
        });
    } else {
        $(".kind-btn").mouseenter(function () {
            element = $(this);
            showBlock(element);
        });
    }

    $(".kind-popup .close-btn").click(function () {
        hideBlock();
    });

    $(".type .open-popup-type").click(function () {

        var text = $(this).attr("data-text");
        var cost = $(this).attr("data-cost");
        var sourceDescription = $(this).attr('data-source-description');
        var yaTarget = $(this).attr('data-yatarget');
        $("#tab-link").click();
        $("#popup-type .text-block").empty().html(text);
        $(".price .summa").empty().append(cost);
        $("#sourceDescriptionProduct").val(sourceDescription);
        $("#popup-type .wpcf7-submit").attr('data-yatarget', yaTarget);
        $("#popup-type .bitrix-utm").val(yaTarget);
        $("#popup-type .utm_region").val(region);
    });

    if ($(".tabs-info").is(':visible')) {
        var tab = $(".tab:first")
        tabWork(tab);
    }


    $(".tab").click(function () {
        var tab = $(this);
        tabWork(tab);
    });

    $('.open-popup-type').magnificPopup({
        type: 'inline',
        midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
    });

    $('.popup-youtube').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        preloader: false
    });


    $('.iframe-popup').magnificPopup({
        type: 'iframe'
    });
    $('.slider .image-popup').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        },
        gallery: {
            enabled: true
        }

    });

    $('.slider1 .image-popup').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        },
        gallery: {
            enabled: true
        }

    });
    $('.slider2 .image-popup').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        },
        gallery: {
            enabled: true
        }

    });
    $('.slider3 .image-popup').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        },
        gallery: {
            enabled: true
        }
    });

    $('.slider4 .image-popup').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        },
        gallery: {
            enabled: true
        }

    });
    $('.slider5 .image-popup').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        },
        gallery: {
            enabled: true
        }

    });
    $('.slider6 .image-popup').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        },
        gallery: {
            enabled: true
        }
    });
    $('.slider7 .image-popup').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        },
        gallery: {
            enabled: true
        }
    });
    $('.sert-block .image-popup').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        },
        gallery: {
            enabled: true
        }
    });

    $(".close-info").click(function () {
        $('.infoblock').infoBlock('close');
    });

    $('.slider1').slick({
        infinite: false,
        centerPadding: '60px',
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        responsive: [
            {
                breakpoint: 728,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.slider2').slick({
        infinite: true,
        centerPadding: '60px',
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        responsive: [
            {
                breakpoint: 720,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    adaptiveHeight: true
                }
            }
        ]
    });

    $('.slider3').slick({
        infinite: true,
        centerPadding: '60px',
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        responsive: [
            {
                breakpoint: 720,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    $('.slider4').slick({
        infinite: false,
        centerPadding: '60px',
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        responsive: [
            {
                breakpoint: 728,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.slider5').slick({
        infinite: true,
        centerPadding: '60px',
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        responsive: [
            {
                breakpoint: 720,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    adaptiveHeight: true
                }
            }
        ]
    });

    $('.slider6').slick({
        infinite: true,
        centerPadding: '60px',
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        responsive: [
			{
				breakpoint: 1181,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1
			  }
			},
			{
                breakpoint: 720,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    $('.slider7').slick({
        infinite: true,
        centerPadding: '60px',
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        responsive: [
            {
                breakpoint: 720,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    function tabWork(tab) {
        $(".tab").removeClass("active");
        var text = tab.attr("data-text");
        var cost = tab.attr("data-cost");
        var imgSrc = tab.attr("data-image");
        var sourceDescription = tab.attr("data-source-description");
        tab.addClass("active");
        if ($(".tabs-info").is(':visible')) {
            $(".tabs-info .text-block").empty().html(text);
            $(".tabs-info .image-block img").attr("src", imgSrc);
            $(".tabs-info .price .sum").empty().append(cost);
            $(".tabs-info #sourceDescriptionProduct").val(sourceDescription);
        } else {
            $("#tab-link").click();
            $("#popup-type .text-block").empty().html(text);
            $(" .price .sum").empty().append(cost);
            $(".tabs-info #sourceDescriptionProduct").val(sourceDescription);
        }

    }


    function showBlock(element) {
        /*    $(".kind").removeClass("active");
         element.parent().addClass("active");
         $(".kind-popup").fadeOut('fast');
         element.parent().find(".kind-popup").fadeIn('fast');
         var scroll_el = element.attr('href');
         if ($(scroll_el).length != 0) {
         $('html, body').animate({ scrollTop: $(scroll_el).offset().top - 145 }, 500);
         }*/

        $(".kind").removeClass("active");
        element.parent().addClass("active");
        $(".kind-popup").fadeOut('fast');
        $(".kind-popup .text-block").empty();
        var text = element.parent().attr("data-text");
        $(".kind-popup .text-block").html(text);
        $(".kind-popup").fadeIn('fast');
        var scroll_el = element.attr('href');

        if ($(scroll_el).length != 0) {
            $('html, body').animate({scrollTop: $(scroll_el).offset().top - 145}, 500);
        }

    }

    jQuery('.block-1 form .wpcf7-submit').click(function(){
        yaCounter30789032.reachGoal('skidka_km'); 
        return true;
    });
    jQuery('.block-4 form .wpcf7-submit').click(function(){
        yaCounter30789032.reachGoal('voprosy_km'); 
        return true;
    });
    jQuery('#popup-type form .wpcf7-submit').click(function(){
        yaCounter30789032.reachGoal($(this).attr('data-yatarget')); 
        return true;
    });
    jQuery('#call form .wpcf7-submit').click(function(){
        yaCounter30789032.reachGoal('podbor_km'); 
        return true;
    });
    jQuery('#block-7 form .wpcf7-submit').click(function(){
        yaCounter30789032.reachGoal('dop_km'); 
        return true;
    });
    jQuery('#block-8 form .wpcf7-submit').click(function(){
        yaCounter30789032.reachGoal('dostavka_km'); 
        return true;
    });
    jQuery('#block-12 form .wpcf7-submit').click(function(){
        yaCounter30789032.reachGoal('ostvoprosy_km'); 
        return true;
    });
    /*function hideBlock() {
        $(".kind").removeClass("active");
        $(".kind-popup").fadeOut();

    }

    var _target = '', $button = [];
    $('form').ajaxForm({
        beforeSubmit: function (d, $e) {
            if (!$e.hasClass('dis')) {

                $button[0] = $e.find('.submit');
                $button[1] = $e.find('.submit').text();

                $e.addClass('dis');

                var emailReg = new RegExp("^[-0-9a-z\._]+\@[-0-9a-z\.]+\.[a-z]{2,4}$", "i");

                for (var j in d) {

                    if (d[j].name == 'target') {
                        _target = d[j].value;
                    }

                    if (d[j].name == 'phone' && d[j].value == "") {
                        $e.removeClass('dis').find('input[name="phone"]').addClass('err-form');
                        $('.infoblock').infoBlock('err', 'Пожалуйста, укажите Ваш телефон.');
                        return false;
                    }
                }

                return true;
            } else return false;
        },

        success: function (data) {
            $("#thks").click();
        }
    });

})

$.fn.extend({
    infoBlock: function (command, content) {
        if (command == 'err') $(this).addClass('err');
        else $(this).removeClass('err');

        if (command == 'close') {
            $(this).css({'opacity': '0', 'top': '-20px'});
        } else {
            $(this).css({'opacity': '1', 'top': '0px'})
                .find('span')
                .html(content);
        }
    }

});

*/
	
});

	
});



