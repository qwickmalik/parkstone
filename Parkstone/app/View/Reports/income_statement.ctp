<?php
echo $this->element('header');

echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');
echo $this->Html->script('print.js');
?>
<!-- Content starts here -->
<h3>Income Statement</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
<p ><i style="font-size: 14px;">Please select the desired period</i></p>

<?php echo $this->Form->create('IncomeStatement', array("url" => array('controller' => 'Reports', 'action' => 'incomeStatement'))); ?>
<div class="row" style="background: #eaeaea; padding: 10px 0px 5px 0px;">
    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
        <?php echo $this->Form->input('start_date', array('label' => 'Start Date*', 'type' => 'date', 'value' => date('d-m-Y'), 'dateFormat' => 'DMY', 'class' => 'form-control', 'div' => array('class' => 'form-inline'))); ?>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
        <?php echo $this->Form->input('end_date', array('label' => 'End Date*', 'type' => 'date', 'value' => date('d-m-Y'), 'dateFormat' => 'DMY', 'class' => 'form-control', 'div' => array('class' => 'form-inline'))); ?>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <?php echo $this->Form->button('View', array("type" => "submit", "class" => "btn btn-md btn-success")); ?>
    </div>
</div>
<?php echo $this->Form->end(); ?>

<div id="clearer"></div>

<?php
if (isset($income_data) && isset($expense_data)) {
    ?>
    <table id="report_content">
        <tr>
            <td>
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
                            echo 'INCOME STATEMENT for the period '.$start_date. ' to ' . $end_date;
                            ?></p>
                        <p align='left'>Generated on <?php echo date('jS F, Y'); ?></p>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <p align="right"><?php echo $this->Session->read('shopAddress') . ', ' . $this->Session->read('shopPosttown') . '<br />' . $this->Session->read('shopPostCity') . ', ' . $this->Session->read('shopPostCount') . '<br />' . $this->Session->read('shopTelephone') . '<br />' . $this->Session->read('shopEmail'); ?></p>
                    </div>
                
                </div>



                <table class="table table-striped">
                    <tr>
                        <td align="left">&nbsp;</td>
                        <td align="right" width="150" style="font-weight: bold;">DEBIT (GHS)</td>
                        <td align="right" width="150" style="font-weight: bold;" >CREDIT (GHS)</td>
                    </tr>
                    <tr>
                        <td align="left" colspan="3" style="font-weight: bold; background: #eaeaea;">REVENUE</td>
                    </tr>
                    <?php
                    $total_income = 0;
                    foreach ($income_data as $each_item):
                        ?>
                        <tr>
                            <td align="left"><?php echo $each_item['TransactionCategory']['category_name']; ?></td>
                            <td align="right" width="150"></td>
                            <td align="right" width="150"><?php echo number_format($each_item[0]['sum_amount'], 2, '.', ','); ?></td>

                        </tr>
                        <?php
                        $total_income += $each_item[0]['sum_amount'];
                    endforeach;
                    ?>
                    <tr>
                        <td align="right" style="font-weight: bold;">Total Income</td>
                        <td align="right" width="150"></td>
                        <td align="right" width="150" style="font-weight: bold; text-decoration: underline;"><?php echo number_format($total_income, 2, '.', ','); ?></td>

                    </tr>
                    <tr>
                        <td align="left" colspan="3" style="font-weight: bold; background: #eaeaea;">EXPENSES</td>
                    </tr>
                    <?php
                    $total_expense = 0;
                    foreach ($expense_data as $each_item):
                        ?>
                        <tr>
                            <td align="left"><?php echo $each_item['TransactionCategory']['category_name']; ?></td>
                            <td align="right" width="150"><?php echo number_format($each_item[0]['sum_amount'], 2, '.', ','); ?></td>
                            <td align="right" width="150"></td>
                        </tr>
                        <?php
                        $total_expense += $each_item[0]['sum_amount'];
                    endforeach;
                    ?>
                    <tr>
                        <td align="right" style="font-weight: bold;">Total Expenses</td>
                        <td align="right" width="150" style="font-weight: bold; text-decoration: underline;"><?php echo number_format($total_expense, 2, '.', ','); ?></td>
                        <td align="right" width="150"></td>
                    </tr>
                    <tr style="background: #CDEEFE;">
                        <td align="right" style="font-weight: bold;">NET INCOME</td>
                        <td align="right" width="150"></td>
                        <td  align="right" width="150" style="font-size: 14px; font-weight: bold; text-decoration: underline;"><?php
                            $net_income = $total_income - $total_expense;
                            if ($net_income >= 0) {
                                echo number_format($net_income, 2, '.', ',');
                            } else {
                                echo '(' . number_format($net_income, 2, '.', ',') . ')';
                            }
                            ?></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top" colspan="3">
                            <p style="font-style: italic;">Generated on <?php echo date('d-m-Y'); ?></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <?php
    echo "<p>&nbsp;</p>";
    echo $this->Html->link('Print', "javascript:void(0)", array("class" => 'btn btn-md btn-danger', "id" => "print_report", 'style' => 'float: right;'));
    echo $this->Html->link('Return', "/Reports/", array('style' => 'float: right;', 'class' => 'btn btn-md btn-info'));
}
?>
<div id="clearer"></div>
<div id="clearer"></div>
</div>
<!-- Content ends here -->

<!-- Footer starts here -->
<?php echo $this->element('footer'); ?>
<!-- Footer starts here -->