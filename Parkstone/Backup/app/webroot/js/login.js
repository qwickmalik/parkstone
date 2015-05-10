/**
 * The Javascript object to handle login related code
 */
var login = {

    verification_url: 'Users/login',

    init: function() {
        // bind the open action to the Login link
        $("a#login-link").click(function() {
            login.doLogin();
            event.preventDefault();
            return false;
        });
       
    },

    doLogin: function() {
        $("#progress_msg").html("Verifying User Credentials").show();
        var query = "action=login&" + $("#loginDisplayForm").serialize();
      
        $("#error_msg").hide();
        $.ajax({
            url: this.verification_url,
            data: query,
            dataType: 'json',
            type: 'POST',
            success:function(data) {
              
                if( data && data.error ) {
                    $("#progress_msg").hide();
                    $("#error_msg").html( data.error ).show('slow');
                    $("#username").focus();
                } else if(data["error"] == "Username Not Valid"){
                    alert("Invalid Username Entered!!");
                    return false;
                }else if(data["error"] == "Password Not Valid"){
                    alert("Invalid Password!!");
                    return false;
                }else {
                    $("#progress_msg").html("User Credentials Verified. Redirecting To Dashboard");
                    window.location = 'Dashboard/index/';
                }
            },
            error: function() {
                $("#progress_msg").hide();
                $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
            }
        });
    }
};

$(document).ready(function() {
    login.init();
});