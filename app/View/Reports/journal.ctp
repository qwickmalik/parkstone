<?php
echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');
echo $this->Html->script('print.js');
?>
<!-- Content starts here -->
<h3>Journal</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
<p ><i style="font-size: 14px;">Please select the desired period</i></p>

<?php echo $this->Form->create('Journal', array("url" => array('controller' => 'Reports', 'action' => 'journal'))); ?>


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
if (isset($all_transactions)) {
    ?>
    <table id="report_content">
        <tr>
            <td>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php echo $this->Html->image('logo.png', array('style' => 'float: left; margin-right: 20px;')); ?>
                        <p style='font-weight: bold; font-size: 16px; text-align: left;'><?php // echo $setup_results['Setting']['company_name'];      ?>JOURNAL</p>
                        <p align='left'>For the period <?php echo $start_date; ?> to <?php echo $end_date; ?></p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <p align="right"><?php echo $this->Session->read('shopAddress') . ', ' . $this->Session->read('shopPosttown') . '<br />' . $this->Session->read('shopPostCity') . ', ' . $this->Session->read('shopPostCount') . '<br />' . $this->Session->read('shopTelephone') . '<br />' . $this->Session->read('shopEmail'); ?></p>
                    </div>
                </div>   


            <!--<table border="1" cellspacing="0" cellpadding="5" style="border: solid 2px gray;" align="left" width="100%">-->
                <table class="table table-striped">
                    <tr>
                        <td align="left" width="100" style="font-weight: bold;">DATE</td>
                        <td align="left"  width="150" style="font-weight: bold;">ACCOUNT HEADING</td>
                        <td align="left" style="font-weight: bold;">CATEGORY</td>
                        <td align="right" width="150" style="font-weight: bold;">DEBIT (GHS)</td>
                        <td align="right" width="150" style="font-weight: bold;">CREDIT (GHS)</td>
                    </tr>
                    <?php
                    $total_debit = 0;
                    $total_credit = 0;

                    foreach ($all_transactions as $each_item):
                        ?>
                        <tr>
                            <td align="left"><?php echo $each_item['Transaction']['transaction_date']; ?></td>
                            <td align="left"><?php echo $each_item['AccountingHead']['head_name']; ?></td>
                            <td align="left"><?php echo $each_item['TransactionCategory']['category_name']; ?></td>
                            <td align="right" width="150"><?php
                                if ($each_item['Transaction']['debit'] == null || $each_item['Transaction']['debit'] == "") {
                                    echo $each_item['Transaction']['debit'];
                                } else {
                                    echo number_format($each_item['Transaction']['debit'], 2, '.', ',');
                                }
                                ?></td>

                            <td align="right" width="150"><?php
                                if ($each_item['Transaction']['credit'] == null || $each_item['Transaction']['credit'] == "") {
                                    echo $each_item['Transaction']['credit'];
                                } else {
                                    echo number_format($each_item['Transaction']['credit'], 2, '.', ',');
                                }
                                ?></td>
                        </tr>
                        <?php
                        $total_debit += $each_item['Transaction']['debit'];
                        $total_credit += $each_item['Transaction']['credit'];
                    endforeach;
                    ?>

                    <tr style="background: #CDEEFE;">
                        <td align="right" colspan="3" style="font-weight: bold;">TOTALS</td>
                        <td align="right" width="150" style="font-size: 14px; font-weight: bold; text-decoration: underline;"><?php echo number_format($total_debit, 2, '.', ','); ?></td>
                        <td align="right" width="150" style="font-size: 14px; font-weight: bold; text-decoration: underline;"><?php echo '(' . number_format($total_credit, 2, '.', ',') . ')'; ?></td>
                    </tr>

                    <tr>
                        <td align="right" valign="top" colspan="5">
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