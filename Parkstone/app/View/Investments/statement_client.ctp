<?php echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js');

if ($this->Session->check('shopCurrency')) {
    $shopCurrency = $this->Session->read('shopCurrency');
} else {
    $shopCurrency = "";
}?>
<h3>Client Statement (Fixed)</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <div class="inner_print">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        &nbsp;
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php 
                        echo $this->Html->image('parkstone_logo2.png', array('style' => 'float: left; margin-right: 20px;','width' => 120, 'alt' => $this->Session->read('shopName')));
                        ?>
                        <p style='font-weight: bold; font-size: 14px; text-align: left;'>
                            <?php 
                            echo $this->Session->read('shopName').'<br />'; 
                            echo 'CLIENT STATEMENT'.'<br />';
                            
                            echo 'CLIENT NAME: '.(!empty($investor_name)?$investor_name:'').'<br />'; 
                            if(!empty($investor_data['Investor']['in_trust_for'])){
                             echo 'IN-TRUST-FOR: '.(!empty($investor_data['Investor']['in_trust_for'])?$investor_name:'');    
                            }
                            ?></p>
                        
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <p align="right"><?php echo $this->Session->read('shopAddress') . ', ' . $this->Session->read('shopPosttown') . '<br />' . $this->Session->read('shopPostCity') . ', ' . $this->Session->read('shopPostCount') . '<br />' . $this->Session->read('shopTelephone') . '<br />' . $this->Session->read('shopEmail').'<br />';echo "Generated on ".date('jS F, Y').'<br />'; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table class="table table-striped">
                    
                    <tr>
                        <th align="left" width="120">Date</th>
                        <th align="left" width="150">Inv. Number &nbsp;</th>
                        <th align="left">Inv. Amount</th>
                        <th align="left">Benchmark Rate</th>
                        <th align="left" width="120">Maturity Date</th>
                        <th align="left">Accrued Days</th>
                        <th align="left">Accrued Interest</th>
                        <th align="left">Principal Plus Interest</th>
                        <th align="left">Payments</th>
                        <th align="left">Balance Due</th>
                    </tr>
                    <?php if(isset($data)){ foreach ($data as $each_item): 
                        
                    $amount = 0;
                    if(!empty($each_item['InvestmentPayment']) ){
                    foreach ($each_item['InvestmentPayment'] as $val):
                        if($val['event_type'] == 'Payment'){
                        $amount += $val['amount'];
                        }
                        endforeach;
                    }
                        ?>
                    
                       <tr>
                            <td align="left"><?php if (isset($each_item['Investment']['investment_date'])) {
            echo  date('d-M-Y',strtotime($each_item['Investment']['investment_date']));
        } ?></td>
                            <td align="left"><?php echo $each_item['Investment']['investment_no']; ?></td>
                            <td align="left"><?php if (isset($each_item['Investment']['investment_amount'])) {
            echo  number_format($each_item['Investment']['investment_amount'],2);
        } ?></td>
                            <td align="left"><?php echo $each_item['Investment']['custom_rate'].'%'; ?></td>
                            <td align="left"><?php if (isset($each_item['Investment']['due_date'])) {
            echo  date('d-M-Y',strtotime($each_item['Investment']['due_date']));
        } ?></td>
                            <td align="left"><?php if (isset($each_item['Investment']['id'])){
                                $id = $each_item['Investment']['id'];
                               $accrued_days = $this->requestAction('/Investments/get_accrueddays/'.$id);
            echo $accrued_days;
        } ?></td>
                            <td align="left"><?php if (isset($each_item['Investment']['id'])) {
                                $id = $each_item['Investment']['id'];
                               $interest_accrued = $this->requestAction('/Investments/get_accruedinterest/'.$id);
            echo  number_format($interest_accrued,2);
        } ?></td>
                            <td align="left"><?php if (isset($each_item['Investment']['id']) && isset($each_item['Investment']['investment_amount'])) {
                                 $id = $each_item['Investment']['id'];
                               $interest_accrued_calc = $this->requestAction('/Investments/get_accruedinterest/'.$id);
                                
                                $totals = $interest_accrued_calc + $each_item['Investment']['investment_amount'];
        
            echo number_format($totals,2);
            
                        } ?></td>
                            <td align="left"><?php if (isset($amount)) {
            echo  number_format($amount,2);
        } ?></td>
                            <td align="left"><?php if (isset($each_item['Investment']['earned_balance'])) {
            echo  number_format($each_item['Investment']['earned_balance'],2);
        } ?></td>
                       </tr>
                       
                       
                    <?php 
                    if(!empty($each_item['Topup']) ){
                        ?>
                       <tr ><td colspan="10">
                               <table class="table table-condensed" style="font-size:75%">
                                  <tr>
                                      <th align="left" width="120">&nbsp;</th>
                        <th align="left" width="120">&nbsp;</th>
                        <th align="left" width="150">Topup Amt. &nbsp;</th>
                        <th align="left">Benchmark(%)</th>
                        <th align="left">Interest</th>
                        <th align="left">Topup Date</th>
                        <th align="left" width="120">Maturity Date</th>
                        <th align="left">Topup Tenure</th>
                    </tr>  
                    <?php
                    
                    foreach ($each_item['Topup'] as $val):
                                    ?>
                    <tr>
                        <th align="left" width="120">&nbsp;</th>
                            <td align="left">&nbsp;</td>
                            <td align="left"><?php echo  number_format($val['topup_amount'],2); ?></td>
                            <td align="left"><?php if (isset($each_item['Investment']['custom_rate'])) {
            echo  $each_item['Investment']['custom_rate'].'%';
        } ?></td>
                            <td align="left"><?php echo number_format($val['topup_interest'],2); ?></td>
                            <td align="left"><?php if (isset($val['investment_date'])) {
            echo  date('d-M-Y',strtotime($val['investment_date']));
        } ?></td>
                            <td align="left"><?php if (isset($each_item['Investment']['due_date'])){
                                echo  date('d-M-Y',strtotime($each_item['Investment']['due_date']));
        } ?></td>
                            <td align="left"><?php if (isset($val['tenure'])) {
            echo  $val['tenure'].'Day(s)';
        } ?></td>
                            
                       </tr>
                       <?php
                       endforeach;
                       ?>
                               </table>
                           </td> 
                       </tr>
                       
                       <?php
                        
                    }
                    endforeach;
                    
                     
                       }
                    ?>
                   
                    <tr>
                        <td align="left" valign="top" ></td>
                        <td align="left" valign="top" >&nbsp;</td>
                        <td align="right" valign="top" >&nbsp;</td>
                        <td align="right" valign="top" > &nbsp;</td>
                        <td align="left" valign="top" >&nbsp;</td>
                        <td align="right" valign="top" >&nbsp;</td>
                        <td align="right" valign="top" >&nbsp;</td>
                        <td align="right" valign="top">&nbsp;</td>
                        <td align="right" valign="top" >&nbsp; </td>
                        <td align="right" valign="top" > &nbsp;</td>
                    </tr>
                 
                       <?php if (isset($total)) {
            foreach($total as $each_item):
                ?>
                    <tr>
                        <td align="left" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                        <td align="left" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">Total(<?php echo $shopCurrency; ?>)</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">
                            <?php   if (isset($each_item[0]['balance_due'])) {
                                echo number_format($each_item[0]['balance_due'], 2);
                            }
                            ?>
                        </td>
                    </tr>
                        <?php endforeach;
                }
                ?>
                    <tr>
                        <td align="left" colspan="10" style="border-bottom: solid 1px #ffffff;background: #ffffff;">&nbsp;</td>
                    </tr>
                    
                    <tr>
                        <td align="right"  valign="top" colspan="3">PARKSTONE OFFICIAL NAME :</td>

                        <td align="left" valign="top" colspan="3">
                            <b><?php if(isset($issued)){echo $issued;} ?></b>
                        </td>
                        <!--<td align="left" valign="top" >&nbsp;</td>-->
                        <td align="right" valign="top" >&nbsp;</td>
                        <td align="right" valign="top" >SIGNATURE:</td>
                        <td align="right" valign="top">&nbsp;</td>
                        <td align="right" valign="top" >&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left" colspan="10" style="border-bottom: solid 1px #ffffff;background: #ffffff;"></td>
                    </tr>
                     
                </table>
            </div>
            </div>
            <?php
            echo "<p>&nbsp;</p>";
            echo $this->Html->link('Print', "javascript:void(0)", array('style' => 'float: right;', "class" => 'btn btn-lg btn-warning', "id" => "print_receipt"));
            echo $this->Html->link('Return', "/Investments/manageInvestments", array('style' => 'float: right;', 'class' => 'btn btn-lg btn-info'));
            ?>
        </div>
    </div>
    <!-- Content end here -->
<?php echo $this->element('footer'); ?>

