jQuery( document ).ready( function() {
  jQuery( '.related_count' ).on( 'pointerdown', function( e ) { e.stopPropagation() } );
  if ( typeof region != "undefined" ) {
    jQuery( '.currentLocation' ).val( region );
    jQuery( ".utm_region" ).val( region );
  }
  jQuery( "form.checkout.woocommerce-checkout" ).on( 'submit', function() {
    yaCounter30789032.reachGoal( 'zakaz_krovat' );
  } );
  jQuery( "#dealers_top .wpcf7-submit" ).click( function( event ) {
    var phone = jQuery( "#dealers_top #txt-tel" ).val();
    if ( phone.length > 0 ) {
      return true;
    }
    if ( jQuery( ".dealers-radio input:radio:checked" ).length === 0 ) {
      return false;
    }
    var choosenInput = jQuery( '#dealers_top input:checked' );
    jQuery( '#dealers_top #form_title' ).html( choosenInput.data( 'title' ) );
    jQuery( '#dealers_top input[name="client"]' ).val( choosenInput.val() );
    jQuery( '#dealers_top input[name="info"]' ).val( choosenInput.data( 'title' ) );
    jQuery( this ).val( choosenInput.data( 'button' ) );
    jQuery( '#dealers_top .dealers-radio' ).hide();
    jQuery( '#dealers_top .wpcf7-tel' ).show();
    return false;
  } );
  jQuery( ".reserv #get-code" ).click( function( event ) {
    var phone = jQuery( this ).parent().parent().find( '#txt-tel' ).val();
    if ( phone.length === 0 ) {
      jQuery( this ).parent().parent().find( '#txt-tel' ).css( { 'border-color': '#cd1124' } );
      event.preventDefault();
      return false;
    }
    jQuery( this ).parent().parent().find( '#otp-code' ).removeClass( 'hidden' );
    jQuery( this ).parent().parent().find( '#tel' ).addClass( 'hidden' );
    jQuery( this ).val( 'Зарезервировать' );
    var otp_code = jQuery.cookie( "otp_code" );
    if ( otp_code == "null" ) {
      var n = 10000;
      var m = 99999;
      otp_code = Math.floor( Math.random() * ( n - m + 1 ) ) + m;
      jQuery.cookie( "otp_code", otp_code );
      var data1 = {
        'action': 'sms_sending',
        'phone': phone,
        'otp_code': otp_code,
      };
      jQuery.ajax( {
        url: MyAjax.my_ajaxurl, // обработчик
        data: data1, // данные
        type: 'POST', // тип запроса
        success: function( result ) {}
      } );
      event.preventDefault();
      return false;
    }
    if ( jQuery( this ).parent().parent().find( 'input#otp-input' ).val() != otp_code ) {
      jQuery( this ).parent().parent().find( 'input#otp-input' ).css( { 'border-color': '#cd1124' } );
      event.preventDefault();
      return false;
    }
    jQuery.cookie( "otp_code", null );
    yaCounter30789032.reachGoal( 'rezerv' );
  } );
  jQuery( '#get_sale' ).click( function() {
    yaCounter30789032.reachGoal( 'priz' );
  } )
  jQuery( '#comments_loadmore' ).click( function() {
    jQuery( '#comments_loadmore' ).text( 'Загружаю...' ); // изменяем текст кнопки, вы также можете добавить прелоадер
    var data = {
      'action': 'load_more_comments',
      'comments_per_page': comments_per_page,
      'page': current_page,
      'meta_key': meta_key,
      'meta_value': meta_value,
      'post_id': post_id
    };
    jQuery.ajax( {
      url: MyAjax.my_ajaxurl, // обработчик
      data: data, // данные
      type: 'POST', // тип запроса
      success: function( data ) {
        if ( data ) {
          jQuery( '.wrap_content' ).append( data ); // вставляем новые посты
          if ( current_page == max_pages ) {
            jQuery( '#comments_loadmore' ).remove(); // если последняя страница, удаляем кнопку
          } else {
            current_page++; // увеличиваем номер страницы на единицу
            jQuery( '#comments_loadmore' ).text( 'Показать еще отзывы' );
          }
        } else {
          jQuery( '#comments_loadmore' ).remove(); // если мы дошли до последней страницы постов, скроем кнопку
        }
      }
    } );
  } );
  jQuery( '#videoreviews_loadmore' ).click( function() {
    jQuery( '#videoreviews_loadmore' ).text( 'Загружаю...' ); // изменяем текст кнопки, вы также можете добавить прелоадер
    var data = {
      'action': 'load_more_videoreviews',
      'posts_per_page': posts_per_page,
      'page': current_page,
      'meta_key': meta_key,
      'meta_value': meta_value,
    };
    jQuery.ajax( {
      url: MyAjax.my_ajaxurl, // обработчик
      data: data, // данные
      type: 'POST', // тип запроса
      success: function( data ) {
        if ( data ) {
          jQuery( '.video-reviews' ).append( data ); // вставляем новые посты
          if ( ( current_page + 1 ) == max_pages ) {
            jQuery( '#videoreviews_loadmore' ).remove(); // если последняя страница, удаляем кнопку
          } else {
            current_page++; // увеличиваем номер страницы на единицу
            jQuery( '#videoreviews_loadmore' ).text( 'Показать еще отзывы' );
          }
        } else {
          jQuery( '#videoreviews_loadmore' ).remove(); // если мы дошли до последней страницы постов, скроем кнопку
        }
      }
    } );
  } );

  jQuery( "#phone, .wpcf7-tel, input[type='tel'], #billing_phone, .boc_wc_cart_phone" ).mask( "+7 (999) 999-9999" );
  jQuery( '#bestsellers .owl-carousel' ).owlCarousel( {
    loop: false,
    nav: true,
    dots: false,
    margin: 25,
    slideBy: 1,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: true,
      },
      480: {
        items: 2,
        nav: true,
      },
      768: {
        items: 3,
        nav: true,
      },
    }
  } );
  jQuery( '#main_action_products .owl-carousel, #main_hit_products .owl-carousel' ).owlCarousel( {
    loop: false,
    nav: true,
    dots: false,
    margin: 25,
    slideBy: 1,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: false,
      },
      480: {
        items: 2,
        nav: true,
      },
      768: {
        items: 4,
        nav: true,
      },
    }
  } );
  jQuery( '.owl-carousel.comments ' ).owlCarousel( {
    loop: false,
    nav: true,
    dots: false,
    margin: 10,
    slideBy: 1,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: true,
      },
      480: {
        items: 2,
        nav: true,
      },
      768: {
        items: 4,
        nav: true,
      },
    }
  } );
  setTimeout( function() {
    jQuery( '#owl-products-images-mob .owl-carousel.mob' ).trigger( 'destroy.owl.carousel' );
    jQuery( '#owl-products-images-mob .owl-carousel.mob' ).owlCarousel( {
      loop: false,
      nav: true,
      dots: false,
      autoHeight: true,
      autoHeightClass: 'owl-height',
      margin: 10,
      slideBy: 1,
      responsiveClass: true,
      responsive: {
        0: {
          items: 1,
          nav: false,
          dots: true,
        },
        480: {
          items: 1,
          nav: false,
          dots: true,
        },
        768: {
          items: 3,
          nav: true,
        },
      }
    } );
  }, 500 );
  jQuery( '#owl-products-images .owl-carousel' ).owlCarousel( {
    loop: false,
    nav: true,
    dots: false,
    autoHeight: false,
    autoHeightClass: 'owl-height',
    margin: 10,
    slideBy: 1,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: false,
        dots: true,
      },
      480: {
        items: 1,
        nav: false,
        dots: true,
      },
      768: {
        items: 3,
        nav: true,
      },
    }
  } );

  jQuery( '.owl-carousel.products' ).owlCarousel( {
    loop: false,
    nav: true,
    dots: false,
    autoHeight: true,
    autoHeightClass: 'owl-height',
    margin: 10,
    slideBy: 1,
    responsiveClass: true,
    responsive: {
      0: {
        autoHeight: true,
        items: 1,
        nav: false,
        dots: true,
      },
      480: {
        items: 2,
        nav: false,
        dots: true,
      },
      768: {
        items: 4,
        nav: true,
      },
    }
  } );
  jQuery( '.videos.owl-carousel' ).owlCarousel( {
    loop: false,
    nav: true,
    dots: false,
    autoHeight: false,
    autoHeightClass: 'owl-height',
    margin: 10,
    slideBy: 1,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: false,
        dots: true,
      },
      480: {
        items: 2,
        nav: false,
        dots: true,
      },
      768: {
        items: 3,
        nav: true,
      },
    }
  } );
  jQuery( '.tab-list.owl-carousel' ).owlCarousel( {
    loop: false,
    nav: true,
    dots: false,
    autoHeight: false,
    stagePadding: 20,
    autoHeightClass: 'owl-height',
    margin: 20,
    slideBy: 1,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      360: {
        items: 2,
      },
      768: {
        items: 6,
      },
    }
  } );
  /*var totalItems = jQuery('.owl-tags.tags a').length;
  if(totalItems > 5){
    jQuery('.owl-tags.tags').owlCarousel({
      loop: false,
      nav: true,
      dots: false,
      margin: 10,
      slideBy: 1,
      responsiveClass: true,
      responsive:{
        0:{
          items: 1,
          nav: false,
          dots: true,
        },        
        480: {
          items: 3,
          nav: false,
          dots: true,
        },
        768:{
          items: 4,
          nav: true,
        },
      }
    });
  }*/
  jQuery( '.owl-carousel.slider-head' ).owlCarousel( {
    items: 1,
    slideBy: 1,
    nav: false,
    dots: false,
    lazyLoad: true,
    loop: false,
    margin: 10,
    responsive: {
      768: {
        nav: true,
      },
    }
  } );
  jQuery( '.owl-carousel:not(.owl-tags)' ).owlCarousel( {
    loop: false,
    nav: true,
    dots: false,
    autoHeight: false,
    autoHeightClass: 'owl-height',
    margin: 10,
    slideBy: 1,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: true,
      },
      480: {
        items: 2,
        nav: true,
      },
      768: {
        items: 3,
        nav: true,
      },
    }
  } );

  //Обработка фильтра в мобильной версии
  if ( screen.width <= 480 ) {
    jQuery( '#text-4 .widget-title .icon_filter' ).on( 'click', function() {
      if ( jQuery( '#filter-blocks' ).hasClass( 'slideNot' ) ) {
        jQuery( '#filter-blocks' ).slideDown( 500 );
        jQuery( '#filter-blocks' ).removeClass( 'slideNot' );
        jQuery( this ).addClass( 'minus' );
      } else {
        jQuery( '#filter-blocks' ).slideUp( 500 );
        jQuery( '#filter-blocks' ).addClass( 'slideNot' );
        jQuery( this ).removeClass( 'minus' );
      }
    } );
    //Убираем фон баннера
    //jQuery('.banner_block').css('background','');
    //Добавляем стили для баннера на моб устройствах
    jQuery( '.banner_block' ).css( 'background-size', '100%' );
    jQuery( '.banner_block' ).css( 'min-height', '80px' );
    //Перемещение 2 номера вместо соцсетей
    jQuery( ".header_top .socials a" ).remove();
    jQuery( ".header_top .tel a.mob_tel" ).appendTo( ".header_top .socials" );

  }

  //  Обработка меню
  var itemsMenu = jQuery( '#secondary .menu > .menu-item' ).not( '.sub-menu > .menu-item' );
  jQuery( '#secondary .menu .sub-menu' ).css( "display", "none" );
  var itemsMenuHasChild = '#secondary .menu > .menu-item.menu-item-has-children';
  var itemsMenuHasChild_icon = '#secondary .menu > .menu-item.menu-item-has-children .icon';
  jQuery( itemsMenuHasChild ).each( function() {
    jQuery( this ).prepend( '<div class="icon"></div>' );
  } );

  jQuery( itemsMenuHasChild_icon ).on( 'click', function() {
    var subMenu = jQuery( this ).siblings( '.sub-menu' );
    if ( jQuery( subMenu ).css( 'display' ) == 'none' ) {
      subMenu.slideDown( 500 );
      jQuery( this ).parent( '.menu-item.menu-item-has-children' ).addClass( 'minus' );
    } else {
      subMenu.slideUp( 500 );
      jQuery( this ).parent( '.menu-item.menu-item-has-children' ).removeClass( 'minus' );
    }
  } );
  var curItemMenuHasChild = jQuery( '#secondary .menu > .menu-item.menu-item-has-children.current-menu-item' );
  curItemMenuHasChild.addClass( 'minus' ).find( '.sub-menu' ).css( 'display', 'block' );
  var curItemSubMenuHasChild = jQuery( '#secondary .menu > .menu-item.menu-item-has-children .sub-menu .current-menu-item' );
  curItemSubMenuHasChild.parent( '.sub-menu' ).css( 'display', 'block' ).parent().addClass( 'minus' );

  /*Раскрытие фильтра*/
  jQuery( '#secondary .widget.yith-woocommerce-ajax-product-filter:not(".yith-woo-ajax-reset-navigation")' ).each( function() {
    jQuery( this ).prepend( '<div class="icon"></div>' );
    jQuery( this ).find( '.yith-wcan' ).css( 'display', 'none' );
  } );

  function custom_parse_url( url ) {
    var params = {};
    if ( url.match( /.*\?.*/ ) ) {
      var len = '';
      if ( url.match( /&/g ) === null ) {
        len = 0;
      } else {
        len = url.match( /&/g ).length;
      }
      for ( var i = 0; i < len + 1; i++ ) {
        var _tmp = url.replace( /.*\?/, '' )
          .split( '&' )[ i ]
          .split( '=' );
        params[ _tmp[ 0 ] ] = _tmp[ 1 ];
      }
    }
    return params;
  }

  function get_value_key( key_bool, obj ) {
    var res = null;
    for ( var key in obj ) {
      if ( key == key_bool ) {
        res = obj[ key ];
      }
    }
    return res;
  }

  jQuery( '.yith-woocommerce-ajax-product-filter ul li' ).each( function() {
    if ( jQuery( this ).children( 'a' ).length === 0 ) {
      jQuery( this ).remove();
    }
  } );
  jQuery( window ).on( 'yith-wcan-ajax-filtered', function() {
    jQuery( '#secondary .widget.yith-woocommerce-ajax-product-filter:not(".yith-woo-ajax-reset-navigation"), #secondary .widget.widget_price_filter' ).each( function() {
      jQuery( this ).prepend( '<div class="icon"></div>' );
      if ( !jQuery( this ).hasClass( 'minus' ) ) {
        jQuery( this ).find( '.yith-wcan' ).css( 'display', 'none' );
      } else {
        var url = window.location.href;
        var new_url = '';
        var params_url = custom_parse_url( url );
        var arrGender = [ 'yith-woo-ajax-navigation-2', 'yith-woo-ajax-navigation-5' ];
        var arrColor = [ 'yith-woo-ajax-navigation-4', 'yith-woo-ajax-navigation-6' ];
        var arrPrice = [ 'woocommerce_price_filter-2', 'woocommerce_price_filter-3' ];
        var arrBortik = [ 'yith-woo-ajax-navigation-7', 'yith-woo-ajax-navigation-9' ];
        var arrYashik = [ 'yith-woo-ajax-navigation-8', 'yith-woo-ajax-navigation-10' ];
        var arrMaterial = [ 'yith-woo-ajax-navigation-12', 'yith-woo-ajax-navigation-11' ];
        var arrVozrast = [ 'yith-woo-ajax-navigation-13', 'yith-woo-ajax-navigation-13' ];
        var arrTip = [ 'yith-woo-ajax-navigation-15', 'yith-woo-ajax-navigation-16' ];
        /*Пол*/
        if ( jQuery.inArray( jQuery( this ).attr( 'id' ), arrGender ) != -1 && get_value_key( 'filter_gender', params_url ) != null ) {
          new_url = url.replace( 'filter_gender=' + get_value_key( 'filter_gender', params_url ), '' );
          jQuery( this ).find( '.widget-title' ).append( '<a href="' + new_url + '" class="reset_link">Сбросить</>' );
        }
        /*Цвет*/
        if ( jQuery.inArray( jQuery( this ).attr( 'id' ), arrColor ) != -1 && get_value_key( 'filter_color', params_url ) != null ) {
          new_url = url.replace( 'filter_color=' + get_value_key( 'filter_color', params_url ), '' );
          jQuery( this ).find( '.widget-title' ).append( '<a href="' + new_url + '" class="reset_link">Сбросить</>' );
        }
        /*Цена*/
        if ( jQuery.inArray( jQuery( this ).attr( 'id' ), arrPrice ) != -1 && get_value_key( 'min_price', params_url ) != null ) {
          new_url = url.replace( 'min_price=' + get_value_key( 'min_price', params_url ) + '&max_price=' + get_value_key( 'max_price', params_url ), '' );
          if ( jQuery( this ).find( '.widget-title a.reset_link' ).length ) {
            jQuery( this ).find( '.widget-title a.reset_link' ).remove();
          }
          jQuery( this ).find( '.widget-title' ).append( '<a href="' + new_url + '" class="reset_link">Сбросить</>' );
        }
        /*Бортик*/
        if ( jQuery.inArray( jQuery( this ).attr( 'id' ), arrBortik ) != -1 && get_value_key( 'filter_ustanovki-bortika', params_url ) != null ) {
          new_url = url.replace( 'filter_ustanovki-bortika=' + get_value_key( 'filter_ustanovki-bortika', params_url ), '' );
          jQuery( this ).find( '.widget-title' ).append( '<a href="' + new_url + '" class="reset_link">Сбросить</>' );
        }
        /*Ящик*/
        if ( jQuery.inArray( jQuery( this ).attr( 'id' ), arrYashik ) != -1 && get_value_key( 'filter_ustanovki-yashhikov', params_url ) != null ) {
          new_url = url.replace( 'filter_ustanovki-yashhikov=' + get_value_key( 'filter_ustanovki-yashhikov', params_url ), '' );
          jQuery( this ).find( '.widget-title' ).append( '<a href="' + new_url + '" class="reset_link">Сбросить</>' );
        }
        /*Материал*/
        if ( jQuery.inArray( jQuery( this ).attr( 'id' ), arrMaterial ) != -1 && get_value_key( 'filter_material', params_url ) != null ) {
          new_url = url.replace( 'filter_material=' + get_value_key( 'filter_material', params_url ), '' );
          jQuery( this ).find( '.widget-title' ).append( '<a href="' + new_url + '" class="reset_link">Сбросить</>' );
        }
        /*Возраст*/
        if ( jQuery.inArray( jQuery( this ).attr( 'id' ), arrVozrast ) != -1 && get_value_key( 'filter_vozrast-let', params_url ) != null ) {
          new_url = url.replace( 'filter_vozrast-let=' + get_value_key( 'filter_vozrast-let', params_url ), '' );
          jQuery( this ).find( '.widget-title' ).append( '<a href="' + new_url + '" class="reset_link">Сбросить</>' );
        }
        /*Тип*/
        if ( jQuery.inArray( jQuery( this ).attr( 'id' ), arrTip ) != -1 && get_value_key( 'filter_tip', params_url ) != null ) {
          new_url = url.replace( 'filter_tip=' + get_value_key( 'filter_tip', params_url ), '' );
          jQuery( this ).find( '.widget-title' ).append( '<a href="' + new_url + '" class="reset_link">Сбросить</>' );
        }
      }
    } );
    if ( !jQuery( '#main ul.products li' ).hasClass( 'product-category' ) ) {
      jQuery( '#main > .wp-pagenavi, #load-posts' ).removeClass( 'hidden' );
    }
    jQuery( '.yith-woocommerce-ajax-product-filter ul li' ).each( function() {
      if ( jQuery( this ).children( 'a' ).length === 0 ) {
        jQuery( this ).remove();
      }
    } );
  } );
  jQuery( '#secondary .widget.yith-woocommerce-ajax-product-filter:not(".yith-woo-ajax-reset-navigation"), #secondary .widget.widget_price_filter' ).on( 'click', '.widget-title a.reset_link', function( e ) {
    e.preventDefault();
    history.pushState( null, null, jQuery( this ).attr( 'href' ) );
    jQuery( this ).remove();
    jQuery( this ).yith_wcan_ajax_filters( e, this );
  } );
  jQuery( '#secondary .widget.yith-woocommerce-ajax-product-filter' ).on( 'click', '.icon', function() {
    var sub = jQuery( this ).siblings( '.yith-wcan' );
    if ( jQuery( sub ).css( 'display' ) == 'none' ) {
      sub.slideDown( 500 );
      jQuery( this ).parent( '.widget.yith-woocommerce-ajax-product-filter' ).addClass( 'minus' );
    } else {
      sub.slideUp( 500 );
      jQuery( this ).parent( '.widget.yith-woocommerce-ajax-product-filter' ).removeClass( 'minus' );
    }
  } );
  /*Раскрытие фильтр-цены*/
  jQuery( '#secondary .widget.widget_price_filter' ).each( function() {
    jQuery( this ).prepend( '<div class="icon"></div>' );
    jQuery( this ).find( 'form' ).css( 'display', 'none' );
  } );
  jQuery( '#secondary .widget.widget_price_filter' ).on( 'click', '.icon', function() {
    var sub = jQuery( this ).siblings( 'form' );
    if ( jQuery( sub ).css( 'display' ) == 'none' ) {
      sub.slideDown( 500 );
      jQuery( this ).parent( '.widget.widget_price_filter' ).addClass( 'minus' );
    } else {
      sub.slideUp( 500 );
      jQuery( this ).parent( '.widget.widget_price_filter' ).removeClass( 'minus' );
    }
  } );
  jQuery( '#secondary .widget.widget_price_filter .price_slider_amount .price_label' ).insertBefore( '#secondary .widget.widget_price_filter .price_slider_amount .button' );
  jQuery( '.woocommerce-product-gallery__wrapper #owl-products-images .owl-item img' ).on( 'click', function() {
    var full_src = jQuery( this ).attr( 'data-large_image' );
    var medium_src = jQuery( this ).attr( 'data-medium' );
    var main_img = jQuery( '.woocommerce-product-gallery__wrapper #general-product-image a' );
    main_img.attr( 'href', full_src );
    var clone = jQuery( this ).clone();
    main_img.html( clone );
    main_img.find( 'img' ).attr( 'src', medium_src );
    main_img.find( 'img' ).removeAttr( 'sizes' );
  } );

  // ------ Зумирование фото в карточке товара ---------
  if ( jQuery( document ).width() >= 751 ) {
    /*jQuery("#general-product-image .attachment-shop_single").imagezoomsl({
      zoomrange: [3, 3]
    });*/
  }
  // -----------------------------------------------------------


  //------ payment tooltip ---------------------------------

  jQuery( 'form[name="checkout"] a[href="#panel2"]' ).click( function() {
    var idBlock;
    jQuery( 'input[type=radio][name=payment_method]' ).change( function() {
      idBlock = jQuery( this ).val();
      jQuery.fancybox( {
        content: jQuery( '#' + idBlock ).html()
      } )
    } )
    setTimeout( function() {
      jQuery( '.payment_method_cod label' ).append( '<img src="https://belmarco.ru/wp-content/uploads/2017/05/step_3.png" alt="Оплата при доставке">' );
    } );

  } );

  //--------------------------------------------------------
  /*---------------------Главная страница (29-05-18)----------------------*/
  jQuery( '#main_video_reviews .item_review .play' ).on( 'click', function() {
    var id = jQuery( this ).parent().attr( 'id' );
    var url_video = jQuery( this ).parent().attr( 'data-video' );
    var iframe = '<iframe src="' + url_video + '" width="100%" height="100%" frameborder="0" scrolling="no"></iframe>';
    jQuery( '#main_video_reviews #' + id ).html( iframe );
  } );

  /*---------------------Mobile Menu----------------------*/
  jQuery( '#btn_mob_menu, #mob_menu .close' ).on( 'click', function() { 
    jQuery( "#mob_menu" ).toggle( "slide" );
    jQuery( 'body' ).toggleClass( 'overflow-hidden' );

    // Сохраняем состояние в history
    history.pushState({
      'state' : 'mob_menu',
      'visible' : jQuery( "#mob_menu" ).is( ":visible" )
    }, document.title);

    console.log("Push State: " + JSON.stringify(history.state));

  } );

  window.addEventListener('popstate', (event) => {
      if (jQuery( "#mob_menu" ).is( ":visible" )) {
        jQuery( "#mob_menu" ).toggle( "slide" );
        jQuery( 'body' ).toggleClass( 'overflow-hidden' );         
      } 
  });



  /*if(jQuery(window).width()<992){
    jQuery('#main .ordering').detach().prependTo('#secondary');
  }*/
  jQuery( 'body' ).on( 'click', '#btn_mob_filter, #secondary .close', function() {
    jQuery( "#secondary" ).toggle( "slide" );
    jQuery( 'body' ).toggleClass( 'overflow-hidden' );
  } );
  jQuery( '.yith-wacp_trigger' ).on( 'click', function( event ) {
    jQuery( '.yith-wacp-mini-cart-icon' ).trigger( 'click' );
  } );

  jQuery( '#mob-menu li ul.sub-menu li' ).each( function() {
    if ( jQuery( this ).hasClass( 'current-product-ancestor' ) ) {
      var parent = jQuery( this ).parents( 'li' );
      if ( !parent.hasClass( 'minus' ) ) {
        parent.find( '.icon' ).trigger( 'click' );
      }
    }
  } );
} );

var yaCounter2904126 = {
  "reachGoal": function() {
    console.log();
  }
}
/*------------Замена ссылки Политики конфинденциальности на мобильной версии (480px)-------------*/
jQuery( window ).load( function() {
  if ( jQuery( window ).width() < 481 ) {
    jQuery( '#menu-o-kompanii .fancybox-pdf' ).empty();
    jQuery( '#menu-o-kompanii .fancybox-pdf' ).append( '<a href="/privacy-policy/" target="_blank">Политика обработки персональных данных</a>' );
  }
  if ( jQuery( '#main ul.products li' ).hasClass( 'product-category' ) ) {
    jQuery( '#main > .wp-pagenavi, #load-posts' ).addClass( 'hidden' );
  }
  if ( jQuery( '#load-posts a.button' ).hasClass( 'disabled' ) ) {
    jQuery( '#load-posts' ).remove();
  }
} );
if ( window.location.pathname == '/cart-checkout/' ) {
  window.scrollTo( 0, 0 );
}
jQuery( function( $ ) {
  if ( jQuery( document ).width() >= 768 ) {
    $( 'body' )
      .on( 'init', '.wc-tabs-wrapper, .woocommerce-tabs', function() {
        var $tabs = $( this ).find( '.wc-tabs, ul.tabs' ).first();
        setTimeout( function() { $tabs.find( '.item-tab:first a' ).click(); }, 500 );
      } )
      .on( 'click', '.wc-tabs li .item-tab a, ul.tabs li .item-tab a', function( e ) {
        e.preventDefault();
        var $tab = $( this );
        var $tabs_wrapper = $tab.closest( '.wc-tabs-wrapper, .woocommerce-tabs' );
        var $tabs = $tabs_wrapper.find( '.wc-tabs, ul.tabs' );
        $tabs.find( '.item-tab' ).removeClass( 'active' );
        $tab.closest( '.item-tab' ).addClass( 'active' );
      } );
    setTimeout( function() {
      var currentTabDescription = $( '.wc-tabs-wrapper .tabs li' ).first();
      $( currentTabDescription ).find( 'a' ).click();
    }, 500 );
  } else {
    $( 'body' )
      .on( 'init', '.wc-tabs-wrapper, .woocommerce-tabs', function() {
        var $contents = $( this ).find( '.woocommerce-Tabs-panel' );
        $contents.each( function() {
          $( this ).addClass( 'hide' );
        } );
      } );

    $( '.wc-tabs-wrapper.product-tabs .tabs li a' ).on( 'click', function( e ) {
      e.preventDefault();
      var title = '<div class="tab-name-content">' + $( this ).html() + '</div>';
      var content = $( this ).attr( 'href' );
      if ( $( content ).find( '.tab-name-content' ).length == 0 ) {
        $( content ).addClass( 'pt-55' );
        $( content ).prepend( title );
      }
      setTimeout( function() {
        if ( $( content ).css( 'display' ) == 'block' ) {
          $( 'body' ).addClass( 'overflow-hidden' );
        }
      }, 200 );
    } );
    setTimeout( function() {
      $( '.wc-tabs-wrapper.product-tabs .tabs li a' ).on( 'click', function( e ) {
        var content = $( this ).attr( 'href' );
        $( content ).removeClass( 'hide' );
      } );
    }, 500 );
    $( '.woocommerce div.product .woocommerce-tabs.product-tabs .panel' ).on( 'click', '.tab-name-content', function() {
      $( this ).parent().hide( 'slide-out' );
      $( 'body' ).removeClass( 'overflow-hidden' );
    } );

    $( '.woocommerce div.product .woocommerce-tabs.product-tabs .panel' ).scroll( function() {
      var _this = $( this );
      if ( $( _this ).scrollTop() >= 40 ) {
        _this.find( '.tab-name-content' ).addClass( 'fixed' );
      } else {
        _this.find( '.tab-name-content' ).removeClass( 'fixed' );
      }
    } );
  }

  function slider_progress_percentage( current, total ) {
    if ( !total ) { return 0; }
    return Math.max( 0, Math.min( 100, 100 * current / total ) );
  }

  function slider_progress( slider ) {
    var count = slider.find( '.owl-stage .owl-item' ).length;
    if ( slider.find( '.owl-stage .owl-item.active' ).length > 1 || count <= 1 ) {
      return 0;
    }
    var width_bar = 100 / count;
    var html = '<div class="slider-progress"><div class="slider-progress-line"><div class="slider-progress-bar" style="left: 0%; width: ' + width_bar + '%;"></div></div><div class="slider-progress-counter"><span class="slider-progress-current">1</span><span class="slider-progress-count">/ ' + count + '</span></div>';
    slider.find( '.owl-dots' ).css( 'display', 'none' ).after( html );
    slider.on( 'changed.owl.carousel', function( event ) {
      var _this = $( this );
      var currentItem = event.item.index;
      var left = slider_progress_percentage( currentItem, count );
      _this.find( '.slider-progress-bar' ).css( 'left', left + '%' );
      _this.find( '.slider-progress-current' ).html( currentItem + 1 );
    } );
  }

  function woof_reset_btn_position() {
    $( '.woof .woof_redraw_zone .woof_reset_search_form' ).detach().prependTo( '.woof .woof_redraw_zone' );
  }
  if ( $( document ).width() < 768 ) {
    woof_reset_btn_position();
    setTimeout( function() {
      $( '.owl-carousel.owl-loaded' ).each( function() {
        var _this = $( this );
        slider_progress( _this );
      } );
    }, 500 );

    /*woof_reset_btn_position();*/
    $( document ).on( 'woof_ajax_done', function() {
      $( '#secondary' ).hide();
      $( 'body' ).removeClass( 'overflow-hidden' );
      /*woof_reset_btn_position();*/
      if ( $( document ).width() < 768 ) {
        woof_reset_btn_position();
      }
    } );
  }

  $( 'body' ).on( 'click', '.menutabs .tabs .item_tab a', function( e ) {
    e.preventDefault();
    var _this = $( this );
    var content = _this.attr( 'href' );
    var parent = _this.parents( '.menutabs' );
    parent.find( '.menutab-content' ).each( function() {
      $( this ).removeClass( 'active' );
    } );
    parent.find( '.tabs .item_tab' ).removeClass( 'active' );
    _this.closest( '.item_tab' ).addClass( 'active' );
    $( content ).addClass( 'active' );
  } );
  setTimeout( function() {
    var currentTabDescription = $( '.menutabs .tabs .item_tab' ).first();
    $( currentTabDescription ).find( 'a' ).click();
  }, 500 );
  $( '.mob_menu ul li.menu-item-has-children' ).each( function() {
    var _this = $( this );
    var title = _this.children( 'a' ).html();
    var href = _this.children( 'a' ).attr( 'href' );
    /*var link_title = 'Смотреть все '+title.toLowerCase();*/
    _this.children( '.sub-menu' ).prepend( '<li class="menu-item menu-item-close">' + title + '</li><li class="menu-item"><a class="turn-left" href="' + href + '">Открыть категорию</a>' );
  } );
  $( '.mob_menu ul li.menu-item-has-children > a' ).on( 'click', function( e ) {
    e.preventDefault();
    $( this ).siblings( '.sub-menu' ).show( 'slide' );
  } );
  $( '.mob_menu ul li .menu-item-close' ).on( 'click', function( e ) {
    e.preventDefault();
    $( this ).parent().hide( 'slide' );
  } );
  $( '.owl-carousel.products' ).trigger( 'refresh.owl.carousel' );
  $( window ).load( function() {
    $( '.owl-carousel.products' ).trigger( 'refresh.owl.carousel' );
  } );

  $( 'body' ).on( 'wcull_success', function() {
    $( '#wcull-content ul.tabs li:first-child a' ).trigger( 'click' );

    $( '#wcull-content .owl-carousel.products' ).owlCarousel( {
      loop: false,
      nav: true,
      dots: false,
      autoHeight: true,
      autoHeightClass: 'owl-height',
      margin: 10,
      slideBy: 1,
      responsiveClass: true,
      responsive: {
        0: {
          autoHeight: true,
          items: 1,
          nav: false,
          dots: true,
        },
        480: {
          items: 2,
          nav: false,
          dots: true,
        },
        768: {
          items: 4,
          nav: true,
        },
      }
    } );

    if ( $( document ).width() < 768 ) {
      $( '#wcull-content .up-sells.upsells.products' ).find( '.wc-tabs li' ).each( function() {
        var id = $( this ).find( 'a' ).attr( 'href' );
        var name = '<div class="tab-title">' + $( this ).find( 'a' ).html() + '</div>';
        $( id ).prepend( name );
      } );
      $( '#wcull-content .up-sells.upsells.products' ).find( '.wc-tabs' ).remove();
      setTimeout( function() {
        $( '#wcull-content .owl-carousel.owl-loaded' ).each( function() {
          var _this = $( this );
          slider_progress( _this );
        } );
        /*$('#wcull-content .owl-carousel.owl-loaded.products').each(function(){
          var wcull_height = $(this).find('.owl-item:first-child').outerHeight();
          $(this).find('.owl-height').css('height', wcull_height+'px');
        });*/
        $( '#wcull-content .owl-carousel.owl-loaded.products' ).each( function() {
          var owl_height = $( this ).find( '.owl-item.active' ).height();
          $( this ).find( '.owl-height' ).css( 'height', owl_height );
        } );
      }, 500 );
      $( '#wcull-content .owl-carousel.owl-loaded.products' ).on( 'translate.owl.carousel, translated.owl.carousel', function() {
        var _this = $( this );
        setTimeout( function() {
          if ( _this.find( '.owl-item.active' ).height() > _this.find( '.owl-height' ).height() ) {
            var owl_height = _this.find( '.owl-item.active' ).height();
            _this.find( '.owl-height' ).css( 'height', owl_height );
          }
        }, 200 );
      } );
    }
  } );

  $( 'body' ).on( 'woofrw_event_check_done', function() {
    var flag = false;
    $( '.woof' ).find( '.woof_redraw_zone .woof_container_inner' ).each( function() {
      if ( $( this ).hasClass( 'woofrw_checked' ) ) {
        flag = true;
      }
    } );
    if ( flag == true ) {
      $( '#btn_mob_filter' ).addClass( 'woofrw_check' );
    } else {
      $( '#btn_mob_filter' ).removeClass( 'woofrw_check' );
    }
  } );
  $( 'body' ).on( 'change', 'form.woocommerce-cart-form input.qty', function() {
    $( 'form.woocommerce-cart-form' ).find( '[name="update_cart"]' ).removeAttr( 'disabled' );
  } );
  $( 'body' ).on( 'click', 'form.woocommerce-cart-form .quantity .minus, form.woocommerce-cart-form .quantity .plus, #yith-wacp-popup .quantity .minus, #yith-wacp-popup .quantity .plus', function( e ) {
    e.preventDefault();
    var $_this = $( this );
    var qty = $_this.parent().find( 'input.qty' );
    var val = parseInt( qty.val() );
    var max = parseInt( qty.attr( 'max' ) );
    var min = parseInt( qty.attr( 'min' ) );
    var step = parseInt( qty.attr( 'step' ) );
    var plus = $_this.parent().find( '.btn.plus' );
    var minus = $_this.parent().find( '.btn.minus' );
    // Change the value if plus or minus
    if ( $_this.hasClass( 'plus' ) ) {
      if ( max && max != '' && ( max <= val ) ) {
        qty.val( max );
        minus.removeClass( 'disabled' );
        $_this.addClass( 'disabled' );
      } else {
        minus.removeClass( 'disabled' );
        qty.val( val + step );
        if ( qty.val() == max ) {
          $_this.addClass( 'disabled' );
        }
        qty.trigger( 'change' );
      }
    } else {
      if ( min && min != '' && ( min >= val ) ) {
        qty.val( min );
        plus.removeClass( 'disabled' );
        $_this.addClass( 'disabled' );
      } else if ( val > 1 ) {
        plus.removeClass( 'disabled' );
        qty.val( val - step );
        if ( qty.val() == min ) {
          $_this.addClass( 'disabled' );
        }
        qty.trigger( 'change' );
      }
    }
  } );
  $( '#yith-wacp-popup' ).on( 'click', '.cart-header .yith-wacp-close', function() {
    $( '#yith-wacp-popup' ).find( '.yith-wacp-head .yith-wacp-close' ).trigger( 'click' );
  } );
  $( document.body ).on( 'updated_duplicate_shipping', function() {
    if ( $( '#promo-my-order-block' ).length && $( '#duplicate_shipping_method' ).length ) {
      var checked = $( '#duplicate_shipping_method' ).find( 'input:checked' );
      var checked_text = checked.siblings( 'label' ).find( '.ship-price' ).html();
      $( '#promo-my-order-block' ).find( '.delivery div:last-child' ).html( checked_text );
    }
  } );
  $( 'body' ).on( 'updated_duplicate_shipping', function() {
    $( '#wc_geo_cityname' ).fancybox();
  } );

  function check_shipping_method() {
    if ( $( '#shipping_method_0_dpd-5' ).is( ':checked' ) ) {
      $( '.checkout-shipping-fields .checkout-shipping-address' ).addClass( 'hidden' );
    } else {
      $( '.checkout-shipping-fields .checkout-shipping-address' ).removeClass( 'hidden' );
    }
  }
  check_shipping_method();
  $( document.body ).on( 'updated_duplicate_shipping', function() {
    check_shipping_method();
  } );
  /*$('body').on('change', '#shipping_method_0_dpd-5', function(){
    if($(this).is(':checked')){
      $('.checkout-shipping-fields .checkout-shipping-address').addClass('hidden');
    }else{
      $('.checkout-shipping-fields .checkout-shipping-address').removeClass('hidden');
    }
  });*/
  function promo_get_total_price() {
    $.ajax( {
      url: '/wp-admin/admin-ajax.php',
      data: { action: 'promo_get_total_price_yith' },
      type: 'POST',
      success: function( res ) {
        return res;
      }
    } );
  }
  $( '#yith-wacp-popup' ).on( 'change', '#promo_wacp_list input.qty', function( e ) {
    e.preventDefault();
    var item_hash = $( this ).attr( 'name' ).replace( /cart\[([\w]+)\]\[qty\]/g, "$1" );
    var item_quantity = $( this ).val();
    var currentVal = parseInt( item_quantity );
    var data = {
      action: 'promo_qty_yith_wcap_cart',
      hash: item_hash,
      quantity: currentVal
    }
    var wacp_list = $( '#promo_wacp_list' );

    $.ajax( {
      url: '/wp-admin/admin-ajax.php',
      data: data,
      type: 'POST',
      beforeSend: function() {
        wacp_list.addClass( 'promo_loading_wcap' );
      },
      success: function( res ) {
        $( document ).trigger( 'yith_wacp_popup_changed', [ $( '#yith-wacp-popup' ) ] );
        $( document.body ).trigger( 'wc_fragment_refresh' );
      },
      complete: function() {
        wacp_list.removeClass( 'promo_loading_wcap' );
      }
    } )
  } );

} );