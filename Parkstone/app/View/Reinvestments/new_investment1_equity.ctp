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
        <?php
        echo $this->Form->create('newReinvestment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Reinvestments', 'action' => 'newInvestment1Fixed1'), "inputDefaults" => array('div' => false)));
        ?>
        <p class="subtitle-red">Step 2 - Equity Re-Investment</p>
                    <div class="row"  style="background: #E2F4FB;">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?php
                            echo "<p><b>&nbsp</b></p>";
                            echo "<p><b>Re-investor Company:</b>" . "</p>";
                            echo "<p><b>Investment Date:</b>" . "</p>";
                            echo "<p><b>Deposited Amount:</b>" . "</p>";
                            echo "<p><b>Available Amount:</b>" . "</p>";
                            ?>  
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?php
                            echo "<p><b>&nbsp</b></p>";
                            echo "<p><b>Notes:</b>" . "</p>"
                            ?>  
                        </div>
                    </div>
                </td>
            
                <hr>            

                    <div class="row">
                        
                        <div class="col-lg-6 col-md-6 col-sm-12" id = "equity">
                            <?php
                            echo $this->Form->hidden('user_id', array('value' => ($this->Session->check('userDetails.id') == true ? $this->Session->read('userDetails.id') : '' )));
                            echo $this->Form->hidden('investment_type', array());

                            echo $this->Form->input('equities_list_id', ['type' => 'select','options' => $equitieslists, 'empty' => '--Please choose desired equity--']);
                            
                            echo "<p><i>Desired equity not listed here?".$this->Html->link('Add to the list', '/Settings/equitiesList') ."</i></p>";
                            
                            echo $this->Form->input('share_price', array('disabled','label' => 'Purchase Price*', 'class' => 'required', 'value' => ($this->Session->check('investtemp.share_price') == true ? $this->Session->read('investtemp.share_price') : '' ))); 
                            
                              echo $this->Form->hidden('purchase_price', array('value' => ($this->Session->check('investtemp.purchase_price') == true ? $this->Session->read('investtemp.purchase_price') : '' )));   
                             
                             
                            ?>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <?php 
                            echo $this->Form->input('numb_shares', array('label' => 'No. of Shares Purchased*', 'class' => 'required', 'value' => ($this->Session->check('investtemp.numb_shares') == true ? $this->Session->read('investtemp.numb_shares') : '' ))); 
                             echo $this->Form->input('total_fees', array('label' => 'Total Fees*', 'class' => 'required', 'value' => ($this->Session->check('investtemp.total_fees') == true ? $this->Session->read('investtemp.total_fees') : '' ))); 
                             ?>
                            <div class="row"> 
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px;'>Reinvestment Date</span>";?>
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
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <?php echo $this->Form->button('Process', array("type" => "submit", "class" => "btn btn-lg btn-success",'name' => "equity_process")); ?>
                            </div>
                                
                            <div class="col-lg-12 col-md-12 col-sm-12" style="border-top: dotted 1px gray;">
                                <?php
                                echo "<span style='font-weight: bold; font-size: 11px; color: red;'>Total Amount:</span>";
                                if (isset($totalamt)) {
                                    echo $shopCurrency.' '.$totalamt;
                                } else {
                                    echo '';
                                }
                                ?>

                            </div>
                            
                        </div>


                    </div>


                <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
                <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right;">
                    <?php
                    echo $this->Html->link('Back', "/Reinvestments/newInvestment", array("class" => 'btn btn-lg btn-info'));
                    echo "&nbsp;&nbsp;";
                    echo $this->Html->link('Finish', "/Reinvestments/newInvestment1Equity1", array("class" => 'btn btn-lg btn-primary'));
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