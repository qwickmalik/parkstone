<?php
echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js');
if ($this->Session->check('shopCurrency')) {
    $shopCurrency = $this->Session->read('shopCurrency');
} else {
    $shopCurrency = "";
}
$total_interest = 0;
$total_pi = 0;
$total_payments=0;
$due_total = 0;
$total_expectedi = 0;
?>

<h3>Reports: Outbound Aggregate Investment Report</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <?php echo $this->Form->create('Investment', array('url' => array('controller' => 'Reports', 'action' => 'aggregateOutboundInvestment'))); ?>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <p style="font-weight: bold; padding: 10px 0px 0px 0px;">From</p>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <?php
                    $month = date('m');
                    $day = date('d');
                    $Year = date('Y');
                    ?>
                    <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                    <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                    <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                    <?php echo $this->Form->day('begin_date', array("selected" => $day)); ?>&nbsp;
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->month('begin_date', array("selected" => $month)); ?>&nbsp;
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->year('begin_date',date('Y') - 10, date('Y') + 10, array("selected" => $Year)); ?>
                </div>
                <script>
                    var day = $("#day").val();
                    var month = $("#month").val();
                    var year = $("#year").val();
                    $("#InvestmentBeginDateDay option[value=" + day + "]").attr('selected', true);
                    $("#InvestmentBeginDateMonth option[value=" + month + "]").attr('selected', true);
                    $("#InvestmentBeginDateYear option[value=" + year + "]").attr('selected', true);
                </script>

            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <p style="font-weight: bold; padding: 10px 0px 0px 0px;">To</p>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <?php
                    $month = date('m');
                    $day = date('d');
                    $Year = date('Y');
                    ?>
                    <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                    <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                    <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                    <?php echo $this->Form->day('finish_date', array("selected" => $day)); ?>&nbsp;
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->month('finish_date', array("selected" => $month)); ?>&nbsp;
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->year('finish_date', date('Y') - 10, date('Y') + 10, array("selected" => $Year)); ?>
                </div>
                <script>
                    var day = $("#day").val();
                    var month = $("#month").val();
                    var year = $("#year").val();
                    $("#InvestmentFinishDateDay option[value=" + day + "]").attr('selected', true);
                    $("#InvestmentFinishDateMonth option[value=" + month + "]").attr('selected', true);
                    $("#InvestmentFinishDateYear option[value=" + year + "]").attr('selected', true);
                </script>
                <?php
                echo $this->Form->button('Find', array('type' => 'submit', 'class' => 'btn btn-lg btn-success', 'style' => 'float: right;'));
                ?>

            </div>

            <?php echo $this->Form->end(); ?>
            <p style="clear: both; width: 100%; margin-bottom: 20px; border-bottom: solid 2px dodgerblue;">&nbsp;</p>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
                <?php
//                echo $this->Element('logo_reports');
//                echo "<H3><b>PARKSTONE CAPITAL LIMITED</b></H3>";
//                $postaladd = 'Postal Address: ';
//
//                if ($this->Session->check('shopAddress')) {
//                    $shopAddress = $this->Session->read('shopAddress');
//                    $postaladd .=$shopAddress;
//                    if ($this->Session->check('shopPosttown')) {
//                        $shopPosttown = $this->Session->read('shopPosttown');
//
//                        // $postaladd .= ', '.$shopPosttown;
//                    }
//                    if ($this->Session->check('shopPostCity')) {
//                        $shopPostCity = $this->Session->read('shopPostCity');
//                        $postaladd .= ', ' . $shopPostCity;
//                    }
//                    if ($this->Session->check('shopPostCount')) {
//                        $shopPostCount = $this->Session->read('shopPostCount');
//                        $postaladd .= ', ' . $shopPostCount;
//                    }
//                    echo "<p>" . $postaladd . "</p>";
//                }
//
//                echo "<p><b>AGGREGATE INVESTMENT REPORT</b></p>";
                ?>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        &nbsp;
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php
                        echo $this->Html->image('parkstone_logo2.png', array('style' => 'float: left; margin-right: 20px;', 'width' => 120, 'alt' => $this->Session->read('shopName')));
                        ?>
                        <p style='font-weight: bold; font-size: 14px; text-align: left;'>
                            <?php
                            echo $this->Session->read('shopName') . '<br />';
                            echo 'AGGREGATE INVESTMENT REPORT'
                            ?></p>
                        <p align='left'>Generated on <?php echo date('jS F, Y'); ?></p>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <p align="right"><?php echo $this->Session->read('shopAddress') . ', ' . $this->Session->read('shopPosttown') . '<br />' . $this->Session->read('shopPostCity') . ', ' . $this->Session->read('shopPostCount') . '<br />' . $this->Session->read('shopTelephone') . '<br />' . $this->Session->read('shopEmail'); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 inner_print">
                <table border="1" cellspacing="" cellpadding="3" width="100%" align="left" style="border: solid 2px gray;">
                    <tr>
                        <td align="left" valign="top" width="250" style="border-bottom: solid 2px Gray;"><b>Inv. Destination</b></td>

                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Investment Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Amount Inv.</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Rate</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Maturity Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Interest Due on Maturity</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Total Due on Maturity</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Disinvestment Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Interest Due on Current Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Principal & Interest Due</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Payment</b></td>
                    </tr>

                    <?php
                    if (isset($accounts)) {

                        foreach ($accounts as $each_item):
                            ?>
                            <tr>

                                <td align="left" valign="top"><?php
                                    if (isset($each_item['InvestmentDestination']['company_name'])) {
                                        echo $each_item['InvestmentDestination']['company_name'];
                                    }
                                     if (isset($each_item['InvDestProduct']['inv_dest_product'])) {
                                         
                                        echo " - (". $each_item['InvDestProduct']['inv_dest_product'].")";
                                    }
                                    ?></td>
                                <td align="right" valign="top"><?php
                                    if (isset($each_item['Reinvestment']['investment_date'])) {
                                        echo date('d-M-Y', strtotime($each_item['Reinvestment']['investment_date']));
                                    }
                                    ?></td>
                                <td align="right" valign="top"><?php
                                    if (isset($each_item['Reinvestment']['investment_amount'])) {
                                        echo number_format($each_item['Reinvestment']['investment_amount'], 2);
                                    }
                                    ?></td>
                                <td align="right" valign="top"><?php
                                    if (isset($each_item['Reinvestment']['interest_rate'])) {
                                        echo $each_item['Reinvestment']['interest_rate'] . '%';
                                    }
                                    ?></td>
                                <td align="right" valign="top"><?php
                                    if (isset($each_item['Reinvestment']['due_date'])) {
                                        echo date('d-M-Y', strtotime($each_item['Reinvestment']['due_date']));
                                    }
                                    ?></td>
                                <td align="right" valign="top"><?php
                                    if (isset($each_item['Reinvestment']['expected_interest'])) {
                                        $total_expectedi += $each_item['Reinvestment']['expected_interest'];
                                        echo number_format($each_item['Reinvestment']['expected_interest'], 2);
                                    }
                                    ?></td>
                                <td align="right" valign="top"><?php
                                    if (isset($each_item['Reinvestment']['amount_due'])
                                    ) {
                                        $totals_due = $each_item['Reinvestment']['amount_due'];
                                        $due_total += $totals_due;
                                        echo number_format($totals_due, 2);
                                    }
                                    ?></td>
                                <td align="right" valign="top"><?php
                                    //check investment_payments table: where event_type = terminated
//                                    echo date('d-M-Y');
                                if (isset($each_item['InvestmentReturn']['date']) && isset($each_item['InvestmentReturn']['return_type'])) {
                                    if ($each_item['InvestmentReturn']['return_type'] == 'Termination'){
                                        echo date('d-M-Y',$each_item['InvestmentPayment']['date']);
                                    }else{
                                        echo "";
                                    }
                                    
                                    }
                                    ?></td>
                                <td align="right" valign="top"><?php
                                    if (isset($each_item['Reinvestment']['interest_earned'])) {
//                                        echo number_format($each_item['Investment']['interest_accrued'], 2);
                                        $id = $each_item['Reinvestment']['id'];
                               $interest_accrued = $each_item['Reinvestment']['interest_earned']; //$this->requestAction('/Reinvestments/get_accruedinterest/'.$id);
                               
                      $total_interest += $interest_accrued;

            echo  number_format($interest_accrued,2);
                                    }
                                    ?></td>
                                <td align="right" valign="top"><?php
//                                    if (isset($each_item['Investment']['interest_accrued']) && isset($each_item['Investment']['investment_amount'])) {
//                                        $totals = $each_item['Investment']['interest_accrued'] + $each_item['Investment']['investment_amount'];
//                                    }
                                if (isset($each_item['Reinvestment']['id']) && isset($each_item['Reinvestment']['investment_amount'])) {
                                 $id = $each_item['Reinvestment']['id'];
                               $interest_accrued_calc = $each_item['Reinvestment']['interest_earned']; ////$this->requestAction('/Reinvestments/get_accruedinterest/'.$id);
                                
                                $totals_ia = $interest_accrued_calc + $each_item['Reinvestment']['investment_amount'];
                                $total_pi += $totals_ia;
            echo number_format($totals_ia,2);
            
                        }
                                    ?></td>
                                <td align="right" valign="top"><?php 
                                 if (!empty($each_item['InvestmentReturn'])) {
                                     $returns = 0;
                                     foreach($each_item['InvestmentReturn'] as $val){
                                    if ($val['return_type'] == 'Terminated' || $val['return_type'] == 'Matured'){
                                        $total_payments += $val['returns'];
                                        
                                        $returns += $val['returns'];
                                    }
                                     }
                                     echo number_format($returns,2);
                                    }
                                ?></td>
                            </tr>

                            <?php
                        endforeach;
                    }
                    ?>
<?php if (isset($total)) {
            foreach($total as $each_item):
                ?>
                    <tr>
                        <td align="left" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">Total(<?php echo $shopCurrency; ?>)</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                         <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">   <?php   if (isset($each_item[0]['principal'])) {
                    echo number_format($each_item[0]['principal'], 2);
                }
                ?></td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;
                      </td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">
                                         <?php   if (isset($total_expectedi)) {
                    echo  number_format($total_expectedi,2);
                }
                ?>
                        </td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">
                                    <?php   if (isset($due_total)) {
                    echo  number_format($due_total,2);
                }
                ?>
                        </td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                        
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">
                                <?php   if (isset($total_interest)) {
                    echo  number_format($total_interest,2);
                }
                ?></td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">
                                <?php   if (isset($total_pi)) {
                    echo number_format($total_pi, 2);
                }
                ?></td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">
                         <?php   if (isset($total_payments)) {
                    echo number_format($total_payments, 2);
                }
                ?>
                        </td>
                       
                    </tr>
                        <?php endforeach;
                }
                ?>
                </table>
            </div>
            <?php
            echo "<p>&nbsp;</p>";
            echo $this->Html->link('Print', "javascript:void(0)", array('style' => 'float: right;', "class" => 'btn btn-lg btn-warning', "id" => "print_receipt"));
            echo $this->Html->link('Return', "/Reports/", array('style' => 'float: right;', 'class' => 'btn btn-lg btn-info'));
            ?>
        </div>
    </div>
    <!-- Content end here -->
    <?php echo $this->element('footer'); ?>
