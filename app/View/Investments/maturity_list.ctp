<?php echo $this->element('header'); ?>

<h3>Daily Maturity List For <?php echo date('D d M, Y'); ?></h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <table border="0" width="100%" cellspacing="5" cellpadding="5" align="left" style="font-size: 87%">
                    <tr >
                        
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('investment_no', 'No.'); ?></b></td>
                       <td style="border-bottom: solid 2px dodgerblue" width="200" align="center"><b><?php echo $this->Paginator->sort('fullname', 'Name'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue;" width="80" align="left"><b><?php echo $this->Paginator->sort('investment_date', 'Inv.Date'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" width="80" align="left"><b><?php echo $this->Paginator->sort('due_date', 'Maturity'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('investment_amount', 'Principal'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" width="60" align="left"><b><?php echo $this->Paginator->sort('custom_rate', 'Benchmark'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" width="60" align="left"><b><?php echo $this->Paginator->sort('interest_accrued', 'Interest'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" width="130" align="left"><b><?php echo $this->Paginator->sort('amount_due', 'Maturity Amt.'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue;" width="60" align="left"><b><?php echo $this->Paginator->sort('duration', 'Elapsed Tenure'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue;" width="60" align="left"><b><?php echo $this->Paginator->sort('total_tenure', 'Tenure Left'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue;" align="left"><b>Instructions</b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="center" style="border-bottom: solid 2px Gray;"><b><?php echo $this->Paginator->sort('status', 'Status'); ?></b></td>

                        <td style="border-bottom: solid 2px dodgerblue;" width="200" align="center" style="border-bottom: solid 2px Gray;"><b>Action</b></td>
                    </tr>
                    <?php if (!empty($data)) {
                        foreach ($data as $each_item) { ?>
                    <tr style="border-bottom: solid 1px silver;font-size: 13px;">
                                <td align="left"><?php echo $each_item['Investment']['investment_no']; ?></td>
                                <td align="left"><?php echo (!empty($each_item['Investor']['fullname']) ? $each_item['Investor']['fullname'] : $each_item['Investor']['comp_name'] );  ?></td>
                            
                                <td align="left"><?php echo $each_item['Investment']['investment_date']; ?></td>
                                <td align="left"><?php echo $each_item['Investment']['due_date']; ?></td>
                                <td align="left"><?php
                                
                                 if($each_item['Investment']['rollover_amount'] > 0){
                                    echo number_format($each_item['Investment']['rollover_amount'],2);
                                }else{
                                 
                                    echo number_format($each_item['Investment']['investment_amount'],2); 
                                }
                                 ?></td>
                                <td align="left"><?php echo $each_item['Investment']['custom_rate'].'%'; ?></td>
                                <td align="left"><?php       if (isset($each_item['Investment']['id'])) {
                                $id = $each_item['Investment']['id'];
                               $interest_accrued = $this->requestAction('/Investments/get_accruedinterest/'.$id);
            echo  number_format($interest_accrued,2);
        } ?></td>
                                <td align="left"><?php  if($each_item['Investment']['rollover_amount'] > 0){
                                    $id = $each_item['Investment']['id'];
                               $interest_accrued = $this->requestAction('/Investments/get_accruedinterest/'.$id);
                                    $matured = $each_item['Investment']['rollover_amount'] + $interest_accrued;
                                    echo number_format($matured,2);
                                }else{
                                   $id = $each_item['Investment']['id'];
                               $interest_accrued = $this->requestAction('/Investments/get_accruedinterest/'.$id);
                                    $matured = $each_item['Investment']['investment_amount'] + $interest_accrued;
                                    echo number_format($matured,2); 
                                } ?></td>
                                <td align="left"><?php  $id = $each_item['Investment']['id'];
                               $accrued_days = $this->requestAction('/Investments/get_accrueddays/'.$id);
            echo $accrued_days.' '.$each_item['Investment']['investment_period']; ?></td>
                                <td align="left"><?php echo $each_item['Investment']['total_tenure'].' Day(s)'; ?></td>
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
}else {
 ?>
                    <tr>
                        <td colspan="15">
                         <div class="alert alert-warning">
                        <h4><i class="icon-remove"></i> NO MATURED INVESTMENT RECORDS FOUND</h4>
                    </div>   
                            
                        </td> 
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