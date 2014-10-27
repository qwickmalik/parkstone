<?php
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');
echo $this->Html->script('notification.js');

$shopCurrency = "GH$";
if ($this->Session->check('shopCurrency_investment')) {
    $shopCurrency = $this->Session->read('shopCurrency_investment');
}
?>

<h3>New Investment Certificate</h3>
<div class="boxed">
	<div class="inner">
            <div id="clearer"></div>
		
		
<table id="payment_receipt" border="0" width="700px" cellspacing="0" cellpadding="5" align="center" style="border: solid 15px Navy;">
    <?php $shopCurrency =""; if ($this->Session->check('shopCurrency')) {
                        $shopCurrency = $this->Session->read('shopCurrency');
                    }
                    ?>
    <tr>
        <td align="center" valign="top" colspan="2">
            
            <div style="font-weight: bold;">
				 <?php echo $this->Html->image('parkstone_logo.png', array('width' => '100')); ?>
                <p style="font-size: 25px;"><?php
                    if ($this->Session->check('shopName')) {
                        $shopName = $this->Session->read('shopName');
                        echo $shopName;
                    }
                    
                    ?></p>
                <p><?php
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
                        echo $postaladd;
                    }
                    ?></p>
                <p><?php
                    if ($this->Session->check('shopMobile')) {
                        $shopMobile = $this->Session->read('shopMobile');

                        echo 'Mobile Phone: ' . $shopMobile;
                    }
                    ?></p>
            </div>
        </td>
    </tr>
    <tr>
        <td align="left" valign="top" width="50%">&nbsp;</td>
        <td align="left" valign="top" width="50%">&nbsp;</td>
    </tr>
    <tr>
        <td align="center" valign="top" colspan="2">
            <h1 style="color: Navy;">Investment Certificate</h1><br />
             <?php if (isset($investors)) {
                            foreach ($investors as $investor):
                                ?><b style="font-size: 18px;"><br /><i style="color: Navy;"><?php  if(isset($investor['surname'])) {
                                            echo $investor['surname'].' ';
                                        }else{
                                            echo '';
                                        } if(isset($investor['other_names'])) {
                                            echo $investor['other_names'];
                                        }else{
                                            echo '';
                                        } ?></i></b>
                                <?php endforeach;
} ?>
        	<br />
            <b>Investment No:  <?php if (isset($investment_number)) {
                        echo $investment_number;
                    } ?></b><br />
                     <?php if (isset($investment_array['Investment']['investment_date'])) { ?> <b>Date: </b>
                        <?php echo $investment_array['Investment']['investment_date']; ?>
<?php } elseif (isset($investment_array['Investment']['purchase_date'])) { ?>
                        <b>Purchase Date: </b>
    <?php echo $investment_array['Investment']['purchase_date'];
}
?>
        </td>
    </tr>
    <tr>
        <td align="left" valign="top" width="50%">&nbsp;</td>
        <td align="left" valign="top" width="50%">&nbsp;</td>
    </tr>
    <tr>
        <td align="left" valign="top" width="50%" >&nbsp;</td>
        <td align="left" valign="top" width="50%" >&nbsp;</td>
    </tr>
    <tr>
        <td align="left" valign="top" width="50%">&nbsp;</td>
        <td align="left" valign="top" width="50%">&nbsp;</td>
    </tr>
    <tr>
        <td align="left" valign="top" width="50%" style="border-top: solid 2px Gray;">&nbsp;</td>
        <td align="left" valign="top" width="50%" style="border-top: solid 2px Gray;">&nbsp;</td>
    </tr>
    <tr>
        <td align="left" valign="top" width="50%">
            <table width="100%" cellspacing="10" cellpadding="0" border="0">

<!--                <tr>
                    <td><b align="right">Portfolio Type:</b></td>
                    <td><span id="xxxxxx"><?php //if (isset($investment_array['Portfolio']['payment_name'])) {
    //echo $investment_array['Portfolio']['payment_name'];
//} ?></span></td>
                </tr>-->
               <tr><?php if (isset($investment_array['InvestmentTerm']['term_name'] )) { ?>
                                <td><b align="right">Investment Term:</b></td>
                                <td><span id="xxxxxx">
                                <? echo $investment_array['InvestmentTerm']['term_name'];
                                ?>
                                    </span></td> <?php
                            }
                            if (isset($investment_array['Investment']['equity'])) { ?>
                            <td><b align="right">Equity Purchased:</b></td>
                                <td><span id="xxxxxx"><?php echo $investment_array['Investment']['equity'];
                                ?>   </span></td> <?php
                            }?>
                </tr> 
                <tr>
                 <?php  if (isset($investment_array['Investment']['custom_rate']) && $investment_array['Investment']['custom_rate'] > 0) { ?><td><b align="right"> Investment Rate:</b></td>
                            <td><span id="xxxxxx"><?php
                                   
                                        echo $investment_array['Investment']['custom_rate'].'%';
                                  
                            ?></span></td> <?php } 
                            elseif (isset($investment_array['Investment']['purchase_price'])) { ?>
                            <td><b align="right">Purchase Price:</b></td>
                                <td><span id="xxxxxx"><?php echo $shopCurrency . ' ' . $investment_array['Investment']['purchase_price'];
                                ?>   </span></td> <?php
                            }?>
                </tr>
                 <?php  if (isset($investment_array['Investment']['numb_shares'])) { ?> <tr>
                 <td><b align="right">No. of Shares Purchased:</b></td>
                            <td><span id="xxxxxx"><?php
                                   
                                        echo $investment_array['Investment']['numb_shares'];
                                  
                            ?></span></td>
                </tr> <?php } ?>
            </table>
        </td>
        <td align="left" valign="top" width="50%">
            <table width="100%" cellspacing="10" cellpadding="0" border="0">
                <tr>
                    <td><b align="right">Amount Invested:</b></td>
                    <td><span id="xxxxxx"><?php if (isset($investment_array['Investment']['investment_amount'])) {
                        if($investment_array['Investment']['status'] == 'Rollover'){
                            echo $shopCurrency. ' ' .$rollover_details['amount'];
                        }else{
                            
                           echo $shopCurrency. ' ' .$investment_array['Investment']['investment_amount'];  
                        }
   
}elseif(isset ($investment_array['Investment']['total_amount'])){
                                           echo $shopCurrency . ' ' . $investment_array['Investment']['total_amount'];
                                         
                                    }
                                    ?></span></td>
                </tr>
<!--                <tr>
                    <td><b align="right">Rate:</b></td>
                    <td><span id="xxxxxx"><?php //if (isset($payment['Rate']['interest_rate'])) {
   // echo $payment['Rate']['interest_rate'].'%';
//} 
										 ?></span></td>
                </tr> -->
<!--                <tr>
                    <td><b align="right">TAX:</b></td>
                    <td><span id="xxxxxx"><?php // if (isset($payment['Order']['tax_charge'])) {
  
                  //  echo $shopCurrency. ' ' .$payment['Order']['tax_charge'];
//} 
										 ?></span></td>
                </tr> -->
                <tr>
                    <td><b align="right">Tax:</b></td>
                    <td><span id="xxxxxx"><?php //if (isset($payment['Investments']['tax'])) {
   // echo $shopCurrency. ' 0.00';//$payment['Investments']['tax'];
//}
										 ?></span></td>
                </tr>
                <tr>
                   <?php if (isset($investment_array['Investment']['amount_due']) && $investment_array['Investment']['amount_due'] > 0) {?> <td><b align="right">Amount Due:</b></td>
                    <td><span id="xxxxxx"><b>
  <?php  echo $shopCurrency. ' ' .$investment_array['Investment']['amount_due'];
  ?></b></span></td> <?php }elseif(isset($investment_array['Investment']['total_fees'])){ ?>
                     <td><b align="right">Total Fees:</b></td>
                    <td><span id="xxxxxx"><b>
  <?php  echo $shopCurrency. ' ' .$investment_array['Investment']['total_fees'];
  ?></b></span></td> <?php } ?>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="left" valign="top" width="50%">&nbsp;</td>
        <td align="left" valign="top" width="50%">&nbsp;</td>
    </tr>
    <tr>
        <td align="left" valign="top" width="50%" style="border-top: solid 2px Gray;">&nbsp;</td>
        <td align="left" valign="top" width="50%" style="border-top: solid 2px Gray;">&nbsp;</td>
    </tr>
    <tr>
        <td align="left" valign="top" width="50%">
            <p><b>Issued by: </b> <?php if(isset($issued)){echo $issued;} ?></p>
        </td>
        <td align="left" valign="top" width="50%">

        </td>
    </tr>
    <tr>
        <td align="left" valign="top" colspan="2">
			 <p ><b>TERMS AND CONDITIONS</b></p>
				<ol style="font-size: 10px;">
					<li>Payment of principal, interest or proceeds shall be effected based on specific instructions provided at time product is chosen, and payment shall be made following satisfactory identification of investment holder.</li>
					<li>Additions or amendments to instructions may be noted, agreed upon and documented as appropriate, and shall be effective following documentation. Instructions may be received and accepted via email, from a recognized email address.</li>
					<li>All investments must run until the agreed term expires.</li>
					<li>Please provide a valid identification document (photocopy to be kept by Parkstone), details of which have been indicated on form.</li>
				</ol>
		 </td>
        
    </tr>
</table>
<table cellspacing="0" cellpadding="0" border="0" align="left" width="700px">
	<tr>
		<td align="left" valign="top" width="50%">&nbsp;</td>
		<td align="left" valign="top" width="50%">&nbsp;</td>
	</tr>
	<tr>
		<td align="left" valign="top" width="50%">&nbsp;</td>
		<td align="right" valign="top" width="50%">
			<?php 
				echo $this->Html->link('Return',"/Investments/newInvestment0",array('style' =>'font-size: 14px;', 'class'=>'btn btn-lg btn-info')); 
				echo $this->Html->link('Print',"javascript:void(0)",array("class" => 'btn btn-lg btn-warning',"id" => "print_receipt")); 
			?>
		</td>
	</tr>
</table>