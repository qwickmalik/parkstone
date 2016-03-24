jQuery(document).ready(function($) {

  // Hook the wizard
  $('.wizard').wizard();

  // On change
  $('.wizard').on('change', function(e, data) {
    var wizard = $(this);
    var inner = $(wizard).parents('.inner');

    // Check if input is valid
    var error = 0;
    var step_form = $('div#step' + (data.step), '.step-content');
    $('input.required', step_form).each(function(i, item) {
      if ($(item).val() == '') {
        $(item).addClass('error');
        error = 1;
      }
    });

    if (error) {
      return false;
    }

    $('div#step' + (data.step), inner).hide();

    if (data.direction == 'next') {
      $('div#step' + (data.step+1), inner).show();
    } else {
      $('div#step' + (data.step-1), inner).show();
    }
  });

  // Finished, submit the form!
  $('.wizard').on('finished', function(e, data) {
//      $('form').submit();
    var form_data = $('form').serialize();
//    var form_data = new FormData();
//    var fileInput = document.getElementById('investor_photo');
//    $.each(form,function(key,input){
//        form_data.append(input.name,input.value);
//    });
//           form_data.append('investor_photo',fileInput);

var query = form_data;
            $.ajax({
                type: 'POST',
                url: $('#post_url').val(),
                dataType: 'json',
//                data: query,
                data: new FormData($('.newinvestor')[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false,       // The content type used when sending data to the server.
//            cache: false, // To unable request pages to be cached
            processData: false, 
                success: function (data) {
                    
                    if(data['status'] == 'error'){
                        window.location.reload();
                    }else if(data['status'] == 'success'){
                      
    $('#wizard-form, .actions, .step-content').hide();
    $('.wizard-form-success').fadeIn(800);
                    }
                    

                },
                error: function () {
                }

            });
//        
//  $('#InvestorNewInvestorIndivForm').submit(function(e){
//      //var query = new FormData(this);
//      var query = new window.FormData($('#InvestorNewInvestorIndivForm')[0]);
//     
//      $.ajax({
//                'url': $('#post_url').val(),
//                'type': 'POST',
//                'data': query,
//                'processData': false,
//                'contentType': false,
//                success: function (rdata) {
//                    alert(rdata);
//                    return false;
//                    if(rdata['status'] == 'error'){
//                       // window.location.reload();
//                    }else if(rdata['status'] == 'success'){
//                        
//    $('#wizard-form, .actions, .step-content').hide();
//    $('.wizard-form-success').fadeIn(800);
//                    }
//                    
//
//                },
//                error: function () {
//                }
//
//            });
//  });
//   $("#InvestorNewInvestorIndivForm").submit();         
    return false;
  });

  // Previouse Button
  $('.btn-prev', '.actions').on('click', function() {
    var inner = $(this).parents('.inner');
    var wizard = $(inner).children('.wizard');
    $(wizard).wizard('previous');
  });

  // Next button
  $('.btn-next', '.actions').on('click', function() {
    var inner = $(this).parents('.inner');
    var wizard = $(inner).children('.wizard');
    $(wizard).wizard('next', 'foo');
  });

});