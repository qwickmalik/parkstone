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
    var form_data = $('#InvestorNewInvestorIndivForm').serialize();

var query = form_data;
             //alert($('#post_url').val());
            $.ajax({
                type: 'POST',
                url: $('#post_url').val(),
                dataType: 'json',
                data: query,
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