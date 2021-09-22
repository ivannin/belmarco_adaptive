jQuery(document).ready(function($){
	$('.fancybox, .sertif-fancybox').fancybox();
	$('.slick-slider').slick({
		infinite: true,
		slidesToShow: 2,
		slidesToScroll: 1
	});
	if(screen.width<=480){
		$('.slick-video-slider').slick({
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1
		});
		
	}
	else{
		$('.slick-video-slider').slick({
			infinite: true,
			slidesToShow: 3,
			slidesToScroll: 1
		});
	}
	$('.show-product').click(function(){
		var showBlock = $(this).attr('data-block');
		$('.product-block').fadeOut(0);
		$('#'+showBlock).fadeIn(300);
	});
	$('.close-product').click(function(){
		$('.product-block').fadeOut(300);
	});
	$('.popup-youtube').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        preloader: false
    });
    $('#catalog-open-window').click(function(e){
    	console.log(123);
    	$('#call').fadeIn(300);
    	$('#background-black').fadeIn(300)
    	e.preventDefault();
    });
    $('#background-black, #closeFormCatalog').click(function(){
    	$('#call').fadeOut(300);
    	$('#background-black').fadeOut(300)
    });
})