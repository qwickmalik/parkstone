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
                            <b>ID:</b> <?php if(isset($data['Reinvestor']['id'])){echo $data['Reinvestor']['id']; } ?><br>
                            <b>Company Name:</b> <?php if(isset($data['Reinvestor']['company_name'])){ echo $data['Reinvestor']['company_name']; } ?><br>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <b>Address:</b> <?php if(isset($data['Reinvestor']['postal_address'])){ echo $data['Reinvestor']['postal_address']; } ?><br>
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
                    echo $this->Form->create('InvestmentCash', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Reinvestments', 'action' => 'addCashDeposit'), "inputDefaults" => array('div' => false)));
                    ?>
                    <div class="row" style="background: #F0E3C0;">
                        <div class="col-lg-6 col-md-6 col-sm-12">

                            <?php
                            echo $this->Form->hidden('user_id', array('value' => ($this->Session->check('userDetails.id') == true ? $this->Session->read('userDetails.id') : '' )));
                            echo $this->Form->hidden('investor_page', array('value' => 'newCashDeposit2'));
                            echo $this->Form->hidden('reinvestor_id', array( 'value' => (isset($data['Reinvestor']['id'])? $data['Reinvestor']['id'] : '') ));

                            echo $this->Form->input('investmentproduct_id', array("required",'label' => 'Investment Product', 'empty' => "--Please Select--", 'selected' => ($this->Session->check('newCashDeposit.investmentproduct_id') == true ? $this->Session->read('newCashDeposit.investmentproduct_id') : '' )));
                            
                            echo $this->Form->input('currency_id', array("required",'type' => 'select', 'options' => $currencies, 'empty' => '--Please select currency--',));
                            echo $this->Form->input('paymentmode_id', array("required",'label' => 'Deposit Mode', 'empty' => "--Please Select--", 'value' => ($this->Session->check('newCashDeposit.paymentmode_id') == true ? $this->Session->read('newCashDeposit.paymentmode_id') : '' )));
                            ?>
                            
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    if ($this->Session->check('newCashDeposit.investment_date') == true) {

                                        $dob_string = $this->Session->read('newCashDeposit.investment_date');
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
                                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>Deposit. Date*:</span>" . $this->Form->day('investment_date', array("required","selected" => $day)); ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->month('investment_date', array("required","selected" => $month)); ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->year('investment_date', 1950, date('Y'), array("required","selected" => $Year)); ?>
                                </div>
                                <script>
                                    var day = $("#day").val();
                                    var month = $("#month").val();
                                    var year = $("#year").val();
                                    $("#InvestmentCashInvestmentDateDay option[value=" + day + "]").attr('selected', true);
                                    $("#InvestmentCashInvestmentDateMonth option[value=" + month + "]").attr('selected', true);
                                    $("#InvestmentCashInvestmentDateYear option[value=" + year + "]").attr('selected', true);
                                </script>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?php
                            echo $this->Form->input('fixed_inv_amount', array('label' => 'Fixed Investment Amount', 'class' => 'required', 'value' => ($this->Session->check('newCashDeposit.fixed_inv_amount') == true ? $this->Session->read('newCashDeposit.fixed_inv_amount') : '' )));
                            
                            echo $this->Form->input('equity_inv_amount', array('label' => 'Equity Investment Amount', 'class' => 'required', 'value' => ($this->Session->check('newCashDeposit.equity_inv_amount') == true ? $this->Session->read('newCashDeposit.equity_inv_amount') : '' )));
                            
                            echo $this->Form->input('notes', array('label' => 'Notes', 'placeholder' => "Other details", 'value' => ($this->Session->check('newCashDeposit.notes') == true ? $this->Session->read('newCashDeposit.notes') : '' ), 'rows' => 4));
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
                    <?php 
//                    echo $this->Form->button('Save Details', array("type" => "submit", "class" => "btn btn-lg btn-success", "id" => "reinvestor_submit", "style" => "float: right; ")); 
                
                    echo $this->Form->button('Submit', array("type" => "submit","class" => 'btn btn-lg btn-primary')); ?>
                </td>
            </tr>
        </table>
        <?php
        echo $this->Form->end();
        ?>
        <div id="clearer"></div>

    </div>
    <!-- Content ends here -->
    