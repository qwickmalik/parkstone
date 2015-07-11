<?php
echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');
echo $this->Html->script('print.js');
?>
<!-- Content starts here -->
<h3>Aggregate Indebtedness</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

<p ><i style="font-size: 14px;">Please select the desired period</i></p>

<?php echo $this->Form->create('BalanceSheet', array("url" => array('controller' => 'Reports', 'action' => 'balanceSheet'))); ?>

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
if (isset($asset_data) && isset($liability_data)) {
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
                            echo 'AGGREGATE INDEBTEDNESS as at '.$statement_date;
                            ?></p>
                        <p align='left'>Generated on <?php echo date('jS F, Y'); ?></p>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <p align="right"><?php echo $this->Session->read('shopAddress') . ', ' . $this->Session->read('shopPosttown') . '<br />' . $this->Session->read('shopPostCity') . ', ' . $this->Session->read('shopPostCount') . '<br />' . $this->Session->read('shopTelephone') . '<br />' . $this->Session->read('shopEmail'); ?></p>
                    </div>
                
                </div>



                    <!--<table border="1" cellspacing="0" cellpadding="5" style="border: solid 2px gray;" align="left" width="100%">-->
                <table class="table table-striped">
                    <tr>
                        <td align="left">&nbsp;</td>
                        <td align="right" width="150" style="font-weight: bold;">GHS</td>
                    </tr>
                    <tr>
                        <td align="left" colspan="2" style="font-weight: bold; background: #eaeaea;">ASSETS</td>
                    </tr>
                    <?php
                    $total_assets = 0;
                    foreach ($asset_data as $each_item):
                        ?>
                        <tr>
                            <td align="left"><?php echo $each_item['TransactionCategory']['category_name']; ?></td>
                            <td align="right" width="150"><?php
                                $net_asset = $each_item[0]['sum_debit'] - $each_item[0]['sum_credit'];
                                echo number_format($net_asset, 2, '.', ',');
                                ?></td>
                        </tr>
                        <?php
                        $total_assets += $net_asset;
                    endforeach;
                    ?>
                    <?php
                    $total_accu_depre = 0;
                    foreach ($accu_depre as $each_item):
                        ?>
                        <tr>
                            <td align="left"><?php echo $each_item['TransactionCategory']['category_name']; ?></td>
                            <td align="right" width="150"><?php
                                $net_accu_depre = $each_item[0]['sum_debit'] - $each_item[0]['sum_credit'];
                                echo '(' . number_format($net_accu_depre, 2, '.', ',') . ')';
                                ?></td>
                        </tr>
                        <?php
                        $total_accu_depre += $net_accu_depre;
                    endforeach;

                    $grand_total_assets = ($total_assets - $total_accu_depre);
                    ?>
                    <tr>
                        <td align="right" style="font-weight: bold; background: #CDEEFE;">TOTAL ASSETS</td>
                        <td align="right" width="150" style="font-size: 14px; font-weight: bold; text-decoration: underline; background: #CDEEFE;"><?php echo number_format($grand_total_assets, 2, '.', ','); ?></td>
                    </tr>
                    <tr>
                        <td align="left" colspan="2" style="font-weight: bold; background: #eaeaea;">CURRENT & LONG-TERM LIABILITIES</td>
                    </tr>
                    <?php
                    $total_liabilities = 0;
                    foreach ($liability_data as $each_item):
                        ?>
                        <tr>
                            <td align="left"><?php echo $each_item['TransactionCategory']['category_name']; ?></td>
                            <td align="right" width="150"><?php
                                $net_liability = $each_item[0]['sum_credit'] - $each_item[0]['sum_debit'];
                                echo number_format($net_liability, 2, '.', ',');
                                ?></td>
                        </tr>
                        <?php
                        $total_liabilities += $net_liability;
                    endforeach;
                    ?>
                    <tr>
                        <td align="right" style="font-weight: bold;">Total Current & Long-term Liabilities</td>
                        <td align="right" width="150" style="font-weight: bold; text-decoration: underline;"><?php echo number_format($total_liabilities, 2, '.', ','); ?></td>
                    </tr>
                    <tr>
                        <td align="left" colspan="2" style="font-weight: bold; background: #eaeaea;">OWNER EQUITY</td>
                    </tr>
                    <?php
                    $oe = 0;
                    $oe_i_empty = array_filter($oe_data);
                    if (!empty($oe_i_empty)) {
                        foreach ($oe_data as $each_item):
                            ?>
                            <tr>
                                <td align="left"><?php echo $each_item['TransactionCategory']['category_name']; ?></td>
                                <td align="right" width="150"><?php
                                    $net_oe = $each_item[0]['sum_credit'] - $each_item[0]['sum_debit'];
                                    echo number_format($net_oe, 2, '.', ',');
                                    ?></td>
                            </tr> 
                            <?php
                            $oe += $net_oe;
                        endforeach;
                        ?>
                        <?php
                    }

                    else {
                        ?>
                        <tr>
                            <td align="left"><?php echo 'Owner Equity'; ?></td>
                            <td align="right" width="150"><?php echo '(' . number_format('0', 2, '.', ',') . ')'; ?></td>
                        </tr> 
                        <?php
                    }

                    $grand_total_liabilities = $total_liabilities + $oe;
                    ?>
                    <tr>
                        <td align="right" style="font-weight: bold;">Total Owner Equity</td>
                        <td align="right" width="150" style="font-weight: bold; text-decoration: underline;"><?php echo number_format($oe, 2, '.', ','); ?></td>
                    </tr>
                    <tr>
                        <td align="right" style="font-weight: bold; background: #CDEEFE;">TOTAL LIABILITIES</td>
                        <td align="right" width="150" style="font-size: 14px; font-weight: bold; text-decoration: underline; background: #CDEEFE;"><?php echo number_format($grand_total_liabilities, 2, '.', ','); ?></td>
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
    <div id="clearer"></div>
    <?php
    echo "<p>&nbsp;</p>";
    echo $this->Html->link('Print', "javascript:void(0)", array("class" => 'btn btn-md btn-danger', "id" => "print_report", 'style' => 'float: right;'));
    echo $this->Html->link('Return', "/Reports/", array('style' => 'float: right;', 'class' => 'btn btn-md btn-info'));
}
?>
<div id="clearer"></div>
</div>
<!-- Content ends here -->

<!-- Footer starts here -->
<?php echo $this->element('footer'); ?>
<!-- Footer starts here -->