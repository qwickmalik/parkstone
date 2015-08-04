<?php echo $this->element('header'); 

echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js');
?>

<?php
$shopCurrency = "GH$";
if ($this->Session->check('shopCurrency_investment')) {
    $shopCurrency = $this->Session->read('shopCurrency_investment');
}
?>
<!-- Content starts here -->
<h3 style="color: red;">New Re-investment</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
        <!-- Step Investment Details Start -->
        
        <p class="subtitle-red">Step 3 - Finished (Summary)</p>
                    <div class="row"  style="background: #F0E3C0;">
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
                                    <?php echo (isset($reinvestments['Reinvestment']['investment_amount']) ?
                                            number_format($reinvestments['Reinvestment']['investment_amount'], 2, '.', ',') : '' );?>
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
                            
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Benchmark Rate:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestments['Reinvestment']['interest_rate']) ? $reinvestments['Reinvestment']['interest_rate'] : '' );?>
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
                                    <?php echo "<p><b>Due Date:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestments['Reinvestment']['due_date']) ? $reinvestments['Reinvestment']['due_date'] : '' );?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Interest Accrued:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestments['Reinvestment']['accrued_interest']) ? 
                                            number_format($reinvestments['Reinvestment']['accrued_interest'], 2, '.', ',')
                                             : '' );?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Total Amount Due:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestments['Reinvestment']['amount_due']) ? 
                                            number_format($reinvestments['Reinvestment']['amount_due'], 2, '.', ',') : '' );?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Notes:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo (isset($reinvestments['Reinvestment']['details']) ? $reinvestments['Reinvestment']['details'] : '' );?>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right;">
                    <?php
                    echo "<p>&nbsp;</p>";
                    echo $this->Html->link('New Re-investment', "/Reinvestments/newInvestment", array("class" => 'btn btn-lg btn-info'));
                    echo "&nbsp;&nbsp;";
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
    
    <script type="text/javascript" language="javascript">
        $(document).ready(function ()
        {
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