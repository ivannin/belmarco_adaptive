jQuery(document).ready(function($){
  if (window.innerWidth < 767 )  {
      if (document.querySelector('.product_title')) {
        document.querySelector('.site-main').prepend(document.querySelector('.product_title'));
      }
    }
});
