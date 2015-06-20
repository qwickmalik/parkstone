<?php echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js'); ?>

<h3>Reports: Aggregate Investment Report</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <?php echo $this->Form->create('Investment', array('url' => array('controller' => 'Reports', 'action' => 'aggregateInvestment'))); ?>
            
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
                    <?php echo $this->Form->year('begin_date', 2003, date('Y'), array("selected" => $Year)); ?>
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
                    <?php echo $this->Form->year('finish_date', 2003, date('Y'), array("selected" => $Year)); ?>
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
                        echo $this->Html->image('parkstone_logo2.png', array('style' => 'float: left; margin-right: 20px;','width' => 120, 'alt' => $this->Session->read('shopName')));
                        ?>
                        <p style='font-weight: bold; font-size: 14px; text-align: left;'>
                            <?php 
                            echo $this->Session->read('shopName').'<br />'; 
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
                        <td align="left" valign="top" width="250" style="border-bottom: solid 2px Gray;"><b>Name</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Investment No.</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Investment Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Amount Inv.</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Benchmark Rate</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Maturity Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Interest Due on Maturity</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Principal & Interest Due</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Current Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Interest Due on Current Date</b></td>
                        <td align="right" valign="top" width="100" style="border-bottom: solid 2px Gray;"><b>Principal & Interest Due on Current Date</b></td>
                    </tr>
                   
                    <?php if (isset($accounts)) {
                          
    foreach ($accounts as $each_item):  
              
            ?>
                    <tr>
                 
                        <td align="left" valign="top"><?php if (isset($each_item['Investor']['fullname'])) {
            echo  $each_item['Investor']['fullname'];
        } ?></td>
                        <td align="left" valign="top"><?php if (isset($each_item['Investment']['investment_no'])) {
            echo  $each_item['Investment']['investment_no'];
        } ?></td>
                        <td align="right" valign="top"><?php if (isset($each_item['Investment']['investment_date'])) {
            echo  date('d-M-Y',strtotime($each_item['Investment']['investment_date']));
        } ?></td>
                        <td align="right" valign="top"><?php if (isset($each_item['Investment']['investment_amount'])) {
            echo  number_format($each_item['Investment']['investment_amount'],2);
        } ?></td>
                        <td align="right" valign="top"><?php if (isset($each_item['Investment']['custom_rate'])) {
            echo  $each_item['Investment']['custom_rate'].'%';
        } ?></td>
                        <td align="right" valign="top"><?php if (isset($each_item['Investment']['due_date'])) {
            echo  date('d-M-Y',strtotime($each_item['Investment']['due_date']));
        } ?></td>
                        <td align="right" valign="top"><?php echo date('d-m-Y'); ?></td>
                        <td align="right" valign="top"><?php if (isset($each_item['Investment']['expected_interest'])) {
            echo  number_format($each_item['Investment']['expected_interest'],2);
        } ?></td>
                        <td align="right" valign="top"><?php if (isset($each_item['Investment']['amount_due']) 
                                ) {
              $totals = $each_item['Investment']['amount_due'] ;
        
            echo number_format($totals,2);
            
                        } ?></td>
                              <td align="right" valign="top"><?php 
            echo  date('d-M-Y');
         ?></td>
                                    <td align="right" valign="top"><?php if (isset($each_item['Investment']['interest_accrued'])) {
            echo  number_format($each_item['Investment']['interest_accrued'],2);
        } ?></td>
                                     <td align="right" valign="top"><?php if (isset($each_item['Investment']['interest_accrued']) && isset($each_item['Investment']['investment_amount'])) {
              $totals = $each_item['Investment']['interest_accrued'] + $each_item['Investment']['investment_amount'];
        
            echo number_format($totals,2);
            
                        } ?></td>
                    </tr>
                    
                    <?php
    
    endforeach;
} ?>
                    
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
