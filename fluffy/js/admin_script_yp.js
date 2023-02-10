jQuery(document).ready(function($) {

  $(document).on('ocdiImportComplete', function() {
    $('body').css('opacity', '0');
    window.location.replace("/wp-admin/admin.php?page=fluent_forms_transfer&vimport_form=1#importforms");
  });


  $('.edit-php a.submitdelete, .post-php a.submitdelete').click( function( event ) {
        if( ! confirm( 'Confirm Delete?' ) ) {
            event.preventDefault();
        }
    });

    $('input#doaction').click( function( event ) {

        var selector_top = $('select#bulk-action-selector-top').val();
        if (selector_top == 'trash') {
          if( ! confirm( 'Confirm Delete?' ) ) {
              event.preventDefault();
          }
        }

    });


    $('input#doaction2').click( function( event ) {

        var selector_bottom = $('select#bulk-action-selector-bottom').val();
        if (selector_bottom == 'trash') {
          if( ! confirm( 'Confirm Delete?' ) ) {
              event.preventDefault();
          }
        }

    });

});

if (typeof $ == 'undefined') {
   var $ = jQuery;
}
