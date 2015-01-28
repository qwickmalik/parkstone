<?php

echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');
echo $this->Html->script('notification.js');

$shopCurrency = "GH$";
if ($this->Session->check('shopCurrency_investment')) {
    $shopCurrency = $this->Session->read('shopCurrency_investment');
}
?>

<h3>New Investment Certificate</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

<?php 
    //FIXED INCOME CERTIFICATE STARTS HERE
    if (isset($investment_array_fixed['Investment']['investment_product_id']) && $investment_array_fixed['Investment']['investment_product_id'] == 1 || $investment_array_fixed['Investment']['investment_product_id'] == 3) {
        ?>
        <table id="payment_receipt1" border="0" width="700px" cellspacing="0" cellpadding="5" align="center" style="border: solid 15px Navy;">
            <?php
            $shopCurrency = "";
            if ($this->Session->check('shopCurrency')) {
                $shopCurrency = $this->Session->read('shopCurrency');
            }
            ?>
            <tr>
                <td align="center" valign="top" colspan="2">

                    <div style="font-weight: bold;">
                        <?php echo $this->Html->image('parkstone_logo.png', array('width' => '100')); ?>
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
                <td align="left" valign="top" width="50%">&nbsp;</td>
                <td align="left" valign="top" width="50%">&nbsp;</td>
            </tr>
            <tr>
                <td align="center" valign="top" colspan="2">
                    <h1 style="color: Navy;">Investment Certificate</h1><br />
                    <?php
                    if (isset($investors)) {
                        foreach ($investors as $investor):
                            ?><b style="font-size: 18px;"><br /><i style="color: Navy;"><?php
                            if (isset($investor['other_names'])) {
                                echo $investor['other_names'] . ' ';
                            } else {
                                echo '';
                            } if (isset($investor['surname'])) {
                                echo $investor['surname'];
                            } else {
                                echo '';
                            }
                            ?></i></b>

                        <?php
                        if(!isset($investor['joint_surname']) && !empty($investor['joint_surname'])){
                           ?>
                    <b style="font-size: 18px;"><br /><i style="color: Navy;">
                    <?php
                            if (isset($investor['joint_other_names'])) {
                                echo $investor['joint_other_names'] . ' ';
                            } else {
                                echo '';
                            } if (isset($investor['joint_surname'])) {
                                echo $investor['joint_surname'];
                            } else {
                                echo '';
                            }
                            ?>

                        </i></b>
                    <?php
                        if(!isset($investor['in_trust_for']) && !empty($investor['in_trust_for'])){
                           ?>
                    <br /><b style="font-size: 18px;">In Trust For: <i style="color: Navy;">
                    <?php
                            if (isset($investor['in_trust_for'])) {
                                echo $investor['in_trust_for'] . ' ';
                            } else {
                                echo '';
                            } 
                            ?>

                        </i></b>
                    <?php
                        }
                        }
                        endforeach;
                    }
                    ?>
                    <br />
                    <b>Investment No:  <?php
                        if (isset($investment_number)) {
                            echo $investment_number;
                        }
                        ?></b><br />
                    <?php if (isset($investment_array_fixed['Investment']['investment_date'])) { ?> <b>Date: </b>
                        <?php echo $investment_array_fixed['Investment']['investment_date']; ?>
                    <?php } elseif (isset($investment_array_fixed['Investment']['purchase_date'])) { ?>
                    <b>Purchase Date: </b>
                        <?php
                        echo $investment_array_fixed['Investment']['purchase_date'];
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top" width="50%">&nbsp;</td>
                <td align="left" valign="top" width="50%">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="top" width="50%" >&nbsp;</td>
                <td align="left" valign="top" width="50%" >&nbsp;</td>
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
                            <td><b align="right">Investment Term:</b></td>
                            <td><span id="xxxxxx">
                                            <?php
                                            if (isset($investment_array_fixed['InvestmentTerm']['term_name'])) { 
                                            echo $investment_array_fixed['InvestmentTerm']['term_name'];
                                            }  ?>
                                </span></td> 
                        </tr> 
                        <tr>
                                        <?php if (isset($investment_array_fixed['Investment']['custom_rate'])) { ?><td><b align="right"> Investment Rate:</b></td>
                            <td><span id="xxxxxx"><?php
                                            echo $investment_array_fixed['Investment']['custom_rate'] . '%';
                                            ?></span></td> <?php } ?>
                        </tr>

                    </table>
                </td>
                <td align="left" valign="top" width="50%">
                    <table width="100%" cellspacing="10" cellpadding="0" border="0">
                        <tr>
                            <td><b align="right">Amount Invested:</b></td>
                            <td><span id="xxxxxx"><?php
                                        if (isset($investment_array_fixed['Investment']['investment_amount'])) {
                                            if ($investment_array_fixed['Investment']['status'] == 'Rollover') {
                                                echo $shopCurrency . ' ' . $rollover_details['amount'];
                                            } else {

                                                echo $shopCurrency . ' ' . $investment_array_fixed['Investment']['investment_amount'];
                                            }
                                        }
                                        ?></span></td>
                        </tr>

                        <tr>
                            <td><b align="right">Amount Due:</b></td>
                            <td><span id="xxxxxx"><b>
                                            <?php
                                            if (isset($investment_array_fixed['Investment']['amount_due'])) {
                                                echo $shopCurrency . ' ' . $investment_array_fixed['Investment']['amount_due'];
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
                    <p><b>Issued by: </b> 
                        <?php
if (isset($issued)) {
    echo $issued;
}
?></p>
                </td>
                <td align="left" valign="top" width="50%">

                </td>
            </tr>
            <tr>
                <td align="left" valign="top" colspan="2">
                    <p ><b>TERMS AND CONDITIONS</b></p>
                    <ol style="font-size: 10px;">
                        <li>Payment of principal, interest or proceeds shall be effected based on specific instructions provided at time product is chosen, and payment shall be made following satisfactory identification of investment holder.</li>
                        <li>Additions or amendments to instructions may be noted, agreed upon and documented as appropriate, and shall be effective following documentation. Instructions may be received and accepted via email, from a recognized email address.</li>
                        <li>All investments must run until the agreed term expires.</li>
                        <li>Please provide a valid identification document (photocopy to be kept by Parkstone), details of which have been indicated on form.</li>
                    </ol>
                </td>

            </tr>
        </table>
        <?php 
        } 
        //FIXED INCOME ENDS HERE
        ?>

        <p>&nbsp;</p>


        <?php
        //EQUITY CERTIFICATE STARTS HERE
        
        if (isset($investment_array_equity['Investment']['investment_product_id']) && $investment_array_equity['Investment']['investment_product_id'] == 2 || $investment_array_equity['Investment']['investment_product_id'] == 3) {
        ?>
        <table id="payment_receipt2" border="0" width="700px" cellspacing="0" cellpadding="5" align="center" style="border: solid 15px Navy;">
            <?php
            $shopCurrency = "";
            if ($this->Session->check('shopCurrency')) {
                $shopCurrency = $this->Session->read('shopCurrency');
            }
            ?>
            <tr>
                <td align="center" valign="top" colspan="2">

                    <div style="font-weight: bold;">
                        <?php echo $this->Html->image('parkstone_logo.png', array('width' => '100')); ?>
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
                <td align="left" valign="top" width="50%">&nbsp;</td>
                <td align="left" valign="top" width="50%">&nbsp;</td>
            </tr>
            <tr>
                <td align="center" valign="top" colspan="2">
                    <h1 style="color: Navy;">Equity Investment Certificate</h1><br />
                    <?php
                    if (isset($investors)) {
                        foreach ($investors as $investor):
                            ?><b style="font-size: 18px;"><br /><i style="color: Navy;"><?php
                            if (isset($investor['surname'])) {
                                echo $investor['surname'] . ' ';
                            } else {
                                echo '';
                            } if (isset($investor['other_names'])) {
                                echo $investor['other_names'];
                            } else {
                                echo '';
                            }
                            ?></i></b>

                        <?php
                        if(!isset($investor['joint_surname']) && !empty($investor['joint_surname'])){
                           ?>
                    <b style="font-size: 18px;"><br /><i style="color: Navy;">
                    <?php
                            if (isset($investor['joint_surname'])) {
                                echo $investor['joint_surname'] . ' ';
                            } else {
                                echo '';
                            } if (isset($investor['joint_other_names'])) {
                                echo $investor['joint_other_names'];
                            } else {
                                echo '';
                            }
                            ?>

                        </i></b>
                    <?php
                        if(!isset($investor['in_trust_for']) && !empty($investor['in_trust_for'])){
                           ?>
                    <br /><b style="font-size: 18px;">In Trust For: <i style="color: Navy;">
                    <?php
                            if (isset($investor['in_trust_for'])) {
                                echo $investor['in_trust_for'] . ' ';
                            } else {
                                echo '';
                            } 
                            ?>

                        </i></b>
                    <?php
                        }
                        }
                        endforeach;
                    }
                    ?>
                    <br />
                    <b>Investment No:  <?php
                        if (isset($investment_number)) {
                            echo $investment_number;
                        }
                        ?></b><br />
                    <?php if (isset($investment_array_equity['Investment']['investment_date'])) { ?> <b>Date: </b>
                        <?php echo $investment_array_equity['Investment']['investment_date']; ?>
                    <?php } elseif (isset($investment_array_equity['Investment']['purchase_date'])) { ?>
                    <b>Purchase Date: </b>
                        <?php
                        echo $investment_array_equity['Investment']['purchase_date'];
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top" width="50%">&nbsp;</td>
                <td align="left" valign="top" width="50%">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="top" width="50%" >&nbsp;</td>
                <td align="left" valign="top" width="50%" >&nbsp;</td>
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

                            <td><b align="right">Equity Purchased:</b></td>
                            <td><span id="xxxxxx">
    <?php
    if (isset($investment_array_equity['Investment']['equity'])) {
        echo $investment_array_equity['Investment']['equity'];
    }
    ?>   </span></td> 
                        </tr> 
                        <tr>
                            <td><b align="right">Purchase Price:</b></td>
                            <td><span id="xxxxxx"><?php
    if (isset($investment_array_equity['Investment']['purchase_price'])) {
        echo $shopCurrency . ' ' . $investment_array_equity['Investment']['purchase_price'];
    }
    ?>   </span></td> 
                        </tr>
                        <tr>
                            <td><b align="right">No. of Shares Purchased:</b></td>
                            <td><?php
    if (isset($investment_array_equity['Investment']['numb_shares'])) {
        echo $investment_array_equity['Investment']['numb_shares'];
    }
    ?></td>
                        </tr> 
                    </table>
                </td>
                <td align="left" valign="top" width="50%">
                    <table width="100%" cellspacing="10" cellpadding="0" border="0">
                        <tr>
                            <td><b align="right">Total Fees:</b></td>
                            <td><?php
    if (isset($investment_array_equity['Investment']['total_fees'])) {
        echo $shopCurrency . ' ' . $investment_array_equity['Investment']['total_fees'];
    }
    ?></td>
                        </tr>

                        <tr>

                            <td><b align="right">Total Amount:</b></td>
                            <td><span id="xxxxxx"><b>
                                            <?php
                                            if (isset($investment_array_equity['Investment']['total_amount'])) {

                                                echo $shopCurrency . ' ' . $investment_array_equity['Investment']['total_amount'];
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
                    <p><b>Issued by: </b> 
                        <?php
                            if (isset($issued)) {
                                echo $issued;
                            }
                        ?>
                    </p>
                </td>
                <td align="left" valign="top" width="50%">

                </td>
            </tr>
            <tr>
                <td align="left" valign="top" colspan="2">
                    <p ><b>TERMS AND CONDITIONS</b></p>
                    <ol style="font-size: 10px;">
                        <li>Payment of principal, interest or proceeds shall be effected based on specific instructions provided at time product is chosen, and payment shall be made following satisfactory identification of investment holder.</li>
                        <li>Additions or amendments to instructions may be noted, agreed upon and documented as appropriate, and shall be effective following documentation. Instructions may be received and accepted via email, from a recognized email address.</li>
                        <li>All investments must run until the agreed term expires.</li>
                        <li>Please provide a valid identification document (photocopy to be kept by Parkstone), details of which have been indicated on form.</li>
                    </ol>
                </td>

            </tr>
        </table>
        <?php
        } 
        //EQUITY ENDS HERE
        ?>

        <table cellspacing="0" cellpadding="0" border="0" align="left" width="700px">
            <tr>
                <td align="left" valign="top" width="50%">&nbsp;</td>
                <td align="left" valign="top" width="50%">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="top" width="50%">&nbsp;</td>
                <td align="right" valign="top" width="50%">
                    <?php
                    echo $this->Html->link('Return', "/Investments/newInvestment0", array('style' => 'font-size: 14px;', 'class' => 'btn btn-lg btn-info'));
                    echo $this->Html->link('Print', "javascript:void(0)", array("class" => 'btn btn-lg btn-warning', "id" => "print_receipt"));
                    ?>
                </td>
            </tr>
        </table>