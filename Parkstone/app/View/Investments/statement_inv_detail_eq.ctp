<?php
echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');
echo $this->Html->script('print.js');

$shopCurrency = "";
if ($this->Session->check('shopCurrency')) {
    $shopCurrency = $this->Session->read('shopCurrency');
}
?>
<!-- Content starts here -->
<h3>Statement of Equity Investment</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <div>
            <table id="payment_receipt" border="0" width="700px" cellspacing="0" cellpadding="5" align="center" style="border: solid 1px Gray;">

                <tr>
                    <td align="left" valign="top" width="50%" >
                        <?php
                        echo $this->Html->image('parkstone_logo2.png', array('style' => 'float: left; margin-right: 20px;', 'width' => 120, 'alt' => $this->Session->read('shopName')));
                        ?>
                        <p style='font-weight: bold; font-size: 19px; text-align: left; margin-top: 20px;'>
                            <?php
                            echo $this->Session->read('shopName') . '<br />';
                            ?></p>

                    </td>
                    <td align="left" valign="top" width="50%" >
                        <p align="right"><?php echo $this->Session->read('shopAddress') . ', ' . $this->Session->read('shopPosttown') . '<br />' . $this->Session->read('shopPostCity') . ', ' . $this->Session->read('shopPostCount') . '<br />' . $this->Session->read('shopTelephone') . '<br />' . $this->Session->read('shopEmail'); ?></p>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" width="50%" style="border-top: solid 2px Gray;">&nbsp;</td>
                    <td align="left" valign="top" width="50%" style="border-top: solid 2px Gray;">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" valign="top" width="50%">
                        <b style="font-size: 20px; font-weight: bold; display: block; width:90%; height: 100%; background-color: dodgerblue; padding: 10px 10px 10px 10px; text-align: center; border: solid 1px gray; color: #ffffff;">Statement: Equity Investment</b><br />
                        <b style="font-size: 14px;">To: <?php
                            if (isset($investor_name)) {
                                echo $investor_name;
                            }
                            ?></b>
                    </td>
                    <td align="left" valign="top" width="50%">
                        <!--                <b>Warehouse: Warehouse name</b><br></br>-->
                        <b>Investor ID: <?php
                            if (isset($investor_id)) {
                                echo $investor_id;
                            }
                            ?></b><br />

                        <b>Date: </b><?php
                            echo date('jS F,Y');
                            ?>
                    </td>
                </tr>
        <!--        <tr>
                    <td align="left" valign="top" width="50%">&nbsp;</td>
                    <td align="left" valign="top" width="50%">&nbsp;</td>
                </tr>-->
        <!--        <tr>
                    <td align="left" valign="top" width="50%" style="border-top: solid 2px Gray;">&nbsp;</td>
                    <td align="left" valign="top" width="50%" style="border-top: solid 2px Gray;">&nbsp;</td>
                </tr>-->

                <tr>
                    <td align="left" valign="top" colspan="2" style="border-top: solid 2px Gray;">
                        <table width="100%" align="left" cellspacing="0" cellpadding="0" border="0">
                            <tr>
                                <td style="border-bottom: solid 2px dodgerblue" align="left"><b>Equity Name</b></td>
                                <td style="border-bottom: solid 2px dodgerblue" align="center"><b>Purchase Price</b></td>
                                <td style="border-bottom: solid 2px dodgerblue" align="center"><b>Current Price</b></td>
                                <td style="border-bottom: solid 2px dodgerblue" align="center"><b>Gain/Loss</b></td>
                            </tr>
                            <tr>
                                <td  align="left">xxx</td>
                                <td  align="center">xxx</td>
                                <td  align="center">xxx</td>
                                <td  align="center">xxx</td>
                            </tr>
                            <?php 
                            /*
                            if (isset($data)) {
                                foreach ($data as $each_item) {
                                    ?>
                                    <tr>
                                        <td align="left"><?php
                                            if (isset($each_item['DailyInterestStatement']['date'])) {
                                                echo date('M,y', strtotime($each_item['DailyInterestStatement']['date'])); //.",".date('y',$each_item['InvestmentStatement']['maturity_date']);
                                            }
                                            ?></td>
                                        <td align="right"><?php
                                            if (isset($each_item['DailyInterestStatement']['principal'])) {
                                                echo number_format($each_item['DailyInterestStatement']['principal'], 2, '.', ',');
                                            }
                                            ?></td>
                                        <td align="center"><?php
                                            if (isset($each_item['DailyInterestStatement']['interest'])) {
                                                echo $each_item['DailyInterestStatement']['interest'];
                                            }
                                            ?></td>
                                        <td align="right"><?php
                                            if (isset($each_item['DailyInterestStatement']['total'])) {
                                                echo number_format($each_item['DailyInterestStatement']['total'], 2, '.', ',');
                                            }
                                            ?></td>
                                    </tr>

                                    <?php
                                }
                            }
*/
                            if (isset($data_total)) {

                                foreach ($data_total as $each_item):
                                    ?>
                                    <tr>
                                        <td align="left" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">Total</td>
                                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;"><?php
                                            if (isset($each_item[0]['total_principal'])) {
                                                echo $shopCurrency . ' ' . number_format($each_item[0]['total_principal'], 2, '.', ',');
                                            }
                                            ?></td>
                                        <td align="center" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;"><?php
                                            if (isset($each_item[0]['total_interest'])) {
                                                echo $shopCurrency . ' ' . number_format($each_item[0]['total_interest'], 2, '.', ',');
                                            }
                                            ?></td>
                                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;"><?php
                                            if (isset($each_item[0]['sum_total'])) {
                                                echo $shopCurrency . ' ' . number_format($each_item[0]['sum_total'], 2, '.', ',');
                                            }
                                            ?></td>
                                    </tr>
                                    <?php
                                endforeach;
                            }
                            ?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" width="50%" style="border-top: solid 2px Gray;">&nbsp;</td>
                    <td align="left" valign="top" width="50%" style="border-top: solid 2px Gray;">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" valign="top" width="50%">
                        <table width="100%" cellspacing="10" cellpadding="0" border="0">
                            <tr>
                                <td><b align="right">Investment ID:</b></td>
                                <td><span id="xxxxxx"><?php
                                        if (isset($invesmentID)) {
                                            echo $invesmentID;
                                        }
                                        ?></td>
                            </tr>
                            <tr>
                                <td><b align="right">Investment Term:</b></td>
                                <td><span id="xxxxxx"><?php
                                        if (isset($data2['Portfolio']['payment_name'])) {
                                            echo $data2['Portfolio']['payment_name'];
                                        }
                                        ?></span></td>
                            </tr>
                        </table>
                    </td>
                    <td align="left" valign="top" width="50%">
                        <table width="100%" cellspacing="10" cellpadding="0" border="0">
                            <tr>
                                <td><b align="right">Investment Date:</b></td>
                                <td><span id="xxxxxx"><?php
                                        if (isset($data2['Investment']['investment_date'])) {
                                            echo $data2['Investment']['investment_date'];
                                        }
                                        ?></td>
                            </tr>
                            <tr>
                                <td><b align="right">Due Date:</b></td>
                                <td><span id="xxxxxx"><?php
                                        if (isset($data2['Investment']['due_date'])) {
                                            echo $data2['Investment']['due_date'];
                                        }
                                        ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" width="50%" style="border-top: solid 2px Gray;">&nbsp;</td>
                    <td align="left" valign="top" width="50%" style="border-top: solid 2px Gray;">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" valign="top" width="50%">
                        <p><b>Issued by: </b><?php
                            if (isset($issued)) {
                                echo $issued;
                            }
                            ?></p>
                    </td>
                    <td align="right" valign="top" width="50%" >
                        &nbsp;

                    </td>

                </tr>
                <tr>
                    <td align="left" valign="top" width="50%">&nbsp;</td>
                    <td align="left" valign="top" width="50%">
                        &nbsp;
                    </td>
                </tr>
            </table>

            <table border="0" width="700px" cellspacing="0" cellpadding="5" align="center">
                <tr>
                    <td align="left" valign="top" width="50%">&nbsp;</td>
                    <td align="left" valign="top" width="50%">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" width="50%">&nbsp;</td>
                    <td align="right" valign="top" width="50%">
                        <?php
                        echo $this->Html->link('Return', "/Investments/manageClientInvestments" . "/" . (isset($investor_id) ? $investor_id : '' ) . "/" . (isset($investor_name) ? $investor_name : '' ), array("class" => 'btn btn-lg btn-info'));
                        echo $this->Html->link('Print', "javascript:void(0)", array("class" => 'btn btn-lg btn-warning', "id" => "print_receipt"));
// echo $this->Form->button('Print Receipt',array("type" => "submit","class" => "button_red","id"=>"print_receipt"));
                        ?>
                    </td>
                </tr>
            </table>

        </div>
    </div>

    <?php echo $this->element('footer'); ?>
		