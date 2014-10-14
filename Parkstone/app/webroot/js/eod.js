
var eod = {

    eod_url: 'run_eod',

    init: function() {
       //run EOD
       eod.doEOD();
       
    },


    doEOD:function(){
        //check to see if cart session is set and display cart
             var cart_query = "action=check_cart&" + "check=yes";
            $.ajax({
            url: this.cart_url,
            data: cart_query,
            dataType: 'json',
            type: 'POST',
            success:function(data){
                if(data['Cart'] == "enabled") {
                    $("#SaleIndexForm").show();
                    $("#cart").html(data['cartData']);
                    return false;
                }else if(data['Cart'] == "disabled"){
                    $("#SaleIndexForm").hide();
                    return false;
                }
                
            },
            error:function(){
                return false;
            }
            });
        
    }
};

$(document).ready(function() {
//    eod.init();
});