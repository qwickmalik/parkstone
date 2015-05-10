<?php echo $this->element('header'); ?>

<?php
$shopCurrency = "GH$";
if ($this->Session->check('shopCurrency_investment')) {
    $shopCurrency = $this->Session->read('shopCurrency_investment');
}
?>
<!-- Content starts here -->
<h3>New Investment - Step 2</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">

            <tr>
                <td align="left" valign="top" colspan="3" style="font-size: 18px; color: gray; font-weight: bold;">Investor Details</td>
            </tr>
            <tr>
                <td align="left" valign="top" colspan="3">
                    <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
                        <tr>
                            <td style="border-bottom: solid 2px dodgerblue;" align="left">
                                <b>ID</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue;" align="left">
                                <b>Group Name</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue" align="left">
                                <b>Contact Person</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue" width="200" align="left">
                                <b>Email</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue" align="left">
                                <b>Phone</b>
                            </td>
                        </tr>
                        <?php if (isset($investors)) {
                            ?>
                            <tr>
                                <td align="left">
                                    <?php
                                    if (isset($investors['Investor']['id'])) {
                                        echo $investors['Investor']['id'];
                                    } else {
                                        echo '';
                                    }
                                    ?>
                                </td>
                                <td align="left">
                                    <?php
                                    if (isset($investors['Investor']['comp_name'])) {
                                        echo $investors['Investor']['comp_name'];
                                    } else {
                                        echo '';
                                    }
                                    ?>
                                </td>
                                <td align="left">
                                    <?php
                                    if (isset($investors['Investor']['contact_person'])) {
                                        echo $investors['Investor']['contact_person'];
                                    } else {
                                        echo '';
                                    }
                                    ?>
                                </td>
                                <td align="left">
                                    <?php
                                    if (isset($investors['Investor']['email'])) {
                                        echo $investors['Investor']['email'];
                                    } else {
                                        echo '';
                                    }
                                    ?>
                                </td>
                                <td align="left">
                                    <?php
                                    if (isset($investors['Investor']['phone'])) {
                                        echo $investors['Investor']['phone'];
                                    } else {
                                        echo '';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php }
                        ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="left" valign="top" style="border-bottom: solid 3px gray;">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="top" colspan="3">

                    <!-- Step Investment Details Start -->
                    <?php
                    echo $this->Form->create('Investment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'process_comp'), "inputDefaults" => array('div' => false)));
                    ?>
                    <div class="row" style="background: #99ccff;">
                        <div class="col-lg-6 col-md-6 col-sm-12"> 
                            <?php
                            echo $this->Form->hidden('user_id', array('value' => ($this->Session->check('userDetails.id') == true ? $this->Session->read('userDetails.id') : '' )));
                            echo $this->Form->hidden('investor_type_id', array('value' => 2));
                            echo $this->Form->hidden('investor_page', array('value' => 'newInvestment2Group'));
                            echo $this->Form->hidden('investor_id', array('value' => (isset($investors['Investor']['id']) ?
                                    $investors['Investor']['id'] : '')));

                            echo $this->Form->input('investmentproduct_id', array('label' => 'Investment Product', 'empty' => "--Please Select--", 'selected' => ($this->Session->check('investtemp.investmentproduct_id') == true ? $this->Session->read('investtemp.investmentproduct_id') : '' ), 'style' => 'background: lilac;'));
                            ?>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    if ($this->Session->check('investtemp1.investment_date') == true) {

                                        $dob_string = $this->Session->read('investtemp1.investment_date');
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
                                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>Inv. Date*:</span>" . $this->Form->day('investment_date', array("selected" => $day)); ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->month('investment_date', array("selected" => $month)); ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->year('investment_date', 1950, date('Y'), array("selected" => $Year)); ?>
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
                            
                            <div class="row"> 
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <?php
                                    echo $this->Form->input('management_fee_type', ['type' => 'select', 'options' =>
                                        array('No Fee' => 'No Fee', 'Management Fee' => 'Management Fee', 'Performance Fee' => 'Performance Fee',
                                            'Management & Performance Fee' => 'Management & Performance Fee'),
                                        'empty' => '--Select Fee Type--', 'selected' =>
                                        ($this->Session->check('investtemp1.management_fee_type') == true ?
                                                $this->Session->read('investtemp1.management_fee_type') : '' )]);
                                    ?>
                                </div> 

                                <div class="col-lg-3 col-md-3 col-sm-12 hidden-fee">
                                    <?php
                                    echo $this->Form->input('base_fees', array('label' => 'Base Fee(%)', 'class' => 'required', 'value' =>
                                        ($this->Session->check('investtemp1.base_fees') == true ?
                                                $this->Session->read('investtemp1.base_fees') : '' )));
                                    ?> 
                                </div>  
                                
                                <div class="col-lg-4 col-md-4 col-sm-12 BenchmarkRate">
                                    <?php
                                    echo $this->Form->input('benchmark_rate', array('label' => 'Benchmark Rate(%)', 'value' =>
                                        ($this->Session->check('investtemp1.benchmark_rate') == true ?
                                                $this->Session->read('investtemp1.benchmark_rate') : '' )));
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <?php echo $this->Form->input('paymentschedule_id', array('label' => 'Payment Schedule', 'empty' => "--Please Select--", 'value' => ($this->Session->check('investtemp1.paymentschedule_id') == true ? $this->Session->read('investtemp1.paymentschedule_id') : '' )));?>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <?php echo $this->Form->input('paymentmode_id', array('label' => 'Payment Mode', 'empty' => "--Please Select--", 'value' => ($this->Session->check('investtemp1.paymentmode_id') == true ? $this->Session->read('investtemp1.paymentmode_id') : '' ))); ?>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('currency_id', array('type' => 'select', 'options' => $currencies, 'empty' => '--Please select currency--', 'selected' => ($this->Session->check('investtemp1.currency_id') == true ? $this->Session->read('investtemp1.currency_id') : '' )));
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo $this->Form->input('cashreceiptmode_id', array('required','label' => 'Cash Receipt Mode', 'empty' => "--Please Select--", 'value' => ($this->Session->check('investtemp1.cashreceiptmode_id') == true ? $this->Session->read('investtemp1.cashreceiptmode_id') : '' ))); ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo $this->Form->input('cheque_no', array('label' => 'Cheque No.', 'placeholder' => "Cheque number(s)", 'value' => ($this->Session->check('investtemp1.cheque_no') == true ? $this->Session->read('investtemp1.cheque_no') : '' ))); ?>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('amount_deposited', array('label' => 'Amount Deposited', 'class' => 'required', 'value' =>
                                        (isset($amount_deposited) ? $amount_deposited : 0.00  )));
                                    ?> 
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 ">
                                    <?php
                                       echo $this->Form->input('cash_athand2', array('label' => 'Available Cash', 'class' => 'required', 'value' =>
                                        (isset($cash_athand) ? $cash_athand : $ledger_data['ClientLedger']['available_cash']  ), 'disabled'));
                                  
                                    echo $this->Form->hidden('cash_athand', array('label' => 'Available Cash', 'class' => 'required', 'value' =>
                                        (isset($cash_athand) ? $cash_athand : $ledger_data['ClientLedger']['available_cash']  )));
                                    ?> 
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->hidden('total_invested', array('label' => 'Total Invested', 'value' =>
                                        (isset($total_invested) ? $total_invested : '' )));

                                    echo $this->Form->input('total_invested2', array('disabled', 'label' => 'Total Invested', 'value' =>
                                        (isset($total_invested) ? $total_invested : $ledger_data['ClientLedger']['invested_amount']  )));
                                    ?>
                                </div>
                            </div>
                            
                            
                        </div>
                        
                        
                    </div>


                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12" id="fixed">
                            <p style="font-size: 18px; font-weight: bold; color: dodgerblue; margin-top: 20px;">Fixed Investment</p>
                            <div class="row">

                                <div class="col-lg-6 col-md-6 col-sm-12" >
                                    <?php
                                    echo $this->Form->input('instruction_id', array('label' => 'Instructions', 'empty' => "--Please Select--", 'selected' => ($this->Session->check('investtemp.instruction_id') == true ? $this->Session->read('investtemp.instruction_id') : '' )));
                                    ?>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12" >
                                    <?php
                                    echo $this->Form->input('instruction_details', array('label' => 'Other Instruction Details', 'placeholder' => "Complete this ONLY if 'Other' is selected", 'value' => ($this->Session->check('investtemp.instruction_details') == true ? $this->Session->read('investtemp.instruction_details') : '' )));
                                    ?>

                                </div>
                            </div>




                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <?php echo $this->Form->input('investment_amount', array('label' => 'Investment Amount', 'class' => 'required', 'placeholder' => '0.00', 'value' => ($this->Session->check('investtemp.investment_amount') == true ? $this->Session->read('investtemp.investment_amount') : '' ))); ?>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <?php // echo $this->Form->input('inv_freq', array('label' => 'Frequency', 'value' => (isset($investor['Investor']['inv_freq']) ? $investor['Investor']['inv_freq'] : '' )));   ?>
                                    <?php
                                    echo $this->Form->input('custom_rate', array('required', 'label' => 'Benchmark(%)*',
                                        'value' => ($this->Session->check('investtemp.custom_rate') == true ? $this->Session->read('investtemp.custom_rate') : 0 )));
                                    ?>

                                </div>
                            </div>
                            <div class="row">

                                <!--                                <div class="col-lg-4 col-md-4 col-sm-12">
                                <?php // echo $this->Form->input('inv_freq', array('label' => 'Frequency', 'value' => (isset($investor['Investor']['inv_freq']) ? $investor['Investor']['inv_freq'] : '' )));     ?>
<?php // echo $this->Form->input('custom_rate', array('label' => 'Expected Interest', 'value' => ($this->Session->check('investtemp.custom_rate') == true ? $this->Session->read('investtemp.custom_rate') : '' )));   ?>
                                
                                                                </div>-->
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('duration', array('required', 'label' => 'Duration*',
                                        'value' => ($this->Session->check('investtemp.duration') == true ?
                                                $this->Session->read('investtemp.duration') : 0 ), 'width' => '50px'));
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">  <?php
                                    echo $this->Form->hidden('investment_period', array('value' => 'Day(s)'));
                                    echo $this->Form->input('investment_period2', array('required', 'label' => 'Inv. Period*', 'empty' => "--Please Select--",
                                        'options' => array('Day(s)' => 'Day(s)', 'Year(s)' => 'Year(s)'),
                                        'default' => 'Day(s)', 'value' => 'Day(s)'));
                                    ?>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
<?php echo $this->Form->input('total_tenure', array('required','label' => 'Total Tenure', 'placeholder' => "0", 'value' => ($this->Session->check('investtemp.total_tenure') == true ? $this->Session->read('investtemp.total_tenure') : 0 ))); ?>

                                </div>

                            </div>
                            <!--<p>&nbsp;</p>-->
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
                                        echo $shopCurrency . ' ' . number_format($interest, 2, '.', ',');
                                    } else {
                                        echo '';
                                    }
                                    ?>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo "<span style='font-weight: bold; font-size: 11px; color: red;'>Expected Amt Due:</span><br>";
                                    if (isset($totaldue)) {
                                        echo $shopCurrency . ' ' . number_format($totaldue, 2, '.', ',');
                                    } else {
                                        echo '';
                                    }
                                    ?>

                                </div>


                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12" id="equity">
                            <p style="font-size: 18px; font-weight: bold; color: dodgerblue; margin-top: 20px;">Equity Investment</p>
                            <?php
                            echo "<p><br><i>Desired equity not listed here? " . $this->Html->link('Add to the list', '/Settings/equitiesList') . "</i></p>";
                            ?>

                            <div class="row" style="background: #E3F8FD; margin-bottom: 5px;  border: solid 1px #A7D2F4;">

                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <?php
                                    echo $this->Form->input('equities_list_id', ['class' => 'equity_id', 'selected' => ($this->Session->check('investtemp.equities_list_id') == true ? $this->Session->read('investtemp.equities_list_id') : '' ), 'id' => '', 'type' => 'select', 'label' => 'Equity', 'options' => $equitieslists, 'empty' => '--Please choose desired equity--']);
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('numb_shares', array('label' => 'No. of Shares*', 'class' => 'required', 'value' => ($this->Session->check('investtemp.numb_shares') == true ? $this->Session->read('investtemp.numb_shares') : '' )));
                                    ?>

                                </div>


                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('share_price', array('disabled', 'label' => 'Purchase Price*', 'class' => 'required', 'value' => ($this->Session->check('investtemp.share_price') == true ? $this->Session->read('investtemp.share_price') : '' )));
                                    echo $this->Form->hidden('purchase_price', array('value' => ($this->Session->check('investtemp.purchase_price') == true ? $this->Session->read('investtemp.purchase_price') : '' )));
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('min_share_price', array('label' => 'Min Price', 'class' => 'required', 'value' => ($this->Session->check('investtemp.min_share_price') == true ? $this->Session->read('investtemp.min_share_price') : '' )));
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('max_share_price', array('label' => 'Max Price', 'class' => 'required', 'value' => ($this->Session->check('investtemp.max_share_price') == true ? $this->Session->read('investtemp.max_share_price') : '' )));
                                    ?>
                                </div> 
                            </div>

                            <div class="row" style="background: #E3F8FD; margin-bottom: 5px; border: solid 1px #A7D2F4;">

                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <?php
                                    echo $this->Form->input('equities_list_id2', ['class' => 'equity_id', 'selected' => ($this->Session->check('investtemp.equities_list_id2') == true ? $this->Session->read('investtemp.equities_list_id2') : '' ), 'id' => '2', 'type' => 'select', 'label' => 'Equity', 'options' => $equitieslists, 'empty' => '--Please choose desired equity--']);
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('numb_shares2', array('label' => 'No. of Shares*', 'class' => 'required', 'value' => ($this->Session->check('investtemp.numb_shares2') == true ? $this->Session->read('investtemp.numb_shares2') : '' )));
                                    ?>

                                </div>


                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('share_price2', array('disabled', 'label' => 'Purchase Price*', 'class' => 'required', 'value' => ($this->Session->check('investtemp.share_price2') == true ? $this->Session->read('investtemp.share_price2') : '' )));
                                    echo $this->Form->hidden('purchase_price2', array('value' => ($this->Session->check('investtemp.purchase_price2') == true ? $this->Session->read('investtemp.purchase_price2') : '' )));
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('min_share_price2', array('label' => 'Min Price', 'class' => 'required', 'value' => ($this->Session->check('investtemp.min_share_price2') == true ? $this->Session->read('investtemp.min_share_price2') : '' )));
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('max_share_price2', array('label' => 'Max Price', 'class' => 'required', 'value' => ($this->Session->check('investtemp.max_share_price2') == true ? $this->Session->read('investtemp.max_share_price2') : '' )));
                                    ?>
                                </div> 
                            </div>

                            <div class="row" style="background: #E3F8FD; margin-bottom: 5px; border: solid 1px #A7D2F4;">

                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <?php
                                    echo $this->Form->input('equities_list_id3', ['class' => 'equity_id', 'selected' => ($this->Session->check('investtemp.equities_list_id3') == true ? $this->Session->read('investtemp.equities_list_id3') : '' ), 'id' => '3', 'type' => 'select', 'label' => 'Equity', 'options' => $equitieslists, 'empty' => '--Please choose desired equity--']);
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('numb_shares3', array('label' => 'No. of Shares*', 'class' => 'required', 'value' => ($this->Session->check('investtemp.numb_shares3') == true ? $this->Session->read('investtemp.numb_shares3') : '' )));
                                    ?>

                                </div>


                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('share_price3', array('disabled', 'label' => 'Purchase Price*', 'class' => 'required', 'value' => ($this->Session->check('investtemp.share_price3') == true ? $this->Session->read('investtemp.share_price3') : '' )));
                                    echo $this->Form->hidden('purchase_price3', array('value' => ($this->Session->check('investtemp.purchase_price3') == true ? $this->Session->read('investtemp.purchase_price3') : '' )));
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('min_share_price3', array('label' => 'Min Price', 'class' => 'required', 'value' => ($this->Session->check('investtemp.min_share_price3') == true ? $this->Session->read('investtemp.min_share_price3') : '' )));
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('max_share_price3', array('label' => 'Max Price', 'class' => 'required', 'value' => ($this->Session->check('investtemp.max_share_price3') == true ? $this->Session->read('investtemp.max_share_price3') : '' )));
                                    ?>
                                </div> 
                            </div>

                            <div class="row" style="background: #E3F8FD; margin-bottom: 5px; border: solid 1px #A7D2F4;">

                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <?php
                                    echo $this->Form->input('equities_list_id4', ['class' => 'equity_id', 'selected' => ($this->Session->check('investtemp.equities_list_id4') == true ? $this->Session->read('investtemp.equities_list_id4') : '' ), 'id' => '4', 'type' => 'select', 'label' => 'Equity', 'options' => $equitieslists, 'empty' => '--Please choose desired equity--']);
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('numb_shares4', array('label' => 'No. of Shares*', 'class' => 'required', 'value' => ($this->Session->check('investtemp.numb_shares4') == true ? $this->Session->read('investtemp.numb_shares4') : '' )));
                                    ?>

                                </div>


                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('share_price4', array('disabled', 'label' => 'Purchase Price*', 'class' => 'required', 'value' => ($this->Session->check('investtemp.share_price4') == true ? $this->Session->read('investtemp.share_price4') : '' )));
                                    echo $this->Form->hidden('purchase_price4', array('value' => ($this->Session->check('investtemp.purchase_price4') == true ? $this->Session->read('investtemp.purchase_price4') : '' )));
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('min_share_price4', array('label' => 'Min Price', 'class' => 'required', 'value' => ($this->Session->check('investtemp.min_share_price4') == true ? $this->Session->read('investtemp.min_share_price4') : '' )));
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('max_share_price4', array('label' => 'Max Price', 'class' => 'required', 'value' => ($this->Session->check('investtemp.max_share_price4') == true ? $this->Session->read('investtemp.max_share_price4') : '' )));
                                    ?>
                                </div> 
                            </div>

                            <div class="row" style="background: #E3F8FD; margin-bottom: 5px; border: solid 1px #A7D2F4;">

                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <?php
                                    echo $this->Form->input('equities_list_id5', ['class' => 'equity_id', 'selected' => ($this->Session->check('investtemp.equities_list_id5') == true ? $this->Session->read('investtemp.equities_list_id5') : '' ), 'id' => '5', 'type' => 'select', 'label' => 'Equity', 'options' => $equitieslists, 'empty' => '--Please choose desired equity--']);
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('numb_shares5', array('label' => 'No. of Shares*', 'class' => 'required', 'value' => ($this->Session->check('investtemp.numb_shares5') == true ? $this->Session->read('investtemp.numb_shares5') : '' )));
                                    ?>

                                </div>


                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('share_price5', array('disabled', 'label' => 'Purchase Price*', 'class' => 'required', 'value' => ($this->Session->check('investtemp.share_price5') == true ? $this->Session->read('investtemp.share_price5') : '' )));
                                    echo $this->Form->hidden('purchase_price5', array('value' => ($this->Session->check('investtemp.purchase_price5') == true ? $this->Session->read('investtemp.purchase_price5') : '' )));
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('min_share_price5', array('label' => 'Min Price', 'class' => 'required', 'value' => ($this->Session->check('investtemp.min_share_price5') == true ? $this->Session->read('investtemp.min_share_price5') : '' )));
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('max_share_price5', array('label' => 'Max Price', 'class' => 'required', 'value' => ($this->Session->check('investtemp.max_share_price5') == true ? $this->Session->read('investtemp.max_share_price5') : '' )));
                                    ?>
                                </div> 
                            </div>




                            <div class="row">

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo "<p>&nbsp;</p>";
                                    echo $this->Form->button('Process', array("type" => "submit", "class" => "btn btn-lg btn-success", 'name' => "equity_process"));
                                    ?>
                                </div>
                            </div>
                            <p>&nbsp;</p>


                            <div class="col-lg-12 col-md-12 col-sm-12" style="border-top: dotted 1px gray; background: #C6F19F;">


                                <!--                                <div class="col-lg-4 col-md-4 col-sm-12">
                                <?php
//                                    echo "<span style='font-weight: bold; font-size: 11px; color: red;'>Equity:</span><br>";
//                                    if (isset($equity)) {
//                                        echo $equity;
//                                    } else {
//                                        echo '';
//                                    }
                                ?>
                                
                                                                </div>-->
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <?php
                                    echo "<span style='font-weight: bold; font-size: 11px; color: red;'>Total Equity Purchased:</span><br>";
                                    if (isset($share_price)) {
                                        echo $shopCurrency . ' ' . number_format($share_price, 2, '.', ',');
                                    } else {
                                        echo '';
                                    }
                                    ?>

                                </div>

                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <?php
                                    echo "<span style='font-weight: bold; font-size: 11px; color: red;'>Expected Amt Due:</span><br>";
                                    if (isset($totalamt)) {
                                        echo $shopCurrency . ' ' . number_format($totalamt, 2, '.', ',');
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
<?php echo $this->Html->link('Back', "/Investments/newInvestment0", array("class" => 'btn btn-lg btn-info')); ?>

                    &nbsp;&nbsp;
                    <?php
// Edit this to lead to a function that will send the data to db and pass the investment_id to  newInvestmentCert()
// Same investment contract/cert to be used for all investor types
                    echo $this->Html->link('Next', "/Investments/newInvestmentCert/", array("class" => 'btn btn-lg btn-primary'));
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
<?php echo $this->element('footer'); ?>
    
    <?php
//    $this->Session->delete('investtemp1');
    ?>
    <script lang="javascript">
        jQuery(document).ready(function ($) {
          
           function hide_benchmark(){
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
            function hide_investcolumn() {
                var prod_val = $("#InvestmentInvestmentproductId").val();
//             $(".hidden-fee").hide();
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
            }
       function hide_chequeno() {
                var cashmode = $("#InvestmentCashreceiptmodeId").val();
                if (cashmode == '2') {
                    $("#InvestmentChequeNo").prop('disabled',false);
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
            //hide or show fixed income and equity columns
            hide_investcolumn();
            $("#InvestmentInvestmentproductId").change(function() {

                hide_investcolumn();
            });
            //hide benchmark if management fee is chosen
            hide_benchmark();
            $("#InvestmentManagementFeeType").change(function () {
               hide_benchmark();
            });
            //get current equity share price
            jQuery(".equity_id").change(function () {
                var class_no = jQuery(this).prop('id');


                var equity_id = jQuery(this).val();
                if (equity_id == "") {

                    jQuery('#InvestmentSharePrice' + class_no).val("");
                    jQuery('#InvestmentPurchasePrice' + class_no).val("");
                }
                if (equity_id != "") {
                    var query = "action=getPurchasePrice&ID=" + equity_id;
                    jQuery.ajax({
                        url: "../../Investments/getPurchasePrice",
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
                                jQuery('#InvestmentSharePrice' + class_no).val(data['EquitiesList']['share_price']);
                                jQuery('#InvestmentPurchasePrice' + class_no).val(data['EquitiesList']['share_price']);

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
