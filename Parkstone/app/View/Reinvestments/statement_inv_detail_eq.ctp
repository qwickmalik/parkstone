<?php
echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js');

if ($this->Session->check('shopCurrency')) {
    $shopCurrency = $this->Session->read('shopCurrency');
} else {
    $shopCurrency = "";
}
?>
<h3>Statement of Equity Investment</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <div class="inner_print">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            &nbsp;
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <?php
                            echo $this->Html->image('parkstone_logo2.png', array('style' => 'float: left; margin-right: 20px;', 'width' => 120, 'alt' => $this->Session->read('shopName')));
                            ?>
                            <p style='font-weight: bold; font-size: 14px; text-align: left;'>
                                <?php
                                echo $this->Session->read('shopName') . '<br />';
                                echo 'CLIENT NAME: ' . (isset($investor_name) ? $investor_name : '') . '<br />';
                                echo 'STATEMENT OF EQUITY INVESTMENT'
                                ?></p>
                            <p align='left'>Generated on <?php echo date('jS F, Y'); ?></p>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <p align="right"><?php echo $this->Session->read('shopAddress') . ', ' . $this->Session->read('shopPosttown') . '<br />' . $this->Session->read('shopPostCity') . ', ' . $this->Session->read('shopPostCount') . '<br />' . $this->Session->read('shopTelephone') . '<br />' . $this->Session->read('shopEmail'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table class="table table-striped">

                        <tr>
                            <td align="left" width="120">Date</td>
                            <td align="left" width="150">Inv. Number</td>
                            <td align="right">Inv. Amount</td>
                            <td align="left">Equity Name</td>
                            <td align="right">Purchase Price</td>
                            <td align="right">Current Price</td>
                            <td align="right">Gain/Loss</td>
                        </tr>
                        <?php
                        if (isset($total)) {
                            foreach ($total as $each_item):
                                ?>
                                <tr>
                                    <td align="left"><?php
                                        if (isset($each_item['InvestorEquity']['purchase_date'])) {
                                            echo date('d-M-Y', strtotime($each_item['InvestorEquity']['purchase_date']));
                                        }
                                        ?></td>
                                    <td align="left"><?php echo $each_item['Investment']['investment_no']; ?></td>
                                    <td align="right"><?php
                                        if (isset($each_item['InvestorEquity']['numb_shares_left']) && isset($each_item['InvestorEquity']['purchase_price'])) {
                                            $inv_amount = $each_item['InvestorEquity']['numb_shares_left'] * $each_item['InvestorEquity']['purchase_price'];
                                            echo number_format($inv_amount, 2);
                                        }
                                        ?></td>
                                    <td align="left"><?php echo $each_item['EquitiesList']['equity_abbrev']; ?></td>
                                    <td align="right"><?php
                                        if (isset($each_item['InvestorEquity']['purchase_price'])) {
                                            echo number_format($each_item['InvestorEquity']['purchase_price'], 2);
                                        }
                                        ?></td>
                                    <td align="right"><?php
                                        if (isset($each_item['EquitiesList']['share_price'])) {
                                            echo number_format($each_item['EquitiesList']['share_price'], 2);
                                        }
                                        ?></td>
                                    <td align="right"><?php
                                        if (isset($each_item['InvestorEquity']['numb_shares_left']) && isset($each_item['EquitiesList']['share_price'])) {
                                            $sale_amount = $each_item['InvestorEquity']['numb_shares_left'] * $each_item['EquitiesList']['share_price'];
                                            $profit_loss = $sale_amount - $inv_amount;
                                            
                                            echo number_format($profit_loss, 2);
                                            
                                        }
                                        ?></td>

                                    <?php
                                endforeach;
                            }
                            ?>

                        <tr>
                            <td align="left" valign="top" ></td>
                            <td align="left" valign="top" >&nbsp;</td>
                            <td align="right" valign="top" >&nbsp;</td>
                            <td align="left" valign="top" > &nbsp;</td>
                            <td align="right" valign="top" >&nbsp;</td>
                            <td align="right" valign="top" >&nbsp;</td>
                            <td align="right" valign="top" >&nbsp;</td>
                        </tr>

                        <tr>
                            <td align="left" colspan="7" style="border-bottom: solid 1px #ffffff;background: #ffffff;"></td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" colspan="3">PARKSTONE OFFICIAL NAME :</td>

                            <td align="left" valign="top" colspan="2">
                                <p><b><?php
                                        if (isset($issued)) {
                                            echo $issued;
                                        }
                                        ?></b></p>
                            </td>
                            <td align="left" valign="top" >&nbsp;</td>
                            <td align="right" valign="top" >&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="left" colspan="10" style="border-bottom: solid 1px #ffffff;background: #ffffff;"></td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" colspan="3">SIGNATURE :</td>

                            <td align="right" valign="top" colspan="2">&nbsp;</td>
                            <td align="left" valign="top" >&nbsp;</td>
                            <td align="right" valign="top" >&nbsp;</td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php
            echo "<p>&nbsp;</p>";
            echo $this->Html->link('Print', "javascript:void(0)", array('style' => 'float: right;', "class" => 'btn btn-lg btn-warning', "id" => "print_receipt"));
            echo $this->Html->link('Return', "/Reinvestments/manageEquityInvestments/".$investor_id."/".$investor_name, array('style' => 'float: right;', 'class' => 'btn btn-lg btn-info'));
            ?>
        </div>
    </div>
    <!-- Content end here -->
    <?php echo $this->element('footer'); ?>

