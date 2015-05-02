<?php echo $this->element('header'); ?>
<?php
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

?>

<?php
//$shopCurrency = "GH$";
//if ($this->Session->check('shopCurrency_investment')) {
//    $shopCurrency = $this->Session->read('shopCurrency_investment');
//}
?>
<!-- Content starts here -->
<h3 style="color: red;"> Fixed Investment - Returns - Summary</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <?php echo $this->Form->create('PaymentFixedReceipt', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Reinvestments', 'action' => 'makePayment'), "inputDefaults" => array('div' => false))); ?>

        <div class="row" >
            <br>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <?php echo "<p><b>Company:</b></p>"; ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php echo (isset($reinvestments['Reinvestor']['company_name']) ? $reinvestments['Reinvestor']['company_name'] : '' ); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <?php echo "<p><b>Investment Date:</b></p>"; ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php echo (isset($reinvestments['Reinvestment']['investment_date']) ? $reinvestments['Reinvestment']['investment_date'] : '' ); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <?php echo "<p><b>Currency:</b></p>"; ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php echo (isset($reinvestments['Currency']['symbol']) ? $reinvestments['Currency']['symbol'] : '' ); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <?php echo "<p><b>Investment Amount:</b></p>"; ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php echo (isset($reinvestments['Reinvestment']['investment_amount']) ? number_format($reinvestments['Reinvestment']['investment_amount'] , 2, '.', ',') : '' ); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <?php echo "<p><b>Dest. Company/Fund:</b></p>"; ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php echo (isset($reinvestments['InvestmentDestination']['company_name']) ? $reinvestments['InvestmentDestination']['company_name'] : '' ); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <?php echo "<p><b>Investment Product:</b></p>"; ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php echo (isset($reinvestments['InvDestProduct']['inv_dest_product']) ? $reinvestments['InvDestProduct']['inv_dest_product'] : '' ); ?>
                    </div>
                </div>

<div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <?php echo "<p><b>Interest Rate:</b></p>"; ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php echo (isset($reinvestments['Reinvestment']['custom_rate']) ? $reinvestments['Reinvestment']['custom_rate'] : '' ); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <?php echo "<p><b>Investment Date:</b></p>"; ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php echo (isset($reinvestments['Reinvestment']['investment_date']) ? $reinvestments['Reinvestment']['investment_date'] : '' ); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <?php echo "<p><b>Interest Rate:</b></p>"; ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php echo (isset($reinvestments['Reinvestment']['custom_rate']) ? $reinvestments['Reinvestment']['custom_rate'] : '' ); ?>
                    </div>
                </div>

            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">

                
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <?php echo "<p><b>Due Date:</b></p>"; ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php echo (isset($reinvestments['Reinvestment']['due_date']) ? $reinvestments['Reinvestment']['due_date'] : '' ); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <?php echo "<p><b>Interest Accrued:</b></p>"; ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php echo (isset($reinvestments['Reinvestment']['interest_earned']) ? number_format($reinvestments['Reinvestment']['interest_earned'] , 2, '.', ',') : '' ); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <?php echo "<p><b>Total Amount Due:</b></p>"; ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php echo (isset($reinvestments['Reinvestment']['amount_due']) ? number_format($reinvestments['Reinvestment']['amount_due'] , 2, '.', ',') : '' ); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <?php echo "<p><b>Payment Date:</b></p>"; ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php echo (isset($reinvestments['Reinvestment']['payment_date']) ? $reinvestments['Reinvestment']['payment_date'] : '' ); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <?php echo "<p><b> Mode:</b></p>"; ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php echo (isset($reinvestments['Reinvestment']['payment_mode']) ? $reinvestments['Reinvestment']['payment_mode'] : '' ); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <?php echo "<p><b>Amount Received:</b></p>"; ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php echo (isset($reinvestments['Reinvestment']['amount_paid']) ? number_format($reinvestments['Reinvestment']['amount_paid'] , 2, '.', ',') : '' ); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <?php echo "<p><b>Cheque Nos.:</b></p>"; ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php echo (isset($reinvestments['Reinvestment']['cheque_nos']) ? $reinvestments['Reinvestment']['cheque_nos'] : '' ); ?>
                    </div>
                </div>
            </div>
        </div>
        <p>&nbsp;</p>
        <hr>
        <div class="col-lg-12 col-md-12 col-sm-12" >
            <?php
            echo "<p>&nbsp;</p>";
            echo $this->Html->link('Print Statement', "javascript:void(0)", array("class" => 'btn btn-lg btn-warning', "id" => "print_statement", 'style' => 'float: right;'));
            ?>
        </div>
        <?php
        echo $this->Form->end();
        ?>
        <div id="clearer"></div>

    </div>
    <!-- Content ends here -->
<?php echo $this->element('footer'); ?>
