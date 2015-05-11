<?php echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js'); ?>

<h3>Reports: Rollover/Disinvestments Report</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <?php echo $this->Form->create('RolloverDisinv', array('url' => array('controller' => 'Reports', 'action' => 'rolloverDisinv'))); ?>
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
               
                <p style="font-weight: bold; padding: 10px 0px 0px 15px;">From</p>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <?php
                    $month = date('m');
                    $day = date('d');
                    $Year = date('Y');
                    ?>
                    <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                    <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                    <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                    <?php echo $this->Form->day('from_date', array("selected" => $day)); ?>&nbsp;
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->month('from_date', array("selected" => $month)); ?>&nbsp;
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->year('from_date', 2003, date('Y'), array("selected" => $Year)); ?>
                </div>
                <script>
                    var day = $("#day").val();
                    var month = $("#month").val();
                    var year = $("#year").val();
                    $("#InvestmentInvestmentDateDay option[value=" + day + "]").attr('selected', true);
                    $("#InvestmentInvestmentDateMonth option[value=" + month + "]").attr('selected', true);
                    $("#InvestmentInvestmentDateYear option[value=" + year + "]").attr('selected', true);
                </script>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <p style="font-weight: bold; padding: 10px 0px 0px 15px;">To</p>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <?php
                    $month = date('m');
                    $day = date('d');
                    $Year = date('Y');
                    ?>
                    <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                    <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                    <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                    <?php echo $this->Form->day('to_date', array("selected" => $day)); ?>&nbsp;
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->month('to_date', array("selected" => $month)); ?>&nbsp;
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->year('to_date', 2003, date('Y'), array("selected" => $Year)); ?>
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

                echo "<p><b>ROLLOVER/DISINVESTMENTS REPORT</b></p>";
                ?>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table border="1" cellspacing="" cellpadding="3" width="100%" align="left" style="border: solid 2px gray;">
                    <tr>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Client Code</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Name</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Investment No.</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Investment Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Amount Invested</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Rate</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Rollover/Disinv. Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Interest Due on Current Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Principal & Interest Due</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Payment</b></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top" rowspan="8">21000</td>
                        <td align="left" valign="top" rowspan="8">Gibril Mohammed</td>
                        <td align="left" valign="top">LC/02/13/0002</td>
                        <td align="right" valign="top">10/02/2014</td>
                        <td align="right" valign="top">200.00</td>
                        <td align="right" valign="top">18%</td>
                        <td align="right" valign="top">10/02/2015</td>
                        <td align="right" valign="top">36.00</td>
                        <td align="right" valign="top">236.00</td>
                        <td align="right" valign="top">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">LC/02/13/0005</td>
                        <td align="right" valign="top">05/03/2014</td>
                        <td align="right" valign="top">200.00</td>
                        <td align="right" valign="top">18%</td>
                        <td align="right" valign="top">10/02/2015</td>
                        <td align="right" valign="top">33.73</td>
                        <td align="right" valign="top">233.73</td>
                        <td align="right" valign="top">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">LC/02/13/0050</td>
                        <td align="right" valign="top">01/04/2014</td>
                        <td align="right" valign="top">200.00</td>
                        <td align="right" valign="top">18%</td>
                        <td align="right" valign="top">10/02/2015</td>
                        <td align="right" valign="top">31.07</td>
                        <td align="right" valign="top">231.07</td>
                        <td align="right" valign="top">&nbsp;</td>     
                    </tr>
                    <tr>
                        <td align="left" valign="top">LC/02/13/0061</td>
                        <td align="right" valign="top">08/07/2014</td>
                        <td align="right" valign="top">200.00</td>
                        <td align="right" valign="top">18%</td>
                        <td align="right" valign="top">10/02/2015</td>
                        <td align="right" valign="top">21.40</td>
                        <td align="right" valign="top">221.40</td>
                        <td align="right" valign="top">&nbsp;</td>     
                    </tr>
                    <tr>
                        <td align="left" valign="top">LC/02/13/0064</td>
                        <td align="right" valign="top">29/08/2014</td>
                        <td align="right" valign="top">500.00</td>
                        <td align="right" valign="top">24%</td>
                        <td align="right" valign="top">10/02/2015</td>
                        <td align="right" valign="top">54.25</td>
                        <td align="right" valign="top">554.25</td>
                        <td align="right" valign="top">&nbsp;</td>     
                    </tr>
                    <tr>
                        <td align="left" valign="top">LC/02/13/0082</td>
                        <td align="right" valign="top">09/10/2014</td>
                        <td align="right" valign="top">200.00</td>
                        <td align="right" valign="top">24%</td>
                        <td align="right" valign="top">10/02/2015</td>
                        <td align="right" valign="top">16.31</td>
                        <td align="right" valign="top">216.31</td>
                        <td align="right" valign="top">&nbsp;</td>     
                    </tr>
                    <tr>
                        <td align="left" valign="top">LC/02/13/0088</td>
                        <td align="right" valign="top">08/12/2014</td>
                        <td align="right" valign="top">400.00</td>
                        <td align="right" valign="top">24%</td>
                        <td align="right" valign="top">10/02/2015</td>
                        <td align="right" valign="top">16.83</td>
                        <td align="right" valign="top">416.83</td>
                        <td align="right" valign="top">&nbsp;</td>     
                    </tr>
                    <tr>
                        <td align="right" valign="top"></td>
                        <td align="right" valign="top"></td>
                        <td align="right" valign="top"></td>
                        <td align="right" valign="top"></td>
                        <td align="right" valign="top"></td>
                        <td align="right" valign="top"></td>
                        <td align="right" valign="top">2,109.59</td>
                        <td align="right" valign="top">2,109.59</td>
                    </tr>
                    
                    <tr>
                        <td align="right" valign="top" colspan="10">&nbsp;</td>
                        
                    </tr>
                    <tr>
                        <td align="right" valign="top" rowspan="8">21000</td>
                        <td align="left" valign="top" rowspan="8">Florence Nana Pokuaa</td>
                        <td align="left" valign="top">LC/02/13/0002</td>
                        <td align="right" valign="top">10/02/2014</td>
                        <td align="right" valign="top">200.00</td>
                        <td align="right" valign="top">18%</td>
                        <td align="right" valign="top">10/02/2015</td>
                        <td align="right" valign="top">36.00</td>
                        <td align="right" valign="top">236.00</td>
                        <td align="right" valign="top">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">LC/02/13/0005</td>
                        <td align="right" valign="top">05/03/2014</td>
                        <td align="right" valign="top">200.00</td>
                        <td align="right" valign="top">18%</td>
                        <td align="right" valign="top">10/02/2015</td>
                        <td align="right" valign="top">33.73</td>
                        <td align="right" valign="top">233.73</td>
                        <td align="right" valign="top">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">LC/02/13/0050</td>
                        <td align="right" valign="top">01/04/2014</td>
                        <td align="right" valign="top">200.00</td>
                        <td align="right" valign="top">18%</td>
                        <td align="right" valign="top">10/02/2015</td>
                        <td align="right" valign="top">31.07</td>
                        <td align="right" valign="top">231.07</td>
                        <td align="right" valign="top">&nbsp;</td>     
                    </tr>
                    <tr>
                        <td align="left" valign="top">LC/02/13/0061</td>
                        <td align="right" valign="top">08/07/2014</td>
                        <td align="right" valign="top">200.00</td>
                        <td align="right" valign="top">18%</td>
                        <td align="right" valign="top">10/02/2015</td>
                        <td align="right" valign="top">21.40</td>
                        <td align="right" valign="top">221.40</td>
                        <td align="right" valign="top">&nbsp;</td>     
                    </tr>
                    <tr>
                        <td align="left" valign="top">LC/02/13/0064</td>
                        <td align="right" valign="top">29/08/2014</td>
                        <td align="right" valign="top">500.00</td>
                        <td align="right" valign="top">24%</td>
                        <td align="right" valign="top">10/02/2015</td>
                        <td align="right" valign="top">54.25</td>
                        <td align="right" valign="top">554.25</td>
                        <td align="right" valign="top">&nbsp;</td>     
                    </tr>
                    <tr>
                        <td align="left" valign="top">LC/02/13/0082</td>
                        <td align="right" valign="top">09/10/2014</td>
                        <td align="right" valign="top">200.00</td>
                        <td align="right" valign="top">24%</td>
                        <td align="right" valign="top">10/02/2015</td>
                        <td align="right" valign="top">16.31</td>
                        <td align="right" valign="top">216.31</td>
                        <td align="right" valign="top">&nbsp;</td>     
                    </tr>
                    <tr>
                        <td align="left" valign="top">LC/02/13/0088</td>
                        <td align="right" valign="top">08/12/2014</td>
                        <td align="right" valign="top">400.00</td>
                        <td align="right" valign="top">24%</td>
                        <td align="right" valign="top">10/02/2015</td>
                        <td align="right" valign="top">16.83</td>
                        <td align="right" valign="top">416.83</td>
                        <td align="right" valign="top">&nbsp;</td>     
                    </tr>
                    <tr>
                        <td align="right" valign="top"></td>
                        <td align="right" valign="top"></td>
                        <td align="right" valign="top"></td>
                        <td align="right" valign="top"></td>
                        <td align="right" valign="top"></td>
                        <td align="right" valign="top"></td>
                        <td align="right" valign="top">2,109.59</td>
                        <td align="right" valign="top">2,109.59</td>
                    </tr>
                    
                    <tr>
                        <td align="right" valign="top" colspan="10">&nbsp;</td>
                        
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
