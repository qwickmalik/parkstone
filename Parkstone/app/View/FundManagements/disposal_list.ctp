<?php echo $this->element('header'); ?>
<h3>Disposal Requests</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <table border="0" width="100%" cellspacing="5" cellpadding="5" align="left">
                    <tr >
                        
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('id', 'Inv. No.'); ?></b></td>
                       <td style="border-bottom: solid 2px dodgerblue" width="200" align="left"><b><?php echo $this->Paginator->sort('fullname', 'Name'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue;" width="100" align="left"><b><?php echo $this->Paginator->sort('investment_date', 'Inv. Date'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('total_amount', 'Total Amt'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" width="120" align="left"><b><?php echo $this->Paginator->sort('numb_shares', 'Total Shares'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" width="120" align="left"><b><?php echo $this->Paginator->sort('numb_shares_left', ' Shares Left'); ?></b></td>
                       
                        <td style="border-bottom: solid 2px dodgerblue" align="center" style="border-bottom: solid 2px Gray;"><b><?php echo $this->Paginator->sort('status', 'Status'); ?></b></td>

                        <td style="border-bottom: solid 2px dodgerblue;" width="200" align="center" style="border-bottom: solid 2px Gray;"><b>Action</b></td>
                    </tr>
                    <?php if (isset($data)) {
                        foreach ($data as $each_item) { ?>
                    <tr style="border-bottom: solid 1px silver;font-size: 13px;">
                                <td align="left"><?php echo $each_item['Investment']['id']; ?></td>
                                <td align="left"><?php echo (!empty($each_item['Investor']['fullname']) ? $each_item['Investor']['fullname'] : (!empty($each_item['Investor']['company_name']) ? $each_item['Investor']['company_name'] : '' ) );  ?></td>
                            
                                <td align="left"><?php echo $each_item['Investment']['investment_date']; ?></td>
                                <td align="left"><?php echo number_format($each_item['Investment']['total_amount'],2); ?></td>
                                <td align="left"><?php echo $each_item['Investment']['numb_shares']; ?></td>
                                <td align="left"><?php echo $each_item['Investment']['numb_shares_left']; ?></td>
                                
                                <td align="center"><?php echo $each_item['Investment']['status']; ?></td>
                                <td align="center" style="border-bottom: solid 1px Gray;">

                            <?php
                            
                               echo $this->Html->link("Dispose","/FundManagements/disposalRequest/".(isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' )); 
                         ?> </td>
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