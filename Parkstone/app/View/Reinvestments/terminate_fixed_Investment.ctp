<?php
//echo $this->Html->script('notification.js');
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
        <?php
        echo $this->Form->create('Reinvestment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Reinvestments', 'action' => 'processTermination'), "inputDefaults" => array('div' => false)));
        
        
        ?>
        <p class="subtitle-red">Step 2 - Fixed Investment</p>
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
                            
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Deposited Amount:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php  if(isset($data['Reinvestment']['investment_amount'])){
                                        $num = number_format($data['Reinvestment']['investment_amount'], 2);
                                    }else{
                                        $num = '0.00';
                                    }
                                    echo $num;
                                   ?>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Expected Amount:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php if(isset($data['Reinvestment']['earned_balance'])){
                                        $num = number_format($data['Reinvestment']['earned_balance'], 2);
                                    }else{
                                        $num = '0.00';
                                    }
                                    echo $num;
                                    ?></div>
                            </div> 
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Benchmark Rate:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($data['Reinvestment']['interest_rate']) ?
                                            $data['Reinvestment']['interest_rate'] : '' );?>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <p></p>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Investment Date:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                     <?php echo (isset($data['Reinvestment']['investment_date']) ?
                                            $data['Reinvestment']['investment_date'] : '' );?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Due Date:</b></p>";?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                   <?php echo (isset($data['Reinvestment']['due_date']) ?
                                            $data['Reinvestment']['due_date'] : '' );?> </div>
                            </div>
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
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="row">
                            
                            <?php
                             echo $this->Form->hidden('id',['value' => 
                                     (isset($data['Reinvestment']['id']) ? 
                                     $data['Reinvestment']['id'] : '' )]);
                             echo $this->Form->hidden('user_id', array('value' => ($this->Session->check('userDetails.id') == true ? $this->Session->read('userDetails.id') : '' )));
                             echo $this->Form->hidden('reinvestorcashaccount_id', array('value' => (isset($reinvestorcashaccounts['ReinvestorCashaccount']['id']) ? $reinvestorcashaccounts['ReinvestorCashaccount']['id'] : '' )));
                             echo $this->Form->hidden('reinvestor_id', array('value' => (isset($reinvestorcashaccounts['ReinvestorCashaccount']['reinvestor_id']) ? $reinvestorcashaccounts['ReinvestorCashaccount']['reinvestor_id'] : '' )));
                             
                             echo $this->Form->input('investmentdestination_id', 
                                    array('disabled','empty' => '--Please Select--', 
                                        'selected' => (isset($data['Reinvestment']['investment_destination_id']) ? $data['Reinvestment']['investment_destination_id'] : '' ),
                                        'label' => 'Investment Destination Company/Fund*'));
                            ?>
                            
                                </div>
                            <div class="row">
                                <?php
                                 echo $this->Form->input('invdestproduct_id', array('disabled','empty' => '--Please Select--', 'selected' =>
                                     (isset($data['Reinvestment']['inv_dest_product_id']) ?
                                         $data['Reinvestment']['inv_dest_product_id'] : '' ), 'label' => 'Investment Product*','class' => 'invprods'));
                                 echo $this->Form->hidden('currency_id',['value' => 
                                     (isset($reinvestorcashaccounts['Reinvestor']['currency_id']) ? 
                                     $reinvestorcashaccounts['Reinvestor']['currency_id'] : '' )]);
                                ?>
                            
                                </div>
                        </div>

                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php 
                                   
                                    
                                    echo $this->Form->input('investment_amount', array('required',
                                        'label' => 'Received Amount*', 'placeholder' => '0.00')); ?>
                                
                                </div>
                                 <div class="col-lg-2 col-md-2 col-sm-12">
                                    <?php // echo $this->Form->input('inv_freq', array('label' => 'Frequency', 'value' => (isset($investor['Investor']['inv_freq']) ? $investor['Investor']['inv_freq'] : '' )));  ?>
                                         <?php echo $this->Form->input('penalty', array('required', 'value' => 0,'label' => 'Penalty(%)*')); ?>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <?php
                                    echo $this->Form->input('duration',array('disabled','label' => 'Duration*', 
                                        'value' => (isset($data['Reinvestment']['duration']) ? 
                                            $data['Reinvestment']['duration'] : '' ),'width' => '50px'));
                                    
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">  <?php
                                    
                                    echo $this->Form->input('investment_period', array('disabled','label' => 'Investment Period*', 'empty' => "--Please Select--",
                                        'options'=> array('Day(s)' => 'Day(s)','Year(s)'=>'Year(s)'),
                                        'value' => (isset($data['Reinvestment']['investment_period']) ? 
                                            $data['Reinvestment']['investment_period'] : '' )
                                       )); ?>
                                     
                                </div>
                               
                            </div>
                            <div class="row"> 
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px;'>Termination Date</span>";?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                       if (isset($data['Investment']['investment_date'])) {
                                            $dob_string = $data['Reinvestment']['investment_date'];
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
                                    <?php echo $this->Form->day('investment_date', array("selected" => $day, "class" => "large")); ?>&nbsp;
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo $this->Form->month('investment_date', array("selected" => $month, "class" => "large")); ?>&nbsp;
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo $this->Form->year('investment_date', 1950, date('Y'), array("selected" => $Year, "class" => "large")); ?>
                                
                                </div>
                                <script>
                                    var day = $("#day").val();
                                    var month = $("#month").val();
                                    var year = $("#year").val();
                                    $("#ReinvestmentInvestmentDateDay option[value=" + day + "]").attr('selected', true);
                                    $("#ReinvestmentInvestmentDateMonth option[value=" + month + "]").attr('selected', true);
                                    $("#ReinvestmentInvestmentDateYear option[value=" + year + "]").attr('selected', true);
                                </script>
                            </div>
                            
                            
                        </div>


                    </div>

                    <!-- Investment Details End -->

                
                
                <div class="row" style="border-bottom: dotted 1px gray;">
                 
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        
                        <table width="80%" cellspacing="0" cellpadding="3" border="0">
                            <tr>
                                <td align="left"><b align="left" style='color: #ff0000'>Received Amount: </b></td>
                                <td><span id="xxxxxx"><?php
                                        if (isset($receivedamt)) {
                                            echo number_format($receivedamt, 2, '.', ',');;
                                        } else {
                                            echo '';
                                        }
                                        ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <table width="80%" cellspacing="0" cellpadding="3" border="0">
                            <tr>
                                <td align="right"><b align="right">Penalty: </b></td>
                                <td><span id="xxxxxx"><?php
                                        if (isset($penalty)) {
                                            echo $penalty.'%';
                                        } else {
                                            echo '0%';
                                        }
                                        ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <table width="80%" cellspacing="0" cellpadding="3" border="0">
                            <tr>
                                <td align="left"><b align="left" style='color: #ff0000'>Expected Amount: </b></td>
                                <td><span id="xxxxxx" ><b><?php
                                            if (isset($expecteddue)) {
                                                echo $shopCurrency . ' ' . number_format($expecteddue, 2, '.', ',');
                                            } else {
                                                echo '';
                                            }
                                            ?></b></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <table width="80%" cellspacing="0" cellpadding="3" border="0">
                            <tr>
                                <td align="right"><b align="right">Expected Interest: </b></td>
                                <td><span id="xxxxxx"><?php
                                        if (isset($expected_interest)) {
                                            echo $shopCurrency . ' ' . number_format($expected_interest, 2, '.', ',');
                                        } else {
                                            echo '';
                                        }
                                        ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                    
                <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
                <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right;">
                    <?php
//                    echo $this->Html->link('Back', "/Reinvestments/newInvestment", array("class" => 'btn btn-lg btn-info'));
                    echo $this->Form->button('Process', array("type" => "submit", "class" => "btn btn-lg btn-success"));
                    echo "&nbsp;&nbsp;";
                    echo $this->Html->link('Save', "/Reinvestments/manageInvFixedCancel/".(isset($data['Reinvestment']['id']) ? $data['Reinvestment']['id'] : '' )."/".(isset($reinvestorcashaccounts['ReinvestorCashaccount']['reinvestor_id']) ? $reinvestorcashaccounts['ReinvestorCashaccount']['reinvestor_id'] : '' ), array("class" => 'btn btn-lg btn-primary'));
                    ?>
                </div>
                    
                
        <?php
        echo $this->Form->end();
        ?>
        <div id="clearer"></div>

    </div>
    <!-- Content ends here -->
  