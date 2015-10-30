<?php echo $this->element('header'); 
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js');

?>

<?php
//$shopCurrency = "GH$";
//if ($this->Session->check('shopCurrency_investment')) {
//    $shopCurrency = $this->Session->read('shopCurrency_investment');
//}
?>
<!-- Content starts here -->
<h3 style="color: red;">Manage Investments</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
        <!-- Step Investment Details Start -->
        
        <p class="subtitle-blue">Equity Investment Details</p>
                    <div class="row" >
                        <br>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Company:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestments['Reinvestor']['company_name']) ? $reinvestments['Reinvestor']['company_name'] :'' );?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Investment Date:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestments['Reinvestment']['investment_date']) ? $reinvestments['Reinvestment']['investment_date'] : '' );?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Currency:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestments['Currency']['symbol']) ? $reinvestments['Currency']['symbol'] : '' );?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Investment Amount:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestments['Reinvestment']['investment_amount']) ? number_format($reinvestments['Reinvestment']['investment_amount'], 2, '.', ',') : '' );?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Inv. Dest. Company/Fund:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestments['InvestmentDestination']['company_name']) ? $reinvestments['InvestmentDestination']['company_name'] : '' );?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Investment Product:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestments['InvDestProduct']['inv_dest_product']) ? $reinvestments['InvDestProduct']['inv_dest_product'] : '' );?>
                                </div>
                            </div>
                            
                            
                              
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            
<!--                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php // echo "<p><b>Interest Rate:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php // echo (isset($reinvestments['Reinvestment']['custom_rate']) ? $reinvestments['Reinvestment']['custom_rate'] : '' );?>
                                </div>
                            </div>-->
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Re-investment Date:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestments['ReinvestmentsEquity']['reinvestment_date']) ? $reinvestments['ReinvestmentsEquity']['reinvestment_date'] : '' );?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Due Date:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestments['ReinvestmentsEquity']['due_date']) ? $reinvestments['ReinvestmentsEquity']['due_date'] : '' );?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Interest Accrued:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestments['ReinvestmentsEquity']['interest_earned']) ? number_format($reinvestments['ReinvestmentsEquity']['interest_earned'], 2, '.', ',') : '' );?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Total Amount Due:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestments['ReinvestmentsEquity']['amount_due']) ? number_format($reinvestments['ReinvestmentsEquity']['amount_due'], 2, '.', ',') : '' );?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Notes:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestments['ReinvestmentsEquity']['details']) ? $reinvestments['ReinvestmentsEquity']['details'] : '' );?>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right;">
                    <?php
                    echo "<p>&nbsp;</p>";
                    echo $this->Html->link('Back', "/FundManagements/manageInvEquity/".(isset($reinvestments['ReinvestmentsEquity']['reinvestor_id']) ? $reinvestments['ReinvestmentsEquity']['reinvestor_id'] : '' ), array("class" => 'btn btn-lg btn-info'));
                    echo $this->Html->link('Print Statement', "javascript:void(0)", array("class" => 'btn btn-lg btn-warning', "id" => "print_statement"));
                    ?>
                </div>

        <?php
        echo $this->Form->end();
        ?>
        <div id="clearer"></div>

    </div>
    <!-- Content ends here -->
<?php echo $this->element('footer'); ?>
  