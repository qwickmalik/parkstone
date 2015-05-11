<?php echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js'); ?>

<h3>Reports: Maturity List</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
                <?php
                echo $this->Element('logo_reports');
                echo "<H3><b>PARKSTONE CAPITAL LIMITED</b></H3>";
                
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
                    echo "<p>" . $postaladd . "</p>";
                }

                echo "<p><b>MATURITY LIST</b></p>";
                ?>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table border="1" cellspacing="" cellpadding="3" width="100%" align="left" style="border: solid 2px gray;">
                    <tr>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Client Code</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Name</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Investment No.</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Investment Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Investment Period</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Maturity Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Principal Amt.</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Interest Rate</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Interest</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Maturity Amt.</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Instructions A/c</b></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">21000</td>
                        <td align="left" valign="top">Adwoa Serwaa</td>
                        <td align="left" valign="top">LC/02/13/0002</td>
                        <td align="right" valign="top">01/02/2013</td>
                        <td align="right" valign="top">365</td>
                        <td align="right" valign="top">01/02/2014</td>
                        <td align="right" valign="top">2,000.00</td>
                        <td align="right" valign="top">22%</td>
                        <td align="right" valign="top">220.00</td>
                        <td align="right" valign="top">2,220.00</td>
                        <td align="left" valign="top">ROLL</td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">21001</td>
                        <td align="left" valign="top">Kofi Mensah</td>
                        <td align="left" valign="top">LC/02/13/0003</td>
                        <td align="right" valign="top">01/08/2013</td>
                        <td align="right" valign="top">182</td>
                        <td align="right" valign="top">01/02/2014</td>
                        <td align="right" valign="top">10,000.00</td>
                        <td align="right" valign="top">22%</td>
                        <td align="right" valign="top">1,100.00</td>
                        <td align="right" valign="top">11,100.00</td>
                        <td align="left" valign="top">REFUND</td>
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
