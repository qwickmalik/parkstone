<?php echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js'); ?>
<h3>Reports: Funds Under Management</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <?php
            echo $this->Form->create('FundsUnderMgt', array('url' => array('controller' => 'Reports', 'action' => 'fundsUnderMgt')));
            ?>
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?php
//                    $month = date('m');
//                    $day = date('d');
                    $Year = date('Y');
                    ?>
                    <input type="hidden" id="month" value="<?php // echo $month; ?>"/>
                    <input type="hidden" id="day" value="<?php // echo $day; ?>"/>
                    <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                    <?php // echo $this->Form->day('report_date', array("selected" => $day)); ?>&nbsp;
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?php // echo $this->Form->month('report_date', array("selected" => $month)); ?>&nbsp;
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?php echo $this->Form->year('report_date', 2003, date('Y'), array("selected" => $Year)); ?>
                </div>
                <script>
//                    var day = $("#day").val();
//                    var month = $("#month").val();
                    var year = $("#year").val();
//                    $("#InvestmentInvestmentDateDay option[value=" + day + "]").attr('selected', true);
//                    $("#InvestmentInvestmentDateMonth option[value=" + month + "]").attr('selected', true);
                    $("#InvestmentInvestmentDateYear option[value=" + year + "]").attr('selected', true);
                </script>
                
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?php
                echo $this->Form->input('bbf', array('type' => 'checkbox', 'label' => 'Balance Brought Forward'));
                ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?php
                echo $this->Form->button('Find', array('type' => 'submit', 'class' => 'btn btn-lg btn-success', 'style' => 'float: right;'));
                ?>
            </div>
<?php $this->Form->end(); ?>
            
            <p style="clear: both; width: 100%; margin-bottom: 20px; border-bottom: solid 2px dodgerblue;">&nbsp;</p>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <?php 
                    
                    echo $this->Html->image('parkstone_logo2.png', array('style' => 'float: left; margin-right: 20px;','width' => 120, 'alt' => $this->Session->read('shopName')));
                    ?>
                    <p style='font-weight: bold; font-size: 16px; text-align: left;'>
                        <?php 
                        echo $this->Session->read('shopName').'<br />'; 
                        echo $report_name; 
                        ?></p>
                    <p align='left'>For the period <?php echo isset($year)? $year: ''; ?></p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <p align="right"><?php echo $this->Session->read('shopAddress') . ', ' . $this->Session->read('shopPosttown') . '<br />' . $this->Session->read('shopPostCity') . ', ' . $this->Session->read('shopPostCount') . '<br />' . $this->Session->read('shopTelephone') . '<br />' . $this->Session->read('shopEmail'); ?></p>
                </div>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!--<table border="1" cellspacing="" cellpadding="3" width="100%" align="left" style="border: solid 2px gray;">-->
                <table class="table table-striped">
                    <tr>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>&nbsp;</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>New Inv.</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Cummulative New Inv.</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Investor Interest Rolled Over</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Cumulative Interest Rolled Over</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Principal Repayments</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Cumulative Payments</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Net Funds Under Mgt.</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Maturity List</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Difference</b></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">BBF</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">January</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">February</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
                        <td align="right" valign="top">xxx</td>
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
