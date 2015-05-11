<?php echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js'); ?>

<h3>Reports: Investor Deposits Report</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <?php echo $this->Form->create('InvestorDeposits', array('url' => array('controller' => 'Reports', 'action' => 'investorDeposits'))); ?>
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php
                echo $this->Form->input('client_name', array('label' => 'Client Name*'));
                ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <p style="font-weight: bold; padding: 10px 0px 0px 15px;">Date</p>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <?php
                    $month = date('m');
                    $day = date('d');
                    $Year = date('Y');
                    ?>
                    <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                    <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                    <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                    <?php echo $this->Form->day('report_date', array("selected" => $day)); ?>&nbsp;
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->month('report_date', array("selected" => $month)); ?>&nbsp;
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->year('report_date', 2003, date('Y'), array("selected" => $Year)); ?>
                </div>
                <script>
                    var day = $("#day").val();
                    var month = $("#month").val();
                    var year = $("#year").val();
                    $("#InvestmentInvestmentDateDay option[value=" + day + "]").attr('selected', true);
                    $("#InvestmentInvestmentDateMonth option[value=" + month + "]").attr('selected', true);
                    $("#InvestmentInvestmentDateYear option[value=" + year + "]").attr('selected', true);
                </script>
                <?php
                echo $this->Form->button('Find', array('type' => 'submit', 'class' => 'btn btn-lg btn-success', 'style' => 'float: right;'));
                ?>

            </div>
            
            <?php echo $this->Form->end(); ?>
            <p style="clear: both; width: 100%; margin-bottom: 20px; border-bottom: solid 2px dodgerblue;">&nbsp;</p>
            
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

                echo "<p><b>INVESTOR DEPOSITS REPORT</b></p>";
                ?>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table border="1" cellspacing="" cellpadding="3" width="100%" align="left" style="border: solid 2px gray;">
                    <tr>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Client Code</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Name</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Investment No.</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Deposit Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Amount Deposited</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Investment Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Rate</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Tenure/Period</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>User/Staff</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Receipt No.</b></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">21000</td>
                        <td align="left" valign="top">Adwoa Serwaa</td>
                        <td align="left" valign="top">LC/02/13/0002</td>
                        <td align="right" valign="top">01/02/2014</td>
                        <td align="right" valign="top">2,000.00</td>
                        <td align="right" valign="top">01/02/2013</td>
                        <td align="right" valign="top">11%</td>
                        <td align="right" valign="top">2 years</td>
                        <td align="right" valign="top">Support</td>
                        <td align="right" valign="top">1234567</td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">21000</td>
                        <td align="left" valign="top">Adwoa Serwaa</td>
                        <td align="left" valign="top">LC/02/13/0002</td>
                        <td align="right" valign="top">15/04/2014</td>
                        <td align="right" valign="top">200.00</td>
                        <td align="right" valign="top">01/02/2013</td>
                        <td align="right" valign="top">11%</td>
                        <td align="right" valign="top">2 years</td>
                        <td align="right" valign="top">Support</td>
                        <td align="right" valign="top">1334567</td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">21000</td>
                        <td align="left" valign="top">Adwoa Serwaa</td>
                        <td align="left" valign="top">LC/02/13/0002</td>
                        <td align="right" valign="top">22/08/2014</td>
                        <td align="right" valign="top">1,000.00</td>
                        <td align="right" valign="top">01/02/2013</td>
                        <td align="right" valign="top">11%</td>
                        <td align="right" valign="top">2 years</td>
                        <td align="right" valign="top">Support</td>
                        <td align="right" valign="top">1634567</td>
                    </tr>
                    <tr style="border-top: solid 2px; background: #eaeaea;">
                        <td align="right" valign="top">&nbsp;</td>
                        <td align="left" valign="top">&nbsp;</td>
                        <td align="left" valign="top">&nbsp;</td>
                        <td align="right" valign="top">TOTAL</td>
                        <td align="right" valign="top">3,200.00</td>
                        <td align="right" valign="top">&nbsp;</td>
                        <td align="right" valign="top">&nbsp;</td>
                        <td align="right" valign="top">&nbsp;</td>
                        <td align="right" valign="top">&nbsp;</td>
                        <td align="right" valign="top">&nbsp;</td>
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
