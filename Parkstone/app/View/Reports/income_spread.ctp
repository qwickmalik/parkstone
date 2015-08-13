<?php echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js'); ?>
<h3>Reports: Income Spread</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <?php
            echo $this->Form->create('IncomeSpread', array('url' => array('controller' => 'Reports', 'action' => 'incomeSpread')));
            ?>
            
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
                    <?php echo $this->Form->year('report_date', 2003, date('Y'), array("selected" => $Year,'required')); ?>
                </div>
                <script>
//                    var day = $("#day").val();
//                    var month = $("#month").val();
                    var year = $("#year").val();
//                    $("#InvestmentInvestmentDateDay option[value=" + day + "]").attr('selected', true);
//                    $("#InvestmentInvestmentDateMonth option[value=" + month + "]").attr('selected', true);
                    $("#IncomeSpreadReportDateYear option[value=" + year + "]").attr('selected', true);
                </script>
                
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?php
//                echo $this->Form->input('bbf', array('type' => 'checkbox', 'label' => 'Balance Brought Forward'));
                ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?php
                echo $this->Form->button('Find', array('type' => 'submit', 'class' => 'btn btn-lg btn-success', 'style' => 'float: right;'));
                ?>
            </div>
<?php $this->Form->end(); ?>
            
            <p style="clear: both; width: 100%; margin-bottom: 20px; border-bottom: solid 2px dodgerblue;">&nbsp;</p>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <?php 
                    
                    echo $this->Html->image('parkstone_logo2.png', array('style' => 'float: left; margin-right: 20px;','width' => 120, 'alt' => $this->Session->read('shopName')));
                    ?>
                    <p style='font-weight: bold; font-size: 16px; text-align: left;'>
                        <?php 
                        echo $this->Session->read('shopName').'<br />'; 
                        echo $report_name; 
                        ?></p>
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
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Month</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Investment Interest</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Benchmark Interest</b></td>
                                                <!--<td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Monthly Interest Accrued</b></td>-->
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Management Fee</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Performance Fee</b></td>
                    </tr>
                        <?php if (isset($accounts) && isset($invaccounts) && isset($mgaccounts)) {
                          
      $total_performance_fee = 0;
        
            ?>
                    <tr>
                        <td align="left" valign="top">January</td>
                        <td align="right" valign="top"><?php
                        $n1 = 0; $out =0;
                        foreach ($accounts as $each_item):
                        
                                if($each_item[0]['month'] ==1 ) {
                                    if ( !empty($each_item[0]['interests'])) {
                                        $out = number_format($each_item[0]['interests'], 2);
                                        $n1 ++;
                    echo  number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                        }
                endforeach;
                if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                        $n1 = 0;$in = 0;
                        foreach ($invaccounts as $each_item):
                                if($each_item[0]['month'] ==1 ) {
                                    if ( !empty($each_item[0]['interests'])) {
                                        $n1 ++;
                                        $in = number_format($each_item[0]['interests'], 2);
                    echo  number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                        }
                endforeach;
                if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                        $n1 = 0;$fee =0;
                        foreach ($mgaccounts as $each_item):
                                if($each_item[0]['month'] ==1 ) {
                                    if ( !empty($each_item[0]['interests'])) {
                                        $n1 ++;
                                        $fee = number_format($each_item[0]['interests'], 2);
                    echo  number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                        }
                endforeach;
                if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                                $performance_fee = $in - $out - $fee;
                                 echo  number_format($performance_fee, 2);
                                 $total_performance_fee +=$performance_fee;
                        
                        ?></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">February</td>
                        <td align="right" valign="top"><?php 
                            $n2 = 0; $out =0;
                        foreach ($accounts as $each_item):
                        if ( $each_item[0]['month'] ==2) {
                            if(!empty($each_item[0]['interests'])){
                                $n2++;
                                        $out = number_format($each_item[0]['interests'], 2);
                                
                    echo  number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                        }
                  endforeach;
                  if(empty($n2)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php 
                           $in = 0; $n2 = 0;
                        foreach ($invaccounts as $each_item):
                            
                        if ( $each_item[0]['month'] ==2) {
                            if(!empty($each_item[0]['interests'])){
                                 $n2++;
                                        $in = number_format($each_item[0]['interests'], 2);
                    echo  number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                        }
                  endforeach;
                  if(empty($n2)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php 
                            $n2 = 0;$fee =0;
                        foreach ($mgaccounts as $each_item):
                            
                        if ( $each_item[0]['month'] ==2) {
                            if(!empty($each_item[0]['interests'])){
                                 $n2++;
                                        $fee = number_format($each_item[0]['interests'], 2);
                    echo  number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                        }
                  endforeach;
                  if(empty($n2)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                                $performance_fee = $in - $out - $fee;
                                 echo  number_format($performance_fee, 2);
                                 $total_performance_fee +=$performance_fee;
                        
                        ?></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">March</td>
                        <td align="right" valign="top"><?php $n3 = 0; $out =0;
                        foreach ($accounts as $each_item):
                            
                            if ( $each_item[0]['month'] ==3) {
                                 if(!empty($each_item[0]['interests'])){
                                  $n3++;
                                        $out = number_format($each_item[0]['interests'], 2);
                    echo   number_format($each_item[0]['interests'], 2);
                }else{
                    echo  ' 0.00';
                }
                            }
                  endforeach;
                  if(empty($n3)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php 
                         $n1 = 0;$in = 0;
                        foreach ($invaccounts as $each_item):
                           
                            if ( $each_item[0]['month'] ==3) {
                                  
                                 if(!empty($each_item[0]['interests'])){
                                     $n1++;
                                        $in = number_format($each_item[0]['interests'], 2);
                    echo   number_format($each_item[0]['interests'], 2);
                }else{
                    echo  ' 0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php $n3 = 0;$fee =0;
                        foreach ($mgaccounts as $each_item):
                            
                            if ( $each_item[0]['month'] ==3) {
                                 
                                 if(!empty($each_item[0]['interests'])){
                                      $n3++;
                                        $fee = number_format($each_item[0]['interests'], 2);
                    echo   number_format($each_item[0]['interests'], 2);
                }else{
                    echo  ' 0.00';
                }
                            }
                  endforeach;
                  if(empty($n3)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                                $performance_fee = $in - $out - $fee;
                                 echo  number_format($performance_fee, 2);
                                 $total_performance_fee +=$performance_fee;
                        
                        ?></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">April</td>
                        <td align="right" valign="top"><?php
                         $out =0; $n1 = 0; foreach ($accounts as $each_item):
                            if ($each_item[0]['month'] ==4) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $out = number_format($each_item[0]['interests'], 2);
                    echo  number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                        $in = 0; $n1 = 0; foreach ($invaccounts as $each_item):
                            if ($each_item[0]['month'] ==4) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $in = number_format($each_item[0]['interests'], 2);
                    echo  number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                         $fee =0;$n1 = 0; foreach ($mgaccounts as $each_item):
                            if ($each_item[0]['month'] ==4) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $fee = number_format($each_item[0]['interests'], 2);
                    echo  number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                                $performance_fee = $in - $out - $fee;
                                 echo  number_format($performance_fee, 2);
                                 $total_performance_fee +=$performance_fee;
                        
                        ?></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">May</td>
                        <td align="right" valign="top"><?php
                         $out =0; $n1 = 0;  foreach ($accounts as $each_item):
                            if ($each_item[0]['month'] ==5) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $out = number_format($each_item[0]['interests'], 2);
                    echo   number_format($each_item[0]['interests'], 2);
                }else{
                    echo  ' 0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                        $in = 0; $n1 = 0;  foreach ($invaccounts as $each_item):
                            if ($each_item[0]['month'] ==5) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $in = number_format($each_item[0]['interests'], 2);
                    echo   number_format($each_item[0]['interests'], 2);
                }else{
                    echo  ' 0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                        $fee =0; $n1 = 0;  foreach ($mgaccounts as $each_item):
                            if ($each_item[0]['month'] ==5) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $fee = number_format($each_item[0]['interests'], 2);
                    echo   number_format($each_item[0]['interests'], 2);
                }else{
                    echo  ' 0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                                $performance_fee = $in - $out - $fee;
                                 echo  number_format($performance_fee, 2);
                                 $total_performance_fee +=$performance_fee;
                        
                        ?></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">June</td>
                        <td align="right" valign="top"><?php
                         $out =0; $n1 = 0;  foreach ($accounts as $each_item):
                            if ($each_item[0]['month'] ==6) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $out = number_format($each_item[0]['interests'], 2);
                    echo  number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                        $in = 0; $n1 = 0;  foreach ($invaccounts as $each_item):
                            if ($each_item[0]['month'] ==6) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $in = number_format($each_item[0]['interests'], 2);
                    echo  number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                        $fee =0; $n1 = 0;  foreach ($mgaccounts as $each_item):
                            if ($each_item[0]['month'] ==6) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $fee = number_format($each_item[0]['interests'], 2);
                    echo  number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                                $performance_fee = $in - $out - $fee;
                                 echo  number_format($performance_fee, 2);
                                 $total_performance_fee +=$performance_fee;
                        ?></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">July</td>
                        <td align="right" valign="top"><?php
                         $out =0; $n1 = 0;  foreach ($accounts as $each_item):
                            if ($each_item[0]['month'] ==7) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $out = number_format($each_item[0]['interests'], 2);
                    echo  number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                        $in = 0; $n1 = 0;  foreach ($invaccounts as $each_item):
                            if ($each_item[0]['month'] ==7) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $in = number_format($each_item[0]['interests'], 2);
                    echo  number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                         $fee =0;$n1 = 0;  foreach ($mgaccounts as $each_item):
                            if ($each_item[0]['month'] ==7) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $fee = number_format($each_item[0]['interests'], 2);
                    echo  number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                                $performance_fee = $in - $out - $fee;
                                 echo  number_format($performance_fee, 2);
                                 $total_performance_fee +=$performance_fee;
                        ?></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">August</td>
                        <td align="right" valign="top"><?php
                         $out =0; $n1 = 0;  foreach ($accounts as $each_item):
                            if ($each_item[0]['month'] ==8) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $out = number_format($each_item[0]['interests'], 2);
                    echo   number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                        $in = 0; $n1 = 0;  foreach ($invaccounts as $each_item):
                            if ($each_item[0]['month'] ==8) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $in = number_format($each_item[0]['interests'], 2);
                    echo   number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                         $fee =0;$n1 = 0;  foreach ($mgaccounts as $each_item):
                            if ($each_item[0]['month'] ==8) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $fee = number_format($each_item[0]['interests'], 2);
                    echo   number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                                $performance_fee = $in - $out - $fee;
                                 echo  number_format($performance_fee, 2);
                                 $total_performance_fee +=$performance_fee;
                        ?></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">September</td>
                        <td align="right" valign="top"><?php
                         $out =0; $n1 = 0;  foreach ($accounts as $each_item):
                            if ( $each_item[0]['month'] ==9) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $out = number_format($each_item[0]['interests'], 2);
                    echo   number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                        $in = 0; $n1 = 0;  foreach ($invaccounts as $each_item):
                            if ( $each_item[0]['month'] ==9) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $in = number_format($each_item[0]['interests'], 2);
                    echo   number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                      $fee =0;  $out =0;  $n1 = 0;  foreach ($mgaccounts as $each_item):
                            if ( $each_item[0]['month'] ==9) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $fee = number_format($each_item[0]['interests'], 2);
                    echo   number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                                $performance_fee = $in - $out - $fee;
                                 echo  number_format($performance_fee, 2);
                                 $total_performance_fee +=$performance_fee;
                        ?></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">October</td>
                        <td align="right" valign="top"><?php
                        $out =0;  $n1 = 0;  foreach ($accounts as $each_item):
                            if ($each_item[0]['month'] ==10) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $out = number_format($each_item[0]['interests'], 2);
                    echo  number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                      $in = 0;   $n1 = 0;  foreach ($invaccounts as $each_item):
                            if ($each_item[0]['month'] ==10) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $in = number_format($each_item[0]['interests'], 2);
                    echo  number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                        $fee =0; $n1 = 0;  foreach ($mgaccounts as $each_item):
                            if ($each_item[0]['month'] ==10) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $fee = number_format($each_item[0]['interests'], 2);
                    echo  number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                                $performance_fee = $in - $out - $fee;
                                 echo  number_format($performance_fee, 2);
                                 $total_performance_fee +=$performance_fee;
                        ?></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">November</td>
                        <td align="right" valign="top"><?php
                         $out =0; $n1 = 0;  foreach ($accounts as $each_item):
                            if ($each_item[0]['month'] ==11) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $out = number_format($each_item[0]['interests'], 2);
                    echo   number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                        $in = 0; $n1 = 0;  foreach ($invaccounts as $each_item):
                            if ($each_item[0]['month'] ==11) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $in = number_format($each_item[0]['interests'], 2);
                    echo   number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                       $fee =0;  $n1 = 0;  foreach ($mgaccounts as $each_item):
                            if ($each_item[0]['month'] ==11) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $fee = number_format($each_item[0]['interests'], 2);
                    echo   number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                                $performance_fee = $in - $out - $fee;
                                 echo  number_format($performance_fee, 2);
                                 $total_performance_fee +=$performance_fee;
                        ?></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">December</td>
                        <td align="right" valign="top"><?php
                         $out =0; $n1 = 0;  foreach ($accounts as $each_item):
                            if ($each_item[0]['month'] ==12) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $out = number_format($each_item[0]['interests'], 2);
                    echo   number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                        $in = 0; $n1 = 0;  foreach ($invaccounts as $each_item):
                            if ($each_item[0]['month'] ==12) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $in = number_format($each_item[0]['interests'], 2);
                    echo   number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                        $fee =0; $n1 = 0;  foreach ($mgaccounts as $each_item):
                            if ($each_item[0]['month'] ==12) {
                                 if(!empty($each_item[0]['interests'])){
                                      $n1++;
                                        $fee = number_format($each_item[0]['interests'], 2);
                    echo   number_format($each_item[0]['interests'], 2);
                }else{
                    echo  '0.00';
                }
                            }
                  endforeach;
                  if(empty($n1)){
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php
                                $performance_fee = $in - $out - $fee;
                                 echo  number_format($performance_fee, 2);
                                 $total_performance_fee +=$performance_fee;
                        ?></td>
                    </tr>
                    
                    <tr>
                        <td align="left" valign="top"><b>Total</b></td>
                        <td align="right" valign="top"><b> <?php 
                            foreach ($total as $tot):  
                            if (!empty($tot[0]['total_interests'])) {
                    echo  'GH$ '. number_format($tot[0]['total_interests'], 2);
                }
                
                endforeach;
                ?></b></td>
                        <td align="right" valign="top"><b> <?php 
                            foreach ($invtotal as $tot):  
                            if (!empty($tot[0]['total_interests'])) {
                    echo  'GH$ '. number_format($tot[0]['total_interests'], 2);
                }
                
                endforeach;
                ?></b></td>
                        <td align="right" valign="top"><b> <?php 
                            foreach ($mgtotal as $tot):  
                            if (!empty($tot[0]['total_interests'])) {
                    echo  'GH$ '. number_format($tot[0]['total_interests'], 2);
                }
                
                endforeach;
                ?></b></td>
                         <td align="right" valign="top"><?php
                                 echo  number_format($total_performance_fee, 2);
                        ?></td>
                    </tr>
                             <?php
        
    
    }else {
 ?>
                    <tr>
                        <td colspan="15">
                         <div class="alert alert-warning">
                        <h4><i class="icon-remove"></i> NO ACCRUED RECORDS FOUND FOR THIS SEARCH. </h4>
                    </div>   
                            
                        </td> 
                    </tr>
                       
                <?php } ?>
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
