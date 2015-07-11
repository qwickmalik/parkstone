<?php
echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');
echo $this->Html->script('print.js');
?>
<!-- Content starts here -->
<h2>Statement of Owners Equity</h2>
<p ><i style="font-size: 14px;">Please select the desired period</i></p>

<?php echo $this->Form->create('OwnersEquity', array("url" => array('controller' => 'Reports', 'action' => 'ownersEquity'))); ?>
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
if (isset($income_data) && isset($expense_data) && isset($oe_investment) && isset($oe_withdrawal)) {
    ?>
    <table id="report_content">
        <tr>
            <td>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php echo $this->Html->image('logo.png', array('style' => 'float: left; margin-right: 20px;')); ?>
                        <p style='font-weight: bold; font-size: 16px; text-align: left;'><?php // echo $setup_results['Setting']['company_name'];    ?>STATEMENT OF OWNERS EQUITY</p>
                        <p align='left'>For the period <?php echo $start_date; ?> to <?php echo $end_date; ?></p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <p align="right"><?php echo $this->Session->read('shopAddress') . ', ' . $this->Session->read('shopPosttown') . '<br />' . $this->Session->read('shopPostCity') . ', ' . $this->Session->read('shopPostCount') . '<br />' . $this->Session->read('shopTelephone') . '<br />' . $this->Session->read('shopEmail'); ?></p>
                    </div>
                </div>



                <table class="table table-striped">
                    <tr>
                        <td align="left">&nbsp;</td>
                        <td align="right" width="150" style="font-weight: bold;">GHS</td>
                    </tr>
                    <?php
                    $oe_inv = 0;
                    $oe_i_empty = array_filter($oe_investment);
                    if (!empty($oe_i_empty)) {
                        foreach ($oe_investment as $each_item):
                            ?>
                            <tr>
                                <td align="left"><?php echo 'Owner Investment'; ?></td>
                                <td align="right" width="150"><?php echo number_format($each_item[0]['sum_credit'], 2, '.', ','); ?></td>
                            </tr> 
                            <?php
                            $oe_inv += $each_item[0]['sum_credit'];
                        endforeach;
                        ?>
                        <?php
                    }
                    else {
                        ?>
                        <tr>
                            <td align="left"><?php echo 'Owner Investment'; ?></td>
                            <td align="right" width="150"><?php echo '(' . number_format('0', 2, '.', ',') . ')'; ?></td>
                        </tr> 
                        <?php
                    }


                    $total_income = 0;
                    foreach ($income_data as $each_item):
                        $total_income += $each_item[0]['sum_amount'];
                    endforeach;


                    $total_expense = 0;
                    foreach ($expense_data as $each_item):
                        $total_expense += $each_item[0]['sum_amount'];
                    endforeach;

                    $net_income = $total_income - $total_expense;
                    $sub_total = $net_income + $oe_inv;
                    ?>

                    <tr>
                        <td align="right">&Tab;Net Income</td>
                        <td align="right" width="150"><?php echo number_format($net_income, 2, '.', ','); ?></td>
                    </tr>
                    <tr>
                        <td align="right" >&Tab;&Tab;Sub Total</td>
                        <td align="right" width="150" style="font-weight: bold; text-decoration: underline;"><?php echo number_format($sub_total, 2, '.', ','); ?></td>
                    </tr>


                    <?php
                    $oe_exp = 0;
                    $oe_w_empty = array_filter($oe_withdrawal);
                    if (!empty($oe_w_empty)) {
                        foreach ($oe_withdrawal as $each_item):
                            ?>
                            <tr>
                                <td align="left"><?php echo 'Owner Withdrawal'; ?></td>
                                <td align="right" width="150"><?php echo '(' . number_format($each_item[0]['sum_debit'], 2, '.', ',') . ')'; ?></td>
                            </tr> 
                            <?php
                            $oe_exp += $each_item[0]['sum_debit'];
                        endforeach;
                        ?>
                        <?php
                    }

                    else {
                        ?>
                        <tr>
                            <td align="left"><?php echo 'Owner Withdrawal'; ?></td>
                            <td align="right" width="150"><?php echo '(' . number_format('0', 2, '.', ',') . ')'; ?></td>
                        </tr> 
                        <?php
                    }
                    ?>
                    <tr>
                        <td align="right" style="font-weight: bold;">OWNERS EQUITY </td>
                        <td align="right" width="150" style="font-size: 14px; font-weight: bold; text-decoration: underline;"><?php echo number_format($sub_total - $oe_exp, 2, '.', ','); ?></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top" colspan="2">
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

<!-- Sidebar starts here -->
<div id="sidebar_reports">
    <?php
    echo $this->element('logo');
    echo $this->element('reports_sidebar');
    ?>
</div>
<!-- Sidebar starts here -->
<!-- Footer starts here -->
<?php echo $this->element('footer'); ?>
<!-- Footer starts here -->