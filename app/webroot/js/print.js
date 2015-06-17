/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var ucsl_report = {

    init: function() {
     
    
        //callback function to handle supplier detail listing for editing
        $("a#print_statement").click(function(event){
            $("#dateRow").hide();
            $("#emailRow").hide();
            $(".inner").printElement();
            $("#dateRow").show();
            $("#emailRow").show();
            event.preventDefault();
            return false;
        });
        //callback function to handle supplier detail listing for editing
        $("a#print_receipt").click(function(event){
            $("#dateRow").hide();
            $("#emailRow").hide();
            $(".inner_print").printElement();
            $("#dateRow").show();
            $("#emailRow").show();
            event.preventDefault();
            return false;
        });
      
       //Events to handle Sales Exec Sales report inputs
        $("#drpSalesPerson").change(function(event) {
            
            var exec_id = $(this).val();
            //var host = window.location.hostname;
            // window.location.href = host + '/Stocks/index/'+supplierID;
            ucsl_report.selectExecCustomers(exec_id)
            event.preventDefault();
            return false;
            
        });
       
       
    },
    selectExecCustomers: function(execID){
        // $("#welcome_message").show();
        //$("#progress_msg").html("Commiting Transaction").show();
        // $("#welcome_message").hide(5000);
           
        var url = '../Reports/getExecCustomers';
        var query = "action=getExecCustomers&" + "sales_person=" + execID;
        $.post(url, query, function(data){
//                alert(data);return false;
                if(data['status'] == "ok") {    
                 
                    $.each(data['data'], function(index, value) {
//                        alert(index + ': ' + value);
            if(data['data'][index]['Customer']['fullname'] != null && data['data'][index]['Customer']['fullname'] != ""){
                        $('<option value="'+data['data'][index]['Customer']['id']+'">'+data['data'][index]['Customer']['fullname']+'</option>').appendTo('#OrdersItemCustomer');
            }
                    });
                    return false;
                
                } else if(data['status'] == 'fail'){
//                     $("#progress_msg").hide();
//                    $("#welcome_message").show();
//                    $("#error_msg").html("Unable to Retrieve Sales Executive Details").show('slow');
                    return false;
                }
                   
        }, "json");
        return false;
//        $("#error_msg").hide();
//        
//        $.ajax({
//            url: verification_url,
//            data: query,
//            dataType: 'json',
//            type: 'POST',
//            success:function(data) {
//                
//                if(data['status'] == "ok") {    
//                   
//                    $.each(data['data']['Customer'], function(index, value) {
//                        alert(index + ': ' + value);
//                        $('<option value="'+index+'">'+value+'</option>').appendTo('#OrderCustomer');
//                       
//                    });
//                    return false;
//                
//                } else if(data['status'] == 'fail'){
//                     $("#progress_msg").hide();
//                    $("#welcome_message").show();
//                    $("#error_msg").html("Unable to Retrieve Sales Executive Details").show('slow');
//                    return false;
//                }
//            },
//            error: function() {
//                $("#progress_msg").hide();
//                $("#welcome_message").show();
//                $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
//                $("#welcome_message").hide(5000);
//            }
//        });
    }
    
};

$(document).ready(function() {
    ucsl_report.init();
   
   
    
});
