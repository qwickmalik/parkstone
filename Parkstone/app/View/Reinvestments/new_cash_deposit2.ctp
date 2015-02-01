<?php
echo $this->Html->script('notification.js');
?>

<?php
//$shopCurrency = "GH$";
//if ($this->Session->check('shopCurrency_investment')) {
//    $shopCurrency = $this->Session->read('shopCurrency_investment');
//}
?>
<!-- Content starts here -->
<h3 style="color: red;">New Re-investor Cash Deposit - Step 2</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">

            <tr>
                <td align="left" valign="top" colspan="3" style="font-size: 18px; color: red; font-weight: bold;">Re-investor Details</td>
            </tr>
            <tr>
                <td align="left" valign="top" colspan="3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <b>ID:</b> <?php echo "";?><br>
                            <b>Company Name:</b> <?php echo "";?><br>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <b>Address:</b> <?php echo "";?><br>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="left" valign="top" style="border-bottom: solid 3px #ffffff;">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="top" colspan="3">

                    <!-- Step Investment Details Start -->
                    <?php
                    echo $this->Form->create('Reinvestment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Reinvestments', 'action' => 'process_indv'), "inputDefaults" => array('div' => false)));
                    ?>
                    <div class="row" style="background: #F0E3C0;">
                        <div class="col-lg-6 col-md-6 col-sm-12">

                            <?php
                            echo $this->Form->hidden('user_id', array('value' => ($this->Session->check('userDetails.id') == true ? $this->Session->read('userDetails.id') : '' )));
                            echo $this->Form->hidden('investor_page', array('value' => 'newCashDeposit2'));
                            echo $this->Form->hidden('reinvestor_id', array( 'value' => (isset($reinvestor['id'])?$reinvestor['id'] : '') ));

                            echo $this->Form->input('investmentproduct_id', array('label' => 'Investment Product', 'empty' => "--Please Select--", 'selected' => ($this->Session->check('investtemp.investmentproduct_id') == true ? $this->Session->read('investtemp.investmentproduct_id') : '' )));
                            
                            echo $this->Form->input('currency_id', array('type' => 'select', 'options' => $currencies, 'empty' => '--Please select currency--',));
                            echo $this->Form->input('paymentmode_id', array('label' => 'Payment Mode', 'empty' => "--Please Select--", 'value' => ($this->Session->check('investtemp.paymentmode_id') == true ? $this->Session->read('investtemp.paymentmode_id') : '' )));
                            ?>
                            
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    if ($this->Session->check('investtemp.investment_date') == true) {

                                        $dob_string = $this->Session->read('investtemp.investment_date');
                                        $month = date('m', strtotime($dob_string));
                                        $day = date('d', strtotime($dob_string));
                                        $Year = date('Y', strtotime($dob_string));
                                    } else {

                                        $month = date('m');
                                        $day = date('d');
                                        $Year = date('Y');
                                    }
                                    ?>
                                    <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                                    <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                                    <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>Inv. Date*:</span>" . $this->Form->day('investment_date', array("selected" => $day)); ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->month('investment_date', array("selected" => $month)); ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->year('investment_date', 1950, date('Y'), array("selected" => $Year)); ?>
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
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?php
                            echo $this->Form->input('fixed_inv_amount', array('label' => 'Fixed Investment Amount', 'class' => 'required', 'value' => ($this->Session->check('investtemp.fixed_inv_amount') == true ? $this->Session->read('investtemp.fixed_inv_amount') : '' )));
                            
                            echo $this->Form->input('equity_inv_amount', array('label' => 'Equity Investment Amount', 'class' => 'required', 'value' => ($this->Session->check('investtemp.equity_inv_amount') == true ? $this->Session->read('investtemp.equity_inv_amount') : '' )));
                            
                            echo $this->Form->input('notes', array('label' => 'Notes', 'placeholder' => "Other details", 'value' => ($this->Session->check('investtemp.notes') == true ? $this->Session->read('investtemp.notes') : '' ), 'rows' => 4));
                            ?>
                        </div>
                        
                    </div>
                </td>
            </tr>

            <tr>
                <td align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>

            <tr>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" valign="middle" colspan="2">
                    <?php echo $this->Html->link('Back', "/Reinvestments/newCashDeposit", array("class" => 'btn btn-lg btn-info')); ?>

                    &nbsp;&nbsp;
                    <?php echo $this->Html->link('Next', "/Reinvestments/newDepositCert", array("class" => 'btn btn-lg btn-primary')); ?>
                </td>
            </tr>
        </table>
        <?php
        echo $this->Form->end();
        ?>
        <div id="clearer"></div>

    </div>
    <!-- Content ends here -->
    