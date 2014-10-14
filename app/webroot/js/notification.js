//The Javascript object to handle notification related code
//JSON Object to handle Sales Page
var sale = {

    verification_url: 'add',
    delete_url:'delSale',
    complete_url: 'complete',
    
    init: function() {
        
        
        // bind the open action to the Login link
        $("button#b_blue").click(function(event) {
            var tempsale = $("#TempSaleSellingPrice").val();
            tempsale = $.trim(tempsale);
            var emptyTextBoxes = $('input.large').filter(function() {
                return this.value == "";
            });
            //            var selectLength = $('select#SendIdType').val();
            var txtLength = emptyTextBoxes.length;
          
            var quan = 0;
            quan += Number($("#TempSaleQuantity").val());
            
            //alert(quan);
            var itemSer = $("#TempSaleItemId").val();
            itemSer = $.trim(itemSer);
            
            var stock = 0
            stock += Number($("#stock").val());
            
            //check if stock is empty
            if( stock != "" && stock <= 0){
                
                alert("Sorry Out of Stock");
                return false;
            }
            
            
            
            //check if quantity selected is more than stock
            if(quan > stock){
                
                alert("Sorry Item Quantity Set Is More Than Stock Value");
                return false;
            }
            
            //set quantity_remaining
            if(stock > quan){
                
                var quan_remaining = stock - quan;
               // $(".sp_stock").html(quan_remaining);
                $("#stock").val(quan_remaining);
            }
            if(itemSer == ""){
            
                $("#TempSaleItemId").css("border-color", "red");
            
                
                alert("Please Choose an Item!!!");
                return false;
            }
            $("#TempSaleItemId").css("border-color", "dodgerblue");
            if(tempsale == ""){
            
                $("#TempSaleSellingPrice").css("border-color", "red");
            
                
                alert("Please Enter Price!!!");
                return false;
            }
            
            $(".large").css("border-color", "dodgerblue");
             
            var hidservice = $("#hidservice").val();
            //             if (!($("#TempSaleQuantity").getAttribute("disabled") == "disabled")){
                
//            if(hidservice == "" && quan == ""){
//            
//                $("#TempSaleQuantity").css("border-color", "red");
//            
//                
//                alert("Please Enter Quantity!!!");
//                return false;
//            }
//            $(".large").css("border-color", "dodgerblue");
             
            //            }
             
            var clientCom = $("#TempSaleClientId").val();
            clientCom = $.trim(clientCom);
            if(clientCom == ""){
            
                $("#TempSaleClientname").css("border-color", "red");
            
                
                alert("Please Choose an Client!!!");
                return false;
            }
            $("#TempSaleClientname").css("border-color", "dodgerblue");
             
             
            sale.doNotify();
            $("#welcome_message2").hide();
            event.preventDefault();
            return false;
        });
        
        //event to handle delete all sale items
        $("button#del_sale").click(function(event) {
            var itemaction = 'all';
            sale.deleteSale(itemaction);
            $("#welcome_message2").hide();
            event.preventDefault();
            return false;
        });
        var checkedItems = new Array();
        //event to handle delete single sale item
        $("#btnDeleteItem").click(function(event) {
            event.preventDefault();
            var checkBoxes = $("input[id=btnD]");
            $('#btnD :checked').each(function() {
                checkedItems.push($(this).val());
            });
            
            //            $.each(checkBoxes, function() {
            //                if ($(this).attr('checked')){
            //                    //do stuff
            //                     checkedItems.push($(this).val());
            //                }
            //            });
           
            //           if(confirm("Are you sure you want to delete!!")){
            sale.deleteSale(checkedItems);
            $("#welcome_message2").hide();
            //           }
            
            return false;
        });
        $("#btnD").change(function(event){
            $(this).attr('checked','checked');
        });
        
        $("button#c_blue").click(function(event) {
            
             
            var amountCom = $("#SaleAmountPaid").val();
            amountCom = $.trim(amountCom);
            if(amountCom == ""){
            
                $("#SaleAmountPaid").css("border-color", "red");
            
                
                alert("Please Enter Payment Amount!!!");
                return false;
            }
            var amount_paid = 0;
            amount_paid  += Number(amountCom);
            var total_cost = 0;
            total_cost += Number($("#hidtotcost").val());
               
               
            $("#SaleAmountPaid").css("border-color", "dodgerblue");
            
              var salesperson = $("#SaleUserId").val();
            salesperson = $.trim(salesperson);
             if(salesperson == ""){
            
                $("#SaleUserId").css("border-color", "red");
            
                
                alert("Please Select A Sales Person!!!");
                return false;
            }
             $("#SaleUserId").css("border-color", "dodgerblue");
            //             var emptyT = $("input[name=data[Sale][payment_status]]:radio").filter(function() {return this.checked;});
            ////            var selectLength = $('select#SendIdType').val();
            //           var txtLength = emptyT.length;
           
            //             var status1 = $("#SalePaymentStatusCredit").val();
            //              var status2 = $("#SalePaymentStatusPartPayment").val();
            //              var status3 = $("#SalePaymentStatusFullPayment").val();
            //              
            //              status1 = $.trim(status1);
            //              status2 = $.trim(status2);
            //              status3 = $.trim(status3);
            //                 var n = $("input:checked").length;
            //               if( n < 2){
            //            
            //                alert("Please Select a Payment Status!!!");
            //                 return false;
            //            }
            sale.doComplete();
            $("#welcome_message").hide();
            event.preventDefault();
            return false;
        });
    },
    doComplete: function(){
        $("#welcome_message").show();
        $("#progress_msg").html("Commiting Transaction").show();
        $("#welcome_message").hide(5000);
        var totcost = $("#hidtotcost").val();
        var query = "action=complete&"+"hidtotcost=" + totcost + "&" + $("#SaleIndexForm").serialize();
      
        $("#error_msg").hide();
        $.ajax({
            url: this.complete_url,
            data: query,
            dataType: 'json',
            type: 'POST',
            success:function(data) {
           
                if( data['action'] == "receipt" ) {
                    var saleID = data['saleID'];
                    var clientInfo = data['clientInfo'];
                    $("#welcome_message").show();
                    $("#progress_msg").html("Transaction Complete").show('slow').hide(9000);
                    $("#welcome_message").hide(5000);
                    
                    window.location = '../Sales/receipt/'+saleID+'/'+clientInfo+'/sale';
                    return false;
                } else if(data['feedback'] == "success"){

                    $("#welcome_message").show();
                    $("#progress_msg").html("Transaction Complete").show('slow').hide(9000);
                    $("#welcome_message").hide(5000);
                    window.location = '../Dashboard/';
                    //$("#SaleIndexForm").show();
                    return false;
                }else if(data['feedback'] == "Debtor Saving Error"){

                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Debtor Saving Error").show('slow');
                    $("#welcome_message").hide(5000);
                    //window.location = '../Dashboard/'
                    //$("#SaleIndexForm").show();
                    return false;
                }else if(data['feedback'] == "error"){

                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Sale Checkout Error").show('slow');
                    $("#welcome_message").hide(5000);
                    //window.location = '../Dashboard/'
                    //$("#SaleIndexForm").show();
                    return false;
                }else if(data["feedback"] == 'One Time Shopper'){
                
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Sorry No Credit for Onetime Shoppers").show('slow');
                    $("#welcome_message").hide(7000);
                    alert("Sorry No Credit for Onetime Shoppers");
                    $("#SaleAmountPaid").focus().css("border-color", "red");
                    return false;
                }
            
            },
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
    },
    
    deleteSale: function(item){
    
    
        var query = "action=delSale&" + "saleId=" + item;
        var url = this.delete_url;
        $.post(url, query, function(data){
            //        alert(data);
            //        return false;
            if(data == "success"){
                $("input").val('');
                $("select").val('');
                $("#welcome_message").show();
                $("#progress_msg").html("Sale Successfully Deleted!!").show('slow').hide(5000);
                alert("Sale Successfully Deleted!!");
                $("#welcome_message").hide(5000);
                $("#cart").html('');
                window.location.reload();
                return false;
            }
            else if(data == "unsuccessful"){
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Delete Sale Error!!").show('slow');
                alert("Delete unsuccessful. Contact System Admin!!!");
                $("#welcome_message").hide(5000);
                return false;
            }
            else{
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error,Contact System Admin!!").show('slow');
                alert("Delete unsuccessful. Contact System Admin!!!");
                $("#welcome_message").hide(5000);
                return false;
            }
        },"html");
    },

    
    doNotify: function(){
        $("#welcome_message").show();
        $("#progress_msg").html("Commiting Transaction").show();
        $("#welcome_message").hide(5000);
        var query = "action=add&" + $("#TempSaleIndexForm").serialize();
      
        $("#error_msg").hide();
        
        $.ajax({
            url: this.verification_url,
            data: query,
            dataType: 'json',
            type: 'POST',
            success:function(data) {
                if(  data['feedback'] == "unsuccessful") {                   
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Server Error. Contact System Admin").show('slow');
                
                } else if(data['feedback'] == 'successful'){
                    $("#welcome_message").show();
                    $("#progress_msg").html("Transaction Successful").show('slow').hide(5000);
                    $("#welcome_message").hide(5000);
                    $("#SaleIndexForm").show();
                    $("#cart").html(data['result']);
                    //$("#stock").val("");
                    $("#TempSaleQuantity").val("");
                   
                    return false;
                }
            },
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
    }
    
    
    
    
};

//sale complete button event handler


var price = {

    verification_url: 'getPrice',

    init: function() {
        // bind the open action to the Login link
        $("select#TempSaleItemId").change(function(event) {
            $("#TempSaleSellingPrice").val("");
            $("#TempSaleQuantity").val("");
             $("#TempSaleQuantity").val("");
            $("#TempSaleWarehouse").val("");
             $("#TempSaleSerialno").val("");
            $("#TempSaleItemName").val("");  
            $("#TempSaleModelno").val("");
            price.updatePrice();
            event.preventDefault();
            return false;
        });
       
    },
    
    updatePrice: function(){
    
        var item = $("select#TempSaleItemId").val();
        var query = "action=getPrice&" + "saleId=" + item;
        var url = this.verification_url;
        $.post(url, query, function(data){
       
            $("#TempSaleSellingPrice").val(data['salesResult']['selling_price']);
            $(".sp_stock").html(data['salesResult']['remaining_quantity']);
            $("#TempSaleSerialno").val(data['salesResult']['serialno']);
            $("#TempSaleItemName").val(data['salesResult']['item']+' - '+data['salesResult']['modelno']);  
            $("#TempSaleModelno").val(data['salesResult']['modelno']);
            $("#TempSaleWarehouse").val(data['warehs']['warehouse']);
            var item_type = data['salesResult']['item_type'];
            var quantity = data['salesResult']['remaining_quantity'];
            $("#stock").val(data['salesResult']['remaining_quantity']);
            if(quantity <= 0){
                alert("Sorry Item Out of Stock");
                return false;
            }
            if( item_type == 1){
                $("#TempSaleQuantity").val("1");
                //             $("#TempSaleQuantity").attr("disabled","disabled");
                $("#hidservice").val("1");
            } 
            if( item_type == 0){
                $("#TempSaleQuantity").removeAttr("disabled");
                $("#hidservice").val("");
            }   
            if(quantity <= 0){
                $("#stock").val("0");
                alert("Sorry Item Out of Stock");
                return false;
            }
        },"json");
    }
};

var setup = {

    verification_url: 'setup',

    init: function() {
        // bind the open action to the Login link
        $("button#company_submit").click(function(event) {
            
            setup.doSetup();
            $("#welcome_message").hide();
            event.preventDefault(event);
            return false;
        });
       
    },
    
    
    doSetup: function(){
        $("#welcome_message").show();
        $("#progress_msg").html("Commiting Transaction").show();
        $("#welcome_message").hide(5000);
        var query = "action=setup&" + $("#SettingSetupForm").serialize();
      
        $("#error_msg").hide();
        $.ajax({
            url: this.verification_url,
            data: query,
            dataType: 'html',
            type: 'POST',
            success:function(data) {
                if(  data == "unsuccessful") {                   
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                
                } else{
                    $("#welcome_message").show();
                    $("#progress_msg").html("Company Setup Information Successfully Saved!!").show('slow').hide(5000);
                    $("#welcome_message").hide(5000);
                    
                   
                    return false;
                }
            },
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
    }
    
    
    
    
};

//JSON Object to handle Item List Page
var list = {

    verification_url: 'itemsList',
    
    init: function() {
        
       //check for empty invoice number
       $("input#ItemItem").change(function(){
           var supinvoice = $("#ItemSupplyInvoiceno").val();
           if(supinvoice == ""){
               alert("Invoice Number Empty");
               $("input#ItemSupplyInvoiceno").focus();
               return false;
           }
       });
        // callback function to handle item type select and disable quatity if type is service
        $("select#ItemItemType").change(function(){
            var item_type = $(this).val();
            if(item_type == "1"){
                $("input#ItemOriginalQuantity").attr("disabled", "disabled");
                $("input#ItemRemainingQuantity").attr("disabled", "disabled");
            }
            
            
        });
        
        //delete single items
        $('.item_del').click(function(event){
            
            var itemaction = $(this).attr('name');
            if(confirm("Are you sure you want to delete!!!")){
                list.deleteItem(itemaction);
                $("#welcome_message2").hide();
            }
            event.preventDefault();
            return false;
        });
        
        //callback function to handle item posting/submission
        $("button#itemBTN").click(function(event) {
            
            list.doList();
            $("#welcome_message").hide();
            event.preventDefault(event);
            return false;
        });
        
        //callback function to handle item detail listing for editing
        $(".itemAnchor a").click(function(event){
            var itemID = $(this).attr("class");
            list.displayInfo(itemID);
            event.preventDefault();
            return false;
        });
       
        //callback function to handle supplier detail display
        $("#ItemSupplierId").change(function(event){
            var supplierID = $(this).val();
            //var host = window.location.hostname;
            // window.location.href = host + '/Stocks/index/'+supplierID;
            list.filterBySupplier(supplierID)
            event.preventDefault();
            return false;
        });
    },
    
    displayInfo: function(item){
        
        var url =  '../Settings/displayInfo';
        var query = "action=displayInfo&" + "ItemId=" + item;
        $.post(url, query, function(data){
               
              
            $("#ItemItem").val(data['Item']['item']);
              
            $("#ItemItemType").val(data['Item']['item_type']);
            if(data['Item']['item_type'] == 1){
                 
                $("#ItemOriginalQuantity").attr("disabled","disabled");
                $("#ItemRemainingQuantity").attr("disabled","disabled");
            }
            if(data['Item']['item_type'] == 0){
                 
                $("#ItemOriginalQuantity").removeAttr("disabled");
                $("#ItemRemainingQuantity").removeAttr("disabled");
            }
            $("#ItemId").val(data['Item']['id']);
            $("#ItemCostPrice").val(data['Item']['cost_price']);
            $("#ItemSellingPrice").val(data['Item']['selling_price']);
            $("#ItemOriginalQuantity").val(data['Item']['original_quantity']);
            $("#ItemRemainingQuantity").val(data['Item']['remaining_quantity']);
            
            $("#ItemModelno").val(data['Item']['modelno']);
            $("#ItemBrand").val(data['Item']['brand']);
            $("#ItemDescription").val(data['Item']['description']);
            $("#ItemWarehouseId").val(data['Item']['warehouse_id']);//val(data['Item']['warehouse_id']);
            $("#ItemSerialno").val(data['Item']['serialno']);
            $("#ItemSupplyInvoiceno").val(data['Item']['supply_invoiceno']);
                 
        }, "json");
        return false;
    },
    
    filterBySupplier: function(supplier){
          
        var url = '../Stocks/supplierInfo';
        var query = "action=supplierInfo&" + "SupplierId=" + supplier;
        $.post(url, query, function(data){
               
              
            
            if(data['status'] == 'ok'){
                //                $(".supplierid").html(data['supplier']['Supplier']['id']);
                //                $(".address").html(data['supplier']['Supplier']['supplier_address']);
                //                $(".tele").html(data['supplier']['Supplier']['supplier_tel']);
                //                $(".email").html(data['supplier']['Supplier']['supplier_email']);
                //window.location = '../Stocks/index/'+supplier;
                window.location.reload(); 
                return false;
            }
            else if(data['status'] == 'fail'){
                window.location.reload(); 
                return false;
            }
            
            
                 
        }, "json");
        
    },
    
    deleteItem: function(item){
    
    
        var query = "action=delItem&" + "itemId=" + item;
        var url = '../Settings/delItem/';
        $.post(url, query, function(data){
        
            if(data == "success"){
                $("input").val('');
                $("select").val('');
                $("#welcome_message").show();
                $("#progress_msg").html("Item Successfully Deleted!!").show('slow').hide(5000);
                alert("Item Successfully Deleted!!");
                $("#welcome_message").hide(5000);
                window.location.reload();
                return false;
            }
            else if(data == "unsuccessful"){
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Item Delete Error!!").show('slow');
                alert("Delete unsuccessful. Contact System Admin!!!");
                $("#welcome_message").hide(5000);
                return false;
            }
            else{
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error,Contact System Admin!!").show('slow');
                alert("Delete unsuccessful. Contact System Admin!!!");
                $("#welcome_message").hide(5000);
                return false;
            }
        },"html");
    },
    doList: function(){
        $("#welcome_message").show();
        $("#progress_msg").html("Commiting Transaction").show();
        $("#welcome_message").hide(5000);
        var query = "action=itemsList&" + $("#ItemItemsListForm").serialize();
      
        $("#error_msg").hide();
        $.ajax({
            url: this.verification_url,
            data: query,
            dataType: 'html',
            type: 'POST',
            success:function(data) {
                if(  data == "unsuccessful") {                   
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                
                } else if(data == "success"){
                    $("#welcome_message").show();
                    $("#progress_msg").html("Item Successfully Saved!!").show('slow').hide(5000);
                    $("#welcome_message").hide(5000);
                    
                    $("#ItemId").val("");
                    $("#ItemItem").val("");
              
                    $("#ItemItemType").val("");
                    $("#ItemCostPrice").val("");
                    $("#ItemSellingPrice").val("");
                    $("#ItemOriginalQuantity").val("");
                    $("#ItemRemainingQuantity").val("");
                   
                    return false;
                }
            },
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
    }
    
    
    
    
    
};
//JSON Object to handle Client Page
var client = {

    verification_url: '../Settings/clientsList/',

    init: function() {
        
        //callback function to handle client saving/submission
        $("button#clientBtn").click(function(event) {
            
            client.doClient();
            $("#welcome_message").hide();
            event.preventDefault(event);
            return false;
        });
        
        //Delete Client
        $('.client_del').click(function(event){
            
            var itemaction = $(this).attr('name');
            if(confirm("Are you sure you want to delete!!!")){
                client.deleteClient(itemaction);
                $("#welcome_message2").hide();
            }
            event.preventDefault();
            return false;
        });
        
        //callback function to handle supplier detail listing for editing
        $(".clientAnchor a").click(function(event){
            var clientID = $(this).attr("class");
            client.clientInfo(clientID);
            event.preventDefault();
            return false;
        });
       
       
    },
    
    clientInfo: function(item){
          
        var url = '../Settings/clientInfo';
        var query = "action=clientInfo&" + "clientId=" + item;
        $.post(url, query, function(data){
               
            $("#ClientClientName").val(data['Client']['client_name']);
            $("#ClientClientContact").val(data['Client']['client_contact']);
            $("#ClientId").val(data['Client']['id']);
               
                
                 
        }, "json");
        return false;
    },
    
    deleteClient: function(item){
    
    
        var query = "action=delCash&" + "clientId=" + item;
        var url = '../Settings/delClient/';
        $.post(url, query, function(data){
        
            if(data == "success"){
                $("input").val('');
                $("select").val('');
                $("#welcome_message").show();
                $("#progress_msg").html("Client Successfully Deleted!!").show('slow').hide(5000);
                alert("Client Successfully Deleted!!");
                $("#welcome_message").hide(5000);
                window.location.reload();
                return false;
            }
            else if(data == "unsuccessful"){
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Client Delete Error!!").show('slow');
                alert("Delete unsuccessful. Contact System Admin!!!");
                $("#welcome_message").hide(5000);
                return false;
            }
            else{
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error,Contact System Admin!!").show('slow');
                alert("Delete unsuccessful. Contact System Admin!!!");
                $("#welcome_message").hide(5000);
                return false;
            }
        },"html");
    },
    doClient: function(){
        $("#welcome_message").show();
        $("#progress_msg").html("Commiting Transaction").show();
        $("#welcome_message").hide(5000);
        var query = "action=clientsList&" + $("#ClientClientsListForm").serialize();
      
        $("#error_msg").hide();
        $.ajax({
            url: this.verification_url,
            data: query,
            dataType: 'html',
            type: 'POST',
            success:function(data) {
                if(  data == "unsuccessful") {                   
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                    return false;
                
                } else if(data == "success") {
                    $("#welcome_message").show();
                    $("#progress_msg").html("Client Details Successfully Saved!!").show('slow').hide(5000);
                    $("#welcome_message").hide(5000);
                    $("#ClientClientName").val("");
                    $("#ClientClientContact").val("");
                    $("#ClientId").val("");
                    window.location.reload(); 
                    return false;
                }
            },
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
    }
    
    
    
    
};

//JSON Object to handle User Administration Page
var user = {

    verification_url: 'users',

    init: function() {
        
        //callback function to handle user saving/submission
        $("button#userBtn").click(function(event) {
            
            
            
            var passwd = $("#UserConfirmPassword").val();
            var confirmp = $("#UserPass").val();
            if(passwd != confirmp){
                $("#welcome_message").show();
                $("#error_msg").html("Passwords Do Not Match!!").show('slow').hide(6000);
                $("#welcome_message").hide(6000);
                $("#UserPass").css("border-color", "red").focus();
                
                $("#UserConfirmPassword").css("border-color", "red");
                return false;
                
            }
         
            user.doUser();
            $("#welcome_message").hide();
            //event.preventDefault();
            return false;
        });
       
        //callback function to handle user detail listing for editing
        $(".userAnchor a").click(function(event){
            var userID = $(this).attr("class");
            user.userInfo(userID);
            event.preventDefault();
            return false;
        });
        //event to handle delete single sale item
        $('.user_del').click(function(event){
            
            var itemaction = $(this).attr('id');
            if(confirm("Are you sure you want to delete!!!")){
                user.deleteUser(itemaction);
                $("#welcome_message2").hide();
            }
            event.preventDefault();
            return false;
        });
    
    },
    
    userInfo: function(item){
          
        var url = '../Users/userInfo';
        var query = "action=userInfo&" + "userId=" + item;
        $.post(url, query, function(data){
               
              
            $("#UserUsername").val(data['User']['username']);
            $("#UserFirstname").val(data['User']['firstname']);
            $("#UserLastname").val(data['User']['lastname']);
            $("#UserUsertype").val(data['User']['usertype']);
            $("#UserId").val(data['User']['id']);
            $("#UserUserdepartmentId").val(data['User']['userdepartment_id']); 
            $("#UserUsertypeId").val(data['User']['usertype_id']);
                 
        }, "json");
        return false;
    },
    deleteUser: function(item){
    
    
        var query = "action=delUser&" + "userId=" + item;
        var url = '../Users/delUser/';
        $.post(url, query, function(data){
        
            if(data == "success"){
                $("input").val('');
                $("select").val('');
                $("#welcome_message").show();
                $("#progress_msg").html("User Successfully Deleted!!").show('slow').hide(5000);
                alert("User Successfully Deleted!!");
                $("#welcome_message").hide(5000);
                window.location.reload();
                return false;
            }
            else if(data == "unsuccessful"){
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Delete User Error!!").show('slow');
                alert("Delete unsuccessful. Contact System Admin!!!");
                $("#welcome_message").hide(5000);
                return false;
            }
            else{
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error,Contact System Admin!!").show('slow');
                alert("Delete unsuccessful. Contact System Admin!!!");
                $("#welcome_message").hide(5000);
                return false;
            }
        },"html");
    },
    doUser: function(){
        $("#welcome_message").show();
        $("#progress_msg").html("Commiting Transaction").show();
        $("#welcome_message").hide(5000);
        var query = "action=users&" + $("#UserUsersForm").serialize();
      
        $("#error_msg").hide();
        $.ajax({
            url: this.verification_url,
            data: query,
            dataType: 'html',
            type: 'POST',
            success:function(data) {
                
                if(  data == "unsuccessful") {                   
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                    return false;
                } else if(data == "success"){
                    $("#welcome_message").show();
                    $("#progress_msg").html("User Details Successfully Saved!!").show('slow').hide(5000);
                    $("#welcome_message").hide(5000);
                    
                    $("#UserPass").css("border-color", "dodgerblue");
                    $("#UserConfirmPassword").css("border-color", "dodgerblue");
                    $("#UserUsername").css("border-color", "dodgerblue");
                    $("#UserUsername").val("");
                    $("#UserConfirmPassword").val("");
                    $("#UserPass").val("");
                    $("#UserFirstname").val("");
                    $("#UserLastname").val("");
                    $("#UserUsertype").val("");
                    $("#UserId").val("");
                    window.location.reload();
                    return false;
                }else if(data == "user exists"){
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#UserUsername").focus();
                    $("#UserUsername").css("border-color", "red");
                    alert("Sorry Username Already In Use!!")
                    $("#error_msg").html("Sorry Username Already In Use!!").show('slow');
                    return false;
                }
            },
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
    }
    
    
    
    
};

//JSON Object to handle Debtor Details Page
var debt = {
    


    init: function() {
        // callback function to handle item type select and disable quatity if type is service
        $("select#DebtorDebtorId").change(function(event){
          
            $("#debt_saledate").val("");
            $("#debt_totcost").val("");
            $("#debt_bal").val("");
            debt.debtdetails();
            event.preventDefault();
            return false;
        });
        
        $("button#btn_debt").click(function(event){
            
            var debtID = $("#DebtorDebtorId").val();
            debtID = $.trim(debtID);
            if(debtID == ""){
                alert("Please Select Sale ID");
                return false;
            }
            
            debt.doDebtPayment();
            event.preventDefault();
        });
        
        //callback function to handle user detail listing for editing
        $(".debtAnchor a").click(function(event){
            var debtID = $(this).attr("class");
            var debtName = $(this).attr("id");
            debt.debtInfo(debtID,debtName);
            event.preventDefault();
            return false;
        });
       
    },
    
    debtdetails: function(){
        var sale_no = $("select#DebtorDebtorId").val();
        
        var query = "action=displayDebt&" + "debtId=" + sale_no;
        var url =  '../Debtors/displayDebt/';
        $.post(url, query, function(data){
     
            $("#debt_saledate").html(data['Debtor']['sale_date']);
            $("#debt_totcost").html(data['Debtor']['total_cost']);
            $("#debt_bal").html(data['Debtor']['balance']);
            $("#debt_paid").html(data['Debtor']['amount_paid']);
        // $("#TempSaleSellingPrice").val(data);
        },"json");
    
    },
    doDebtPayment: function(){
        $("#welcome_message").show();
        $("#progress_msg").html("Commiting Transaction").show();
        $("#welcome_message").hide(5000);
        var query = "action=debtPayment&" + $("#DebtorIndexForm").serialize();
      
        $("#error_msg").hide();
        $.ajax({
            url:  '../Debtors/debtPayment',
            data: query,
            dataType: 'html',
            type: 'POST',
            success:function(data) {
       
                if(  data == "unsuccessful") {                   
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Data Error. Check Server and Database Configurations").show('slow');
                    return false;
                    
                } else if(data == "success"){
                    $("#welcome_message").show();
                    $("#progress_msg").html("Payment Successfully Saved!!").show('slow').hide(5000);
                    $("#welcome_message").hide(5000);
                    debt.debtdetails();
                    $("#DebtorAmountPaid").val("");
                    return false;
                }else if(data ==  "Error reaching server"){
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                    return false;
                    
                }
            },
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
    },
    debtInfo: function(item,name){
          
        var url = '../Debtors/listTransactions';
        var query = "action=listTransactions&" + "clientId=" + item;
        // window.location = "../Debtors/";
        //window.location = "../Debtors/index/" + item;
        // window.location = "../Debtors/";
        $.post(url, query, function(data){
               
            if(data['feedback']=="Debtor Retrieve Error"){
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Debtor Retrieve Error.").show('slow');
                return false;
                  
            }else{
                $("#debtor").html(name);
                $("#DebtorDebtorId").html('<option value="">--Please Select Debt ID--</option>');
                $.each(data, function(property, value) {
                    
                    $("#DebtorDebtorId").append('<option value="' + property+ '">' + value + '</option>');
        
                });
                    
            }

        }, "json");
        return false;
    }
};

//JSON Object to handle Supplier Details Page
var supplier = {

    verification_url: 'suppliers',

    init: function() {
        
        //callback function to handle client saving/submission
        $("button#supBtn").click(function(event) {
            
            supplier.doSupplier();
            $("#welcome_message").hide();
            event.preventDefault(event);
            return false;
        });
        
        //Delete Client
        $('.supplier_del').click(function(event){
            
            var itemaction = $(this).attr('name');
            if(confirm("Are you sure you want to delete!!!")){
                supplier.deleteSupplier(itemaction);
                $("#welcome_message2").hide();
            }
            event.preventDefault();
            return false;
        });
        //callback function to handle supplier detail listing for editing
        $(".supplierAnchor a").click(function(event){
            var supplyID = $(this).attr("class");
            supplier.supplyInfo(supplyID);
            event.preventDefault();
            return false;
        });
       
    
    },
    
    supplyInfo: function(item){
          
        var url = '../Stocks/supplyInfo';
        var query = "action=supplyInfo&" + "SupplyId=" + item;
        $.post(url, query, function(data){
               
            $("#SupplierId").val(data['Supplier']['id']);
            $("#SupplierSupplierName").val(data['Supplier']['supplier_name']);
            $("#SupplierSupplierAddress").val(data['Supplier']['supplier_address']);
            $("#SupplierSupplierTel").val(data['Supplier']['supplier_tel']);
            $("#SupplierSupplierEmail").val(data['Supplier']['supplier_email']);
            $("#SupplierBank1Name").val(data['Supplier']['bank1_name']);
            $("#SupplierBank1Branch").val(data['Supplier']['bank1_branch']);
            $("#SupplierBank1AccNo").val(data['Supplier']['bank1_acc_no']);
            $("#SupplierBank2Name").val(data['Supplier']['bank2_name']);
            $("#SupplierBank2Branch").val(data['Supplier']['bank2_branch']);
            $("#SupplierBank2AccNo").val(data['Supplier']['bank2_acc_no']);
                
                 
        }, "json");
        return false;
    },
    deleteSupplier: function(item){
    
    
        var query = "action=delSupplier&" + "supplierId=" + item;
        var url = '../Settings/delSupplier/';
        $.post(url, query, function(data){
        
            if(data == "success"){
                $("input").val('');
                $("select").val('');
                $("#welcome_message").show();
                $("#progress_msg").html("Item Successfully Deleted!!").show('slow').hide(5000);
                alert("Supplier Successfully Deleted!!");
                $("#welcome_message").hide(5000);
                window.location.reload();
                return false;
            }
            else if(data == "unsuccessful"){
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Item Delete Error!!").show('slow');
                alert("Delete unsuccessful. Contact System Admin!!!");
                $("#welcome_message").hide(5000);
                return false;
            }
            else{
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error,Contact System Admin!!").show('slow');
                alert("Delete unsuccessful. Contact System Admin!!!");
                $("#welcome_message").hide(5000);
                return false;
            }
        },"html");
    },
    doSupplier: function(){
        $("#welcome_message").show();
        $("#progress_msg").html("Commiting Transaction").show();
        $("#welcome_message").hide(5000);
        var query = "action=suppliers&" + $("#SupplierSuppliersForm").serialize();
      
        $("#error_msg").hide();
        $.ajax({
            url: this.verification_url,
            data: query,
            dataType: 'html',
            type: 'POST',
            success:function(data) {
                if(  data == "unsuccessful") {                   
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                
                } else if(data == "success"){
                    $("#welcome_message").show();
                    $("#progress_msg").html("Supplier Details Successfully Saved!!").show('slow').hide(5000);
                    $("#welcome_message").hide(5000);
                    $("#SupplierId").val("");
                    $("#SupplierSupplierName").val("");
                    $("#SupplierSupplierAddress").val("");
                    $("#SupplierSupplierTel").val("");
                    $("#SupplierSupplierEmail").val("");
                   window.location.reload();
                    return false;
                }
            },
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
    }
    
    
    
    
};

var credit = {

    verification_url: 'processCredit',
    display_url: '../displayCredit',
    payment_url: '../creditPayment',
    credaddition_url: '../Creditors/creditAddition',

    init: function() {
        // callback function to handle item type select and disable quatity if type is service
        $("select#CreditorCreditorId").change(function(event){
          
            $("#bal").val("");
            $("#supDate").val("");
            $("#disb").val("");
            credit.updateCredit();
            event.preventDefault();
            return false;
        });
        
        $("button#supDetBTN").click(function(event){
            
            var transID = $("#CreditorCreditorId").val();
            transID = $.trim(transID);
            if(transID == ""){
                alert("Please Select Transaction ID");
                return false;
            }
            
            credit.doPayment();
            event.preventDefault();
        });
        
        $("button#cred_save").click(function(event){
            
            var supply_cost = $("#SupplyPaymentAmount").val();
            supply_cost = $.trim(supply_cost);
            
            var amount_disb = $("#CreditorAmountDisbursed").val();
            amount_disb = $.trim(amount_disb);
            
            if(supply_cost == ""){
            
                $("#CreditorSupplyCost").css("border-color", "red");
            
                
                alert("Please Enter a Payment Amount!!!");
                return false;
            }
//            if(amount_disb == ""){
//            
//                $("#CreditorAmountDisbursed").css("border-color", "red");
//            
//                
//                alert("Please Enter Disbursement Amount!!!");
//                return false;
//            }
            
            $("input").css("border-color", "dodgerblue");
            var cday = $("select#CreditorSupplyDateDay").val();
            var cmonth = $("select#CreditorSupplyDateMonth").val();
            var cyear = $("select#CreditorSupplyDateYear").val();
            var expire = cyear + '-' + cmonth + '-' + cday;
         
//            credit.doAddition(expire);
            event.preventDefault(); 
        });
       
    },
    //callback function to handle new credit addition
    doAddition: function(dat){
        $("#welcome_message").show();
        $("#progress_msg").html("Commiting Transaction").show();
        $("#welcome_message").hide(5000);
        var query = "action=creditAddition&" +"lastDisb=" + dat + "&" + $("#CreditorIndexForm").serialize();
      
        $("#error_msg").hide();
        $.ajax({
            url: this.credaddition_url,
            data: query,
            dataType: 'html',
            type: 'POST',
            success:function(data) {
            
                if(  data == "unsuccessful") {                   
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                    return false;
                    
                } else if(data == "success"){
                    $("#welcome_message").show();
                    $("#progress_msg").html("Payment Successfully Saved!!").show('slow').hide(5000);
                    $("#welcome_message").hide(5000);
                    return false;
                }
            },
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
    },
    updateCredit: function(){
        var trans_no = $("select#CreditorCreditorId").val();
    
        var query = "action=displayCredit&" + "creditId=" + trans_no;
        var url = this.display_url;
        $.post(url, query, function(data){
     
            $("#bal").html(data['Creditor']['balance']);
            $("#supDate").html(data['Creditor']['supply_date']);
            $("#disb").html(data['Creditor']['last_disb_date']);
        // $("#TempSaleSellingPrice").val(data);
        },"json");
    
    },
    
   
    //callback function to handle item posting/submission
    doCreditor: function(){
        $("#welcome_message").show();
        $("#progress_msg").html("Commiting Transaction").show();
        $("#welcome_message").hide(5000);
        var query = "action=processCredit&" + $("#ItemItemsListForm").serialize();
      
        $("#error_msg").hide();
        $.ajax({
            url: this.verification_url,
            data: query,
            dataType: 'html',
            type: 'POST',
            success:function(data) {
                if(  data == "unsuccessful") {                   
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                   
                    $('input').val('');
                    $('select').val('');
                    return false;
                } else if(data == "success"){
                    $("#welcome_message").show();
                    $("#progress_msg").html("Item Successfully Saved!!").show('slow').hide(5000);
                    $("#welcome_message").hide(5000);
                    $('input').val('');
                    $('select').val('');
                    return false;
                }
            },
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
    },
    
    //callback function to handle credit payment
    doPayment: function(){
        $("#welcome_message").show();
        $("#progress_msg").html("Commiting Transaction").show();
        $("#welcome_message").hide(5000);
        var query = "action=creditPayment&" + $("#CreditorSupplierDetailForm").serialize();
      
        $("#error_msg").hide();
        $.ajax({
            url: this.payment_url,
            data: query,
            dataType: 'json',
            type: 'POST',
            success:function(data) {
              
                if(  data['feedback'] == "unsuccessful") {                   
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                    return false;
                    
                } else if(data['feedback'] == "success"){
                    $("#welcome_message").show();
                    $("#progress_msg").html("Payment Successfully Saved!!").show('slow').hide(5000);
                    $("#welcome_message").hide(5000);
                    $("#bal").html(data['newData']['Creditor']['balance']);
                    $("#supDate").html(data['newData']['Creditor']['supply_date']);
                    $("#disb").html(data['newData']['Creditor']['last_disb_date']);
                    return false;
                }
            },
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
    }
    
    
    
    
};
//
//var cash = {
//
//    save_url: '../CashAccounts/saveCash',
//
//    init: function() {
//        
//        //callback function to handle client saving/submission
//        $("button#expense_save").click(function(event) {
//            
//            cash.doCash();
//            $("#welcome_message").hide();
//            event.preventDefault();
//            return false;
//        });
//        
//        //event to handle delete single sale item
//        $('.button_del').click(function(event){
//            
//            var itemaction = $(this).attr('name');
//            if(confirm("Are you sure you want to delete!!!")){
//                cash.deleteCash(itemaction);
//                $("#welcome_message2").hide();
//            }
//            event.preventDefault();
//            return false;
//        });
//        
//        //callback function to handle supplier detail listing for editing
//        $(".clientAnchor a").click(function(event){
//            var clientID = $(this).attr("class");
//            client.clientInfo(clientID);
//            event.preventDefault();
//            return false;
//        });
//       
//       
//    },
//    
//    clientInfo: function(item){
//          
//        var url = '../Settings/clientInfo';
//        var query = "action=clientInfo&" + "clientId=" + item;
//        $.post(url, query, function(data){
//               
//            $("#ClientClientName").val(data['Client']['client_name']);
//            $("#ClientClientContact").val(data['Client']['client_contact']);
//            $("#ClientId").val(data['Client']['id']);
//               
//                
//                 
//        }, "json");
//        return false;
//    },
//    
//    deleteCash: function(item){
//    
//    
//        var query = "action=delCash&" + "cashId=" + item;
//        var url = '../CashAccounts/delCash/';
//        $.post(url, query, function(data){
//        
//            if(data == "success"){
//                $("input").val('');
//                $("select").val('');
//                $("#welcome_message").show();
//                $("#progress_msg").html("Item Successfully Deleted!!").show('slow').hide(5000);
//                alert("Item Successfully Deleted!!");
//                $("#welcome_message").hide(5000);
//                window.location.reload();
//                return false;
//            }
//            else if(data == "unsuccessful"){
//                $("#progress_msg").hide();
//                $("#welcome_message").show();
//                $("#error_msg").html("Item Delete Error!!").show('slow');
//                alert("Delete unsuccessful. Contact System Admin!!!");
//                $("#welcome_message").hide(5000);
//                return false;
//            }
//            else{
//                $("#progress_msg").hide();
//                $("#welcome_message").show();
//                $("#error_msg").html("Server Error,Contact System Admin!!").show('slow');
//                alert("Delete unsuccessful. Contact System Admin!!!");
//                $("#welcome_message").hide(5000);
//                return false;
//            }
//        },"html");
//    },
//    
//    doCash: function(){
//        $("#welcome_message").show();
//        $("#progress_msg").html("Commiting Transaction").show();
//        $("#welcome_message").hide(5000);
//        var query = "action=saveCash&" + $("#CashAccountIndexForm").serialize();
//      
//        $("#error_msg").hide();
//        $.ajax({
//            url: this.save_url,
//            data: query,
//            dataType: 'json',
//            type: 'POST',
//            success:function(data) {
//               
//                if(  data['feedback'] == "unsuccessful") {                   
//                    $("#progress_msg").hide();
//                    $("#welcome_message").show();
//                    $("#error_msg").html("save error. Check Server or Contact Administrators").show('slow');
//                    return false;
//                } else if(data['feedback'] == "success") {
//                    $("#welcome_message").show();
//                    $("#progress_msg").html("Expense Details Successfully Saved!!").show('slow').hide(5000);
//                    $("#welcome_message").hide(5000);
//                    $("#CashAccountExpenseName").val("");
//                    $("#CashAccountExpenseType").val("");
//                    $("#CashAccountAmount").val("");
//                    $("#CashAccountRemarks").val("");
//                    window.location.reload();
//                    return false;
//                }else if(data['feedback'] == "No Data"){
//                    $("#progress_msg").hide();
//                    $("#welcome_message").show();
//                    $("#error_msg").html("No Data. Server Not Receiving Data. Contact Admin!!").show('slow');
//                }
//            },
//            error: function() {
//                $("#progress_msg").hide();
//                $("#welcome_message").show();
//                $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
//                $("#welcome_message").hide(5000);
//            }
//        });
//    }
//    
//    
//    
//    
//};


var cash = {

    save_url: '../CashAccounts/saveCash',

    init: function() {
        
        $("#exp_desc").hide();
        $("#CashAccountExpenseDesc").hide();
        $("#loan").hide();
        $("#CashAccountLnMonths").hide();
        $("#CashAccountPrincipal").hide();
        $("#CashAccountScdType").hide();
         $(".pettyc").hide();
        
        $("#CashAccountLoanId").change(function() {
            var loan_id = $(this).val();
            
            if(loan_id != ""){
                var query = "action=getloanInfo&" + "loanId=" + loan_id;
                var url = '../CashAccounts/getloanInfo/';
                $.post(url, query, function(data){

                    if(data['status'] == "ok"){
                       
                        $("#CashAccountPrincipal").val(data['loanResult']['Loan']['principal']);
                        $("#CashAccountPrincipalBalance").val(data['loanResult']['Loan']['principal_balance']);
                        $("#CashAccountTinterestDue").val(data['loanResult']['Loan']['interest']);
                        if(data['status2'] == 'sok'){
                        $("#CashAccountInterestDue").val(data['loanexp']);
                        
                        }
                        
                       
                        
                        return false;
                    }
                    else if(data['status'] == "fail"){
//                        $("#progress_msg").hide();
//                        $("#welcome_message").show();
//                        $("#error_msg").html("Item Delete Error!!").show('slow');
//                        alert("Delete unsuccessful. Contact System Admin!!!");
//                        $("#welcome_message").hide(5000);
                        return false;
                    }
                    else{
//                        $("#progress_msg").hide();
//                        $("#welcome_message").show();
//                        $("#error_msg").html("Server Error,Contact System Admin!!").show('slow');
//                        alert("Delete unsuccessful. Contact System Admin!!!");
//                        $("#welcome_message").hide(5000);
                        return false;
                    }
                },"json");
            }
        });
        $("#CashAccountExpenseType").change(function() {
            var csh_extp = $("#CashAccountExpenseType").val();
            
            if(csh_extp == 0){
                $(".exp_desc").show();
                $("#CashAccountExpenseDesc").show();
                $(".zoneclass").show();
            }
            if(csh_extp != 0){
                $(".exp_desc").hide();
                $("#CashAccountExpenseDesc").hide();
                
            }
            
            if(csh_extp == 1){
                $(".loan").show();
                $(".amt").html("Amt Per Repayment:");
                $(".pd").html("Received from");
                $("#CashAccountLnMonths").show();
                $("#CashAccountPrincipal").show();
                $("#CashAccountScdType").show();
                $("#CashAccountFinterest").show();
                $("#CashAccountFprincipal").show();
            }
            if(csh_extp != 1){
                $(".loan").hide();
                $(".amt").html("Amount");
                $(".pd").html("Paid to");
                $("#CashAccountLnMonths").hide();
                $("#CashAccountPrincipal").hide();
                $("#CashAccountScdType").hide();
                $("#CashAccountFinterest").hide();
                $("#CashAccountFprincipal").hide();
            }
            
            if(csh_extp == 4){
                $(".repay").show();
                $(".amt").html("Principal Payment");
                $("#CashAccountInterestDue").show();
                $("#CashAccountTinterestDue").show();
                $("#CashAccountInterestPayment").show();
               // $("#CashAccountPrincipalPayment").show();
                 $("#CashAccountLoanId").show();
                /// $("#CashAccountFprincipal").show();
              
              

            }
            
            if(csh_extp != 4){
                $(".repay").hide();
                $("#amt").html("Amount");
                $("#CashAccountInterestPayment").hide();
                $("#CashAccountInterestDue").hide();
                $("#CashAccountLoanId").hide();

            }
            if(csh_extp == 6){
                $(".deposit").show();
                $("#CashAccountDepositType").show();
               

            }
            
            if(csh_extp != 6){
                $(".deposit").hide();
                $("#CashAccountDepositType").hide();
                
            }
            if(csh_extp == 7){
                $(".pettyc").show();
               $(".zoneclass").show();
            }
            
            if(csh_extp != 7){
                $(".pettyc").hide();
            }
            if(csh_extp !=7 && csh_extp !=0){
                $(".zoneclass").hide();
            }
        });
        
        
        //callback function to handle client saving/submission
        $("button#expense_save").click(function(event) {
            var payment_type = $("#CashAccountExpenseType").val();
            var exp_type = $("#CashAccountExpenseDesc").val();
            var exp_name = $("#CashAccountExpenseId").val(); 
            var amount = $("#CashAccountAmount").val();
            var remarks = $("#CashAccountRemarks").val();
            var auth = $("#CashAccountAmount").val();
            var principal = $("#CashAccountPrincipal").val();
            var schd_type = $("#CashAccountScdType").val();
            var schd_period = $("#CashAccountLnMonths").val();
            var loan_name = $("#CashAccountLoanId").val();
            var interest = $("#CashAccountInterestPayment").val();
            var zone = $("#CashAccountZoneId").val();
            
            var source = $("#CashAccountSource").val(); 
            payment_type = $.trim(payment_type);
            exp_type = $.trim(exp_type);
            exp_name = $.trim(exp_name);
            principal = $.trim(principal);
            schd_type = $.trim(schd_type);
            schd_period = $.trim(schd_period);
            loan_name = $.trim(loan_name);
            auth = $.trim(auth);
            remarks = $.trim(remarks);
            interest = $.trim(interest);
            zone = $.trim(zone);
            source = $.trim(source);
            
            if(exp_name == ""){
                alert("Please Select Payment Name");
                $("#CashAccountExpenseId").css("border-color", "red");
                return false;
            }
            $("#CashAccountExpenseId").css("border-color", "dodgerblue");
            
            if(payment_type == ""){
                alert("Please Select Account Type");
                $("#CashAccountExpenseType").css("border-color", "red");
                return false;
            }
            $("#CashAccountExpenseType").css("border-color", "dodgerblue");
            
            if(payment_type == 0){
               
               
                if(exp_type == ""){
                    alert("Please Select Expense Type");
                    $("#CashAccountExpenseDesc").css("border-color", "red");
                    return false;
                }
                $("#CashAccountExpenseDesc").css("border-color", "dodgerblue");
                if(zone == ""){
                     
                    alert("Please Select Zone");
                    $("#CashAccountZoneId").css("border-color", "red");
                    return false;
                }
                $("#CashAccountZoneId").css("border-color", "dodgerblue");
                    if(source == ""){
                     
                    alert("Please Select Source");
                    $("#CashAccountSource").css("border-color", "red");
                    return false;
                }
                $("#CashAccountSource").css("border-color", "dodgerblue");
            }
            
            
            if(payment_type == 1){
                if(principal == ""){
                    alert("Please Enter Principal Amount");
                    $("#CashAccountPrincipal").css("border-color", "red");
                    return false;
                }
                $("#CashAccountPrincipal").css("border-color", "dodgerblue");
                  
                if(schd_type == ""){
                    alert("Please Select Payment Schedule Type");
                    $("#CashAccountScdType").css("border-color", "red");
                    return false;
                }
                $("#CashAccountScdType").css("border-color", "dodgerblue");
                  
                  
                if(schd_period == ""){
                    alert("Please Enter Payment Schedule Period");
                    $("#CashAccountLnMonths").css("border-color", "red");
                    return false;
                }
                $("#CashAccountLnMonths").css("border-color", "dodgerblue");
                  
            }
            if(payment_type == 4){
                if(loan_name == ""){
                    alert("Please Select Loan Name");
                    $("#CashAccountLoanId").css("border-color", "red");
                    return false;
                }
                $("#CashAccountLoanId").css("border-color", "dodgerblue");
                
                 if(interest == ""){
                    alert("Please Enter Interest Amount");
                    $("#CashAccountInterestPayment").css("border-color", "red");
                   $("#CashAccountInterestPayment").focus();
                }
            }
            
            if(payment_type == 7){
                   if(zone == ""){
                    alert("Please Select Zone");
                    $("#CashAccountZoneId").css("border-color", "red");
                    return false;
                }
                $("#CashAccountZoneId").css("border-color", "dodgerblue");
                
            }
            if(amount == ""){
                alert("Please State Amount");
                $("#CashAccountAmount").css("border-color", "red");
                return false;
            }
            $("#CashAccountAmount").css("border-color", "dodgerblue");
            
//            if(auth == "" || auth == 0 ){
//                alert("Please Select Authoriser");
//                $("#CashAccountUserId").css("border-color", "red");
//                return false;
//            }
//            $("#CashAccountUserId").css("border-color", "dodgerblue");
//            
            if(remarks == ""){
                alert("Please Enter Remarks");
                $("#CashAccountRemarks").css("border-color", "red");
                return false;
            }
            $("#CashAccountRemarks").css("border-color", "dodgerblue");
            
            cash.doCash();
            $("#CashAccountExpenseType").val("");
            $("#welcome_message").hide();
            event.preventDefault();
            return false;
        });
        //event to handle delete single sale item
        $('.button_del').click(function(event){
            
            var itemaction = $(this).attr('name');
            if(confirm("Are you sure you want to delete!!!")){
                cash.deleteCash(itemaction);
                $("#welcome_message2").hide();
            }
            event.preventDefault();
            return false;
        });
        //callback function to handle supplier detail listing for editing
        $(".clientAnchor a").click(function(event){
            var clientID = $(this).attr("class");
            client.clientInfo(clientID);
            event.preventDefault();
            return false;
        });
       
       
    },
    
    clientInfo: function(item){
          
        var url = '../Settings/clientInfo';
        var query = "action=clientInfo&" + "clientId=" + item;
        $.post(url, query, function(data){
               
            $("#ClientClientName").val(data['Client']['client_name']);
            $("#ClientClientContact").val(data['Client']['client_contact']);
            $("#ClientId").val(data['Client']['id']);
               
                
                 
        }, "json");
        return false;
    },
    
    deleteCash: function(item){
    
    
        var query = "action=delCash&" + "cashId=" + item;
        var url = '../CashAccounts/delCash/';
        $.post(url, query, function(data){
        
            if(data == "success"){
                $("input").val('');
                $("select").val('');
                $("#welcome_message").show();
                $("#progress_msg").html("Item Successfully Deleted!!").show('slow').hide(5000);
                alert("Item Successfully Deleted!!");
                $("#welcome_message").hide(5000);
                window.location.reload();
                return false;
            }
            else if(data == "unsuccessful"){
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Item Delete Error!!").show('slow');
                alert("Delete unsuccessful. Contact System Admin!!!");
                $("#welcome_message").hide(5000);
                return false;
            }
            else{
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error,Contact System Admin!!").show('slow');
                alert("Delete unsuccessful. Contact System Admin!!!");
                $("#welcome_message").hide(5000);
                return false;
            }
        },"html");
    },
    doCash: function(){
        $("#welcome_message").show();
        $("#progress_msg").html("Commiting Transaction").show();
        $("#welcome_message").hide(5000);
        var query = "action=saveCash&" + $("#CashAccountIndexForm").serialize();
      
        $("#error_msg").hide();
        $.ajax({
            url: this.save_url,
            data: query,
            dataType: 'json',
            type: 'POST',
            success:function(data) {
               
                if(  data['feedback'] == "unsuccessful") {                   
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("save error. Check Server or Contact Administrators").show('slow');
                    return false;
                }else if(  data['feedback'] == "balzero") {                   
                    $("#progress_msg").hide();
                    
                    window.location = '../cashAccounts/redirectTOIndex/';
                    
                } else if(data['feedback'] == "success") {
                    //                    alert(data['data']);
                    //                    return false;
                    $("#welcome_message").show();
                    $("#progress_msg").html("Expense Details Successfully Saved!!").show('slow').hide(9000);
                    $("#welcome_message").hide(9000);
                     $("#CashAccountPaidTo").val('');
                    $("select").val('');
                    
                    $("#CashAccountExpenseDateDay").val(data['dateSendday']);
                    $("#CashAccountExpenseDateMonth").val(data['dateSendmonth']);
                     $("#CashAccountExpenseDateYear").val(data['dateSendyear']);
                    $("#CashAccountExpenseName").val("");
                    $("#CashAccountExpenseType").val("");
                    $("#CashAccountAmount").val("");
                    $("#CashAccountRemarks").val("");
                    window.location = '../cashAccounts/redirectTOIndex/';
                  //  return false;
                }else if(data['feedback'] == "pending") {
                    //                    alert(data['data']);
                    //                    return false;
                    $("#welcome_message").show();
                    $("#progress_msg").html("Expense Details Successfully Saved,Pending Approval!!").show('slow').hide(9000);
                    
                    $("#welcome_message").hide(9000);
                    $("#CashAccountPaidTo").val('');
                    $("select").val('');
                    
                    $("#CashAccountExpenseDateDay").val(data['dateSendday']);
                    $("#CashAccountExpenseDateMonth").val(data['dateSendmonth']);
                     $("#CashAccountExpenseDateYear").val(data['dateSendyear']);
                    $("#CashAccountExpenseName").val("");
                    $("#CashAccountExpenseType").val("");
                    $("#CashAccountAmount").val("");
                    $("#CashAccountRemarks").val("");
                    window.location = '../cashAccounts/redirectTOIndex/';
                  //  return false;
                }else if(data['feedback'] == "No Data"){
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("No Data. Server Not Receiving Data. Contact Admin!!").show('slow');
                }
            },
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
    }
    
};

var report ={
    balsheet_url:'financialPosition',
    inStatement_url:'incomeStatement', 
    annual_url: 'financialPosition1',
    isAnnual_url: 'incomeStatement1',
    eqAnnual_url: 'ownersEquity1',
        
    init: function() {
        
        //Hide Reports
        $("#tblOwnerEquity").hide()
        $("#tblIncomeStatement").hide();
        $("#tblBalSheet").hide();
        $("#tbldate").show();
        $("#tblIncomeStatement").hide();
        
       
        //button to handle Financial Position Generation
        $("button#balinterrimBTN").click(function(event) {
            //                var option = $('input:radio:checked').val();
            //             var fromday = $("select#SettingFromDay").val(); get from db; can do this in controller; a session

            var startmonth = $("select#BalanceSheetFromMonth").val();
            var startyear = $("select#BalanceSheetFromYear").val();
            var endmonth = $("select#BalanceSheetToMonth").val();
            var endyear = $("select#BalanceSheetToYear").val();
            
            if(startmonth == ""){
                alert("Please Select Start Month!!!");
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Please Select Start Month!!!").show('slow');
                $("#welcome_message").hide(5000);
                return false;
            }
            
            
            if(startyear == ""){
                alert("Please Select Start Year!!!");
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Please Select Start Year!!!").show('slow');
                $("#welcome_message").hide(5000);
                return false;
            }
            if(endmonth == ""){
                alert("Please Select End Month!!!");
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Please Select End Month!!!").show('slow');
                $("#welcome_message").hide(5000);
                return false;
            }
            if(endyear == ""){
                alert("Please Select End Year!!");
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Please Select End Year!!!").show('slow');
                $("#welcome_message").hide(5000);
                return false;
            }
            //            var expire = fromyear + '-' + frommonth + '-' + fromday;
            report.doFPosition(startmonth,endmonth,startyear,endyear);
            return false;
            $("#welcome_message").hide();
            event.preventDefault();
        });
            
        $("button#bal_print").click(function(event) {
                
                
            $("#tblBalSheet").printElement();
            return false;
        });
        $("button#owEquity_print").click(function(event) {
                
                
            $("#tblOwnerEquity").printElement();
            return false;
        }); 
        $("button#inStatement_print").click(function(event) {
                
                
            $("#tblIncomeStatement").printElement();
            return false;
        }); 
            
        //button to handle Financial Position Generation
        $("button#balannualBTN").click(function(event) {
            //                var option = $('input:radio:checked').val();
            //             var fromday = $("select#SettingFromDay").val(); get from db; can do this in controller; a session
            var annual = $("select#fin_pos_year").val();
          
            if(annual == ""){
                alert("Please Select Accounting Year!!!");
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Please Select Accounting Year!!!").show('slow');
                $("#welcome_message").hide(5000);
                return false;
            }
            
           
            //            var expire = fromyear + '-' + frommonth + '-' + fromday;
            report.doAnnualFP(annual);
            return false;
            $("#welcome_message").hide();
            event.preventDefault();
        });
            
           
            
            
        $("button#inStateBTN").click(function(event) {
            //                var option = $('input:radio:checked').val();
            //             var fromday = $("select#SettingFromDay").val(); get from db; can do this in controller; a session

            var startmonth = $("select#IncomeStatementFromMonth").val();
            var endmonth = $("select#IncomeStatementToMonth").val();
            var startyear = $("select#IncomeStatementFromYear").val();
            var endyear = $("select#IncomeStatementToYear").val();
            
            if(startmonth == ""){
                alert("Please Select Start Month!!!");
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Please Select Start Month!!!").show('slow');
                $("#welcome_message").hide(5000);
                return false;
            }
            
            if(startyear == ""){
                alert("Please Select Start Year!!");
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Please Select Start Year!!!").show('slow');
                $("#welcome_message").hide(5000);
                return false;
            }
            
            if(endmonth == ""){
                alert("Please Select End Month!!!");
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Please Select End Month!!!").show('slow');
                $("#welcome_message").hide(5000);
                return false;
            }
            
            if(endyear == ""){
                alert("Please Select Year!!");
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Please Select To Year!!!").show('slow');
                $("#welcome_message").hide(5000);
                return false;
            }
            //            var expire = fromyear + '-' + frommonth + '-' + fromday;
            report.doInStatement(startmonth,endmonth,startyear,endyear);
            return false;
            $("#welcome_message").hide();
            event.preventDefault();
        });
            
            
        $("button#btnISyear").click(function(event) {
            //                var option = $('input:radio:checked').val();
            //             var fromday = $("select#SettingFromDay").val(); get from db; can do this in controller; a session

            var is_annual = $("select#is_year").val();
          
            if(is_annual == ""){
                alert("Please Select Accounting Year!!!");
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Please Select Accounting Year!!!").show('slow');
                $("#welcome_message").hide(5000);
                return false;
            }
            
           
            //            var expire = fromyear + '-' + frommonth + '-' + fromday;
            report.doAnnualIS(is_annual);
            return false;
            $("#welcome_message").hide();
            event.preventDefault();
        });
        
        $("button#inStatement_print").click(function(event) {
                
                
            $("#tblIncomeStatement").printElement();
            return false;
        });
        
        $("button#btnEQ").click(function(event) {
            //                var option = $('input:radio:checked').val();
            //             var fromday = $("select#SettingFromDay").val(); get from db; can do this in controller; a session

            var is_annual = $("select#eq_year").val();
          
            if(is_annual == ""){
                alert("Please Select Accounting Year!!!");
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Please Select Accounting Year!!!").show('slow');
                $("#welcome_message").hide(5000);
                return false;
            }
            
           
            //            var expire = fromyear + '-' + frommonth + '-' + fromday;
            report.doAnnualEQ(is_annual);
            return false;
            $("#welcome_message").hide();
            event.preventDefault();
        });


    },
    doAnnualEQ:function(oyear){
        $("#welcome_message").show();
        $("#progress_msg").html("Committing Transaction").show();
        $("#welcome_message").hide(5000);
        var query = "action=ownersEquity1&" +"oyear="+ oyear + "&" + $("#OwnersEquityOwnersEquity1Form").serialize();
      
        $("#error_msg").hide();
        $.ajax({
            url: this.eqAnnual_url,
            data: query,
            dataType: 'json',
            type: 'POST',
            success: function(data){
                               
                if(data['feedback'] == "unsuccessful"){
                    alert("Sorry, No Transactions For Selected Date Range!!!");
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Sorry, No Transactions For Selected Date Range!!!").show('slow');
                    $("#welcome_message").hide(5000);
                    $("#tblEquity").hide();
                    $("#tblOwnerEquity").show();
                    $("#tblInnerEQ").html(data['ownerEquityTable']);
                    return false;
                }
                else if(data['feedback'] == "success"){
                    $("#tblEquity").hide();
                    $("#tblOwnerEquity").show();
                    $("#tblInnerEQ").html(data['ownerEquityTable']);
                  
                    return false;
                }
            },
            
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Contact System Adminstrator").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
    },
    doAnnualIS:function(iyear){
        $("#welcome_message").show();
        $("#progress_msg").html("Committing Transaction").show();
        $("#welcome_message").hide(5000);
        var query = "action=incomeStatement1&" +"iyear="+ iyear + "&" + $("#IncomeStatementIncomeStatement1Form").serialize();
      
        $("#error_msg").hide();
        $.ajax({
            url: this.isAnnual_url,
            data: query,
            dataType: 'json',
            type: 'POST',
            success: function(data){
                //                alert(data);
                //                return false;
                if(data['feedback'] == "unsuccessful"){
                    alert("Sorry, No Transactions For Selected Date Range!!!");
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Sorry, No Transactions For Selected Date Range!!!").show('slow');
                    $("#welcome_message").hide(5000);
                    $("#tblInStatement").hide();
                    $("#tblIncomeStatement").show();
                    $("#tblInnerIS").html(data['inStateTable']);
                    return false;
                }
                else if(data['feedback'] == "success"){
                    $("#tblInStatement").hide();
                    $("#tblIncomeStatement").show();
                    $("#tblInnerIS").html(data['inStateTable']);
                  
                    return false;
                }
            },
            
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Contact System Adminstrator").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
    },
    doAnnualFP:function(ayear){
        $("#welcome_message").show();
        $("#progress_msg").html("Committing Transaction").show();
        $("#welcome_message").hide(5000);
        var query = "action=financialPosition1&" +"ayear="+ ayear + "&" + $("#BalanceSheetFinancialPosition1Form").serialize();
      
        $("#error_msg").hide();
        $.ajax({
            url: this.annual_url,
            data: query,
            dataType: 'json',
            type: 'POST',
            success: function(data){
                              
                if(data['feedback'] == "unsuccessful"){
                    alert("Sorry, No Transactions For Selected Date Range!!!");
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Sorry, No Transactions For Selected Date Range!!!").show('slow');
                    $("#welcome_message").hide(5000);
                    $("#tbldate").hide();
                    $("#tblBalSheet").show();
                    $("#tblInnerBS").html(data['balSheetTable']);
                    return false;
                }
                else if(data['feedback'] == "success"){
                    $("#tbldate").hide();
                    $("#tblBalSheet").show();
                    $("#tblInnerBS").html(data['balSheetTable']);
                  
                    return false;
                }
            },
            
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Contact System Adminstrator").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
    },
       
    doFPosition:function(smonth,emonth,syear,eyear){
        $("#welcome_message").show();
        $("#progress_msg").html("Committing Transaction").show();
        $("#welcome_message").hide(5000);
        var query = "action=financialPosition&" +"smonth="+smonth+ "&emonth="+ emonth + "&syear=" + syear +"&eyear=" + eyear + "&" + $("#BalanceSheetFinancialPositionForm").serialize();
      
        $("#error_msg").hide();
        $.ajax({
            url: this.balsheet_url,
            data: query,
            dataType: 'json',
            type: 'POST',
            success: function(data){
                //                alert(data);
                //                return false;
                if(data['feedback'] == "unsuccessful"){
                    alert("Sorry, No Transactions For Selected Date Range!!!");
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Sorry, No Transactions For Selected Date Range!!!").show('slow');
                    $("#welcome_message").hide(5000);
                    $("#tbldate").hide();
                    $("#tblBalSheet").show();
                    $("#tblInnerBS").html(data['balSheetTable']);
                  
                    //                var curr = data['currency'];
                    //                    $("#Acurrency").html(curr);
                    //                    $("#Bcurrency").html(curr);
                    //                    $("#Ccurrency").html(curr);
                    //  
                    //                     $("#balcash").html("0");
                    //                     $("#balsupplies").html("0");
                    //                     $("#balppe").html("0");
                    //                     $("#balaccreceiv").html("0");
                    //                     $("#balaccpayable").html("0");
                    //                     $("#balliabilities").html("0");
                    //                     $("#balequity").html("0");
                    //                     $("#baltotassets").html(curr + " " + "0");
                    //                     $("#baltotliabilities").html(curr + " " + "0");
                    //                     $("#baltotequity").html(curr + " " + "0");
                    return false;
                }
                else if(data['feedback'] == "success"){
                    //                    window.location = '../Settings/sentLog/'+from+'/'+to+'/'+bran;
                    //                    var curr = data['currency'];
                    //                    $("#Acurrency").html(curr);
                    //                    $("#Bcurrency").html(curr);
                    //                    $("#Ccurrency").html(curr);
                    //  
                    //                     $("#balcash").html(data['cash']);
                    //                     $("#balsupplies").html(data['stock']);
                    //                     $("#balppe").html(data['property_plant_equipment']);
                    //                     $("#balaccreceiv").html(data['acc_receivable_debtors']);
                    //                     $("#balaccpayable").html(data['acc_payable_creditors']);
                    //                     $("#balliabilities").html(data['other_liabilities']);
                    //                     $("#balequity").html(data['owner_equity']);
                    //                     $("#baltotassets").html(curr + " " +data['total_assets']);
                    //                     $("#baltotliabilities").html(curr + " " +data['total_liab']);
                    //                     $("#baltotequity").html(curr + " " +data['total_liabEq']);
                    $("#tbldate").hide();
                    $("#tblBalSheet").show();
                    $("#tblInnerBS").html(data['balSheetTable']);
                    return false;
                }
            },
            
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Contact System Adminstrator").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
    },
       
    doInStatement:function(ismonth,iemonth,ibyear,toyear){
        $("#welcome_message").show();
        $("#progress_msg").html("Committing Transaction").show();
        $("#welcome_message").hide(5000);
        var query = "action=incomeStatement&" +"ismonth="+ismonth+ "&iemonth="+ iemonth + "&iyear=" + ibyear + "&toyear=" + toyear + "&" + $("#BalanceSheetIncomeStatementForm").serialize();
      
        $("#error_msg").hide();
        $.ajax({
            url: this.inStatement_url,
            data: query,
            dataType: 'json',
            type: 'POST',
            success: function(data){
                //                alert(data);
                //                return false;
                if(data['feedback'] == "unsuccessful"){
                    alert("Sorry, No Transactions For Selected Date Range!!!");
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Sorry, No Transactions For Selected Date Range!!!").show('slow');
                    $("#welcome_message").hide(5000);
                
                    $("#tblInStatement").hide();
                    $("#tblIncomeStatement").show();
                    $("#tblInnerIS").html(data['inStateTable']);
                    
                    return false;
                }
                else if(data['feedback'] == "success"){
                    //                    window.location = '../Settings/sentLog/'+from+'/'+to+'/'+bran;
                    $("#tblInStatement").hide();
                    $("#tblIncomeStatement").show();
                    $("#tblInnerIS").html(data['inStateTable']);
                    return false;
                }
            },
            
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Contact System Adminstrator").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
    }
    
    
};

var expense = {

    save_url: '../Settings/createExpense',

    init: function() {
        
        //callback function to handle client saving/submission
        $("button#expenseBtn").click(function(event) {
            
            expense.doExpense();
            $("#welcome_message").hide();
            event.preventDefault();
            return false;
        });
        
        //Delete Payment Name
        $('.expense_del').click(function(event){
            
            var itemaction = $(this).attr('name');
            if(confirm("Are you sure you want to delete!!!")){
                expense.deleteExpense(itemaction);
                $("#welcome_message2").hide();
            }
            event.preventDefault();
            return false;
        });
        
        
    //callback function to handle supplier detail listing for editing
    //         $(".clientAnchor a").click(function(event){
    //         var clientID = $(this).attr("class");
    //         client.clientInfo(clientID);
    //         event.preventDefault();
    //         return false;
    //        });
       
       
    },
    
    //    clientInfo: function(item){
    //          
    //          var url = '../Settings/clientInfo';
    //           var query = "action=clientInfo&" + "clientId=" + item;
    //           $.post(url, query, function(data){
    //               
    //              $("#ClientClientName").val(data['Client']['client_name']);
    //              $("#ClientClientContact").val(data['Client']['client_contact']);
    //              $("#ClientId").val(data['Client']['id']);
    //               
    //                
    //                 
    //           }, "json");
    //        return false;
    //    },
    deleteExpense: function(item){
    
    
        var query = "action=delPaymentName&" + "paymentnameId=" + item;
        var url = '../Settings/delPaymentName/';
        $.post(url, query, function(data){
        
            if(data == "success"){
                $("input").val('');
                $("select").val('');
                $("#welcome_message").show();
                $("#progress_msg").html("Item Successfully Deleted!!").show('slow').hide(5000);
                alert("Item Successfully Deleted!!");
                $("#welcome_message").hide(5000);
                window.location.reload();
                return false;
            }
            else if(data == "unsuccessful"){
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Item Delete Error!!").show('slow');
                alert("Delete unsuccessful. Contact System Admin!!!");
                $("#welcome_message").hide(5000);
                return false;
            }
            else{
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error,Contact System Admin!!").show('slow');
                alert("Delete unsuccessful. Contact System Admin!!!");
                $("#welcome_message").hide(5000);
                return false;
            }
        },"html");
    },
    
    doExpense: function(){
        $("#welcome_message").show();
        $("#progress_msg").html("Commiting Transaction").show();
        $("#welcome_message").hide(5000);
        var query = "action=saveCash&" + $("#ExpenseCreateExpensesForm").serialize();
      
        $("#error_msg").hide();
        $.ajax({
            url: this.save_url,
            data: query,
            dataType: 'json',
            type: 'POST',
            success:function(data) {
                if(  data['feedback'] == "unsuccessful") {                   
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Server Error. Check Server or Contact Administrators").show('slow');
                
                } else if(data['feedback'] == "success") {
                    $("#welcome_message").show();
                    $("#progress_msg").html("Expense Details Successfully Saved!!").show('slow').hide(5000);
                    $("#welcome_message").hide(5000);
                    $('#')
                    window.location.reload();
                    return false;
                }else if(data['feedback'] == "No Data"){
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Server Error. Server Not Receiving Data. Contact Admin!!").show('slow');
                }
            },
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
    }
    
    
    
    
};
var tax = {

    save_url: '../Settings/taxesList',

    init: function() {
        
        //callback function to handle client saving/submission
        $("button#taxBtn").click(function(event) {
            
            tax.doTax();
            $("#welcome_message").hide();
            event.preventDefault();
            return false;
        });
        
        //Delete Payment Name
        $('.tax_del').click(function(event){
            
            var itemaction = $(this).attr('name');
            if(confirm("Are you sure you want to delete!!!")){
                tax.deleteTax(itemaction);
                $("#welcome_message2").hide();
            }
            event.preventDefault();
            return false;
        });
        
        //callback function to handle supplier detail listing for editing
        $(".taxAnchor a").click(function(event){
            var taxID = $(this).attr("class");
            tax.taxInfo(taxID);
            event.preventDefault();
            return false;
        });
       
       
       
    },
    
    taxInfo: function(item){
           
        var url = '../Settings/taxInfo';
        var query = "action=taxInfo&" + "taxId=" + item;
        $.post(url, query, function(data){
                 
            $("#TaxTaxName").val(data['Tax']['tax_name']);
            $("#TaxTaxRate").val(data['Tax']['tax_rate']);
            $("#TaxId").val(data['Tax']['id']);
                   
                  
                   
        }, "json");
        return false;
    },
    deleteTax: function(item){
    
    
        var query = "action=delTax&" + "taxId=" + item;
        var url = '../Settings/delTax/';
        $.post(url, query, function(data){
        
            if(data == "success"){
                $("input").val('');
                $("select").val('');
                $("#welcome_message").show();
                $("#progress_msg").html("Item Successfully Deleted!!").show('slow').hide(5000);
                alert("Item Successfully Deleted!!");
                $("#welcome_message").hide(5000);
                window.location.reload();
                return false;
            }
            else if(data == "unsuccessful"){
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Item Delete Error!!").show('slow');
                alert("Delete unsuccessful. Contact System Admin!!!");
                $("#welcome_message").hide(5000);
                return false;
            }
            else{
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error,Contact System Admin!!").show('slow');
                alert("Delete unsuccessful. Contact System Admin!!!");
                $("#welcome_message").hide(5000);
                return false;
            }
        },"html");
    },
    
    doTax: function(){
        $("#welcome_message").show();
        $("#progress_msg").html("Commiting Transaction").show();
        $("#welcome_message").hide(5000);
        var query = "action=taxesList&" + $("#TaxTaxesListForm").serialize();
      
        $("#error_msg").hide();
        $.ajax({
            url: this.save_url,
            data: query,
            dataType: 'json',
            type: 'POST',
            success:function(data) {
                if(  data['feedback'] == "unsuccessful") {                   
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Server Error. Check Server or Contact Administrators").show('slow');
                
                } else if(data['feedback'] == "success") {
                    $("#welcome_message").show();
                    $("#progress_msg").html("Tax Details Successfully Saved!!").show('slow').hide(5000);
                    $("#welcome_message").hide(5000);
                    $('#')
                    window.location.reload();
                    return false;
                }
            },
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
    }
    
    
    
    
};

var portfolio =  {
    
    init: function() {
        
      
        
        //callback function to handle supplier detail listing for editing
        $(".portermAnchor a").click(function(event){
            var ptermID = $(this).attr("class");
            portfolio.portfolioInfo(ptermID);
            event.preventDefault();
            return false;
        });
      
       
       
    },
    
    portfolioInfo: function(item){
           
        var url = '../Settings/portfolioInfo';
        var query = "action=portfolioInfo&" + "ptermId=" + item;
        $.post(url, query, function(data){
                 
            $("#PortfolioPaymentName").val(data['Portfolio']['payment_name']);
            $("#PortfolioPeriodMonths").val(data['Portfolio']['period_months']);
            $("#PortfolioInterestRate").val(data['Portfolio']['interest_rate']);
            $("#PortfolioId").val(data['Portfolio']['id']);
                   
                  
                   
        }, "json");
        return false;
    }
    
};
var payment_term = {

    save_url: '../Settings/taxesList',

    init: function() {
        
      
        
        //callback function to handle supplier detail listing for editing
        $(".ptermAnchor a").click(function(event){
            var ptermID = $(this).attr("class");
            payment_term.paymentInfo(ptermID);
            event.preventDefault();
            return false;
        });
      
       
       
    },
    
    paymentInfo: function(item){
           
        var url = '../Settings/paymentInfo';
        var query = "action=paymentInfo&" + "ptermId=" + item;
        $.post(url, query, function(data){
                 
            $("#RatePaymentName").val(data['Rate']['payment_name']);
            $("#RatePeriodMonths").val(data['Rate']['period_months']);
            $("#RateInterestRate").val(data['Rate']['interest_rate']);
            $("#RateId").val(data['Rate']['id']);
                   
                  
                   
        }, "json");
        return false;
    },
    deleteTax: function(item){
    
    
        var query = "action=delTax&" + "taxId=" + item;
        var url = '../Settings/delTax/';
        $.post(url, query, function(data){
        
            if(data == "success"){
                $("input").val('');
                $("select").val('');
                $("#welcome_message").show();
                $("#progress_msg").html("Item Successfully Deleted!!").show('slow').hide(5000);
                alert("Item Successfully Deleted!!");
                $("#welcome_message").hide(5000);
                window.location.reload();
                return false;
            }
            else if(data == "unsuccessful"){
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Item Delete Error!!").show('slow');
                alert("Delete unsuccessful. Contact System Admin!!!");
                $("#welcome_message").hide(5000);
                return false;
            }
            else{
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error,Contact System Admin!!").show('slow');
                alert("Delete unsuccessful. Contact System Admin!!!");
                $("#welcome_message").hide(5000);
                return false;
            }
        },"html");
    },
    
    doTax: function(){
        $("#welcome_message").show();
        $("#progress_msg").html("Commiting Transaction").show();
        $("#welcome_message").hide(5000);
        var query = "action=taxesList&" + $("#TaxTaxesListForm").serialize();
      
        $("#error_msg").hide();
        $.ajax({
            url: this.save_url,
            data: query,
            dataType: 'json',
            type: 'POST',
            success:function(data) {
                if(  data['feedback'] == "unsuccessful") {                   
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Server Error. Check Server or Contact Administrators").show('slow');
                
                } else if(data['feedback'] == "success") {
                    $("#welcome_message").show();
                    $("#progress_msg").html("Tax Details Successfully Saved!!").show('slow').hide(5000);
                    $("#welcome_message").hide(5000);
                    $('#')
                    window.location.reload();
                    return false;
                }
            },
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
    }
    
    
    
    
};
var payments = {

    init: function() {
        
      
        
        //callback function to handle supplier detail listing for editing
        $("a#print_receipt").click(function(event){
            $("#payment_receipt").printElement();
            event.preventDefault();
            return false;
        });
      
       
       
    }
    
};
var customer = {

    init: function() {
        
       var options = { 
        //target:        '#output2',   // target element(s) to be updated with server response 
          // pre-submit callback 
        success:  function(data){
            
                //                alert(data);
                //                return false;
                if(data['feedback'] == "unsuccessful"){
                    alert("Sorry, No Transactions For Selected Date Range!!!");
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Sorry, No Transactions For Selected Date Range!!!").show('slow');
                    $("#welcome_message").hide(5000);
                
                    
                    return false;
                }
                else if(data['feedback'] == "success"){
                    
                    return false;
                }
                else if(data['feedback'] == 'Wrong Image File Type'){
                     alert("Invalid File Type For Customer Picture!!!");
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Invalid File Type For Customer Picture!!!").show('slow');
                    $("#welcome_message").hide(5000);
                }
                 else if(data['feedback'] == 'Error Creating thumbnail'){
                     alert("Error Creating thumbnail!!!");
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Error Creating thumbnail!!!").show('slow');
                    $("#welcome_message").hide(5000);
                }
            },
            //showResponse,  // post-submit callback 
 
        // other available options: 
        url:       '../Customers/commit',         // override for form's 'action' attribute 
        type:      'post',        // 'get' or 'post', override for form's 'method' attribute 
        dataType:  'json',        // 'xml', 'script', or 'json' (expected server response type) 
        //clearForm: true        // clear all form fields after successful submit 
        resetForm: true        // reset the form after successful submit 
 
        // $.ajax options can be used here too, for example: 
        //timeout:   3000 
    }; 
 
    

 
// pre-submit callback 
      
        //callback function to handle supplier detail listing for editing
//        $("button#cust_save").click(function(event){
//           
//           var custPicture = $("#CustomerCustomerPhoto").val();
//            event.preventDefault();
//            if(custPicture == "" || custPicture == null){
//            
//                $("#CustomerCustomerPhoto").css("border-color", "red");
//            
//                
//                alert("Please Supply The Customer\'s Firstname!!!");
//                return false;
//            }
//            
//            //customer.saveCustomer();
//            $(this).ajaxSubmit(options); 
//            return false;
//        });
        
              // bind to the form's submit event 
    $('#CustomerIndexForm').submit(function() { 
        // inside event callbacks 'this' is the DOM element so we first 
        // wrap it in a jQuery object and then invoke ajaxSubmit 
         var custPicture = $("#CustomerCustomerPhoto").val();
         
            event.preventDefault();
            if(custPicture == "" || custPicture == null){
            
                $("#CustomerCustomerPhoto").css("border-color", "red");
            
                
                alert("Please Supply The Customer\'s Firstname!!!");
                return false;
            }
//            
        $(this).ajaxSubmit(options); 
 
        // !!! Important !!! 
        // always return false to prevent standard browser submit and page navigation 
        return false; 
    }); 
       
       
    },
    
    saveCustomer: function(){
        // $("#welcome_message").show();
        //$("#progress_msg").html("Commiting Transaction").show();
        // $("#welcome_message").hide(5000);
           
        var url = '../Customers/commit';
        var query = "action=commit&" + "sales_person=save";
        $.ajax({
            url: this.inStatement_url,
            data: query,
            dataType: 'json',
            type: 'POST',
            success: function(data){
                //                alert(data);
                //                return false;
                if(data['feedback'] == "unsuccessful"){
                    alert("Sorry, No Transactions For Selected Date Range!!!");
                    $("#progress_msg").hide();
                    $("#welcome_message").show();
                    $("#error_msg").html("Sorry, No Transactions For Selected Date Range!!!").show('slow');
                    $("#welcome_message").hide(5000);
                
                    $("#tblInStatement").hide();
                    $("#tblIncomeStatement").show();
                    $("#tblInnerIS").html(data['inStateTable']);
                    
                    return false;
                }
                else if(data['feedback'] == "success"){
                    //                    window.location = '../Settings/sentLog/'+from+'/'+to+'/'+bran;
                    $("#tblInStatement").hide();
                    $("#tblIncomeStatement").show();
                    $("#tblInnerIS").html(data['inStateTable']);
                    return false;
                }
            },
            
            error: function() {
                $("#progress_msg").hide();
                $("#welcome_message").show();
                $("#error_msg").html("Server Error. Contact System Adminstrator").show('slow');
                $("#welcome_message").hide(5000);
            }
        });
        return false;

    }
    
};
var ucsl_order = {

    init: function() {
        
      
        
        //callback function to handle supplier detail listing for editing
        $("#OrderPaymentMode").change(function(){
           
           var payment_mode = $(this).val();
          
            
            if(payment_mode == "Post-dated chq"){
            
                $("#OrderChequeNos").removeAttr('disabled');
               $("#OrderChequeNos").focus(); 
            }else{
                $("#OrderChequeNos").attr('disabled','disabled');
            }
            return false;
        });
      
       
       
    }
    
};
var ucsl_payment = {

    init: function() {
        
      $("#postdate_chqs").hide();
        
        //callback function to handle supplier detail listing for editing
        $("#PaymentPaymentMode").change(function(){
           
           var payment_mode = $(this).val();
          
            
            if(payment_mode == "Cheque"){
            
                $("#PaymentChequeNos").removeAttr('disabled');
               $("#PaymentChequeNos").focus(); 
            }else{
                $("#PaymentChequeNos").attr('disabled','disabled');
            }
            
            if(payment_mode == "Post-dated chq"){
            
                $("#postdate_chqs").show(); 
            }else{
                $("#postdate_chqs").hide();
            }
            
            return false;
        });
      
       
       
    }
    
};

var ucsl_investorpayment = {

    init: function() {
        
        
        //callback function to handle supplier detail listing for editing
        $("#InvestmentPaymentPaymentMode").change(function(){
           
           var payment_mode = $(this).val();
          
            
            if(payment_mode == "Cheque" || payment_mode == "Post-dated chq"){
            
                $("#InvestmentPaymentChequeNos").removeAttr('disabled');
               $("#InvestmentPaymentChequeNos").focus(); 
            }else{
                $("#InvestmentPaymentChequeNos").attr('disabled','disabled');
            }
            
            
            return false;
        });
      
       
       
    }
    
};
var ucsl_supplierpayment = {

    init: function() {
        
      $("#postdate_chqs").hide();
      
      var payment_mode = $("#SupplyPaymentPaymentMode").val();
        if(payment_mode == "Cheque"){
            
                $("#SupplyPaymentUsedChequenos").removeAttr('disabled');
               $("#SupplyPaymentUsedChequenos").focus(); 
            }else{
                $("#SupplyPaymentUsedChequenos").attr('disabled','disabled');
            }
        //callback function to handle supplier detail listing for editing
        $("#SupplyPaymentPaymentMode").change(function(){
           
           var payment_mode = $(this).val();
          
            
            if(payment_mode == "Cheque"){
            
                $("#SupplyPaymentUsedChequenos").removeAttr('disabled');
               $("#SupplyPaymentUsedChequenos").focus(); 
            }else{
                $("#SupplyPaymentUsedChequenos").attr('disabled','disabled');
            }
            
            if(payment_mode == "Post-dated chq"){
            
                $("#postdate_chqs").show(); 
            }else{
                $("#postdate_chqs").hide();
            }
            
            return false;
        });
      
       
       
    }
    
};
var ucsl_report = {

    init: function() {
     
    
        //callback function to handle supplier detail listing for editing
        $("a#print_report").click(function(event){
            $("#dateRow").hide();
            $("#emailRow").hide();
            $("#report_content").printElement();
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
var investor = {
    init: function () {
        var self = this;

        $("#InvestorNewInvestorIndivForm").validate({
            rules: {
            },
            focusCleanup: false,
            highlight: function (label) {
                $(label).closest('.control-group').removeClass('success').addClass('error');
            },
            success: function (label) {
                $(label).closest('.control-group').removeClass('error');
            },
            errorPlacement: function (error, element) {
                error.appendTo(element.parents('.controls'));
            }
        });
    }
    };
$(document).ready(function() {
    // $("#receive_receipt").printElement();
    $("#welcome_message").hide();
    $("#SaleIndexForm").hide();    
    sale.init();
    price.init();
    setup.init();
    list.init();
    client.init();
    supplier.init();
    credit.init();
    debt.init();
    user.init();
    cash.init();
    expense.init();
    report.init();
    tax.init();
    payment_term.init();
    payments.init();
    ucsl_report.init();
    customer.init();
    ucsl_order.init();
    ucsl_payment.init();
    ucsl_supplierpayment.init();
    portfolio.init();
    ucsl_investorpayment.init();
    investor.init();
});
