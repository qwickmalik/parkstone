<?php echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js'); ?>

<h3>Reports: Rollover/Disinvestments Report</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <?php echo $this->Form->create('RolloverDisinv', array('url' => array('controller' => 'Reports', 'action' => 'rolloverDisinv'))); ?>
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
               
                <p style="font-weight: bold; padding: 10px 0px 0px 15px;">From</p>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <?php
                    $month = date('m');
                    $day = date('d');
                    $Year = date('Y');
                    ?>
                    <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                    <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                    <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                    <?php echo $this->Form->day('from_date', array("selected" => $day)); ?>&nbsp;
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->month('from_date', array("selected" => $month)); ?>&nbsp;
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->year('from_date', 2003, date('Y'), array("selected" => $Year)); ?>
                </div>
                <script>
                    var day = $("#day").val();
                    var month = $("#month").val();
                    var year = $("#year").val();
                    $("#RolloverDisinvFromDateDay option[value=" + day + "]").attr('selected', true);
                    $("#RolloverDisinvFromDateMonth option[value=" + month + "]").attr('selected', true);
                    $("#RolloverDisinvFromDateYear option[value=" + year + "]").attr('selected', true);
                </script>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <p style="font-weight: bold; padding: 10px 0px 0px 15px;">To</p>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <?php
                    $month = date('m');
                    $day = date('d');
                    $Year = date('Y');
                    ?>
                    <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                    <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                    <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                    <?php echo $this->Form->day('to_date', array("selected" => $day)); ?>&nbsp;
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->month('to_date', array("selected" => $month)); ?>&nbsp;
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->year('to_date', 2003, date('Y'), array("selected" => $Year)); ?>
                </div>
                <script>
                    var day = $("#day").val();
                    var month = $("#month").val();
                    var year = $("#year").val();
                    $("#RolloverDisinvToDateDay option[value=" + day + "]").attr('selected', true);
                    $("#RolloverDisinvToDateMonth option[value=" + month + "]").attr('selected', true);
                    $("#RolloverDisinvToDateYear option[value=" + year + "]").attr('selected', true);
                </script>
                <?php
                echo $this->Form->button('Find', array('type' => 'submit', 'class' => 'btn btn-lg btn-success', 'style' => 'float: right;'));
                ?>

            </div>
            
            <?php echo $this->Form->end(); ?>
            <p style="clear: both; width: 100%; margin-bottom: 20px; border-bottom: solid 2px dodgerblue;">&nbsp;</p>
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        &nbsp;
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php 
                        echo $this->Html->image('parkstone_logo2.png', array('style' => 'float: left; margin-right: 20px;','width' => 120, 'alt' => $this->Session->read('shopName')));
                        ?>
                        <p style='font-weight: bold; font-size: 14px; text-align: left;'>
                            <?php 
                            echo $this->Session->read('shopName').'<br />'; 
                            echo 'ROLLOVER/DISINVESTMENTS REPORT'
                            ?></p>
                        <p align='left'>Generated on <?php echo date('jS F, Y'); ?></p>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <p align="right"><?php echo $this->Session->read('shopAddress') . ', ' . $this->Session->read('shopPosttown') . '<br />' . $this->Session->read('shopPostCity') . ', ' . $this->Session->read('shopPostCount') . '<br />' . $this->Session->read('shopTelephone') . '<br />' . $this->Session->read('shopEmail'); ?></p>
                    </div>
                </div>
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
//                echo "<p><b>ROLLOVER/DISINVESTMENTS REPORT</b></p>";
                ?>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table border="1" cellspacing="" cellpadding="3" width="100%" align="left" style="border: solid 2px gray;">
                    <tr>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Name</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Investment No.</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Investment Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Amount Invested</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Benchmark Rate</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Rollover/Disinv. Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Interest Due on Current Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Principal & Interest Due</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Payment</b></td>
                    </tr>
                    <?php if (isset($accounts)) {
                       
       foreach ($inv as $val):                  
//     print_r($accounts);exit;
    foreach ($accounts as $each_item):  
              if($val == $each_item['InvestmentPayment']['investor_id']){
            ?>
                    <tr>
                        <td align="left" valign="top" rowspan="8"><?php if (isset($each_item['Investor']['fullname'])) {
            echo  $each_item['Investor']['fullname'];
        } ?></td>
                        <td align="left" valign="top" style="background-color:Gray;"></td>
                        <td align="right" valign="top" style="background-color:Gray;"></td>
                        <td align="right" valign="top" style="background-color:Gray;"></td>
                        <td align="right" valign="top" style="background-color:Gray;"></td>
                        <td align="right" valign="top" style="background-color:Gray;"></td>
                        <td align="right" valign="top" style="background-color:Gray;"></td>
                        <td align="right" valign="top" style="background-color:Gray;"></td>
                        <td align="right" valign="top" style="background-color:Gray;"></td>
                    </tr>
                              <?php
                              break;
              }
    endforeach;
    foreach ($accounts as $each_item):  
        if($val == $each_item['InvestmentPayment']['investor_id']){
 ?>
                    <tr>
                        <td align="left" valign="top"><?php if (isset($each_item['Investment']['investment_no'])) {
            echo  $each_item['Investment']['investment_no'];
        } ?></td>
                        <td align="right" valign="top"><?php if (isset($each_item['Investment']['investment_date'])) {
            echo  date('d-m-Y',strtotime($each_item['Investment']['investment_date']));
        } ?></td>
                        <td align="right" valign="top"><?php if (isset($each_item['Investment']['investment_amount'])) {
            echo  number_format($each_item['Investment']['investment_amount'],2);
        } ?></td>
                        <td align="right" valign="top"><?php if (isset($each_item['Investment']['custom_rate'])) {
            echo  $each_item['Investment']['custom_rate'].'%';
        } ?></td>
                        <td align="right" valign="top"><?php if (isset($each_item['InvestmentPayment']['event_date'])) {
            echo  date('d-m-Y',strtotime($each_item['InvestmentPayment']['event_date']));
        } ?></td>
                        <td align="right" valign="top"><?php if (isset($each_item['Investment']['interest_accrued'])) {
            echo  number_format($each_item['Investment']['interest_accrued'],2);
        } ?></td>
                        <td align="right" valign="top"><?php if (isset($each_item['Investment']['interest_accrued']) && isset($each_item['Investment']['investment_amount'])) {
              $totals = $each_item['Investment']['interest_accrued'] + $each_item['Investment']['investment_amount'];
        
            echo number_format($totals,2);
            
                        } ?></td>
                        <td align="right" valign="top">&nbsp;</td>
                    </tr>
                    
     <?php
        }
    endforeach;
    
    ?>
     <tr>              
                        <td align="right" valign="top"></td>
                        <td align="right" valign="top"></td>
                        <td align="right" valign="top"></td>
                        <td align="right" valign="top"></td>
                        <td align="right" valign="top"></td>
                        <td align="right" valign="top"></td>
                        <td align="right" valign="top"><?php if (isset($total)) {
            foreach($total as $each_item):
                 if($val == $each_item['InvestmentPayment']['investor_id']){
                 if (isset($each_item[0]['totalamount'])) {
                    echo 'GH$ '.number_format($each_item[0]['totalamount'], 2);
                }
                 }
                        
            endforeach;
                        }
                ?></td>
                        <td align="right" valign="top"><?php if (isset($total_payment)) {
            foreach($total_payment as $each_item):
                 if($val == $each_item['InvestmentPayment']['investor_id']){
                 if (isset($each_item[0]['payment'])) {
                    echo 'GH$ '.number_format($each_item[0]['payment'], 2);
                }
                 }
            endforeach;
                        }
                ?></td>
                    </tr>
   <?php 
   
   

   endforeach;
        } 

?>
                   
                    
<!--                    <tr>
                        <td align="right" valign="top" colspan="10">&nbsp;</td>
                        
                    </tr>-->
                  
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
