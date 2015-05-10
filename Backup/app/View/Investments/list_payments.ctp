<?php echo $this->element('header'); ?>
<?php

if ($this->Session->check('shopCurrency')) {
    $shopCurrency = $this->Session->read('shopCurrency');
} else {
    $shopCurrency = "";
}
?>

<!-- Content starts here -->
<h3>Payments</h3>
<div class="boxed">
	<div class="inner">
            <div id="clearer"></div>

    <h3>Investor: <?php echo "Kwaku Afreh-Nuamah"; ?></h3><br />
    <p style="color: red;"><i>
		To edit a payment, please click the Investment ID in the list.
		</i></p>
    <div id="clearer"></div>

    <div id="report_content" style="font-size: 95%">        <form id="order_list" action="#" method="post">
                    <table border="0" width="100%" cellspacing="0" cellpadding="0" align="left">
                            <tr>
                                  <td style="border-bottom: solid 2px dodgerblue;" align="left">
                                      <b><?php echo 'Investment ID'; ?></b>
                                  </td>
                                  <td style="border-bottom: solid 2px dodgerblue" align="left">
                                    <b><?php echo 'Amount Invested'; ?></b>
                                </td>
                                <td style="border-bottom: solid 2px dodgerblue" align="left">
                                    <b><?php echo 'Amount Due'; ?></b> 
                                </td>
                                <td style="border-bottom: solid 2px dodgerblue" align="left">
                                    <b><?php echo 'Payment Date'; ?></b>
                                </td>
                                <td style="border-bottom: solid 2px dodgerblue" align="left">
                                    <b><?php echo 'Amount Paid'; ?></b>
                                </td>
                                <td style="border-bottom: solid 2px dodgerblue" align="left">
                                    <b><?php echo 'Payment Mode'; ?></b>
                                </td>
                                <td style="border-bottom: solid 2px dodgerblue" align="left">
                                    <b><?php echo 'Delete'; ?></b>
                                </td>
                            </tr>  
                            <tr>
                                <td align="left">
                                    <?php echo $this->Html->link("001", "/Investments/editPayment/"); ?>
                                </td>
                                <td align="left">
                                    <?php echo '20,000'; ?>
                                </td>
                                <td align="left">
                                    <?php echo '23,000'; ?> 
                                </td>
                                <td align="left">
                                    <?php echo '10/05/2014'; ?>
                                </td>
                                <td align="left">
                                    <?php echo '23,000'; ?>
                                </td>
                                <td align="left">
                                    <?php echo 'Cash'; ?>
                                </td>
                                <td align="left">
                                    <?php echo $this->Html->link("Delete", "/Investments/delPayment/"); ?>
                                </td>
                            </tr>  
                            <tr>
                                  <td align="left">
                                      <?php echo $this->Html->link("002", "/Investments/editPayment/"); ?>
                                  </td>
                                  <td align="left">
                                    <?php echo '40,000'; ?>
                                </td>
                                <td align="left">
                                    <?php echo '46,000'; ?> 
                                </td>
                                <td align="left">
                                    <?php echo '03/03/2014'; ?>
                                </td>
                                <td align="left">
                                    <?php echo '23,000'; ?>
                                </td>
                                <td align="left">
                                    <?php echo 'Cheque'; ?>
                                </td>
                                <td align="left">
                                    <?php echo $this->Html->link("Delete", "/Investments/delPayment/"); ?>
                                </td>
                            </tr> 
                            <tr>
                                  <td align="left">
                                      <?php echo $this->Html->link("003", "/Investments/editPayment/"); ?>
                                  </td>
                                  <td align="left">
                                    <?php echo '40,000'; ?>
                                </td>
                                <td align="left">
                                    <?php echo '46,000'; ?> 
                                </td>
                                <td align="left">
                                    <?php echo '01/02/2014'; ?>
                                </td>
                                <td align="left">
                                    <?php echo '46,000'; ?>
                                </td>
                                <td align="left">
                                    <?php echo 'Cash'; ?>
                                </td>
                                <td align="left">
                                    <?php echo $this->Html->link("Delete", "/Investments/delPayment/"); ?>
                                </td>
                            </tr>
        <?php // if (isset($total)) {
            //foreach ($total as $each_item):
                ?>
                <tr>
                    <td align="left" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">Totals</td>
                    <td align="left" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                    <td align="left" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                    <td align="left" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                   
                    <td align="left" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;"><?php
                if (isset($amount)) {
                    echo 'Amount Paid: '.$shopCurrency . ' ' . round($amount, 0);
                }
                ?></td>
                    <td align="left" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                    <td align="left" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;"><?php
                if (isset($balance)) {
                    echo 'Outstanding Balance: '.$shopCurrency . ' ' . round($balance, 0);
                }
                ?></td>
                    
                </tr>
                <tr>
                    <td>&nbsp; </td>
                </tr>
                  
                            <tr>
                                
                                <td colspan="7" align="right">
                                <?php
								//echo $this->Html->link('Back','/Investments/manageInvestments/',array("class" => 'btn btn-xs btn-info'));
                                echo $this->Html->link('Print', "javascript:void(0)", array("class" => 'btn btn-warning', "id" => "print_report"));           
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td  colspan="7" align="right">&nbsp;</td>
                            </tr>
                            <tr>
                                <td  colspan="7" align="right">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="7" align="center">
                                   <?php
//                                   echo $this->Paginator->first($this->Html->image('first.png', array('width'=>15, 'height'=>15, 'valign'=>'middle', 'alt'=>'First', 'title'=>'First')), array('escape' => false), null, null, array('class' => 'disabled'))."&nbsp;&nbsp;&nbsp;&nbsp;";
//                                   echo $this->Paginator->prev($this->Html->image('prev.png', array('width'=>15, 'height'=>15, 'valign'=>'middle', 'alt'=>'Previous', 'title'=>'Previous')), array('escape' => false), null, null, array('class' => 'disabled'))."&nbsp;&nbsp;&nbsp;&nbsp;";
//                                   echo $this->Paginator->numbers()."&nbsp;&nbsp;";
//                                   echo $this->Paginator->next($this->Html->image('next.png', array('width'=>15, 'height'=>15, 'valign'=>'middle', 'alt'=>'Next', 'title'=>'Next')), array('escape' => false), null, null, array('class' => 'disabled'))."&nbsp;&nbsp;&nbsp;&nbsp;";
//                                   echo $this->Paginator->last($this->Html->image('last.png', array('width'=>15, 'height'=>15, 'valign'=>'middle', 'alt'=>'Last', 'title'=>'Last')), array('escape' => false), null, null, array('class' => 'disabled'))."&nbsp;&nbsp;&nbsp;&nbsp;";
//                                   //prints X of Y, where X is current page and Y is number of pages
//                                   echo $this->Paginator->counter(array('format' => 'Page %page%, showing %current% items'));  
                                   ?>
                                </td>
                            </tr>
                    </table>
                    </form>
    </div>
    <table width="100%" cellspacing="10" cellpadding="0" border="0">
        <tr>
            <td align="left" valign="top" >&nbsp;</td>
            <td align="left" valign="middle" width="375" >
                &nbsp;
            </td>
            <td align="left" valign="middle" width="375"><?php 
                //echo $this->Html->link('Next',"/Payments/payment",array("class" => 'button_blue')); 
               
                
                ?></td>
        </tr>
    </table>
    
</div>
<!-- Content ends here -->

<?php echo $this->element('footer'); ?>