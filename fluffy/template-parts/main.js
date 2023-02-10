jQuery(document).ready(function($) { 

  $(window).click(function() {
    //Hide the menus if visible
    $('.btn-acc_option').removeClass('on');
    $('.sub-acc').removeClass('on');
  });
  $('.btn-acc_option').on('click', function() {
    event.stopPropagation();
    $(this).toggleClass('on');
    $('.sub-acc').toggleClass('on');
  });
  
  // $('html').one('click',function() {
  //   $(".custom-select").removeClass("opened");
  // });
  // $(this).parents(".custom-select").toggleClass("opened");
  // event.stopPropagation();

  var swiper = new Swiper(".house_style-carousel", {
    autoplay: {
      delay: 2500,
    },
    loop: true,
    spaceBetween: 10,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
    breakpoints: {
      360: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      640: {
        slidesPerView: 4,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 4,
        spaceBetween: 20,
      },
      1024: {
        slidesPerView: 4,
        spaceBetween: 20,
      },
    },
  });

});

