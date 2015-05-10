
$body = $("body");

$(document).on({
    ajaxStart: function() { $body.addClass("loading");
      //  $("<p>Processing...Please Wait</p>").insertAfter(".loading");
        
            },
     ajaxStop: function() { $body.removeClass("loading"); }    
});