<?php echo $this->element('header'); ?>

<!-- Content starts here -->
<h3>Dispose Equity</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>


        <?php echo $this->Form->create('EquityOrder', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Reinvestments', 'action' => 'makeEquityOrder'), "inputDefaults" => array('div' => false))); ?>
        <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">
            <tr>
                <td align="left" valign="top" width="50%">
                    <table width="100%" cellspacing="10" cellpadding="0" border="0">
                        <tr>
                            <td align="left" width="200"><b align="right">Company ID:</b></td>
                            <td align="left"><?php
                                if (isset($data['inv']['Investment']['investor_id'])) {
                                    echo $data['inv']['Investment']['investor_id'];
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <td align="left" width="200"><b align="right">Company:</b></td>
                            <td align="left"><?php
                                if (isset($data['inv']['Investor']['fullname'])) {
                                    echo $data['inv']['Investor']['fullname'];
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <td width="30%"><b align="right">Investment ID:</b></td>
                            <td><span  align="left" id="xxxxxx"><?php
                                    if (isset($data['inv']['Investment']['id'])) {
                                        echo $data['inv']['Investment']['id'];
                                    }
                                    ?></span>

                                <input type="hidden" value="<?php
                                if (isset($data['inv']['Investment']['id'])) {
                                    echo $data['inv']['Investment']['id'];
                                }
                                ?>" name="hid_investid" /></td>
                        </tr>
<!--                        <tr>
                            <td width="30%"><b align="right">Investment Term:</b></td>
                            <td><span align="left" id="xxxxxx"><?php
//                                    if (isset($data['InvestmentTerm']['term_name'])) {
//                                        echo $data['InvestmentTerm']['term_name'];
//                                    }
                                    ?></span></td>
                        </tr>-->
                        <tr>
                            <td width="30%"><b align="right">Investment Date:</b></td>
                            <td><span align="left" id="xxxxxx"><?php
                                    if (isset($data['inv']['Investment']['investment_date'])) {
                                        echo $data['inv']['Investment']['investment_date'];
                                    }
                                    ?></span></td>
                        </tr>
                        <tr>
                            <td><b align="right">Payment Mode:</b></td>
                            <td><span id="xxxxxx"><?php
                                    if (isset($data['inv']['PaymentMode']['payment_mode_name'])) {
                                        echo $data['inv']['PaymentMode']['payment_mode_name'];
                                    }
                                    ?></span></td>
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
                </td>
                <td align="left" valign="top" width="50%">

                    <table width="100%" cellspacing="10" cellpadding="0" border="0">
                        <tr>
                            <td><b align="right">Equity:</b></td>
                            <td><span id="xxxxxx"><?php
                            $abbrev = '';
                                    if (isset($data['EquitiesList'])) {
                                        foreach($data['EquitiesList'] as $val){
                                            
                                           $abbrev .= $val['EquitiesList']['equity_abbrev'].','; 
                                        }
                                        echo trim($abbrev,',');
                                        
                                    }
                                    ?></span></td>
                        </tr>
                        <tr>
                            <td><b align="right">Total Shares Purchased:</b></td>
                            <td><span id="xxxxxx"><?php
                            $total_shares = 0;
                                     if (isset($data['EquitiesList'])) {
                                         
                                        foreach($data['EquitiesList'] as $val){
                                           $total_shares += $val['ReinvestorEquity']['numb_shares']; 
                                        }
                                        
                                    }
                                    echo $total_shares;
                                    ?></span></td>
                        </tr>
                        <tr>
                            <td><b align="right">Total Shares Remaining:</b></td>
                            <td><span id="xxxxxx"><?php
                            $total_remshares = 0;
                                     if (isset($data['EquitiesList'])) {
                                         
                                        foreach($data['EquitiesList'] as $val){
                                           $total_remshares += $val['ReinvestorEquity']['numb_shares_left']; 
                                        }
                                        
                                    }
                                    echo $total_remshares;
                                    ?></span></td>
                        </tr>
                        <tr>
                            <td><b align="right">Total Fees:</b></td>
                            <td><span id="xxxxxx"><?php
                                    if (isset($data['ReinvestmentsEquity']['total_fees'])) {
                                        echo 'GH$ '.$data['ReinvestmentsEquity']['total_fees'];
                                    }
                                    ?></span></td>
                        </tr>

                        
                    </table>

                </td>
            </tr>

        </table>


       
        <div class="row">
 
 <div class="col-lg-12 col-md-12 col-sm-12" id="equity">
     
     <?php
                            echo $this->Form->hidden('invest_no',array('value' => (isset($data['inv']['Investment']['investment_no']) ?
                                    $data['inv']['Investment']['investment_no'] : '')));
                            echo $this->Form->hidden('user_id', array('value' =>
                                ($this->Session->check('userDetails.id') == true ? 
                                    $this->Session->read('userDetails.id') : '' )));
                            ?>
                           <?php
                            echo "<p><br><i>Desired equity not listed here? " . $this->Html->link('Add to the list', '/Settings/equitiesList') . "</i></p>";
                            ?>
     <!--background: #E3F8FD;-->
                            <div class="row" style=" margin-bottom: 5px; border: solid 1px #A7D2F4;">
                             
                            <div class="col-lg-5 col-md-6 col-sm-12" style="background: #E3F8FD; margin-right: 0px;  border-right: solid 1px #A7D2F4;">

                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <?php
                                    echo $this->Form->input('equities_list_id', ['class' => 'equity_id', 'id' => '', 'type' => 'select', 'label' => 'Equity', 'options' => $equitieslists, 'empty' => '--Please choose desired equity--'
                                        , 'selected' => (isset($equity_array[1]) ? 
                                    $equity_array[1]['ReinvestorEquity']['equities_list_id'] : '' )]);
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('numb_shares', array('label' => 'No. of Shares*','max' => (isset($equity_array[1]) ? 
                                    $equity_array[1]['ReinvestorEquity']['numb_shares_left'] : 0 ),'class' => 'required', 
                                        'value' => (isset($equity_array[1]) ? 
                                    $equity_array[1]['ReinvestorEquity']['numb_shares_left'] : 0 )));
                                    
                                    echo $this->Form->hidden('shares_rem', array('value' => (isset($equity_array[1]) ? 
                                    $equity_array[1]['ReinvestorEquity']['numb_shares_left'] : 0 )));
                                    ?>

                                </div>


                             
                            </div>

                            <div class="col-lg-5 col-md-6 col-sm-12" style="background: #E3F8FD;float:right; border-left: solid 1px #A7D2F4;">
                                 <div class="col-lg-8 col-md-8 col-sm-12">
                                    <?php
                                    echo $this->Form->input('equities_list_id2', ['class' => 'equity_id', 'id' => '2', 'type' =>
                                        'select', 'label' => 'Equity', 'options' => $equitieslists, 'empty' =>
                                        '--Please choose desired equity--', 'selected' => 
                                        (isset($equity_array[2]) ? 
                                    $equity_array[2]['ReinvestorEquity']['equities_list_id'] : 0 )]);
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('numb_shares2', array('label' => 'No. of Shares*','max' => (isset($equity_array[2]) ? 
                                    $equity_array[2]['ReinvestorEquity']['numb_shares_left'] : 0 ), 'class' => 'required', 'value' =>
                                        (isset($equity_array[2]) ? 
                                    $equity_array[2]['ReinvestorEquity']['numb_shares_left'] : 0 )));
                                     echo $this->Form->hidden('shares_rem2', array('value' => (isset($equity_array[2]) ? 
                                    $equity_array[2]['ReinvestorEquity']['numb_shares_left'] : 0 )));
                                    ?>

                                </div>



                                
                            </div>
                                </div>
                            <div class="row" style=" margin-bottom: 5px; border: solid 1px #A7D2F4;">
                             
                            <div class="col-lg-5 col-md-6 col-sm-12" style="background: #E3F8FD; margin-right: 0px;  border-right: solid 1px #A7D2F4;">

                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <?php
                                    echo $this->Form->input('equities_list_id3', ['class' => 'equity_id', 'selected' => 
                                        (isset($equity_array[3]) ? 
                                    $equity_array[3]['ReinvestorEquity']['equities_list_id'] : 0 ), 'id' => '3', 
                                        'type' => 'select', 'label' => 'Equity', 'options' => $equitieslists, 
                                        'empty' => '--Please choose desired equity--']);
                                    
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('numb_shares3', array('label' => 'No. of Shares*', 'max' => (isset($equity_array[3]) ? 
                                    $equity_array[3]['ReinvestorEquity']['numb_shares_left'] : 0 ),'class' => 
                                        'required', 'value' => (isset($equity_array[3]) ? 
                                    $equity_array[3]['ReinvestorEquity']['numb_shares_left'] : 0 )));
                                    
                                     echo $this->Form->hidden('shares_rem3', array('value' => (isset($equity_array[3]) ? 
                                    $equity_array[3]['ReinvestorEquity']['numb_shares_left'] : 0 )));
                                    ?>

                                </div>

 
                            </div>

     <div class="col-lg-5 col-md-6 col-sm-12" style="background: #E3F8FD;float:right; border-left: solid 1px #A7D2F4;">
                                
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <?php
                                    echo $this->Form->input('equities_list_id4', ['class' => 'equity_id', 'selected' => 
                                        (isset($equity_array[4]) ? 
                                    $equity_array[4]['ReinvestorEquity']['equities_list_id'] : 0 ), 'id' => '4', 'type' => 'select', 'label' => 'Equity', 'options' => $equitieslists, 'empty' => '--Please choose desired equity--']);
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('numb_shares4', array('label' => 'No. of Shares*','max' => (isset($equity_array[4]) ? 
                                    $equity_array[4]['ReinvestorEquity']['numb_shares_left'] : 0 ), 'class' =>
                                        'required', 'value' => (isset($equity_array[4]) ? 
                                    $equity_array[4]['ReinvestorEquity']['numb_shares_left'] : 0 )));
                                    
                                     echo $this->Form->hidden('shares_rem4', array('value' => (isset($equity_array[4]) ? 
                                    $equity_array[4]['ReinvestorEquity']['numb_shares_left'] : 0 )));
                                    ?>

                                </div>


                            </div>
                                </div>
                            <div class="row" style=" margin-bottom: 5px; border: solid 1px #A7D2F4;">
                                <div class="col-lg-5 col-md-6 col-sm-12" style=" background: #E3F8FD;margin-right: 0px;  border-right: solid 1px #A7D2F4;">

                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <?php
                                    echo $this->Form->input('equities_list_id5', ['class' => 'equity_id', 'selected' => 
                                        (isset($equity_array[5]) ? 
                                    $equity_array[5]['ReinvestorEquity']['min_share_price'] : 0 ), 'id' => '5', 'type' => 'select', 'label' => 'Equity', 'options' => $equitieslists, 'empty' => '--Please choose desired equity--']);
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('numb_shares5', array('label' => 'No. of Shares*', 'max' => (isset($equity_array[5]) ? 
                                    $equity_array[5]['ReinvestorEquity']['numb_shares_left'] : 0 ),'class' => 'required', 'value' => 
                                           (isset($equity_array[5]) ? 
                                    $equity_array[5]['ReinvestorEquity']['numb_shares_left'] : 0 )));
                                        echo $this->Form->hidden('shares_rem5', array('value' => (isset($equity_array[5]) ? 
                                    $equity_array[5]['ReinvestorEquity']['numb_shares_left'] : 0 )));
                                    
                                    ?>

                                </div>

                            </div>
<div class="col-lg-5 col-md-6 col-sm-12" style="padding-bottom: 2px; background: #E3F8FD;float:right;border-left: solid 1px #A7D2F4;">
                         
                            </div>
                            </div>
                                </div>

        </div>

        <p>&nbsp;</p>



        <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right;">
            <?php
            echo $this->Html->link('Cancel', "/Reinvestments/manageEquityInvestments/", array("class" => 'btn btn-lg btn-info'));
           // echo $this->Form->button('Make Payment', array("type" => "submit", "class" => "btn btn-lg btn-success")); //check the parameters here 
           // echo $this->Html->link('Make Payment', "disposeEquityReceipt/". (isset($data['Investment']['id'])? $data['Investment']['id']: null),array( "class" => "btn btn-lg btn-success"));
            echo $this->Form->button('Place Order', array("type" => "submit","class" => "btn btn-lg btn-success",'confirm' => 'Are you sure you want to place this order?'));
            ?> 
        </div>

        <?php $this->Form->end(); ?>

        <div id="clearer"></div>

    </div>
    <!-- Content ends here -->
    <script type="text/javascript">
    jQuery(document).ready(function() {
         jQuery("#EquityPaymentChequeNos").attr('disabled');
        var payment_mode = $("#EquityPaymentPaymentMode");
        if(payment_mode == 'Cheque'){
           jQuery("#EquityPaymentChequeNos").removeAttr('disabled'); 
        }else if(payment_mode == 'Post-dated chq'){
            jQuery("#EquityPaymentChequeNos").removeAttr('disabled');
        }else{
            jQuery("#EquityPaymentChequeNos").attr('disabled');
        }
    });
        
        </script>
<?php echo $this->element('footer'); ?>