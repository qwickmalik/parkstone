<?php echo $this->element('header'); ?>
<?php
echo $this->Html->script('jquery.printElement.js');
//
?>
<h3>Statement of All Investments</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <table id="payment_receipt" border="0" width="700px" cellspacing="0" cellpadding="5" align="center" style="border: 0;">
            <?php
            $shopCurrency = "";
            if ($this->Session->check('shopCurrency')) {
                $shopCurrency = $this->Session->read('shopCurrency');
            }
            ?>
            <tr>
                <td align="left" valign="top" colspan="2">
                    <div style="float: left; width: auto; height: auto; margin: 0; padding: 10px 100px 10px 10px;">
                        <?php echo $this->Html->image('logo.png');
                        ;
                        ?>
                    </div>
                    <div style="font-weight: bold;">
                        <p style="font-size: 25px;"><?php
                            if ($this->Session->check('shopName')) {
                                $shopName = $this->Session->read('shopName');
                                echo $shopName;
                            }
                            ?></p>
                        <p><?php
                            $postaladd = 'Postal Address: ';

                            if ($this->Session->check('shopAddress')) {
                                $shopAddress = $this->Session->read('shopAddress');
                                $postaladd .=$shopAddress;
                                if ($this->Session->check('shopPosttown')) {
                                    $shopPosttown = $this->Session->read('shopPosttown');

                                    // $postaladd .= ', '.$shopPosttown;
                                }
                                if ($this->Session->check('shopPostCity')) {
                                    $shopPostCity = $this->Session->read('shopPostCity');
                                    $postaladd .= ', ' . $shopPostCity;
                                }
                                if ($this->Session->check('shopPostCount')) {
                                    $shopPostCount = $this->Session->read('shopPostCount');
                                    $postaladd .= ', ' . $shopPostCount;
                                }
                                echo $postaladd;
                            }
                            ?></p>
                        <p><?php
                            if ($this->Session->check('shopMobile')) {
                                $shopMobile = $this->Session->read('shopMobile');

                                echo 'Mobile Phone: ' . $shopMobile;
                            }
                            ?></p>
                    </div>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top" width="50%" style="border-top: solid 2px Gray;">&nbsp;</td>
                <td align="left" valign="top" width="50%" style="border-top: solid 2px Gray;">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="top" width="50%">
                    <b style="font-size: 20px; font-weight: bold; display: block; width:90%; height: 100%; background-color: dodgerblue; padding: 10px 10px 10px 10px; text-align: center; border: solid 1px gray; color: #ffffff;">Statement of All Investments</b><br />
                    <b style="font-size: 14px;">To: <?php
                        if (isset($payment['Investor']['fullname']) && !empty($payment['Investor']['fullname'])) {
                            echo $payment['Investor']['fullname'];
                        } elseif (isset($payment['Investor']['comp_name']) && !empty($payment['Investor']['comp_name'])) {
                            echo $payment['Investor']['comp_name'];
                        }
                        ?></b>
                </td>
                <td align="left" valign="top" width="50%">
                    <!--                <b>Warehouse: Warehouse name</b><br></br>-->
                    <b>Investor ID: <?php
                        if (isset($payment['Investor']['id'])) {
                            echo $payment['Investor']['id'];
                        }
                        ?></b><br></br>
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
                            <td style="border-bottom: solid 2px dodgerblue;" width="30" align="left"><b>ID<?php // echo $this->Paginator->sort('id', 'ID');   ?></b></td>
                            <td style="border-bottom: solid 2px dodgerblue" align="right"><b>Inv. Product<?php //echo $this->Paginator->sort('cost_price', 'Total Cost Price');   ?></b></td>
                            <td style="border-bottom: solid 2px dodgerblue" align="right"><b>Inv. Date<?php // echo $this->Paginator->sort('date', 'Supply Date');   ?></b></td>
                            <td style="border-bottom: solid 2px dodgerblue" align="right"><b>Inv. Amount/Total Amount<?php //echo $this->Paginator->sort('cost_price', 'Total Cost Price');   ?></b></td>
                            <!--<td style="border-bottom: solid 2px dodgerblue" align="right"><b>Total Fees<?php //echo $this->Paginator->sort('cost_price', 'Total Cost Price');   ?></b></td>-->
                            <td style="border-bottom: solid 2px dodgerblue" align="center"><b>Rate (%)</b></td>
                            <td style="border-bottom: solid 2px dodgerblue" align="right"><b>Due Date<?php //echo $this->Paginator->sort('balance', 'Balance');   ?></b></td>
                            <td style="border-bottom: solid 2px dodgerblue" align="right"><b>Amount Due<?php //echo $this->Paginator->sort('cost_price', 'Total Cost Price');  ?></b></td>
                            <td style="border-bottom: solid 2px dodgerblue" align="right"><b>Status<?php //echo $this->Paginator->sort('cost_price', 'Total Cost Price'); ?></b></td>

                        </tr>

                                <?php if (isset($data)) {
                                    foreach ($data as $each_item) { ?>
                                <tr>
                                    <td align="left"><?php
                                        if (isset($each_item['Investment']['id'])) {
                                            echo $each_item['Investment']['id']; //.",".date('y',$each_item['InvestmentStatement']['maturity_date']);
                                        }
                                        ?></td>
                                    <td align="right"><?php
                                        if (isset($each_item['Investment']['investment_product_id'])) {
                                            echo $each_item['InvestmentProduct']['product_name']; //.",".date('y',$each_item['InvestmentStatement']['maturity_date']);
                                        }
                                        ?></td>
                                    <td align="right"><?php
                                        if (isset($each_item['Investment']['investment_date'])) {
                                            echo $each_item['Investment']['investment_date']; //.",".date('y',$each_item['InvestmentStatement']['maturity_date']);
                                        }
                                        ?></td>
                                    <td align="center"><?php
                                        if (isset($each_item['Investment']['investment_amount']) && !empty($each_item['Investment']['investment_amount']) && $each_item['Investment']['investment_amount'] > 0) {
                                            echo number_format($each_item['Investment']['investment_amount'], 2, '.', ',');
                                        } elseif (isset($each_item['Investment']['total_amount']) && !empty($each_item['Investment']['total_amount'])) {
                                            echo number_format($each_item['Investment']['total_amount'], 2, '.', ',');
                                        }
                                        ?></td>
            <!--                        <td align="right"><?php
//                        if(isset($each_item['Investment']['total_fees'])){
//                            echo number_format($each_item['Investment']['total_fees'], 2, '.', ',');
//                        }
                                        ?></td>-->
                                    <td align="center"><?php
                                        if (isset($each_item['Investment']['custom_rate']) && $each_item['Investment']['custom_rate'] > 0) {
                                            echo $each_item['Investment']['custom_rate'] . '%';
                                        }
//   elseif(isset($each_item['Portfolio']['interest_rate'])){ echo $each_item['Portfolio']['interest_rate'].'%';
//} 
                                        ?></td>
                                    <td align="right"><?php
                                        if (isset($each_item['Investment']['due_date'])) {
                                            echo $each_item['Investment']['due_date'];
                                        }
                                        ?></td>
                                    <td align="right"><?php
                                        if (isset($each_item['Investment']['amount_due'])) {
                                            echo number_format($each_item['Investment']['amount_due'], 2, '.', ',');
                                        }
                                        ?></td>
                                    <td align="right"><?php
                                        if (isset($each_item['Investment']['status'])) {
                                            echo $each_item['Investment']['status'];
                                        }
                                        ?></td>
                                </tr>

    <?php }
} ?> 
                    </table>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top" width="50%" style="border-top: solid 2px Gray;">&nbsp;</td>
                <td align="left" valign="top" width="50%" style="border-top: solid 2px Gray;">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="top" width="50%">&nbsp;</td>
                <td align="left" valign="top" width="50%">&nbsp;</td>
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
    echo $this->Html->link('Return', "/Investments/manageInvestments", array("class" => 'btn btn-info'));
    echo $this->Html->link('Print Receipt', "javascript:void(0)", array("class" => 'btn btn-warning', "id" => "print_receipt"));
// echo $this->Form->button('Print Receipt',array("type" => "submit","class" => "button_red","id"=>"print_receipt"));
    ?>
                </td>
            </tr>
        </table>
    </div>

<?php echo $this->element('footer'); ?>