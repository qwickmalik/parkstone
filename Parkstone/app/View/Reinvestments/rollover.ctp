<?php
echo $this->element('header');

?>

<?php
$shopCurrency = "GH$";
if ($this->Session->check('shopCurrency_investment')) {
    $shopCurrency = $this->Session->read('shopCurrency_investment');
}
?>
<!-- Content starts here -->
<h3 style="color: red;">Process Investment</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
        <!-- Step Investment Details Start -->
        <?php
        echo $this->Form->create('Reinvestment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Reinvestments', 'action' => 'rolloverReinvestorFixed'), "inputDefaults" => array('div' => false)));
        
        
        ?>
        <p class="subtitle-red">Step 2 - Roll-over Fixed Investment</p>
                    <div class="row"  style="background: #F0E3C0;">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <p></p>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Company:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestorcashaccounts['Reinvestor']['company_name']) ? 
                                            $reinvestorcashaccounts['Reinvestor']['company_name'] : '' );?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Last Modified Date:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestorcashaccounts['ReinvestorCashaccount']['modified']) ?
                                            $reinvestorcashaccounts['ReinvestorCashaccount']['modified'] : '' );?>
                                </div>
                            </div>
<!--                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php // echo "<p><b>Currency:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php // echo (isset($reinvestorcashaccounts['Currency']['symbol']) ? 
//                                            $reinvestorcashaccounts['Currency']['symbol'] : '' );?>
                                </div>
                            </div>-->
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Principal:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($data['Reinvestment']['investment_amount']) ?
                                            number_format($data['Reinvestment']['investment_amount'], 2) : '' );?>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Balance:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($data['Reinvestment']['earned_balance']) ?
                                            number_format($data['Reinvestment']['earned_balance'], 2) : '' );?>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <p></p>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Investment Type:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo 'Fixed Investment';?>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Notes:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($data['Reinvestment']['details']) ?
                                            $data['Reinvestment']['details'] : '' );?>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            
                <hr>            

                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="row">
                            
                            <?php
                            echo $this->Form->hidden('id', array('value' => (isset($data['Reinvestment']['id']) ? $data['Reinvestment']['id'] : '' )));
                            echo $this->Form->hidden('earned_balance', array('value' => (isset($data['Reinvestment']['earned_balance']) ? $data['Reinvestment']['earned_balance'] : '' )));
                            
                            echo $this->Form->hidden('user_id', array('value' => ($this->Session->check('userDetails.id') == true ? $this->Session->read('userDetails.id') : '' )));
                             echo $this->Form->hidden('reinvestorcashaccount_id', array('value' => (isset($reinvestorcashaccounts['ReinvestorCashaccount']['id']) ? $reinvestorcashaccounts['ReinvestorCashaccount']['id'] : '' )));
                             echo $this->Form->hidden('reinvestor_id', array('value' => (isset($reinvestorcashaccounts['ReinvestorCashaccount']['reinvestor_id']) ? $reinvestorcashaccounts['ReinvestorCashaccount']['reinvestor_id'] : '' )));
                             
                            echo $this->Form->input('investmentdestination_id', 
                                    array('required','empty' => '--Please Select--', 
                                        'value' => ($this->Session->check('rollreinvesttemp.investmentdestination_id') 
                                    == true ? $this->Session->read('rollreinvesttemp.investmentdestination_id') : 
                                        ($data['Reinvestment']['investment_destination_id'] ? 
                                            $data['Reinvestment']['investment_destination_id'] : '' )),
                                        'label' => 'Investment Destination Company/Fund*'));
                            ?>
                            
                                </div>
                            <div class="row">
                                <?php
                                 echo $this->Form->input('invdestproduct_id', array('required','empty' => '--Please Select--', 'selected' => 
                                         ($this->Session->check('reinvesttemp.inv_dest_product_id') == true ?
                                         $this->Session->read('reinvesttemp.inv_dest_product_id') : 
                                             ($data['Reinvestment']['inv_dest_product_id'] ? 
                                                 $data['Reinvestment']['inv_dest_product_id'] : '' ) ),
                                     'label' => 'Investment Product*','class' => 'invprods'));
                                 
                                 echo $this->Form->hidden('currency_id',['value' => 
                                     (isset($reinvestorcashaccounts['Reinvestor']['currency_id']) ? 
                                     $reinvestorcashaccounts['Reinvestor']['currency_id'] : '')]);
                                ?>
                            
                                </div>
                        </div>

                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo $this->Form->input('investment_amount', array('required',
                                        'label' => 'Investment Amount*', 'class' => 'required', 'value' => 
                                            ($this->Session->check('rollreinvesttemp.investment_amount') == true 
                                            ? number_format($this->Session->read('rollreinvesttemp.investment_amount'), 2, '.', ',') :
                                        ($data['Reinvestment']['earned_balance'] ? $data['Reinvestment']['earned_balance'] : '' ) ))); ?>
                                
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <?php
                                    echo $this->Form->input('duration',array('required','label' => 'Duration*', 
                                        'value' => ($this->Session->check('rollreinvesttemp.duration') == true ? 
                                            $this->Session->read('rollreinvesttemp.duration') : 
                                                ($data['Reinvestment']['duration'] ? $data['Reinvestment']['duration'] : '' ) ),'width' => '50px'));
                                    
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">  <?php
                                    
                                    echo $this->Form->input('investment_period', array('required','label' => 'Investment Period*', 'empty' => "--Please Select--",
                                        'options'=> array('Day(s)' => 'Day(s)','Year(s)'=>'Year(s)'),
                                        'selected' => ($this->Session->check('rollreinvesttemp.investment_period') == true ? 
                                            $this->Session->read('rollreinvesttemp.investment_period') :
                                        ($data['Reinvestment']['investment_period'] ? $data['Reinvestment']['investment_period'] : '' ) )
                                       )); ?>
                                     
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <?php // echo $this->Form->input('inv_freq', array('label' => 'Frequency', 'value' => (isset($investor['Investor']['inv_freq']) ? $investor['Investor']['inv_freq'] : '' )));  ?>
                                    <?php echo $this->Form->input('interest_rate', array('required','label' => 'Rate (%)*', 'value' => 
                                            ($this->Session->check('rollreinvesttemp.interest_rate') == true ? 
                                            $this->Session->read('rollreinvesttemp.interest_rate') : 
                                        ($data['Reinvestment']['interest_rate'] ? $data['Reinvestment']['interest_rate'] : '' )))); ?>
                                    
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px;'>Investment Date</span>";?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    if ($this->Session->check('rollreinvesttemp.investment_date') == true) {

                                        $dob_string = $this->Session->read('rollreinvesttemp.investment_date');
                                        $month = date('m', strtotime($dob_string));
                                        $day = date('d', strtotime($dob_string));
                                        $Year = date('Y', strtotime($dob_string));
                                    } else{
                                        $month = date('m');
                                        $day = date('d');
                                        $Year = date('Y');
                                    }
                                    ?>
                                    <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                                    <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                                    <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                                    <?php echo $this->Form->day('investment_date', array("selected" => $day, "class" => "large")); ?>&nbsp;
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo $this->Form->month('investment_date', array("selected" => $month, "class" => "large")); ?>&nbsp;
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo $this->Form->year('investment_date', 1950, date('Y'), array("selected" => $Year, "class" => "large")); ?>
                                
                                </div>
                                <script>
                                    var day = $("#day").val();
                                    var month = $("#month").val();
                                    var year = $("#year").val();
                                    $("#ReinvestmentInvestmentDateDay option[value=" + day + "]").attr('selected', true);
                                    $("#ReinvestmentInvestmentDateMonth option[value=" + month + "]").attr('selected', true);
                                    $("#ReinvestmentInvestmentDateYear option[value=" + year + "]").attr('selected', true);
                                </script>
                            </div>
                            
                            
                        </div>


                    </div>

                    <!-- Investment Details End -->

                
                
<!--                <div class="row" style="border-bottom: dotted 1px gray;">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <table width="80%" cellspacing="0" cellpadding="3" border="0">
                            <tr>
                                <td align="right"><b align="right">Due Date: </b></td>
                                <td><span id="xxxxxx"><?php
//                                        if (isset($duedate)) {
//                                            echo $duedate;
//                                        } else {
//                                            echo '';
//                                        }
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
//                                        if (isset($interest)) {
//                                            echo $shopCurrency . ' ' . number_format($interest, 2, '.', ',');
//                                        } else {
//                                            echo '';
//                                        }
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
//                                            if (isset($totaldue)) {
//                                                echo $shopCurrency . ' ' . number_format($totaldue, 2, '.', ',');
//                                            } else {
//                                                echo '';
//                                            }
                                            ?></b></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                </div>-->
                    
                <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
                <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right;">
                    <?php
                    echo $this->Html->link('Back', "/Reinvestments/manageInvFixed/".(isset($reinvestorcashaccounts['ReinvestorCashaccount']['reinvestor_id']) ? $reinvestorcashaccounts['ReinvestorCashaccount']['reinvestor_id'] : '' ), array("class" => 'btn btn-lg btn-info'));
                    echo $this->Form->button('Submit', array("type" => "submit", "class" => "btn btn-lg btn-success"));
                    echo "&nbsp;&nbsp;";
//                    echo $this->Html->link('Submit', "/Reinvestments/newInvestment1Fixed1/".(isset($reinvestorcashaccounts['ReinvestorCashaccount']['reinvestor_id']) ? $reinvestorcashaccounts['ReinvestorCashaccount']['reinvestor_id'] : '' ), array("class" => 'btn btn-lg btn-primary'));
                    ?>
                </div>
                    
                
        <?php
        echo $this->Form->end();
        ?>
        <div id="clearer"></div>

    </div>
    <!-- Content ends here -->
    <script type="text/javascript" language="javascript">
        $(document).ready(function ()
        {
             $("#ReinvestmentInvestmentAmount").mouseout(function () {
                 var inv_amount = $(this).val();
                 var url = '../getAvailableAmount';
                 var reinvestor_id = $("#ReinvestmentReinvestorId").val();
                 var query = "action=getAvailableAmount&amount=" + inv_amount + "&reinvestor_id=" + reinvestor_id;
                 if (inv_amount != ""){
                      $.ajax({
                    url: url,
                    data: query,
                    dataType: 'json',
                    type: 'POST',
                    success: function (data) {
                        
                    if (data['status'] == 'ok') {
                        
                    if(data['data'] == 'prompt'){
                        alert("Investment amount provided is more than available");
                        $(this).focus();
                         $(this).attr('border-color','red');
                         return false;
                    }
                     $(this).attr('border-color','#c6ced0');
                    } 
                    },
                    error: function () {
                        $(".errormsg").show();
                            $(".errormsg").html("Server Error. Check Server and Database Configurations").show('slow');
                            $(".errormsg").hide();
                  }
            });
                 }
                 
             });
            $("#ReinvestmentInvestmentdestinationId").change(function () {
                var url = '../getInvProd';
                var destination_id = $(this).val();
                
                  var toplevel = $(this).val();
    if(destination_id == ""){
        $('.invprods').html('<option value="">-- Select Product --</option>');
    }
            if (toplevel != ""){
    var query = "action=getInvProd&destination_id=" + toplevel;
            $.ajax({
                    url: url,
                    data: query,
                    dataType: 'json',
                    type: 'POST',
                    success: function (data) {
                        
                    if (data['status'] == 'fail') {
                        
                    $(".errormsg").show();
                            $(".errormsg").html(data['data']).show('slow');
                            $(".errormsg").hide();
                    } else {
                    //jquery("midleveltype").
                    $('.invprods').html('<option value="">-- Select Product --</option>');
                            var numbers = data['data'];
                            $.each(numbers, function(val,text) {
                               
                            $('.invprods').append('<option value="' +text['InvDestProduct']['id'] + '">' + text['InvDestProduct']['inv_dest_product'] +'</option>');
                            });
                            
                            return false;
                    }
                    },
                    error: function () {
                        $(".errormsg").show();
                            $(".errormsg").html("Server Error. Check Server and Database Configurations").show('slow');
                            $(".errormsg").hide();
                  }
            });
    }
//                if (id != "") {
//                    var query = "action=getfunds&" + "investee_id=" + id;
//
//                    $("#error_msg").hide();
//                    $.ajax({
//                        url: url,
//                        data: query,
//                        dataType: 'json',
//                        type: 'POST',
//                        success: function (data) {
//
//                            if (data['status'] == "ok") {
//                                var prod1 = data['data']['product1'];
//                                var prod2 = data['data']['product2'];
//                                var prod3 = data['data']['product3'];
//                                var prod4 = data['data']['product4'];
//                                var prod5 = data['data']['product5'];
//                                var prod6 = data['data']['product6'];
//                                var prod7 = data['data']['product7'];
//                                var prod8 = data['data']['product8'];
//                                var prod9 = data['data']['product9'];
//                                var selectHTML = '<option value="">-- Please Select --</option>';
//                                if (prod1 != "" || prod1 != null) {
//                                    selectHTML += "<option value=" + prod1 + ">" + prod1 + "</option>";
//                                }
//                                if (prod2 != "" && prod2 != null) {
//                                    selectHTML += "<option value=" + prod2 + ">" + prod2 + "</option>";
//                                }
//                                if (prod3 != "" && prod3 != null) {
//                                    selectHTML += "<option value=" + prod3 + ">" + prod3 + "</option>";
//                                }
//                                if (prod4 != "" && prod4 != null) {
//                                    selectHTML += "<option value=" + prod4 + ">" + prod4 + "</option>";
//                                }
//                                if (prod5 != "" && prod5 != null) {
//                                    selectHTML += "<option value=" + prod5 + ">" + prod5 + "</option>";
//                                }
//                                if (prod6 != "" && prod6 != null) {
//                                    selectHTML += "<option value=" + prod6 + ">" + prod6 + "</option>";
//                                }
//                                if (prod7 != "" && prod7 != null) {
//                                    selectHTML += "<option value=" + prod7 + ">" + prod7 + "</option>";
//                                }
//                                if (prod8 != "" && prod8 != null) {
//                                    selectHTML += "<option value=" + prod8 + ">" + prod8 + "</option>";
//                                }
//                                if (prod9 != "" && prod9 != null) {
//                                    selectHTML += "<option value=" + prod9 + ">" + prod9 + "</option>";
//                                }
//                                $("#ReinvestmentInvestmentproductId").html(selectHTML);
//                                return false;
//                            } else if (data['status'] == "failed") {
//
//
//
//                                return false;
//                            }
//
//                        },
//                        error: function () {
//                            $("#progress_msg").hide();
//                            $("#welcome_message").show();
//                            $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
//                            $("#welcome_message").hide(5000);
//                        }
//                    });
//                }
            });

        });
    </script>