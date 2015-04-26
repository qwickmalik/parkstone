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
<h3 style="color: red;"> Payment - Fixed</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <?php echo $this->Form->create('PaymentFixed', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Reinvestments', 'action' => 'makePayment'), "inputDefaults" => array('div' => false))); ?>

        <div class="row" >
            <br>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <?php echo "<p><b>Investment Company:</b></p>"; ?>
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
                        <?php echo (isset($reinvestments['Reinvestment']['interest_rate']) ? $reinvestments['Reinvestment']['interest_rate'] : '' ); ?>
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
                        <?php echo (isset($reinvestments['Reinvestment']['earned_balance']) ? number_format($reinvestments['Reinvestment']['earned_balance'] , 2, '.', ',') : '' ); ?>
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
                                    

                                        $month = date('m');
                                        $day = date('d');
                                        $Year = date('Y');
                                    
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
                                    $("#PaymentFixedInvestmentDateDay option[value=" + day + "]").attr('selected', true);
                                    $("#PaymentFixedInvestmentDateMonth option[value=" + month + "]").attr('selected', true);
                                    $("#PaymentFixedInvestmentDateYear option[value=" + year + "]").attr('selected', true);
                                </script>
            <div class="col-lg-12 col-md-12 col-sm-12" >
                <?php echo $this->Form->input('cashreceiptmode_id', array('required', 'label' => 'Cash Receipt Mode', 'empty' => '--Please Select--')); ?>
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
<?php echo $this->element('footer'); ?>
    
     <script lang="javascript">
        jQuery(document).ready(function($) {
function hide_chequeno() {
                var cashmode = $("#PaymentFixedCashreceiptmodeId").val();
                if (cashmode == '2') {
                    $("#PaymentFixedChequeNos").prop('disabled',false);
                    return false;
                }
                if (cashmode != '2') {
                    $("#PaymentFixedChequeNos").prop('disabled', true);
                    return false;
                }
            }
            
            
           

            
            //DISABLE CHEQUENO if CASH
            hide_chequeno();
            $("#PaymentFixedCashreceiptmodeId").change(function() {
                hide_chequeno();
            });
             });
 </script>           