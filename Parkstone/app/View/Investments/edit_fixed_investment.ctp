<?php echo $this->element('header'); ?>

<?php
$shopCurrency = "GH$";
if ($this->Session->check('shopCurrency_investment')) {
    $shopCurrency = $this->Session->read('shopCurrency_investment');
}
?>
<!-- Content starts here -->
<h3 style="color: #7EB000; ">Edit Fixed Investment</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">

            <tr>
                <td align="left" valign="top" colspan="3" style="font-size: 18px; color: gray; font-weight: bold;">Investor Details</td>
            </tr>
            <tr>
                <td align="left" valign="top" colspan="3">
                    <table border="0" width="100%" cellspacing="10" cellpadding="5" align="left">
                        <tr>
                            <td style="border-bottom: solid 2px dodgerblue;" align="left">
                                <b>ID</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue;" align="left">
                                <b>Name</b>
                            </td>

                            <td style="border-bottom: solid 2px dodgerblue" align="left">
                                <b>ITF</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue" width="200" align="left">
                                <b>Invested Amount</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue" width="200" align="left">
                                <b>Available Cash</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue" width="200" align="left">
                                <b>Phone Number</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue" align="left">
                                <b>Email</b>
                            </td>
                        </tr>
                        <?php
                        if (isset($inv)) {
                            ?>
                            <tr>
                                <td align="left">
                                    <?php
                                    if (!empty($inv['Investor']['id'])) {
                                        echo $inv['Investor']['id'];
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </td>
                                <td align="left">
                                    <?php
                                    if (!empty($inv['Investor']['surname']) && !empty($inv['Investor']['other_names'])) {
                                        echo $inv['Investor']['surname'] . ' ' . $inv['Investor']['other_names'];
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </td>

                                <td align="left">
                                    <?php
                                    if (!empty($inv['Investor']['in_trust_for'])) {
                                        echo $inv['Investor']['in_trust_for'];
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </td>
                                <td align="left">
                                    <?php
                                    if (!empty($inv['ClientLedger']['invested_amount'])) {
                                        echo 'GH$ '.number_format($inv['ClientLedger']['invested_amount']);
                                    } else {
                                        echo 'GH$ 0.00';
                                    }
                                    ?>
                                </td>
                                <td align="left">
                                    <?php
                                    if (!empty($inv['ClientLedger']['available_cash'])) {
                                        echo 'GH$ '.number_format($inv['ClientLedger']['available_cash']);
                                    } else {
                                        echo 'GH$ 0.00';
                                    }
                                    ?>
                                </td>
                                <td align="left">
                                    <?php
                                    if (!empty($inv['Investor']['phone'])) {
                                        echo $inv['Investor']['phone'];
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </td>
                                <td align="left">
                                    <?php
                                    if (!empty($inv['Investor']['email'])) {
                                        echo $inv['Investor']['email'];
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="left" valign="top" style="border-bottom: solid 3px #ffffff;">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="top" colspan="3">

                    <!-- Step Investment Details Start -->
                    <?php
                    echo $this->Form->create('Investment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'processfixed_edit'), "inputDefaults" => array('div' => false)));
                    ?>
                    <div class="row" style="background: #99ccff;">
                        <div class="col-lg-6 col-md-6 col-sm-12">

                            <?php
                            echo $this->Form->hidden('id', array('value' => (isset($data['Investment']['id']) ? $data['Investment']['id'] : $investment_id)));

                            echo $this->Form->hidden('user_id', array('value' => ($this->Session->check('userDetails.id') == true ? $this->Session->read('userDetails.id') : '')));
                            echo $this->Form->hidden('investor_type_id', array('value' => (isset($data['Investment']['investor_type_id']) ? $data['Investment']['investor_type_id'] : 2)));
                            echo $this->Form->hidden('investor_page', array('value' => 'editFixedInvestment'));
                            echo $this->Form->hidden('ledger_transaction_id', array('value' => (isset($data['InvestorDeposit']['ledger_transaction_id']) ? $data['InvestorDeposit']['ledger_transaction_id'] : '')));
                            echo $this->Form->hidden('investor_id', array('value' => (isset($inv['Investor']['id']) ?
                                        $inv['Investor']['id'] : $data['Investment']['investor_id'])));

                             echo $this->Form->hidden('old_investmentamount', array('value' => 
                                        ($this->Session->check('editinvesttemp.old_investmentamount') == true ?
                                                $this->Session->read('editinvesttemp.old_investmentamount') : $data['InvestmentCash']['amount'] )));

                            echo $this->Form->input('investmentproduct_id', array('disabled', 'label' => 'Investment Product',
                                'empty' => "--Please Select--", 'selected' => '1', 'style' => 'background: lilac;'));
                            ?>
                            <div class="row"> 
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <?php
                                    echo $this->Form->input('management_fee_type2', ['type' => 'select', 'disabled' ,'options' =>
                                        array('No Fee' => 'No Fee', 'Management Fee' => 'Management Fee', 'Performance Fee' => 'Performance Fee',
                                            'Management & Performance Fee' => 'Management & Performance Fee'),
                                        'empty' => '--Select Fee Type--', 'selected' =>
                                        ($this->Session->check('editinvesttemp.management_fee_type') == true ?
                                                $this->Session->read('editinvesttemp.management_fee_type') : $data['Investment']['management_fee_type'] )]);
                                    
                                    echo $this->Form->hidden('management_fee_type', ['type' => 'select', 'options' =>
                                        array('No Fee' => 'No Fee', 'Management Fee' => 'Management Fee', 'Performance Fee' => 'Performance Fee',
                                            'Management & Performance Fee' => 'Management & Performance Fee'),
                                        'empty' => '--Select Fee Type--', 'selected' =>
                                        ($this->Session->check('editinvesttemp.management_fee_type') == true ?
                                                $this->Session->read('editinvesttemp.management_fee_type') : $data['Investment']['management_fee_type'] )]);
                                    ?>
                                </div> 

                                <div class="col-lg-3 col-md-3 col-sm-12 hidden-fee">
                                    <?php
                                    echo $this->Form->input('base_fees2', array('label' => 'Base Fee(%)', 'disabled' ,'class' => 'required', 'value' =>
                                        ($this->Session->check('editinvesttemp.base_fees') == true ?
                                                $this->Session->read('editinvesttemp.base_fees') : $data['Investment']['base_fees'] )));
                                    
                                          echo $this->Form->hidden('base_fees', array('value' =>
                                        ($this->Session->check('editinvesttemp.base_fees') == true ?
                                                $this->Session->read('editinvesttemp.base_fees') : $data['Investment']['base_fees'] )));
                                    ?> 
                                </div>  

                                <div class="col-lg-4 col-md-4 col-sm-12 BenchmarkRate">
                                    <?php
                                    echo $this->Form->input('benchmark_rate2', array('label' => 'Benchmark(%)','disabled' ,'value' =>
                                        ($this->Session->check('editinvesttemp.benchmark_rate') == true ?
                                                $this->Session->read('editinvesttemp.benchmark_rate') : $data['Investment']['benchmark_rate'] )));
                                    echo $this->Form->hidden('benchmark_rate', array('value' =>
                                        ($this->Session->check('editinvesttemp.benchmark_rate') == true ?
                                                $this->Session->read('editinvesttemp.benchmark_rate') : $data['Investment']['benchmark_rate'] )));
                                    ?>
                                </div>
                            </div> 
                            <div class="row"> 
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    if(!empty($data['InvestmentCash']['investment_date'])){
                                        
                                            $dob_string = $data['InvestmentCash']['investment_date'];
                                            echo $this->Form->hidden('deposit_date', array('value' => $dob_string));
                                            $month = date('m', strtotime($dob_string));
                                            $day = date('d', strtotime($dob_string));
                                            $Year = date('Y', strtotime($dob_string));
                                    }else {

                                            $month = date('m');
                                            $day = date('d');
                                            $Year = date('Y');
                                        }
                                    
                                    
//                                    if ($this->Session->check('editinvesttemp.investment_date') == true) {
//
//                                        $dob_string = $this->Session->read('editinvesttemp.investment_date');
//                                        $month = date('m', strtotime($dob_string));
//                                        $day = date('d', strtotime($dob_string));
//                                        $Year = date('Y', strtotime($dob_string));
//                                    } else {
//                                        if (!empty($dob_string)) {
//                                            $month = date('m', strtotime($dob_string));
//                                            $day = date('d', strtotime($dob_string));
//                                            $Year = date('Y', strtotime($dob_string));
//                                        } else {
//
//                                            $month = date('m');
//                                            $day = date('d');
//                                            $Year = date('Y');
//                                        }
//                                    }
                                    ?>
                                    <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                                    <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                                    <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                                    
                                    <input type="hidden" name="data[Investment][investment_date][month]" value="<?php echo $month; ?>"/>
                                    <input type="hidden" name="data[Investment][investment_date][day]" value="<?php echo $day; ?>"/>
                                    <input type="hidden" name="data[Investment][investment_date][year]" value="<?php echo $Year; ?>"/>
                                    
                                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>Inv. Date*:</span>" . $this->Form->day('investment_date', array("selected" => $day,'disabled')); ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->month('investment_date', array("selected" => $month,'disabled')); ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->year('investment_date', 1950, date('Y'), array("selected" => $Year,'disabled')); ?>
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

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?php
                            echo $this->Form->input('paymentschedule_id', array('label' => 'Payment Schedule',
                                'empty' => "--Please Select--", 'value' =>
                                ($this->Session->check('editinvesttemp.paymentschedule_id') == true ?
                                        $this->Session->read('editinvesttemp.paymentschedule_id') :
                                        $data['Investment']['payment_schedule_id'] )));

                            echo $this->Form->input('paymentmode_id', array('label' => 'Payment Mode',
                                'empty' => "--Please Select--", 'value' => ($this->Session->check('editinvesttemp.paymentmode_id') ==
                                true ? $this->Session->read('editinvesttemp.paymentmode_id') :
                                        $data['Investment']['payment_mode_id'] )));
                            ?>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php
                            echo $this->Form->input('currency_id', array('disabled', 'type' => 'select', 'options' => $currencies,
                                'empty' => '--Please select currency--', 'selected' =>
                                ($this->Session->check('editinvesttemp.currency_id') == true ?
                                        $this->Session->read('editinvesttemp.currency_id') : $data['Investment']['currency_id'] )));
                            ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php echo $this->Form->input('cashreceiptmode_id', array('required', 'label' => 'Cash Receipt Mode',
                                'empty' => "--Please Select--", 'value' => ($this->Session->check('editinvesttemp.cashreceiptmode_id') == 
                                    true ? $this->Session->read('editinvesttemp.cashreceiptmode_id') : '' ))); ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php echo $this->Form->input('cheque_no', array('disabled', 'label' => 'Cheque No.', 'placeholder' => 
                                "Cheque number(s)", 'value' => ($this->Session->check('editinvesttemp.cheque_no') == true ? 
                                    $this->Session->read('editinvesttemp.cheque_no') : '' ))); ?>
                                </div>
                            </div>
                        </div>


                    </div>


                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12" id="fixed">
                            <!--<p style="font-size: 18px; font-weight: bold; color: dodgerblue; margin-top: 20px;">Fixed Investment</p>-->
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12" >
                            <?php
                            echo $this->Form->input('instruction_id', array('label' => 'Instructions',
                                'empty' => "--Please Select--", 'selected' =>
                                ($this->Session->check('editinvesttemp.instruction_id') == true ?
                                        $this->Session->read('editinvesttemp.instruction_id') : $data['Investment']['instruction_id'])));
                            ?>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12" >
                            <?php
                            echo $this->Form->input('instruction_details', array('label' => 'Other Instruction Details',
                                'placeholder' => "Complete this ONLY if 'Other' is selected", 'value' =>
                                ($this->Session->check('editinvesttemp.instruction_details') == true ?
                                        $this->Session->read('editinvesttemp.instruction_details') : $data['Investment']['instruction_details'] )));
                            ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                            <?php
                            echo $this->Form->input('investment_amount', array('required', 'label' => 'Investment Amount',
                                'class' => 'required', 'value' => ($this->Session->check('editinvesttemp.investment_amount') ==
                                true ? $this->Session->read('editinvesttemp.investment_amount') :
                                        $data['InvestmentCash']['amount'] )));
                            ?>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                            <?php
                            echo $this->Form->input('custom_rate2', array('label' => 'Benchmark(%)*','disabled' ,
                                'empty' => "--Please Select--", 'value' =>
                                ($this->Session->check('editinvesttemp.custom_rate') == true ?
                                        $this->Session->read('editinvesttemp.custom_rate') :
                                        $data['Investment']['custom_rate'] )));
                            
                            echo $this->Form->hidden('custom_rate', array(
                                'empty' => "--Please Select--", 'value' =>
                                ($this->Session->check('editinvesttemp.custom_rate') == true ?
                                        $this->Session->read('editinvesttemp.custom_rate') :
                                        $data['Investment']['custom_rate'] )));
                            ?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                <?php
                                echo $this->Form->input('duration2', array('required', 'label' => 'Duration*','disabled' ,
                                    'value' => ($this->Session->check('editinvesttemp.duration') == true ?
                                            $this->Session->read('editinvesttemp.duration') : $data['Investment']['duration'] ),
                                    'width' => '50px'));
                                echo $this->Form->hidden('duration', array(
                                    'value' => ($this->Session->check('editinvesttemp.duration') == true ?
                                            $this->Session->read('editinvesttemp.duration') : $data['Investment']['duration'] ),
                                    'width' => '50px'));
                                ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">  <?php
                                    echo $this->Form->input('investment_period2', array('required', 'label' => 'Inv. Period*','disabled' ,
                                        'empty' => "--Please Select--",
                                        'options' => array('Day(s)' => 'Day(s)', 'Year(s)' => 'Year(s)'),
                                        'value' => ($this->Session->check('editinvesttemp.investment_period') == true ?
                                                $this->Session->read('editinvesttemp.investment_period') : $data['Investment']['investment_period'] )
                                    ));
                                    echo $this->Form->hidden('investment_period', array(
                                        'empty' => "--Please Select--",
                                        'options' => array('Day(s)' => 'Day(s)', 'Year(s)' => 'Year(s)'),
                                        'value' => ($this->Session->check('editinvesttemp.investment_period') == true ?
                                                $this->Session->read('editinvesttemp.investment_period') : $data['Investment']['investment_period'] )
                                    ));
                                ?>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                <?php
                                echo $this->Form->input('total_tenure2', array('label' => 'Total Tenure', 'required','disabled' ,
                                    'placeholder' => "0", 'value' => ($this->Session->check('editinvesttemp.total_tenure') == true ?
                                            $this->Session->read('editinvesttemp.total_tenure') : $data['Investment']['total_tenure'] )));
                                echo $this->Form->hidden('total_tenure', array( 'value' => ($this->Session->check('editinvesttemp.total_tenure') == true ?
                                            $this->Session->read('editinvesttemp.total_tenure') : $data['Investment']['total_tenure'] )));
                                ?>

                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <?php echo $this->Form->button('Process', array("type" => "submit", "class" => "btn btn-lg btn-success", 'name' => "fixed_process")); ?>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12" style="border-top: dotted 1px gray; background: #C6F19F;">

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo "<span style='font-weight: bold; font-size: 11px; color: red;'>Due Date:</span><br>";
                                    if (isset($duedate)) {
                                        echo $duedate;
                                    } else {
                                        echo '';
                                    }
                                    ?>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo "<span style='font-weight: bold; font-size: 11px; color: red;'>Interest:</span><br>";
                                    if (isset($interest)) {
                                        echo $shopCurrency . ' ' . $interest;
                                    } else {
                                        echo '';
                                    }
                                    ?>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo "<span style='font-weight: bold; font-size: 11px; color: red;'>Expected Amt Due:</span><br>";
                                    if (isset($totaldue)) {
                                        echo $shopCurrency . ' ' . $totaldue;
                                    } else {
                                        echo '';
                                    }
                                    ?>

                                </div>


                            </div>
                        </div>


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
                    <?php echo $this->Html->link('Back', "/Investments/manageFixedInvestments/".(isset($inv['Investor']['id']) ? $inv['Investor']['id'] : '')."/".(isset($inv['Investor']['fullname']) ? $inv['Investor']['fullname'] : ''), array("class" => 'btn btn-lg btn-info')); ?>

                    &nbsp;&nbsp;
                    <?php echo $this->Html->link('Next', "/Investments/newInvestmentCert",
                            array("class" => 'btn btn-lg btn-primary',
                                'confirm' => 'Are you sure you wish to edit this investment?')
                             ); ?>
                </td>
            </tr>
        </table>
        <?php
        echo $this->Form->end();
        ?>
        <div id="clearer"></div>

    </div>
    <!-- Content ends here -->
    <?php
//    $this->Session->delete('investtemp1');
    ?>
    <script lang="javascript">
        jQuery(document).ready(function($) {
            function hide_benchmark() {
                var fee_type = $("#InvestmentManagementFeeType").val();
                $(".BenchmarkRate").show();
                $(".hidden-fee").show();
                if (fee_type == "Performance Fee") {
                    $(".hidden-fee").hide();
                    return false;
                }
                if (fee_type == "Management Fee") {
                    $(".BenchmarkRate").hide();
                    return false;
                }
            }
            var prod_val = $("#InvestmentInvestmentproductId").val();
            if (prod_val == "1") {

                $("#fixed").show("slow");
                $("#equity").hide("slow");
            }

            if (prod_val == "2") {

                $("#equity").show(5000);
                $("#fixed").hide("slow");
            }

            if (prod_val == "3") {
                $("#fixed").show("slow");
                $("#equity").show("slow");
            }

            if (prod_val == "") {
                $("#fixed").show("slow");
                $("#equity").show("slow");
            }

            $("#InvestmentInvestmentproductId").change(function() {


                var investmentproduct = $(this).val();
                if (investmentproduct == "1") {

                    $("#fixed").show("slow");
                    $("#equity").hide("slow");
                }

                if (investmentproduct == "2") {

                    $("#equity").show(5000);
                    $("#fixed").hide("slow");
                }

                if (investmentproduct == "3") {
                    $("#fixed").show("slow");
                    $("#equity").show("slow");
                }

                if (investmentproduct == "") {
                    $("#fixed").show("slow");
                    $("#equity").show("slow");
                }

            });
            function hide_chequeno() {
                var cashmode = $("#InvestmentCashreceiptmodeId").val();
                if (cashmode == '2') {
                    $("#InvestmentChequeNo").prop('disabled', false);
                    return false;
                }
                if (cashmode != '2') {
                    $("#InvestmentChequeNo").prop('disabled', true);
                    return false;
                }
            }




            //hide tenure if no
            hide_chequeno();
            $("#InvestmentCashreceiptmodeId").change(function() {
                hide_chequeno();
            });

            //hide benchmark if management fee is chosen
            hide_benchmark();
            $("#InvestmentManagementFeeType").change(function() {
                hide_benchmark();
            });
        });
    </script>
<?php echo $this->element('footer'); ?>