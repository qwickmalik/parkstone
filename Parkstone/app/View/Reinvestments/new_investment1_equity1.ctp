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
<h3 style="color: red;">New Re-investment</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
        <!-- Step Investment Details Start -->
        
        <p class="subtitle-red">Step 3 - Finished (Summary)</p>
                    <div class="row"  style="background: #E2F4FB;">
                        <br>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Re-investor Company:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo "COMPANY NAME" ;?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Investment Date:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo "06/02/2015";?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Currency:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo "GHS";?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Deposited Amount:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo "500,000.00";?>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Available Amount:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo "300,000.00";?>
                                </div>
                            </div>
                            
                              
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Equity:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo "CPC";?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Purchase Price:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo "3.35"; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>No. of Shares Purchased:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo "5,500";?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Total Fees:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo "150.00";?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Total Amount Invested:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo "300,000.00";?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Re-investment Date:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo "06/02/2015";?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <?php echo "<p><b>Notes:</b></p>";?>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <?php echo "xxxxxxx";?>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right;">
                    <?php
                    echo "<p>&nbsp;</p>";
                    echo $this->Html->link('New Re-investment', "/Reinvestments/newInvestment", array("class" => 'btn btn-lg btn-info'));
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