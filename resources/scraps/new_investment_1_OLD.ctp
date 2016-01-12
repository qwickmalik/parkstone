<?php
//
?>

<?php
$shopCurrency = "GH$";
if ($this->Session->check('shopCurrency_investment')) {
    $shopCurrency = $this->Session->read('shopCurrency_investment');
}
?>
<!-- Content starts here -->
<h3 style="color: red;">Re-investment</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
<!-- Step Investment Details Start -->
                    <?php
                    echo $this->Form->create('Reinvestment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Reinvestments', 'action' => 'newInvestment'), "inputDefaults" => array('div' => false)));
                    ?>
        <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">

            <tr>
                <td align="left" valign="top" colspan="3" ><p class="subtitle-red">Reinvestor</p></td>
            </tr>
            <tr>
                <td align="left" valign="top" colspan="3">
                     <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <?php
                        echo $this->Form->input('reinvestor_id', array('label' => 'Company','empty' => '--Select Company--'));
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
                <td align="left" valign="top" colspan="3" style="font-size: 18px; color: Red; font-weight: bold;">Investee Details</td>
            </tr>
            <tr>
                <td align="left" valign="top" colspan="3">

                    
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?php
                            echo $this->Form->hidden('user_id', array('value' => ($this->Session->check('userDetails.id') == true ? $this->Session->read('userDetails.id') : '' )));
                            echo $this->Form->hidden('investment_type', array('value' => 'indv_joint'));

                            //echo $this->Form->hidden('investment_product_id', array('label' => 'Investment Product', 'empty' => "--Please Select--", 'value' => 1));
                            
                            echo $this->Form->input('investee_id', array('empty' => '--Please Select--', 'label' => 'Company/Fund',  'selected' => '--Please Select--'));
                            echo $this->Form->input('investmentproduct_id', array('label' => 'Investment Product', 'empty' => "--Please Select--",'selected' => ($this->Session->check('investtemp.investmentproduct_id') == true ? $this->Session->read('investtemp.investmentproduct_id') : '' )));
                            echo $this->Form->input('instruction_id', array('label' => 'Instructions', 'empty' => "--Please Select--",'selected' => ($this->Session->check('investtemp.instruction_id') == true ? $this->Session->read('investtemp.instruction_id') : '' )));
                            echo $this->Form->input('instruction_details', array('label' => 'Other Instruction Details', 'placeholder' => "Complete this ONLY if 'Other' is selected",'value' => ($this->Session->check('investtemp.instruction_details') == true ? $this->Session->read('investtemp.instruction_details') : '' )));
                            ?>
                        </div>
                    
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo $this->Form->input('investment_amount', array('label' => 'Investment Amount', 'class' => 'required', 'value' => ($this->Session->check('investtemp.investment_amount') == true ? $this->Session->read('investtemp.investment_amount') : '' ))); ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
<?php echo $this->Form->input('investmentterm_id', array('label' => 'Investment Term', 'empty' => "--Please Select--", 'value' => ($this->Session->check('investtemp.investmentterm_id') == true ? $this->Session->read('investtemp.investmentterm_id') : '' ))); ?>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
<?php // echo $this->Form->input('inv_freq', array('label' => 'Frequency', 'value' => (isset($investor['Investor']['inv_freq']) ? $investor['Investor']['inv_freq'] : '' )));  ?>
<?php echo $this->Form->input('custom_rate', array('label' => 'Custom Interest Rate', 'value' => ($this->Session->check('investtemp.custom_rate') == true ? $this->Session->read('investtemp.custom_rate') : '' ))); ?>

                                </div>
</div>
                           <div class="row"> 
                                <div class="col-lg-4 col-md-4 col-sm-12">
<?php echo $this->Form->input('currency_id', array('label' => 'Currency', 'empty' => "--Please Select a Currency--" ,'value' => ($this->Session->check('investtemp.currency_id') == true ? $this->Session->read('investtemp.currency_id') : '' ))); ?>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo $this->Form->input('paymentschedule_id', array('label' => 'Payment Schedule', 'empty' => "--Please Select--", 'value' => ($this->Session->check('investtemp.custom_rate') == true ? $this->Session->read('investtemp.custom_rate') : '' ))); ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
<?php echo $this->Form->input('paymentmode_id', array('label' => 'Payment Mode', 'empty' => "--Please Select--",'value' => ($this->Session->check('investtemp.paymentmode_id') == true ? $this->Session->read('investtemp.paymentmode_id') : '' ))); ?>
                                </div>
                           </div>
                                <!--                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                   
<?php //echo "<span style='font-size: 14px;font-weight: normal;line-height: 20px;'>Inv. Date:</span>&nbsp;" . $this->Form->day('investment_date', array("selected" => $day, "class" => "large"));  ?>&nbsp;<?php //echo $this->Form->month('investment_date', array("selected" => $month, "class" => "large")); ?>&nbsp;<?php //echo $this->Form->year('investment_date', 1950, date('Y'), array("selected" => $Year, "class" => "large")); ?>
                                                                    
                                
                                                                </div>-->
<div class="row"> 
                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <?php
                                    if ($this->Session->check('investtemp.investment_date') == true) {

                                        $dob_string = $this->Session->read('investtemp.investment_date');
                                        $month = date('m', strtotime($dob_string));
                                        $day = date('d', strtotime($dob_string));
                                        $Year = date('Y', strtotime($dob_string));
                                    } else {

                                        $month = date('m');
                                        $day = date('d');
                                        $Year = date('Y');
                                    }
                                    ?>
                                    <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                                    <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                                    <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>Inv. Date*:</span>" . $this->Form->day('investment_date', array("selected" => $day, "class" => "large")); ?>&nbsp;
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->month('investment_date', array("selected" => $month, "class" => "large")); ?>&nbsp;
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12">
<?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->year('investment_date', 1950, date('Y'), array("selected" => $Year, "class" => "large")); ?>
                                </div>
                                <script>
                                    var day = $("#day").val();
                                    var month = $("#month").val();
                                    var year = $("#year").val();
                                    $("#InvestmentInvestmentDateDay option[value=" + day + "]").attr('selected', true);
                                    $("#InvestmentInvestmentDateMonth option[value=" + month + "]").attr('selected', true);
                                    $("#InvestmentInvestmentDateYear option[value=" + year + "]").attr('selected', true);
                                </script>
                                 </div>
                            </div>
                       

                    </div>

                    <!-- Investment Details End -->

                </td>
            </tr>
            <tr>
                <td colspan="3" align="left" valign="top" style="border-bottom: dotted 1px gray;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3" align="left" valign="top">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <table width="80%" cellspacing="0" cellpadding="3" border="0">
                            <tr>
                                <td align="right"><b align="right">Due Date: </b></td>
                                <td><span id="xxxxxx"><?php
                                        if (isset($duedate)) {
                                            echo $duedate;
                                        } else {
                                            echo '';
                                        }
                                        ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <table width="80%" cellspacing="0" cellpadding="3" border="0">
                            <tr>
                                <td align="right"><b align="right">Interest Accrued: </b></td>
                                <td><span id="xxxxxx"><?php
                                        if (isset($interest)) {
                                            echo $shopCurrency . ' ' . $interest;
                                        } else {
                                            echo '';
                                        }
                                        ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <table width="80%" cellspacing="0" cellpadding="3" border="0">
                            <tr>
                                <td align="right"><b align="right" style='color: #ff0000'>Total Amount Due: </b></td>
                                <td><span id="xxxxxx" ><b><?php
                                            if (isset($totaldue)) {
                                                echo $shopCurrency . ' ' . $totaldue;
                                            } else {
                                                echo '';
                                            }
                                            ?></b></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
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
                        echo $this->Html->link('Clear', "/Reinvestments/newInvestment", array("class" => 'btn btn-lg btn-info')); 
                        echo $this->Form->button('Process', array("type" => "submit", "class" => "btn btn-lg btn-success")); 
                        echo "&nbsp;&nbsp;";
                        echo $this->Html->link('Next', "/Reinvestments/newInvestmentCert", array("class" => 'btn btn-lg btn-primary')); 
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