<?php
echo $this->element('header');

?>

<?php
$shopCurrency = "GH$";
if ($this->Session->check('shopCurrency_investment')) {
    $shopCurrency = $this->Session->read('shopCurrency_investment');
}
?>
<!-- Content starts here -->
<h3 style="color: red;">Process Investment</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
        <!-- Step Investment Details Start -->
     
        <?php echo $this->Form->create('Topup', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Reinvestments', 'action' => 'topupInvestment'), 'class'=> 'basic-form')); ?> 
                       
        
        
        <p class="subtitle-red">Step 2 - Top-up Fixed Investment</p>
                    <div class="row"  style="background: #F0E3C0;">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <p></p>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Company:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestorcashaccounts['Reinvestor']['company_name']) ? 
                                            $reinvestorcashaccounts['Reinvestor']['company_name'] : '' );?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Last Modified Date:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestorcashaccounts['ReinvestorCashaccount']['modified']) ?
                                            $reinvestorcashaccounts['ReinvestorCashaccount']['modified'] : '' );?>
                                </div>
                            </div>
<!--                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php // echo "<p><b>Currency:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php // echo (isset($reinvestorcashaccounts['Currency']['symbol']) ? 
//                                            $reinvestorcashaccounts['Currency']['symbol'] : '' );?>
                                </div>
                            </div>-->
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Principal:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($data['Reinvestment']['investment_amount']) ?
                                            number_format($data['Reinvestment']['investment_amount'], 2) : '' );?>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Available Cash:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestorcashaccounts['ReinvestorCashaccount']['fixed_inv_balance']) ?
                                            number_format($reinvestorcashaccounts['ReinvestorCashaccount']['fixed_inv_balance'], 2) : '' );?>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <p></p>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Investment Type:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo 'Fixed Investment';?>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Notes:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($data['Reinvestment']['details']) ?
                                            $data['Reinvestment']['details'] : '' );?>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            
                <hr>            

                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="row">
                            
                            <?php
                            echo $this->Form->hidden('id', array('value' => (isset($data['Reinvestment']['id']) ? $data['Reinvestment']['id'] : '' )));
                            echo $this->Form->hidden('earned_balance', array('value' => (isset($data['Reinvestment']['earned_balance']) ? $data['Reinvestment']['earned_balance'] : '' )));
                            
                            echo $this->Form->hidden('user_id', array('value' => ($this->Session->check('userDetails.id') == true ? $this->Session->read('userDetails.id') : '' )));
                             echo $this->Form->hidden('reinvestorcashaccount_id', array('value' => (isset($reinvestorcashaccounts['ReinvestorCashaccount']['id']) ? $reinvestorcashaccounts['ReinvestorCashaccount']['id'] : '' )));
                             echo $this->Form->hidden('reinvestor_id', array('value' => (isset($reinvestorcashaccounts['ReinvestorCashaccount']['reinvestor_id']) ? $reinvestorcashaccounts['ReinvestorCashaccount']['reinvestor_id'] : '' )));
                             
                            echo $this->Form->input('investmentdestination_id', 
                                    array('disabled','empty' => '--Please Select--', 
                                        'value' => ($data['Reinvestment']['investment_destination_id'] ? 
                                            $data['Reinvestment']['investment_destination_id'] : '' ),
                                        'label' => 'Investment Destination Company/Fund*'));
                            ?>
                            
                                </div>
                            <div class="row">
                                <?php
                                 echo $this->Form->input('invdestproduct_id', array('disabled','empty' => '--Please Select--', 'selected' => 
                                          
                                             ($data['Reinvestment']['inv_dest_product_id'] ? 
                                                 $data['Reinvestment']['inv_dest_product_id'] : ''  ),
                                     'label' => 'Investment Product*','class' => 'invprods'));
                                 
                                 echo $this->Form->hidden('currency_id',['value' => 
                                     (isset($reinvestorcashaccounts['Reinvestor']['currency_id']) ? 
                                     $reinvestorcashaccounts['Reinvestor']['currency_id'] : '')]);
                                ?>
                            
                                </div>
                        </div>

                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    
<?php echo $this->Form->input('paymentmode_id', array( 'label' => 'Cash Receipt Mode', 'empty' => "--Please Select--")); ?>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12">
                                  
<?php echo $this->Form->input('cheque_no', array('disabled', 'label' => 'Cheque No.', 'placeholder' => "Cheque number(s)")); ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">  <?php 
                                 echo $this->Form->hidden('topupinvestment_id',array('class' => 'invest_id','value' => (isset($data['Reinvestment']['id']) ? $data['Reinvestment']['id'] : '' )));
                                 
                                 echo $this->Form->hidden('topupinvestor_id',array('value' =>
                                     (isset($reinvestorcashaccounts['ReinvestorCashaccount']['reinvestor_id']) 
                                        ? $reinvestorcashaccounts['ReinvestorCashaccount']['reinvestor_id'] : '')));
                                 echo $this->Form->hidden('topupinvestor_name',array('value' => (isset($reinvestorcashaccounts['Reinvestor']['company_name']) 
                                        ? $reinvestorcashaccounts['Reinvestor']['company_name'] : '')));
                                echo $this->Form->hidden('topupavailable_cash',array('value' => (isset($reinvestorcashaccounts['ReinvestorCashaccount']['fixed_inv_balance']) 
                                        ? $reinvestorcashaccounts['ReinvestorCashaccount']['fixed_inv_balance'] : 0)));
                                echo $this->Form->input('topup_amount',
                                        array('label' => 'Top-up Amount', 'class' => 'required', 'placeholder' => '0.00')); ?> 
                                     
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12">
                                       </div>
                            </div>
                            <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <?php
                                        if ($this->Session->check('topuptemp.investment_date') == true) {

                                            $dob_string = $this->Session->read('topuptemp.investment_date');
                                            $month = date('m', strtotime($dob_string));
                                            $day = date('d', strtotime($dob_string));
                                            $Year = date('Y', strtotime($dob_string));
                                        } else {

                                            $month = date('m');
                                            $day = date('d');
                                            $Year = date('Y');
                                        }
                                        ?>
                                        <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                                        <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                                        <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                                        <?php echo "<p style='width: 100%;float:left; font-size: 14px;font-weight: bold;line-height: 0px; padding: 60px 0px 0px 0px;'>Top-up Date*:</p>
                               ".$this->Form->day('investment_date', array("selected" => $day,)); ?>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <?php echo "<p style='width: 100%;float:left; font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>&nbsp;</p>
                               ".$this->Form->month('investment_date', array("selected" => $month)); ?>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <?php echo "<p style='width: 100%;float:left; font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>&nbsp;</p>
                               ".$this->Form->year('investment_date', 1950, date('Y'), array("selected" => $Year)); ?>
                                    </div>
                                    <script>
                                        var day = $("#day").val();
                                        var month = $("#month").val();
                                        var year = $("#year").val();
                                        $("#TopupInvestmentDateDay option[value=" + day + "]").attr('selected', true);
                                        $("#TopupInvestmentDateMonth option[value=" + month + "]").attr('selected', true);
                                        $("#TopupInvestmentDateYear option[value=" + year + "]").attr('selected', true);
                                    </script>
                            </div>
                            
                            
                        </div>        
                    

                    <!-- Investment Details End -->

                
                
<!--                <div class="row" style="border-bottom: dotted 1px gray;">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <table width="80%" cellspacing="0" cellpadding="3" border="0">
                            <tr>
                                <td align="right"><b align="right">Due Date: </b></td>
                                <td><span id="xxxxxx"><?php
//                                        if (isset($duedate)) {
//                                            echo $duedate;
//                                        } else {
//                                            echo '';
//                                        }
                                        ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <table width="80%" cellspacing="0" cellpadding="3" border="0">
                            <tr>
                                <td align="right"><b align="right">Interest Accrued: </b></td>
                                <td><span id="xxxxxx"><?php
//                                        if (isset($interest)) {
//                                            echo $shopCurrency . ' ' . number_format($interest, 2, '.', ',');
//                                        } else {
//                                            echo '';
//                                        }
                                        ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <table width="80%" cellspacing="0" cellpadding="3" border="0">
                            <tr>
                                <td align="right"><b align="right" style='color: #ff0000'>Total Amount Due: </b></td>
                                <td><span id="xxxxxx" ><b><?php
//                                            if (isset($totaldue)) {
//                                                echo $shopCurrency . ' ' . number_format($totaldue, 2, '.', ',');
//                                            } else {
//                                                echo '';
//                                            }
                                            ?></b></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                </div>-->
                    
                <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
                <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right;">
                    <?php
                    echo $this->Html->link('Back', "/Reinvestments/manageInvFixed/".(isset($reinvestorcashaccounts['ReinvestorCashaccount']['reinvestor_id']) ? $reinvestorcashaccounts['ReinvestorCashaccount']['reinvestor_id'] : '' ), array("class" => 'btn btn-lg btn-info'));
                    echo $this->Form->button('Submit', array("type" => "submit", "class" => "btn btn-lg btn-success"));
                    echo "&nbsp;&nbsp;";
//                    echo $this->Html->link('Submit', "/Reinvestments/newInvestment1Fixed1/".(isset($reinvestorcashaccounts['ReinvestorCashaccount']['reinvestor_id']) ? $reinvestorcashaccounts['ReinvestorCashaccount']['reinvestor_id'] : '' ), array("class" => 'btn btn-lg btn-primary'));
                    ?>
                </div>
                    
                
        <?php
        echo $this->Form->end();
        ?>
        <div id="clearer"></div>

    </div>
    <!-- Content ends here -->
    <script type="text/javascript" language="javascript">
        $(document).ready(function ()
        {
           
  function hide_chequeno() {
                var cashmode = $("#TopupPaymentmodeId").val();
                if (cashmode == '2') {
                    $("#TopupChequeNo").prop('disabled',false);
                    return false;
                }
                if (cashmode != '2') {
                    $("#TopupChequeNo").prop('disabled', true);
                    return false;
                }
            }
            
            
           

            
            //DISABLE CHEQUENO if CASH
            hide_chequeno();
            $("#TopupPaymentmodeId").change(function() {
                hide_chequeno();
            });
           

        });
    </script>