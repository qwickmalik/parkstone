<?php
 echo $this->element('header');
 
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js');

$shopCurrency =""; if ($this->Session->check('shopCurrency')) {
    $shopCurrency = $this->Session->read('shopCurrency');

}
?>

<h3>Payment Receipt</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <table id="payment_receipt" border="0" cellspacing="0" cellpadding="5" align="left" style="border:none;">
            <tr>
                <td align="left">
            
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <?php 
                                    echo $this->Html->image('parkstone_logo2.png', array('style' => 'float: left; margin-right: 20px;','width' => 120, 'alt' => $this->Session->read('shopName')));
                                    ?>
                                    <p style='font-weight: bold; font-size: 16px; text-align: left;'>
                                        <?php 
                                        echo $this->Session->read('shopName').'<br />'; 
                                        echo 'INVESTMENT PAYMENT RECEIPT'; 
                                        ?></p>
                                    <p align='left'>Generated on <?php echo date('jS F, Y'); ?></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p align="right"><?php echo $this->Session->read('shopAddress') . ', ' . $this->Session->read('shopPosttown') . '<br />' . $this->Session->read('shopPostCity') . ', ' . $this->Session->read('shopPostCount') . '<br />' . $this->Session->read('shopTelephone') . '<br />' . $this->Session->read('shopEmail'); ?></p>
                                </div>
                            </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            &nbsp;
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <b style="font-size: 14px;">To: <?php if(isset($payment['Investor']['fullname'])){echo $payment['Investor']['fullname'];} ?></b><br />
                            <b>Receipt No.: <?php if(isset($voucher_no)){echo $voucher_no; } ?></b><br />
                            <b>Date: </b><?php $check = $this->Session->check('payment_date');
                            if ($check) {
                                $pdate = $this->Session->read('payment_date');
                                        echo $pdate;
                            } ?>
                            
                            
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            &nbsp;
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            &nbsp;
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                            <b align="right"> </b>
                            <table class="table table-condensed">
                                <tr>
                                    <td><b align="right">Total Amount Invested:</b></td>
                                      <td>
                                          <?php if (isset($payment['ClientLedger']['invested_amount'])) {
                                                echo $shopCurrency. ' ' .number_format($payment['ClientLedger']['invested_amount']);
                                            } ?>
                                      </td>
                                  </tr>
                                  <tr>
                                    <td><b align="right">Closing Balance:</b></td>
                                      <td>
                                          <?php  if (isset($payment['ClientLedger']['available_cash'])) {
                                                echo $shopCurrency. ' ' .number_format($payment['ClientLedger']['available_cash']);
                                              } ?>
                                      </td>
                                  </tr>
                                  <tr>
                                    <td><b align="right">Amount Paid:</b></td>
                                       <td><b><?php if (isset($payment_amt)) { echo $shopCurrency. ' ' .number_format($payment_amt, 2, '.', ',');} ?></b></td>
                                   </tr>      

                                   <tr>
                                      <td><b align="right">Cheque No.:</b></td>
                                       <td><b><?php if (isset($check_nos)) {
                                            echo $check_nos;
                                        } ?></b>
                                       </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <p><b>Issued by: </b><?php if(isset($issued)){echo $issued;} ?></p>
                                        </td>
                                        <td align="right">
                                            &nbsp;
                                        </td>
                                    </tr>
                            </table>
                            
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            &nbsp;
                        </div>
                    </div>
                        
            </td>
        </tr>
    </table>
            
        
                 <?php 
               echo  $this->Html->link('Return',"/Investments/processPayments/".(isset($payment['Investor']['id']) ? $payment['Investor']['id'] : '' )."/".(isset($payment['Investor']['fullname']) ? $payment['Investor']['fullname'] : '' ),array('class' =>'btn btn-md btn-info', 'style' => 'float: right;')); 
                echo $this->Html->link('Print Receipt',"javascript:void(0)",array("class" => 'btn btn-md btn-warning',"id" => "print_receipt", 'style' => 'float: right;')); 
           // echo $this->Form->button('Print Receipt',array("type" => "submit","class" => "button_red","id"=>"print_receipt"));
                ?>
           
    
        </div>
    </div>
    <!-- Content end here -->
<?php echo $this->element('footer'); ?>