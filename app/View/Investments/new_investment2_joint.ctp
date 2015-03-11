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
                                <b>Name</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue" align="left">
                                <b>Joint Acc Name</b>
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
                        if (isset($investors)) {
                            foreach ($investors as $investor):
                                ?>
                                <tr>
                                    <td align="left">
                                        <?php
                                        if (isset($investor['investor_id'])) {
                                            echo $investor['investor_id'];
                                        } else {
                                            echo '';
                                        }
                                        ?>
                                    </td>
                                    <td align="left">
                                        <?php
                                        if (isset($investor['surname']) && isset($investor['other_names'])) {
                                            echo $investor['surname'].' '.$investor['other_names'];
                                        } else {
                                            echo '';
                                        }
                                        ?>
                                    </td>
                                    <td align="left">
                                        <?php
                                        if (isset($investor['joint_surname']) && isset($investor['joint_other_names'])) {
                                            echo $investor['joint_surname'].' '.$investor['joint_other_names'];
                                        } else {
                                            echo '';
                                        }
                                        ?>
                                    </td>
                                    <td align="left">
                                        <?php
                                        if (isset($investor['in_trust_for'])) {
                                            echo $investor['in_trust_for'];
                                        } else {
                                            echo '';
                                        }
                                        ?>
                                    </td>
                                    <td align="left">
                                        <?php
                                        if (isset($investor['phone'])) {
                                            echo $investor['phone'];
                                        } else {
                                            echo '';
                                        }
                                        ?>
                                    </td>
                                    <td align="left">
                                        <?php
                                        if (isset($investor['email'])) {
                                            echo $investor['email'];
                                        } else {
                                            echo '';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        }
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
                    echo $this->Form->create('Investment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'process_indv'), "inputDefaults" => array('div' => false)));
                    ?>
                    <div class="row" style="background: #99ccff;">
                        <div class="col-lg-6 col-md-6 col-sm-12">

                            <?php
                            echo $this->Form->hidden('user_id', array('value' => ($this->Session->check('userDetails.id') == true ? $this->Session->read('userDetails.id') : '' )));
                            echo $this->Form->hidden('investor_type_id', array('value' => 4));
                            echo $this->Form->hidden('investor_page', array('value' => 'newInvestment2_joint'));
                            echo $this->Form->hidden('investor_id', array('value' => (isset($investor['investor_id']) ? $investor['investor_id'] : '')));

                            echo $this->Form->input('investmentproduct_id', array('label' => 'Investment Product', 'empty' => "--Please Select--", 'selected' => ($this->Session->check('investtemp.investmentproduct_id') == true ? $this->Session->read('investtemp.investmentproduct_id') : '' ), 'style' => 'background: lilac;'));

                            echo $this->Form->input('currency_id', array('type' => 'select', 'options' => $currencies, 'empty' => '--Please select currency--', 'selected' => ($this->Session->check('investtemp1.currency_id') == true ? $this->Session->read('investtemp1.currency_id') : '' )));
                            ?>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?php
                            echo $this->Form->input('paymentschedule_id', array('label' => 'Payment Schedule', 'empty' => "--Please Select--", 'value' => ($this->Session->check('investtemp1.paymentschedule_id') == true ? $this->Session->read('investtemp1.paymentschedule_id') : '' )));
                            echo $this->Form->input('paymentmode_id', array('label' => 'Payment Mode', 'empty' => "--Please Select--", 'value' => ($this->Session->check('investtemp1.paymentmode_id') == true ? $this->Session->read('investtemp1.paymentmode_id') : '' )));
                            ?>
                        </div>
                          <div class="col-lg-6 col-md-6 col-sm-12"> 
                            
                               <div class="col-lg-5 col-md-5 col-sm-12">
                                       <?php
                             echo $this->Form->input('management_fee_type', ['type' => 'select', 'options' => 
                                 array('No Fee' => 'No Fee','Management Fee' =>'Management Fee','Performance Fee' => 'Performance Fee',
                                     'Management & Performance Fee' => 'Management & Performance Fee'),
                                 'empty' => '--Select Fee Type--', 'selected' => 
                                       ($this->Session->check('investtemp1.management_fee') == true ?
                                       $this->Session->read('investtemp1.management_fee') : '' )]);
                             
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
                           echo $this->Form->input('benchmark_rate', array( 'label' => 'Benchmark Rate(%)', 'value' => 
                                       ($this->Session->check('investtemp1.benchmark_rate') == true ?
                                       $this->Session->read('investtemp1.benchmark_rate') : '' )));
                             ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12"> 
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
                    </div>


                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-12" id="fixed">
                            <p style="font-size: 18px; font-weight: bold; color: dodgerblue; margin-top: 20px;">Fixed Investment</p>
                            <?php
                            echo $this->Form->input('instruction_id', array('label' => 'Instructions', 'empty' => "--Please Select--", 'selected' => ($this->Session->check('investtemp.instruction_id') == true ? $this->Session->read('investtemp.instruction_id') : '' )));
                            echo $this->Form->input('instruction_details', array('label' => 'Other Instruction Details', 'placeholder' => "Complete this ONLY if 'Other' is selected", 'value' => ($this->Session->check('investtemp.instruction_details') == true ? $this->Session->read('investtemp.instruction_details') : '' )));
                            ?>


                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo $this->Form->input('investment_amount', array('label' => 'Investment Amount', 'class' => 'required', 'value' => ($this->Session->check('investtemp.investment_amount') == true ? $this->Session->read('investtemp.investment_amount') : '' ))); ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo $this->Form->input('investmentterm_id', array('label' => 'Investment Term', 'empty' => "--Please Select--", 'value' => ($this->Session->check('investtemp.investmentterm_id') == true ? $this->Session->read('investtemp.investmentterm_id') : '' ))); ?>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php // echo $this->Form->input('inv_freq', array('label' => 'Frequency', 'value' => (isset($investor['Investor']['inv_freq']) ? $investor['Investor']['inv_freq'] : '' )));    ?>
                                    <?php echo $this->Form->input('custom_rate', array('label' => 'Expected Interest', 'value' => ($this->Session->check('investtemp.custom_rate') == true ? $this->Session->read('investtemp.custom_rate') : '' ))); ?>

                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php // echo $this->Form->input('currency_id', array('label' => 'Currency', 'empty' => "--Please Select a Currency--", 'value' => ($this->Session->check('investtemp.currency_id') == true ? $this->Session->read('investtemp.currency_id') : '' )));  ?>
                                    <?php // echo $this->Form->input('currency_id', array('label' => 'Currency', 'empty' => "--Please Select Currency--", 'value' => ($this->Session->check('investtemp.currency_id') == true ? $this->Session->read('investtemp.currency_id') : '' ))); ?>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php // echo $this->Form->input('paymentschedule_id', array('label' => 'Payment Schedule', 'empty' => "--Please Select--", 'value' => ($this->Session->check('investtemp.paymentschedule_id') == true ? $this->Session->read('investtemp.paymentschedule_id') : '' )));  ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php // echo $this->Form->input('paymentmode_id', array('label' => 'Payment Mode', 'empty' => "--Please Select--", 'value' => ($this->Session->check('investtemp.paymentmode_id') == true ? $this->Session->read('investtemp.paymentmode_id') : '' )));  ?>
                                </div>
                            </div>

                            <!--                            <div class="row"> 
                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php
//                                    if ($this->Session->check('investtemp.investment_date') == true) {
//
//                                        $dob_string = $this->Session->read('investtemp.investment_date');
//                                        $month = date('m', strtotime($dob_string));
//                                        $day = date('d', strtotime($dob_string));
//                                        $Year = date('Y', strtotime($dob_string));
//                                    } else {
//
//                                        $month = date('m');
//                                        $day = date('d');
//                                        $Year = date('Y');
//                                    }
                            ?>
                                                                <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                                                                <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                                                                <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                            <?php // echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>Inv. Date*:</span>" . $this->Form->day('investment_date', array("selected" => $day));  ?>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php // echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->month('investment_date', array("selected" => $month));  ?>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php // echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->year('investment_date', 1950, date('Y'), array("selected" => $Year));  ?>
                                                            </div>
                                                            <script>
                                                                var day = $("#day").val();
                                                                var month = $("#month").val();
                                                                var year = $("#year").val();
                                                                $("#InvestmentInvestmentDateDay option[value=" + day + "]").attr('selected', true);
                                                                $("#InvestmentInvestmentDateMonth option[value=" + month + "]").attr('selected', true);
                                                                $("#InvestmentInvestmentDateYear option[value=" + year + "]").attr('selected', true);
                                                            </script>
                            
                                                        </div>-->
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
//                            echo $this->Form->input('instruction_id', array('label' => 'Instructions','name' => 'instruction_id2', 'empty' => "--Please Select--", 'selected' => ($this->Session->check('investtemp.instruction_id2') == true ? $this->Session->read('investtemp.instruction_id2') : '' )));
//                            echo $this->Form->input('instruction_details', array('label' => 'Other Instruction Details','name' => 'instruction_details2', 'placeholder' => "Complete this ONLY if 'Other' is selected", 'value' => ($this->Session->check('investtemp.instruction_details2') == true ? $this->Session->read('investtemp.instruction_details2') : '' )));
                            ?>
                            <!--                            <div class="row"> 
                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php
//                                    if ($this->Session->check('investtemp.purchase_date') == true) {
//
//                                        $dob_string = $this->Session->read('investtemp.purchase_date');
//                                       
//                                        $month = date('m', strtotime($dob_string));
//                                        $day = date('d', strtotime($dob_string));
//                                        $Year = date('Y', strtotime($dob_string));
//                                    } else {
//
//                                        $month = date('m');
//                                        $day = date('d');
//                                        $Year = date('Y');
//                                    }
                            ?>
                                                                <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                                                                <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                                                                <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                            <?php // echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>Pur. Date*:</span>" . $this->Form->day('purchase_date', array("selected" => $day));  ?>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php // echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->month('purchase_date', array("selected" => $month));  ?>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php // echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->year('purchase_date', 1950, date('Y'), array("selected" => $Year));  ?>
                                                            </div>
                                                            <script>
                                                                var day = $("#day").val();
                                                                var month = $("#month").val();
                                                                var year = $("#year").val();
                                                                $("#InvestmentPurchaseDateDay option[value=" + day + "]").attr('selected', true);
                                                                $("#InvestmentPurchaseDateMonth option[value=" + month + "]").attr('selected', true);
                                                                $("#InvestmentPurchaseDateYear option[value=" + year + "]").attr('selected', true);
                                                            </script>
                            
                                                        </div>-->
                            <div class="row"> 
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
//                                    echo $this->Form->input('currency_id', array('label' => 'Currency','name' => 'currency2', 'empty' => "--Please Select a Currency--", 'value' => ($this->Session->check('investtemp.currency2') == true ? $this->Session->read('investtemp.currency2') : '' ))); 
//                                    echo $this->Form->input('currency_id', array('type' => 'select', 'options' => $currencies, 'empty' => '--Please select currency--',));
                                    ?>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php // echo $this->Form->input('paymentschedule_id', array('label' => 'Payment Schedule','name' => 'paymentschedule_id2', 'empty' => "--Please Select--", 'value' => ($this->Session->check('investtemp.paymentschedule_id2') == true ? $this->Session->read('investtemp.paymentschedule_id2') : '' )));  ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php // echo $this->Form->input('paymentmode_id', array('label' => 'Payment Mode','name' => 'paymentmode_id2', 'empty' => "--Please Select--", 'value' => ($this->Session->check('investtemp.paymentmode_id2') == true ? $this->Session->read('investtemp.paymentmode_id2') : '' )));  ?>
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
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('numb_shares', array('label' => 'No. of Shares*', 'class' => 'required', 'value' => ($this->Session->check('investtemp.numb_shares') == true ? $this->Session->read('investtemp.numb_shares') : '' )));
                                    ?>
                                </div>
                               <div class="col-lg-4 col-md-4 col-sm-6">
                                    <?php
                                    echo $this->Form->input('min_share_price', array('label' => 'Min Price', 'class' => 'required', 'value' => ($this->Session->check('investtemp.min_share_price') == true ? $this->Session->read('investtemp.min_share_price') : '' )));
                                   ?>
                                </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                    <?php
                                    echo $this->Form->input('max_share_price', array('label' => 'Max Price', 'class' => 'required', 'value' => ($this->Session->check('investtemp.max_share_price') == true ? $this->Session->read('investtemp.max_share_price') : '' )));
                                    ?>
                                </div>
                            </div>
                            <p>&nbsp;</p><p>&nbsp;</p>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <?php echo $this->Form->button('Process', array("type" => "submit", "class" => "btn btn-lg btn-success", 'name' => "equity_process")); ?>
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

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo "<span style='font-weight: bold; font-size: 11px; color: red;'>Equity:</span><br>";
                                    if (isset($equity)) {
                                        echo $equity;
                                    } else {
                                        echo '';
                                    }
                                    ?>

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo "<span style='font-weight: bold; font-size: 11px; color: red;'>Share Price:</span><br>";
                                    if (isset($share_price)) {
                                        echo $shopCurrency . ' ' . number_format($share_price, 2, '.', ',');
                                    } else {
                                        echo '';
                                    }
                                    ?>

                                </div>
                             
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo "<span style='font-weight: bold; font-size: 11px; color: red;'>Expected Amt Due:</span>";
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
                    <?php echo $this->Html->link('Next', "/Investments/newInvestmentCert", array("class" => 'btn btn-lg btn-primary')); ?>
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
        $this->Session->delete('investtemp1');
    ?>
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
    //hide benchmark if management fee is chosen
            $("#InvestmentManagementFeeType").change(function () {
                var fee_type = $(this).val();
                $(".BenchmarkRate").show();
                 $(".hidden-fee").show();
                if(fee_type == "Performance Fee"){
                    $(".hidden-fee").hide();
                    return false;
                }
                if(fee_type =="Management Fee"){
                    $(".BenchmarkRate").hide();
                    return false;
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