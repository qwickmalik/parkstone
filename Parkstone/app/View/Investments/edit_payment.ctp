<?php
echo $this->element('header');
echo $this->Html->script('notification.js');

?>

<!-- Content starts here -->
<h3>Edit Payment</h3>
<div class="boxed">
	<div class="inner">
            <div id="clearer"></div>
		

    <?php echo $this->Form->create('Payment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'makePayment'), "inputDefaults" => array('div' => false))); ?>
    
                <table border="0" width="100%" cellspacing="5" cellpadding="0" align="left">
                    <tr>
                        <td align="left" width="200"><p style="font-size: 18px;">Investor ID: </p></td>
                        <td align="left"><p style="font-size: 18px;">001</p></td>
                    </tr>
                    <tr>
                        <td align="left" width="200"><p style="font-size: 18px;">Investor Name: </p></td>
                        <td align="left"><p style="font-size: 18px;">Kwaku Afreh-Nuamah</p></td>
                    </tr>
                </table>
          
            <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                <table width="100%" cellspacing="10" cellpadding="0" border="0">
                    <tr>
                        <td width="200"><b align="right">Investment ID:</b></td>
                        <td><span id="xxxxxx" >003</span>
                        
                        <input type="hidden" value="<?php if(isset($payment['Order']['id'])){echo $payment['Order']['id'];} ?>" name="hid_orderid" /></td>
                    </tr>
                    <tr>
                        <td><b align="right">Investment Portfolio:</b></td>
                        <td><span id="xxxxxx">Acc Type</span></td>
                    </tr>
                    <tr>
                        <td><b align="right">Investment Date:</b></td>
                        <td><span id="xxxxxx">01/01/2014</span></td>
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
			</div>
		
            <div class="col-lg-6 col-md-6 col-sm-12">
                <table width="100%" cellspacing="10" cellpadding="0" border="0">
                    
                    <tr>
                        <td width="200"><b align="right">Invested Amount:</b></td>
                        <td><span id="xxxxxx">20,000</span></td>
                    </tr>
                    <tr>
                        <td><b align="right">Rate(%):</b></td>
                        <td><span id="xxxxxx">15</span></td>
                    </tr>
                    <tr>
                        <td><b align="right">Due Date:</b></td>
                        <td><span id="xxxxxx">01/07/2014</span></td>
                    </tr>
                     <tr>
                        <td><b align="right">Amount Due:</b></td>
                        <td><span id="xxxxxx">23,000</span></td>
                    </tr>
                    <tr>
                        <td><b align="right">&nbsp;</b></td>
                        <td><span id="xxxxxx">&nbsp;</span></td>
                    </tr>
                </table>
                
				</div>
		</div>
        
		
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
            <?php
				echo "<b style='font-size: 16px;'>Payment Date:</b>&nbsp;".$this->Form->input('payment_date', array('type' => 'date', 'dateFormat' => 'DMY', 'label' => false));
                
				echo "<b style='font-size: 16px;'>Payment Mode:</b>&nbsp;".$this->Form->input('payment_mode',array('options' => array("Cash"=>"Cash", "Cheque"=>"Cheque", "Post-dated chq"=>"Post-dated chq", "Standing order"=>"Standing order", "Visa"=>"Visa"),'selected' => $pay_mode,'empty' => '--Please Select--', 'label'=>false)); 
				?>
			</div>
		
			<div class="col-lg-6 col-md-6 col-sm-12">
                <?php echo "<b style='font-size: 16px;'>Amount being Paid:</b>&nbsp;".$this->Form->input('amount', array('size'=> 17, 'class'=>'input1', 'label'=>false)); ?>
			</div>
		</div>
		
		
        <table cellspacing="0" cellpadding="5" width="100%" border="0">
                    <tr>
                        <td align="right" valign="middle" width="50%">
                            <div id="postdate_chqs">
                            <?php //if(isset($payment['Order']['cheque_nos']) && $payment['Order']['cheque_nos'] != "" && $payment['Order']['cheque_nos'] != null){ 
                            
           if($payment['Order']['payment_mode'] == "Post-dated chq") {
                                $cheque_nos = $payment['Order']['cheque_nos'];
                                $cheque_nos = explode(",", $cheque_nos); 
                               
                                $nos = array();
                                $merged = array();
                                foreach($cheque_nos as $each_item): 
                                  //  $new = array();
                                $nos[$each_item] = $each_item;
                                   
                                
                                 endforeach;
                                 
                                 
                                 ?>
                            <table>  <tr>
                            
                            <td align="left">
                               <?php  echo "<b style='font-size: 16px;'>Post-Dated Chq Nos.:</b>&nbsp;".$this->Form->radio('used_chequenos',$nos, array('type' => 'radio','label' => false,'separator' => '<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;','legend' => false)); ?>
                            </td>
                            
                        </tr></table>
                        <?php //
                        } ?>
                                
                            </div>
                        </td>
                        <td align="right" valign="middle" width="30%">
                            <?php  echo "<b style='font-size: 16px;'>Cheque Nos.:</b>&nbsp;". $this->Form->input('cheque_nos', array('size'=> 5,'disabled' => true, 'type' => 'textarea', 'style' => 'height: 50px;','label' => false)); ?>
                        </td>
                        
                    </tr>
                </table>
</form>
    <table width="100%" cellspacing="10" cellpadding="0" border="0">
        <tr>
            <td align="left" valign="top" >&nbsp;</td>
            <td align="left" valign="middle" width="375" ></td>
            <td align="right" valign="middle" width="375">
				<?php 
					echo $this->Html->link('Back',"/Investments/listPayments",array("class" => 'btn btn-xs btn-info'));
					echo $this->Form->button('Save', array("type" => "submit", "class" => "btn btn-success")); //check the parameters here 
					echo $this->Html->link('Print Receipt',"/Investments/paymentReceipt",array("class" => 'btn btn-warning')); 
				?>
			</td>
        </tr>
    </table>
<div id="clearer"></div>

</div>
<!-- Content ends here -->
