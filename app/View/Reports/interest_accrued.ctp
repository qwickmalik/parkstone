<?php echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js'); ?>
<h3>Reports: Internal Investments Accrued Interest</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <?php
            echo $this->Form->create('InterestAccrued', array('url' => array('controller' => 'Reports', 'action' => 'interestAccrued')));
            ?>
            <div class="row" style="background: #eaeaea; padding: 10px 0px 5px 0px;">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?php
//                    $month = date('m');
//                    $day = date('d');
                    $Year = date('Y');
                    ?>
                    <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                    <?php // echo $this->Form->day('report_date', array("selected" => $day)); ?>&nbsp;
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?php // echo $this->Form->month('report_date', array("selected" => $month)); ?>&nbsp;
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?php echo $this->Form->year('report_date', 2009, date('Y')+2, array("selected" => $Year)); ?>
                </div>
                <script>
//                    var day = $("#day").val();
//                    var month = $("#month").val();
                    var year = $("#year").val();
//                    $("#InvestmentInvestmentDateDay option[value=" + day + "]").attr('selected', true);
//                    $("#InvestmentInvestmentDateMonth option[value=" + month + "]").attr('selected', true);
                    $("#InterestAccruedReportDateYear option[value=" + year + "]").attr('selected', true);
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
                        <td align="left" valign="top"><?php if (!empty($each_item['Investor']['in_trust_for'])) {
                    echo  $each_item['Investor']['in_trust_for'];
                }elseif(!empty($each_item['Investor']['surname'])){
                    echo  $each_item['Investor']['surname'];
                }elseif(!empty($each_item['Investor']['comp_name'])){
                    echo  $each_item['Investor']['comp_name'];
                }
                ?></td>
                        <td align="right" valign="top">
                              <?php 
                              if (!empty($each_item['AggregateInterest']['bbf'])) {
                    echo  number_format($each_item['AggregateInterest']['bbf'], 2);
                }
                ?>
                      
                        </td>
                        <td align="right" valign="top"><?php if (!empty($each_item['AggregateInterest']['jan'])) {
                    echo  number_format($each_item['AggregateInterest']['jan'], 2);
                }else{
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['AggregateInterest']['feb'])) {
                    echo  number_format($each_item['AggregateInterest']['feb'], 2);
                }else{
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['AggregateInterest']['march'])) {
                    echo   number_format($each_item['AggregateInterest']['march'], 2);
                }else{
                    echo  ' 0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['AggregateInterest']['april'])) {
                    echo  number_format($each_item['AggregateInterest']['april'], 2);
                }else{
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['AggregateInterest']['may'])) {
                    echo   number_format($each_item['AggregateInterest']['may'], 2);
                }else{
                    echo  ' 0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['AggregateInterest']['june'])) {
                    echo  number_format($each_item['AggregateInterest']['june'], 2);
                }else{
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['AggregateInterest']['july'])) {
                    echo  number_format($each_item['AggregateInterest']['july'], 2);
                }else{
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['AggregateInterest']['aug'])) {
                    echo   number_format($each_item['AggregateInterest']['aug'], 2);
                }else{
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['AggregateInterest']['sept'])) {
                    echo   number_format($each_item['AggregateInterest']['sept'], 2);
                }else{
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['AggregateInterest']['oct'])) {
                    echo  number_format($each_item['AggregateInterest']['oct'], 2);
                }else{
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['AggregateInterest']['nov'])) {
                    echo   number_format($each_item['AggregateInterest']['nov'], 2);
                }else{
                    echo  '0.00';
                }
                ?></td>
                        <td align="right" valign="top"><?php if (!empty($each_item['AggregateInterest']['decem'])) {
                    echo   number_format($each_item['AggregateInterest']['decem'], 2);
                }else{
                    echo  '0.00';
                }
                ?></td>
                                <td align="right" valign="top"><b>
                            <?php 
                             $bbf = 0;
                             $total_int = 0;
                                    if (!empty($each_item['AggregateInterest']['bbf']) && !empty($each_item['AggregateInterest']['total'])) {
                    $bbf = $each_item['AggregateInterest']['bbf'];
                    $total_int = $each_item['AggregateInterest']['total'];
                    $comp_total = $bbf + $total_int;
                    
                    echo   'GHc '.number_format($comp_total, 2);
                }elseif(!empty($each_item['AggregateInterest']['total'])) {
                    echo   'GHc '.number_format($each_item['AggregateInterest']['total'], 2);
                }elseif(!empty($each_item['AggregateInterest']['bbf'])){
                    
                    echo   'GHc '.number_format($each_item['AggregateInterest']['bbf'], 2);
                }
                else{
                    echo  'GHc 0.00';
                }
                ?>
                                        
                            </b></td>
                    </tr>
                              <?php
    
    endforeach;  }else {
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
            if(isset($this->Paginator)){
            
            ?>
            
           
             <div class="pagination">
                                 <table>
                                <tbody>
                       
                                <tr>
                                    <td colspan="6" align="center">
                                        <?php
                                        echo $this->Paginator->first($this->Html->image('first.png', array('width' => 15, 'height' => 15, 'valign' => 'middle', 'alt' => 'First', 'title' => 'First')), array('escape' => false), null, null, array('class' => 'disabled')) . "&nbsp;&nbsp;&nbsp;&nbsp;";
                                        echo $this->Paginator->prev($this->Html->image('prev.png', array('width' => 15, 'height' => 15, 'valign' => 'middle', 'alt' => 'Previous', 'title' => 'Previous')), array('escape' => false), null, null, array('class' => 'disabled')) . "&nbsp;&nbsp;&nbsp;&nbsp;";
                                        echo $this->Paginator->numbers() . "&nbsp;&nbsp;";
                                        echo $this->Paginator->next($this->Html->image('next.png', array('width' => 15, 'height' => 15, 'valign' => 'middle', 'alt' => 'Next', 'title' => 'Next')), array('escape' => false), null, null, array('class' => 'disabled')) . "&nbsp;&nbsp;&nbsp;&nbsp;";
                                        echo $this->Paginator->last($this->Html->image('last.png', array('width' => 15, 'height' => 15, 'valign' => 'middle', 'alt' => 'Last', 'title' => 'Last')), array('escape' => false), null, null, array('class' => 'disabled')) . "&nbsp;&nbsp;&nbsp;&nbsp;";
                                        //prints X of Y, where X is current page and Y is number of pages
                                        echo $this->Paginator->counter(array('format' => 'Page %page% of %pages%, showing %current% items out of %count% total'));
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
<!--                                <ul>
                                    <li><a href="#">Prev</a></li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">Next</a></li>
                                </ul>-->
                            </div>
              <?php  
            }
            echo "<p>&nbsp;</p>";
            echo $this->Html->link('Print', "javascript:void(0)", array('style' => 'float: right;', "class" => 'btn btn-lg btn-warning', "id" => "print_receipt"));
            echo $this->Html->link('Return', "/Reports/", array('style' => 'float: right;', 'class' => 'btn btn-lg btn-info'));
            ?>
        </div>
    </div>
    <!-- Content end here -->
<?php echo $this->element('footer'); ?>
