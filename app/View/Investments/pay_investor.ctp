<?php echo $this->element('header');

$shopCurrency =""; if ($this->Session->check('shopCurrency')) {
    $shopCurrency = $this->Session->read('shopCurrency');

}?>

<!-- Content starts here -->
<h3>Pay Investor</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>


        <?php echo $this->Form->create('InvestmentPayment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'makePayment'), "inputDefaults" => array('div' => false))); ?>
        <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">
        
            <tr>
                <td align="left" valign="top" width="50%">
                    <table width="100%" cellspacing="10" cellpadding="0" border="0">
                        <tr>
                            <td width="30%"><b align="right">Investor ID:</b></td>
                            <td><span  align="left" id="xxxxxx"><?php
                                    if (isset($data['ClientLedger']['investor_id'])) {
                                        echo $data['ClientLedger']['investor_id'];
                                    }
        ?></span>
                                 <input type="hidden" value="<?php if (isset($data['ClientLedger']['investor_id'])) {
                                        echo $data['ClientLedger']['id'];
                                    } ?>" name="hid_ledgerid" /><input type="hidden" value="<?php if (isset($inv_data['Investment']['id'])) {
                                        echo $inv_data['Investment']['id'];
                                    } ?>" name="hid_investid" /><input type="hidden" value="<?php if (isset($data['ClientLedger']['investor_id'])) {
                                        echo $data['ClientLedger']['investor_id'];
                                    } ?>" name="hid_investorid" /></td>
                                
                        </tr>
                        <tr>
                            <td width="30%"><b align="right">Investor Name:</b></td>
                            <td><span align="left" id="xxxxxx"><?php
                                    if (isset($data['Investor']['fullname'])) {
                                        echo $data['Investor']['fullname'];
                                    }
        ?></span></td>
                        </tr>
                        <tr>
                            <td width="30%"><b align="right">Instructions:</b></td>
                            <td><span align="left" id="xxxxxx"><?php
                                    if (isset($inv_data['Investment']['instruction_details'])) {
                                        echo $inv_data['Investment']['instruction_details'];
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
                            <td><b align="right">Ledger Balance:</b></td>
                            <td><span id="xxxxxx"><?php
                                   if (isset($data['ClientLedger']['available_cash'])) {
                                        echo $shopCurrency." ".number_format($data['ClientLedger']['available_cash'],2);
                                    }
                                    ?></span></td>
                        </tr>
                        <tr>
                            <td><b align="right">Total Cash In Investment:</b></td>
                            <td><span id="xxxxxx"><?php
                                   if (isset($data['ClientLedger']['invested_amount'])) {
                                        echo $shopCurrency." ".number_format($data['ClientLedger']['invested_amount'],2);
                                    }
        ?></span></td>
                        </tr>
                        <tr>
                            <td><b align="right">Total Principal</b></td>
                            <td><span id="xxxxxx"><?php
                                   if (isset($data['ClientLedger']['total_principal'])) {
                                        echo $shopCurrency." ".number_format($data['ClientLedger']['total_principal'],2);
                                    }
        ?></span></td>
                        </tr>
                        <tr>
                            <td><b align="right">Total Interest</b></td>
                            <td><span id="xxxxxx"><?php
                                   if (isset($data['ClientLedger']['total_interest'])) {
                                        echo $shopCurrency." ".number_format($data['ClientLedger']['total_interest'],2);
                                    }
        ?></span></td>
                        </tr>
                        <tr>
                            <td><b align="right">Approval Date & Time:</b></td>
                            <td><span id="xxxxxx"><?php
                                    if (isset($data['ClientLedger']['modified'])) {
                                        echo $data['ClientLedger']['modified'];
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
                             <?php
                                    

                                        $month = date('m');
                                        $day = date('d');
                                        $Year = date('Y');
                                    
                                    ?>
                                    <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                                    <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                                    <input type="hidden" id="year" value="<?php echo $Year; ?>"/>

                            <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>Payment Date:</span>" . $this->Form->day('payment_date', array("class" => "large")); ?>&nbsp;
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->month('payment_date', array("class" => "large")); ?>&nbsp;
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
<?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->year('payment_date', 1950, date('Y'), array( "class" => "large")); ?>
                        </div>

                        <script>
                            var day = $("#day").val();
                            var month = $("#month").val();
                            var year = $("#year").val();
                            $("#InvestmentPaymentPaymentDateDay option[value=" + day + "]").attr('selected', true);
                            $("#InvestmentPaymentPaymentDateMonth option[value=" + month + "]").attr('selected', true);
                            $("#InvestmentPaymentPaymentDateYear option[value=" + year + "]").attr('selected', true);
                        </script>
                    </div>
              <div class="row">
     <!--<div class="col-lg-12 col-md-12 col-sm-12">-->                 
<?php
echo "<b style='font-size: 14px;float:left'>Cheque Nos.:</b>&nbsp;" . $this->Form->input('cheque_nos', array('size' => 5,'value' => ($this->Session->check('payinvesttemp.cheque_nos') == true ? 
                                            $this->Session->read('payinvesttemp.cheque_nos') : '' ), 'disabled' => true, 'type' => 'textarea', 'style' => 'height: 50px;', 'label' => false));
?>
         </div>  
     </div> 
                    
                </td>

                       
                <td align="right" valign="top" width="50%">
              <div class="col-lg-5 col-md-5 col-sm-12" >
<?php echo "<b style='font-size: 14px;float:left;'>Payment Mode:</b>&nbsp;" . $this->Form->input('paymentmode_id', array('required','label' => false, 'empty' => "--Please Select--", 
    'value' => ($this->Session->check('payinvesttemp.paymentmode_id') == true ? 
        $this->Session->read('payinvesttemp.paymentmode_id') : '' )));
echo "<span style='margin-bottom:10px;'>&nbsp;</span>";
?>
                        </div>
              <div class="col-lg-5 col-md-5 col-sm-12" >
                                    <?php
                                  echo "<b style='font-size: 14px;float:left;'>Instructions:</b>&nbsp;" . $this->Form->input('instruction_id', array('required','label' => false, 'empty' => "--Please Select--"));
                                  echo "<span style='margin-bottom:10px;'>&nbsp;</span>";
                                  ?>
                                </div>
                    
                                <div class="col-lg-5 col-md-5 col-sm-12" >
<?php
echo "<b style='font-size: 14px;float:left;'>Interest being Paid:</b>&nbsp;" . $this->Form->input('interest_amount', array('required','size' => 17,'disabled' => true, 'class' => 'input1','value' => ($this->Session->check('payinvesttemp.interest_amount') == true ? 
                                            $this->Session->read('payinvesttemp.interest_amount') : 0 ) ,'label' => false));
?>
</div>
                                    <div class="col-lg-5 col-md-5 col-sm-12" >
<?php
echo "<b style='font-size: 16px;float:left'>Principal being Paid:</b>&nbsp;" . $this->Form->input('principal_amount', array('required','size' => 17,'disabled' => true,'class' => 'input1','value' => ($this->Session->check('payinvesttemp.principal_amount') == true ? 
                                            $this->Session->read('payinvesttemp.principal_amount') : 0 ) ,'label' => false));
?>
</div>
  
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
<?php echo $this->element('footer'); ?>
    
    
    <script type="text/javascript" language="javascript">
        $(document).ready(function()
        {
       
        
        function checkpayment_mode(){
            var payment_mode = $("#InvestmentPaymentPaymentmodeId").val();
           
           if(payment_mode == '2'){
               
               $("#InvestmentPaymentChequeNos").prop('disabled',false);
               return false;
           }
             if(payment_mode == '4'){
               $("#InvestmentPaymentChequeNos").prop('disabled',false);
               return false;
           }
           
                        if(payment_mode != '4' && payment_mode != '2'){
               $("#InvestmentPaymentChequeNos").prop('disabled',true);
           } 
        }
        
        function checkpayment_instructions(){
            var payment_instuc = $("#InvestmentPaymentInstructionId").val();
           
           if(payment_instuc == '1'){
               
               $("#InvestmentPaymentInterestAmount").prop('disabled',false);
               $("#InvestmentPaymentPrincipalAmount").prop('disabled',true);
               return false;
           }
             if(payment_instuc == '2'){
               $("#InvestmentPaymentPrincipalAmount").prop('disabled',false);
               $("#InvestmentPaymentInterestAmount").prop('disabled',true);
               return false;
           }
           
                        if(payment_instuc == '3'){
               $("#InvestmentPaymentInterestAmount").prop('disabled',false);
               $("#InvestmentPaymentPrincipalAmount").prop('disabled',false);
           }
           if(payment_instuc == ''){
               
               $("#InvestmentPaymentInterestAmount").prop('disabled',true);
               $("#InvestmentPaymentPrincipalAmount").prop('disabled',true);
           }
        } 
        checkpayment_mode();
        checkpayment_instructions();
          $("#InvestmentPaymentPaymentmodeId").change(function (){
             
          checkpayment_mode();
        });
         $("#InvestmentPaymentInstructionId").change(function (){
             
          checkpayment_instructions();
        });
        });
        
        </script>
