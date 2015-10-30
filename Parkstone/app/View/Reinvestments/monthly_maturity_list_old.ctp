<?php echo $this->element('header'); ?>

<h3>Monthly Maturity List (OUTBOUND) For Period <?php echo $frstart_date; ?> - <?php echo $frend_date; ?></h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <?php echo $this->Form->create('Reinvestment', array('url' => array('controller' => 'Reinvestments', 'action' => 'monthlyMaturityList'))); ?>
            
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <p style="font-weight: bold; padding: 10px 0px 0px 15px;float: right">Period</p>
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
   
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php
                    $month = date('m');
//                    $day = date('d');
                    $Year = date('Y');
                    ?>
                    <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                    <!--<input type="hidden" id="day" value="<?php // echo $day; ?>"/>-->
                    <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                    <?php echo $this->Form->month('to_date', array("selected" => $month)); ?>&nbsp;
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->year('to_date', 2003, date('Y')+5, array("selected" => $Year)); ?>
                </div>
                <script>
                    var day = $("#day").val();
                    var month = $("#month").val();
                    var year = $("#year").val();
                    $("#InvestmentToDateDay option[value=" + day + "]").attr('selected', true);
                    $("#InvestmentToDateMonth option[value=" + month + "]").attr('selected', true);
                    $("#InvestmentToDateYear option[value=" + year + "]").attr('selected', true);
                </script>
                 <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                  <?php
                echo $this->Form->button('Find', array('type' => 'submit', 'class' => 'btn btn-lg btn-success', 'style' => 'float: left;'));
                ?>
                </div>
                

            </div>
            
            <?php echo $this->Form->end(); ?>
            <p style="clear: both; width: 100%; margin-bottom: 20px; border-bottom: solid 2px #000000;">&nbsp;</p>
            
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <table border="0" width="100%" cellspacing="5" cellpadding="5" align="left">
<?php if (!empty($data)) { ?>
                    <tr >
                        
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('id', 'Inv. No.'); ?></b></td>
                       <td style="border-bottom: solid 2px dodgerblue" width="200" align="left"><b><?php echo $this->Paginator->sort('company_name', 'Name'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue;" width="60" align="left"><b><?php echo $this->Paginator->sort('investment_date', 'Inv. Date'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('due_date', 'Maturity'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('investment_amount', 'Principal'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" width="60" align="left"><b><?php echo $this->Paginator->sort('interest_rate', 'Benchmark Rate'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" width="60" align="left"><b><?php echo $this->Paginator->sort('interest_earned', 'Interest'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" width="130" align="left"><b><?php echo $this->Paginator->sort('amount_due', 'Maturity Amt.'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue;" width="60" align="left"><b><?php echo $this->Paginator->sort('duration', 'Elapsed Tenure'); ?></b></td>
                       
                        <td style="border-bottom: solid 2px dodgerblue" align="center" style="border-bottom: solid 2px Gray;"><b><?php echo $this->Paginator->sort('payment_status', 'Payment Status'); ?></b></td>

                        <td style="border-bottom: solid 2px dodgerblue;" width="200" align="center" style="border-bottom: solid 2px Gray;"><b>Action</b></td>
                    </tr>
<?php 
                        foreach ($data as $each_item) { ?>
                    <tr style="border-bottom: solid 1px silver;font-size: 13px;">
                                <td align="left"><?php echo $each_item['Reinvestment']['id']; ?></td>
                                <td align="left"><?php echo $this->Html->link((!empty($each_item['Reinvestor']['company_name']) ? $each_item['Reinvestor']['company_name'] : '' ),"/Reinvestments/approvePayments2/".(isset($each_item['Reinvestor']['id']) ? $each_item['Reinvestor']['id']."/".$each_item['Reinvestor']['company_name'] : '' ),array());  ?></td>
                            
                                <td align="left"><?php echo $each_item['Reinvestment']['investment_date']; ?></td>
                                <td align="left"><?php echo $each_item['Reinvestment']['due_date']; ?></td>
                                <td align="left"><?php echo $each_item['Reinvestment']['investment_amount']; ?></td>
                                <td align="left"><?php echo $each_item['Reinvestment']['interest_rate'].'%'; ?></td>
                                <td align="left"><?php echo $each_item['Reinvestment']['interest_earned']; ?></td>
                                <td align="left"><?php echo $each_item['Reinvestment']['amount_due']; ?></td>
                                <td align="left"><?php echo $each_item['Reinvestment']['duration'].' '.$each_item['Reinvestment']['investment_period']; ?></td>
                                
                                <td align="left"><?php echo $each_item['Reinvestment']['payment_status']; ?></td>
                                <td align="center" style="border-bottom: solid 1px Gray;">

                            <?php
                            
                               echo $this->Html->link("Record Inv. Returns","/Reinvestments/payReinvestorFixed/".$each_item['Reinvestment']['id']); 
                         ?> | <?php
                                echo $this->Html->link("Roll-over","/Reinvestments/rollover/".$each_item['Reinvestment']['id']."/".$each_item['Reinvestment']['reinvestor_id']);
                            ?></td>
                            </tr>
    <?php } ?>
                            


                    <tr>
                        <td colspan="11" align="right">
<?php //echo $this->Form->end();
?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="11" align="center">
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
<?php }
     else {
 ?> 
                            <tr >

                                    <td style="border-bottom: solid 2px dodgerblue" align="left"><b>Inv. No.</b></td>
                                    <td style="border-bottom: solid 2px dodgerblue" width="200" align="left"><b>Name</b></td>
                                    <td style="border-bottom: solid 2px dodgerblue;" width="60" align="left"><b>Inv. Date</b></td>
                                    <td style="border-bottom: solid 2px dodgerblue" align="left"><b>Maturity</b></td>
                                    <td style="border-bottom: solid 2px dodgerblue" align="left"><b>Principal</b></td>
                                    <td style="border-bottom: solid 2px dodgerblue" width="60" align="left"><b>Benchmark Rate</b></td>
                                    <td style="border-bottom: solid 2px dodgerblue" width="60" align="left"><b>Interest</b></td>
                                    <td style="border-bottom: solid 2px dodgerblue" width="130" align="left"><b>Maturity Amt.</b></td>
                                    <td style="border-bottom: solid 2px dodgerblue;" width="60" align="left"><b>Elapsed Tenure</b></td>

                                    <td style="border-bottom: solid 2px dodgerblue" align="center" style="border-bottom: solid 2px Gray;"><b>Payment Status</b></td>

                                    <td style="border-bottom: solid 2px dodgerblue;" width="200" align="center" style="border-bottom: solid 2px Gray;"><b>Action</b></td>
                                </tr>
                                <tr>
                                    <td colspan="15">
                                        <div class="alert alert-warning">
                                            <h4><i class="icon-remove"></i> NO MATURED INVESTMENT RECORDS FOUND FOR THIS SEARCH</h4>
                                        </div>   

                                    </td> 
                                </tr>
                       
                <?php } ?>
                </table>
            </div>
            <?php
//            echo "<p>&nbsp;</p>";
//            echo $this->Html->link('Print', "javascript:void(0)", array('style' => 'float: right;', "class" => 'btn btn-lg btn-warning', "id" => "print_receipt"));
//            echo $this->Html->link('Return', "/Reports/", array('style' => 'float: right;', 'class' => 'btn btn-lg btn-info'));
            ?>
        </div>
        <!-- Content end here -->

<?php echo $this->element('footer'); ?>