<?php echo $this->element('header'); ?>

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
        echo $this->Form->create('Reinvestment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Reinvestments', 'action' => 'process_equity'), "inputDefaults" => array('div' => false)));
        ?>
        <p class="subtitle-red">Step 2 - Equity Investment</p>
                    <div class="row"  style="background: #E2F4FB;">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <p></p>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Re-investor Company:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($equitydetails['Reinvestor']['company_name']) ? $equitydetails['Reinvestor']['company_name'] : '' );?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Investment Date:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($equitydetails['InvestmentCash']['investment_date']) ? $equitydetails['InvestmentCash']['investment_date'] : '' );?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Currency:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($equitydetails['Currency']['symbol']) ? $equitydetails['Currency']['symbol'] : '' );?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Total Company Deposited Amount:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestorcashaccount['ReinvestorCashaccount']['equity_inv_amount']) ? 
                                            number_format($reinvestorcashaccount['ReinvestorCashaccount']['equity_inv_amount'], 2, '.', ',')
                                             : '' );?>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Total Available Amount:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestorcashaccount['ReinvestorCashaccount']['equity_inv_balance']) ? 
                                            number_format($reinvestorcashaccount['ReinvestorCashaccount']['equity_inv_balance'], 2, '.', ',') : '' );?>
                                </div>
                            </div> 
                            
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <p></p>
                               <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Investor's Deposited Amount:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($equitydetails['InvestmentCash']['amount']) ? number_format($equitydetails['InvestmentCash']['amount'], 2, '.', ',') : '' );?>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Investor's Available Amount:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($equitydetails['InvestmentCash']['available_amount']) ? number_format($equitydetails['InvestmentCash']['available_amount'], 2, '.', ',') : '' );?>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Investment Type:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($equitydetails['InvestmentCash']['investment_type']) ? $equitydetails['InvestmentCash']['investment_type'] : '' );?>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Notes:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($equitydetails['Investment']['details']) ? $equitydetails['Investment']['details'] : '' );?>
                                </div>
                            </div> 
                        </div>
                    </div>
                </td>
            
                <hr>            

<!--                    <div class="row">
                        
                        <div class="col-lg-6 col-md-6 col-sm-12" id = "equity">
                            <?php
//                            echo $this->Form->hidden('user_id', array('value' =>
//                                ($this->Session->check('userDetails.id') == true ? 
//                                    $this->Session->read('userDetails.id') : '' )));
//                            echo $this->Form->hidden('reinvestor_id', array('value' 
//                                => (isset($equitydetails['InvestmentCash']['reinvestor_id']) ? 
//                                    $equitydetails['InvestmentCash']['reinvestor_id'] : '' )));
//                            echo $this->Form->hidden('investor_id', array('value' => (isset($equitydetails['Investment']['investor_id']) ? $equitydetails['Investment']['investor_id'] : '' )));
//
//                            echo $this->Form->hidden('reinvestorcashaccount_id', array('value' => (isset($reinvestorcashaccount['ReinvestorCashaccount']['id']) ? 
//                                    $reinvestorcashaccount['ReinvestorCashaccount']['id'] : '' )));
//                            
//                            echo $this->Form->hidden('currency_id', array('value' => (isset($equitydetails['InvestmentCash']['currency_id']) ? $equitydetails['InvestmentCash']['currency_id'] : '' )));
//                            echo $this->Form->hidden('investment_cash_id', array('value' => (isset($equitydetails['InvestmentCash']['id']) ? $equitydetails['InvestmentCash']['id'] : '' )));
//
//                            echo $this->Form->hidden('investment_type', array('value' => (isset($equitydetails['InvestmentCash']['investment_type']) ? $equitydetails['InvestmentCash']['investment_type'] : '' )));
//                            
//                            echo $this->Form->hidden('details', array('value' => 
//                                    (isset($equitydetails['InvestmentCash']['notes']) ? 
//                                    $equitydetails['InvestmentCash']['notes'] : '' )));
//                            
//                            echo $this->Form->hidden('investment_date', array('value' => 
//                                    (isset($equitydetails['Investment']['investment_date']) ? 
//                                    $equitydetails['Investment']['investment_date'] : '' )));
//                            
//                            
//                               echo $this->Form->hidden('available_amount', array('value' => 
//                                    (isset($equitydetails['InvestmentCash']['available_amount']) ? 
//                                    $equitydetails['InvestmentCash']['available_amount'] : 0 )));
//                                
//   
//
//                            echo $this->Form->input('equities_list_id', ['required','selected' => 
//                                ($this->Session->check('reeinvesttemp.equities_list_id') == true ?
//                                      $this->Session->read('reeinvesttemp.equities_list_id') : (isset($equitydetails['Investment']['equities_list_id']) ? 
//                                    $equitydetails['Investment']['equities_list_id'] : '' ) )
//                                ,'type' => 'select','options' => $equitieslists, 
//                                'empty' => '--Please choose desired equity--']);
//                            
//                            echo "<p><i>Desired equity not listed here?".$this->Html->link('Add to the list', '/Settings/equitiesList') ."</i></p>";
//                            
//                            echo $this->Form->input('purchase_price', array('label' => 'Purchase Price*', 
//                                'class' => 'required', 'value' => ($this->Session->check('reeinvesttemp.share_price') 
//                                    == true ? $this->Session->read('reeinvesttemp.share_price') : '' ))); 
//                            
//                              echo $this->Form->hidden('share_price', array('value' => ($this->Session->check('reeinvesttemp.purchase_price') == true ?
//                                      $this->Session->read('reeinvesttemp.purchase_price') : 0.00 )));   
//                             
                             
                            ?>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?php 
//                            echo $this->Form->input('numb_shares', array('required','label' => 'No. of Shares Purchased*', 'class' => 'required',
//                                'value' => ($this->Session->check('reeinvesttemp.numb_shares') == true ? 
//                                    $this->Session->read('reeinvesttemp.numb_shares') : (isset($equitydetails['Investment']['numb_shares_left']) ? 
//                                    $equitydetails['Investment']['numb_shares_left'] : 0 ) ))); 
//                            
//                             echo $this->Form->input('total_fees', array('label' => 'Total Fees*', 'class' => 'required',
//                                 'value' => ($this->Session->check('reeinvesttemp.total_fees') == true ? 
//                                     $this->Session->read('reeinvesttemp.total_fees') : (isset($equitydetails['Investment']['total_fees']) ? 
//                                    $equitydetails['Investment']['total_fees'] : 0.00 ) ))); 
                             ?>
                            <div class="row"> 
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <?php // echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px;'>Reinvestment Date</span>";?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
//                                    if ($this->Session->check('reeinvesttemp.reinvestment_date') == true) {
//
//                                        $dob_string = $this->Session->read('reeinvesttemp.reinvestment_date');
//                                        $month = date('m', strtotime($dob_string));
//                                        $day = date('d', strtotime($dob_string));
//                                        $Year = date('Y', strtotime($dob_string));
//                                    } else {
//
//                                        $month = date('m');
//                                        $day = date('d');
//                                        $Year = date('Y');
//                                    }
                                    ?>
                                    <input type="hidden" id="month" value="<?php // echo $month; ?>"/>
                                    <input type="hidden" id="day" value="<?php // echo $day; ?>"/>
                                    <input type="hidden" id="year" value="<?php // echo $Year; ?>"/>
                                    <?php // echo $this->Form->day('reinvestment_date', array("selected" => $day, "class" => "large")); ?>&nbsp;
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php // echo $this->Form->month('reinvestment_date', array("selected" => $month, "class" => "large")); ?>&nbsp;
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php // echo $this->Form->year('reinvestment_date', 1950, date('Y'), array("selected" => $Year, "class" => "large")); ?>
                                </div>
                                <script>
                                    var day = $("#day").val();
                                    var month = $("#month").val();
                                    var year = $("#year").val();
                                    $("#ReinvestmentReinvestmentDateDay option[value=" + day + "]").attr('selected', true);
                                    $("#ReinvestmentReinvestmentDateMonth option[value=" + month + "]").attr('selected', true);
                                    $("#ReinvestmentReinvestmentDateYear option[value=" + year + "]").attr('selected', true);
                                </script>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <?php // echo $this->Form->button('Process', array("type" => "submit", "class" => "btn btn-lg btn-success",'name' => "equity_process")); ?>
                            </div>
                                
                            <div class="col-lg-12 col-md-12 col-sm-12" style="border-top: dotted 1px gray;">
                                <?php
//                                echo "<span style='font-weight: bold; font-size: 11px; color: red;'>Total Amount:</span>";
//                                if (isset($totalamt)) {
//                                    echo $shopCurrency.' '.number_format($totalamt, 2, '.', ',');
//                                } else {
//                                    echo '';
//                                }
                                ?>

                            </div>
                            
                        </div>


                    </div>-->
               <!--begin test --> 
 <div class="row">
 <div class="col-lg-12 col-md-12 col-sm-12" id="equity">
     <?php
                            echo $this->Form->hidden('user_id', array('value' =>
                                ($this->Session->check('userDetails.id') == true ? 
                                    $this->Session->read('userDetails.id') : '' )));
                            echo $this->Form->hidden('reinvestor_id', array('value' 
                                => (isset($equitydetails['InvestmentCash']['reinvestor_id']) ? 
                                    $equitydetails['InvestmentCash']['reinvestor_id'] : '' )));
                            echo $this->Form->hidden('investor_id', array('value' =>
                                (isset($equitydetails['Investment']['investor_id']) ? 
                                    $equitydetails['Investment']['investor_id'] : '' )));

                            echo $this->Form->hidden('reinvestorcashaccount_id', array('value' => (isset($reinvestorcashaccount['ReinvestorCashaccount']['id']) ? 
                                    $reinvestorcashaccount['ReinvestorCashaccount']['id'] : '' )));
                            
                            echo $this->Form->hidden('currency_id', array('value' => (isset($equitydetails['InvestmentCash']['currency_id']) ? $equitydetails['InvestmentCash']['currency_id'] : '' )));
                            echo $this->Form->hidden('investment_cash_id', array('value' => (isset($equitydetails['InvestmentCash']['id']) ? $equitydetails['InvestmentCash']['id'] : '' )));

                            echo $this->Form->hidden('investment_type', array('value' => (isset($equitydetails['InvestmentCash']['investment_type']) ? $equitydetails['InvestmentCash']['investment_type'] : '' )));
                            
                            echo $this->Form->hidden('details', array('value' => 
                                    (isset($equitydetails['InvestmentCash']['notes']) ? 
                                    $equitydetails['InvestmentCash']['notes'] : '' )));
                            
                            echo $this->Form->hidden('investment_date', array('value' => 
                                    (isset($equitydetails['Investment']['investment_date']) ? 
                                    $equitydetails['Investment']['investment_date'] : '' )));
                            
                            echo $this->Form->hidden('base_fees', array('value' => 
                                    (isset($equitydetails['Investment']['base_fees']) ? 
                                    $equitydetails['Investment']['base_fees'] : '' )));
                            
                            echo $this->Form->hidden('oldtotal_amount', array('value' => 
                                    (isset($equitydetails['Investment']['total_amount']) ? 
                                    $equitydetails['Investment']['total_amount'] : '' )));
                            
                             echo $this->Form->hidden('cash_receipt_mode_id', array('value' => 
                                    (isset($equitydetails['Investment']['cash_receipt_mode_id']) ? 
                                    $equitydetails['Investment']['cash_receipt_mode_id'] : '' )));
                             
                               echo $this->Form->hidden('available_amount', array('value' => 
                                    (isset($equitydetails['InvestmentCash']['available_amount']) ? 
                                    $equitydetails['InvestmentCash']['available_amount'] : 0 )));
                                
     
                               echo $this->Form->hidden('investment_no', array('value' => 
                                    (isset($equitydetails['Investment']['investment_no']) ? 
                                    $equitydetails['Investment']['investment_no'] : '' )));
                                
     
                             
                             
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
                                        , 'selected' => ($this->Session->check('reeinvesttemp.equities_list_id') == true ?
                                            $this->Session->read('reeinvesttemp.equities_list_id') : (isset($equity_array[1]) ? 
                                    $equity_array[1]['InvestorEquity']['equities_list_id'] : '' ) )]);
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('numb_shares', array('label' => 'No. of Shares*', 'class' => 'required', 
                                        'value' => ($this->Session->check('reeinvesttemp.numb_shares') == true ?
                                            $this->Session->read('reeinvesttemp.numb_shares') : (isset($equity_array[1]) ? 
                                    $equity_array[1]['InvestorEquity']['numb_shares_left'] : 0 ) )));
                                    ?>

                                </div>


                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('purchase_price', array('label' => 'Purchase Price*', 'class' => 'required', 'value' => 
                                            ($this->Session->check('reeinvesttemp.purchase_price') == true ? $this->Session->read('reeinvesttemp.purchase_price') : '' )));
                                    
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('min_share_price', array('label' => 'Min Price', 'class'
                                        => 'required', 'value' => ($this->Session->check('reeinvesttemp.min_share_price') ==
                                            true ? $this->Session->read('reeinvesttemp.min_share_price') : (isset($equity_array[1]) ? 
                                    $equity_array[1]['InvestorEquity']['min_share_price'] : 0 ) )));
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('max_share_price', array('label' => 'Max Price', 'class' =>
                                        'required', 'value' => ($this->Session->check('reeinvesttemp.max_share_price') 
                                            == true ? $this->Session->read('reeinvesttemp.max_share_price') : (isset($equity_array[1]) ? 
                                    $equity_array[1]['InvestorEquity']['max_share_price'] : 0 ) )));
                                    ?>
                                </div> 
                            </div>

                            <div class="col-lg-5 col-md-6 col-sm-12" style="background: #E3F8FD;float:right; border-left: solid 1px #A7D2F4;">
                                 <div class="col-lg-8 col-md-8 col-sm-12">
                                    <?php
                                    echo $this->Form->input('equities_list_id2', ['class' => 'equity_id', 'id' => '2', 'type' =>
                                        'select', 'label' => 'Equity', 'options' => $equitieslists, 'empty' =>
                                        '--Please choose desired equity--', 'selected' => 
                                        ($this->Session->check('reeinvesttemp.equities_list_id2') == true ? 
                                            $this->Session->read('reeinvesttemp.equities_list_id2') : (isset($equity_array[2]) ? 
                                    $equity_array[2]['InvestorEquity']['equities_list_id'] : 0 ) )]);
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('numb_shares2', array('label' => 'No. of Shares*', 'class' => 'required', 'value' =>
                                        ($this->Session->check('reeinvesttemp.numb_shares2') == true ? 
                                            $this->Session->read('reeinvesttemp.numb_shares2') : (isset($equity_array[2]) ? 
                                    $equity_array[2]['InvestorEquity']['numb_shares_left'] : 0 ) )));
                                    ?>

                                </div>


                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('purchase_price2', array( 'label' => 'Purchase Price*', 'class' => 'required', 'value' => 
                                            ($this->Session->check('reeinvesttemp.purchase_price2') == true ? $this->Session->read('reeinvesttemp.purchase_price2') : '' )));
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('min_share_price2', array('label' => 'Min Price', 'class' => 
                                        'required', 'value' => ($this->Session->check('reeinvesttemp.min_share_price2') == true ? 
                                            $this->Session->read('reeinvesttemp.min_share_price2') : (isset($equity_array[2]) ? 
                                    $equity_array[2]['InvestorEquity']['min_share_price'] : 0 ) )));
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('max_share_price2', array('label' => 'Max Price', 'class' => 
                                        'required', 'value' => ($this->Session->check('reeinvesttemp.max_share_price2') == 
                                            true ? $this->Session->read('reeinvesttemp.max_share_price2') : (isset($equity_array[2]) ? 
                                    $equity_array[2]['InvestorEquity']['max_share_price'] : 0 ) )));
                                    ?>
                                </div>
                                
                            </div>
                                </div>
                            <div class="row" style=" margin-bottom: 5px; border: solid 1px #A7D2F4;">
                             
                            <div class="col-lg-5 col-md-6 col-sm-12" style="background: #E3F8FD; margin-right: 0px;  border-right: solid 1px #A7D2F4;">

                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <?php
                                    echo $this->Form->input('equities_list_id3', ['class' => 'equity_id', 'selected' => 
                                        ($this->Session->check('reeinvesttemp.equities_list_id3') == true ? 
                                            $this->Session->read('reeinvesttemp.equities_list_id3') : (isset($equity_array[3]) ? 
                                    $equity_array[3]['InvestorEquity']['equities_list_id'] : 0 ) ), 'id' => '3', 'type' => 'select', 'label' => 'Equity', 'options' => $equitieslists, 'empty' => '--Please choose desired equity--']);
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('numb_shares3', array('label' => 'No. of Shares*', 'class' => 
                                        'required', 'value' => ($this->Session->check('reeinvesttemp.numb_shares3') == 
                                            true ? $this->Session->read('reeinvesttemp.numb_shares3') : (isset($equity_array[3]) ? 
                                    $equity_array[3]['InvestorEquity']['numb_shares_left'] : 0 ) )));
                                    ?>

                                </div>


                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('purchase_price3', array( 'label' => 'Purchase Price*', 'class' => 'required', 'value' => 
                                            ($this->Session->check('reeinvesttemp.purchase_price3') == true ?
                                            $this->Session->read('reeinvesttemp.purchase_price3') : '' )));
                                   ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('min_share_price3', array('label' => 'Min Price', 'class' => 
                                        'required', 'value' => ($this->Session->check('reeinvesttemp.min_share_price3') 
                                            == true ? $this->Session->read('reeinvesttemp.min_share_price3') : (isset($equity_array[3]) ? 
                                    $equity_array[3]['InvestorEquity']['min_share_price'] : 0 ) )));
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('max_share_price3', array('label' => 'Max Price', 'class' =>
                                        'required', 'value' => ($this->Session->check('reeinvesttemp.max_share_price3') == 
                                            true ? $this->Session->read('reeinvesttemp.max_share_price3') : (isset($equity_array[3]) ? 
                                    $equity_array[3]['InvestorEquity']['max_share_price'] : 0 ) )));
                                    ?>
                                </div> 
                            </div>

     <div class="col-lg-5 col-md-6 col-sm-12" style="background: #E3F8FD;float:right; border-left: solid 1px #A7D2F4;">
                                
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <?php
                                    echo $this->Form->input('equities_list_id4', ['class' => 'equity_id', 'selected' => 
                                        ($this->Session->check('reeinvesttemp.equities_list_id4') == true ? 
                                            $this->Session->read('reeinvesttemp.equities_list_id4') : (isset($equity_array[4]) ? 
                                    $equity_array[4]['InvestorEquity']['equities_list_id'] : 0 ) ), 'id' => '4', 'type' => 'select', 'label' => 'Equity', 'options' => $equitieslists, 'empty' => '--Please choose desired equity--']);
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('numb_shares4', array('label' => 'No. of Shares*', 'class' =>
                                        'required', 'value' => ($this->Session->check('reeinvesttemp.numb_shares4') == true ? 
                                            $this->Session->read('reeinvesttemp.numb_shares4') : (isset($equity_array[4]) ? 
                                    $equity_array[4]['InvestorEquity']['numb_shares_left'] : 0 ) )));
                                    ?>

                                </div>


                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('purchase_price4', array('label' => 'Purchase Price*', 'class' => 'required', 'value' => 
                                            ($this->Session->check('reeinvesttemp.purchase_price4') == true ? $this->Session->read('reeinvesttemp.purchase_price4') 
                                            : '' )));
                                   
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('min_share_price4', array('label' => 'Min Price', 'class' => 'required',
                                        'value' => ($this->Session->check('reeinvesttemp.min_share_price4') == true ?
                                            $this->Session->read('reeinvesttemp.min_share_price4') : (isset($equity_array[4]) ? 
                                    $equity_array[4]['InvestorEquity']['min_share_price'] : 0 ) )));
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('max_share_price4', array('label' => 'Max Price', 'class' => 'required',
                                        'value' => ($this->Session->check('reeinvesttemp.max_share_price4') == true ?
                                            $this->Session->read('reeinvesttemp.max_share_price4') : (isset($equity_array[4]) ? 
                                    $equity_array[4]['InvestorEquity']['max_share_price'] : 0 ) )));
                                    ?>
                                </div> 
                            </div>
                                </div>
                            <div class="row" style=" margin-bottom: 5px; border: solid 1px #A7D2F4;">
                                <div class="col-lg-5 col-md-6 col-sm-12" style=" background: #E3F8FD;margin-right: 0px;  border-right: solid 1px #A7D2F4;">

                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <?php
                                    echo $this->Form->input('equities_list_id5', ['class' => 'equity_id', 'selected' => 
                                        ($this->Session->check('reeinvesttemp.equities_list_id5') == true ?
                                            $this->Session->read('reeinvesttemp.equities_list_id5') : (isset($equity_array[5]) ? 
                                    $equity_array[5]['InvestorEquity']['min_share_price'] : 0 ) ), 'id' => '5', 'type' => 'select', 'label' => 'Equity', 'options' => $equitieslists, 'empty' => '--Please choose desired equity--']);
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('numb_shares5', array('label' => 'No. of Shares*', 'class' => 'required', 'value' => 
                                            ($this->Session->check('reeinvesttemp.numb_shares5') == true ?
                                            $this->Session->read('reeinvesttemp.numb_shares5') : (isset($equity_array[5]) ? 
                                    $equity_array[5]['InvestorEquity']['numb_shares_left'] : 0 ) )));
                                    ?>

                                </div>


                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('purchase_price5', array( 'label' => 'Purchase Price*', 'class' => 'required', 'value' => ($this->Session->check('reeinvesttemp.purchase_price5') == true ? $this->Session->read('reeinvesttemp.purchase_price5') : '' )));
                                    
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('min_share_price5', array('label' => 'Min Price', 'class' => 'required',
                                        'value' => ($this->Session->check('reeinvesttemp.min_share_price5') == true ? 
                                            $this->Session->read('reeinvesttemp.min_share_price5') : (isset($equity_array[5]) ? 
                                    $equity_array[5]['InvestorEquity']['min_share_price'] : 0 ) )));
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    echo $this->Form->input('max_share_price5', array('label' => 'Max Price', 'class' => 'required', 
                                        'value' => ($this->Session->check('reeinvesttemp.max_share_price5') == true ? 
                                            $this->Session->read('reeinvesttemp.max_share_price5') : (isset($equity_array[5]) ? 
                                    $equity_array[5]['InvestorEquity']['max_share_price'] : 0 ) )));
                                    ?>
                                </div> 
                            </div>
<div class="col-lg-5 col-md-6 col-sm-12" style="padding-bottom: 2px; background: #E3F8FD;float:right;border-left: solid 1px #A7D2F4;">
                                
                           <div class="col-lg-12 col-md-12 col-sm-12">
                                    <?php 
//                                    echo "<p>&nbsp;</p>";
                                    echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px;'>Reinvestment Date</span>";
                                    
                                    ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    if ($this->Session->check('reeinvesttemp.reinvestment_date') == true) {

                                        $dob_string = $this->Session->read('reeinvesttemp.reinvestment_date');
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
                                    <?php echo $this->Form->day('reinvestment_date', array("selected" => $day, "class" => "large")); ?>&nbsp;
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo $this->Form->month('reinvestment_date', array("selected" => $month, "class" => "large")); ?>&nbsp;
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo $this->Form->year('reinvestment_date', 1950, date('Y'), array("selected" => $Year, "class" => "large")); ?>
                                <script>
                                    var day = $("#day").val();
                                    var month = $("#month").val();
                                    var year = $("#year").val();
                                    $("#ReinvestmentReinvestmentDateDay option[value=" + day + "]").attr('selected', true);
                                    $("#ReinvestmentReinvestmentDateMonth option[value=" + month + "]").attr('selected', true);
                                    $("#ReinvestmentReinvestmentDateYear option[value=" + year + "]").attr('selected', true);
                                </script>
                                </div>
                                
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                      <div class="col-lg-8 col-md-8 col-sm-12">
                                <?php
//                                    echo "<p>&nbsp;</p>";
                                     echo $this->Form->input('details', array('type' => 'textarea','label' => 'Details',
                                 'value' => ($this->Session->check('reeinvesttemp.details') == true ? 
                                     $this->Session->read('reeinvesttemp.details') : '' ))); 
                                    ?>
                                </div> 
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                <?php
//                                    echo "<p>&nbsp;</p>";
                                     echo $this->Form->input('total_fees', array('label' => 'Total Fees*', 'class' => 'required',
                                 'value' => ($this->Session->check('reeinvesttemp.total_fees') == true ? 
                                     $this->Session->read('reeinvesttemp.total_fees') : 0 ))); 
                                    ?>
                                </div>
                                
                                   
                            </div>
                            </div>
                            </div>
                                </div>


                            <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                    <?php
                                    echo "<p>&nbsp;</p>";
                                    ?>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <?php
                                    echo "<p>&nbsp;</p>";
                                    echo $this->Form->button('Process', array("type" => "submit", "class" => "btn btn-lg btn-success", 'name' => "equity_process"));
                                    ?>
                                </div>
                            </div>
                            


                            <div class="col-lg-12 col-md-12 col-sm-12">


                                <!--                                <div class="col-lg-4 col-md-4 col-sm-12">
                                <?php
//                                    echo "<span style='font-weight: bold; font-size: 11px; color: red;'>Equity:</span><br>";
//                                    if (isset($equity)) {
//                                        echo $equity;
//                                    } else {
//                                        echo '';
//                                    }
                                ?>
                                
                                                                </div>-->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                 <?php
                                    echo "<p>&nbsp;</p>";
                                    ?>

                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12" style="border-top: dotted 1px gray;background: #C6F19F;">
                                <?php
                                echo "<span style='font-weight: bold; font-size: 11px; color: red;'>Total Amount:</span>";
                                if (isset($totalamt)) {
                                    echo $shopCurrency.' '.number_format($totalamt, 2, '.', ',');
                                } else {
                                    echo '';
                                }
                                ?>

                            </div>
                            </div>

                        </div>
                
                 <!--end test --> 
                <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
                <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right;">
                    <?php
                    echo $this->Html->link('Back', "/Reinvestments/newInvestment", array("class" => 'btn btn-lg btn-info'));
                    echo "&nbsp;&nbsp;";
                    echo $this->Html->link('Submit', "/Reinvestments/newInvestment1Equity1/".(isset($equitydetails['InvestmentCash']['reinvestor_id']) ? 
                                    $equitydetails['InvestmentCash']['reinvestor_id'] : '' ).'/'.(isset($equitydetails['InvestmentCash']['id']) ? 
                                    $equitydetails['InvestmentCash']['id'] : '' ), 
                            array("class" => 'btn btn-lg btn-primary','confirm' => 'Are you sure you wish to submit this investment?'));
                    ?>
                </div>
                    
                
        <?php
        echo $this->Form->end();
        ?>
        <div id="clearer"></div>

    </div>
    <!-- Content ends here -->
<?php echo $this->element('footer'); ?>
    
    
    <script type="text/javascript" language="javascript">
        $(document).ready(function ()
        {
//            var equity_id = jQuery("#ReinvestmentEquitiesListId").val();
//     if (equity_id == ""){
//         
//                    
//                    jQuery('#ReinvestmentSharePrice' + class_no).val("");
//                    jQuery('#ReinvestmentPurchasePrice' + class_no).val("");
//     }
//            if (equity_id != ""){
//    var query = "action=getPurchasePrice&ID=" + equity_id;
//            jQuery.ajax({
//                    url: "../../getPurchasePrice",
//                    data: query,
//                    dataType: 'json',
//                    type: 'POST',
//                    success: function (data) {
//                        
//                    if (data && data.error) {
//                        
//                    jQuery(".errormsg").show();
//                            jQuery(".errormsg").html(data.error).show('slow');
//                            jQuery(".errormsg").hide();
//                    } else {
//                    //jquery("midleveltype").
//                   jQuery('#ReinvestmentSharePrice' + class_no).val(data['EquitiesList']['share_price']);
//                                jQuery('#ReinvestmentPurchasePrice' + class_no).val(data['EquitiesList']['share_price']);
// return false;
//                    }
//                    },
//                    error: function () {
//                        jQuery(".errormsg").show();
//                            jQuery(".errormsg").html("Server Error. Check Server and Database Configurations").show('slow');
//                            jQuery(".errormsg").hide();
//                  }
//            });
//    }
          //get current equity share price
//            jQuery(".equity_id").change(function () {
//                var class_no = jQuery(this).prop('id');
//
//
//                var equity_id = jQuery(this).val();
//                if (equity_id == "") {
//
////                    jQuery('#ReinvestmentSharePrice' + class_no).val("");
////                    jQuery('#ReinvestmentPurchasePrice' + class_no).val("");
//                }
//                if (equity_id != "") {
//                    var query = "action=getPurchasePrice&ID=" + equity_id;
//                    jQuery.ajax({
//                        url: "../../getPurchasePrice",
//                        data: query,
//                        dataType: 'json',
//                        type: 'POST',
//                        success: function (data) {
//
//                            if (data && data.error) {
//
//                                jQuery(".errormsg").show();
//                                jQuery(".errormsg").html(data.error).show('slow');
//                                jQuery(".errormsg").hide();
//                            } else {
//                                //jquery("midleveltype").
////                                jQuery('#ReinvestmentSharePrice' + class_no).val(data['EquitiesList']['share_price']);
////                                jQuery('#ReinvestmentPurchasePrice' + class_no).val(data['EquitiesList']['share_price']);
//
//                                return false;
//                            }
//                        },
//                        error: function () {
//                            jQuery(".errormsg").show();
//                            jQuery(".errormsg").html("Server Error. Check Server and Database Configurations").show('slow');
//                            jQuery(".errormsg").hide();
//                        }
//                    });
//                }
//            });
//             jQuery("#ReinvestmentEquitiesListId").change(function(){
//
//    var equity_id = jQuery(this).val();
//     if (equity_id == ""){
//         
//                    jQuery('#ReinvestmentSharePrice').val("");
//                     jQuery('#ReinvestmentPurchasePrice').val(""); 
//     }
//            if (equity_id != ""){
//    var query = "action=getPurchasePrice&ID=" + equity_id;
//            jQuery.ajax({
//                    url: "../../getPurchasePrice",
//                    data: query,
//                    dataType: 'json',
//                    type: 'POST',
//                    success: function (data) {
//                        
//                    if (data && data.error) {
//                        
//                    jQuery(".errormsg").show();
//                            jQuery(".errormsg").html(data.error).show('slow');
//                            jQuery(".errormsg").hide();
//                    } else {
//                    //jquery("midleveltype").
//                    jQuery('#ReinvestmentSharePrice').val(data['EquitiesList']['share_price']);
//                     jQuery('#ReinvestmentPurchasePrice').val(data['EquitiesList']['share_price']);     
//                            
//                            return false;
//                    }
//                    },
//                    error: function () {
//                        jQuery(".errormsg").show();
//                            jQuery(".errormsg").html("Server Error. Check Server and Database Configurations").show('slow');
//                            jQuery(".errormsg").hide();
//                  }
//            });
//    }
//    });
            $("#ReinvestmentInvesteeId").change(function () {
                var url = 'getfunds';
                var id = $(this).val();
                if (id != "") {
                    var query = "action=getfunds&" + "investee_id=" + id;

                    $("#error_msg").hide();
                    $.ajax({
                        url: url,
                        data: query,
                        dataType: 'json',
                        type: 'POST',
                        success: function (data) {

                            if (data['status'] == "ok") {
                                var prod1 = data['data']['product1'];
                                var prod2 = data['data']['product2'];
                                var prod3 = data['data']['product3'];
                                var prod4 = data['data']['product4'];
                                var prod5 = data['data']['product5'];
                                var prod6 = data['data']['product6'];
                                var prod7 = data['data']['product7'];
                                var prod8 = data['data']['product8'];
                                var prod9 = data['data']['product9'];
                                var selectHTML = '<option value="">-- Please Select --</option>';
                                if (prod1 != "" || prod1 != null) {
                                    selectHTML += "<option value=" + prod1 + ">" + prod1 + "</option>";
                                }
                                if (prod2 != "" && prod2 != null) {
                                    selectHTML += "<option value=" + prod2 + ">" + prod2 + "</option>";
                                }
                                if (prod3 != "" && prod3 != null) {
                                    selectHTML += "<option value=" + prod3 + ">" + prod3 + "</option>";
                                }
                                if (prod4 != "" && prod4 != null) {
                                    selectHTML += "<option value=" + prod4 + ">" + prod4 + "</option>";
                                }
                                if (prod5 != "" && prod5 != null) {
                                    selectHTML += "<option value=" + prod5 + ">" + prod5 + "</option>";
                                }
                                if (prod6 != "" && prod6 != null) {
                                    selectHTML += "<option value=" + prod6 + ">" + prod6 + "</option>";
                                }
                                if (prod7 != "" && prod7 != null) {
                                    selectHTML += "<option value=" + prod7 + ">" + prod7 + "</option>";
                                }
                                if (prod8 != "" && prod8 != null) {
                                    selectHTML += "<option value=" + prod8 + ">" + prod8 + "</option>";
                                }
                                if (prod9 != "" && prod9 != null) {
                                    selectHTML += "<option value=" + prod9 + ">" + prod9 + "</option>";
                                }
                                $("#ReinvestmentInvestmentproductId").html(selectHTML);
                                return false;
                            } else if (data['status'] == "failed") {



                                return false;
                            }

                        },
                        error: function () {
                            $("#progress_msg").hide();
                            $("#welcome_message").show();
                            $("#error_msg").html("Server Error. Check Server and Database Configurations").show('slow');
                            $("#welcome_message").hide(5000);
                        }
                    });
                }
            });

        });
    </script>