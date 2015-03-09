<?php
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');
echo $this->Html->script('notification.js');
?>

<?php
//$shopCurrency = "GH$";
//if ($this->Session->check('shopCurrency_investment')) {
//    $shopCurrency = $this->Session->read('shopCurrency_investment');
//}
?>
<!-- Content starts here -->
<h3 style="color: red;">Re-investor Payment - Fixed</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <?php echo $this->Form->create('PaymentFixed', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Reinvestments', 'action' => 'makePayment'), "inputDefaults" => array('div' => false))); ?>

        <div class="row" >
            <br>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <?php echo "<p><b>Re-investor Company:</b></p>"; ?>
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
                        <?php echo "<p><b>Inv. Dest. Company/Fund:</b></p>"; ?>
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



            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">

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
                        <?php echo "<p><b>Re-investment Date:</b></p>"; ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php echo (isset($reinvestments['Reinvestment']['investment_date']) ? $reinvestments['Reinvestment']['investment_date'] : '' ); ?>
                    </div>
                </div>
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
                        <?php echo "<p><b>Notes:</b></p>"; ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php echo (isset($reinvestments['Reinvestment']['details']) ? $reinvestments['Reinvestment']['details'] : '' ); ?>
                    </div>
                </div>
            </div>
        </div>
        <p>&nbsp;</p>
        <hr>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12" >
                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px;'>Payment Date</span>";?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    if ($this->Session->check('investtemp.investment_date') == true) {

                                        $dob_string = $this->Session->read('investtemp.investment_date');
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
                                    $("#InvestmentInvestmentDateDay option[value=" + day + "]").attr('selected', true);
                                    $("#InvestmentInvestmentDateMonth option[value=" + month + "]").attr('selected', true);
                                    $("#InvestmentInvestmentDateYear option[value=" + year + "]").attr('selected', true);
                                </script>
            <div class="col-lg-12 col-md-12 col-sm-12" >
                <?php echo $this->Form->input('payment_mode', array('options' => array("Cash" => "Cash", "Cheque" => "Cheque", "Post-dated chq" => "Post-dated chq", "Standing order" => "Standing order", "Visa" => "Visa"), 'empty' => '--Please Select--', 'label' => 'Payment Mode')); ?>
            </div>
            
            </div>
            
        
            <div class="col-lg-6 col-md-6 col-sm-12" >
            <?php
        echo $this->Form->input('amount', array('size' => 17, 'class' => 'input1', 'label' => 'Amount being Paid'));
        echo $this->Form->input('cheque_nos', array('size' => 5, 'disabled' => true, 'type' => 'textarea', 'style' => 'height: 50px;', 'label' => 'Cheque Nos.'));
        ?>
           
        </div>



        
        <div class="col-lg-6 col-md-6 col-sm-12">
            <?php
            echo "<p>&nbsp;</p>";
            echo $this->Html->link('Back', "/Reinvestments/manageInvFixed", array("class" => 'btn btn-lg btn-info'));
            echo $this->Html->link('Make Payment', "/Reinvestments/makePayment", array("class" => 'btn btn-lg btn-success'));
//            echo $this->Html->link('Print Statement', "javascript:void(0)", array("class" => 'btn btn-lg btn-warning', "id" => "print_statement"));
            ?>
        </div>
</div>
        <?php
        echo $this->Form->end();
        ?>
        <div id="clearer"></div>

    </div>
    <!-- Content ends here -->
