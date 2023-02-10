jQuery(document).ready(function($) {

  function dateFormat(inputDate, format) {
  //parse the input date
  const date = new Date(inputDate);

  //extract the parts of the date
  const day = date.getDate();
  const month = date.getMonth() + 1;
  const year = date.getFullYear();

  //replace the month
  format = format.replace("MM", month.toString().padStart(2,"0"));

  //replace the year
  if (format.indexOf("yyyy") > -1) {
      format = format.replace("yyyy", year.toString());
  } else if (format.indexOf("yy") > -1) {
      format = format.replace("yy", year.toString().substr(2,2));
  }

  //replace the day
  format = format.replace("dd", day.toString().padStart(2,"0"));

  return format;
}






$('.reDate_start,.reDate_end').attr('autocomplete', 'off');
  function get_next_week_start() {
     var now = new Date();
     var next_week_start = new Date(now.getFullYear(), now.getMonth(), now.getDate()+(8 - now.getDay()));
     return next_week_start;
  }

  const dateString = get_next_week_start(new Date());
  const D = new Date(dateString);

  var minD = D.getFullYear()+'-'+(D.getMonth() +1)+'-'+D.getDate();


  $(".reDate_end").prop('disabled', true);

  $('.reCat').change(function(event) {
    $('.reDate_start,.reDate_end').val('');
    $('.reDate_end').addClass('readonly-single');
    $('.reDate_end').attr('disabled', 'disabled');


    var start_date_txt = $(".reDate_start").val();
    var data = $(this).val();

    if (data == 'cat_01' || data == 'cat_02') {

      $(".reDate_start").flatpickr({
          // minDate: new Date(),
          minDate: minD,
          disable : [
           function(date) {
               return ( date.getDay() != 1 );
           }
         ],
           locale: {
               firstDayOfWeek : 1 // start week on Monday
           },
           onOpen: function(selectedDates, dateStr, instance) {
             $(".reDate_end").val('');
           },
           onChange: function(selectedDates, dateStr, instance) {
             $(".reDate_end").prop('disabled', false);
             const myArray = dateStr.split("/");
             var new_date = myArray[2]+'/'+myArray[1]+'/'+myArray[0];
                 $(".reDate_end").flatpickr({
                     minDate: new_date,
                      locale: {
                          firstDayOfWeek : 1 // start week on Monday
                      },
                     enableTime: false,
                     allowInput: true,
                     dateFormat: "d/m/Y"
                 });
              },
          enableTime: false,
          allowInput: true,
          // altInput: true,
          dateFormat: "d/m/Y"
      });

    }

    else if (data == 'cat_03' || data == 'cat_04') {

      $(".reDate_start").flatpickr({
          // minDate: new Date(),
          minDate: minD,
          disable : [
           function(date) {
               return ( date.getDay() != 2 );
           }
         ],
           locale: {
               firstDayOfWeek : 1 // start week on Monday
           },
           onOpen: function(selectedDates, dateStr, instance) {
             $(".reDate_end").val('');
           },
           onChange: function(selectedDates, dateStr, instance) {
             $(".reDate_end").prop('disabled', false);
             const myArray = dateStr.split("/");
             var new_date = myArray[2]+'/'+myArray[1]+'/'+myArray[0];
                 $(".reDate_end").flatpickr({
                     minDate: new_date,
                      locale: {
                          firstDayOfWeek : 1 // start week on Monday
                      },
                     enableTime: false,
                     allowInput: true,
                     dateFormat: "d/m/Y"
                 });
              },
          enableTime: false,
          allowInput: true,
          // altInput: true,
          dateFormat: "d/m/Y"
      });

    }

    else if  (data == 'cat_05' || data == 'cat_06') {

      $(".reDate_start").flatpickr({
          // minDate: new Date(),
          minDate: minD,
          disable : [
           function(date) {
               return ( date.getDay() != 4 );
           }
         ],
         onOpen: function(selectedDates, dateStr, instance) {
           $(".reDate_end").val('');
         },
         onChange: function(selectedDates, dateStr, instance) {
           $(".reDate_end").prop('disabled', false);
           const myArray = dateStr.split("/");
           var new_date = myArray[2]+'/'+myArray[1]+'/'+myArray[0];
               $(".reDate_end").flatpickr({
                   minDate: new_date,
                    locale: {
                        firstDayOfWeek : 1 // start week on Monday
                    },
                   enableTime: false,
                   allowInput: true,
                   dateFormat: "d/m/Y"
               });
            },
           locale: {
               firstDayOfWeek : 1 // start week on Monday
           },
          enableTime: false,
          allowInput: true,
          // altInput: true,
          dateFormat: "d/m/Y"
      });

    }
    else {

      $(".reDate_start").flatpickr({
          // minDate: new Date(),
           minDate: "today",
         //  disable : [
         //   function(date) {
         //       return (date.getDay() === 0 || date.getDay() === 6);
         //   }
         // ],
         onOpen: function(selectedDates, dateStr, instance) {
           $(".reDate_end").val('');
         },
         onChange: function(selectedDates, dateStr, instance) {
           $(".reDate_end").prop('disabled', false);
           const myArray = dateStr.split("/");
           var new_date = myArray[2]+'/'+myArray[1]+'/'+myArray[0];
               $(".reDate_end").flatpickr({
                   minDate: new_date,
                    locale: {
                        firstDayOfWeek : 1 // start week on Monday
                    },
                   enableTime: false,
                   allowInput: true,
                   dateFormat: "d/m/Y"
               });
            },
           locale: {
               firstDayOfWeek : 1 // start week on Monday
           },
          enableTime: false,
          allowInput: true,
          // altInput: true,
          dateFormat: "d/m/Y"
      });


    }



  });


});
