<h3>Payments: Maturity List</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table border="1" cellspacing="" cellpadding="3" width="100%" align="left" style="border: solid 2px gray;">
                    <tr>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Client Code</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Name</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Investment No.</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Investment Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Investment Period</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Maturity Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Principal Amt.</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Interest Rate</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Interest</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Maturity Amt.</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Instructions A/c</b></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">21000</td>
                        <td align="left" valign="top">Adwoa Serwaa</td>
                        <td align="left" valign="top">LC/02/13/0002</td>
                        <td align="right" valign="top">01/02/2013</td>
                        <td align="right" valign="top">365</td>
                        <td align="right" valign="top">01/02/2014</td>
                        <td align="right" valign="top">2,000.00</td>
                        <td align="right" valign="top">22%</td>
                        <td align="right" valign="top">220.00</td>
                        <td align="right" valign="top">2,220.00</td>
                        <td align="left" valign="top">ROLL</td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">21001</td>
                        <td align="left" valign="top">Kofi Mensah</td>
                        <td align="left" valign="top">LC/02/13/0003</td>
                        <td align="right" valign="top">01/08/2013</td>
                        <td align="right" valign="top">182</td>
                        <td align="right" valign="top">01/02/2014</td>
                        <td align="right" valign="top">10,000.00</td>
                        <td align="right" valign="top">22%</td>
                        <td align="right" valign="top">1,100.00</td>
                        <td align="right" valign="top">11,100.00</td>
                        <td align="left" valign="top">REFUND</td>
                    </tr>
                </table>
                <table border="0" width="100%" cellspacing="5" cellpadding="5" align="left">
                    <tr>
                        <td style="border-bottom: solid 2px dodgerblue;" width="90" align="left"><b><?php echo $this->Paginator->sort('id', 'Client Code'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('fullname', 'Name'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('investment_no', 'Inv. No.'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('investment_date', 'Inv. Date'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('investment_term_id', 'Inv. Period'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('due_date', 'Maturity Date'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('investment_amount', 'Principal Amt.'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('custom_rate', 'Int. Rate'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('interest_earned', 'Interest'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('amount_due', 'Maturity Amt.'); ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue;" align="left"><b>Instructions</b></td>
                    </tr>
                    <?php if (isset($data)) {
                        foreach ($data as $each_item) { ?>
                    <tr style="border-bottom: solid 1px silver;">
                                <td align="left"><?php echo $each_item['Investor']['id']; ?></td>
                                <td align="left"><?php echo $each_item['Investor']['fullname']; ?></td>
                                <td align="left"><?php echo $each_item['Investment']['investment_no']; ?></td>
                                <td align="left"><?php echo $each_item['Investment']['investment_date']; ?></td>
                                <td align="left"><?php echo $each_item['InvestmentTerm']['period']; ?></td>
                                <td align="left"><?php echo $each_item['Investment']['due_date']; ?></td>
                                <td align="left"><?php echo $each_item['Investment']['investment_amount']; ?></td>
                                <td align="left"><?php echo $each_item['Investment']['custom_rate']; ?></td>
                                <td align="left"><?php echo $each_item['Investment']['interest_earned']; ?></td>
                                <td align="left"><?php echo $each_item['Investment']['amount_due']; ?></td>
                                <td align="left"><?php echo $this->Html->Link('Active Investments', '/Investments/statementActiveInv', array('escape' => false)); ?> | <?php echo $this->Html->Link('All Investments', '/Investments/statementAllInv', array('escape' => false)); ?></td>
                            </tr>
    <?php }
} ?>

                    <tr>
                        <td colspan="6" align="right">
<?php //echo $this->Form->end();
?>
                        </td>
                    </tr>
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

                </table>
            </div>
            <?php
//            echo "<p>&nbsp;</p>";
//            echo $this->Html->link('Print', "javascript:void(0)", array('style' => 'float: right;', "class" => 'btn btn-lg btn-warning', "id" => "print_receipt"));
//            echo $this->Html->link('Return', "/Reports/", array('style' => 'float: right;', 'class' => 'btn btn-lg btn-info'));
            ?>
        </div>
        <!-- Content end here -->
