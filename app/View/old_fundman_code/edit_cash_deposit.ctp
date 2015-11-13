<?php echo $this->element('header'); ?>

<?php
//$shopCurrency = "GH$";
//if ($this->Session->check('shopCurrency_investment')) {
//    $shopCurrency = $this->Session->read('shopCurrency_investment');
//}
?>
<!-- Content starts here -->
<h3 style="color: red;">Edit Company Cash Deposit</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">

            <tr>
                <td align="left" valign="top" colspan="3" style="font-size: 18px; color: red; font-weight: bold;">Company Details</td>
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
                    echo $this->Form->create('ReinvestorDeposit', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Reinvestments', 'action' => 'editCashDeposit'), "inputDefaults" => array('div' => false)));
                    ?>
                    <div class="row" style="background: #F0E3C0;">
                        <div class="col-lg-6 col-md-6 col-sm-12">

                            <?php
                            echo $this->Form->hidden('user_id', array('value' => ($this->Session->check('userDetails.id') == true ? $this->Session->read('userDetails.id') : '' )));
                            echo $this->Form->hidden('investor_page', array('value' => 'editCashDeposit'));
                            echo $this->Form->hidden('reinvestor_id', array( 'value' => (isset($data['Reinvestor']['id'])?$data['Reinvestor']['id'] : '') ));
                            echo $this->Form->hidden('id', array( 'value' => (isset($data['ReinvestorDeposit']['id'])?$data['ReinvestorDeposit']['id'] : '') ));

                            echo $this->Form->input('investmentproduct', array('disabled','label' => 'Investment Product', 'empty' => "--Please Select--", 'selected' => (isset($data['ReinvestorDeposit']['investment_product_id']) ? $data['ReinvestorDeposit']['investment_product_id'] : '' )));
                            echo $this->Form->hidden('investmentproduct_id', array( 'value' => (isset($data['ReinvestorDeposit']['investment_product_id']) ? $data['ReinvestorDeposit']['investment_product_id'] : '' )));
                            
                            echo $this->Form->input('currency_id', array('type' => 'select', 'options' => $currencies, 'empty' => '--Please select currency--', 'selected' => (isset($data['ReinvestorDeposit']['currency_id']) ? $data['ReinvestorDeposit']['currency_id'] : '' )));
                            echo $this->Form->input('paymentmode_id', array('label' => 'Payment Mode', 'empty' => "--Please Select--", 'selected' => (isset($data['ReinvestorDeposit']['payment_mode_id']) ? $data['ReinvestorDeposit']['payment_mode_id'] : '' )));
                            ?>
                            
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    if (isset($data['ReinvestorDeposit']['investment_date'])) {

                                        $dob_string = $data['ReinvestorDeposit']['investment_date'];
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
                                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>Deposit Date*:</span>" . $this->Form->day('investment_date', array("selected" => $day)); ?>
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
                                    $("#ReinvestorDepositInvestmentDateDay option[value=" + day + "]").attr('selected', true);
                                    $("#ReinvestorDepositInvestmentDateMonth option[value=" + month + "]").attr('selected', true);
                                    $("#ReinvestorDepositInvestmentDateYear option[value=" + year + "]").attr('selected', true);
                                </script>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?php
                            echo $this->Form->input('fixed_inv_amount', array('label' => 'Fixed Investment Amount', 'class' => 'required', 'value' => (isset($data['ReinvestorDeposit']['fixed_inv_amount']) ? $data['ReinvestorDeposit']['fixed_inv_amount'] : '' )));
                            
                            echo $this->Form->input('equity_inv_amount', array('label' => 'Equity Investment Amount', 'class' => 'required', 'value' => (isset($data['ReinvestorDeposit']['equity_inv_amount']) ? $data['ReinvestorDeposit']['equity_inv_amount'] : '' )));
                            
                            echo $this->Form->input('notes', array('label' => 'Notes', 'placeholder' => "Other details", 'value' => (isset($data['ReinvestorDeposit']['notes'])? $data['ReinvestorDeposit']['notes'] : '' ), 'rows' => 4));
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
                    <?php echo $this->Html->link('Back', "/FundManagement/listCashDeposits", array("class" => 'btn btn-lg btn-info')); ?>

                    &nbsp;&nbsp;
                    <?php echo $this->Form->button('Save', array("type" => "submit", "id" => "save", "class" => "btn btn-lg btn-success")); ?> 
                </td>
            </tr>
        </table>
        <?php
        echo $this->Form->end();
        ?>
        <div id="clearer"></div>

    </div>
    <!-- Content ends here -->
<?php echo $this->element('footer'); ?>