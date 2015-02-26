<?php 

echo $this->Html->script('jquery.js');
 echo $this->Html->script('jquery.printElement.js');
echo $this->Html->script('notification.js');
echo $this->Html->css('template.css');

?>
<div>
<table id="payment_receipt" border="0" width="700px" cellspacing="0" cellpadding="5" align="center" style="border: solid 1px Gray;">
    <?php  $shopCurrency =""; if ($this->Session->check('shopCurrency')) {
                        $shopCurrency = $this->Session->read('shopCurrency');
                        
                    }
                    ?>
        <tr>
            <td align="left" valign="top" colspan="2">
                    <div style="float: left; width: auto; height: auto; margin: 0; padding: 10px 100px 10px 10px;">
                        <?php echo $this->Html->image('logo.png'); ;?>
                    </div>
                    <div style="font-weight: bold;">
                        <p style="font-size: 25px;"><?php if( $this->Session->check('shopName') ) {
                        $shopName = $this->Session->read('shopName');
                        echo $shopName;
                        
                        }
                        ?></p>
                        <p><?php
                        $postaladd = 'Postal Address: ';
                        
                        if( $this->Session->check('shopAddress') ) {
                        $shopAddress = $this->Session->read('shopAddress');
                        $postaladd .=$shopAddress;
                        if( $this->Session->check('shopPosttown') ) {
                        $shopPosttown = $this->Session->read('shopPosttown');
                        
                       // $postaladd .= ', '.$shopPosttown;
                        }
                        if( $this->Session->check('shopPostCity') ) {
                        $shopPostCity = $this->Session->read('shopPostCity');
                        $postaladd .= ', '.$shopPostCity;
                        }
                        if( $this->Session->check('shopPostCount') ) {
                        $shopPostCount = $this->Session->read('shopPostCount');
                         $postaladd .= ', '.$shopPostCount;
                        
                         }
                         echo $postaladd;
                        }
                        
                        
                        ?></p>
                        <p><?php if( $this->Session->check('shopMobile') ) {
                        $shopMobile = $this->Session->read('shopMobile');
                        
                        echo 'Mobile Phone: '.$shopMobile;
                        }
                        ?></p>
                    </div>
            </td>
        </tr>
        <tr>
            <td align="left" valign="top" width="50%" style="border-top: solid 2px Gray;">&nbsp;</td>
            <td align="left" valign="top" width="50%" style="border-top: solid 2px Gray;">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top" width="50%">
                <b style="font-size: 20px; font-weight: bold; display: block; width:90%; height: 100%; background-color: dodgerblue; padding: 10px 10px 10px 10px; text-align: center; border: solid 1px gray; color: #ffffff;">Investment Payment Receipt</b><br />
                <b style="font-size: 14px;">To: <?php if(isset($payment['Investor']['fullname'])){echo $payment['Investor']['fullname'];} ?></b>
            </td>
            <td align="left" valign="top" width="50%">
<!--                <b>Warehouse: Warehouse name</b><br></br>-->
                <b>Investment No.: <?php if(isset($payment['Investment']['investment_no'])){echo $payment['Investment']['investment_no'];} ?></b><br></br>
                <b>Date: </b><?php $check = $this->Session->check('payment_date');
            if ($check) {
                $pdate = $this->Session->read('payment_date');
                        echo $pdate;;
            } ?>
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
                    <td><b align="right">Investment Term:</b></td>
                    <td><span id="xxxxxx"><?php if (isset($payment['InvestmentTerm']['term_name'])) {
    echo $payment['InvestmentTerm']['term_name'];
} ?></span></td>
                </tr>
                <tr>
                    <td><b align="right">Investment Rate:</b></td>
                    <td><span id="xxxxxx"><?php if (isset($payment['Investment']['custom_rate'])) {
    echo $payment['Investment']['custom_rate'].'%';
} ?></span></td>
                </tr>
                
                <tr>
                    <td><b align="right">&nbsp;</b></td>
                    <td><span id="xxxxxx">&nbsp;</span></td>
                </tr>
            </table>
        </td>
        <td align="left" valign="top" width="50%">
            <table width="100%" cellspacing="10" cellpadding="0" border="0">
                <tr>
                    <td><b align="right">Amount Invested:</b></td>
                    <td><span id="xxxxxx"><?php if (isset($payment['Investment']['investment_amount'])) {
    echo $shopCurrency. ' ' .$payment['Investment']['investment_amount'];
} ?></span></td>
                </tr>
<!--                <tr>
                    <td><b align="right">Rate:</b></td>
                    <td><span id="xxxxxx"><?php //if (isset($payment['Rate']['interest_rate'])) {
   // echo $payment['Rate']['interest_rate'].'%';
//} ?></span></td>
-->                </tr>
                <tr>
                    <td><b align="right">Interest Earned:</b></td>
                    <td><span id="xxxxxx"><?php  if (isset($payment['Investment']['interest_accrued'])) {
  
                    echo $shopCurrency. ' ' .$payment['Investment']['interest_accrued'];
} ?></span></td>
                </tr>
                <tr>
                    <td><b align="right">Amount Due:</b></td>
                    <td><span id="xxxxxx"><?php  if (isset($payment['Investment']['total_amount_earned'])) {
  
                    echo $shopCurrency. ' ' .$payment['Investment']['total_amount_earned'];
} ?></span></td>
                </tr>
                
                <tr>
                    <td><b align="right">Amount Paid:</b></td>
                    <td><span id="xxxxxx"><b><?php if (isset($payment_amt)) {
    echo $shopCurrency. ' ' .$payment_amt;
} ?></b></span></td>
                </tr>
                
                <tr>
                    <td><b align="right">Outstanding Balance:</b></td>
                    <td><span id="xxxxxx"><b><?php if (isset($payment['Investment']['earned_balance'])) {
    echo $shopCurrency. ' ' .$payment['Investment']['earned_balance'];
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
                <p><b>Issued by: </b><?php if(isset($issued)){echo $issued;} ?></p>
            </td>
            <td align="right" valign="top" width="50%" >
                &nbsp;
               
            </td>
            
        </tr>
        <tr>
            <td align="left" valign="top" width="50%">&nbsp;</td>
            <td align="left" valign="top" width="50%">
                &nbsp;
            </td>
        </tr>
    </table>
    
    <table border="0" width="700px" cellspacing="0" cellpadding="5" align="center">
        <tr>
            <td align="left" valign="top" width="50%">&nbsp;</td>
            <td align="left" valign="top" width="50%">
                &nbsp;
            </td>
        </tr>
         <tr>
            <td align="left" valign="top" width="50%">&nbsp;</td>
            <td align="right" valign="top" width="50%">
                 <?php 
               echo  $this->Html->link('Return',"/Investments/manageClientInvestments/".(isset($payment['Investor']['id']) ? $payment['Investor']['id'] : '' )."/".(isset($payment['Investor']['fullname']) ? $payment['Investor']['fullname'] : '' ),array('style' =>'font-size: 14px;')); 
                echo $this->Html->link('Print Receipt',"javascript:void(0)",array("class" => 'button_red',"id" => "print_receipt")); 
           // echo $this->Form->button('Print Receipt',array("type" => "submit","class" => "button_red","id"=>"print_receipt"));
                ?>
            </td>
        </tr>
    </table>
    
    </div>