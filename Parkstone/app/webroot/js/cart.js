
var cart = {

    cart_url: 'check_cart',

    init: function() {
        // check if the cart is empty
       cart.checkCart();
       
    },


    checkCart:function(){
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
    cart.init();
});