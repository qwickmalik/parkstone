<?php
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');
echo $this->Html->script('notification.js');
echo $this->Html->css('template.css');
?>
<div>
    <table id="payment_receipt" border="0" width="700px" cellspacing="0" cellpadding="5" align="center" style="border: solid 1px Gray; background: #ffffff;">
        <?php
        $shopCurrency = "";
        if ($this->Session->check('shopCurrency')) {
            $shopCurrency = $this->Session->read('shopCurrency');
        }
        ?>
        <tr>
            <td align="left" valign="top" colspan="2">
                <div style="float: left; width: auto; height: auto; margin: 0; padding: 10px 100px 10px 10px;">
                    <?php
                    echo $this->Html->image('logo.png');
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
                <b style="font-size: 20px; font-weight: bold; display: block; width:90%; height: 100%; background-color: dodgerblue; padding: 10px 10px 10px 10px; text-align: center; border: solid 1px gray; color: #ffffff;">Equity Disposal Receipt</b><br />
                <b style="font-size: 14px;">To: <?php
                    if (isset($payment['Investor']['fullname'])) {
                        echo $payment['Investor']['fullname'];
                    }
                    ?></b>
            </td>
            <td align="left" valign="top" width="50%">
                <!--                <b>Warehouse: Warehouse name</b><br></br>-->
                <b>Investment No.: <?php
                    if (isset($payment['Investment']['investment_no'])) {
                        echo $payment['Investment']['investment_no'];
                    }
                    ?></b><br></br>
                <b>Date: </b><?php
               if (isset($payment['InvestmentPayment']['payment_date'])) {
                        echo $payment['InvestmentPayment']['payment_date'];
                    }
                ?>
            </td>
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
            <td align="left" valign="top" width="50%">&nbsp;</td>
            <td align="left" valign="top" width="50%">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top" width="50%" style="border-top: solid 2px Gray;">&nbsp;</td>
            <td align="left" valign="top" width="50%" style="border-top: solid 2px Gray;">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top" width="50%">
                <table width="100%" cellspacing="10" cellpadding="0" border="0">

                    <tr>
                        <td><b align="right">Equity:</b></td>
                        <td><span id="xxxxxx"><?php
                                if (isset($investment_name['EquitiesList']['equity_abbrev'])) {
                                    echo $investment_name['EquitiesList']['equity_abbrev'];
                                }
                                ?></span></td>
                    </tr>
                    <tr>
                        <td><b align="right">Purchase Date:</b></td>
                        <td><span id="xxxxxx"><?php
                                if (isset($payment['Investment']['investment_date'])) {
                                    echo $payment['Investment']['investment_date'];
                                }
                                ?></span></td>
                    </tr>
                    <tr>
                        <td><b align="right">Buying Price:</b></td>
                        <td><span id="xxxxxx"><?php
                                if (isset($payment['Investment']['purchase_price'])) {
                                    echo $payment['Investment']['purchase_price'];
                                }
                                ?></span></td>
                    </tr>

                    <tr>
                        <td><b align="right">Selling Price:</b></td>
                        <td><span id="xxxxxx"><?php
                                if (isset($payment['InvestmentPayment']['selling_price'])) {
                                    echo $payment['InvestmentPayment']['selling_price'];
                                }
                                ?></span></td>
                    </tr>

                </table>
            </td>
            <td align="left" valign="top" width="50%">
                <table width="100%" cellspacing="10" cellpadding="0" border="0">
                    <tr>
                        <td><b align="right">Total Equity Sold:</b></td>
                        <td><span id="xxxxxx"><?php
                                if (isset($payment['Investment']['numb_shares_sold'])) {
                                    echo $shopCurrency . ' ' . $payment['Investment']['numb_shares_sold'];
                                }
                                ?></span></td>
                    </tr>
        </tr>
        <tr>
            <td><b align="right">Total Equity Remaining:</b></td>
            <td><span id="xxxxxx"><?php
                    if (isset($payment['Investment']['numb_shares_left'])) {

                        echo $shopCurrency . ' ' . $payment['Investment']['numb_shares_left'];
                    }
                    ?></span></td>
        </tr>
        <tr>
            <td><b align="right">Total Fees:</b></td>
            <td><span id="xxxxxx"><?php
                    if (isset($payment['Investment']['total_fees'])) {

                        echo $shopCurrency . ' ' . $payment['Investment']['total_fees'];
                    }
                    ?></span></td>
        </tr>

        <tr>
            <td><b align="right">Amount Paid:</b></td>
            <td><span id="xxxxxx"><b><?php
                        if (isset($payment_amt)) {
                            echo $shopCurrency . ' ' . $payment_amt;
                        }
                        ?></b></span></td>
        </tr>


    </table>
</td>
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
            echo $this->Html->link('Return', "/Investments/manageEquityInvestments/" . (isset($payment['Investor']['id']) ? $payment['Investor']['id'] : '' ) . "/" . (isset($payment['Investor']['fullname']) ? $payment['Investor']['fullname'] : '' ), array("class" => 'btn btn-lg btn-info',));
            echo $this->Html->link('Print Receipt', "javascript:void(0)", array("class" => 'btn btn-lg btn-warning', "id" => "print_receipt"));
            ?>
        </td>
    </tr>
</table>

</div>