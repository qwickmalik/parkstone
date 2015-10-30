<?php echo $this->element('header'); 
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js');
?>
<h3>New Outbound Investment Summary</h3>
<div class="boxed">
	<div class="inner">
            <div id="clearer"></div>
		
		
<table id="payment_receipt" border="0" width="700px" cellspacing="0" cellpadding="5" align="center" style="border: solid 10px green;">
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
            <h1 style="color: Green;">Reinvestment Summary</h1><br />
            <b style="font-size: 18px;"> <?php if (isset($investors)) {
                            foreach ($investors as $investor):
                                ?><br /><i style="color: Navy;"><?php  if(isset($investor['surname'])) {
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
            <b>Date: </b><?php if (isset($investment_array['Investment']['investment_date'])) {
                        echo $investment_array['Investment']['investment_date'];
                    } ?>
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

                <tr>
                    <td><b align="right">Company/fund:</b></td>
                    <td><span id="xxxxxx"><?php 
                        echo "Investee Company Name";
                    ?>
                        </span></td>
                </tr>
               <tr>
                    <td><b align="right">Investment Term:</b></td>
                    <td><span id="xxxxxx"><?php if (isset($investment_array['InvestmentTerm']['term_name'])) {
    echo $investment_array['InvestmentTerm']['term_name'];
} 
										 ?>
										 </span></td>
                </tr> 
                <tr>
                    <td><b align="right">Benchmark Rate:</b></td>
                    <td><span id="xxxxxx"><?php if (isset($investment_array['InvestmentTerm']['interest_rate'])) {
    echo $investment_array['InvestmentTerm']['interest_rate'];
} ?></span></td>
                </tr>
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
   
} ?></span></td>
                </tr>

                <tr>
                    <td><b align="right">Tax:</b></td>
                    <td><span id="xxxxxx"><?php //if (isset($payment['Investments']['tax'])) {
   // echo $shopCurrency. ' 0.00';//$payment['Investments']['tax'];
//}
										 ?></span></td>
                </tr>
                <tr>
                    <td><b align="right">Amount Due:</b></td>
                    <td><span id="xxxxxx"><b><?php if (isset($investment_array['Investment']['amount_due'])) {
    echo $shopCurrency. ' ' .$investment_array['Investment']['amount_due'];
} ?></b></span></td>
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
            <p><b>Created by: </b> <?php if(isset($issued)){echo $issued;} ?></p>
        </td>
        <td align="left" valign="top" width="50%">

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
				echo $this->Html->link('Return',"/Reinvestments/newInvestment",array('style' =>'font-size: 14px;', 'class'=>'btn btn-lg btn-info')); 
				echo $this->Html->link('Print',"javascript:void(0)",array("class" => 'btn btn-lg btn-warning',"id" => "print_receipt")); 
			?>
		</td>
	</tr>
</table>
        </div>
    
<?php echo $this->element('footer'); ?>