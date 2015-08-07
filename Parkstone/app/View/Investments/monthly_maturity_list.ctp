<?php echo $this->element('header'); ?>

<h3>Monthly Maturity List</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <?php echo $this->Form->create('Investment', array('url' => array('controller' => 'Investments', 'action' => 'monthlyMaturityList'))); ?>
            
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
                    <?php echo $this->Form->year('from_date', 2003, date('Y')+5, array("selected" => $Year)); ?>
                </div>
                <script>
                    var day = $("#day").val();
                    var month = $("#month").val();
                    var year = $("#year").val();
                    $("#InvestmentFromDateDay option[value=" + day + "]").attr('selected', true);
                    $("#InvestmentFromDateMonth option[value=" + month + "]").attr('selected', true);
                    $("#InvestmentFromDateYear option[value=" + year + "]").attr('selected', true);
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
                <?php
                echo $this->Form->button('Find', array('type' => 'submit', 'class' => 'btn btn-lg btn-success', 'style' => 'float: right;'));
                ?>

            </div>
            
            <?php echo $this->Form->end(); ?>
            <p style="clear: both; width: 100%; margin-bottom: 20px; border-bottom: solid 2px #000000;">&nbsp;</p>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <table border="0" width="100%" cellspacing="5" cellpadding="5" align="left" style="font-size: 85%">
                    <tr >
                        
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('investment_no', 'Inv. No.'); ?></b></td>
                       <td style="border-bottom: solid 2px dodgerblue" width="200" align="left"><b><?php echo $this->Paginator->sort('fullname', 'Name'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue;" width="60" align="left"><b><?php echo $this->Paginator->sort('investment_date', 'Inv. Date'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('due_date', 'Maturity'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('investment_amount', 'Principal'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" width="60" align="left"><b><?php echo $this->Paginator->sort('custom_rate', 'Benchmark'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" width="60" align="left"><b><?php echo $this->Paginator->sort('interest_earned', 'Interest'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" width="130" align="left"><b><?php echo $this->Paginator->sort('amount_due', 'Maturity Amt.'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue;" width="60" align="left"><b><?php echo $this->Paginator->sort('duration', 'Elapsed Tenure'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue;" width="60" align="left"><b><?php echo $this->Paginator->sort('total_tenure', 'Tenure Left'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue;" align="left"><b>Instructions</b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="center" style="border-bottom: solid 2px Gray;"><b><?php echo $this->Paginator->sort('status', 'Status'); ?></b></td>

                        <td style="border-bottom: solid 2px dodgerblue;" width="200" align="center" style="border-bottom: solid 2px Gray;"><b>Action</b></td>
                    </tr>
                    <?php if (isset($data)) {
                        foreach ($data as $each_item) { ?>
                    <tr style="border-bottom: solid 1px silver;font-size: 13px;">
                                <td align="left"><?php echo $each_item['Investment']['investment_no']; ?></td>
                                <td align="left"><?php echo $this->Html->link((!empty($each_item['Investor']['fullname']) ? $each_item['Investor']['fullname'] : $each_item['Investor']['comp_name'] ),"/Investments/approvePayments2/".(isset($each_item['Investor']['id']) ? $each_item['Investor']['id']."/".$each_item['Investor']['fullname'] : '' ),array());  ?></td>
                            
                                <td align="left"><?php echo $each_item['Investment']['investment_date']; ?></td>
                                <td align="left"><?php echo $each_item['Investment']['due_date']; ?></td>
                                <td align="left"><?php echo $each_item['Investment']['investment_amount']; ?></td>
                                <td align="left"><?php echo $each_item['Investment']['custom_rate'].'%'; ?></td>
                                <td align="left"><?php echo $each_item['Investment']['interest_earned']; ?></td>
                                <td align="left"><?php echo $each_item['Investment']['amount_due']; ?></td>
                                <td align="left"><?php echo $each_item['Investment']['duration'].' '.$each_item['Investment']['investment_period']; ?></td>
                                <td align="left"><?php echo $each_item['Investment']['total_tenure'].' '.$each_item['Investment']['investment_period']; ?></td>
                                <td align="left"><?php if($each_item['Instruction']['id'] != 5){
                                    echo $each_item['Instruction']['instruction_name'];
                                }else{
                                   echo $each_item['Investment']['instruction_details']; 
                                }?></td>
                                <td align="center" style="border-bottom: solid 1px Gray;"><?php
                            if (isset($each_item['Investment']['status'])) {
                                echo $each_item['Investment']['status'];
                            }
                            ?></td>
                                <td align="center" style="border-bottom: solid 1px Gray;">

                            <?php
                            
                                echo $this->Html->Link('Request Paymt', '/Investments/requestPayment/' . "/" . (isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' ), array('escape' => false));
                              ?> | <?php
                                echo $this->Html->Link('Rollover', '/Investments/rollover/' . "/" . (isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' ) . "/" . (isset($each_item['Investment']['investor_id']) ? $each_item['Investment']['investor_id'] : '' ) , array('escape' => false));
                            ?></td>
                            </tr>
    <?php }
} ?>

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