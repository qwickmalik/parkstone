<?php echo $this->element('header'); ?>

<?php
$shopCurrency = "GH$";
if ($this->Session->check('shopCurrency_investment')) {
    $shopCurrency = $this->Session->read('shopCurrency_investment');
}
?>
<!-- Content starts here -->
<h3 style="color: #7EB000; ">Roll-over Fixed Investment</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">

            <tr>
                <td align="left" valign="top" colspan="3" style="font-size: 18px; color: gray; font-weight: bold;">Investor Details</td>
            </tr>
            <tr>
                <td align="left" valign="top" colspan="3">
<!--                    <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
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
                                <b>Phone Number</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue" align="left">
                                <b>Email</b>
                            </td>
                        </tr>
                    <?php
//                        if (isset($inv)) {
//                            foreach ($inv as $investor):
//                                
                    ?>
                                <tr>
                                    <td align="left">
                                        //<?php
//                                        if (isset($investor['id'])) {
//                                            echo $investor['id'];
//                                        } else {
//                                            echo '';
//                                        }
//                                        
                    ?>
                                    </td>
                                    <td align="left">
                                        //<?php
//                                        if (isset($investor['surname']) && isset($investor['other_names'])) {
//                                            echo $investor['surname'] . ' ' . $investor['other_names'];
//                                        } else {
//                                            echo '';
//                                        }
//                                        
                    ?>
                                    </td>

                                    <td align="left">
                                        //<?php
//                                        if (isset($investor['in_trust_for'])) {
//                                            echo $investor['in_trust_for'];
//                                        } else {
//                                            echo '';
//                                        }
//                                        
                    ?>
                                    </td>
                                    <td align="left">
                                        //<?php
//                                        if (isset($investor['phone'])) {
//                                            echo $investor['phone'];
//                                        } else {
//                                            echo '';
//                                        }
//                                        
                    ?>
                                    </td>
                                    <td align="left">
                                        //<?php
//                                        if (isset($investor['email'])) {
//                                            echo $investor['email'];
//                                        } else {
//                                            echo '';
//                                        }
//                                        
                    ?>
                                    </td>
                                </tr>
                                //<?php
//                            endforeach;
//                        }
                    ?>
                    </table>-->
                    <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">
                        <tr>
                            <td >
                                <table border="0" width="100%" cellspacing="5" cellpadding="0" align="left">
                                    <tr>
                                        <td align="left" width="30%"><p style="font-size: 18px;">Investor ID: </p></td>
                                        <td align="left"><p style="font-size: 18px;"><?php
                    if (isset($data['Investment']['investor_id'])) {
                        echo $data['Investment']['investor_id'];
                    }
                    ?></p></td>
                                    </tr>
                                   
                                </table>
                            </td>
                            <td >
                                <table border="0" width="100%" cellspacing="5" cellpadding="0" align="left">
                                  
                                    <tr>
                                        <td align="left" width="30%"><p style="font-size: 18px;">Investor Name: </p></td>
                                        <td align="left"><p style="font-size: 18px;"><?php
                                                if (isset($data['Investor']['fullname'])) {
                                                    echo $data['Investor']['fullname'];
                                                }
                    ?></p></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" width="50%">
                                <table width="100%" cellspacing="10" cellpadding="0" border="0">
                                    <tr>
                                        <td width="30%"><b align="right">Investment ID:</b></td>
                                        <td><span  align="left" id="xxxxxx"><?php
                                            if (isset($data['Investment']['id'])) {
                                                echo $data['Investment']['id'];
                                            }
                                            ?></span>

                                            <input type="hidden" value="<?php
                                                if (isset($data['Investment']['id'])) {
                                                    echo $data['Investment']['id'];
                                                }
                                                ?>" name="hid_investid" /></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><b align="right">Investment Tenure:</b></td>
                                        <td><span align="left" id="xxxxxx"><?php
                                                if (isset($data['Investment']['duration'])) {
                                                    echo $data['Investment']['duration'] . ' ' . $data['Investment']['investment_period'];
                                                }
                                                ?></span></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><b align="right">Investment Date:</b></td>
                                        <td><span align="left" id="xxxxxx"><?php
                                                if (isset($data['Investment']['investment_date'])) {
                                                    echo $data['Investment']['investment_date'];
                                                }
                                                ?></span></td>
                                    </tr>
                                    <tr>
                                        <td><b align="right">Instruction:</b></td>
                                        <td><span id="xxxxxx"><?php
                                                if ($data['Instruction']['id'] != 5) {
                                                    echo $data['Instruction']['instruction_name'];
                                                } else {
                                                    echo $data['Investment']['instruction_details'];
                                                }
                                                ?></span></td>
                                    </tr>
                                    <tr>
                                        <td><b align="right">&nbsp;</b></td>
                                        <td><span id="xxxxxx">&nbsp;</span></td>
                                    </tr>
                                </table>

                                <div style="clear: both;"></div>
                            </td>
                            <td align="left" valign="top" width="50%">

                                <table width="100%" cellspacing="10" cellpadding="0" border="0">

                                    <tr>
                                        <td width="30%"><b align="right">Invested Amount:</b></td>
                                        <td><span id="xxxxxx"><?php
                                                if (isset($data['Investment']['investment_amount'])) {
                                                    echo $data['Investment']['investment_amount'];
                                                }
                                                ?></span></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><b align="right">Benchmark Rate(%):</b></td>
                                        <td><span id="xxxxxx"><?php
                                                if (isset($data['Investment']['custom_rate'])) {
                                                    echo $data['Investment']['custom_rate'] . '%';
                                                }
                                                ?></span></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><b align="right">Due Date:</b></td>
                                        <td><span id="xxxxxx"><?php
                                                if (isset($data['Investment']['due_date'])) {
                                                    echo $data['Investment']['due_date'];
                                                }
                                                ?></span></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><b align="right">Amount Due:</b></td>
                                        <td><span id="xxxxxx"><?php
                                                if (isset($data['Investment']['amount_due'])) {
                                                    echo number_format($data['Investment']['amount_due'],2);
                                                }
                                                ?></span></td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><b align="right">&nbsp;</b></td>
                                        <td><span id="xxxxxx">&nbsp;</span></td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
<!--                        <tr>
                            <td colspan="2">
                                &nbsp;
                            </td>

                        </tr>-->
                </td>
            </tr>
<!--            <tr>
                <td colspan="3" align="left" valign="top" style="border-bottom: solid 3px #ffffff;">&nbsp;</td>
            </tr>-->
            <tr>
                <td align="left" valign="top" colspan="3">

                    <!-- Step Investment Details Start -->
                            <?php
                            echo $this->Form->create('Investment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'process_rollover'), "inputDefaults" => array('div' => false)));
                            ?>
                    <div class="row" style="background: #99ccff;">
                        <div class="col-lg-6 col-md-6 col-sm-12"> 
                            <?php
                            echo $this->Form->hidden('id', array('value' => $data['Investment']['id']));
                            echo $this->Form->hidden('user_id', array('value' => ($this->Session->check('userDetails.id') == true ? $this->Session->read('userDetails.id') : '' )));
                            echo $this->Form->hidden('investor_type_id', array('value' => 2));
                            echo $this->Form->hidden('investor_page', array('value' => 'rollover'));
                            echo $this->Form->hidden('investor_id', array('value' => (isset($data['Investment']['investor_id']) ? $data['Investment']['investor_id'] : '')));
//                            echo $this->Form->hidden('investmentproduct_id', array('empty' => "--Please Select--",
//                                'selected' => ($data['Investment']['investment_product_id'] ? $data['Investment']['investment_product_id'] : '' ), 'style' => 'background: lilac;'));
                            
                            echo $this->Form->input('investmentproduct_id', array('disabled', 'label' => 'Investment Product', 'empty' => "--Please Select--",
                                'selected' => ($data['Investment']['investment_product_id'] ? $data['Investment']['investment_product_id'] : '' ), 'style' => 'background: lilac;'));
                            ?>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>Investment Date</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <?php
                                if ($this->Session->check('rollovertemp.investment_date') == true) {

                                    $dob_string = $this->Session->read('rollovertemp.investment_date');
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
<?php echo $this->Form->day('investment_date', array("selected" => $day)); ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
<?php echo $this->Form->month('investment_date', array("selected" => $month)); ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
<?php echo $this->Form->year('investment_date', 1950, date('Y'), array("selected" => $Year)); ?>
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

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?php
                            echo $this->Form->input('paymentschedule_id', array('label' => 'Payment Schedule',
                                'empty' => "--Please Select--",
                                'value' => ($this->Session->check('rollovertemp.paymentschedule_id') == true ? $this->Session->read('rollovertemp.paymentschedule_id') : $data['Investment']['payment_schedule_id'] )));
                            echo $this->Form->input('paymentmode_id', array('label' => 'Payment Mode',
                                'empty' => "--Please Select--",
                                'value' => ($this->Session->check('rollovertemp.paymentmode_id') == true ? $this->Session->read('rollovertemp.paymentmode_id') : $data['Investment']['payment_mode_id'] )));
                            ?>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12"> 

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <?php
                                echo $this->Form->input('management_fee_type', ['label' => 'Fee Type','type' => 'select', 'options' =>
                                    array('No Fee' => 'No Fee', 'Management Fee' => 'Management Fee', 'Performance Fee' => 'Performance Fee',
                                        'Management & Performance Fee' => 'Management & Performance Fee'),
                                    'empty' => '--Select Fee Type--', 'selected' =>
                                    ($this->Session->check('rollovertemp.management_fee_type') == true ?
                                            $this->Session->read('rollovertemp.management_fee_type') : $data['Investment']['management_fee_type']  )]);
                                ?>
                            </div> 

                            <div class="col-lg-4 col-md-4 col-sm-12 hidden-fee">
                                <?php
                                echo $this->Form->input('base_fees', array('label' => 'Base Fee(%)', 'class' => 'required', 'value' =>
                                    ($this->Session->check('rollovertemp.base_fees') == true ?
                                            $this->Session->read('rollovertemp.base_fees') : $data['Investment']['base_rate']  )));
                                ?> 
                            </div>  
                            <div class="col-lg-4 col-md-4 col-sm-12 BenchmarkRate">
                                <?php
                                echo $this->Form->input('benchmark_rate', array('label' => 'Benchmark(%)', 'value' =>
                                    ($this->Session->check('rollovertemp.benchmark_rate') == true ?
                                            $this->Session->read('rollovertemp.benchmark_rate') : $data['Investment']['benchmark_rate'] )));
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php
//                            echo $this->Form->input('currency_id', array('type' => 'select', 'options' => $currencies, 
//                                'empty' => '--Please select currency--', 'selected' => ($this->Session->check('rollovertemp.currency_id') == true ? $this->Session->read('rollovertemp.currency_id') : $data['Investment']['currency_id'] )));
                            echo $this->Form->input('currencyid', array('value' => 1, 'disabled', 'type' => 'select', 'options' => $currencies, 'empty' => '--Please select currency--', 'selected' => ($this->Session->check('rollovertemp.currency_id') == true ? $this->Session->read('rollovertemp.currency_id') : $data['Investment']['currency_id'] )));
                                    echo $this->Form->hidden('currency_id', array('default' => 1, 'value' => isset($currencies['id']) ? $currencies['id'] : 1));
                            ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <?php
                                echo $this->Form->input('cash_athand2', array('label' => 'Available Cash', 'disabled',
                                    'value' => ($this->Session->check('rollovertemp.cash_athand') == true ?
                                            $this->Session->read('rollovertemp.cash_athand') : $ledger_data['ClientLedger']['available_cash'])));
                                
                                echo $this->Form->hidden('cash_athand', array('label' => 'Available Cash', 
                                    'value' => ($this->Session->check('rollovertemp.cash_athand') == true ?
                                            $this->Session->read('rollovertemp.cash_athand') : $ledger_data['ClientLedger']['available_cash'])));
                                
                                 echo $this->Form->hidden('cash_athand', array('label' => 'Available Cash', 
                                    'value' => ($this->Session->check('rollovertemp.cash_athand') == true ?
                                            $this->Session->read('rollovertemp.cash_athand') : $ledger_data['ClientLedger']['available_cash'])));
                                ?>  
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <?php
                                echo $this->Form->hidden('total_invested', array('label' => 'Total Invested', 'value' =>
                                    ($this->Session->check('rollovertemp.total_invested') == true ?
                                            $this->Session->read('rollovertemp.total_invested') : $ledger_data['ClientLedger']['invested_amount'])));

                                echo $this->Form->input('total_invested2', array('disabled', 'label' => 'Total Invested', 'value' =>
                                    ($this->Session->check('rollovertemp.total_invested') == true ?
                                            $this->Session->read('rollovertemp.total_invested') :$ledger_data['ClientLedger']['invested_amount'] )));
                                ?>
                            </div>
                         
                        </div>
                    </div>
                    <!--</div>-->


                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12" id="fixed">
                            <!--<p style="font-size: 18px; font-weight: bold; color: dodgerblue; margin-top: 20px;">Fixed Investment</p>-->
                            <div class="row">

                             <div class="col-lg-6 col-md-6 col-sm-12" >
                            <?php
                            echo $this->Form->input('instruction_id', array('label' => 'Instructions',
                                'empty' => "--Please Select--",
                                'selected' => ($this->Session->check('rollovertemp.instruction_id') == true ? $this->Session->read('rollovertemp.instruction_id') :
                                        $data['Investment']['instruction_id'] )));
                            ?>
                                 </div>
                                <div class="col-lg-6 col-md-6 col-sm-12" >
                                    <?php
                            echo $this->Form->input('instruction_details', array('label' =>
                                'Other Instruction Details', 'placeholder' =>
                                "Complete this ONLY if 'Other' is selected", 'value'
                                => ($this->Session->check('rollovertemp.instruction_details') ==
                                true ? $this->Session->read('rollovertemp.instruction_details') :
                                        $data['Investment']['instruction_details'])));
                            ?>

                                     </div>
                            </div>
                            <div class="row">
                                  <div class="col-lg-6 col-md-6 col-sm-12">
                                    <?php
                                    echo $this->Form->input('investment_amount', array('label' => 'Investment Amount', 'class' => 'required',
                                        'value' => ($this->Session->check('rollovertemp.investment_amount') == true ? $this->Session->read('rollovertemp.investment_amount') : '' )));
                                    ?>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <?php
                                    echo $this->Form->input('custom_rate', array('required', 'label' =>
                                        'Benchmark(%)*', 'value' => ($this->Session->check('rollovertemp.custom_rate') == true ? $this->Session->read('rollovertemp.custom_rate') : $data['Investment']['custom_rate'] )));
                                    ?>

                                </div>
                                </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('duration', array('required', 'label' => 'Inv. Duration*',
                                        'value' => ($this->Session->check('rollovertemp.duration') == true ?
                                                $this->Session->read('rollovertemp.duration') : $data['Investment']['duration'] ), 'width' => '50px'));
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">   <?php
                                   
                                     echo $this->Form->input('investment_period', array('required', 'label' => 'Inv. Period*', 'empty' => "--Select--",
                                        'options' => array('Day(s)' => 'Day(s)', 'Year(s)' => 'Year(s)'),'value' => ($this->Session->check('rollovertemp.investment_period') == true ?
                                                $this->Session->read('rollovertemp.investment_period') : $data['Investment']['investment_period'] )
                                        ));
                                    ?>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php echo $this->Form->input('total_tenure', array('required','label' =>
                                'Total Tenure', 'placeholder' => "0", 'value' => 
                                    ($this->Session->check('rollovertemp.total_tenure') == true ? 
                                    $this->Session->read('rollovertemp.total_tenure') : $data['Investment']['total_tenure'] ))); ?>

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
                                    echo "<span style='font-weight: bold; font-size: 11px; color: red;'>Expected Interest :</span><br>";
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
                                        echo $shopCurrency . ' ' . number_format($totaldue, 2, '.', ',');;
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
                    <?php echo $this->Html->link('Back', "/Investments/maturityList", array("class" => 'btn btn-lg btn-info')); ?>

                    &nbsp;&nbsp;
<?php echo $this->Html->link('Next', "/Investments/newInvestmentCert", 
                             array("class" => 'btn btn-lg btn-primary',
                                 'confirm' => 'Are you sure you wish to rollover this investment?')
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
<?php echo $this->element('footer'); ?>
    
    
    <?php
    $this->Session->delete('investtemp1');
    ?>
    <script lang="javascript">
        jQuery(document).ready(function ($) {
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

            $("#InvestmentInvestmentproductId").change(function () {


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
              //hide benchmark if management fee is chosen
            $("#InvestmentManagementFeeType").change(function () {
                var fee_type = $(this).val();
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
            });
            jQuery("#InvestmentEquitiesListId").change(function () {

                var equity_id = jQuery(this).val();
                if (equity_id == "") {

                    jQuery('#InvestmentSharePrice').val("");
                    jQuery('#InvestmentPurchasePrice').val("");
                }
                if (equity_id != "") {
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