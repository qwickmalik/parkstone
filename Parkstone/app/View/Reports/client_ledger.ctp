<?php echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js'); ?>
<h3>Reports: Client Ledger</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
                <?php
//                echo $this->Element('logo_reports');
//                echo "<H3><b>PARKSTONE CAPITAL LIMITED</b></H3>";
//                $postaladd = 'Postal Address: ';
//
//                if ($this->Session->check('shopAddress')) {
//                    $shopAddress = $this->Session->read('shopAddress');
//                    $postaladd .=$shopAddress;
//                    if ($this->Session->check('shopPosttown')) {
//                        $shopPosttown = $this->Session->read('shopPosttown');
//
//                        // $postaladd .= ', '.$shopPosttown;
//                    }
//                    if ($this->Session->check('shopPostCity')) {
//                        $shopPostCity = $this->Session->read('shopPostCity');
//                        $postaladd .= ', ' . $shopPostCity;
//                    }
//                    if ($this->Session->check('shopPostCount')) {
//                        $shopPostCount = $this->Session->read('shopPostCount');
//                        $postaladd .= ', ' . $shopPostCount;
//                    }
//                    echo "<p>" . $postaladd . "</p>";
//                }
//
//                echo "<p><b>CLIENT LEDGER</b></p>";
                ?>
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
                            echo 'CLIENT LEDGER'
                            ?></p>
                        <p align='left'>Generated on <?php echo date('jS F, Y'); ?></p>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <p align="right"><?php echo $this->Session->read('shopAddress') . ', ' . $this->Session->read('shopPosttown') . '<br />' . $this->Session->read('shopPostCity') . ', ' . $this->Session->read('shopPostCount') . '<br />' . $this->Session->read('shopTelephone') . '<br />' . $this->Session->read('shopEmail'); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 inner_print">
                <table border="1" cellspacing="" cellpadding="3" width="100%" align="left" style="border: solid 2px gray;">
                    <tr>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Voucher Number</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Description</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Debit</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Credit</b></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;">12/01/2014</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;">2</td>
                        <td align="left" valign="top" style="border-bottom: solid 1px Gray;">Deposit for investment</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;"></td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;">2,000.00</td>
                    </tr>
                    <tr>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;">12/01/2014</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;"></td>
                        <td align="left" valign="top" style="border-bottom: solid 1px Gray;">Investment in Accord for one year (IC/01/14/0016)</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;">2,000.00</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;"></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;">15/06/2014</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;">15</td>
                        <td align="left" valign="top" style="border-bottom: solid 1px Gray;">Deposit for investment</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;"></td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;">2,000.00</td>
                    </tr>
                    <tr>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;">12/01/2014</td>
                        <td align="left" valign="top" style="border-bottom: solid 1px Gray;"></td>
                        <td align="left" valign="top" style="border-bottom: solid 1px Gray;">Investment in Accord for one year (IC/01/14/0016)</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;">2,000.00</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;"></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;">18/07/2014</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;"></td>
                        <td align="left" valign="top" style="border-bottom: solid 1px Gray;">Discounting of IC/01/14/0001</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;"></td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;">2,179.32</td>
                    </tr>
                    <tr>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;">18/07/2014</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;">18</td>
                        <td align="left" valign="top" style="border-bottom: solid 1px Gray;">Payment of investment proceeds(IC/01/14/0016)</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;">2,179.32</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;"></td>
                    </tr>
                </table>
            </div>
            <?php
            echo "<p>&nbsp;</p>";
            echo $this->Html->link('Print', "javascript:void(0)", array('style' => 'float: right;', "class" => 'btn btn-lg btn-warning', "id" => "print_receipt"));
            echo $this->Html->link('Return', "/Reports/", array('style' => 'float: right;', 'class' => 'btn btn-lg btn-info'));
            ?>
        </div>
    </div>
    <!-- Content end here -->
<?php echo $this->element('footer'); ?>

