jQuery(document).ready(function($) {
    $('.item-bottom_banner').click(function() {
      var data_id = $(this).attr('data-id');
      var date_click  = $(this).attr('data-date');
      var data = {
          action: 'bottom_banner_ajax',
          banner_id: data_id,
          date_click: date_click
      };


      jQuery.ajax({
          type: 'POST',
          url: bottom_banner_object.ajax_url,
          data: data,
          success: function (msg) {
              console.log(msg);
          },
          dataType: 'html'
      });


    });
});
