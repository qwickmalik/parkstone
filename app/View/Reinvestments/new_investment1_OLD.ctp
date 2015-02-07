<?php
//echo $this->Html->script('notification.js');
?>

<?php
$shopCurrency = "GH$";
if ($this->Session->check('shopCurrency_investment')) {
    $shopCurrency = $this->Session->read('shopCurrency_investment');
}
?>
<!-- Content starts here -->
<h3 style="color: red;">New Re-investment</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
<!-- Step Investment Details Start -->
                    <?php
                    echo $this->Form->create('Reinvestment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Reinvestments', 'action' => 'newInvestment'), "inputDefaults" => array('div' => false)));
                    ?>
        <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">

            <tr>
                <td align="left" valign="top" colspan="3" ><p class="subtitle-red">Step 2 - Choose Investment Product</p></td>
            </tr>
            <tr>
                <td align="left" valign="top" colspan="3">
                     <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <?php
                        echo $this->Form->input('reinvestor_id', array('label' => 'Company','empty' => '--Select Company--', 'disabled'));
                        
                        echo $this->Form->input('investmentproduct_id', array('label' => 'Investment Product', 'empty' => "--Please Select--",'selected' => ($this->Session->check('investtemp.investmentproduct_id') == true ? $this->Session->read('investtemp.investmentproduct_id') : '' )));
//,'selected' => ($this->Session->check('investortemp.investor_type_id') == true ? $this->Session->read('investortemp.investor_type_id') : 1 )
                        ?>  
                    </div>
                     </div>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="left" valign="top" style="border-bottom: dotted 1px gray;">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>

            <tr>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" valign="middle" colspan="2">
                    <?php 
//                        echo $this->Html->link('Clear', "/Reinvestments/newInvestment", array("class" => 'btn btn-lg btn-info')); 
                        
                        echo $this->Html->link('Fixed Investment', "/Reinvestments/newInvestment2Fixed", array("class" => 'btn btn-lg btn-primary')); 
                        echo $this->Html->link('Equity Investment', "/Reinvestments/newInvestment2Equity", array("class" => 'btn btn-lg btn-primary')); 
                        ?>
                </td>
            </tr>
        </table>
        <?php
        echo $this->Form->end();
        ?>
        <div id="clearer"></div>

    </div>
    <!-- Content ends here -->
<script type="text/javascript" language="javascript">
$(document).ready(function()
{
   $("#ReinvestmentInvesteeId").change(function(){
       var url = 'getfunds';
       var id = $(this).val();
       if(id != ""){
        var query = "action=getfunds&"+"investee_id=" + id ;
      
        $("#error_msg").hide();
        $.ajax({
            url: url,
            data: query,
            dataType: 'json',
            type: 'POST',
            success:function(data) {
           
                if( data['status'] == "ok" ) {
                    var prod1 = data['data']['product1'];
                    var prod2 = data['data']['product2'];
                    var prod3 = data['data']['product3'];
                    var prod4 = data['data']['product4'];
                    var prod5 = data['data']['product5'];
                    var prod6 = data['data']['product6'];
                    var prod7 = data['data']['product7'];
                    var prod8 = data['data']['product8'];
                    var prod9 = data['data']['product9'];
                    var selectHTML = '<option value="">-- Please Select --</option>';
                    if(prod1 != "" || prod1 != null){
                       selectHTML += "<option value=" + prod1 + ">"+ prod1 +"</option>";
                    }
                     if(prod2 != "" && prod2 != null){
                       selectHTML += "<option value=" + prod2 + ">"+ prod2 +"</option>";
                    }
                    if(prod3 != "" && prod3 != null){
                       selectHTML += "<option value=" + prod3 + ">"+ prod3 +"</option>";
                    }
                    if(prod4 != "" && prod4 != null){
                       selectHTML += "<option value=" + prod4 + ">"+ prod4 +"</option>";
                    }
                    if(prod5 != "" && prod5 != null){
                       selectHTML += "<option value=" + prod5 + ">"+ prod5 +"</option>";
                    }
                    if(prod6 != "" && prod6 != null){
                       selectHTML += "<option value=" + prod6 + ">"+ prod6 +"</option>";
                    }
                    if(prod7 != "" && prod7 != null){
                       selectHTML += "<option value=" + prod7 + ">"+ prod7 +"</option>";
                    }
                    if(prod8 != "" && prod8 != null){
                       selectHTML += "<option value=" + prod8 + ">"+ prod8 +"</option>";
                    }
                    if(prod9 != "" && prod9 != null){
                       selectHTML += "<option value=" + prod9 + ">"+ prod9 +"</option>";
                    }
                    $("#ReinvestmentInvestmentproductId").html(selectHTML);
                    return false;
                } else if(data['status'] == "failed"){

                 
                  
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
   });
    
});
</script>