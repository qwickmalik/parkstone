<?php echo $this->element('header'); ?>
<?php
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');



?>
<h3>Reinvestment Cash Deposit Certificate</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

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
                            <h1 style="color: Navy;">New Investment Deposit Certificate</h1><br />
        
            <b style="font-size: 18px;"> <br /><i style="color: Navy;"><?php
                                if (isset($company_name)) {
                                    echo $company_name;
                                } 
                                ?></i></b>
                            
                            <br />
                            
                                <?php if (isset($date)) { ?> <b>Date: </b>
                                    <?php echo $date; ?>
                            <?php } if (isset($payment_mode)) { ?>
                                <b>Payment Mode: </b>
                                <?php
                                echo $payment_mode;
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
                               
                                <?php  if (isset($product_type) && ($product_type == 'fixed' || $product_type == 'both')) { ?>
                                <tr>
                                    <td><b align="right">Fixed Investment Amount:</b></td>
                                    <td><span id="xxxxxx">
                                        <?php
                                        if (isset($data_fixed['InvestmentCash']['amount'])) {
                                            echo number_format($data_fixed['InvestmentCash']['amount'], 2, '.', ',');
                                        }
                                        ?>
                                        </span></td>   
                                </tr> 
                                
                                <?php } if (isset($product_type) && ($product_type == 'equity' || $product_type == 'both')) { ?>
                                <tr>
                                    <td><b align="right">Equity Investment Amount:</b></td>
                                    <td><span id="xxxxxx"><?php
                                    if (isset($data_equity['InvestmentCash']['amount'])) {
                                        echo number_format($data_equity['InvestmentCash']['amount'], 2, '.', ',');
                                    }
                                    ?></span></td> 
                                </tr>
            <?php } ?>
                            </table>
                        </td>
                        <td align="left" valign="top" width="50%">
                            <table width="100%" cellspacing="10" cellpadding="0" border="0">
                                <tr>
                                    <td><b align="right">Total Amount Invested:</b></td>
                                    <td><span id="xxxxxx"><?php
                                        if (isset($total_invested)) {
                                            echo  number_format($total_invested, 2, '.', ',');
                                        }
                                    ?></span></td>
                                </tr>

                                <tr>
                                    <td><b align="right">Tax:</b></td>
                                    <td><span id="xxxxxx"><?php
                                    
//}
        ?></span></td>
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
                            <p><b>Issued by: </b> <?php
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
    



        <table cellspacing="0" cellpadding="0" border="0" align="left" width="700px">
            <tr>
                <td align="left" valign="top" width="50%">&nbsp;</td>
                <td align="left" valign="top" width="50%">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="top" width="50%">&nbsp;</td>
                <td align="right" valign="top" width="50%">
<?php
echo $this->Html->link('Return', "/Reinvestments/newCashDeposit", array('style' => 'font-size: 14px;', 'class' => 'btn btn-lg btn-info'));
echo $this->Html->link('Print', "javascript:void(0)", array("class" => 'btn btn-lg btn-warning', "id" => "print_receipt"));
?>
                </td>
            </tr>
        </table>
    </div>
<?php echo $this->element('footer'); ?>