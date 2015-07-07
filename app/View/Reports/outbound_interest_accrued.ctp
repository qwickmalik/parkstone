<?php echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js'); ?>
<h3>Reports: External Investments Accrued Interest</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <?php
            echo $this->Form->create('ReinvestInterestAccrual', array('url' => array('controller' => 'Reports', 'action' => 'outboundInterestAccrued')));
            ?>
            <div class="row" style="background: #eaeaea; padding: 10px 0px 5px 0px;">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?php
//                    $month = date('m');
//                    $day = date('d');
                    $Year = date('Y');
                    ?>
                    <input type="hidden" id="month" value="<?php // echo $month; ?>"/>
                    <input type="hidden" id="day" value="<?php // echo $day; ?>"/>
                    <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                    <?php // echo $this->Form->day('report_date', array("selected" => $day)); ?>&nbsp;
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?php // echo $this->Form->month('report_date', array("selected" => $month)); ?>&nbsp;
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?php echo $this->Form->year('report_date', 2009, date('Y'), array("selected" => $Year)); ?>
                </div>
                <script>
//                    var day = $("#day").val();
//                    var month = $("#month").val();
                    var year = $("#year").val();
//                    $("#InvestmentInvestmentDateDay option[value=" + day + "]").attr('selected', true);
//                    $("#InvestmentInvestmentDateMonth option[value=" + month + "]").attr('selected', true);
                    $("#ReinvestInterestAccrualReportDateYear option[value=" + year + "]").attr('selected', true);
                </script>
                
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?php
                echo $this->Form->input('bbf', array('type' => 'checkbox', 'label' => 'Balance Brought Forward'));
                ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?php
                echo $this->Form->button('Find', array('type' => 'submit', 'class' => 'btn btn-lg btn-success', 'style' => 'float: right;'));
                ?>
            </div>
<?php $this->Form->end(); ?>
            </div>
            <!--<p style="clear: both; width: 100%; margin-bottom: 20px; border-bottom: solid 2px dodgerblue;">&nbsp;</p>-->
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    &nbsp;
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <?php 
                    
                    echo $this->Html->image('parkstone_logo2.png', array('style' => 'float: left; margin-right: 20px;','width' => 120, 'alt' => $this->Session->read('shopName')));
                    ?>
                    <p style='font-weight: bold; font-size: 16px; text-align: left;'>
                        <?php 
                        echo $this->Session->read('shopName').'<br />'; 
                        echo $report_name; 
                        ?></p>
                    <p align='left'>For the period <?php echo isset($year)? $year: ''; ?></p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <p align="right"><?php echo $this->Session->read('shopAddress') . ', ' . $this->Session->read('shopPosttown') . '<br />' . $this->Session->read('shopPostCity') . ', ' . $this->Session->read('shopPostCount') . '<br />' . $this->Session->read('shopTelephone') . '<br />' . $this->Session->read('shopEmail'); ?></p>
                </div>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!--<table border="1" cellspacing="" cellpadding="3" width="100%" align="left" style="border: solid 2px gray;">-->
                <table class="table table-striped">
                    <tr>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Investor</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>BBF</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Jan</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Feb</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>March</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>April</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>May</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>June</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>July</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Aug</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Sept</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Oct</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Nov</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Dec</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Total</b></td>
                    </tr>
                         <?php if (isset($accounts)) {
                          
    foreach ($accounts as $each_item):  
              
            ?>
                    <tr>
                        <td align="left" valign="top"><?php if (!empty($each_item['Reinvestor']['company_name'])) {
                    echo  $each_item['Reinvestor']['company_name'];
                }
                ?></td>
                        <td align="right" valign="top">
                              <?php 
                              if(isset($bbf_total)){
                            foreach ($bbf_total as $btot):  
                            if ($btot['ReinvestReinvestInterestAccrual']['reinvestor_id'] == $each_item['ReinvestReinvestInterestAccrual']['reinvestor_id'] && isset($btot[0]['total_interests'])) {
                    echo number_format($btot[0]['total_interests'], 2);
                }
                
                endforeach;
                              }
                ?>
                      
                        </td>
                        <td align="right" valign="top"><?php if (!empty($each_item['ReinvestReinvestInterestAccrual']['Jan'])) {
                    echo  number_format($each_item['ReinvestReinvestInterestAccrual']['Jan'], 2);
                }else{
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['ReinvestInterestAccrual']['Feb'])) {
                    echo  number_format($each_item['ReinvestInterestAccrual']['Feb'], 2);
                }else{
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['ReinvestInterestAccrual']['Mar'])) {
                    echo   number_format($each_item['ReinvestInterestAccrual']['Mar'], 2);
                }else{
                    echo  ' 0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['ReinvestInterestAccrual']['Apr'])) {
                    echo  number_format($each_item['ReinvestInterestAccrual']['Apr'], 2);
                }else{
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['ReinvestInterestAccrual']['May'])) {
                    echo   number_format($each_item['ReinvestInterestAccrual']['May'], 2);
                }else{
                    echo  ' 0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['ReinvestInterestAccrual']['Jun'])) {
                    echo  number_format($each_item['ReinvestInterestAccrual']['Jun'], 2);
                }else{
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['ReinvestInterestAccrual']['Jul'])) {
                    echo  number_format($each_item['ReinvestInterestAccrual']['Jul'], 2);
                }else{
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['ReinvestInterestAccrual']['Aug'])) {
                    echo   number_format($each_item['ReinvestInterestAccrual']['Aug'], 2);
                }else{
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['ReinvestInterestAccrual']['Sep'])) {
                    echo   number_format($each_item['ReinvestInterestAccrual']['Sep'], 2);
                }else{
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['ReinvestInterestAccrual']['Oct'])) {
                    echo  number_format($each_item['ReinvestInterestAccrual']['Oct'], 2);
                }else{
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['ReinvestInterestAccrual']['Nov'])) {
                    echo   number_format($each_item['ReinvestInterestAccrual']['Nov'], 2);
                }else{
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['ReinvestInterestAccrual']['Dec'])) {
                    echo   number_format($each_item['ReinvestInterestAccrual']['Dec'], 2);
                }else{
                    echo  '0.00';
                }
                ?></td>
                                <td align="right" valign="top"><b>
                            <?php 
                            foreach ($total as $tot):  
                            if ($tot['ReinvestInterestAccrual']['reinvestor_id'] == $each_item['ReinvestInterestAccrual']['reinvestor_id'] && isset($tot[0]['total_interests'])) {
                    echo  'GH$ '. number_format($tot[0]['total_interests'], 2);
                }
                
                endforeach;
                ?>
                                        
                            </b></td>
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
