<?php
//echo $this->Html->script('notification.js');
?>

<!-- Content starts here -->
<h3>Pay Investor</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>


        <?php echo $this->Form->create('EquityPayment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'makeEquityPayment'), "inputDefaults" => array('div' => false))); ?>
        <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">
            <tr>
                <td align="left" valign="top" width="50%">
                    <table width="100%" cellspacing="10" cellpadding="0" border="0">
                        <tr>
                            <td align="left" width="200"><b align="right">Investor ID:</b></td>
                            <td align="left"><?php
                                if (isset($data['Investment']['investor_id'])) {
                                    echo $data['Investment']['investor_id'];
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <td align="left" width="200"><b align="right">Investor Name:</b></td>
                            <td align="left"><?php
                                if (isset($data['Investor']['fullname'])) {
                                    echo $data['Investor']['fullname'];
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <td width="30%"><b align="right">Investment ID:</b></td>
                            <td><span  align="left" id="xxxxxx"><?php
                                    if (isset($data['Investment']['id'])) {
                                        echo $data['Investment']['id'];
                                    }
                                    ?></span>

                                <input type="hidden" value="<?php
                                if (isset($data['Investment']['id'])) {
                                    echo $data['Investment']['id'];
                                }
                                ?>" name="hid_investid" /></td>
                        </tr>
                        <tr>
                            <td width="30%"><b align="right">Investment Term:</b></td>
                            <td><span align="left" id="xxxxxx"><?php
                                    if (isset($data['InvestmentTerm']['term_name'])) {
                                        echo $data['InvestmentTerm']['term_name'];
                                    }
                                    ?></span></td>
                        </tr>
                        <tr>
                            <td width="30%"><b align="right">Investment Date:</b></td>
                            <td><span align="left" id="xxxxxx"><?php
                                    if (isset($data['Investment']['investment_date'])) {
                                        echo $data['Investment']['investment_date'];
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
                                    if (isset($data['Investment']['equities_list_id'])) {
                                        echo $data['Investment']['equities_list_id'];
                                    }
                                    ?></span></td>
                        </tr>
                        <tr>
                            <td><b align="right">Total Shares:</b></td>
                            <td><span id="xxxxxx"><?php
                                    if (isset($data['Investment']['numb_shares'])) {
                                        echo $data['Investment']['numb_shares'];
                                    }
                                    ?></span></td>
                        </tr>
                        <tr>
                            <td><b align="right">Buying Price:</b></td>
                            <td><span id="xxxxxx"><?php
                                    if (isset($data['Investment']['purchase_price'])) {
                                        echo $data['Investment']['purchase_price'];
                                    }
                                    ?></span></td>
                        </tr>
                        <tr>
                            <td><b align="right">Total Fees:</b></td>
                            <td><span id="xxxxxx"><?php
                                    if (isset($data['Investment']['total_fees'])) {
                                        echo $data['Investment']['total_fees'];
                                    }
                                    ?></span></td>
                        </tr>

                        <tr>
                            <td><b align="right">Payment Mode:</b></td>
                            <td><span id="xxxxxx"><?php
                                    if (isset($data['Investment']['payment_mode_id'])) {
                                        echo $data['Investment']['payment_mode_id'];
                                    }
                                    ?></span></td>
                        </tr>
                    </table>

                </td>
            </tr>

        </table>


       
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12"> 
                <?php
                echo $this->Form->input('numb_shares', array('label' => 'No. of Shares to Dispose*', 'class' => 'required'));

                echo $this->Form->input('selling_price', array('label' => 'Current Selling Price*', 'class' => 'required'));
                echo $this->Form->hidden('purchase_price', array('value' => ($this->Session->check('investtemp.purchase_price') == true ? $this->Session->read('investtemp.purchase_price') : '' )));

                echo $this->Form->input('total_fees', array('label' => 'Total Fees*', 'class' => 'required'));
                echo $this->Form->button('Process', array("type" => "submit", "class" => "btn btn-sm btn-success", 'name' => "equity_process"));
                
                echo "<br />";
                echo $this->Form->input('amount_paid', array('class' => 'input1', 'label' => 'Amount being paid', 'disabled' => true));
                
                ?>
            </div>

            
            
            <div class="col-lg-6 col-md-6 col-sm-12">
                <?php
                echo $this->Form->input('payment_mode', array('label' => 'Payment Mode', 'options' => array("Cash" => "Cash", "Cheque" => "Cheque", "Post-dated chq" => "Post-dated chq", "Standing order" => "Standing order", "Visa" => "Visa"), 'empty' => '--Please Select--'));

                echo $this->Form->input('cheque_nos', array('size' => 5, 'type' => 'textarea', 'style' => 'height: 50px;', 'label' => 'Cheque Number(s)'));
                ?>

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
                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>Payment Date*:</span>" . $this->Form->day('payment_date', array("selected" => $day)); ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->month('payment_date', array("selected" => $month)); ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->year('payment_date', 1950, date('Y'), array("selected" => $Year)); ?>
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

        </div>

        <p>&nbsp;</p>



        <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right;">
            <?php
            echo $this->Html->link('Back', "/Investments/manageEquityInvestments/", array("class" => 'btn btn-lg btn-info'));
            echo $this->Form->button('Make Payment', array("type" => "submit", "class" => "btn btn-lg btn-success")); //check the parameters here 
            echo $this->Html->link('Make Payment to generate receipt', "disposeEquityReceipt/7/2000");
            ?> 
        </div>

        <?php $this->Form->end(); ?>

        <div id="clearer"></div>

    </div>
    <!-- Content ends here -->
