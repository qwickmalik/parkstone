<?php
//echo $this->Html->script('notification.js');
?>

<!-- Content starts here -->
<h3>Pay Investor</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>


        <?php echo $this->Form->create('InvestmentPayment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'makePayment'), "inputDefaults" => array('div' => false))); ?>
        <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">
            <tr>
                <td colspan="2">
                    <table border="0" width="100%" cellspacing="5" cellpadding="0" align="left">
                        <tr>
                            <td align="left" width="200"><p style="font-size: 18px;">Investor ID: </p></td>
                            <td align="left"><p style="font-size: 18px;"><?php
        if (isset($data['Investment']['investor_id'])) {
            echo $data['Investment']['investor_id'];
        }
        ?></p></td>
                        </tr>
                        <tr>
                            <td align="left" width="200"><p style="font-size: 18px;">Investor Name: </p></td>
                            <td align="left"><p style="font-size: 18px;"><?php
                                    if (isset($data['Investor']['fullname'])) {
                                        echo $data['Investor']['fullname'];
                                    }
        ?></p></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top" width="50%">
                    <table width="100%" cellspacing="10" cellpadding="0" border="0">
                        <tr>
                            <td width="30%"><b align="right">Investment ID:</b></td>
                            <td><span  align="left" id="xxxxxx"><?php
                                    if (isset($data['Investment']['id'])) {
                                        echo $data['Investment']['id'];
                                    }
        ?></span>

                                <input type="hidden" value="<?php if (isset($data['Investment']['id'])) {
                                        echo $data['Investment']['id'];
                                    } ?>" name="hid_investid" /></td>
                        </tr>
                        <tr>
                            <td width="30%"><b align="right">Investment Term:</b></td>
                            <td><span align="left" id="xxxxxx"><?php
                                    if (isset($data['InvestmentTerm']['term_name'])) {
                                        echo $data['InvestmentTerm']['term_name'];
                                    }
        ?></span></td>
                        </tr>
                        <tr>
                            <td width="30%"><b align="right">Investment Date:</b></td>
                            <td><span align="left" id="xxxxxx"><?php
                                    if (isset($data['Investment']['investment_date'])) {
                                        echo $data['Investment']['investment_date'];
                                    }
        ?></span></td>
                        </tr>
                        <tr>
                            <td><b align="right">&nbsp;</b></td>
                            <td><span id="xxxxxx">&nbsp;</span></td>
                        </tr>
                        <tr>
                            <td><b align="right">&nbsp;</b></td>
                            <td><span id="xxxxxx">&nbsp;</span></td>
                        </tr>
                    </table>

                    <div style="clear: both;"></div>
                </td>
                <td align="left" valign="top" width="50%">

                    <table width="100%" cellspacing="10" cellpadding="0" border="0">

                        <tr>
                            <td><b align="right">Invested Amount:</b></td>
                            <td><span id="xxxxxx"><?php
                                    if (isset($data['Investment']['investment_amount'])) {
                                        echo $data['Investment']['investment_amount'];
                                    }
        ?></span></td>
                        </tr>
                        <tr>
                            <td><b align="right">Rate(%):</b></td>
                            <td><span id="xxxxxx"><?php
                                    if (isset($data['Investment']['custom_rate'])) {
                                        echo $data['Investment']['custom_rate'];
                                    }
                                    ?></span></td>
                        </tr>
                        <tr>
                            <td><b align="right">Due Date:</b></td>
                            <td><span id="xxxxxx"><?php
                                    if (isset($data['Investment']['due_date'])) {
                                        echo $data['Investment']['due_date'];
                                    }
                                    ?></span></td>
                        </tr>
                        <tr>
                            <td><b align="right">Amount Due:</b></td>
                            <td><span id="xxxxxx"><?php
                                    if (isset($data['Investment']['amount_due'])) {
                                        echo $data['Investment']['amount_due'];
                                    }
                                    ?></span></td>
                        </tr>
                        <tr>
                            <td><b align="right">&nbsp;</b></td>
                            <td><span id="xxxxxx">&nbsp;</span></td>
                        </tr>
                    </table>

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    &nbsp;
                </td>

            </tr>
            <tr>
                <td align="left" valign="top" width="50%"> 
<?php
//echo "<b style='font-size: 16px;'>Payment Date:</b>&nbsp;".$this->Form->input('payment_date', array('type' => 'date', 'dateFormat' => 'DMY', 'label' => false));
?> 
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
<!--                         <input type="hidden" id="month" value="<?php // echo $month; ?>"/>
                            <input type="hidden" id="day" value="<?php // echo $day; ?>"/>
                            <input type="hidden" id="year" value="<?php // echo $Year; ?>"/>-->

                            <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>Payment Date:</span>" . $this->Form->day('payment_date', array("class" => "large")); ?>&nbsp;
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->month('payment_date', array("class" => "large")); ?>&nbsp;
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
<?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->year('payment_date', 1950, date('Y'), array( "class" => "large")); ?>
                        </div>
<!--
                        <script>
                            var day = $("#day").val();
                            var month = $("#month").val();
                            var year = $("#year").val();
                            $("#InvestorDobDay option[value=" + day + "]").attr('selected', true);
                            $("#InvestorDobMonth option[value=" + month + "]").attr('selected', true);
                            $("#InvestorDobYear option[value=" + year + "]").attr('selected', true);
                        </script>-->
                    </div>
<?php echo "<b style='font-size: 16px;'>Payment Mode:</b>&nbsp;" . $this->Form->input('payment_mode', array('options' => array("Cash" => "Cash", "Cheque" => "Cheque", "Post-dated chq" => "Post-dated chq", "Standing order" => "Standing order", "Visa" => "Visa"), 'empty' => '--Please Select--', 'label' => false)); ?>
                </td>



                <td align="right" valign="top" width="50%">
<?php
echo "<b style='font-size: 16px;'>Amount being Paid:</b>&nbsp;" . $this->Form->input('amount', array('size' => 17, 'class' => 'input1', 'label' => false));
echo "<b style='font-size: 16px;'>Cheque Nos.:</b>&nbsp;" . $this->Form->input('cheque_nos', array('size' => 5, 'disabled' => true, 'type' => 'textarea', 'style' => 'height: 50px;', 'label' => false));
?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table cellspacing="0" cellpadding="5" width="100%" border="0">
                        <tr>
                            <td align="right" valign="middle" width="50%">
                                &nbsp;
                            </td>
                            <td align="right" valign="middle" width="30%">
<?php
//echo "<b style='font-size: 16px;'>Cheque Nos.:</b>&nbsp;". $this->Form->input('cheque_nos', array('size'=> 5,'disabled' => true, 'type' => 'textarea', 'style' => 'height: 50px;','label' => false)); 
?>
                            </td>

                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="right" valign="middle" width="50%">&nbsp;</td>
                <td align="right" valign="middle" width="50%">
<?php
//echo $this->Html->link('Back',"/Investments/manageClientInvestments",array("class" => 'btn btn-xs btn-info'));
echo $this->Form->button('Make Payment', array("type" => "submit", "class" => "btn btn-success")); //check the parameters here 
?>
<?php
// echo $this->Html->link('Payment Receipt (delete after)',"/Investments/paymentReceipt",array("class" => 'button_green')); 
?>
                </td>
            </tr>
        </table>
        </form>
        <table width="100%" cellspacing="10" cellpadding="0" border="0">
            <tr>
                <td align="left" valign="top" >&nbsp;</td>
                <td align="left" valign="middle" width="375" ></td>
                <td align="left" valign="middle" width="375">&nbsp;</td>
            </tr>
        </table>
        <div id="clearer"></div>

    </div>
    <!-- Content ends here -->
