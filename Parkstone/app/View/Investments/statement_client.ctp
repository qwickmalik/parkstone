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
                    <?php 
                    
                   $account_tot_bal = 0;
                    
                    if(isset($data)){ foreach ($data as $each_item): 
                    $topup_pt = 0;    
                    $amount = 0;
                    $topup_in = 0;
                     $total_bal = 0;
                     $invest_int = 0;
                     $invest_amount = 0;
                     $interest_accrued = 0;
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
                            <td align="left"><?php if (!empty($each_item['Investment']['investment_amount'])) {
                                if(!empty($topup_principal)){
                                    
                                    foreach($topup_principal as $tp_val){
                                        if($tp_val['Topup']['investment_id'] == $each_item['Investment']['id']){
                                        $topup_pt += $tp_val[0]['total_topup'];
                                        }
                                    }
                                    $invest_amount = $each_item['Investment']['investment_amount'] - $topup_pt;
                                    echo  number_format($invest_amount,2);
                                }else{
              $invest_amount = number_format($each_item['Investment']['investment_amount'],2);
            echo $invest_amount;
                                }
        } ?></td>
                            <td align="left"><?php echo $each_item['Investment']['custom_rate'].'%'; ?></td>
                            <td align="left"><?php if (isset($each_item['Investment']['due_date'])) {
            echo  date('d-M-Y',strtotime($each_item['Investment']['due_date']));
        } ?></td>
                            <td align="left"><?php if (isset($each_item['Investment']['id'])){
                                $id = $each_item['Investment']['id'];
                               $accrued_days = $this->requestAction('/Investments/get_accrueddays/'.$id);
            echo $accrued_days;
        
        
         
                                
                            }
        
        ?></td>
                            <td align="left"><?php if (isset($each_item['Investment']['id'])) {
                                $id = $each_item['Investment']['id'];
                               $interest_accrued = $this->requestAction('/Investments/get_accruedinterest/'.$id);
            
            
            
//              if(!empty($topup_principal)){
//                                    
//                                    foreach($topup_principal as $tp_val){
//                                        if($tp_val['Topup']['investment_id'] == $each_item['Investment']['id']){
//                                        $topup_in += $tp_val[0]['topup_in'];
//                                        }
//                                    }
//                                    $invest_int = $interest_accrued - $topup_in;
//                                    echo  number_format($invest_int,2);
//                                }else{
              $invest_int = number_format($interest_accrued,2);
              echo $invest_int;
//                                }
        } ?></td>
                            <td align="left"><?php if (isset($each_item['Investment']['id']) && isset($each_item['Investment']['investment_amount'])) {
                                 
                                $id = $each_item['Investment']['id'];
                               $interest_accrued = $this->requestAction('/Investments/get_accruedinterest/'.$id);
                               $invest_int = $interest_accrued;
                                $totals = $invest_amount + $invest_int;
        
            echo number_format($totals,2);
            
                        } ?></td>
                            <td align="left"><?php if (isset($amount)) {
//                                $total_bal -= $amount;
            echo  number_format($amount,2);
            
        } ?></td>
                            <td align="left"><?php 
                            
//                            if (isset($each_item['Investment']['earned_balance'])) {
//                               
//            echo  number_format($each_item['Investment']['earned_balance'],2);
//        }
        
                            
                            
                            if (isset($each_item['Investment']['id']) && isset($each_item['Investment']['investment_amount'])) {
                                 $invest_amount = $each_item['Investment']['investment_amount'];
                                 $id = $each_item['Investment']['id'];
                               $interest_accrued = $this->requestAction('/Investments/get_accruedinterest/'.$id);
                                $invest_int = $interest_accrued;
                                $earnbtotals = $invest_amount + $invest_int;
        
                    $total_bal += $earnbtotals;
            echo number_format($earnbtotals,2,'.',',');
            
                        }
        ?></td>
                       </tr>
                       
                       
                    <?php 
                    if(!empty($each_item['Topup']) ){
                        ?>
                       <tr ><td colspan="10">
                               <table class="table table-condensed" style="font-size:75%">
                                  <tr>
                                      <th align="left" width="120">&nbsp;</th>
                        <th align="left" width="120">&nbsp;</th>
                        <th align="left" width="100">Topup Amt. &nbsp;</th>
                        <th align="left">Benchmark(%)</th>
                        <th align="left">Interest</th>
                        <th align="left">Total</th>
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
                            <td align="left"><?php
                            $princ=0;
                            $princ =  number_format($val['topup_amount'],2);
                            echo  number_format($val['topup_amount'],2); ?></td>
                            <td align="left"><?php if (isset($each_item['Investment']['custom_rate'])) {
            echo  $each_item['Investment']['custom_rate'].'%';
        } ?></td>
                            <td align="left"><?php // echo number_format($val['topup_interest'],2);
                            $interest_amountt = 0;
                            $tfirst_date = $val['investment_date'];
                            $inv_date = new DateTime($tfirst_date);
                            $date = date('Y-m-d');
                            $to_date = new DateTime($date);
                            $tduration = date_diff($inv_date, $to_date);
                            $tduration = $tduration->format("%a");
                            $principal = $val['topup_amount'];
                            $rate = $each_item['Investment']['custom_rate'];
                            $interest_amount1 = ($rate / 100) * $principal;
                            $interest_amountt = $interest_amount1 * ($tduration / 365);
                           
                            
                             echo number_format($interest_amountt,2,'.',',');
                            ?></td>
                            <td align="left"><?php
                            $int = 0;
                            if(isset($interest_amountt)){
                            $int =  $interest_amountt;
                            }
                            $totaltop = $int + $val['topup_amount'];
                            $total_bal += $totaltop;
                            echo number_format($totaltop,2,'.',','); ?></td>
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
                    ?>
                          
                     <tr>
                         <td align="left" valign="top" colspan="2"><b>Investment Balance</b></td>
                        <!--<td align="left" valign="top" >&nbsp;</td>-->
                        <td align="right" valign="top" >&nbsp;</td>
                        <td align="right" valign="top" > &nbsp;</td>
                        <td align="left" valign="top" >&nbsp;</td>
                        <td align="right" valign="top" >&nbsp;</td>
                        <td align="right" valign="top" >&nbsp;</td>
                        <td align="right" valign="top">&nbsp;</td>
                        <td align="right" valign="top" >&nbsp; </td>
                        <td align="right" valign="top" > <?php
                         if (isset($total_bal)) {
                                echo number_format($total_bal, 2,'.',',');
                                $account_tot_bal+=$total_bal;
                            }
                        
                        ?>
                        </td>
                    </tr>
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
                    
                    <?php
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
                        <td align="left" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;" colspan="2"><b>Account Balance</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">(<?php echo $shopCurrency; ?>)</td>
                        <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">
                            <?php // if (isset($each_item[0]['balance_due'])) {
//                                echo number_format($each_item[0]['balance_due'], 2);
//                            }
                            
                             if (isset($account_tot_bal)) {
                                echo number_format($account_tot_bal, 2,'.',',');
                            }
                             $account_tot_bal 
                            
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

