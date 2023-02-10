function addClass(e,l){var elements=document.querySelectorAll(e);for(var s=0;s<elements.length;s++)elements[s].classList.add(l)}function removeClass(e,l){var elements=document.querySelectorAll(e);for(var s=0;s<elements.length;s++)elements[s].classList.remove(l)}

document.addEventListener(
  "click",
  function (event) {

    // Mobile Toggle
    if (event.target.closest("#toggle-main-menu")) {
      if (!event.target.classList.contains("is-active")) {
          addClass("#toggle-main-menu,#mobile_menu_wrap,.overlay_menu_m", "is-active");
      }
    }

    if (event.target.closest("#close-mobile-menu,.overlay_menu_m")) {
      removeClass("#toggle-main-menu,#mobile_menu_wrap,.overlay_menu_m", "is-active");
    }




    // Sub menu Toggle
    // if (event.target.closest(".wrap-toggle-mobile")) {
    //
    //   if (event.target.parentNode.parentNode.classList.contains(".menu-item-has-children")) {
    //     event.target.parent().add("is-active-mobile");
    //
    //   }
    //   else {
    //     event.target.parent().classList.remove("is-active-mobile");
    //
    //   }
    // }

    // if (event.target.closest("#close-mobile-menu")) {
    //   removeClass("#toggle-main-menu,#mobile_menu_wrap,.overlay_menu_m", "is-active");
    // }
 //
 // if (event.target.closest(".wrap-toggle-mobile")) {
 //    event.target(this).parent().classList.toggle("is-active-mobile");
 //  }


  },
  false
);

new WOW().init();

!function(e){"use strict";e.fn.accordionjs=function(n){if(this.length>1)return this.each(function(){e(this).accordionjs(n)}),this;var c=this,t={isInteger:function(e){return"number"==typeof e&&isFinite(e)&&Math.floor(e)===e},isArray:function(e){return"[object Array]"===Object.prototype.toString.call(e)},isObject:function(e){return"[object Object]"===Object.prototype.toString.call(e)},sectionIsOpen:function(e){return e.hasClass("acc_active")},getHash:function(){return window.location.hash?window.location.hash.substring(1):!1}},o=e.extend({closeAble:!1,closeOther:!0,slideSpeed:150,activeIndex:1,openSection:!1,beforeOpenSection:!1},n);e.each(o,function(e){var n=e.replace(/([A-Z])/g,"-$1").toLowerCase().toString(),t=c.data(n);(t||!1===t)&&(o[e]=t)}),(o.activeIndex===!1||o.closeOther===!1)&&(o.closeAble=!0);var i=function(){c.create(),c.openOnClick(),e(window).on("load",function(){c.openOnHash()}),e(window).on("hashchange",function(){c.openOnHash()})};return this.openSection=function(n,c){e(document).trigger("accjs_before_open_section",[n]),"function"==typeof o.beforeOpenSection&&o.beforeOpenSection.call(this,n),c=c>=0?c:o.slideSpeed;var t=n.children().eq(1);t.slideDown(c,function(){e(document).trigger("accjs_open_section",[n]),"function"==typeof o.openSection&&o.openSection.call(this,n)}),n.addClass("acc_active")},this.closeSection=function(n,c){e(document).trigger("accjs_before_close_section",[n]),"function"==typeof o.beforeCloseSection&&o.beforeCloseSection.call(this,n),c=c>=0?c:o.slideSpeed;var t=n.children().eq(1);t.slideUp(c,function(){e(document).trigger("accjs_close_section",[n]),"function"==typeof o.closeSection&&o.closeSection.call(this,n)}),n.removeClass("acc_active")},this.closeOtherSections=function(n,t){var o=n.closest(".accordionjs").children();e(o).each(function(){c.closeSection(e(this).not(n),t)})},this.create=function(){c.addClass("accordionjs");var n=c.children();if(e.each(n,function(n,t){c.createSingleSection(e(t))}),t.isArray(o.activeIndex))for(var i=o.activeIndex,s=0;s<i.length;s++)c.openSection(n.eq(i[s]-1),0);else o.activeIndex>1?c.openSection(n.eq(o.activeIndex-1),0):!1!==o.activeIndex&&c.openSection(n.eq(0),0)},this.createSingleSection=function(n){var c=n.children();n.addClass("acc_section"),e(c[0]).addClass("acc_head"),e(c[1]).addClass("acc_content"),n.hasClass("acc_active")||n.children(".acc_content").hide()},this.openOnClick=function(){c.on("click",".acc_head",function(n){n.stopImmediatePropagation();var i=e(this).closest(".acc_section");t.sectionIsOpen(i)?o.closeAble?c.closeSection(i):1===c.children().length&&c.closeSection(i):o.closeOther?(c.closeOtherSections(i),c.openSection(i)):c.openSection(i)})},this.openOnHash=function(){if(t.getHash()){var n=e("#"+t.getHash());n.hasClass("acc_section")&&(c.openSection(n),o.closeOther&&c.closeOtherSections(n),e("html, body").animate({scrollTop:parseInt(n.offset().top)-50},150))}},i(),this}}(jQuery);



jQuery(document).ready(function($) {


// $('.sf-field-category').select2();


  $('.ec_close svg,.favorite_close,.yp-favorite-overlay').click(function(event) {
      $('.edit_cover_input,.wrap-all-favorite').removeClass('active');
  });

  $('.edit_cover').click(function(event) {
      $('.edit_cover_input').toggleClass('active');
  });

  $('.yp-favorite-form li label span').click(function(event) {
        $('.yp-favorite-form button').text('บันทึก');
    $(this).parent().parent().toggleClass('active');
      // if ($(this).hasClass('active')) {
      //     $(this).removeClass('active');
      // }
      // else {
      //   $(this).addClass('active');
      // }
  });


    $('#mobile-menu li>a').click(function(event) {
      $("#toggle-main-menu,#mobile_menu_wrap,.overlay_menu_m").removeClass('is-active');
    });

    $("#yp-accordion").accordionjs({
        // Allow self close.(data-close-able)
        // closeAble   : false,
        //
        // // Close other sections.(data-close-other)
        // closeOther  : true,
        //
        // // Animation Speed.(data-slide-speed)
        // slideSpeed  : 150,

        // The section open on first init. A number from 1 to X or false.(data-active-index)
        activeIndex : false,
        //
        // // Callback when a section is open
        // openSection: function( section ){},
        //
        // // Callback before a section is open
        // beforeOpenSection: function( section ){},
    });


  $('.nav-sub-term-yp li').click(function (event) {
    var data = $(this).attr('data-id');
    var currentClick = $(this).attr('data-nav');

    $('.'+currentClick+' .content-post-tab-yp').removeClass('active');
    $('.'+currentClick+' .nav-sub-term-yp li').removeClass('active');

    $(this).addClass('active');
    $('.'+currentClick+' .content-post-tab-yp[data-id="' + data + '"]').addClass('active');

    $('.content-post-tab-yp .vc-post').removeClass('vdelayed');


    setTimeout(function () {
        $('.'+currentClick+' .content-post-tab-yp[data-id="' + data + '"] .vc-post').addClass('vdelayed');
    }, 1000);

    // var selected = '.'+currentClick+' .btn-all_terms a';
    // var selected_2 = '.'+currentClick+' .vc-view-more';
    // var selected_3 = '.'+currentClick+' .read_more';
    //
    //
    // $(selected+', '+selected_2+', '+selected_3).attr('href', '?go_posts_terms='+data);
  });



  $('.heateor_sss_sharing_ul a').click(function(e) {

    var isMobile = false; //initiate as false

    // device detection
    if (
      /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) ||
      /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(
        navigator.userAgent.substr(0, 4)
      )
    )
      isMobile = true;


    var winWidth = 560;
    var winHeight = 600;

    var winTop = screen.height / 2 - winHeight / 2;
    var winLeft = screen.width / 2 - winWidth / 2;


    e.preventDefault();
    link = $(this).attr('href');
    type = $(this).attr('title');


      if (!isMobile) {
            if (type == 'Facebook' || type == 'Twitter' || type == 'Line' ) {
                window.open(link, "social", "top=" + winTop + ",left=" + winLeft + ",toolbar=0,status=0,width=" + winWidth + ",height=" + winHeight);
            }
      }
      else {

        if (type == 'Facebook' || type == 'Twitter') {
            window.open(link, "social", "top=" + winTop + ",left=" + winLeft + ",toolbar=0,status=0,width=" + winWidth + ",height=" + winHeight);
        }

        if ( type == 'Line' ) {
          var url = "http://line.me/R/msg/text/?" + encodeURIComponent($('h1.entry-title').text()) + "%0d%0a" + encodeURIComponent(window.location.href);
            window.open(url, "social", "top=" + winTop + ",left=" + winLeft + ",toolbar=0,status=0,width=" + winWidth + ",height=" + winHeight);
        }

      }

  });

  // $('.sf-field-category select').select2();

  $('.btn_back').click(function(event) {
    window.history.back();
  });

  $('.but-2.reset-btn').attr('type', 'reset');
  $('.toggle-search').on('click', function() {
    $('.popup_search, .overlay-popup_search').addClass('active');
    $('.cancel-btn_search svg').addClass('active');
  });

  $('.btn-close,.overlay-popup_search').on('click', function() {
    $('.popup_search,.overlay-popup_search').removeClass('active');
    $('.cancel-btn_search svg').removeClass('active');
  });

  $('.wrap-toggle-mobile').click(function() {
  var parent_li = $(this).parent();
  parent_li.toggleClass('is-active-mobile');
  // $('.sub-menu').slideDown('400');
  });



  //
  // $( ".color-box .cbtn-1 span" ).addClass('active');
  // $( ".color-box .cbtn-1 span" ).click(function() {
  //     $(this).addClass('active');
  //     $( "body" ).addClass("vc-color_1");
  //     $( "body" ).removeClass("vc-color_2");
  //     $( "body" ).removeClass("vc-color_3");
  //     $( ".color-box .cbtn-2  span" ).removeClass("active");
  //     $( ".color-box .cbtn-3  span" ).removeClass("active");
  //     $(".site-branding").removeClass('active');
  //     $(".site-branding.white").removeClass('active');
  //      Cookies.set('boxColor', 'vc-color_1', { expires: 1, path: '/' });
  //   });
  //   $( ".color-box .cbtn-2  span" ).click(function() {
  //     $(this).addClass('active');
  //     $( "body" ).addClass("vc-color_2");
  //     $( "body" ).removeClass("vc-color_1");
  //     $( "body" ).removeClass("vc-color_3");
  //     $( ".color-box .cbtn-1  span" ).removeClass("active");
  //     $( ".color-box .cbtn-3  span" ).removeClass("active");
  //     $(".site-branding").removeClass('active');
  //     // $(".site-branding.white").removeClass('active');
  //     Cookies.set('boxColor', 'vc-color_2', { expires: 1, path: '/' });
  //   });
  //   $(".site-branding.white img.custom-logo").removeClass('active');
  //   $( ".color-box .cbtn-3  span" ).click(function() {
  //     $(this).addClass('active');
  //     $( "body" ).addClass('vc-color_3');
  //     $(".site-branding").addClass('active');
  //     $(".site-branding.white").addClass('active');
  //     $( "body" ).removeClass("vc-color_1");
  //     $( "body" ).removeClass("vc-color_2");
  //     $( ".color-box .cbtn-1 span" ).removeClass("active");
  //     $( ".color-box .cbtn-2 span" ).removeClass("active");
  //     Cookies.set('boxColor', 'vc-color_3', { expires: 1, path: '/' });
  //   });

  //
  // $('.button-size .sizeOne').click(function(event) {
  //     $('.button-size button').removeClass('active');
  //     $(this).addClass('active');
  //     $('body').addClass('vSize-1');
  //     $('body').removeClass('vSize-2');
  //     $('body').removeClass('vSize-3');
  //     Cookies.set('vSize', 'vSize-1', { expires: 1, path: '/' });
  // });
  //
  //
  // $('.button-size .sizeTwo').click(function(event) {
  //     $('.button-size button').removeClass('active');
  //     $(this).addClass('active');
  //     $('body').removeClass('vSize-1');
  //     $('body').addClass('vSize-2');
  //     $('body').removeClass('vSize-3');
  //    Cookies.set('vSize', 'vSize-2', { expires: 1, path: '/' });
  // });
  //
  // $('.button-size .sizeThree').click(function(event) {
  //     $('.button-size button').removeClass('active');
  //     $(this).addClass('active');
  //     $('body').removeClass('vSize-1');
  //     $('body').removeClass('vSize-2');
  //     $('body').addClass('vSize-3');
  //     Cookies.set('vSize', 'vSize-3', { expires: 1, path: '/' });
  // });
  //
  //
  //
  //
  // if (Cookies.get('boxColor')) {
  //     $('body').addClass(Cookies.get('boxColor'));
  // }
  // if (Cookies.get('vSize')) {
  //     $('body').addClass(Cookies.get('vSize'));
  //     $('.button-size button').removeClass('active');
  //     if (Cookies.get('vSize') == 'vSize-1') {
  //       $('.button-size .sizeOne').addClass('active')
  //     }
  //     if (Cookies.get('vSize') == 'vSize-2') {
  //       $('.button-size .sizeTwo').addClass('active')
  //     }
  //     if (Cookies.get('vSize') == 'vSize-3') {
  //       $('.button-size .sizeThree').addClass('active')
  //     }
  // }
  //
  //
  // if (Cookies.get('boxColor') == 'vc-color_3') {
  //     $(".site-branding").addClass('active');
  // }
  // // if (Cookies.get('boxColor') == 'vc-color_2') {
  // //     $('.button-color .btn-color span').removeClass('active');
  // //       $('.color-box .cbtn-2 span').addClass('active');
  // // }
  // if (Cookies.get('boxColor') == 'vc-color_3') {
  //       $('.button-color .btn-color span').removeClass('active');
  //       $('.color-box .cbtn-3 span').addClass('active');
  // }
  //
  // if (Cookies.get('boxColor') == 'vc-color_1') {
  //     $(".site-branding").removeClass('active');
  // }



});
