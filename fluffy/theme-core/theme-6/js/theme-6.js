    jQuery(document).ready(function($) {

        $(window).on('scroll',function(){
            stop = Math.round($(window).scrollTop());
            if (stop > 80) {
            $('.main-object').addClass('fixed');
            } else {
            $('.main-object').removeClass('fixed');
            }
            });


      });
