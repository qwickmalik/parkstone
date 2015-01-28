<?php
echo $this->Html->script('notification.js');
?>

<!-- Content starts here -->
<h3>Edit Equity Investment</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
        <table border="0" width="100%" cellspacing="5" cellpadding="0" align="left">
            <tr>
                <td align="left" width="200"><p style="font-size: 18px;">Investor ID: </p></td>
                <td align="left"><p style="font-size: 18px;"><?php
                        if (isset($investor_id)) {
                            echo $investor_id;
                        }
                        ?></p></td>
            </tr>

            <tr>
                <td align="left" width="200"><p style="font-size: 18px;">Investor Name: </p></td>
                <td align="left"><p style="font-size: 18px;"><?php
                        if (isset($investor_name)) {
                            echo $investor_name;
                        }
                        ?></p></td>
            </tr>
            <tr>
                <td align="left" width="200"><p style="font-size: 18px;">Investment ID: </p></td>
                <td align="left"><p style="font-size: 18px;"><?php
                        if (isset($investor_name)) {
                            echo $investor_name;
                        }
                        ?></p></td>
            </tr>
        </table>
        <div class="col-lg-6 col-md-6 col-sm-12" id="equity">


            <?php
            echo $this->Form->create('EditInvestment', ['action' => 'editEquityInvestment']);


            echo $this->Form->input('instruction_id', array('label' => 'Instructions', 'name' => 'instruction_id2', 'empty' => "--Please Select--", 'selected' => ($this->Session->check('investtemp.instruction_id2') == true ? $this->Session->read('investtemp.instruction_id2') : '' )));
            echo $this->Form->input('instruction_details', array('label' => 'Other Instruction Details', 'name' => 'instruction_details2', 'placeholder' => "Complete this ONLY if 'Other' is selected", 'value' => ($this->Session->check('investtemp.instruction_details2') == true ? $this->Session->read('investtemp.instruction_details2') : '' )));
            ?>
            <div class="row"> 
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php
                    if ($this->Session->check('investtemp.purchase_date') == true) {

                        $dob_string = $this->Session->read('investtemp.purchase_date');

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
                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>Pur. Date*:</span>" . $this->Form->day('purchase_date', array("selected" => $day)); ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->month('purchase_date', array("selected" => $month)); ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->year('purchase_date', 1950, date('Y'), array("selected" => $Year)); ?>
                </div>
                <script>
                    var day = $("#day").val();
                    var month = $("#month").val();
                    var year = $("#year").val();
                    $("#InvestmentPurchaseDateDay option[value=" + day + "]").attr('selected', true);
                    $("#InvestmentPurchaseDateMonth option[value=" + month + "]").attr('selected', true);
                    $("#InvestmentPurchaseDateYear option[value=" + year + "]").attr('selected', true);
                </script>

            </div>
            <div class="row"> 
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php
                    echo $this->Form->input('currency_id', array('label' => 'Currency', 'name' => 'currency', 'empty' => "--Please Select a Currency--", 'value' => ($this->Session->check('investtemp.currency') == true ? $this->Session->read('investtemp.currency') : '' )));
                    
                    ?>

                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->input('paymentschedule_id', array('label' => 'Payment Schedule', 'name' => 'paymentschedule_id', 'empty' => "--Please Select--", 'value' => ($this->Session->check('investtemp.paymentschedule_id') == true ? $this->Session->read('investtemp.paymentschedule_id') : '' ))); ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->input('paymentmode_id', array('label' => 'Payment Mode', 'name' => 'paymentmode_id', 'empty' => "--Please Select--", 'value' => ($this->Session->check('investtemp.paymentmode_id') == true ? $this->Session->read('investtemp.paymentmode_id') : '' ))); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?php
                    echo $this->Form->input('equities_list_id', ['type' => 'select', 'options' => $equitieslists, 'empty' => '--Please choose desired equity--']);
                    echo "<p><i>Desired equity not listed here?" . $this->Html->link('Add to the list', '/Settings/equitiesList') . "</i></p>";
                    ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?php
                    echo $this->Form->input('share_price', array('disabled', 'label' => 'Purchase Price*', 'class' => 'required', 'value' => ($this->Session->check('investtemp.share_price') == true ? $this->Session->read('investtemp.share_price') : '' )));
                    echo $this->Form->hidden('purchase_price', array('value' => ($this->Session->check('investtemp.purchase_price') == true ? $this->Session->read('investtemp.purchase_price') : '' )));
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?php
                    echo $this->Form->input('numb_shares', array('label' => 'No. of Shares*', 'class' => 'required', 'value' => ($this->Session->check('investtemp.numb_shares') == true ? $this->Session->read('investtemp.numb_shares') : '' )));
                    ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?php
                    echo $this->Form->input('total_fees', array('label' => 'Total Fees*', 'class' => 'required', 'value' => ($this->Session->check('investtemp.total_fees') == true ? $this->Session->read('investtemp.total_fees') : '' )));
                    //                             echo $this->Form->input('total_amount', array('label' => 'Total Amount*', 'class' => 'required', 'value' => ($this->Session->check('investtemp.total_amount') == true ? $this->Session->read('investtemp.total_amount') : '' ))); 
                    ?>
                </div>
            </div>
            <p>&nbsp;</p><p>&nbsp;</p>
            <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right;">
                <?php echo $this->Form->button('Process', array("type" => "submit", "class" => "btn btn-xs btn-success", 'name' => "equity_process")); ?>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12" style="border-top: dotted 1px gray; background: #C6F19F;">
                <?php
//                                echo "<span style='font-weight: bold; font-size: 11px; color: red;'>Total Amount:</span>";
//                                if (isset($totalamt)) {
//                                    echo $shopCurrency.' '.$totalamt;
//                                } else {
//                                    echo '';
//                                }
                ?>

                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?php
                    echo "<span style='font-weight: bold; font-size: 11px; color: red;'>Equity:</span><br>";
                    if (isset($equity)) {
                        echo $equity;
                    } else {
                        echo '';
                    }
                    ?>

                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?php
                    echo "<span style='font-weight: bold; font-size: 11px; color: red;'>Share Price:</span><br>";
                    if (isset($share_price)) {
                        echo $shopCurrency . ' ' . $share_price;
                    } else {
                        echo '';
                    }
                    ?>

                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?php
                    echo "<span style='font-weight: bold; font-size: 11px; color: red;'>Total Fees:</span><br>";
                    if (isset($total_fees)) {
                        echo $shopCurrency . ' ' . $total_fees;
                    } else {
                        echo '';
                    }
                    ?>

                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?php
                    echo "<span style='font-weight: bold; font-size: 11px; color: red;'>Expected Amt Due:</span>";
                    if (isset($totalamt)) {
                        echo $shopCurrency . ' ' . $totalamt;
                    } else {
                        echo '';
                    }
                    ?>

                </div>
            </div>
            <p>&nbsp;</p>
            <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right;">
                <?php echo $this->Form->button('Save', array("type" => "submit", "class" => "btn btn-lg btn-primary", 'name' => "edit_equity_save")); ?>
            </div>
        </div>
        <?php $this->Form->end(); ?>
    </div>
    <!-- Content ends here -->
<script lang="javascript">
 jQuery(document).ready(function($) {
     var prod_val = $("#InvestmentInvestmentproductId").val();
     if(prod_val == "1"){
            
    $("#fixed").show("slow");
    $("#equity").hide("slow");
        }
        
        if(prod_val == "2"){
        
    $("#equity").show(5000);    
    $("#fixed").hide("slow");
        }
        
        if(prod_val == "3"){
            $("#fixed").show("slow");
    $("#equity").show("slow");
        }
        
        if(prod_val == ""){
            $("#fixed").show("slow");
    $("#equity").show("slow");
        }
  
    $("#InvestmentInvestmentproductId").change(function(){
        
        
        var investmentproduct = $(this).val();
        if(investmentproduct == "1"){
            
    $("#fixed").show("slow");
    $("#equity").hide("slow");
        }
        
        if(investmentproduct == "2"){
        
    $("#equity").show(5000);    
    $("#fixed").hide("slow");
        }
        
        if(investmentproduct == "3"){
            $("#fixed").show("slow");
    $("#equity").show("slow");
        }
        
        if(investmentproduct == ""){
            $("#fixed").show("slow");
    $("#equity").show("slow");
        }
        
    });
    jQuery("#InvestmentEquitiesListId").change(function(){

    var equity_id = jQuery(this).val();
     if (equity_id == ""){
         
                    jQuery('#InvestmentSharePrice').val("");
                     jQuery('#InvestmentPurchasePrice').val(""); 
     }
            if (equity_id != ""){
    var query = "action=getPurchasePrice&ID=" + equity_id;
            jQuery.ajax({
                    url: "../Investments/getPurchasePrice",
                    data: query,
                    dataType: 'json',
                    type: 'POST',
                    success: function (data) {
                        
                    if (data && data.error) {
                        
                    jQuery(".errormsg").show();
                            jQuery(".errormsg").html(data.error).show('slow');
                            jQuery(".errormsg").hide();
                    } else {
                    //jquery("midleveltype").
                    jQuery('#InvestmentSharePrice').val(data['EquitiesList']['share_price']);
                     jQuery('#InvestmentPurchasePrice').val(data['EquitiesList']['share_price']);     
                            
                            return false;
                    }
                    },
                    error: function () {
                        jQuery(".errormsg").show();
                            jQuery(".errormsg").html("Server Error. Check Server and Database Configurations").show('slow');
                            jQuery(".errormsg").hide();
                  }
            });
    }
    });
});          
        </script>