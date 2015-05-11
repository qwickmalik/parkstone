<?php echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js'); ?>
<h3>Reports: Investor Contract</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <?php
            echo $this->Form->create('InvestorContract', array('url' => array('controller' => 'Reports', 'action' => 'investorContract')));
            ?>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php
                echo $this->Form->input('client_name', array('label' => 'Client Name*'));
                ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <p style="font-weight: bold; padding: 10px 0px 0px 0px;">Date</p>
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
                echo $this->Form->button('Find', array('type' => 'submit', 'class' => 'btn btn-lg btn-info', 'style' => 'float: right;'));
                ?>

            </div>

            <p style="clear: both; width: 100%; margin-bottom: 20px; border-bottom: solid 2px dodgerblue;">&nbsp;</p>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
                <?php
                echo $this->Element('logo_reports');
                echo "<H3><b>PARKSTONE CAPITAL LIMITED</b></H3>";
                echo "<p><b>INVESTOR CONTRACT</b></p>";
                ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <p>Client Name: Adwoa Serwaa</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <p>Client Number: 21001</p>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table border="1" cellspacing="" cellpadding="3" width="100%" align="left" style="border: solid 2px gray;">
                    <tr>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Date</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Investment No.</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Investment Period</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Principal Amt. GHS</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Interest Rate</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Interest GHS</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Maturity Amt. GHS</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Maturity Date</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Instructions A/c</b></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">12-01-2014</td>
                        <td align="left" valign="top">IC/2/14/0004</td>
                        <td align="right" valign="top">365</td>
                        <td align="right" valign="top">2,000.00</td>
                        <td align="right" valign="top">22%</td>
                        <td align="right" valign="top">440</td>
                        <td align="right" valign="top">2,440.00</td>
                        <td align="right" valign="top">12/01/2015</td>
                        <td align="left" valign="top">ROLL</td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">05-04-2014</td>
                        <td align="left" valign="top">IC/4/14/0016</td>
                        <td align="right" valign="top">365</td>
                        <td align="right" valign="top">1,000.00</td>
                        <td align="right" valign="top">21%</td>
                        <td align="right" valign="top">210</td>
                        <td align="right" valign="top">1,210.00</td>
                        <td align="right" valign="top">05/04/2015</td>
                        <td align="left" valign="top">PIM</td>
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
