<?php echo $this->element('header'); ?>
<h3>Approve Payments: Maturity List</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <table border="0" width="100%" cellspacing="5" cellpadding="5" align="left">
                    <tr>
                       <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('fullname', 'Name'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('investment_no', 'Inv. No.'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('investment_date', 'Inv. Date'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('duration', 'Tenure'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('due_date', 'Maturity Date'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('investment_amount', 'Principal'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('custom_rate', 'Int. Rate'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('interest_accrued', 'Interest'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('amount_due', 'Maturity Amt.'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue;" align="left"><b>Instructions</b></td>
                    </tr>
                    <?php if (isset($data)) {
                        foreach ($data as $each_item) { ?>
                    <tr style="border-bottom: solid 1px silver;">
                               <td align="left"><?php echo $this->Html->link($each_item['Investor']['fullname'],
                                       "/Investments/approvePayments2/".(isset($each_item['Investor']['id']) ? $each_item['Investor']['id']."/".$each_item['Investor']['fullname'] 
                                       : '' )."/".(isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' )."/".
                                       (isset($each_item['Instruction']['instruction_name']) ? $each_item['Instruction']['instruction_name'] : (isset($each_item['Investment']['instruction_details']) ? $each_item['Investment']['instruction_details'] : '' ) ),array());  ?></td>
                                <td align="left"><?php echo $each_item['Investment']['investment_no']; ?></td>
                                <td align="left"><?php echo $each_item['Investment']['investment_date']; ?></td>
                                <td align="left"><?php 
                                
                                 $id = $each_item['Investment']['id'];
                               $accrued_days = $this->requestAction('/Investments/get_accrueddays/'.$id);
            echo $accrued_days.' '.$each_item['Investment']['investment_period'];
                                ?></td>
                                <td align="left"><?php echo $each_item['Investment']['due_date']; ?></td>
                                <td align="left"><?php  
                                
                                 if($each_item['Investment']['rollover_amount'] > 0){
                                    echo number_format($each_item['Investment']['rollover_amount'],2);
                                }else{
                                 
                                    echo number_format($each_item['Investment']['investment_amount'],2); 
                                }
                                ?></td>
                                <td align="left"><?php echo $each_item['Investment']['custom_rate'].'%'; ?></td>
                                <td align="left"><?php // echo $each_item['Investment']['interest_accrued'];
                                 if (isset($each_item['Investment']['id'])) {
                                $id = $each_item['Investment']['id'];
                               $interest_accrued = $this->requestAction('/Investments/get_accruedinterest/'.$id);
            echo  number_format($interest_accrued,2);
        } ?></td>
                                <td align="left"><?php 
                                if($each_item['Investment']['rollover_amount'] > 0){
                                    $id = $each_item['Investment']['id'];
                               $interest_accrued = $this->requestAction('/Investments/get_accruedinterest/'.$id);
                                    $matured = $each_item['Investment']['rollover_amount'] + $interest_accrued;
                                    echo number_format($matured,2);
                                }else{
                                   $id = $each_item['Investment']['id'];
                               $interest_accrued = $this->requestAction('/Investments/get_accruedinterest/'.$id);
                                    $matured = $each_item['Investment']['investment_amount'] + $interest_accrued;
                                    echo number_format($matured,2); 
                                }
                                
                                 ?></td>
                                <td align="left"><?php if($each_item['Instruction']['id'] != 7){
                                    echo $each_item['Instruction']['instruction_name'];
                                }else{
                                   echo $each_item['Investment']['instruction_details']; 
                                } ?></td>
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